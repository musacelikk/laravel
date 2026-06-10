import fs from 'fs';
import net from 'net';
import path from 'path';
import tls from 'tls';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const localHost = process.env.DB_PROXY_HOST ?? '127.0.0.1';
const localPort = Number(process.env.DB_PROXY_PORT ?? 15432);
const remoteHost = process.env.DB_HOST ?? '127.0.0.1';
const remotePort = Number(process.env.DB_PORT ?? 5432);
const SSL_REQUEST = Buffer.from([0x00, 0x00, 0x00, 0x08, 0x04, 0xd2, 0x16, 0x2f]);
const SSL_REQUEST_CODE = 80877103;
const GSS_REQUEST_CODE = 80877104;
const PROTOCOL_VERSION = 196608;

const tlsCredentials = {
    key: fs.readFileSync(path.join(__dirname, 'proxy-key.pem')),
    cert: fs.readFileSync(path.join(__dirname, 'proxy-cert.pem')),
};

function readStartupMessage(socket) {
    return new Promise((resolve, reject) => {
        const chunks = [];

        const onData = (chunk) => {
            chunks.push(chunk);

            while (true) {
                const buffer = Buffer.concat(chunks);

                if (buffer.length < 8) {
                    return;
                }

                const length = buffer.readInt32BE(0);
                const code = buffer.readInt32BE(4);

                if (length === 8 && code === GSS_REQUEST_CODE) {
                    socket.write(Buffer.from('N'));
                    chunks.length = 0;
                    if (buffer.length > 8) {
                        chunks.push(buffer.subarray(8));
                    }
                    continue;
                }

                if (length === 8 && code === SSL_REQUEST_CODE) {
                    reject(new Error('Unexpected SSL request after secure handshake.'));
                    return;
                }

                if (buffer.length < length) {
                    return;
                }

                if (length <= 8 || code !== PROTOCOL_VERSION) {
                    reject(new Error('Unsupported PostgreSQL client handshake.'));
                    return;
                }

                socket.off('data', onData);
                socket.off('error', onError);

                const remainder = buffer.subarray(length);

                if (remainder.length > 0) {
                    socket.unshift(remainder);
                }

                resolve(buffer.subarray(0, length));
                return;
            }
        };

        const onError = (error) => reject(error);

        socket.on('data', onData);
        socket.on('error', onError);
    });
}

function openTlsBackend(startupMessage) {
    return new Promise((resolve, reject) => {
        const backend = net.connect(remotePort, remoteHost);

        backend.once('error', reject);
        backend.write(SSL_REQUEST);

        backend.once('data', (response) => {
            if (response[0] !== 0x53) {
                backend.destroy();
                reject(new Error('Remote PostgreSQL server does not support SSL.'));

                return;
            }

            const secureBackend = tls.connect(
                {
                    socket: backend,
                    servername: remoteHost,
                    rejectUnauthorized: false,
                },
                () => {
                    secureBackend.write(startupMessage);
                    resolve(secureBackend);
                },
            );

            secureBackend.once('error', reject);
        });
    });
}

function bridgeSecureClient(secureClient) {
    readStartupMessage(secureClient)
        .then((startupMessage) => openTlsBackend(startupMessage))
        .then((backend) => {
            backend.pipe(secureClient);
            secureClient.pipe(backend);

            secureClient.on('error', () => backend.destroy());
            backend.on('error', () => secureClient.destroy());
        })
        .catch((error) => {
            console.error(`Client proxy error: ${error.message}`);
            secureClient.destroy();
        });
}

const tlsServer = tls.createServer(tlsCredentials, bridgeSecureClient);

const plainServer = net.createServer((socket) => {
    const chunks = [];

    const onData = (chunk) => {
        chunks.push(chunk);
        const buffer = Buffer.concat(chunks);

        if (buffer.length < 8) {
            return;
        }

        const length = buffer.readInt32BE(0);
        const code = buffer.readInt32BE(4);

        if (length === 8 && code === GSS_REQUEST_CODE) {
            socket.write(Buffer.from('N'));
            chunks.length = 0;
            if (buffer.length > 8) {
                chunks.push(buffer.subarray(8));
            }
            return;
        }

        if (length !== 8 || code !== SSL_REQUEST_CODE) {
            socket.destroy();
            return;
        }

        socket.off('data', onData);
        socket.write(Buffer.from('S'));

        const remainder = buffer.subarray(8);

        if (remainder.length > 0) {
            socket.unshift(remainder);
        }

        tlsServer.emit('connection', socket);
    };

    socket.on('data', onData);
    socket.on('error', () => socket.destroy());
});

plainServer.on('error', (error) => {
    console.error(`Proxy error: ${error.message}`);
    process.exit(1);
});

plainServer.listen(localPort, localHost, () => {
    console.log(`PostgreSQL proxy: ${localHost}:${localPort} -> ${remoteHost}:${remotePort}`);
});

import pg from 'pg';

const config = {
  host: process.env.DB_HOST ?? 'postgres.railway.internal',
  port: Number(process.env.DB_PORT ?? 16824),
  user: process.env.DB_USERNAME ?? 'railway',
  password: process.env.DB_PASSWORD,
  database: process.env.DB_ADMIN_DATABASE ?? 'railway',
  ssl: process.env.DB_SSLMODE === 'disable' ? false : { rejectUnauthorized: false },
};

const targetDatabase = process.env.DB_DATABASE ?? 'musa';
const targetSchema = process.env.DB_SCHEMA ?? 'dev1';

const client = new pg.Client(config);

try {
  await client.connect();

  const exists = await client.query('SELECT 1 FROM pg_database WHERE datname = $1', [targetDatabase]);

  if (exists.rowCount === 0) {
    await client.query(`CREATE DATABASE "${targetDatabase.replace(/"/g, '""')}"`);
    console.log(`Veritabanı oluşturuldu: ${targetDatabase}`);
  } else {
    console.log(`Veritabanı zaten mevcut: ${targetDatabase}`);
  }

  await client.end();

  const schemaClient = new pg.Client({ ...config, database: targetDatabase });
  await schemaClient.connect();

  if (targetSchema !== 'public') {
    await schemaClient.query(`CREATE SCHEMA IF NOT EXISTS "${targetSchema.replace(/"/g, '""')}"`);
    console.log(`Şema oluşturuldu: ${targetSchema}`);
  }

  await schemaClient.end();
} catch (error) {
  console.error('Hata:', error.message);
  process.exit(1);
}

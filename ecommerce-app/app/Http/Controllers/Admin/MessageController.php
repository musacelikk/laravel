<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function show(Message $message): View
    {
        if ($message->status === 'new') {
            $message->update(['status' => 'read']);
        }

        return view('admin.messages.show', [
            'message' => $message,
        ]);
    }

    public function destroy(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'Message deleted.');
    }
}

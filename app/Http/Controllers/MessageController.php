<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string',
            'user_from' => 'required|exists:users,id',
            'user_to' => 'required|exists:users,id'
        ]);

        $message = Message::query()->create($validated);

        MessageSent::dispatch($message);

        return response()->json(['message' => $message]);
    }
}

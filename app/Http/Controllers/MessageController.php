<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        MessageSent::dispatch(Message::query()->first());
//        broadcast(new MessageSent())->toOthers();

        return 'success';
    }

    public function store(Request $request)
    {
        $message = Message::query()->create([
            'user_from' => 3,
            'user_to' => 5,
            'message' => $request->input('message')
        ]);

        MessageSent::dispatch($message);
//        broadcast(new MessageSent($message))->toOthers();

        return $message;
    }
}

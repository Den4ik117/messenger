<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $users = User::all();
        $messages = collect(MessageResource::collection(Message::all()))->map(fn ($message) => ['message' => $message]);

        return view('welcome', compact([
            'users',
            'messages',
        ]));
    }
}

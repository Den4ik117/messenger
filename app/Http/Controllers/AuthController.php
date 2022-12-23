<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        if (auth()->check()) {
            auth()->logout();
        }

        auth()->login($user);

        return to_route('welcome');
    }
}

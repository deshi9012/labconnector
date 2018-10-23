<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    //

    public function getAllUsers() {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return $users;
    }

    public function checkAuth() {

    }

    public function getAuthUser() {
        return auth()->user();
    }

    public function join(RegisterRequest $request) {

        $user = User::create($request->all());

        Auth::login($user);
        return redirect('/room');
    }

    public function enter(LoginRequest $request) {

        $user  = User::where('email', $request->all()['email'])->first();

        if($user) {
            Auth::login($user);
            return redirect('/room');
        }
    }
}

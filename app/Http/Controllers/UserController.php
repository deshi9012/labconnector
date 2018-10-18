<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    //

    public function getAllUsers() {

    }

    public function join(Request $request) {

        $user = User::updateOrCreate($request->all());

        Auth::login($user);
        return redirect('/room');
    }

    public function enter(Request $request) {

        $user = $user = User::where('email', $request->all()['email'])->first();
        Auth::login($user);
        return redirect('/room');

    }

    public function checkAuth() {

    }
}

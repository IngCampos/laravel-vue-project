<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserConfigController extends Controller
{
    public function updatepassword(Request $request)
    {
        if ($request->password == $request->password && $request->password != "") {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
        }
    }
}

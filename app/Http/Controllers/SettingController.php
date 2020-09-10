<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings', [
            'user' => Auth::user(),
            'permissions' => Auth::user()->permissions
        ]);
    }
    public function update(Request $request)
    {
        if ($request->password == $request->password && $request->password != "") {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
        }
        return back();
    }
}

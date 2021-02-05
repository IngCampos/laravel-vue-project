<?php

namespace App\Http\Controllers;

use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        return view('app.settings', [
            'user' => Auth::user(),
            'permissions' => Auth::user()->permissions
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:30|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->update();
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name', 'asc')->paginate(15);
        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ],
            'users' => $users->load('department')
        ];
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'password' => Hash::make($request->name)
        ] + $request->all());
        $user->save();

        $user->department;
        return $user;
    }

    public function update_password(Request $request, User $user)
    {
        $user->password = Hash::make($request->password);
        $user->update();
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());

        $user->department;
        return $user;
    }

    public function disabled(User $user)
    {
        $user->isEnabled = !$user->isEnabled;
        $user->update();
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->department_id = $request->department_id;
        $user->isEnabled = true;
        $user->password = Hash::make($request->name);
        $user->save();
        $user->department;
        return $user;
    }

    public function update(UserRequest $request, User $user)
    {
        //The function just update password or the others values(together)
        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->department_id = $request->department_id;
        }
        $user->update();
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

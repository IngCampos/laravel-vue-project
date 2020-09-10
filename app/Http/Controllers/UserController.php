<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'asc')->paginate(15);
        for ($i = 0; $i < count($users); $i++) {
            $users[$i]->department;
        }
        return [
            'pagination' => [
                'total' => $users->total(),
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
            ],
            'users' => $users
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'department_id' => 'required'
        ]);

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        //The function just update password or the others values(together)
        if (isset($request->password)) {
            $request->validate([
                'password' => 'required|min:8|max:30'
            ]);
            $user->password = Hash::make($request->password);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'department_id' => 'required'
            ]);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->department_id = $request->department_id;
        }
        $user->update();
        $user->department;
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->isEnabled = !$user->isEnabled;
        $user->update();
    }
}

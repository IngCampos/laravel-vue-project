<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        $data = [];
        foreach (Permission::get() as $permission) {
            $users = $permission->users()->get()->load('department');
            array_push($data, (object) [
                'info' => $permission,
                'users' => $users,
            ]);
        }
        return view('admin.permission', [
            'permissions' =>  json_encode($data)
        ]);
    }

    public function create()
    {
        return Permission::get();
    }

    public function store(PermissionRequest $request)
    {
        $permissions = Permission::find($request->permission_id);
        if (count($permissions->users->where('pivot.user_id', $request->user_id)) == 0) {
            $permissions->users()->attach($request->user_id);
            $return = Permission::find($request->permission_id)->users
                ->where('pivot.user_id', $request->user_id)->first();
            $return->department;
            return $return;
        } else
            return abort(409); // if the permission is set, it return an error 409
    }

    public function destroy($id)
    {
        // TODO: create better route
        // explode to separate the id from permission and the user
        $ids = explode(',', $id);
        $permission = Permission::find($ids[0]);
        $permission->users()->detach($ids[1]);
        return $ids;
    }
}

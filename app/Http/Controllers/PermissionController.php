<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form to create a new permission.
     *
     * @return Response
     */
    public function create()
    {
        return Permission::get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // explode to separate the id from permission and the user
        $ids = explode(',', $id);
        $permission = Permission::find($ids[0]);
        $permission->users()->detach($ids[1]);
        return $ids;
    }
}

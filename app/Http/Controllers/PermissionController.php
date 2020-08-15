<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Permission::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = Permission::find($id)->users()->get();
        for ($i = 0; $i < count($permissions); $i++) {
            $permissions[$i]->department;
        }
        return $permissions;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

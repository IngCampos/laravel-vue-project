<?php

namespace App\Http\Controllers;

use App\User;

class DataByIdController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user_id($id)
    {
        $user = User::find($id);
        return $user->name;
    }

    public function department_user_id($id)
    {
        $direction = User::find($id)->department;
        return $direction->name;
    }
}

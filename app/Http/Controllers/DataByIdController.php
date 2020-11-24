<?php

namespace App\Http\Controllers;

use App\User;

class DataByIdController extends Controller
{
    // TODO: Try to use the Controller User and Department instead of using this one.
    public function user_id(User $user)
    {
        return $user->name;
    }

    public function department_user_id(User $user)
    {
        return $user->direction->name;
    }
}

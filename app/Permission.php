<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'created_at',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->orderBy('name');
    }
}

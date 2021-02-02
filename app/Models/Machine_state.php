<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine_state extends Model
{
    protected $fillable = [
        'name'
    ];

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

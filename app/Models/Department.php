<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $fillable = [
        'name'
    ];
    
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

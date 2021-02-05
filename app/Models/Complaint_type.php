<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint_type extends Model
{
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

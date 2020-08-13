<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public function type()
    {
        return $this->belongsTo(Complaint_type::class);
    }

    protected $fillable = [
        'name', 'email', 'complaint_type_id', 'content'
    ];

    protected $hidden = [
        'updated_at'
    ];
}

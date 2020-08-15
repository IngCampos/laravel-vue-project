<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public function state()
    {
        return $this->belongsTo(Machine_state::class);
    }

    protected $casts = [
        'common_failures' => 'array'
    ];
}

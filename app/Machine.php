<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public function machine_state()
    {
        return $this->belongsTo(Machine_state::class);
    }

    protected $casts = [
        'common_failures' => 'array'
    ];
}

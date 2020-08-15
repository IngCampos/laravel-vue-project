<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    public function tender_section()
    {
        return $this->belongsTo(Tender_section::class);
    }
}

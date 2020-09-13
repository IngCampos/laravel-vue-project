<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender_section extends Model
{
    public function tenders()
    {
        return $this->hasMany(Tender::class)->orderBy('name', 'asc');
    }

    public function getGetNameAttribute()
    {
        return "Public tender " . ($this->isInternational ? 'International' : 'National') .
            " 00" . $this->number . -$this->year;
    }
}

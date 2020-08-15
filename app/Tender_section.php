<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tender_section extends Model
{
    public function tenders()
    {
        return $this->hasMany(Tender::class)->orderBy('name', 'asc');
    }
}

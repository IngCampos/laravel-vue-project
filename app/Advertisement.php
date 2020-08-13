<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'order', 'image_source', 'link', 'expiration'
    ];
}

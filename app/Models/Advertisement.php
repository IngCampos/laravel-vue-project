<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'image_source', 'link', 'expiration'
    ];

    public function setImageSourceAttribute($value)
    {
        $this->attributes['image_source'] = "/storage/ads/" . $value;
    }
}

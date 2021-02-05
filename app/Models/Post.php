<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'iframe', 'image', 'user_id',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGetExcerptAttribute($key)
    {
        // return substr($this->body, 0, 140); //PHP function
        return Str::limit($this->body, 140); // Laravel function
    }

    public function getGetImageAttribute($key)
    {
        if ($this->image)
            return url("storage/$this->image");
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'tags',
    ];

    public function Images()
    {
        return $this->belongsToMany("App\Image", 'images_tags','tag_id', 'image_id');
    }
}

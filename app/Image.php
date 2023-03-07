<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images"; //Indica la tabla que va a modificar este modelo

    //Relacion de uno a varios: de una imagen a muchos comentarios:
    public function comments(){
        return $this->hasMany("App\Comment")->orderBy('id','desc');
    }

    //Relacion de uno a muchos: una imagen muchos likes
    public function likes(){
        return $this->hasMany("App\Like");
    }

    //Relacion de muchos a uno: muchas imagenes pueden tener un solo usuario:
    public function user(){
        return $this->belongsTo("App\User","user_id");
    }
}

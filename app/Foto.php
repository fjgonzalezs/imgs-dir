<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
	 use SoftDeletes;
	 protected $table = 'fotos';
     protected $fillable = [
        'url', 'bbcode','favorito','created_at'
    ];
     protected $dates = ['deleted_at'];
     
     public function carpetas()
    {
        return $this->belongsTo('App\Carpeta');
    }
    
}

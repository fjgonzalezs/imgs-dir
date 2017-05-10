<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carpeta extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nombre'
    ];
    protected $dates = ['deleted_at'];
     public function user()
    {
        return $this->belongsTo('App\User');
    }
     public function fotos()
    {
        return $this->hasMany('App\Foto');
    }
}

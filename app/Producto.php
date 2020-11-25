<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    public $fillable = ['*'];

    public function clase() {
    	return $this->belongsTo('App\Clase');
    }
}

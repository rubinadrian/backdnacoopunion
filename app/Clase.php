<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clase extends Model
{
    use SoftDeletes;

    protected $fillable = ['clase'];

    public function productos() {
    	return $this->hasMany('App\Producto');
    }
}

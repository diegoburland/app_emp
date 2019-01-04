<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Busqueda extends Model
{

    protected $fillable = [
        'razon_social'
    ];
    protected $table = 'empresas'; //change the table name here.
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    
    protected $fillable = array('razon_social', 'ubicacion', 'direccion', 'tel', 'email', 'nombres_contacto', 'apellidos_contacto', 'tel_contacto', 'cel_contacto', 'email_contacto');
}

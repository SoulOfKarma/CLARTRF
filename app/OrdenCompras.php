<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompras extends Model
{
    protected $fillable = [
        'descripcionOrdenCompras',
        'fechaOC',
        'idEstadoOC'
    ];

}

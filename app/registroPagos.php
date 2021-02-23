<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registroPagos extends Model
{
    protected $fillable = [
        'idART',
        'ncuotaPago',
        'montoPago',
        'fechaPago',
        'idTipoMantencion',
        'detallePago',
        'presupuestoPago',
        'uuid'
    ];
}

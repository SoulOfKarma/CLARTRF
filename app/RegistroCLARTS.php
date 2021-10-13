<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroCLARTS extends Model
{
    protected $table = 'registroCLARTS';

    protected $fillable = [
        'idART', 'idProveedor','monto','nfactura','fechaemifac','fechaentcont','idCategoria','idEstado'
    ];
}

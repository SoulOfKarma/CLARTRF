<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registroARTS extends Model
{
    protected $fillable = [
        'idART',
        'fechaART',
        'fechaFactura',
        'idProveedor',
        'idSolicitante',
        'idEjecutor',
        'idItemPresupuestario',
        'idTipoMantencion',
        'idRecurso',
        'idTipoCompra',
        'idLicitacion',
        'idResLlamado',
        'idResAdjudicacion',
        'idResContrato',
        'idCDP',
        'idOrdenCompra',
        'idResInterna',
        'idMemo',
        'monto','cuotas','saldo',
        'uuid',
        'nfactura',
        'detalleART'
    ];
}

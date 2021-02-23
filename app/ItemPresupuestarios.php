<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPresupuestarios extends Model
{
    protected $fillable = [
        'codigoItemPresupuestario','descripcionItemPresupuestario'
    ];
}

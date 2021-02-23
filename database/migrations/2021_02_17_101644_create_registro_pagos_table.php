<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idART')->nullable();
            $table->bigInteger('ncuotaPago');
            $table->bigInteger('montoPago')->nullable();
            $table->date('fechaPago')->nullable();
            $table->bigInteger('idTipoMantencion')->nullable();
            $table->string('detallePago')->nullable();
            $table->bigInteger('presupuestoPago');
            $table->uuid('uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_pagos');
    }
}

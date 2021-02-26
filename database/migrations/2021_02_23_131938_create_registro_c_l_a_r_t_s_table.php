<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroCLARTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroCLARTS', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idART')->nullable();
            $table->bigInteger('idProveedor');
            $table->bigInteger('monto');
            $table->string('nfactura')->nullable();
            $table->date('fechaemifac')->nullable();
            $table->date('fechaentcont')->nullable();
            $table->bigInteger('idCategoria');
            $table->bigInteger('idEstado')->nullable();
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
        Schema::dropIfExists('registroCLARTS');
    }
}

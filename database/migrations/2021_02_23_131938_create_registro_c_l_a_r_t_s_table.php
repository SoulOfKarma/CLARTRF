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
            $table->bigInteger('idART');
            $table->bigInteger('idProveedor');
            $table->bigInteger('monto');
            $table->string('nfactura');
            $table->date('fechaemifac');
            $table->date('fechaentcont');
            $table->bigInteger('idCategoria');
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

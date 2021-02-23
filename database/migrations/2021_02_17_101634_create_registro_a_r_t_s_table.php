<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroARTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroARTS', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idART');
            $table->date('fechaART');
            $table->date('fechaFactura');
            $table->bigInteger('idProveedor')->unsigned()->nullable();
            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->bigInteger('idSolicitante')->unsigned()->nullable();
            $table->foreign('idSolicitante')->references('id')->on('solicitantes');
            $table->bigInteger('idEjecutor')->unsigned()->nullable();
            $table->foreign('idEjecutor')->references('id')->on('ejecutores');
            $table->bigInteger('idItemPresupuestario')->unsigned()->nullable();
            $table->foreign('idItemPresupuestario')->references('id')->on('item_presupuestarios');
            $table->bigInteger('idTipoMantencion')->unsigned()->nullable();
            $table->foreign('idTipoMantencion')->references('id')->on('tipo_mantenciones');
            $table->bigInteger('idRecurso')->unsigned()->nullable();
            $table->foreign('idRecurso')->references('id')->on('recursos');
            $table->bigInteger('idTipoCompra')->unsigned()->nullable();
            $table->foreign('idTipoCompra')->references('id')->on('tipo_compras');
            $table->bigInteger('idLicitacion')->unsigned()->nullable();
            $table->foreign('idLicitacion')->references('id')->on('licitaciones');
            $table->bigInteger('idResLlamado')->unsigned()->nullable();
            $table->foreign('idResLlamado')->references('id')->on('resolucion_llamados');
            $table->bigInteger('idResAdjudicacion')->unsigned()->nullable();
            $table->foreign('idResAdjudicacion')->references('id')->on('resolucion_adjudicaciones');
            $table->bigInteger('idResContrato')->unsigned()->nullable();
            $table->foreign('idResContrato')->references('id')->on('resolucion_contratos');
            $table->bigInteger('idCDP')->unsigned()->nullable();
            $table->foreign('idCDP')->references('id')->on('cdps');
            $table->bigInteger('idOrdenCompra')->unsigned()->nullable();
            $table->foreign('idOrdenCompra')->references('id')->on('orden_compras');
            $table->bigInteger('idResInterna')->unsigned()->nullable();
            $table->foreign('idResInterna')->references('id')->on('resolucion_internas');
            $table->bigInteger('idMemo')->unsigned()->nullable();
            $table->foreign('idMemo')->references('id')->on('memos');
            $table->bigInteger('monto');
            $table->bigInteger('cuotas');
            $table->bigInteger('saldo');
            $table->uuid('uuid');
            $table->string('nfactura');
            $table->string('detalleART');
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
        Schema::dropIfExists('registroARTS');
    }
}

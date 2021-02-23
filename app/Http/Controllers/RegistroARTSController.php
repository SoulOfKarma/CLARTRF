<?php

namespace App\Http\Controllers;

use App\registroARTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RegistroARTSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function DataByOC($id){
       try {
           $get_all = RegistroARTS::select('registroarts.fechaART','registroarts.fechaFactura',
                      'proveedores.rutProveedor','proveedores.descripcionProveedor','solicitantes.descripcionSolicitante',
                      'ejecutores.descripcionEjecutores','item_presupuestarios.codigoItemPresupuestario','item_presupuestarios.descripcionItemPresupuestario',
                      'tipo_mantenciones.descripcionTipoMantencion','recursos.descripcionRecursos',
                      'tipo_compras.descripcionTipoCompra','licitaciones.codigoLicitacion','resolucion_llamados.descripcionResLlamados',
                      'resolucion_adjudicaciones.descripcionResAdj','resolucion_contratos.descripcionResContratos',
                      'cdps.descripcionCDPS','orden_compras.descripcionOrdenCompras','resolucion_internas.descripcionResInternas',
                      'memos.descripcionMemo','monto','cuotas','saldo','nfactura','detalleART','uuid')
                      ->join('proveedores','registroarts.idProveedor','=','proveedores.id')
                      ->join('solicitantes','registroarts.idSolicitante','=','solicitantes.id')
                      ->join('ejecutores','registroarts.idEjecutor','=','ejecutores.id')
                      ->join('item_presupuestarios','registroARTS.idItemPresupuestario','=','item_presupuestarios.id')
                      ->join('tipo_mantenciones','registroARTS.idTipoMantencion','=','tipo_mantenciones.id')
                      ->join('recursos','registroARTS.idRecurso','=','recursos.id')
                      ->join('tipo_compras','registroARTS.idTipoCompra','=','tipo_compras.id')
                      ->join('licitaciones','registroARTS.idLicitacion','=','licitaciones.id')
                      ->join('resolucion_llamados','registroARTS.idResLlamado','=','resolucion_llamados.id')
                      ->join('resolucion_adjudicaciones','registroARTS.idResAdjudicacion','=','resolucion_adjudicaciones.id')
                      ->join('resolucion_contratos','registroARTS.idResContrato','=','resolucion_contratos.id')
                      ->join('cdps','registroARTS.idCDP','=','cdps.id')
                      ->join('orden_compras','registroARTS.idOrdenCompra','=','orden_compras.id')
                      ->join('resolucion_internas','registroARTS.idResInterna','=','resolucion_internas.id')
                      ->join('memos','registroARTS.idMemo','=','memos.id')
                      ->where('orden_compras',$id)
                      ->first();

            return $get_all;
       } catch (\Throwable $th) {
           log::info($th);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function show(registroARTS $registroARTS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function edit(registroARTS $registroARTS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registroARTS $registroARTS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function destroy(registroARTS $registroARTS)
    {
        //
    }
}

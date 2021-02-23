<?php

namespace App\Http\Controllers;

use App\ResolucionLlamados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResolucionLlamadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = ResolucionLlamados::all();
        return $get_all;
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

    public function CreateRL(Request $request){
      try {
          ResolucionLlamados::create($request->all());
          return true;
      } catch (\Throwable $th) {
          log::info($th);
          return false;
      }
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
     * @param  \App\ResolucionLlamados  $resolucionLlamados
     * @return \Illuminate\Http\Response
     */
    public function show(ResolucionLlamados $resolucionLlamados)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResolucionLlamados  $resolucionLlamados
     * @return \Illuminate\Http\Response
     */
    public function edit(ResolucionLlamados $resolucionLlamados)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResolucionLlamados  $resolucionLlamados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResolucionLlamados $resolucionLlamados)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResolucionLlamados  $resolucionLlamados
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResolucionLlamados $resolucionLlamados)
    {
        //
    }
}

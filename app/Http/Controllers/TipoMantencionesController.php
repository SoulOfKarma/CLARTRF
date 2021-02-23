<?php

namespace App\Http\Controllers;

use App\TipoMantenciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoMantencionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = TipoMantenciones::all();
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

    public function CreateTM(Request $request){
        try {
            $get_all = TipoMantenciones::create($request->all());
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
     * @param  \App\TipoMantenciones  $tipoMantenciones
     * @return \Illuminate\Http\Response
     */
    public function show(TipoMantenciones $tipoMantenciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoMantenciones  $tipoMantenciones
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMantenciones $tipoMantenciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoMantenciones  $tipoMantenciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMantenciones $tipoMantenciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoMantenciones  $tipoMantenciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMantenciones $tipoMantenciones)
    {
        //
    }
}

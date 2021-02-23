<?php

namespace App\Http\Controllers;

use App\ResolucionContratos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResolucionContratosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = ResolucionContratos::all();
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

    public function CreateRC(Request $request){
        try {
            ResolucionContratos::create($request->all());
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
     * @param  \App\ResolucionContratos  $resolucionContratos
     * @return \Illuminate\Http\Response
     */
    public function show(ResolucionContratos $resolucionContratos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResolucionContratos  $resolucionContratos
     * @return \Illuminate\Http\Response
     */
    public function edit(ResolucionContratos $resolucionContratos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResolucionContratos  $resolucionContratos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResolucionContratos $resolucionContratos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResolucionContratos  $resolucionContratos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResolucionContratos $resolucionContratos)
    {
        //
    }
}

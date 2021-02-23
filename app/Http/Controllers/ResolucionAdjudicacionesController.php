<?php

namespace App\Http\Controllers;

use App\ResolucionAdjudicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResolucionAdjudicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = ResolucionAdjudicaciones::all();
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

    public function CreateRA(Request $request){
       try {
           ResolucionAdjudicaciones::create($request->all());
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
     * @param  \App\ResolucionAdjudicaciones  $resolucionAdjudicaciones
     * @return \Illuminate\Http\Response
     */
    public function show(ResolucionAdjudicaciones $resolucionAdjudicaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResolucionAdjudicaciones  $resolucionAdjudicaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(ResolucionAdjudicaciones $resolucionAdjudicaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResolucionAdjudicaciones  $resolucionAdjudicaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResolucionAdjudicaciones $resolucionAdjudicaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResolucionAdjudicaciones  $resolucionAdjudicaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResolucionAdjudicaciones $resolucionAdjudicaciones)
    {
        //
    }
}

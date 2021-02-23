<?php

namespace App\Http\Controllers;

use App\Licitaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LicitacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = Licitaciones::all();
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

    public function CreateLic(Request $request){
        try {
            Licitaciones::create($request->all());
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
     * @param  \App\Licitaciones  $licitaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Licitaciones $licitaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Licitaciones  $licitaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Licitaciones $licitaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Licitaciones  $licitaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Licitaciones $licitaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Licitaciones  $licitaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Licitaciones $licitaciones)
    {
        //
    }
}

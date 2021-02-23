<?php

namespace App\Http\Controllers;

use App\Solicitantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SolicitantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = Solicitantes::all();
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

    public function CreateSolicitante(Request $request){
        try {
            $get_all = Solicitantes::create($request->all());
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
     * @param  \App\Solicitantes  $solicitantes
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitantes $solicitantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitantes  $solicitantes
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitantes $solicitantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitantes  $solicitantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitantes $solicitantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitantes  $solicitantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitantes $solicitantes)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\TipoCompras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TipoComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = TipoCompras::all();
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

    public function CreateTC(Request $request){
        try {
            TipoCompras::create($request);
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
     * @param  \App\TipoCompras  $tipoCompras
     * @return \Illuminate\Http\Response
     */
    public function show(TipoCompras $tipoCompras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoCompras  $tipoCompras
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoCompras $tipoCompras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoCompras  $tipoCompras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoCompras $tipoCompras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoCompras  $tipoCompras
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoCompras $tipoCompras)
    {
        //
    }
}

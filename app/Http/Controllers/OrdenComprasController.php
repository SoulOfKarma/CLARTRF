<?php

namespace App\Http\Controllers;

use App\OrdenCompras;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrdenComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = OrdenCompras::all();
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

    public function CreateOC(Request $request){
       try {
           OrdenCompras::create($request->all());
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
     * @param  \App\OrdenCompras  $ordenCompras
     * @return \Illuminate\Http\Response
     */
    public function show(OrdenCompras $ordenCompras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdenCompras  $ordenCompras
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenCompras $ordenCompras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdenCompras  $ordenCompras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdenCompras $ordenCompras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrdenCompras  $ordenCompras
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdenCompras $ordenCompras)
    {
        //
    }
}

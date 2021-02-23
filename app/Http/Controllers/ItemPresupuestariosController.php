<?php

namespace App\Http\Controllers;

use App\ItemPresupuestarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemPresupuestariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_all = ItemPresupuestarios::all();
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

    public function CreateIP(Request $request){
        try {
            $get_all = ItemPresupuestarios::create($request->all());
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
     * @param  \App\ItemPresupuestarios  $itemPresupuestarios
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPresupuestarios $itemPresupuestarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemPresupuestarios  $itemPresupuestarios
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemPresupuestarios $itemPresupuestarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemPresupuestarios  $itemPresupuestarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemPresupuestarios $itemPresupuestarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemPresupuestarios  $itemPresupuestarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemPresupuestarios $itemPresupuestarios)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\RepositorioDocumentaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RepositorioDocumentacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $get_all = RepositorioDocumentaciones::all();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function showRegistroEspecifico($id){
        try {
            $get_all = RepositorioDocumentaciones::select("*")
            ->where("repositorio_documentaciones.idCLART", $id)
            ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
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
        $data = "";
        try {
            if ($request->hasFile('avatar')) {
                // Si es así , almacenamos en la carpeta public/avatars
                // esta estará dentro de public/defaults/
               $url = $request->avatar->store('users/Documentacion');
               $RepositorioDocumentaciones = new RepositorioDocumentaciones;
               $RepositorioDocumentaciones->idCLART = $request->id;
               //$repositorioDocumentaciones->descripcionDocumento = $request->nombreDoc;
               $RepositorioDocumentaciones->nombreDocumento = $url;
               $RepositorioDocumentaciones->save();
               $idLast = $RepositorioDocumentaciones->id;
               RepositorioDocumentaciones::where('id', $idLast)
                ->where('idCLART', $request->id)
                ->update(['descripcionDocumento' => $request->nombreDoc]);
               return true;
            }
            
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RepositorioDocumentaciones  $repositorioDocumentaciones
     * @return \Illuminate\Http\Response
     */
    public function show(RepositorioDocumentaciones $repositorioDocumentaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RepositorioDocumentaciones  $repositorioDocumentaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(RepositorioDocumentaciones $repositorioDocumentaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RepositorioDocumentaciones  $repositorioDocumentaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RepositorioDocumentaciones $repositorioDocumentaciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RepositorioDocumentaciones  $repositorioDocumentaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepositorioDocumentaciones $repositorioDocumentaciones)
    {
        //
    }
}

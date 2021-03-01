<?php

namespace App\Http\Controllers;

use App\RegistroCLARTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;

class RegistroCLARTSController extends Controller
{
    protected $dateFormat = 'U';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $get_all = registroCLARTS::all();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function indexCatEQ(){
        try {
            $get_all = registroCLARTS::select("registroCLARTS.id","registroCLARTS.idART","proveedores.rutProveedor",
            "proveedores.descripcionProveedor","registroCLARTS.monto","registroCLARTS.nfactura","registroCLARTS.fechaemifac",
            "registroCLARTS.fechaentcont",DB::raw("DATE_FORMAT(registroCLARTS.updated_at,'%Y-%m-%d') as updated_at"),"estados.descripcionEstado")
            ->join("proveedores","registroCLARTS.idProveedor","=","proveedores.id")
            ->join("estados","registroCLARTS.idEstado","=","estados.id")
            ->where("registroCLARTS.idCategoria",1)
            ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function indexCatI(){
        try {
            $get_all = registroCLARTS::select("registroCLARTS.id","registroCLARTS.idART","proveedores.rutProveedor",
            "proveedores.descripcionProveedor","registroCLARTS.monto","registroCLARTS.nfactura","registroCLARTS.fechaemifac",
            "registroCLARTS.fechaentcont",DB::raw("DATE_FORMAT(registroCLARTS.updated_at,'%Y-%m-%d') as updated_at"),"estados.descripcionEstado")
            ->join("proveedores","registroCLARTS.idProveedor","=","proveedores.id")
            ->join("estados","registroCLARTS.idEstado","=","estados.id")
            ->where("registroCLARTS.idCategoria",2)
            ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function indexCatAP(){
        try {
            $get_all = registroCLARTS::select("registroCLARTS.id","registroCLARTS.idART","proveedores.rutProveedor",
            "proveedores.descripcionProveedor","registroCLARTS.monto","registroCLARTS.nfactura","registroCLARTS.fechaemifac",
            "registroCLARTS.fechaentcont",DB::raw("DATE_FORMAT(registroCLARTS.updated_at,'%Y-%m-%d') as updated_at"),"estados.descripcionEstado")
            ->join("proveedores","registroCLARTS.idProveedor","=","proveedores.id")
            ->join("estados","registroCLARTS.idEstado","=","estados.id")
            ->where("registroCLARTS.idCategoria",3)
            ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function indexCatMI(){
        try {
            $get_all = registroCLARTS::select("registroCLARTS.id","registroCLARTS.idART","proveedores.rutProveedor",
            "proveedores.descripcionProveedor","registroCLARTS.monto","registroCLARTS.nfactura","registroCLARTS.fechaemifac",
            "registroCLARTS.fechaentcont",DB::raw("DATE_FORMAT(registroCLARTS.updated_at,'%Y-%m-%d') as updated_at"),"estados.descripcionEstado")
            ->join("proveedores","registroCLARTS.idProveedor","=","proveedores.id")
            ->join("estados","registroCLARTS.idEstado","=","estados.id")
            ->where("registroCLARTS.idCategoria",4)
            ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }




    public function showRegistroEspecifico(){
        try {
            $get_all = registroCLARTS::select("registroCLARTS.id","registroCLARTS.idART","proveedores.rutProveedor",
            "proveedores.descripcionProveedor","registroCLARTS.monto","registroCLARTS.nfactura","registroCLARTS.fechaemifac",
            "registroCLARTS.fechaentcont", DB::raw("DATE_FORMAT(registroCLARTS.updated_at,'%Y-%m-%d') as updated_at"),"estados.descripcionEstado")
            ->join("proveedores","registroCLARTS.idProveedor","=","proveedores.id")
            ->join("estados","registroCLARTS.idEstado","=","estados.id")
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            registroCLARTS::create($request->all());
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegistroCLARTS  $registroCLARTS
     * @return \Illuminate\Http\Response
     */
    public function show(RegistroCLARTS $registroCLARTS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegistroCLARTS  $registroCLARTS
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistroCLARTS $registroCLARTS)
    {
        //
    }

    public function PUTEstado(Request $request){
        try {
            RegistroCLARTS::where('idART', $request->idART)
                ->update(['idEstado' => $request->idEstado]);
                return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function PUTEstadoContabilidad(Request $request){
        try {
            RegistroCLARTS::where('idART', $request->idART)
                ->update(['idEstado' => $request->idEstado,'fechaentcont' => $request->fechaEmisionContabilidad]);
                return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegistroCLARTS  $registroCLARTS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistroCLARTS $registroCLARTS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegistroCLARTS  $registroCLARTS
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistroCLARTS $registroCLARTS)
    {
        //
    }
}

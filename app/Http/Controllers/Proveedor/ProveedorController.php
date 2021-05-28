<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResponsePermisoController;
use App\Models\DocumentoProveedor;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function  __construct(){
        $this->middleware('auth:api');
    }

    public function store(Request $request){

        if($request->user()->can('add_proveedor')) {


        $provedor=    DB::transaction(function () use ($request) {
                $provedor = Proveedor::create([
                    'razon_social' => $request->razon_social,
                    'primer_nombre' => $request->primer_nombre,
                    'primer_apellido' => $request->primer_apellido,
                    'segundo_nombre' => $request->segundo_nombre,
                    'segundo_apellido' => $request->segundo_apellido,
                    'tipo_proveedor' => $request->tipo_proveedor,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'email' => $request->email,
                    'municipio_id' => $request->municipio_id,
                    'user_id' => $request->user()->id
                ]);
                DocumentoProveedor::create([
                    'numero' => $request->numero,
                    'tipodocumento_id' => $request->tipodocumento_id,
                    'user_id' => $request->user()->id,
                    'proveedor_id' => $provedor->id
                ]);

                return $provedor;
            });

            if (!$request) {
                ResponseController::set_errors(true);
                ResponseController::set_messages('Error en la creacion del PROVEEDOR');
                return ResponseController::response('BAD REQUEST');
            }

            ResponseController::set_messages('Proveedor creado');
            ResponseController::set_data(['proveedor'=>$provedor->id]);
            return ResponseController::response('OK');
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');



    }

    public function show(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');

    }

    public function  get(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function update(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

    public function  destroy(Request $request){
        if($request->user()->can('add_provedor')){
            return response($request->user());
        }
        ResponseController::set_errors(true);
        ResponseController::set_messages('Usuario sin permiso');
        return ResponseController::response('UNAUTHORIZED');
    }

}
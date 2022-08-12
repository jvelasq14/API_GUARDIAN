<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contactos;

class ContactosController extends Controller
{
    public function Create(Request $request){

        $request->validate([
            "contactos" => "required",
        ]);
        
        $user_id = auth()->user()->id;
        $Contactos = new Contactos();
        $Contactos->user_id = $user_id;
        $Contactos->contactos = $request->contactos;
        $Contactos->save();

        return response([
            "status" => 1,
            "msg" => "¡Datos de usuario guardados exitosamente!"
        ]);
    }
    public function update(Request $request, $id){
        $user_id = auth()->user()->id; 

        if ( Contactos::where( ["user_id"=>$user_id, "id" => $id] )->exists() ) {                        
            $Contactos = Contactos::find($id);
            $Contactos->user_id = $user_id;
            $Contactos->contactos = $request->contactos;
            $Contactos->save();
            
            return response()->json([
                "status" => 1,
                "msg" => "Actualizado correctamente."
            ]);
        }else{
        
            return response()->json([
                "status" => 0,
                "msg" => "No de encontró el usuario"
            ], 404);
        }
    }
    public function getById($id){
        $user_id = auth()->user()->id;
        if( Contactos::where( ["id" => $id, "user_id" => $user_id ])->exists() ){            
            $info = Contactos::where( ["id" => $id, "user_id" => $user_id ])->get();
            return response()->json([
                "status" => 1,
                "msg" => "Registro encontrado",
                "msg" => $info,
            ], 404);
        }else{            
            return response()->json([
                "status" => 0,
                "msg" => "Registro no encontrado"
            ], 404);
        }
    }
    public function delate($id){
        $user_id = auth()->user()->id; 
        if( Contactos::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $info = Contactos::where( ["id" => $id, "user_id" => $user_id ])->first();
            $info->delete();
            
            return response()->json([
                "status" => 1,
                "msg" => "Registro eliminado correctamente."
            ]);
        }else{
             
             return response()->json([
                "status" => 0,
                "msg" => "No de encontró el registro"
            ], 404);
        }
    }
    public function get(Request $request){
        $user_id =  auth()->user()->id;

        $DATOS = Contactos::where("user_id", $user_id)->get();

        return response()->json([
            "status" => 1,
            "msg" => "Datos encontrados",
            "data" => $DATOS
        ]);
    }

}

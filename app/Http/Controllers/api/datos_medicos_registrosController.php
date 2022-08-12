<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datos_Medicos_Registro;

class datos_medicos_registrosController extends Controller
{
    public function create_Datos_Medicos(Request $request) {
        
        $request->validate([
            "eps" => "required",
            "tipo_sangre" => "required",
            "alergias" => "required",
            "patologias" => "required",
        ]);
        
        $user_id = auth()->user()->id;

        $Datos_Medicos_Registro = new Datos_Medicos_Registro();    
        $Datos_Medicos_Registro->user_id = $user_id; 
        $Datos_Medicos_Registro->eps = $request->eps;
        $Datos_Medicos_Registro->tipo_sangre = $request->tipo_sangre;
        $Datos_Medicos_Registro->alergias = $request->alergias;
        $Datos_Medicos_Registro->patologias = $request->patologias;
        $Datos_Medicos_Registro->save();
        
        return response([
            "status" => 1,
            "msg" => "¡Datos de usuario guardados exitosamente!"
        ]);
    }
    public function getDatos_Medicos(Request $request) {
        $user_id =  auth()->user()->id;

        $DATOS = Datos_Medicos_Registro::where("user_id", $user_id)->get();

        return response()->json([
            "status" => 1,
            "msg" => "Datos Medicos",
            "data" => $DATOS
        ]);
    }

     
    public function GetByID($id) {
        $user_id = auth()->user()->id;
        if( Datos_Medicos_Registro::where( ["id" => $id, "user_id" => $user_id ])->exists() ){            
            $info = Datos_Medicos_Registro::where( ["id" => $id, "user_id" => $user_id ])->get();
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

    public function update(Request $request, $id){

        $user_id = auth()->user()->id; 

        if ( Datos_Medicos_Registro::where( ["user_id"=>$user_id, "id" => $id] )->exists() ) {                        
            $Datos_Medicos_Registro = Datos_Medicos_Registro::find($id);
          
            $Datos_Medicos_Registro->eps = isset($request->eps) ? $request->eps : $Datos_Medicos_Registro->eps;    
            $Datos_Medicos_Registro->tipo_sangre = isset($request->tipo_sangre) ? $request->tipo_sangre :  $Datos_Medicos_Registro->tipo_sangre;
            $Datos_Medicos_Registro->alergias = isset($request->alergias) ? $request->alergias :  $Datos_Medicos_Registro->alergias; 
            $Datos_Medicos_Registro->patologias = isset($request->patologias) ? $request->patologias :  $Datos_Medicos_Registro->patologias;                
            $Datos_Medicos_Registro->save();
            
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

    public function delete($id){
        $user_id = auth()->user()->id; 
        if( Datos_Medicos_Registro::where( ["id" => $id, "user_id" => $user_id ])->exists() ){
            $info = Datos_Medicos_Registro::where( ["id" => $id, "user_id" => $user_id ])->first();
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
    
}

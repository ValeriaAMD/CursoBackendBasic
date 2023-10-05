<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function crear_usuario (Request $recuest){
        try{
            $user = User::create([
                'name' => $recuest->name,
                'email' =>$recuest->email,
                'password' => bcrypt($recuest->password),
            ]);

            return response()->json([
                'status' => 'success', // 'error
                'message' => 'Usuario creado exitosamente',
                'user' => $user,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error', // 'error
                'message' => 'Error al crear el usuario',
                'error' => $th->getMessage(),
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', // 'error
                'message' => 'Error al crear el usuario',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function consultar_usuario ($usuario_id)
    {

       try{
        $user = User::find($usuario_id);

        if ($user == null){
            return response()-> json([
                'status' => 'error',
                'message' => 'usuario no encontrado',
            ],404);
        }

        return response()->json([
            'status' => 'success', // 'error
            'message' => 'Usuario extraido exitosamente',
            'user' => $user,
        ]);
       } catch (\Throwable $th) {
        return response()->json([
            'status' => 'error', // 'error
            'message' => 'Error al crear el usuario',
            'error' => $th->getMessage(),
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error', // 'error
            'message' => 'Error al crear el usuario',
            'error' => $e->getMessage(),
        ], 500);
        }
    }

    public function obtener_usuario_por_token(){
        $user = JWTAuth::parseToken()->authenticate();
return response()->json([
            'status' => 'success', // 'error
            'message' => 'Usuario consultado exitosamente',
            'user' => $user,
        ]);
    }
}

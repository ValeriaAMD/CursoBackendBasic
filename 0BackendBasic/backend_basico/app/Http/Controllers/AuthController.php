<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function iniciar_secion(Request $request){
        $validador = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
if ($validador->fails()) {
            return response()->json([
                'status' => 'error', // 'error
                'message' => 'Error en los datos enviados',
                'error' => $validador->errors(),
            ], 400);
        }
$credenciales = $request->only(['email', 'password']);

        if (!$token = JWTAuth::customClaims([
            'test' => 'Vale Hdz', 
            'permisos' => [
                'crear_usuario',
                'consultar_usuario',
                'actualizar_usuario',
                'eliminar_usuario',
                'permiso_paraAbordar',
                'mas_permisosXD'
            ]
        ])->attempt($credenciales)) {
            return response()->json([
                'status' => 'error', // 'error
                'message' => 'Credenciales incorrectas',
            ], 401);
        }

        return response()->json([
            'status' => 'success', // 'error
            'message' => 'Inicio de sesión exitoso',
            'token' => $token,
        ]);
    }
}

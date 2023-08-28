<?php

namespace App\Http\Controllers;

use App\Models\Ficha;
use App\Models\FichaUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropietarioController extends Controller
{

    public function login_propietario(Request $request){

        if ( $request->passPropietario == 0 ) {
            $user = User::find($request->usuario);
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if (!Auth::attempt(['uuid' => $request->usuario, 'password' => $request->password])) {
            return response()->json([
                'ok' => false,
                'message' => 'Email o contraseña inválidos, o no tiene acceso.',
            ], 401);
        }

        $user = User::where('uuid', $request->usuario)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'ok' => true,
            'user' => [
                'uuid' => $user->uuid,
                '_token' => $token,
                '_usuario' => $request->password,
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $ficha = new Ficha();
        $ficha->entidad_id = $request->entidad;
        $ficha->departamento_id = $request->departamento_id;
        $ficha->estacionamiento = $request->estacionamiento ?? "";
        $ficha->numero_placa = $request->numero_placa ?? "";
        $ficha->visitas =  $request->visitas ?? "";
        $ficha->ingreso = $request->ingreso ?? "";
        $ficha->salida = $request->salida ?? "";
        $ficha->infantes = $request->infantes ?? "";
        $ficha->numero_huesped = $request->numero_huesped ?? "";
        $ficha->save();
        $adjunto = "";
        for ($i = 1; $i <= $request->numero_huesped; $i++) {
            $user = new User();
            $user->nombre  = $request->input("nombre-" . $i);
            $user->apellido = $request->input("apellido-" . $i);
            $user->tipo_documento_id = $request->input("tipo_documento_id-" . $i);
            $user->numero_documento = $request->input("numero_documento-" . $i);
            $user->user_type = '4';
            $user->principal = $request->input("principal-" . $i);
            $user->nacionalidad = $request->input("nacionalidad-" . $i);
            $user->save();

            $fichaUser = new FichaUser();
            $fichaUser->ficha_id = Ficha::find($ficha->uuid)->id;
            $fichaUser->user_id = User::find($user->uuid)->id;
            $fichaUser->save();
        }

        return response()->json([
            'ok' => true,
            'message' => "Se guardo correctamente",
            'ficha' => $ficha
        ]);
    }

    public function unidadXEntidad($uuidUsuario, $entidadID) {

        $response = DB::select("
            SELECT id, `uuid`, departamento
            FROM unidad_inmobiliaria
            WHERE estado = TRUE AND entidad_id = ? AND propietario = (SELECT id FROM users WHERE `uuid` = ?)
        ",[$entidadID, $uuidUsuario]);

        return response()->json([
            'ok' => true,
            'response' => $response
        ]);
    }

}

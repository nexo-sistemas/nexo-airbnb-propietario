<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;


Route::get('/', function (Request $request) {
    $user = User::find($request->u);
    if (!$user) {
       return view('pages.nofount-user');
    }
    return view('pages.login-propietario', ['user' => $user]);
});

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/frm', function (Request $request) {
        $entidad = DB::select("SELECT entidad.id,entidad.uuid, entidad.nombre FROM entidad WHERE id IN ( (SELECT usuario_entidad.entidad_id FROM usuario_entidad WHERE usuario_entidad.user_id = (SELECT users.id FROM users WHERE users.uuid = ? ) ) )", [$request->u]);
        return view('pages.ficha', [
            'entidad' => $entidad,
            'uuidUsuario' => $request->u
        ]);
    });

});

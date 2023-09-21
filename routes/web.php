<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

Route::get('/', function (Request $request) {
    if (!isset($request->u)) {
        return view('pages.nofount-user');
    }
    return view('pages.index', ['usuario' => $request->u]);
});

Route::get('/{usuario}', function ($usuario) {
    $user = User::find(base64_decode($usuario));
    return view('pages.login-propietario', ['user' => $user]);
});

Route::get('/ios/{usuario}', function ($usuario) {
    $user = User::find(base64_decode($usuario));
    if (!$user) {
        return view('pages.nofount-user');
     }
     return view('pages.login-propietario-ios', ['user' => $user]);
});

Route::get('/android', function (Request $request) {
    $user = User::find($request->u);
    if (!$user) {
        return view('pages.nofount-user');
     }
     return view('pages.login-propietario', ['user' => $user]);
});


Route::get('/user-not-fount', function () {
    return view('pages.nofount-user');
});


Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/frm/ficha', function (Request $request) {
        $entidad = DB::select("SELECT entidad.id,entidad.uuid, entidad.nombre FROM entidad WHERE id IN ( (SELECT usuario_entidad.entidad_id FROM usuario_entidad WHERE usuario_entidad.user_id = (SELECT users.id FROM users WHERE users.uuid = ? ) ) )", [$request->u]);
        return view('pages.ficha', [
            'entidad' => $entidad,
            'uuidUsuario' => $request->u
        ]);
    });

});

<?php

namespace App\Http\Controllers\tabulador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TabuladorCreateRequest;
use App\Models\Tabulador;

class tabuladorController extends Controller
{
    public function store(TabuladorCreateRequest $request)
    {
//        return response()->json([
//            'ok'=>false,
//            'mensaje' => 'El tabulador se registro correctamente',
//            'tabulador' => $request->all()
//        ], 200);
        // Se busca si existe un tabulador anterior para inhabilitar
        $tabulador = Tabulador::where('activo', 'SI')->first();
        if ($tabulador) {
            $tabulador->activo = "NO";
            $tabulador->save();
        }
        // Se cargan todos los datos provenientes del Request
        $tabulador = new Tabulador();
        $tabulador->fill($request->all());
        $tabulador->fecha_inicio = new \Carbon\Carbon($request->fecha_inicio);

        $tabulador->save();

        // Se retorna el mensaje de guardado
        return response()->json([
            'ok'=>true,
            'mensaje' => 'El tabulador se registro correctamente',
            'tabulador' => $tabulador
        ], 200);
    }

    public function index()
    {
        // Se busca el tabulador activo
        $tabulador = Tabulador::where('activo', 'SI')->first();

        // Se verifica que exista un tabulador activo
        if (!$tabulador) {
            return response()->json([
            'ok'=>true,
            'mensaje' => 'No existe tabulador activo'
          ], 204);
        }

        // Se retorna el tabulador encontrado
        return response()->json([
          'ok'=>true,
          'tabulador' => $tabulador
        ], 200);
    }
}

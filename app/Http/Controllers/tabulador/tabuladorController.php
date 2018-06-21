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
    	$tabulador = new Tabulador();
    	$tabulador->fill($request->all());

    	$tabulador->save();

    	return response()->json([
    		'ok'=>true,
    		'mensaje' => 'El tabulador se registro correctamente',
    		'tabulador' => $tabulador
    	], 200);
    }
}

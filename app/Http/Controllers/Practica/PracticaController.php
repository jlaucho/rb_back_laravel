<?php

namespace App\Http\Controllers\Practica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facturas;

class PracticaController extends Controller
{
    public function index()
    {
    	$facturas = Facturas::all();

    	return response()->json([
    		'ok'	=> true,
    		'resp'	=> $facturas
    	]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresas;

class datosController extends Controller
{
    public function datos()
    {
        $empresas = Empresas::all();

        foreach ($empresas as $keyE => $empresa) {
            // return $empresa->r_facturas;
            if (count($empresa->r_facturas) < 1) {
                unset($empresas[$keyE]);
            }
            foreach ($empresa->r_facturas as $keyF => $factura) {
                if ($factura->pagada == 'NO') {
                    unset($empresa->r_facturas[$keyF]);
                    // return 'SI esta paga '. $factura->numFactura ;
                    // break;
                }
                foreach ($factura->r_correos_facturas as $keyCF => $correoF) {
                    $correoF->r_correoEnviado;
                }
            }
        }

        return response()->json([
        'ok'  => 'true',
        'empresas'=> $empresas
      ]);
    }
}

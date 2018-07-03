<?php

namespace App\Http\Controllers\busqueda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Empresas;
use App\Models\CorreosEnviados;
use App\Models\Facturas;
use App\Models\Tabulador;

class BusquedaController extends Controller
{
    public function por_coleccion($collection, $id)
    {
        // Se busca por coleccion en el swich
        switch ($collection) {
        case 'usuario':
              $busqueda = User::find($id);
          break;

        case 'correo':
              $busqueda = CorreosEnviados::find($id);
          break;

        case 'factura':

              $busqueda = Facturas::busquedaFactura($id);
          break;

        case 'empresa':
              $busqueda = Empresas::find($id);
          break;

        case 'tabulador':
              $busqueda = Tabulador::where('activo', 'SI')->first();
          break;

        default:
            // Sino se encuentra ninguna collecion retrna el mensaje de error
            return response()->json([
                'ok'=>false,
                'error'=>['coleccion'=>'Coleccion no permitida, solo se admite "usuario", "empresa", "correo", "tabulador" y "factura"']
            ], 400);
            break;
        }
        // Si el Request es valido se verifica si el retorno de a BD contiene datos
        if (!$busqueda || $busqueda->count() == 0) {
            return response()->json([
                    'ok'=>false,
                    'error'=>[$collection =>'No existen datos para el ID: '. $id]
                ], 202);
        }
        // Si todo se encuentra todo se retorna los resultados de la busqueda
        $total = count($busqueda);
        return response()->json([
            'ok'=>true,
            'total'=> $total,
            'busqueda'=>$busqueda
            ], 200);
    }
}

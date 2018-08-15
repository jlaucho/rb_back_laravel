<?php

namespace App\Http\Controllers\servicios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CorreosEnviados;
use App\Models\Recorridos;
use App\Models\Tabulador;

class ServiciosController extends Controller
{
    /**
    *
    * Store the CorreosEnviados
    * @return json Object
    * @param request correoObject data
    * @method POST
    *
    */
    public function store(Request $request)
    {


        $tabulador = Tabulador::tabuladorActivo('activo')->first();
        if (!$tabulador) {
            return response()->json([
            'ok'=>false,
            'mensaje' => 'No existe tabulador activo'
          ], 202);
        }
        // return response()->json( $tabulador, 200 );
        // return $request->all();
        $correo = new CorreosEnviados();
        $correo->fill($request->all());
        $correo->registrado_por = auth()->user()->id;
        $correo->save();

        if ($correo) {
            $montoTotalRecorridos = 0;
            $montoTotalEncomienda = 0;
            $montoTotalNocturno = 0;
            foreach ($request->origen as $key => $origen) {
                $recorrido = new Recorridos();
                // Se asignan los valores a los recorridos
                $recorrido->origen = $request->origen[$key];
                $recorrido->destino = $request->destino[$key];
                $recorrido->cantidad = $request->cantidad[$key];
                // Se verifica si es un Servicio interno o externo
                // de lo contrario se obtiene el valor suministrado por teclado
                $recorrido->concepto = $request->concepto[$key];
                switch ($recorrido->concepto) {
                    case 'DesvInter':
                        $recorrido->recorrido = $tabulador->monto_desv_exter;
                        break;
                    case 'DesvExter':
                        $recorrido->recorrido = $tabulador->monto_desv_inter;
                        break;
                    
                    default:
                        $recorrido->recorrido = $request->recorrido[$key];
                        break;
                }
                $recorrido->totalRecorrido = $recorrido->cantidad * $recorrido->recorrido;
                $recorrido->encomienda = $request->encomienda[$key];
                $recorrido->nocturno = $request->nocturno[$key];
                $recorrido->r_correo()->associate($correo);

                $montoTotalRecorridos += $recorrido->totalRecorrido;

                // Se determina si ese recorrido tienen encomienda
                if ($recorrido->encomienda == "SI") {
                    $montoTotalEncomienda += $recorrido->totalRecorrido;
                }

                // Se determina si ese recorrido tiene nocturno
                if ($recorrido->nocturno == "SI") {
                    $montoTotalNocturno += $recorrido->totalRecorrido;
                }

                $recorrido->save();
            }
            // Se guarda en la BD el total de los Nocturnos y Encomiendas
            $correo->monto_encomienda = $montoTotalEncomienda; //Este es el monto en bruto hay que sacarle el porcentaje
            $correo->monto_nocturno = $montoTotalNocturno; //Este en el monto en bruto hay que sacarle el porcentaje
            // Se globaliza el monto deacuerdo al porcentaje en el tabulador
            $montoServicioNocturno = $montoTotalNocturno * ($tabulador->por_bono_nocturno / 100);
            $montoServicioEncomienda = $montoTotalEncomienda * ($tabulador->por_encomienda / 100);

            $montoServicioNocturno = round($montoServicioNocturno, 2);
            $montoServicioEncomienda = round($montoServicioEncomienda, 2);

            // Se determina el servicio tiene espera
            $montoTotalHoras = 0;
            if ($correo->cantHoras > 0) {
                $montoTotalHoras += $correo->cantHoras * $tabulador->monto_horas;
                $correo->monto_horas = $montoTotalHoras;
            }
            // Se saca el monto total del Servicio
            $correo->totalMonto = $montoTotalRecorridos + $montoServicioNocturno + $montoServicioEncomienda + $montoTotalHoras;
            // Se determina el servicio tiene bono por fin de semana
            $montoTotalFinSemana = 0;
            if ($correo->bono_finSemana == "SI") {
                $montoTotalFinSemana += $correo->totalMonto * ($tabulador->por_fin_semana / 100);
                $montoTotalFinSemana = round($montoTotalFinSemana, 2);
            }
            // Se determina el servicio tiene Pernocta
            $montoTotalPernocta = 0;
            if ($correo->cantPernocta > 0) {
                $montoTotalPernocta += $correo->cantPernocta * $tabulador->monto_pernocta;
            }
            // Se suman todos los cargos del servicio
            $correo->monto_bonoFinSemana = $montoTotalFinSemana;
            $correo->monto_pernocta = $montoTotalPernocta;
            $correo->totalMonto += $montoTotalFinSemana + $montoTotalPernocta;
            $correo->save();
        }

        return response()->json([
            'ok'=> true,
            'mensaje'=>'El registro se creo correctamente por un monto de '. $correo->totalMonto
        ], 201);
    }
    /*---------------------------------------------------------------------------------------*/
    /**
    *
    * List the Correos
    * @return list
    * @param null
    * @method GET
    *
    */
    public function correoList($option = null)
    {
        try {
            $correos = CorreosEnviados::datosCorreo($option);
            // dd($correos);
            if (!$correos) {
                return response()->json([
                'ok' => false,
                'mensaje'=>'No existen correos registrados con esa opcion',
              ], 400);
            }

            $total = $correos->count();
            return response()->json([
              'ok' => true,
              'total'=>$total,
              'correos' => $correos
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
              'ok' => false,
              'correo' => null,
              'error' => ['busqueda' => 'Error al buscar el servicio en el sistema']
            ], 500);
        }
    }
    /*---------------------------------------------------------------------------------------*/
}

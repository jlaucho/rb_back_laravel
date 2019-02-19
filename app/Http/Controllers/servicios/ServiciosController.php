<?php

namespace App\Http\Controllers\servicios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CorreosEnviados;
use App\Models\Recorridos;
use App\Models\Tabulador;
use Mail;
use App\Mail\CostoServicio;
use App\Jobs\SendMail;
use phpDocumentor\Reflection\Types\Object_;

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
        $correo = new CorreosEnviados();
        $correo->fill($request->all());
        $correo->fechaServicio = new \Carbon\Carbon($request->fechaServicio);
        $correo->registrado_por = auth()->user()->id;
        $correo->tabulador_id = $tabulador->id;
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
                        $recorrido->recorrido = $tabulador->monto_desv_inter;
                        break;
                    case 'DesvExter':
                        $recorrido->recorrido = $tabulador->monto_desv_exter;
                        break;
                    
                    default:
                        $recorrido->recorrido = $request->recorrido[$key];
                        break;
                }
                // return response()->json(['respuestaRequest'=> $recorrido], 200);
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
//         try {
//
//            SendMail::dispatch('jlaucho@gmail.com')
//                ->delay(now()->addSeconds(10));
//         } catch (\Exception $e) {
//             return response()->json([
//                'ok'=> true,
//                'mensaje'=>'FALLO EL ENVIO DE CORREO, REALICELO '. $correo->totalMonto
//            ], 501);
//         }


        return response()->json([
            'ok'=> true,
            'mensaje'=>'El servicio se registro correctamente '. number_format($correo->totalMonto, 2, ',', '.')
        ], 200);
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
      $correos = CorreosEnviados::datosCorreo($option);
      // return $correos;
      // dd($correos);
      if (!$correos) {
          return response()->json([
          'ok' => false,
          'total' => 0,
          'mensaje'=>'No existen Servicios registrados con esa opcion',
        ], 400);
      }

      $total = $correos[0]->totalGeneral;
      return response()->json([
        'ok' => true,
        'total'=>$total,
        'correos' => $correos
      ], 200);
        
    }
    /*---------------------------------------------------------------------------------------*/

    /**
     * @param $idServicio
     * @return object
     * @method DELETE
     */
    public function delete($idServicio): object
    {
        $correo = CorreosEnviados::find($idServicio);

        if (!$correo) {
            return response()->json([
                'ok' => false,
                'total' => 0,
                'mensaje'=>'No es posible ubicar el servicio solicitado',
            ], 400);
        }

        $correo->delete();

        return response()->json([
            'ok' => true,
            'mensaje' => 'El servicio fue eliminado correctamente',
            'servicio' => $correo
        ], 200);

    }
    /*---------------------------------------------------------------------------------------*/

    /*---------------------------------------------------------------------------------------*/

    /**
     * @param $idServicio
     * @return object
     * @method DELETE
     */
    public function agregarODC( Request $request)
    {
        $servicio = CorreosEnviados::findOrFail($request->idServicio);

        if (!$servicio) {
            return response()->json([
                'ok' => false,
                'total' => 0,
                'mensaje'=>'No es posible ubicar el servicio solicitado',
            ], 400);
        }

        $servicio->ODC_number = $request->ODC_number;
        $servicio->save();

        return response()->json([
            'ok' => true,
            'mensaje' => 'El servicio fue actualizado con la ODC '. $request->ODC_number .' correctamente',
            'servicio' => $servicio
        ], 200);

    }
    /*---------------------------------------------------------------------------------------*/
}

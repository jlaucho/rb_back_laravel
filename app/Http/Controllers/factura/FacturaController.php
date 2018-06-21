<?php

namespace App\Http\Controllers\factura;

// use Illuminate\Http\Request;
use App\Http\Requests\FacturaCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\Facturas;
use App\Models\CorreosEnviados;
use App\Models\Correo_Factura;
// use App\Http\Controllers\busqueda\BusquedaController;

class FacturaController extends Controller
{

	/**
  *
  * Store the Factura
  * @return json Object
  * @param request empresa data
  * @method POST
  *
  */
  public function store(FacturaCreateRequest $request)
  {
    $factura = new Facturas();
    $factura->fill( $request->all());

    $factura->save();

    // $busqueda = new BusquedaController();

    $sum_servicios = 0;
    foreach ($request->correo_id as $key => $correo) {

      $correo = CorreosEnviados::find($request->correo_id[$key]);      

      $correo_factura = new Correo_Factura();
      $correo_factura->correo_id = $correo->idCorreos;
      $correo_factura->totalRenglonFactura = $correo->totalMonto;
      $correo_factura->cantServicios = $request->cantServicios[$key];
      $correo_factura->codigo = $request->codigo[$key];
      $correo_factura->ODC = $request->ODC[$key];
      $correo_factura->descripcion = $request->descripcion[$key];
      $sum_servicios+= $correo->totalMonto;
      $correo_factura->r_factura()->associate($factura);
      $correo_factura->save();

      $correo->facturado = 'SI';
      $correo->save();
    }

    $factura->baseImponible = $sum_servicios;
    $factura->IVA_monto = $factura->baseImponible * ($request->IVA_por / 100);
    $factura->totalFact = $factura->baseImponible + $factura->IVA_monto;
    $factura->save();
    
          

		return response()->json([
			'ok'=> true,
			'factura'=>$factura,
			'mensaje'=>'Factura creada correctamente'
		], 201);
  }
  /*---------------------------------------------------------------------------------------*/
}

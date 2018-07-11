<?php

namespace App\Http\Controllers\factura;

// use Illuminate\Http\Request;
use App\Http\Requests\FacturaCreateRequest;
use App\Http\Controllers\Controller;
use App\Models\Facturas;
use App\Models\CorreosEnviados;
use App\Models\Correo_Factura;
use App\Http\Controllers\pdfs\generarPdfController;
use App\Jobs\generarFacturaPdfJobs;

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
        // $generar = new generarPdfController();

        // $generar::facturaNueva();

        // Esta es el area donde en envia a generar factura
        // generarFacturaPdfJobs::dispatch();
        // $pdf = \PDF::loadview('vendor.pdfs.generarFactura');
        // return $pdf->download('ejemplo.pdf');
        // return $valor;


        $factura = new Facturas();
        $factura->fill($request->all());

        $factura->save();

        $total_servicios = 0; // Suma el total de todos los servicios invocados en la factura

        foreach ($request->correo_id as $key => $correo) {
            $correo = CorreosEnviados::find($request->correo_id[$key]);

            $correo_factura = new Correo_Factura();
            $correo_factura->correo_id = $correo->idCorreos;
            $correo_factura->totalRenglonFactura = $correo->totalMonto;
            $correo_factura->cantServicios = $request->cantServicios[$key];
            $correo_factura->codigo = $request->codigo[$key];
            $correo_factura->ODC = $request->ODC[$key];
            $correo_factura->descripcion = $request->descripcion[$key];
            $correo_factura->r_factura()->associate($factura);
            $correo_factura->save();

            $total_servicios+= $correo->totalMonto * $request->cantServicios[$key];

            $correo->facturado = 'SI';
            $correo->save();
        }

        $factura->baseImponible = $total_servicios;
        $IVA_monto = $factura->baseImponible * ($request->IVA_por / 100);
        $factura->IVA_monto = round($IVA_monto, 2);

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facturas extends Model
{
    protected $table 			  = 'facturas';
    protected $primaryKey 	= 'idFacturas';
    protected $fillable 		= [
        'idFacturas', 'numFactura' , 'fechaFactura' , 'descripcionFactura', 'baseImponible', 'IVA_por', 'IVA_monto', 'totalFact', 'pagada', 'empresas_id', 'created_at'
    ];

    /**
     *
     * Relaciones de la tabla
     *
     */
    public function r_correos_facturas()
    {
        return $this->hasMany('App\Models\Correo_Factura', 'factura_id', 'idFacturas');
    }

    public function r_empresa()
    {
        return $this->belongsTo('App\Models\Empresas', 'empresas_id', 'idEmpresas');
    }
    /**
     *
     * Method Static of Factura Tables
     *
     */

    private static function facturaEstatus($estatus)
    {
        $facturas = Facturas::select('*')
        ->where('pagada', $estatus)
        ->orderBy('created_at', 'DESC')
        ->get();
        return $facturas;
    }

    public static function busquedaFactura($option)
    {
        if ($option == 'todas') {
            $facturas = Facturas::select('*')
          ->orderBy('created_at', 'DESC')
          ->get();
        } elseif ($option == 'pagadas') {
            $facturas = self::facturaEstatus('SI');
        } elseif ($option == 'pendientes') {
            $facturas = self::facturaEstatus('NO');
        } else {
            $facturas = Facturas::where('numFactura', 'like', '%'.$option.'%')->get();

            // if ($factura) {
            //     $factura->r_empresa;
            // }
            //
            // return $factura;
        }

        if ($facturas) {
            foreach ($facturas as $key => $factura) {
                $factura->r_empresa;
                foreach ($factura->r_correos_facturas as $correoE) {
                    $correoE->r_correoEnviado;
                }
            }
        }

        return $facturas;
    }
}

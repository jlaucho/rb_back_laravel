<?php

namespace App\Http\Controllers\pdfs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class generarPdfController extends Controller
{
    public static function facturaNueva()
    {
        $pdf = \PDF::loadview('vendor.pdfs.generarFactura');
        return $pdf->download('ejemplo.pdf');
    }
}

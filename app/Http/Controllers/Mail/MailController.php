<?php

namespace App\Http\Controllers\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\CostoServicio;
use Mail;

class MailController extends Controller
{
    public function costo_servicio_prestado($recipent)
    {
    	Mail::to($recipent)
    		->send(new CostoServicio());
    }
}

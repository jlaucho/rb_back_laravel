<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabulador extends Model
{
    protected $table 			  = 'tabuladors';
    protected $primaryKey 	= 'id';
    protected $fillable 		= [
        'por_bono_nocturno', 'por_encomienda' , 'monto_pernocta' , 'monto_horas', 'por_fin_semana'
    ];

    public static function tabuladorActivo()
    {
        $tabulador = Tabulador::where('activo', 'SI')->first();
        return $tabulador;
    }
}

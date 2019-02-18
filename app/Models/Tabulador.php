<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabulador extends Model
{
    protected $table 			  = 'tabuladors';
    protected $primaryKey 	= 'id';
    protected $fillable 		= [
        'por_bono_nocturno', 'por_encomienda' , 'monto_pernocta' , 'monto_horas', 'por_fin_semana', 'monto_desv_inter', 'monto_desv_exter', 'fecha_inicio'
    ];

    public function r_tabulador()
    {
        return $this->hasOne(CorreosEnviados::class, 'tabulador_id', 'id');
    }

    public static function tabuladorActivo($collection)
    {
        switch ($collection) {

          case 'activo':
            $data = Tabulador::where('activo', 'SI')->get();
          break;

          case 'inactivos':
            $data = Tabulador::where('activo', 'NO')->get();
          break;

          case 'todos':
            $data = Tabulador::all();
          break;

          default:
            $data = Tabulador::find($collection);
          break;
        }

        return $data;
    }
}

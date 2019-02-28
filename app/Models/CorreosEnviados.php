<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorreosEnviados extends Model
{
   use SoftDeletes;

    protected $dates        = ['deleted_at'];
    protected $table 			  = 'correosEnviados';
    protected $primaryKey 	= 'idCorreos';
    protected $fillable 		= [
        'idCorreos', 'mensaje', 'fechaServicio' , 'cantHoras' , 'cantPernocta', 'cantCorreos', 'totalMonto', 'bono_finSemana', 'ODC', 'realizado_por', 'registrado_por', 'created_at', 'tabulador_id', 'usuario_id'
    ];

    /**
     *
     * Relaciones de la tabla
     *
     */
    public function r_realizado()
    {
        return $this->belongsTo(User::class, 'realizado_por', 'id');
    }

    public function r_registrado()
    {
        return $this->belongsTo(User::class, 'registrado_por', 'id');
    }

    public function r_recorridos()
    {
        return $this->hasMany(Recorridos::class, 'correo_id', 'idCorreos');
    }

    public function r_correos_facturas()
    {
        return $this->hasMany(Correo_Factura::class, 'correo_id', 'idCorreos');
    }

    public function r_tabulador()
    {
        return $this->belongsTo(Tabulador::class, 'tabulador_id', 'id');
    }

    public function r_usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
    /**
     *
     * Method Static of CorreosEviados Method
     *
     */
    public static function datosCorreo($option)
    {
        switch ($option) {
          case 'todos':
            $correos = CorreosEnviados::select('*')
                ->orderBy('created_at', 'DESC');
              break;
          case 'pendientes':
            $correos = CorreosEnviados::select('*')
                ->orderBy('created_at', 'DESC')
                ->where([['facturado', "NO"], ['ODC', 'NO']]);
              break;
            case 'ODC':
                $correos = CorreosEnviados::select('*')
                    ->orderBy('created_at', 'DESC')
                    ->where([['ODC', "SI"], ['facturado', 'NO']])
                    ->whereNull('ODC_number');
                break;
          case 'facturados':
            $correos = CorreosEnviados::select('*')
                ->orderBy('created_at', 'DESC')
                ->where('facturado', "SI");
              break;
          case 'por_facturar':
             $correos = CorreosEnviados::select('*')
                ->orderBy('created_at', 'DESC')
                ->where('facturado', "NO")
                ->whereNotNull('ODC_number');
                break;

          default:
            $correos = CorreosEnviados::where('idCorreos', $option);
            break;
        }

        if (!$correos->count()) {
            return null;
        }
        $temp = $correos->sum('totalMonto');
        $correos = $correos->paginate(25);

        foreach ($correos as $key => $correo) {

            $correo->r_realizado;
            $correo->r_registrado;
            $correo->r_recorridos;
            $correo->r_usuario;
        }
        $correos[0]->totalGeneral = $temp;
        // return $correos->totalFacturado;
        return $correos;
    }
}

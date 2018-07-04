<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TabuladorCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'por_bono_nocturno' => 'required|numeric|between:5,90',
          'por_encomienda'    => 'required|numeric|between:5,90',
          'monto_pernocta'    => 'required|numeric',
          'monto_horas'       => 'required|numeric',
          'por_fin_semana'    => 'required|numeric|between:5,90'
        ];
    }

    public function messages()
    {
      return [
        'por_bono_nocturno.required'  => 'Se requiere el campo del bono nocturno',
        'por_bono_nocturno.between'   => 'El campo de bono debe estar entre :min y :max porciento',
        'por_bono_nocturno.numeric'   => 'El campo debe contener solo numeros validos',

        'por_encomienda.required'  => 'Se requiere el campo de la encomienda',
        'por_encomienda.between'   => 'El campo de la encomienda debe estar entre :min y :max porciento',
        'por_encomienda.numeric'   => 'El campo de la encomienda debe contener solo numeros validos',

        'por_fin_semana.required'  => 'Se requiere el campo del bono de fin de semana',
        'por_fin_semana.between'   => 'El campo del bono de fin de semana debe estar entre :min y :max porciento',
        'por_fin_semana.numeric'   => 'El campo del bono de fin de semana debe contener solo numeros validos',

        'monto_pernocta.required'  => 'Se requiere el campo del monto de pernocta',
        'monto_pernocta.numeric'   => 'El campo del monto de pernocta debe contener solo numeros validos',

        'monto_horas.required'  => 'Se requiere el campo del monto de horas de espera',
        'monto_horas.numeric'   => 'El campo del monto de horas de espera debe contener solo numeros validos',
      ];
    }
}

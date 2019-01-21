<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Tabulador::class, function (Faker $faker) {
    return [
        'por_bono_nocturno' => 20,
        'por_encomienda'    => 20,
        'monto_pernocta'    => 70000,
        'monto_horas'       => 20,
        'por_fin_semana'    => 20,
        'monto_desv_inter'  => 17000,
        'monto_desv_exter'  => 22000,
        'fecha_inicio'      => '01-01-2019'
    ];
});

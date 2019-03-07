<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescripcionOdc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('correosEnviados', function (Blueprint $table) {
            $table->string('descripcion')->nullable()->comment('Este es el comentario que se coloca en la factura"el que viene en la ODC"');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('correosEnviados', function (Blueprint $table) {
            //
        });
    }
}

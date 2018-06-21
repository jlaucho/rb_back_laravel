<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabuladorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabuladors', function (Blueprint $table) {
            $table->increments('id');
            $table->float('por_bono_nocturno', 4, 2);
            $table->float('por_encomienda', 4, 2);
            $table->float('monto_pernocta', 11, 2);
            $table->float('monto_horas', 11, 2);
            $table->float('por_fin_semana', 4, 2);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabuladors');
    }
}

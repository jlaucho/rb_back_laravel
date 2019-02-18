<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTabuladorIdToCorreos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('correosEnviados', function (Blueprint $table) {
            $table->integer('tabulador_id')->unsigned()->nullable();
            $table->foreign('tabulador_id')->references('id')->on('tabuladors')
                ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('tabuladors', function (Blueprint $table) {
            $table->float('precio_USD', 8,2)->nullable();
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

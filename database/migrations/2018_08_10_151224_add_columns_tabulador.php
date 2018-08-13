<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsTabulador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabuladors', function (Blueprint $table) {
            $table->float('monto_desv_inter', 12, 2)->nullable();
            $table->float('monto_desv_exter', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tabuladors', function (Blueprint $table) {
            //
        });
    }
}

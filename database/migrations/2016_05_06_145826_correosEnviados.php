<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorreosEnviados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correosEnviados', function (Blueprint $table) {
            $table->increments('idCorreos');
            $table->string('mensaje')->comment('Aca se guarda el mensaje de cabecera que se envia en los correos');
            $table->date('fechaServicio');
            $table->integer('cantHoras');
            $table->integer('cantPernocta');
            $table->integer('cantCorreos')->comment('cantidad de correos con el mismo monto')->default(1);
            $table->enum('facturado', ['NO', 'SI'])->default('NO')->comment('Aca es donde se guara si el servicio se encuentra facturado');
            $table->float('totalMonto', 11, 2)->nullable()->comment('Monto a cobrar por el servicio realizado');
            $table->float('monto_bonoFinSemana', 11, 2)->nullable();
            $table->float('monto_encomienda', 11, 2)->nullable()->comment('Este bono se calcula sumando todos los recorridos que contemplan esta opcion en "SI"');
            $table->float('monto_nocturno', 11, 2)->nullable()->comment('Este bono se calcula sumando todos los recorridos que contemplan esta opcion en "SI"');
            $table->float('monto_horas', 11, 2)->nullable()->comment('este es el calculo realizado con la multiplicacion de cantHoras por el monto del tabulador vigente');
            $table->float('monto_pernocta', 11, 2)->nullable()->comment('este es el calculo realizado con la multiplicacion de cantPernocta por el monto del tabulador vigente');
            $table->enum('bono_finSemana', ['SI', 'NO'])->default('NO');
            $table->enum('ODC', ['SI','NO'])->default('SI');
            $table->string('ODC_number', 15)->nullable();

            $table->integer('realizado_por')->unsigned()->comment('Guarda el conductor que realizo el servicio');
            $table->foreign('realizado_por')->references('id')->on('users')->onDelete('cascade');

            $table->integer('registrado_por')->unsigned()->comment('Guarda el usuario que registro el servicio en el sistema');
            $table->foreign('registrado_por')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('correosEnviados');
    }
}

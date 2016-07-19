<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlNutricionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_nutricional', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->text('detalles')->nullable(); //Ej: {"estatura":'1.2',"peso":"26","medidas":[{brazo:23}]}
            $table->text('alergias');
            $table->text('observacion');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->softDeletes();
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
        Schema::drop('control_nutricional');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre');
            $table->text('fabricante');
            $table->float('precio1',6,3);
            $table->float('precio2',6,3);
            $table->float('precio3',6,3);
            $table->text('descripcion');
            $table->date('fecha_venc');
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
        Schema::drop('productos_servicios');
    }
}

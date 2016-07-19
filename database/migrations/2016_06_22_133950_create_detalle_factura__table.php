<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('factura_id')->unsigned();
            $table->integer('productoservicio_id')->unsigned();
            $table->date('fecha_ini');
            $table->date('fecha_cul');
            $table->softDeletes();
            
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->foreign('productoservicio_id')->references('id')->on('productos_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('factura_detalles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('municipio_inicio_id');
            $table->string('ubicacion_inicial');
            $table->unsignedBigInteger('municipio_final_id');
            $table->string('ubicacion_final');
            $table->integer('horas_laboral_dia');
            $table->integer('temperatura');
            $table->boolean('estado')->default(true);
            $table->enum('propietario_dobletroque',['propio','alquilado','mixto']);
            $table->integer('duracion_dias');
            $table->integer('cantidad_vehiculo_propio')->default(0);
            $table->integer ('cantidad_vehiculo_alquilado')->default(0);
            $table->double('valor_metrocubico_propio','12,2')->default(0);
            $table->double('valor_metrocubico_alquilado','12,2')->default(0);
            $table->double('valor_contrato','12.2')->default(0);
            $table->double('valor_anticipo_contrato','12,2')->default(0);

            $table->integer('antiguedad_vehiculos_anios');
            $table->text('otro_requerimientos')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('municipio_inicio_id')->references('id')->on('municipios');
            $table->foreign('municipio_final_id')->references('id')->on('municipios');
            $table->foreign('user_id')->references('id')->on('users');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}

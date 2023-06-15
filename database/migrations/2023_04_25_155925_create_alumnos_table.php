<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('clave_alumno')->unique();
            $table->string('clave_larga')->unique();
            $table->string('cambio_carera');
            $table->string('nombre');
            $table->string('sexo');
            $table->integer('generacion');
            $table->string('tutor');
            $table->date('fecha_egreso')->nullable();
            $table->date('fecha_pasante')->nullable();
            $table->date('fecha_titulacion')->nullable();
            $table->string('situacion')->nullable();
            $table->string('opcion_titulacion')->nullable();
            $table->string('testimonio_egel')->nullable();
            $table->integer('materias_reprobadas');
            $table->integer('dias_titulo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};

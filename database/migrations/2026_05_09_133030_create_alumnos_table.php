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
            $table->string('carnet')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('carrera', [
                'Ingeniería en Sistemas',
                'Ingeniería Civil',
                'Administración de Empresas',
                'Medicina',
                'Derecho',
            ]);
            $table->integer('semestre')->default(1);
            $table->enum('estado', [
                'activo',
                'inactivo',
                'graduado',
                'suspendido',
            ])->default('activo');
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

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
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascotas_id')
            ->constrained('mascotas')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->String('nombre_vacuna');
            $table->String('lote');
            $table->date('fecha_aplicacion'); // Campo para la fecha de aplicación
            $table->date('fecha_proxima_dosis'); // Campo para la fecha de próxima dosis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};

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
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clientes_id')
            ->constrained('clientes')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->string('documento');
            $table->string('nombre');
            $table->foreignId('razas_id')
            ->constrained('razas')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->string('tipo');
            $table->string('sexo');
            $table->integer('edad');
            $table->string('image_path')->nullable(); // Cambiar de 'imagen' a 'image_path'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mascotas');
    }
};

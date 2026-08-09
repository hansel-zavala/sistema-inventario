<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insumos_herramientas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('cantidad_disponible')->default(0);
            $table->integer('cantidad_minima')->default(1);
            $table->string('unidad_medida', 20)->default('unidad');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insumos_herramientas');
    }
};
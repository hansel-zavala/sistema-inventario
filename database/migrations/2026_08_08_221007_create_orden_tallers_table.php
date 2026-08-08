<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordenes_taller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->restrictOnDelete();
            $table->string('motivo', 255);
            $table->enum('estado', ['en_espera', 'en_reparacion', 'finalizado'])->default('en_espera');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('observaciones')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordenes_taller');
    }
};
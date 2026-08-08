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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->cascadeOnDelete();
            $table->foreignId('ubicacion_anterior_id')->nullable()->constrained('ubicaciones')->nullOnDelete();
            $table->foreignId('ubicacion_nueva_id')->nullable()->constrained('ubicaciones')->nullOnDelete();
            $table->foreignId('empleado_anterior_id')->nullable()->constrained('empleados')->nullOnDelete();
            $table->foreignId('empleado_nuevo_id')->nullable()->constrained('empleados')->nullOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->string('comentario', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
    
};

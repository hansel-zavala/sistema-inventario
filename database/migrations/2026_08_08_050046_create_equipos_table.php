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
    Schema::create('equipos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre', 100);
        $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnUpdate()->restrictOnDelete();
        $table->foreignId('ubicacion_id')->constrained('ubicaciones')->cascadeOnUpdate()->restrictOnDelete();
        $table->foreignId('empleado_id')->nullable()->constrained('empleados')->cascadeOnUpdate()->nullOnDelete();
        $table->string('marca', 60)->nullable();
        $table->string('modelo', 60)->nullable();
        $table->string('numero_serie', 100)->nullable()->unique();
        $table->date('fecha_adquisicion')->nullable();
        $table->enum('estado', ['activo', 'en_reparacion', 'de_baja'])->default('activo');
        $table->text('observaciones')->nullable();
        $table->foreignId('deleted_by')->nullable()->constrained('users')->nullOnDelete();
        $table->softDeletes();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};

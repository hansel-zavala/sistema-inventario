<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'nombre',
        'cargo',
        'departamento',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }
}
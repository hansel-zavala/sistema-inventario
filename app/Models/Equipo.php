<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'ubicacion_id',
        'empleado_id',
        'marca',
        'modelo',
        'numero_serie',
        'fecha_adquisicion',
        'estado',
        'observaciones',
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date',
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}
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
        'deleted_by',
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

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function eliminadoPor()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function ordenesTaller()
    {
        return $this->hasMany(OrdenTaller::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenTaller extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ordenes_taller';

    protected $fillable = [
        'equipo_id',
        'motivo',
        'estado',
        'fecha_ingreso',
        'fecha_salida',
        'usuario_id',
        'observaciones',
        'deleted_by',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_salida' => 'date',
    ];

    // Relaciones
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function eliminadoPor()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsumoHerramienta extends Model
{
    use HasFactory;

    protected $table = 'insumos_herramientas';

    protected $fillable = [
        'nombre',
        'categoria_id',
        'ubicacion_id',
        'cantidad_disponible',
        'cantidad_minima',
        'unidad_medida',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class);
    }

    public function movimientos()
    {
        return $this->hasMany(MovimientoInsumo::class, 'insumo_id');
    }
}
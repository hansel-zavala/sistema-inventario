<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInsumo extends Model
{
    use HasFactory;

    protected $table = 'movimientos_insumos';

    const UPDATED_AT = null;

    protected $fillable = [
        'insumo_id',
        'tipo',
        'cantidad',
        'motivo',
        'usuario_id',
    ];

    public function insumo()
    {
        return $this->belongsTo(InsumoHerramienta::class, 'insumo_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
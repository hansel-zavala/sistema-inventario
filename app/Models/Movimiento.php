<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movimiento extends Model
{
    use HasFactory;

    protected $table = 'movimientos';

    const UPDATED_AT = null;

    protected $fillable = [
        'equipo_id',
        'ubicacion_anterior_id',
        'ubicacion_nueva_id',
        'empleado_anterior_id',
        'empleado_nuevo_id',
        'usuario_id',
        'comentario',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function ubicacionAnterior()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_anterior_id');
    }

    public function ubicacionNueva()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_nueva_id');
    }

    public function empleadoAnterior()
    {
        return $this->belongsTo(Empleado::class, 'empleado_anterior_id');
    }

    public function empleadoNuevo()
    {
        return $this->belongsTo(Empleado::class, 'empleado_nuevo_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    
}

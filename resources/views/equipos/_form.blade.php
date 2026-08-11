<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre ?? '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Categoría</label>
        <select name="categoria_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">Selecciona...</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ old('categoria_id', $equipo->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        @error('categoria_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Ubicación</label>
        <select name="ubicacion_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">Selecciona...</option>
            @foreach ($ubicaciones as $ubicacion)
                <option value="{{ $ubicacion->id }}"
                    {{ old('ubicacion_id', $equipo->ubicacion_id ?? '') == $ubicacion->id ? 'selected' : '' }}>
                    {{ $ubicacion->nombre }}
                </option>
            @endforeach
        </select>
        @error('ubicacion_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Responsable (opcional)</label>
        <select name="empleado_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">Sin asignar</option>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}"
                    {{ old('empleado_id', $equipo->empleado_id ?? '') == $empleado->id ? 'selected' : '' }}>
                    {{ $empleado->nombre }}
                </option>
            @endforeach
        </select>
        @error('empleado_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    @if (isset($equipo))
        <div>
            <label class="block text-sm font-medium text-gray-700">Estado</label>
            <select name="estado" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                <option value="activo" {{ old('estado', $equipo->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="en_reparacion" {{ old('estado', $equipo->estado) === 'en_reparacion' ? 'selected' : '' }}>En reparación</option>
                <option value="de_baja" {{ old('estado', $equipo->estado) === 'de_baja' ? 'selected' : '' }}>De baja</option>
            </select>
            @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Marca</label>
        <input type="text" name="marca" value="{{ old('marca', $equipo->marca ?? '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('marca') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Modelo</label>
        <input type="text" name="modelo" value="{{ old('modelo', $equipo->modelo ?? '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('modelo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Número de serie</label>
        <input type="text" name="numero_serie" value="{{ old('numero_serie', $equipo->numero_serie ?? '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('numero_serie') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Fecha de adquisición</label>
        <input type="date" name="fecha_adquisicion" value="{{ old('fecha_adquisicion', isset($equipo->fecha_adquisicion) ? $equipo->fecha_adquisicion->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('fecha_adquisicion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700">Observaciones</label>
        <textarea name="observaciones" rows="3"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('observaciones', $equipo->observaciones ?? '') }}</textarea>
        @error('observaciones') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>
    @if (isset($equipo))
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">
                Comentario del cambio (opcional, solo si cambias ubicación o responsable)
            </label>
            <input type="text" name="comentario_movimiento" value="{{ old('comentario_movimiento') }}"
                   placeholder="Ej. Traslado por reorganización de oficina"
                   class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        </div>
    @endif
</div>
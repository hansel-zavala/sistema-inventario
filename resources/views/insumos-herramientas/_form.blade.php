<div>
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $insumo->nombre ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Categoría</label>
    <select name="categoria_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        <option value="">Selecciona...</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}"
                {{ old('categoria_id', $insumo->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
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
                {{ old('ubicacion_id', $insumo->ubicacion_id ?? '') == $ubicacion->id ? 'selected' : '' }}>
                {{ $ubicacion->nombre }}
            </option>
        @endforeach
    </select>
    @error('ubicacion_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

@if ($modoCreacion)
    <div>
        <label class="block text-sm font-medium text-gray-700">Cantidad inicial disponible</label>
        <input type="number" name="cantidad_disponible" min="0" value="{{ old('cantidad_disponible', 0) }}"
               class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        @error('cantidad_disponible') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-500 mt-1">Después de crearlo, los cambios de cantidad se hacen desde el botón "Stock" en el listado.</p>
    </div>
@endif

<div>
    <label class="block text-sm font-medium text-gray-700">Cantidad mínima (para alertas de reposición)</label>
    <input type="number" name="cantidad_minima" min="0" value="{{ old('cantidad_minima', $insumo->cantidad_minima ?? 1) }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('cantidad_minima') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Unidad de medida</label>
    <input type="text" name="unidad_medida" value="{{ old('unidad_medida', $insumo->unidad_medida ?? 'unidad') }}"
           placeholder="unidad, caja, metro..."
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('unidad_medida') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>
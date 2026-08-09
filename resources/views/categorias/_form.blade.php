<div>
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Código</label>
    <input type="text" name="codigo" value="{{ old('codigo', $categoria->codigo ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('codigo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Tipo</label>
    <select name="tipo" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        <option value="">Selecciona...</option>
        <option value="equipo" {{ old('tipo', $categoria->tipo ?? '') === 'equipo' ? 'selected' : '' }}>Equipo</option>
        <option value="insumo" {{ old('tipo', $categoria->tipo ?? '') === 'insumo' ? 'selected' : '' }}>Insumo</option>
    </select>
    @error('tipo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Descripción</label>
    <textarea name="descripcion" rows="3"
              class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>
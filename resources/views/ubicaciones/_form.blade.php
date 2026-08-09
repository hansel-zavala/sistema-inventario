<div>
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $ubicacion->nombre ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Descripción</label>
    <textarea name="descripcion" rows="3"
              class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('descripcion', $ubicacion->descripcion ?? '') }}</textarea>
    @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>
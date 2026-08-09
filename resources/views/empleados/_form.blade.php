<div>
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('nombre') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Cargo</label>
    <input type="text" name="cargo" value="{{ old('cargo', $empleado->cargo ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('cargo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Departamento</label>
    <input type="text" name="departamento" value="{{ old('departamento', $empleado->departamento ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('departamento') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>
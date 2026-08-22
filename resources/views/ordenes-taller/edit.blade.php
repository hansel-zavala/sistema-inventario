<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar orden de taller — {{ $orden->equipo->nombre ?? 'Equipo eliminado' }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow rounded p-6">
        <form action="{{ route('ordenes-taller.update', $orden) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Motivo</label>
                <input type="text" name="motivo" value="{{ old('motivo', $orden->motivo) }}"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                @error('motivo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="estado" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    <option value="en_espera" {{ old('estado', $orden->estado) === 'en_espera' ? 'selected' : '' }}>En espera</option>
                    <option value="en_reparacion" {{ old('estado', $orden->estado) === 'en_reparacion' ? 'selected' : '' }}>En reparación</option>
                    <option value="finalizado" {{ old('estado', $orden->estado) === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
                </select>
                @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Fecha de salida <span class="text-gray-400 text-xs">(se autocompleta si finalizas y la dejas vacía)</span>
                </label>
                <input type="date" name="fecha_salida" value="{{ old('fecha_salida', $orden->fecha_salida?->format('Y-m-d')) }}"
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                @error('fecha_salida') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                <textarea name="observaciones" rows="3"
                          class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('observaciones', $orden->observaciones) }}</textarea>
                @error('observaciones') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('ordenes-taller.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
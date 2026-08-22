<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva orden de taller
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow rounded p-6">
        @if ($equipos->isEmpty())
            <p class="text-gray-600">No hay equipos disponibles para ingresar al taller (todos están en reparación o de baja).</p>
        @else
            <form action="{{ route('ordenes-taller.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Equipo</label>
                    <select name="equipo_id" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                        <option value="">Selecciona...</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }} @if($equipo->numero_serie) ({{ $equipo->numero_serie }}) @endif
                            </option>
                        @endforeach
                    </select>
                    @error('equipo_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Motivo</label>
                    <input type="text" name="motivo" value="{{ old('motivo') }}"
                           placeholder="Ej. No enciende, instalación de Office..."
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    @error('motivo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de ingreso</label>
                    <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso', now()->format('Y-m-d')) }}"
                           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                    @error('fecha_ingreso') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                    <textarea name="observaciones" rows="3"
                              class="mt-1 block w-full rounded border-gray-300 shadow-sm">{{ old('observaciones') }}</textarea>
                    @error('observaciones') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('ordenes-taller.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Guardar
                    </button>
                </div>
            </form>
        @endif
    </div>
</x-app-layout>
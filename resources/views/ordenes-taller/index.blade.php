<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Taller técnico
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="bg-white shadow rounded p-4 mb-4 flex gap-3">
            <select name="estado" class="rounded border-gray-300 shadow-sm text-sm flex-1">
                <option value="">Todos los estados</option>
                <option value="en_espera" {{ request('estado') === 'en_espera' ? 'selected' : '' }}>En espera</option>
                <option value="en_reparacion" {{ request('estado') === 'en_reparacion' ? 'selected' : '' }}>En reparación</option>
                <option value="finalizado" {{ request('estado') === 'finalizado' ? 'selected' : '' }}>Finalizado</option>
            </select>
            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                Filtrar
            </button>
            <a href="{{ route('ordenes-taller.index') }}" class="text-sm text-gray-600 self-center">Limpiar</a>
        </form>

        <div class="flex justify-end mb-4">
            <a href="{{ route('ordenes-taller.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                + Nueva orden de taller
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Equipo</th>
                        <th class="px-4 py-2">Motivo</th>
                        <th class="px-4 py-2">Ingreso</th>
                        <th class="px-4 py-2">Salida</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Registrado por</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ordenes as $orden)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $orden->equipo->nombre ?? 'Equipo eliminado' }}</td>
                            <td class="px-4 py-2">{{ $orden->motivo }}</td>
                            <td class="px-4 py-2">{{ $orden->fecha_ingreso->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ $orden->fecha_salida?->format('d/m/Y') ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if ($orden->estado === 'en_espera')
                                    <span class="text-gray-700 bg-gray-200 px-2 py-1 rounded text-xs">En espera</span>
                                @elseif ($orden->estado === 'en_reparacion')
                                    <span class="text-yellow-700 bg-yellow-100 px-2 py-1 rounded text-xs">En reparación</span>
                                @else
                                    <span class="text-green-700 bg-green-100 px-2 py-1 rounded text-xs">Finalizado</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $orden->usuario->name ?? '—' }}</td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('ordenes-taller.edit', $orden) }}"
                                   class="text-indigo-600 hover:underline">Editar</a>
                                <form action="{{ route('ordenes-taller.destroy', $orden) }}" method="POST" class="inline"
                                      onsubmit="return confirm('¿Eliminar esta orden de taller?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No hay órdenes de taller registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $ordenes->links() }}
        </div>
    </div>
</x-app-layout>
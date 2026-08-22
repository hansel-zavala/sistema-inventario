<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Insumos y Herramientas
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="bg-white shadow rounded p-4 mb-4 flex gap-3">
            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre..."
                   class="rounded border-gray-300 shadow-sm text-sm flex-1">

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="bajo_stock" value="1" {{ request('bajo_stock') ? 'checked' : '' }}>
                Solo bajo stock
            </label>

            <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                Filtrar
            </button>
            <a href="{{ route('insumos-herramientas.index') }}" class="text-sm text-gray-600 self-center">Limpiar</a>
        </form>

        <div class="flex justify-end mb-4">
            <a href="{{ route('insumos-herramientas.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                + Nuevo insumo/herramienta
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Categoría</th>
                        <th class="px-4 py-2">Ubicación</th>
                        <th class="px-4 py-2">Disponible</th>
                        <th class="px-4 py-2">Mínimo</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($insumos as $insumo)
                        <tr class="border-t {{ $insumo->cantidad_disponible <= $insumo->cantidad_minima ? 'bg-red-50' : '' }}">
                            <td class="px-4 py-2">{{ $insumo->nombre }}</td>
                            <td class="px-4 py-2">{{ $insumo->categoria->nombre ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $insumo->ubicacion->nombre ?? '—' }}</td>
                            <td class="px-4 py-2">
                                {{ $insumo->cantidad_disponible }} {{ $insumo->unidad_medida }}
                                @if ($insumo->cantidad_disponible <= $insumo->cantidad_minima)
                                    <span class="text-red-600 text-xs font-semibold">⚠ Bajo stock</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $insumo->cantidad_minima }}</td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <button type="button"
                                        onclick="document.getElementById('modal-mov-{{ $insumo->id }}').classList.remove('hidden')"
                                        class="text-green-600 hover:underline">
                                    Stock
                                </button>
                                <a href="{{ route('insumos-herramientas.edit', $insumo) }}"
                                   class="text-indigo-600 hover:underline">Editar</a>
                                <form action="{{ route('insumos-herramientas.destroy', $insumo) }}" method="POST" class="inline"
                                      onsubmit="return confirm('¿Desactivar este insumo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Desactivar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal simple para registrar entrada/salida -->
                        <tr id="modal-mov-{{ $insumo->id }}" class="hidden">
                            <td colspan="6" class="bg-gray-50 px-4 py-4">
                                <form action="{{ route('insumos-herramientas.movimiento', $insumo) }}" method="POST"
                                      class="flex flex-wrap items-end gap-3">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700">Tipo</label>
                                        <select name="tipo" class="mt-1 rounded border-gray-300 shadow-sm text-sm">
                                            <option value="entrada">Entrada (compra/reposición)</option>
                                            <option value="salida">Salida (uso en taller)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-700">Cantidad</label>
                                        <input type="number" name="cantidad" min="1" required
                                               class="mt-1 rounded border-gray-300 shadow-sm text-sm w-24">
                                    </div>
                                    <div class="flex-1 min-w-[200px]">
                                        <label class="block text-xs font-medium text-gray-700">Motivo (opcional)</label>
                                        <input type="text" name="motivo"
                                               class="mt-1 rounded border-gray-300 shadow-sm text-sm w-full">
                                    </div>
                                    <button type="submit" class="bg-indigo-600 text-white px-3 py-2 rounded text-sm hover:bg-indigo-700">
                                        Registrar
                                    </button>
                                    <button type="button"
                                            onclick="document.getElementById('modal-mov-{{ $insumo->id }}').classList.add('hidden')"
                                            class="text-gray-500 text-sm">
                                        Cancelar
                                    </button>
                                </form>
                                @error('cantidad') <p class="text-red-600 text-sm mt-2">{{ $message }}</p> @enderror
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                No hay insumos o herramientas registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $insumos->links() }}
        </div>
    </div>
</x-app-layout>
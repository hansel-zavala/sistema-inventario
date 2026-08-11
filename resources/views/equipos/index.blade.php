<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Equipos
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtros -->
        <form method="GET" class="bg-white shadow rounded p-4 mb-4 grid grid-cols-1 md:grid-cols-5 gap-3">
            <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar por nombre, serie, marca..."
                   class="rounded border-gray-300 shadow-sm text-sm md:col-span-2">

            <select name="categoria_id" class="rounded border-gray-300 shadow-sm text-sm">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>

            <select name="ubicacion_id" class="rounded border-gray-300 shadow-sm text-sm">
                <option value="">Todas las ubicaciones</option>
                @foreach ($ubicaciones as $ubicacion)
                    <option value="{{ $ubicacion->id }}" {{ request('ubicacion_id') == $ubicacion->id ? 'selected' : '' }}>
                        {{ $ubicacion->nombre }}
                    </option>
                @endforeach
            </select>

            <select name="estado" class="rounded border-gray-300 shadow-sm text-sm">
                <option value="">Todos los estados</option>
                <option value="activo" {{ request('estado') === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="en_reparacion" {{ request('estado') === 'en_reparacion' ? 'selected' : '' }}>En reparación</option>
                <option value="de_baja" {{ request('estado') === 'de_baja' ? 'selected' : '' }}>De baja</option>
            </select>

            <div class="md:col-span-5 flex justify-end gap-2">
                <a href="{{ route('equipos.index') }}" class="text-sm text-gray-600 self-center">Limpiar filtros</a>
                <button type="submit" class="bg-gray-700 text-white px-4 py-2 rounded text-sm hover:bg-gray-800">
                    Filtrar
                </button>
            </div>
        </form>

        <div class="flex justify-end mb-4">
            <a href="{{ route('equipos.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                + Nuevo equipo
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Categoría</th>
                        <th class="px-4 py-2">Ubicación</th>
                        <th class="px-4 py-2">Responsable</th>
                        <th class="px-4 py-2">N° Serie</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipos as $equipo)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $equipo->nombre }}</td>
                            <td class="px-4 py-2">{{ $equipo->categoria->nombre ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $equipo->ubicacion->nombre ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $equipo->empleado->nombre ?? 'Sin asignar' }}</td>
                            <td class="px-4 py-2">{{ $equipo->numero_serie ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if ($equipo->estado === 'activo')
                                    <span class="text-green-700 bg-green-100 px-2 py-1 rounded text-xs">Activo</span>
                                @elseif ($equipo->estado === 'en_reparacion')
                                    <span class="text-yellow-700 bg-yellow-100 px-2 py-1 rounded text-xs">En reparación</span>
                                @else
                                    <span class="text-gray-600 bg-gray-200 px-2 py-1 rounded text-xs">De baja</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('equipos.edit', $equipo) }}"
                                   class="text-indigo-600 hover:underline">Editar</a>

                                <form action="{{ route('equipos.destroy', $equipo) }}" method="POST" class="inline"
                                      onsubmit="return confirm('¿Eliminar este equipo? Podrás recuperarlo luego desde la papelera.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                No se encontraron equipos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $equipos->links() }}
        </div>
    </div>
</x-app-layout>
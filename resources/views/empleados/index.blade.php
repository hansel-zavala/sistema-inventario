<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Empleados
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('empleados.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                + Nuevo empleado
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Cargo</th>
                        <th class="px-4 py-2">Departamento</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($empleados as $empleado)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $empleado->nombre }}</td>
                            <td class="px-4 py-2">{{ $empleado->cargo ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $empleado->departamento ?? '—' }}</td>
                            <td class="px-4 py-2">
                                @if ($empleado->activo)
                                    <span class="text-green-700 bg-green-100 px-2 py-1 rounded text-xs">Activo</span>
                                @else
                                    <span class="text-gray-500 bg-gray-100 px-2 py-1 rounded text-xs">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('empleados.edit', $empleado) }}"
                                   class="text-indigo-600 hover:underline">Editar</a>

                                @if ($empleado->activo)
                                    <form action="{{ route('empleados.destroy', $empleado) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Desactivar este empleado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Desactivar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No hay empleados registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $empleados->links() }}
        </div>
    </div>
</x-app-layout>
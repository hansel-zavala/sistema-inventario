<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorías
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('categorias.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded text-sm hover:bg-indigo-700">
                + Nueva categoría
            </a>
        </div>

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left">
                    <tr>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Tipo</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $categoria->nombre }}</td>
                            <td class="px-4 py-2">{{ $categoria->codigo }}</td>
                            <td class="px-4 py-2">
                                {{ $categoria->tipo === 'equipo' ? 'Equipo' : 'Insumo' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($categoria->activo)
                                    <span class="text-green-700 bg-green-100 px-2 py-1 rounded text-xs">Activo</span>
                                @else
                                    <span class="text-gray-500 bg-gray-100 px-2 py-1 rounded text-xs">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                   class="text-indigo-600 hover:underline">Editar</a>

                                @if ($categoria->activo)
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Desactivar esta categoría?')">
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
                                No hay categorías registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $categorias->links() }}
        </div>
    </div>
</x-app-layout>

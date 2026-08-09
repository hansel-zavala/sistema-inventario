<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar categoría
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow rounded p-6">
        <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            @include('categorias._form')

            <div class="flex justify-end">
                <a href="{{ route('categorias.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

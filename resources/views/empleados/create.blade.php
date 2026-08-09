<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo empleado
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow rounded p-6">
        <form action="{{ route('empleados.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('empleados._form')

            <div class="flex justify-end">
                <a href="{{ route('empleados.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
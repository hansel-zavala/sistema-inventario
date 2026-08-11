<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo equipo
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
        <form action="{{ route('equipos.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('equipos._form')

            <div class="flex justify-end">
                <a href="{{ route('equipos.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
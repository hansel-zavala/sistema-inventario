<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nuevo usuario</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white shadow rounded p-6">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('users._form')

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
                @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('users.index') }}" class="text-gray-600 mr-4 self-center">Cancelar</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
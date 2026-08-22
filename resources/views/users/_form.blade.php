<div>
    <label class="block text-sm font-medium text-gray-700">Nombre</label>
    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Correo electrónico</label>
    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="mt-1 block w-full rounded border-gray-300 shadow-sm">
    @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700">Rol</label>
    <select name="role" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
        <option value="administrador" {{ old('role', $user->role ?? '') === 'administrador' ? 'selected' : '' }}>Administrador</option>
        <option value="tecnico" {{ old('role', $user->role ?? '') === 'tecnico' ? 'selected' : '' }}>Técnico</option>
    </select>
    @error('role') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>
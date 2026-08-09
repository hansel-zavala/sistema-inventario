<aside class="w-64 min-h-screen bg-gray-800 text-gray-200 flex-shrink-0">
    <div class="px-4 py-5 text-lg font-semibold border-b border-gray-700">
        Inventario TI
    </div>

    <nav class="mt-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
            Dashboard
        </a>

        @if (Route::has('equipos.index'))
            <a href="{{ route('equipos.index') }}"
               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('equipos.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
                 Equipos
            </a>
        @endif

        <a href="{{ route('categorias.index') }}"
           class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('categorias.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
            Categorías
        </a>

        @if (Route::has('ubicaciones.index'))
            <a href="{{ route('ubicaciones.index') }}"
               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('ubicaciones.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
                 Ubicaciones
            </a>
        @endif

        @if (Route::has('empleados.index'))
            <a href="{{ route('empleados.index') }}"
               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('empleados.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
                 Empleados
            </a>
        @endif

        @if (Route::has('insumos-herramientas.index'))
            <a href="{{ route('insumos-herramientas.index') }}"
               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('insumos-herramientas.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
                 Insumos y Herramientas
            </a>
        @endif

        @if (Route::has('ordenes-taller.index'))
            <a href="{{ route('ordenes-taller.index') }}"
               class="flex items-center px-4 py-2 text-sm {{ request()->routeIs('ordenes-taller.*') ? 'bg-gray-900 text-white' : 'hover:bg-gray-700' }}">
                 Taller
            </a>
        @endif

        @if (auth()->user()->role === 'administrador')
            <div class="mt-4 pt-4 border-t border-gray-700 px-4 text-xs uppercase text-gray-400">
                Administración
            </div>

            <a href="#"
               class="flex items-center px-4 py-2 text-sm hover:bg-gray-700">
                Usuarios
            </a>

            <a href="#"
               class="flex items-center px-4 py-2 text-sm hover:bg-gray-700">
                Papelera
            </a>
        @endif
    </nav>
</aside>

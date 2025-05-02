@extends('layouts.app')
@section('content')
<!-- Pruebas para el toast-->
@if (session('success'))
    <div id="toast-success" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div id="toast-error" class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg z-[9999] transition-opacity duration-300">
        <i class="fas fa-times-circle mr-2"></i> {{ session('error') }}
    </div>
@endif
<script>
    setTimeout(() => {
        document.getElementById('toast-success')?.classList.add('opacity-0');
        document.getElementById('toast-error')?.classList.add('opacity-0');
    }, 3000); // Se oculta en 3 segundos
</script>
<!-- tabla para mostrar mi información de usuario -->
<div class="overflow-x-auto mt-10 px-6">
    <h2 class="text-3xl font-bold mb-6 text-green-700">Mi Perfil</h2>

    <table class="min-w-full bg-white border border-gray-300 rounded shadow text-left">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="py-3 px-6">Nombre</th>
                <th class="py-3 px-6">Correo</th>
                <th class="py-3 px-6">Rol</th>
                <th class="py-3 px-6 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="py-3 px-6">{{ $user->nombre }}</td>
                <td class="py-3 px-6">{{ $user->email }}</td>
                <td class="py-3 px-6">{{ $user->rol->nombre ?? 'Sin Rol' }}</td>
                <td class="py-3 px-6 text-center space-x-2">
                    <button onclick="openEditModal()" class="text-blue-600 hover:text-blue-800 text-xl">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button onclick="openDeleteModal()" class="text-red-600 hover:text-red-800 text-xl">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal Editar -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-20 flex justify-center items-center z-50 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h3 class="text-lg font-bold mb-4 text-center">Editar Perfil</h3>
        <form id="editForm" method="POST" action="{{ route('usuarios.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nombre</label>
                <input type="text" name="nombre" value="{{ $user->nombre }}" class="border p-2 rounded w-full" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Correo</label>
                <input type="email" name="email" value="{{ $user->email }}" class="border p-2 rounded w-full" required>
            </div>

            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-20 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm">
        <h3 class="text-lg font-bold mb-4 text-center text-red-600">¿Eliminar Perfil?</h3>
        <p class="text-center mb-6 text-gray-600">Esta acción no se puede deshacer.</p>

        <div class="flex justify-center space-x-4 mt-6">
            <button type="button" onclick="closeDeleteModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </button>

            <form id="deleteForm" method="POST" action="{{ route('usuarios.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                    Eliminar
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection

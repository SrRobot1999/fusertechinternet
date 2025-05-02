<!-- resources/views/modals/modal-edit.blade.php -->
<div id="modalEdit" class="modal hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Editar</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div id="modalContent">
                <!-- Aquí se inyectará contenido dinámico -->
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2" onclick="closeModal()">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal()">&times;</button>
    </div>
</div>
<script>
    function openModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
<div id="modalDelete" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/3 transition-transform transform scale-95">
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Confirmar Eliminación</h2>
        </div>
        <div class="px-6 py-4">
            <p class="text-gray-600">¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer.</p>
        </div>
        <div class="px-6 py-4 flex justify-end space-x-4">
            <button id="cancel-button" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Cancelar</button>
            <button id="confirm-button" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Eliminar</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modalDelete');
        const cancelButton = document.getElementById('cancel-button');
        const confirmButton = document.getElementById('confirm-button');

        // Function to open the modal
        window.openDeleteModal = (onConfirm) => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            confirmButton.onclick = () => {
                onConfirm();
                closeModal();
            };
        };

        // Function to close the modal
        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        cancelButton.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    });
</script>

<style>
    #modal-delete {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    #modal-delete.flex {
        opacity: 1;
        transform: scale(1);
    }
    #modal-delete.hidden {
        opacity: 0;
        transform: scale(0.95);
    }
</style>
<div id="modalCreate" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dynamicModalTitle">Crear Nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dynamicModalBody">
                <!-- Dynamic content will be injected here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="dynamicModalSave">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openDynamicModal(title, bodyContent, saveCallback) {
        // Set modal title
        document.getElementById('dynamicModalTitle').innerText = title;

        // Set modal body content
        document.getElementById('dynamicModalBody').innerHTML = bodyContent;

        // Set save button callback
        const saveButton = document.getElementById('dynamicModalSave');
        saveButton.onclick = function () {
            if (typeof saveCallback === 'function') {
                saveCallback();
            }
            $('#modalCreate').modal('hide');
        };

        // Show the modal with a fade-in transition
        $('#modalCreate').modal('show');
    }

    function closeDynamicModal() {
        // Hide the modal with a fade-out transition
        $('#modalCreate').modal('hide');
    }
</script>
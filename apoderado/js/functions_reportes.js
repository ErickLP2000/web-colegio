document.addEventListener('DOMContentLoaded', function() {
    let apoderadoElement = document.getElementById('apoderadoInfo');
    console.log("Apoderado Element:", apoderadoElement); // Verifica que el elemento existe

    if (apoderadoElement) {
        let apoderadoId = apoderadoElement.getAttribute('data-apoderado-id');
        console.log("Apoderado ID:", apoderadoId); // Verificar el ID del apoderado

        fetch('reportes_bullying.php?apoderado_id=' + apoderadoId)
            .then(response => response.json())
            .then(data => {
                console.log("Alumnos Data:", data); // Verificar la respuesta
                let select = document.getElementById('alumno');
                select.innerHTML = ''; // Limpiar opciones anteriores
                data.forEach(alumno => {
                    let option = document.createElement('option');
                    option.value = alumno.alumno_id;
                    option.textContent = alumno.nombre_alumno;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error("No se encontró el elemento con ID 'apoderadoInfo'");
    }

    document.getElementById('reporteBullyingForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let formData = new FormData(this);
        let submitButton = document.querySelector('#reporteBullyingForm button[type="submit"]');
        submitButton.disabled = true;

        fetch('reportes_bullying.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Crear un modal para el mensaje de confirmación
            let modal = document.createElement('div');
            modal.innerHTML = `
                <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirmación</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>${data}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="modalOkButton">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            // Mostrar el modal
            let confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confirmationModal.show();

            // Recargar la página cuando se hace clic en OK
            document.getElementById('modalOkButton').addEventListener('click', function() {
                confirmationModal.hide();
                window.location.reload();
            });
        })
        .catch(error => {
            console.error('Error:', error);
            submitButton.disabled = false;
        });
    });
});

function eliminarReporte(reporteId) {
    // Crear un modal para la confirmación de eliminación
    let modal = document.createElement('div');
    modal.innerHTML = `
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmación de Eliminación</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro de que desea eliminar este reporte?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(modal);

    // Mostrar el modal
    let deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    deleteConfirmationModal.show();

    // Manejar la confirmación de eliminación
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        deleteConfirmationModal.hide();
        fetch('eliminar_reporte.php?reporte_id=' + reporteId)
            .then(response => response.text())
            .then(data => {
                // Crear un modal para el mensaje de confirmación de eliminación
                let modal = document.createElement('div');
                modal.innerHTML = `
                    <div class="modal fade" id="deleteSuccessModal" tabindex="-1" role="dialog" aria-labelledby="deleteSuccessModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteSuccessModalLabel">Eliminación Exitosa</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>${data}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" id="deleteModalOkButton">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);

                // Mostrar el modal
                let deleteSuccessModal = new bootstrap.Modal(document.getElementById('deleteSuccessModal'));
                deleteSuccessModal.show();

                // Recargar la página cuando se hace clic en OK
                document.getElementById('deleteModalOkButton').addEventListener('click', function() {
                    deleteSuccessModal.hide();
                    window.location.reload();
                });
            })
            .catch(error => console.error('Error:', error));
    });
}

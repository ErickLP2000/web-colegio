document.getElementById('formularioAsistencia').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('guardar_asistencia.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Respuesta del servidor:', data); // Para depuración
        if (data.error) {
            Swal.fire({
                title: 'Error!',
                text: data.error,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        } else if (data.success) {
            Swal.fire({
                title: 'Éxito!',
                text: data.success,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload();
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Ocurrió un error al guardar la asistencia.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

document.getElementById('fechaConsulta').addEventListener('change', function() {
    const fechaConsulta = this.value;

    fetch(`obtener_asistenciasporfecha.php?fecha=${fechaConsulta}`)
        .then(response => response.json())
        .then(data => {
            const tablaAsistencias = document.getElementById('tablaAsistencias');
            tablaAsistencias.innerHTML = '';

            if (data.length > 0) {
                let table = `<table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre del Alumno</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                
                data.forEach(asistencia => {
                    table += `<tr data-id="${asistencia.alumno_id}" data-fecha="${fechaConsulta}" data-nombre="${asistencia.nombre_alumno}">
                                <td>${asistencia.nombre_alumno}</td>
                                <td>${asistencia.estado}</td>
                                <td><button class="btn btn-warning btn-sm" onclick="abrirEditarEstadoModal(this)">Editar Estado</button></td>
                              </tr>`;
                });

                table += `</tbody></table>`;
                tablaAsistencias.innerHTML = table;
            } else {
                tablaAsistencias.innerHTML = '<p>No se encontraron asistencias para esta fecha.</p>';
            }
        })
        .catch(error => console.error('Error:', error));
});

function abrirEditarEstadoModal(button) {
    const row = button.closest('tr');
    const alumno_id = row.getAttribute('data-id');
    const fecha = row.getAttribute('data-fecha');
    const nombre = row.getAttribute('data-nombre');

    document.getElementById('alumno_id').value = alumno_id;
    document.getElementById('fecha').value = fecha;
    document.getElementById('nombreAlumno').value = nombre;
    document.getElementById('estado').value = row.querySelector('td:nth-child(2)').textContent.trim();

    $('#editarEstadoModal').modal('show');
}

document.getElementById('formEditarEstado').addEventListener('submit', function(event) {
    event.preventDefault();

    const alumno_id = document.getElementById('alumno_id').value;
    const fecha = document.getElementById('fecha').value;
    const estado = document.getElementById('estado').value;

    fetch('editar_asistencia.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `alumno_id=${alumno_id}&fecha=${fecha}&estado=${estado}`
    })
    .then(response => response.text())
    .then(data => {
        console.log('Respuesta del servidor:', data); // Para depuración
        Swal.fire({
            title: 'Éxito!',
            text: data,
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            $('#editarEstadoModal').modal('hide');
            document.getElementById('fechaConsulta').dispatchEvent(new Event('change'));
        });
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error!',
            text: 'Ocurrió un error al editar la asistencia.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    });
});

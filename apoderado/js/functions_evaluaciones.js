document.addEventListener('DOMContentLoaded', function() {
    const alumnoSelect = document.getElementById('alumnoSelect');
    const evaluacionesContenedor = document.getElementById('evaluacionesContenedor');
    const formEntrega = document.getElementById('formEntrega');

    alumnoSelect.addEventListener('change', function() {
        const alumno_id = this.value;

        if (alumno_id) {
            fetch(`obtener_evaluaciones.php?alumno_id=${alumno_id}`)
                .then(response => response.json())
                .then(evaluaciones => {
                    evaluacionesContenedor.innerHTML = '';

                    if (evaluaciones.length > 0) {
                        evaluaciones.forEach(evaluacion => {
                            const materialPath = evaluacion.material ? evaluacion.material.replace('../../../', '') : '#';
                            const materialLink = evaluacion.material ? `<a class="btn btn-primary" href="/webcolegiomaincallao/${materialPath}" download>Material de Descarga</a>` : 'No hay material disponible';
                            const entregaStatus = evaluacion.entregado > 0 ? `<span>Entregado</span>` : `<button class="btn btn-success" type="button" onclick="prepararEntrega(${alumno_id}, ${evaluacion.evaluacion_id})">Entregar</button>`;
                            const cardClass = evaluacion.entregado > 0 ? 'card mb-3 entregada' : 'card mb-3';

                            let evaluacionHTML = `
                                <div class="${cardClass}" id="evaluacion_${evaluacion.evaluacion_id}">
                                    <div class="card-body">
                                        <h5 class="card-title">${evaluacion.nombre_evaluacion}</h5>
                                        <p class="card-text">${evaluacion.descripcion}</p>
                                        <p class="card-text"><small class="text-muted">Fecha Límite: ${evaluacion.fecha}</small></p>
                                        <p class="card-text"><small class="text-muted">Contenido: ${evaluacion.nombre_contenido}</small></p>
                                        <p class="card-text"><small class="text-muted">Materia: ${evaluacion.nombre_materia}</small></p>
                                        <p class="card-text"><small class="text-muted">Profesor: ${evaluacion.nombre_profesor}</small></p>
                                        <p class="card-text"><small class="text-muted">${materialLink}</small></p>
                                        <p class="card-text"><small class="text-muted">${entregaStatus}</small></p>
                                    </div>
                                </div>`;
                            
                            evaluacionesContenedor.innerHTML += evaluacionHTML;
                        });
                    } else {
                        evaluacionesContenedor.innerHTML = '<p>No se encontraron evaluaciones para este alumno.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    evaluacionesContenedor.innerHTML = '<p>Ocurrió un error al obtener las evaluaciones.</p>';
                });
        } else {
            evaluacionesContenedor.innerHTML = '<p>Seleccione un alumno para ver las evaluaciones</p>';
        }
    });

    if (formEntrega) {
        formEntrega.onsubmit = function(e) {
            e.preventDefault();

            const formData = new FormData(formEntrega);
            fetch('subir_entrega.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Entrega realizada con éxito',
                        confirmButtonColor: '#00695C',
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.msg,
                        confirmButtonColor: '#00695C',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al realizar la entrega',
                    confirmButtonColor: '#00695C',
                });
            });
        };
    }
});

function prepararEntrega(alumno_id, evaluacion_id) {
    document.getElementById('alumno_id').value = alumno_id;
    document.getElementById('evaluacion_id').value = evaluacion_id;
    
    // Remover la clase 'selected' de todas las evaluaciones
    document.querySelectorAll('.card').forEach(card => card.classList.remove('selected'));
    
    // Añadir la clase 'selected' a la evaluación seleccionada
    document.getElementById(`evaluacion_${evaluacion_id}`).classList.add('selected');
    
    document.getElementById('formEntrega').scrollIntoView();
}

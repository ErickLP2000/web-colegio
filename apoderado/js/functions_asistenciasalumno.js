document.addEventListener('DOMContentLoaded', function() {
    const alumnoSelect = document.getElementById('alumnoSelect');
    const fechaConsulta = document.getElementById('fechaConsulta');
    const infoAsistencia = document.getElementById('infoAsistencia');

    // Consultar asistencia cuando se selecciona un alumno o una fecha
    alumnoSelect.addEventListener('change', consultarAsistencia);
    fechaConsulta.addEventListener('change', consultarAsistencia);

    function consultarAsistencia() {
        const alumno_id = alumnoSelect.value;
        const fecha = fechaConsulta.value;

        if (alumno_id && fecha) {
            fetch(`obtener_asistencias_alumno.php?alumno_id=${alumno_id}&fecha=${fecha}`)
                .then(response => response.json())
                .then(asistencias => {
                    infoAsistencia.innerHTML = '';

                    if (asistencias.length > 0) {
                        asistencias.forEach(asistencia => {
                            let estadoClass;
                            switch (asistencia.estado) {
                                case 'Temprano':
                                case 'Presente':
                                    estadoClass = 'estado-temprano';
                                    break;
                                case 'Llego tarde':
                                    estadoClass = 'estado-llegotarde';
                                    break;
                                case 'Falto':
                                    estadoClass = 'estado-falto';
                                    break;
                                default:
                                    estadoClass = '';
                                    break;
                            }

                            let asistenciaHTML = `
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h4 class="card-title">${asistencia.nombre_alumno}</h4>
                                        <p><strong>Fecha:</strong> ${asistencia.fecha}</p>
                                        <p><strong>Docente:</strong> ${asistencia.nombre_docente}</p>
                                        <h3 class="${estadoClass}">${asistencia.estado}</h3>
                                    </div>
                                </div>`;
                            
                            infoAsistencia.innerHTML += asistenciaHTML;
                        });
                    } else {
                        infoAsistencia.innerHTML = '<p>No se encontraron registros de asistencia para esta fecha.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    infoAsistencia.innerHTML = '<p>Ocurrió un error al obtener la asistencia.</p>';
                });
        } else {
            infoAsistencia.innerHTML = '<p>Seleccione una fecha y un alumno para ver la asistencia</p>';
        }
    }
});

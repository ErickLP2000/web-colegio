document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('selectAlumno').addEventListener('change', function() {
        let alumnoId = this.value;
        if (alumnoId) {
            fetch('obtener_info_alumno.php?alumno_id=' + alumnoId)
                .then(response => response.json())
                .then(data => {
                    let infoAlumno = document.getElementById('infoAlumno');
                    infoAlumno.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>${data.nombre_alumno}</strong></h5>
                                <p class="card-text"><strong>ID:</strong> ${data.alumno_id}</p>
                                <p class="card-text"><strong>Edad:</strong> ${data.edad}</p>
                                <p class="card-text"><strong>Dirección:</strong> ${data.direccion}</p>
                                <p class="card-text"><strong>Documento:</strong> ${data.documento}</p>
                                <p class="card-text"><strong>Fecha de Nacimiento:</strong> ${data.fecha_nac}</p>
                                <p class="card-text"><strong>Fecha de Registro:</strong> ${data.fecha_registro}</p>
                                <p class="card-text"><strong>Estado:</strong> ${data.estado}</p>
                            </div>
                        </div>
                    `;
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('infoAlumno').innerHTML = '<p>Seleccione un hijo para ver la información</p>';
        }
    });
});

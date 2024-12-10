<?php 
require_once 'includes/header.php';
require_once 'includes/modals/modal_alumno.php'
require_once '../includes/conexion.php';
$sql = "SELECT * FROM apoderadosaunnoregistrados";
$query = $pdo->prepare($sql);
$query->execute();
$apoderadosNoRegistrados = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Lista de alumnos</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></li>
          <li class="breadcrumb-item"><a href="#">lista de alumnos</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
          <div class="tile-body">
              <div class="table-responsive">
                <table class="table hover table-bordered" id="tableAlumnos">
                  <thead>
                    <tr>
                      <th >ACCIONES</th>
                      <th>ID</th>
                      <th>NOMBRE</th>
                      <th>EDAD</th>
                      <th>DIRECCION</th>
                      <th>DOCUMENTO</th>
                      <th>APODERADO</th>
                      <th>FECHA NAC.</th>
                      <th>FECHA REGISTRO</th>
                      <th>ESTADO</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
<div>

<button class="btn btn-primary" type="button" onclick="openModalAlumno()" style="margin-top: 20px;">Registrar Nuevo Alumno</button>

</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <h2>Apoderados Aun No Registrados</h2>
                <button class="btn btn-success mb-3" onclick="exportTableToPDF()">Exportar a PDF</button>
                <div class="table-responsive">
                    <table class="table hover table-responsive table-bordered" id="tableApoderadosNoRegistrados">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre Apoderado</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>DNI Apoderado</th>
                                <th>Correo</th>
                                <th>Nombre Estudiante</th>
                                <th>DNI Estudiante</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Grado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($apoderadosNoRegistrados as $apoderado) { ?>
                                <tr>
                                    <td><?= $apoderado['id']; ?></td>
                                    <td><?= $apoderado['nombreapellido_apoderado']; ?></td>
                                    <td><?= $apoderado['direccion_apoderado']; ?></td>
                                    <td><?= $apoderado['telefono_apoderado']; ?></td>
                                    <td><?= $apoderado['dni_apoderado']; ?></td>
                                    <td><?= $apoderado['correo_apoderado']; ?></td>
                                    <td><?= $apoderado['nombreapellido_estudiante']; ?></td>
                                    <td><?= $apoderado['dni_estudiante']; ?></td>
                                    <td><?= $apoderado['fecha_nacimiento']; ?></td>
                                    <td><?= $apoderado['grado_estudiante']; ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="eliminarApoderadoNoRegistrado(<?= $apoderado['id']; ?>)">Eliminar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>      
    </main>

<?php 
require_once 'includes/footer.php';
?>

<script src="js/functionsapoderadosnoregistrados.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
<script>
    function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('landscape');

        // Agregar título al PDF
        doc.setFontSize(18);
        doc.text('Lista de Apoderados Aun No Registrados', 14, 22);

        // Extraer el contenido de la tabla sin las columnas "ID" y "Acciones"
        const table = document.getElementById("tableApoderadosNoRegistrados");
        const headers = Array.from(table.querySelectorAll("th")).map(th => th.innerText).slice(1, -1); // Excluir la primera y la última columna
        const data = Array.from(table.querySelectorAll("tbody tr")).map(tr => {
            return Array.from(tr.querySelectorAll("td")).slice(1, -1).map(td => td.innerText); // Excluir la primera y la última columna
        });

        // Configurar autoTable
        doc.autoTable({
            head: [headers],
            body: data,
            startY: 30,
            styles: {
                fontSize: 10,
                cellPadding: 3,
                valign: 'middle',
                halign: 'center', // Alineación horizontal del texto
                lineColor: [44, 62, 80],
                lineWidth: 0.75
            },
            headStyles: {
                fillColor: [52, 152, 219],
                textColor: [255, 255, 255],
                fontSize: 12
            },
            alternateRowStyles: {
                fillColor: [245, 245, 245]
            },
            margin: { top: 30 },
            theme: 'grid'
        });

        // Guardar el PDF con un nombre específico
        doc.save('apoderadosaunnoregistrados.pdf');
    }
</script>

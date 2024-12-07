<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';

// Obtener todos los reportes
$sqlReportes = "SELECT r.*, a.nombre_alumno, ap.nombre_apoderado FROM reportes_bullying r 
JOIN alumnos a ON r.alumno_id = a.alumno_id 
JOIN apoderado ap ON r.apoderado_id = ap.apoderado_id";
$queryReportes = $pdo->prepare($sqlReportes);
$queryReportes->execute();
$reportes = $queryReportes->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="bi bi-flag"></i> Administración de Reportes de Bullying</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Alumno</th>
                                <th>Apoderado</th>
                                <th>Asunto</th>
                                <th>Descripción</th>
                                <th>Archivo</th>
                                <th>Fecha de Reporte</th>
                                <th>Estado de Revisión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reportes as $reporte) { ?>
                                <tr>
                                    <td><?= $reporte['reporte_id']; ?></td>
                                    <td><?= $reporte['nombre_alumno']; ?></td>
                                    <td><?= $reporte['nombre_apoderado']; ?></td>
                                    <td><?= $reporte['asunto']; ?></td>
                                    <td><?= $reporte['descripcion']; ?></td>
                                    <td>
                                        <?php if ($reporte['archivo']) { ?>
                                            <a href="../uploads/<?= $reporte['archivo']; ?>" target="_blank">Ver Archivo</a>
                                        <?php } else { ?>
                                            No adjunto
                                        <?php } ?>
                                    </td>
                                    <td><?= $reporte['fecha_reporte']; ?></td>
                                    <td>
                                        <button class="btn btn-sm <?= $reporte['reporte_visto'] === 'no visualizado' ? 'btn-danger' : 'btn-success' ?>" 
                                                onclick="actualizarEstadoReporte(<?= $reporte['reporte_id']; ?>, '<?= $reporte['reporte_visto'] === 'no visualizado' ? 'visualizado' : 'no visualizado' ?>')">
                                            <?= ucfirst($reporte['reporte_visto'] === 'no visualizado' ? 'no visualizado' : 'visualizado') ?>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="eliminarReporte(<?= $reporte['reporte_id'] ?>)">Eliminar</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>

<!-- Incluye el archivo JavaScript al final del body -->
<script src="js/functions_admin_reportes.js"></script>

<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';
$apoderado_id = $_SESSION['apoderado_id'];

// Obtener los alumnos del apoderado
$sql = "SELECT * FROM alumnos WHERE apoderado_id = ?";
$query = $pdo->prepare($sql);
$query->execute([$apoderado_id]);
$alumnos = $query->fetchAll();

// Obtener reportes previos
$sqlReportes = "SELECT r.*, a.nombre_alumno FROM reportes_bullying r 
JOIN alumnos a ON r.alumno_id = a.alumno_id 
WHERE r.apoderado_id = ?";
$queryReportes = $pdo->prepare($sqlReportes);
$queryReportes->execute([$apoderado_id]);
$reportes = $queryReportes->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="mt-4"><i class="bi bi-flag"></i> Reportar Bullying</h1>
        </div>
    </div>

    <div id="apoderadoInfo" data-apoderado-id="<?= $_SESSION['apoderado_id']; ?>"></div>
    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <div class="tile-body">
                    <form id="reporteBullyingForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombreApoderado">Nombre del Apoderado:</label>
                            <span id="nombreApoderado"><?= $_SESSION['nombre_apoderado'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="alumno">Seleccionar Alumno:</label>
                            <select id="alumno" name="alumno_id" class="form-control" required>
                                <?php foreach ($alumnos as $alumno) { ?>
                                    <option value="<?= $alumno['alumno_id']; ?>"><?= $alumno['nombre_alumno']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <input type="text" id="asunto" name="asunto" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Adjuntar Archivo:</label>
                            <input type="file" id="archivo" name="archivo" class="form-control">
                        </div>
                        <button type="submit" class="btn-enviar-reporte">Enviar Reporte</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tile">
                <div class="tile-body" style="height: 400px; overflow-y: auto;">
                    <h3>Reportes Anteriores</h3>
                    <div id="reportesPrevios">
                        <?php foreach ($reportes as $reporte) { ?>
                            <div class="reporte-previo">
                                <h5><?= $reporte['nombre_alumno'] ?> - <?= $reporte['asunto'] ?></h5>
                                <p><?= $reporte['descripcion'] ?></p>
                                <small><?= $reporte['fecha_reporte'] ?></small>
                                <p>Estado de Revisión: 
                                    <span style="color: <?= $reporte['reporte_visto'] === 'visualizado' ? 'green' : 'red'; ?>">
                                        <?= ucfirst($reporte['reporte_visto']); ?>
                                    </span>
                                </p>
                                <button class="btn btn-danger btn-sm" onclick="eliminarReporte(<?= $reporte['reporte_id'] ?>)">Eliminar</button>
                            </div>
                            <hr>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>

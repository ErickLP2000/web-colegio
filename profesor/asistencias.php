<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['profesor_id'])) {
    echo "Error: el profesor_id no está en la sesión.";
    exit;
}

$profesor_id = $_SESSION['profesor_id'];

// Obtener el grado del profesor
$sqlGrado = "SELECT g.grado_id, g.nombre_grado FROM grados g 
JOIN profesor_grado pg ON g.grado_id = pg.grado_id 
WHERE pg.profesor_id = ?";
$queryGrado = $pdo->prepare($sqlGrado);
$queryGrado->execute([$profesor_id]);
$grado = $queryGrado->fetch();

$grado_id = $grado['grado_id'];
$nombre_grado = $grado['nombre_grado'];

// Obtener los alumnos del profesor
$sqlAlumnos = "SELECT DISTINCT a.alumno_id, a.nombre_alumno 
        FROM profesor_alumno pa 
        INNER JOIN profesor_grado pg ON pa.pg_id = pg.pg_id 
        INNER JOIN alumnos a ON pa.alumno_id = a.alumno_id 
        WHERE pg.profesor_id = ?";
$queryAlumnos = $pdo->prepare($sqlAlumnos);
$queryAlumnos->execute([$profesor_id]);
$alumnos = $queryAlumnos->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="mt-4"><i class="bi bi-calendar-check"></i> Registrar Asistencia para <?= htmlspecialchars($nombre_grado, ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tile">
                <div class="tile-body">
                <form id="formularioAsistencia">
                    <h3 class="mb-4">Registrar Asistencia</h3> <!-- Título del formulario -->
                    
                    <input type="hidden" name="grado_id" value="<?= htmlspecialchars($grado_id, ENT_QUOTES, 'UTF-8'); ?>">

                    <div class="form-group">
                        <label for="fecha" class="font-weight-bold">Seleccionar Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>

                    <div id="listaAlumnos" class="mt-4">
                        <?php if (!empty($alumnos)) {
                            foreach ($alumnos as $alumno) { ?>
                                <div class="form-group mb-3">
                                    <label class="font-weight-semibold"><?= htmlspecialchars($alumno['nombre_alumno'], ENT_QUOTES, 'UTF-8'); ?></label>
                                    <select name="asistencia[<?= htmlspecialchars($alumno['alumno_id'], ENT_QUOTES, 'UTF-8'); ?>]" class="form-control">
                                        <option value="Temprano Presente">Temprano Presente</option>
                                        <option value="Falto">Falto</option>
                                        <option value="Llego Tarde">Llego Tarde</option>
                                    </select>
                                </div>
                            <?php }
                        } else {
                            echo "<p>No se encontraron alumnos para este profesor.</p>";
                        } ?>
                    </div>

                    <!-- Botón con un diseño más atractivo -->
                    <button type="submit" class="btn btn-primary btn-lg w-100">Guardar Asistencia</button>
                </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="tile">
                <div class="tile-body">
                    <h3>Ver Asistencias por Fecha</h3>
                    <div class="form-group">
                        <label for="fechaConsulta">Seleccionar Fecha:</label>
                        <input type="date" id="fechaConsulta" name="fechaConsulta" class="form-control">
                    </div>
                    <div id="tablaAsistencias" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <a href="index.php" class="btn btn-info"><< Volver Atrás</a>
    </div>
</main>

<!-- Modal para Editar Estado -->
<div class="modal fade" id="editarEstadoModal" tabindex="-1" role="dialog" aria-labelledby="editarEstadoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarEstadoModalLabel">Editar Estado de Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditarEstado">
                    <div class="form-group">
                        <label for="nombreAlumno">Nombre del Alumno</label>
                        <input type="text" id="nombreAlumno" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control">
                            <option value="Temprano Presente">Temprano Presente</option>
                            <option value="Falto">Falto</option>
                            <option value="Llego Tarde">Llego Tarde</option>
                        </select>
                    </div>
                    <input type="hidden" id="alumno_id">
                    <input type="hidden" id="fecha">
                    <button type="submit" class="btn btn-primary">Editar Estado</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
require_once 'includes/footer.php';
?>

<!-- Asegúrate de que el script se carga después del HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/functions_asistencia.js"></script>
<!-- Incluye jQuery y Bootstrap para los modales -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


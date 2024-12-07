<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['apoderado_id'])) {
    echo "Error: el apoderado_id no está en la sesión.";
    exit;
}

$apoderado_id = $_SESSION['apoderado_id'];

// Obtener los alumnos del apoderado
$sqlAlumnos = "SELECT a.alumno_id, a.nombre_alumno 
               FROM alumnos a 
               WHERE a.apoderado_id = ?";
$queryAlumnos = $pdo->prepare($sqlAlumnos);
$queryAlumnos->execute([$apoderado_id]);
$alumnos = $queryAlumnos->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1 class="mt-4"><i class="bi bi-calendar-check"></i> Ver Asistencias de Alumnos</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- Ajuste el ancho de la columna para que sea más grande -->
            <div class="tile">
                <div class="tile-body">
                    <div class="form-group">
                        <label for="alumnoSelect">Seleccionar Alumno:</label>
                        <select id="alumnoSelect" class="form-control">
                            <option value="">Seleccione un alumno</option>
                            <?php foreach ($alumnos as $alumno) { ?>
                                <option value="<?= htmlspecialchars($alumno['alumno_id'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($alumno['nombre_alumno'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fechaConsulta">Seleccionar Fecha:</label>
                        <input type="date" id="fechaConsulta" name="fechaConsulta" class="form-control">
                    </div>
                    <div id="infoAsistencia" class="asistencia-info mt-4">
                        <p>Seleccione una fecha y un alumno para ver la asistencia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
require_once 'includes/footer.php';
?>

<!-- Asegúrate de que el script se carga después del HTML -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/functions_asistenciasalumno.js"></script>
<!-- Incluye jQuery y Bootstrap para los modales -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .asistencia-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        overflow: hidden; /* Evitar barras de desplazamiento */
    }
    .asistencia-info h4 {
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .asistencia-info h3 {
        font-size: 1.5em;
        margin-bottom: 20px;
    }
    .estado-temprano {
        color: green;
    }
    .estado-tarde {
        color: darkorange;
    }
    .estado-falto {
        color: red;
    }
    .asistencia-info p {
        font-size: 1.2em;
    }
    .asistencia-info .estado {
        font-size: 1.5em;
        font-weight: bold;
    }
</style>

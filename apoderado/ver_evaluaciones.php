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
<div class="">
    <!-- Título de la sección -->
    <div class="app-title text-center">
        <h1 class="h3 mt-4"><i class="bi bi-journal-check"></i> Ver Evaluaciones de Alumnos</h1>
    </div>

    <!-- Selección de alumno -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="tile p-4 shadow-sm">
                <div class="tile-body">
                    <div class="form-group mb-4">
                        <label for="alumnoSelect" class="fw-bold mb-2">Seleccionar Alumno:</label>
                        <select id="alumnoSelect" class="form-control form-control-lg">
                            <option value="">Seleccione un alumno</option>
                            <?php foreach ($alumnos as $alumno) { ?>
                                <option value="<?= htmlspecialchars($alumno['alumno_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?= htmlspecialchars($alumno['nombre_alumno'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="evaluacionesContenedor" class="contenidos-info p-3 text-center bg-light border rounded">
                        <p class="text-muted">Seleccione un alumno para ver las evaluaciones</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de subida -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <div class="tile p-4 shadow-sm">
                <div class="tile-body">
                    <form id="formEntrega" enctype="multipart/form-data">
                        <!-- Input ocultos -->
                        <input type="hidden" id="alumno_id" name="alumno_id" value="" />
                        <input type="hidden" id="evaluacion_id" name="evaluacion_id" value="" />

                        <!-- Subir material -->
                        <div class="form-group mb-4">
                            <label for="material_alumno" class="fw-bold mb-2">Subir Material:</label>
                            <input type="file" class="form-control form-control-lg" id="material_alumno" name="material_alumno" required>
                        </div>

                        <!-- Observación -->
                        <div class="form-group mb-4">
                            <label for="observacion" class="fw-bold mb-2">Observación:</label>
                            <textarea class="form-control form-control-lg" id="observacion" name="observacion" rows="4" placeholder="Escriba una observación"></textarea>
                        </div>

                        <!-- Botón enviar -->
                        <div class="text-center">
                            <button type="submit" class="btn-enviar-reporte">Enviar</button>
                        </div>
                    </form>
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
<script src="js/functions_evaluaciones.js"></script>
<!-- Incluye jQuery y Bootstrap para los modales -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
.selected {
    border: 2px solid #28a745;
    box-shadow: 0 0 10px rgba(0, 128, 0, 0.7);
}

.entregada {
    background-color: #f8f9fa;
    color: #6c757d;
    pointer-events: none; /* Esto deshabilita la interacción */
}
.entregada .card-body .btn {
    display: none;
}

</style>

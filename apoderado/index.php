<?php 
require_once 'includes/header.php';
require_once '../includes/conexion.php';

// Asegúrate de que la sesión está iniciada y obtener el id del apoderado
session_start();
$apoderado_id = $_SESSION['apoderado_id'];

// Obtener los hijos del apoderado
$sql = "SELECT * FROM alumnos WHERE apoderado_id = ?";
$query = $pdo->prepare($sql);
$query->execute([$apoderado_id]);
$alumnos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="bi bi-speedometer"></i> Resumen de actividades</h1>
          <p>Comienza con un buen día</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
          <li class="breadcrumb-item"><a href="#">Resumen de actividades</a></li>
        </ul>
      </div>
      <div class="row justify-content-center mt-4">
        <div class="col-md-10">
          <div class="tile p-4 shadow-sm" style="border-radius: 10px; background-color: #f8f9fa;">
            <div class="tile-body">
              <div class="form-group mb-4">
                <label for="selectAlumno"  class="font-weight-bold" style="font-size: 1.2rem; color: #495057;">Seleccione el hijo que desea información:</label>
                <select id="selectAlumno" class="form-control form-control-lg" style="border-radius: 8px;">
                  <option value="">Seleccione un hijo</option>
                  <?php foreach ($alumnos as $alumno) { ?>
                    <option value="<?= $alumno['alumno_id']; ?>"><?= $alumno['nombre_alumno']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <h2 class="text-center mt-4 mb-3" style="font-size: 1.5rem; color: #343a40;">Información del Hijo</h2>
              <div id="infoAlumno" class="p-3 text-center" style="background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px;">
                <p style="font-size: 1rem; color: #6c757d;">Seleccione un hijo para ver la información</p>
              </div>
            </div>
          </div>
        </div>
      </div>
</main>

<?php 
require_once 'includes/footer.php';
?>

<!-- Incluye el archivo JavaScript al final del body -->
<script src="js/functions_index.js"></script>

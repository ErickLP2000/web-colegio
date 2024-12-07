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
$alumnos = $queryAlumnos->fetchAll(PDO::FETCH_ASSOC);

// Obtener el ID del alumno seleccionado
$alumno_id = isset($_GET['alumno_id']) ? $_GET['alumno_id'] : (isset($alumnos[0]['alumno_id']) ? $alumnos[0]['alumno_id'] : null);

// Obtener las notas del alumno seleccionado
$notas = [];
if ($alumno_id) {
    $sql_notas = "SELECT 
                    n.nota_id,
                    n.valor_nota,
                    n.fecha AS fecha_nota,
                    ee.material_alumno,
                    ee.observacion,
                    e.nombre_evaluacion,
                    e.descripcion,
                    e.fecha AS fecha_evaluacion,
                    a.nombre_alumno
                FROM 
                    notas n
                JOIN 
                    ev_entregadas ee ON n.ev_entregada_id = ee.ev_entregada_id
                JOIN 
                    evaluaciones e ON ee.evaluacion_id = e.evaluacion_id
                JOIN 
                    alumnos a ON ee.alumno_id = a.alumno_id
                WHERE 
                    a.alumno_id = ?";
    $query_notas = $pdo->prepare($sql_notas);
    $query_notas->execute([$alumno_id]);
    $notas = $query_notas->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Notas de los Alumnos</title>
    <style>
        .container {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
        }
        .form-container {
            flex: 0 0 auto;
            max-width: 250px;
            margin-right: 20px;
        }
        .notas-container {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
        }
        .nota-verde {
            font-size: 32px;
            color: green;
        }
        .nota-roja {
            font-size: 32px;
            color: red;
        }
        .form-container select.form-control {
            width: auto;
            display: block;
        }
        .tile {
            flex: 1 1 100%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1 class="mt-4"><i class="bi bi-speedometer"></i> Notas de los Alumnos</h1>
            </div>
        </div>
        <div class="container">
            <div class="form-container">
                <form method="GET" action="ver_notas.php">
                    <input type="hidden" name="apoderado_id" value="<?= $apoderado_id ?>">
                    <div class="form-group">
                        <label for="alumnoSelect">Seleccionar Alumno:</label>
                        <select name="alumno_id" id="alumnoSelect" class="form-control" onchange="this.form.submit()">
                            <?php foreach ($alumnos as $alumno) { ?>
                                <option value="<?= $alumno['alumno_id'] ?>" <?= ($alumno['alumno_id'] == $alumno_id) ? 'selected' : '' ?>>
                                    <?= $alumno['nombre_alumno'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="notas-container">
                <?php if (count($notas) > 0) {
                    foreach ($notas as $nota) { 
                        $nota_class = $nota['valor_nota'] >= 12 ? 'nota-verde' : 'nota-roja'; ?>
                    <div class="tile">
                        <div class="tile-body">
                            <div class="title-title-w-btn">
                                <h3 class="title"><?= $nota['nombre_alumno'] ?> - <?= $nota['nombre_evaluacion'] ?></h3>
                            </div>
                            <div class="title-body">
                                <b class="<?= $nota_class ?>">Nota: <?= $nota['valor_nota'] ?></b><br><br>
                                <b>Fecha de Nota: <kbd><?= $nota['fecha_nota'] ?></kbd></b><br><br>
                                <b>Evaluación: <?= $nota['descripcion'] ?></b><br><br>
                                <b>Fecha de Evaluación: <?= $nota['fecha_evaluacion'] ?></b><br><br>
                                <b>Material: <a href="<?= $nota['material_alumno'] ?>" target="_blank">Descargar</a></b><br><br>
                                <b>Observación: <?= $nota['observacion'] ?></b>
                            </div>
                        </div>
                    </div>
                    <?php }
                } else { ?>
                <div class="tile">
                    <div class="tile-body">
                        <h3>No hay notas disponibles para mostrar.</h3>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div>
            <a href="apoderado.php" class="btn btn-info text-white"><< Volver Atrás</a>
        </div>
    </main>

<?php 
require_once 'includes/footer.php';
?>

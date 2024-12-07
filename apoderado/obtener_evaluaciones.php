<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/conexion.php';

if (!isset($_SESSION['apoderado_id'])) {
    echo json_encode(['error' => 'Sesión no válida']);
    exit;
}

$apoderado_id = $_SESSION['apoderado_id'];

if (isset($_GET['alumno_id'])) {
    $alumno_id = $_GET['alumno_id'];

    try {
        $sql = "SELECT DISTINCT e.evaluacion_id, e.nombre_evaluacion, e.descripcion, e.fecha, c.nombre_contenido, c.material, m.nombre_materia, p.nombre AS nombre_profesor,
                       (SELECT COUNT(*) FROM ev_entregadas ee WHERE ee.evaluacion_id = e.evaluacion_id AND ee.alumno_id = a.alumno_id) AS entregado
                FROM evaluaciones e
                JOIN contenidos c ON e.contenido_id = c.contenido_id
                JOIN profesor_grado pg ON c.pg_id = pg.pg_id
                JOIN materias m ON pg.materia_id = m.materia_id
                JOIN profesor_alumno pa ON pa.pg_id = pg.pg_id
                JOIN alumnos a ON pa.alumno_id = a.alumno_id
                JOIN profesor p ON pg.profesor_id = p.profesor_id
                WHERE a.alumno_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$alumno_id]);
        $evaluaciones = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($evaluaciones);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>

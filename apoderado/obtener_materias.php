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
        $sql = "SELECT DISTINCT m.materia_id, m.nombre_materia 
                FROM profesor_grado pg
                JOIN materias m ON pg.materia_id = m.materia_id
                JOIN alumnos a ON a.grado_id = pg.grado_id
                WHERE a.alumno_id = ? AND a.apoderado_id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$alumno_id, $apoderado_id]);
        $materias = $query->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($materias);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos']);
}
?>

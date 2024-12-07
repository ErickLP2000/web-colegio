<?php
require_once '../includes/conexion.php';

if (isset($_GET['grado_id']) && isset($_GET['fecha'])) {
    $grado_id = $_GET['grado_id'];

    $sql = "SELECT a.* FROM alumnos a 
    JOIN profesor_alumno pa ON a.alumno_id = pa.alumno_id 
    WHERE pa.grado_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$grado_id]);
    $alumnos = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($alumnos);
}
?>

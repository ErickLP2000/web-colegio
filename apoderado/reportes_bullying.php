<?php
session_start();
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['apoderado_id'])) {
    $apoderado_id = $_GET['apoderado_id'];
    $sql = "SELECT alumno_id, nombre_alumno FROM alumnos WHERE apoderado_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$apoderado_id]);
    $alumnos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($alumnos);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['apoderado_id'])) {
        $apoderado_id = $_SESSION['apoderado_id'];
    } else {
        echo "Error: No se pudo obtener el ID del apoderado.";
        exit;
    }

    $alumno_id = $_POST['alumno_id'];
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];
    $fecha_reporte = date('Y-m-d');

    $archivo = '';
    if (!empty($_FILES['archivo']['name'])) {
        $archivo = basename($_FILES['archivo']['name']);
        move_uploaded_file($_FILES['archivo']['tmp_name'], '../uploads/' . $archivo);
    }

    $sql = "INSERT INTO reportes_bullying (apoderado_id, alumno_id, asunto, descripcion, archivo, fecha_reporte) VALUES (?, ?, ?, ?, ?, ?)";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$apoderado_id, $alumno_id, $asunto, $descripcion, $archivo, $fecha_reporte]);

    if ($result) {
        echo "Reporte enviado exitosamente.";
    } else {
        echo "Error al enviar el reporte.";
    }
    exit;
}
?>

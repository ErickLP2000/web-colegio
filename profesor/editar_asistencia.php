<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/conexion.php';

if (!isset($_SESSION['profesor_id'])) {
    echo "Error: el profesor_id no está en la sesión.";
    exit;
}

$profesor_id = $_SESSION['profesor_id'];

if (isset($_POST['alumno_id']) && isset($_POST['fecha']) && isset($_POST['estado'])) {
    $alumno_id = $_POST['alumno_id'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];

    // Depuración: Mostrar los datos recibidos
    error_log("Editar Asistencia - alumno_id: $alumno_id, fecha: $fecha, estado: $estado");

    $sql = "UPDATE asistencias 
            SET estado = ? 
            WHERE alumno_id = ? AND fecha = ? AND profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$estado, $alumno_id, $fecha, $profesor_id]);

    if ($result) {
        echo "Asistencia actualizada exitosamente.";
    } else {
        $errorInfo = $query->errorInfo();
        error_log("Error al actualizar la asistencia: " . $errorInfo[2]);
        echo "Error al actualizar la asistencia. Error: " . $errorInfo[2];
    }
} else {
    echo "Datos incompletos.";
}
?>

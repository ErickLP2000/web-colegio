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

if (isset($_POST['alumno_id']) && isset($_POST['fecha'])) {
    $alumno_id = $_POST['alumno_id'];
    $fecha = $_POST['fecha'];

    // Depuración: Mostrar los datos recibidos
    error_log("Eliminar Asistencia - alumno_id: $alumno_id, fecha: $fecha");

    $sql = "DELETE FROM asistencias 
            WHERE alumno_id = ? AND fecha = ? AND profesor_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$alumno_id, $fecha, $profesor_id]);

    if ($result) {
        echo "Asistencia eliminada exitosamente.";
    } else {
        $errorInfo = $query->errorInfo();
        error_log("Error al eliminar la asistencia: " . $errorInfo[2]);
        echo "Error al eliminar la asistencia. Error: " . $errorInfo[2];
    }
} else {
    echo "Datos incompletos.";
}
?>

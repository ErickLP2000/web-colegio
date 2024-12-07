<?php
session_start();
require_once '../includes/conexion.php';

// Verificar si el profesor_id está en la sesión
if (!isset($_SESSION['profesor_id'])) {
    echo json_encode(['error' => 'Error: el profesor_id no está en la sesión.']);
    exit;
}

$profesor_id = $_SESSION['profesor_id'];

if (isset($_POST['fecha']) && isset($_POST['asistencia']) && isset($_POST['grado_id'])) {
    $grado_id = $_POST['grado_id'];
    $fecha = $_POST['fecha'];
    $asistencia = $_POST['asistencia'];

    try {
        // Iniciar transacción
        $pdo->beginTransaction();
        
        foreach ($asistencia as $alumno_id => $estado) {
            // Verificar si ya existe un registro para la misma fecha y alumno
            $sql = "SELECT COUNT(*) FROM asistencias WHERE alumno_id = ? AND fecha = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$alumno_id, $fecha]);
            $count = $query->fetchColumn();

            if ($count > 0) {
                throw new Exception("No se permite registrar la asistencia porque ya se realizó en esta fecha.");
            } else {
                // Insertar nueva asistencia
                $sql = "INSERT INTO asistencias (alumno_id, profesor_id, grado_id, fecha, estado) 
                        VALUES (?, ?, ?, ?, ?)";
                $query = $pdo->prepare($sql);
                $result = $query->execute([$alumno_id, $profesor_id, $grado_id, $fecha, $estado]);
                // Verificar el resultado de cada inserción
                if (!$result) {
                    throw new Exception("Error al insertar asistencia para el alumno.");
                }
            }
        }
        
        // Confirmar transacción
        $pdo->commit();
        
        echo json_encode(['success' => 'Asistencia guardada exitosamente.']);
    } catch (Exception $e) {
        // Revertir transacción en caso de error
        $pdo->rollBack();
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Datos incompletos.']);
}
?>

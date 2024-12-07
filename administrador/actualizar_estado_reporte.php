<?php
require_once '../includes/conexion.php';

if (isset($_GET['reporte_id']) && isset($_GET['estado'])) {
    $reporte_id = $_GET['reporte_id'];
    $nuevo_estado = $_GET['estado'];
    
    $sql = "UPDATE reportes_bullying SET reporte_visto = ? WHERE reporte_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$nuevo_estado, $reporte_id]);

    if ($result) {
        echo "Estado del reporte actualizado exitosamente.";
    } else {
        echo "Error al actualizar el estado del reporte.";
    }
} else {
    echo "Parámetros no especificados.";
}
?>

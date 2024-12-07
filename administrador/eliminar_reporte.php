<?php
require_once '../includes/conexion.php';

if (isset($_GET['reporte_id'])) {
    $reporte_id = $_GET['reporte_id'];
    $sql = "DELETE FROM reportes_bullying WHERE reporte_id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$reporte_id]);

    if ($result) {
        echo "Reporte eliminado exitosamente.";
    } else {
        echo "Error al eliminar el reporte.";
    }
} else {
    echo "ID de reporte no especificado.";
}
?>

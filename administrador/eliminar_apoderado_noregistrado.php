<?php
require_once '../includes/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM apoderadosaunnoregistrados WHERE id = ?";
    $query = $pdo->prepare($sql);
    $result = $query->execute([$id]);

    if ($result) {
        echo "Apoderado eliminado exitosamente.";
    } else {
        echo "Error al eliminar el apoderado.";
    }
} else {
    echo "ID de apoderado no especificado.";
}
?>

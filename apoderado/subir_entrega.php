<?php
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['material_alumno']) && !empty($_POST['evaluacion_id']) && !empty($_POST['alumno_id'])) {
        $alumno_id = $_POST['alumno_id'];
        $evaluacion_id = $_POST['evaluacion_id'];
        $observacion = !empty($_POST['observacion']) ? $_POST['observacion'] : '';

        // Generar un nombre de carpeta aleatorio para mantener la consistencia con el código de contenido
        $directorio = '../uploads/' . $alumno_id . '/';
        
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        $material = $_FILES['material_alumno']['name'];
        $url_temp = $_FILES['material_alumno']['tmp_name'];

        // Asegurar que la ruta tiene el formato correcto
        $destino = $directorio . $material;

        if (move_uploaded_file($url_temp, $destino)) {
            $relative_path = $destino; // Guardar la ruta con el prefijo ../../../

            $sql = "INSERT INTO ev_entregadas (material_alumno, observacion, evaluacion_id, alumno_id)
                    VALUES (?, ?, ?, ?)";
            $query = $pdo->prepare($sql);
            $result = $query->execute([$relative_path, $observacion, $evaluacion_id, $alumno_id]);

            if ($result) {
                echo json_encode(['status' => true, 'msg' => 'Entrega realizada con éxito']);
            } else {
                echo json_encode(['status' => false, 'msg' => 'Error al insertar en la base de datos']);
            }
        } else {
            echo json_encode(['status' => false, 'msg' => 'Error al subir el archivo']);
        }
    } else {
        echo json_encode(['status' => false, 'msg' => 'Datos incompletos']);
    }
} else {
    echo json_encode(['status' => false, 'msg' => 'Método no permitido']);
}
?>

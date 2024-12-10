<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema-escolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4"
// Obtener los datos del formulario
$nombreapellido_apoderado = $_POST['nombreapellido_apoderado'];
$direccion_apoderado = $_POST['direccion_apoderado'];
$telefono_apoderado = $_POST['telefono_apoderado'];
$dni_apoderado = $_POST['dni_apoderado'];
$correo_apoderado = $_POST['correo_apoderado'];
$nombreapellido_estudiante = $_POST['nombreapellido_estudiante'];
$dni_estudiante = $_POST['dni_estudiante'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$grado_estudiante = $_POST['grado_estudiante'];

// Preparar y enlazar
$stmt = $conn->prepare("INSERT INTO apoderadosaunnoregistrados (nombreapellido_apoderado, direccion_apoderado, telefono_apoderado, dni_apoderado, correo_apoderado, nombreapellido_estudiante, dni_estudiante, fecha_nacimiento, grado_estudiante) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", 
    $nombreapellido_apoderado, 
    $direccion_apoderado, 
    $telefono_apoderado, 
    $dni_apoderado, 
    $correo_apoderado, 
    $nombreapellido_estudiante, 
    $dni_estudiante, 
    $fecha_nacimiento, 
    $grado_estudiante
);

// Ejecutar la inserción
if ($stmt->execute()) {
    header('Location: indexprincipal.php?registro=exitoso');
} else {
    echo "Error en el registro: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>


<?php
// Configuración de la conexión a la base de datos
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "sistema-escolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre_apoderado = $_POST['nombre_apoderado'];
$apellido_apoderado = $_POST['apellido_apoderado'];
$direccion_apoderado = $_POST['direccion_apoderado'];
$telefono_apoderado = $_POST['telefono_apoderado'];
$dni_apoderado = $_POST['dni_apoderado'];
$correo_apoderado = $_POST['correo_apoderado']; // Nuevo campo
$nombre_estudiante = $_POST['nombre_estudiante'];
$apellido_estudiante = $_POST['apellido_estudiante'];
$grado_estudiante = $_POST['grado_estudiante'];

// Preparar y enlazar
$stmt = $conn->prepare("INSERT INTO ApoderadosAunNoRegistrados (nombre_apoderado, apellido_apoderado, direccion_apoderado, telefono_apoderado, dni_apoderado, correo_apoderado, nombre_estudiante, apellido_estudiante, grado_estudiante) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", 
    $nombre_apoderado, 
    $apellido_apoderado, 
    $direccion_apoderado, 
    $telefono_apoderado, 
    $dni_apoderado, 
    $correo_apoderado, // Nuevo campo
    $nombre_estudiante, 
    $apellido_estudiante, 
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


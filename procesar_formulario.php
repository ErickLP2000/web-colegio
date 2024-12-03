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

// Obtener los datos del formulario
$nombre_apoderado = $_POST['nombre_apoderado'];
$nombre_estudiante = $_POST['nombre_estudiante'];
$dni_apoderado = $_POST['dni_apoderado'];
$dni_estudiante = $_POST['dni_estudiante'];
$direccion_apoderado = $_POST['direccion_apoderado'];
$edad_estudiante = $_POST['edad_estudiante'];
$telefono_apoderado = $_POST['telefono_apoderado'];
$nac_estudiante = $_POST['nac_estudiante'];
$correo_apoderado = $_POST['correo_apoderado']; // Nuevo campo
$grado_estudiante = $_POST['grado_estudiante'];

// Preparar y enlazar
$stmt = $conn->prepare("INSERT INTO matricula (nombre_apoderado, dni_apoderado, direccion_apoderado, telefono_apoderado, correo_apoderado, nombre_estudiante, dni_estudiante, edad_estudiante, nacimiento_estudiante, grado_estudiante) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", 
    $nombre_apoderado, 
    $dni_apoderado, 
    $direccion_apoderado, 
    $telefono_apoderado,
    $correo_apoderado, // Nuevo campo
    $nombre_estudiante, 
    $dni_estudiante, 
    $edad_estudiante, 
    $nac_estudiante, 
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


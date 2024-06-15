<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include 'conexion.php';

// Recibir datos del formulario
$numempleado = isset($_POST['numempleado']) ? $_POST['numempleado'] : null;
$nombre = isset($_POST['name']) ? $_POST['name'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;

// Verificar que todos los campos necesarios estén presentes
if ($numempleado && $nombre && $apellido && $email && $password && $telefono && $direccion) {
    // Preparar la consulta SQL para insertar datos
    $query = "INSERT INTO usuarios (id, nombre, apellido, telefono, domicilio, correo, password) 
              VALUES ('$numempleado', '$nombre', '$apellido', '$telefono', '$direccion', '$email', '$password')";

    // Ejecutar la consulta
    if (mysqli_query($conn, $query)) {
        // Éxito en la inserción
        $response = array(
            'status' => 'success',
            'message' => 'Técnico registrado correctamente.'
        );
        echo json_encode($response);
    } else {
        // Error en la inserción
        $response = array(
            'status' => 'error',
            'message' => 'Error al registrar técnico: ' . mysqli_error($conn)
        );
        echo json_encode($response);
    }
} else {
    // Datos no recibidos correctamente
    $response = array(
        'status' => 'error',
        'message' => 'Error: Datos no recibidos correctamente.'
    );
    echo json_encode($response);
}

// Cerrar conexión
mysqli_close($conn);
?>

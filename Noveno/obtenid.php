<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

include 'conexion.php';

// Verificamos que el método de solicitud sea GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Consulta para obtener el último ID registrado en la tabla 'usuarios'
    $sql = "SELECT MAX(id) AS ultimo_id FROM usuarios";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        // Verificamos si se encontró un resultado
        if ($row) {
            $ultimo_id = $row['ultimo_id'];
            $siguiente_id = $ultimo_id + 1;
            echo json_encode(['next_id' => $siguiente_id]);
        } else {
            // Si no hay resultados, el siguiente ID será 1
            echo json_encode(['next_id' => 1]);
        }
    } else {
        // Manejo de errores en la consulta
        echo json_encode(['error' => 'Error al ejecutar la consulta']);
    }
} else {
    // Si el método de solicitud no es GET, devolvemos un error
    echo json_encode(['message' => 'Método no permitido']);
}

$conn->close();
?>
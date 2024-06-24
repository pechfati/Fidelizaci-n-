<?php
// obtener_premios.php

require_once 'db.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los premios
$sql = "SELECT id, nombre, descripcion, puntosRequeridos, imagen FROM premios";
$result = $conn->query($sql);

$premios = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $premios[] = $row;
    }
} else {
    echo "0 resultados";
}

$conn->close();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($premios);
?>

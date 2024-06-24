<?php
// agregar_premio.php

require_once 'db.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$puntosRequeridos = $_POST['puntosRequeridos'];

// Manejo de la imagen
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real
$check = getimagesize($_FILES["imagen"]["tmp_name"]);
if ($check === false) {
    die("El archivo no es una imagen.");
}

// Verificar si el archivo ya existe
if (file_exists($target_file)) {
    die("Lo siento, el archivo ya existe.");
}

// Verificar el tamaño del archivo (por ejemplo, máximo 5MB)
if ($_FILES["imagen"]["size"] > 5000000) {
    die("Lo siento, tu archivo es demasiado grande.");
}

// Permitir solo ciertos formatos de imagen
$allowedFormats = ["jpg", "png", "jpeg", "gif"];
if (!in_array($imageFileType, $allowedFormats)) {
    die("Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.");
}

// Intentar subir el archivo
if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
    die("Lo siento, hubo un error al subir tu archivo.");
}

// Insertar los datos del premio en la base de datos
$sql = "INSERT INTO premios (nombre, descripcion, puntosRequeridos, imagen) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $nombre, $descripcion, $puntosRequeridos, $target_file);

if ($stmt->execute()) {
    echo "Nuevo premio agregado con éxito.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>

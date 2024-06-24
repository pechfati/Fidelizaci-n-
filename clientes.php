<?php
// Incluir el archivo de conexión
include 'db.php';

// Función para obtener información de un cliente por su correo electrónico
function obtenerClientePorCorreo($correo) {
  global $conn;

  $sql = "SELECT * FROM clientes WHERE correoElectronico = '$correo'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

// Ejemplo de uso:
$correo = "cliente@example.com";
$cliente = obtenerClientePorCorreo($correo);

// Imprimir información del cliente (solo para propósitos de ejemplo)
if ($cliente) {
  echo "Nombre: " . $cliente['nombre'] . "<br>";
  echo "Apellidos: " . $cliente['apellidos'] . "<br>";
  echo "Puntos acumulados: " . $cliente['puntos'] . "<br>";
}
?>

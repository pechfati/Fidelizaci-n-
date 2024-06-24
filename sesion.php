<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['cliente'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}
?>

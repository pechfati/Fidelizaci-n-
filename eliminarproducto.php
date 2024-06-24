<?php
// eliminarproducto.php

// Recibir el ID del elemento a eliminar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    
    // Aquí podrías realizar acciones adicionales, como eliminar de la base de datos, etc.
    
    // Redirigir al usuario a mispremios.html
    header("Location: ./mispremios.html");
    exit;
}
?>

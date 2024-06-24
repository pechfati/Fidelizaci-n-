<?php
require 'sesion.php';

// Verificar si el usuario está autenticado y tiene datos en sesión
if (!isset($_SESSION['cliente'])) {
    // Si no está autenticado, redirigir al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}

// Obtener datos del cliente desde la sesión
$cliente = $_SESSION['cliente'];

// Incluir archivo de conexión a la base de datos
require_once 'db.php';
if (!$conn) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa de Fidelización</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Programa de Fidelización</h1>
    </header>
    <section id="home"> 
        <h2>Bienvenido, <?php echo htmlspecialchars($cliente['nombre']); ?></h2>
        <p>Tus puntos acumulados: <?php echo htmlspecialchars($cliente['puntos']); ?></p>

        <div id="premios">
            <h2>Premios disponibles</h2>
            <ul id="premios-lista">
                <?php
                // Consulta SQL para obtener premios
                $sql_premios = "SELECT * FROM premios";
                $result_premios = $conn->query($sql_premios);

                if (!$result_premios) {
                    echo "Error en la consulta: " . $conn->error;
                } else {
                    if ($result_premios->num_rows > 0) {
                        while ($row = $result_premios->fetch_assoc()) {
                            echo "<li>" . htmlspecialchars($row['nombre']) . " - " . htmlspecialchars($row['descripcion']) . "</li>";
                        }
                    } else {
                        echo "<li>No hay premios disponibles</li>";
                    }
                }
                ?>
            </ul>  
        </div>

        <div id="beneficios">
            <h2>Beneficios</h2>
            <ul>
                <li>Descuento del 10% en compras en Supermercados</li>
                <li>Entrada gratuita al cine por cada 500 puntos</li>
            </ul>
        </div>

        <div id="tarjeta-digital">
            <h2>Tu tarjeta digital</h2>
            <p>Número de teléfono: <?php echo htmlspecialchars($cliente['telefonoMovil']); ?></p>
        </div>

        <!-- Agregar enlace para cerrar sesión -->
        <div class="button" style="display: flex; align-items: center; justify-content: flex-start;">
            <a href="cerrarsesion.php"><span style="margin-right: 10px;">Cerrar Sesión</span></a>
            <img src="./img/medalla.png" alt="Premios" style="width: 50px; height: auto; margin-left: 0;">
            <a href="./premios.html"><span style="margin-right: 10px;">Detalles de tarjeta</span></a>
        </div>
    </section>

    <script src="script.js"></script>
    <footer>
        <p>&copy; 2024 Maria Can Cocom</p>
    </footer>
</body>
</html>

<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $direccion = $_POST['direccion'];
    $correoElectronico = $_POST['correoElectronico'];
    $estado = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $telefonoMovil = $_POST['telefonoMovil'];
    $password = $_POST['password'];

    // Hashear la contraseña usando MD5
    $password_md5 = md5($password);

    // Inicializar los puntos en cero
    $puntos = 0;

    // Preparar declaración SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO clientes (nombre, apellidos, direccion, correoElectronico, estado, ciudad, telefonoMovil, password, puntos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $nombre, $apellidos, $direccion, $correoElectronico, $estado, $ciudad, $telefonoMovil, $password_md5, $puntos);

    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error en el registro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Registro de Usuario</h1>
    </header>

    <main>
        <section id="register">
            <h2>Registrar nuevo usuario</h2>
            <form id="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required>
                <br>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
                <br>
                <label for="correoElectronico">Correo Electrónico:</label>
                <input type="email" id="correoElectronico" name="correoElectronico" required>
                <br>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required>
                <br>
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" required>
                <br>
                <label for="telefonoMovil">Número de teléfono móvil:</label>
                <input type="text" id="telefonoMovil" name="telefonoMovil" required>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <!-- Campo para puntos, si deseas permitir que el usuario ingrese los puntos manualmente, de lo contrario, se inicializa en cero -->
                <label for="puntos">Puntos:</label>
                <input type="number" id="puntos" name="puntos" value="0" required readonly>
                <br>
                <button type="submit">Registrar</button>
            </form>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>

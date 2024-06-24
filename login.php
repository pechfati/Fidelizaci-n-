<?php
session_start();

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir archivo de conexión a la base de datos
    require_once 'db.php';

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario y sanitizarlos
    $telefonoMovil = mysqli_real_escape_string($conn, $_POST['telefonoMovil']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hashear la contraseña usando MD5
    $password_md5 = md5($password);

    // Preparar una declaración SQL para evitar inyecciones SQL
    $sql = "SELECT id, nombre, apellidos, direccion, correoElectronico, estado, ciudad, puntos, telefonoMovil FROM clientes WHERE telefonoMovil = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la declaración se preparó correctamente
    if ($stmt === false) {
        die("Error en la preparación de la declaración: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $telefonoMovil, $password_md5);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Inicio de sesión exitoso, obtener los datos del cliente
        $cliente = $result->fetch_assoc();

        // Guardar los datos del cliente en la sesión
        $_SESSION['cliente'] = $cliente;

        // Redirigir al usuario a la página principal (index.php o la que desees)
        header("Location: index.php");
        exit();
    } else {
        // Si no se encuentra ningún cliente con las credenciales proporcionadas, mostrar un mensaje de error
        $error_message = "Número de teléfono móvil o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Programa de Fidelización</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #fff, #ffd700);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        main {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1, h2 {
            color: #fff;
        }
        section#login {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            padding: 10px;
            background-color: #ffd700;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2575fc;
        }
        a {
            margin-top: 10px;
            text-decoration: none;
            color: #2575fc;
        }
        a:hover {
            text-decoration: underline;
        }
        .error {
            color: #ff0000;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
   

    <main>
        <section id="login">
            <h3>Bienvenido</h3>
            <h2>Iniciar sesión</h2>
            <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <?php if (isset($error_message)): ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <label for="telefonoMovil">Número de teléfono móvil:</label>
                <input type="text" id="telefonoMovil" name="telefonoMovil" required>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Iniciar sesión</button>
                <a href="./registro.php"><samp>Registrarse</samp></a>
            </form>
        </section>
    </main>
</body>
</html>

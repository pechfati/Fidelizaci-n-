<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especiales</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            padding: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #000;
            color: #fff;
            padding: 10px;
        }
        .header img {
            width: 24px;
            height: 24px;
        }
        .item {
            background-color: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .item img {
            width: 100%;
            border-radius: 10px;
        }
        .item-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }
        .item-info span {
            font-size: 14px;
            color: #888;
        }
        .item-info .points {
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .item-info .points img {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }
        .buy-button {
            background-color: #FFA500;
            color: #000;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        .buy-button img {
            width: 16px;
            height: 16px;
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="./premios.html"><img src="./img/atras.png" alt="Atrás"></a>
            <h1>Especiales</h1>
            <img src="./img/correo.png" alt="Correo">
        </div>
        
        <!-- Aquí se mostrarán los productos obtenidos -->
        <div id="productos-obtenidos">
            <!-- Los productos se agregarán dinámicamente aquí -->
        </div>
    </div>

    <script>
        // Ejemplo de cómo obtener productos usando AJAX y mostrarlos en la página
        document.addEventListener("DOMContentLoaded", function() {
            fetch('obtenerproducto.php')
                .then(response => response.json())
                .then(data => {
                    const productosObtenidos = data;
                    const contenedorProductos = document.getElementById('productos-obtenidos');
                    contenedorProductos.innerHTML = '';

                    productosObtenidos.forEach(producto => {
                        const itemHTML = `
                            <div class="item">
                                <h2>${producto.nombre}</h2>
                                <p>${producto.descripcion}</p>
                                <div class="item-info">
                                    <div class="points">
                                        <img src="points_icon.png" alt="Puntos">
                                        <span>${producto.puntosRequeridos} pts.</span>
                                    </div>
                                    <a href="#" class="buy-button"> 
                                        <span>Obtenerlo</span>
                                        <img src="./img/carrito.png" alt="Carrito">
                                    </a>
                                </div>
                            </div>
                        `;
                        contenedorProductos.innerHTML += itemHTML;
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los productos:', error);
                });
        });
    </script>
</body>
</html>

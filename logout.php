<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('header.php');
    ?>
     

    <div class="container">
        <div id="box">
            <h1>Cerrando sesión</h1>
            <p>Gracias por utilizar nuestra aplicacion...</p>
            <img src="ruta/al/gif/cerrar-sesion.gif" alt="Cerrar sesión">
        </div>
    </div>


    <?php
    include('footer.php');
    ?>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000);
    </script>
</body>
</html>
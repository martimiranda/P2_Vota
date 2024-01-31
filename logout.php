<?php
session_start();
$_SESSION['page'] = 'logout'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <?php
    include('header.php');
    ?>
    <h1 id="reg"></h1>


    <div class="container">
        <div id="box">
            <h1>Cerrando sesión</h1>
            <p>Gracias por utilizar nuestra aplicacion...</p>
            <div id="contenedor">
                 <div class="loader" id="loader">Loading...</div>
            </div>
        </div>
    </div>


    <?php
    include('sistemLog.php');
    registrarEvento("LOGOUT: ".$_SESSION["usuario"]. " a cerrado la sesión");
    include('footer.php');
    unset($_SESSION['usuario']);
    unset($_SESSION['user_id']);
    ?>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000);
    </script>
</body>
</html>
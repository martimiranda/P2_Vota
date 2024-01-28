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
</head>
<body>
    <?php
    $_SESSION['usuario'] = "";
    $_SESSION['user_id']= false;
    include('header.php');
    ?>
     

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
    include('footer.php');
    ?>
    <script>
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000);
    </script>
</body>
</html>
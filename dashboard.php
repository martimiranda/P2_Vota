<?php 
session_start();
$_SESSION['page'] = 'dashboard';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    http_response_code(403);
    include('errores/error403.php');
    exit;
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $_SESSION['page'] = 'dashboard';
    include('header.php');
    ?>
     

    <div class="container">
        <div id="box2">
            <h1>Panel de control</h1>
            <section>
                <a class='button2' href="create_poll.php">Crear Encuesta</a>
                <a class='button2' href="#">Listar Encuesta</a>
            </section>
        </div>
    </div>


    <?php
    include('footer.php');
}
    ?>

</body>
</html>
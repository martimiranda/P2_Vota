<?php
session_start();
$_SESSION['page'] = 'index'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('header.php');
    ?>
    <section>
        <img src="img/encuestas-online.png" alt="encuestas">
    </section>
    <main>
        <p>Estás en nuestra página principal de <strong>Margomi Votos</strong>, un portal de votos donde puedes realizar múltiples operaciones, como crear encuestas a tu gusto, votar encuestas creadas por otros usuarios y mucho más. ¡Descubre cómo!<br>
        Para comenzar, te invitamos a unirte a nosotros creando una nueva cuenta en "Registrarse" o, si ya tienes una cuenta, inicia sesión. Deberás proporcionar algunos datos.<br><br>
        Una vez registrado y/o iniciado sesión, ingresarás a tu portal de Margomi Encuestas, donde encontrarás diferentes secciones para acceder:</p>
        <ul>
            <li>Crear encuesta.</li>
            <p>En esta sección, podrás desarrollar una pregunta con sus múltiples respuestas. Debes incluir un mínimo de 2 respuestas y un máximo de 100 respuestas para elegir.</p>
            <li>Votar encuesta.</li>
            <p>En esta sección, podrás elegir y participar en una encuesta.</p>
            <li>Listado de encuestas creadas.</li>
            <p>En esta sección, podrás observar en un listado todas tus encuestas creadas, tanto habilitadas como deshabilitadas.</p>
            <li>Listado de encuestas votadas.</li>
            <p>En esta sección, podrás observar en un listado todos tus votos realizados en encuestas y votos pendientes de realizar.</p>
        </ul>
    </main>

    <section>
        <a class='button' href="login.php">Logearse</a>
        <a class='button' href="register.php">Registrarse</a>
    </section>
    <?php
    include('footer.php');
    ?>
</body>
</html>
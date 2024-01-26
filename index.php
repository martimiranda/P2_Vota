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
        <p>Estas en nuestra pagina principal de <strong>margomi votos</strong>, es un portal de votos, donde puedes hacer multiples operaciones como crear encuestas a tu merced, votar encuestas creadas por los usuarios y mucho mas. ¡Descubre como!<br>
        Para comenzar, te invitamos a unirte a nosotros creando una nueva cuenta en registrarse o si ya contiene una cuenta inicie sesión, tendras que rellenar algunos datos.<br><br>
        Una vez registrado y/o logeado, entraras en tu portal de margomi encuestas, donde encontraras diferentes secciones para acceder:</p>
        <ul>
            <li>Crear encuesta.</li>
            <p>En esta sección, podras desarrollar una pregunta con sus multiples respuestas con un minimo 2 respuestas y un máximo de 100 respuestas a elegir.</p>
            <li>Votar encuesta.</li>
            <p>En esta sección, podras elegir y realizar una encuesta.</p>
            <li>Listado de encuestas creadas.</li>
            <p>En esta sección, podras observar en un listado todas tus encuestas creadas, tanto habilitadas como deshabilitadas.</p>
            <li>Listado de encuestas votadas.</li>
            <p>En esta sección, podras observar en un listado todos tus votos realizados de encuestas y votos pendientes de realizar.</p>
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
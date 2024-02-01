<?php 
session_start();
$_SESSION['page'] = 'Invite Voters';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || !isset($_POST['questionId'])) {
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
    <title>Invitar Votantes</title>
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="inviteVoters.js"></script>

    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php
    $_SESSION['page'] = 'Invite Voters';
    include('header.php');
    ?>
    <h1 id="reg">Invitar a Votantes</h1>
    <h4>Invite a los usuarios que quiera que voten. Para invitarlos, debe poner las direcciones de correo electrónico de los invitados de la manera del ejemplo (En cada línea un invitado).</h4>
    <div class="container">
        <div id="box3">
            <section>
            <textarea id="inviteText" 
placeholder="ejemplo1@ejemplo.com
ejemplo2@ejemplo.com
ejemplo3@ejemplo.com"></textarea>
            <button id="enviarButton">Enviar</button>
            </section>
        </div>
    </div>


    <?php
    include('footer.php');
}
    ?>

</body>
</html>
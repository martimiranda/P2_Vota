<?php 
session_start();
$_SESSION['page'] = 'Invite Voters';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || !isset($_POST['questionId']) && !isset($_POST['option']) ) {
    http_response_code(403);
    include('errores/error403.php');
    exit;
} else {
    if(isset($_POST['questionId'])){
        $_SESSION['questionId'] = $_POST['questionId'];
    }
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
    
    <div class="container">
    <h1 id="reg">Invitar a Votantes</h1>
        <div id="box3">
        <h4>Invite a los usuarios que quiera que voten. Para invitarlos, debe poner las direcciones de correo electrónico de los invitados de la manera del ejemplo (En cada línea un invitado).</h4>
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
    if(isset($_POST['option'])){
        $options = $_POST['option'];
        $question_id = $_SESSION['questionId'];
        include('sistemLog.php');
            try {
                $dsn = "mysql:host=localhost;dbname=p2_votos";
                $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
    
                if (!empty($options)) {
    
                    foreach ($options as $option) {
                        $option_query = $pdo->prepare("INSERT INTO invitations (question_id, email) VALUES(:question_idd, :mail)");
                        $option_query->bindParam(':question_idd', $question_id, PDO::PARAM_INT);
                        $option_query->bindParam(':mail', $option, PDO::PARAM_STR);
                        $option_query->execute();
    
                        if ($option_query->rowCount() > 0) {
                        } else {
                            registrarEvento("ERROR INVITE VOTERS (ID USER: $userId): Al insertar el mail'$option'");
                            echo "Error al insertar el mail '$option'<br>";
                        }
                    }
                    registrarEvento("INVITE VOTERS (ID USER: $userId): ¡Usuarios invitados correctamente a la encuesta con id: $question_id");
                    echo '<div id="voters_sended" class="container">
                    <div id="box">
                        <form action="list_polls.php" method="POST">
                            <h4>Usuarios invitados correctamente!!</h4>
                            <button class="accept-button" type="submit">Aceptar</button>
                        </form>
                    </div>
                </div>';
                } 
    
            } catch (PDOException $e) {
                registrarEvento("ERROR CREATE POLL (ID USER: $userId): Error en la base de datos: " . $e->getMessage());
                echo "Error en la base de datos: " . $e->getMessage();
            }
        
    }
    include('footer.php');
}
    ?>

</body>
</html>
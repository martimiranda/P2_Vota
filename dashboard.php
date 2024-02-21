<?php 
session_start();
$_SESSION['page'] = 'dashboard';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    http_response_code(403);
    include('errores/error403.php');
    exit;
} else {
    try {
        $hostname = "localhost";
        $dbname = "p2_votos";
        $username = "martimehdi";
        $pw = "P@ssw0rd";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        registrarEvento("LOGIN: Failed to get DB handle: " . $e->getMessage() . "\n");
        exit;
    }

    $querystr = "SELECT * FROM users WHERE user_id=:idUser";
    $query = $pdo->prepare($querystr);

    $query->bindParam(':idUser', $_SESSION['user_id'], PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if ($row["conditions_status"]) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php
    $_SESSION['page'] = 'dashboard';
    include('header.php');
    ?>
    <h1 id="reg">Panel de Control</h1>

    <div class="container">
        <div id="box2">
            <section>
                <a class='button2' href="create_poll.php">Crear Encuesta</a>
                <a class='button2' href="list_polls.php">Mis Encuestas</a>
                <a class='button2' href="list_votations.php">Mis Votaciones</a>
            </section>
        </div>
    </div>


    <?php
    include('footer.php');
    } else {
        echo '<script>
            window.location.href = "verificar_terminos.php";
        </script>';
    }
}
    ?>

</body>
</html>
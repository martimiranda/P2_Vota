<?php
session_start();
$_SESSION['page'] = 'list_polls';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    <title>Listado Votaciones</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="list_polls.js"></script> -->
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php include('header.php'); ?>

    <h1 id="reg">Listado de votaciones pendientes</h1>
    <!-- <div id="box4"> -->
    <?php
    $userId = $_SESSION['user_id'];

    echo '<table id="questionTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Pregunta</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>';

    include('sistemLog.php');

    try {
        $dsn = "mysql:host=localhost;dbname=p2_votos";
        $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
        $query = $pdo->prepare("SELECT q.question_id, q.question, i.token
                                FROM questions q
                                JOIN invitations i ON q.question_id = i.question_id
                                JOIN users u ON u.email = i.email
                                WHERE i.token_status = true
                                AND u.user_id = $userId;");
        $query->execute();

        while ($row = $query->fetch()) {
            $question = $row['question'];
            $questionId = $row['question_id'];
            $token = $row['token'];

            echo '<tr>';
            echo '<td>' . $question . '</td>';
            echo '<td>
                    <a class="button3" href="vote_loget.php?token=' . $token . '">Votar</a>
                </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';

    } catch (PDOException $e) {
        registrarEvento("ERROR LIST POLL (ID USER: $userId): " . $e->getMessage());
        echo $e->getMessage();
    }
?>


<h1 id="reg">Listado de votaciones hechas</h1>
    <!-- <div id="box4"> -->
    <?php
    
    $userId = $_SESSION['user_id'];

    echo '<table id="questionTable">
            <thead>
                <tr>
                    <th style="text-align: center;">Pregunta</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>';



    try {
        $dsn = "mysql:host=localhost;dbname=p2_votos";
        $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
        $query = $pdo->prepare("SELECT DISTINCT q.question, o.option_text FROM questions q JOIN options o ON q.question_id = o.question_id JOIN votes v ON o.option_id= v.option_id JOIN invitations i ON q.question_id = i.question_id JOIN users u ON u.email = v.email WHERE i.token_status = false AND u.user_id
        = $userId;");
        $query->execute();

        while ($row = $query->fetch()) {
            $question = $row['question'];
            $option = $row['option_text'];

            echo '<tr>';
            echo '<td>' . $question . '</td>';
            echo '<td class="inline-container">
                    <button class="showOption">Mostrar opción votada</button>
                    <h4 class="optionVoted" style="display:none;">'.$option.'</h4>
                </td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<script>
    $(document).ready(function() {
        $(".showOption").click(function() {
            $(this).siblings(".optionVoted").toggle();
            
            // Cambiar el texto del botón
            var buttonText = $(this).text();
            $(this).text(buttonText === "Mostrar opción votada" ? "Ocultar opción votada" : "Mostrar opción votada");
        });
    });
</script>';

    } catch (PDOException $e) {
        registrarEvento("ERROR LIST POLL (ID USER: $userId): " . $e->getMessage());
        echo $e->getMessage();
    }
?>

    <!-- </div> -->
    <?php include('footer.php'); ?>
</body>
</html>
<?php
}
?>

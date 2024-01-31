<?php 
session_start();
$_SESSION['page'] = 'create_poll';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    http_response_code(403);
    include('errores/error403.php');
    exit;
} else {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    <title>Creación Encuesta</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="create_poll.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
<?php
    include('header.php');
    ?>

    <h1 id="reg">Creación Encuesta</h1>

    <?php
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['usuario'];
    include('sistemLog.php');
    if (isset($_POST['question'])) {
        $creator = $_SESSION['user_id'];
        $question = $_POST["question"];
        $start = date("Y-m-d H:i:s", strtotime($_POST["start"])); 
        $end = date("Y-m-d H:i:s", strtotime($_POST["end"])); 

        try {
            $dsn = "mysql:host=localhost;dbname=p2_votos";
            $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
            $query = $pdo->prepare("INSERT INTO questions (date_start, date_end, question, creator_id) VALUES (:date_start, :date_end, :question, :creator_id)");
            $query->bindParam(':date_start', $start, PDO::PARAM_STR);
            $query->bindParam(':date_end', $end, PDO::PARAM_STR);
            $query->bindParam(':question', $question, PDO::PARAM_STR);
            $query->bindParam(':creator_id', $creator, PDO::PARAM_INT);
            $query->execute();

            $question_id = $pdo->lastInsertId();
            $options = isset($_POST["option"]) ? $_POST["option"] : [];

            if (!empty($options)) {

                foreach ($options as $option) {
                    $option_query = $pdo->prepare("INSERT INTO options (question_id, option_text) VALUES (:question_id, :option_text)");
                    $option_query->bindParam(':question_id', $question_id, PDO::PARAM_INT);
                    $option_query->bindParam(':option_text', $option, PDO::PARAM_STR);
                    $option_query->execute();

                    if ($option_query->rowCount() > 0) {
                    } else {
                        registrarEvento("ERROR CREATE POLL (ID USER: $userId): Al insertar la opcion '$option'");
                        echo "Error al insertar la opción '$option'<br>";
                    }
                }
                registrarEvento("CREATE POLL (ID USER: $userId): Encuesta de '$question' creada correctamente!!");
                echo '<div id="poll_created" class="container">
                <div id="box">
                    <form action="list_polls.php" method="POST">
                        <h4>Encuesta creada correctamente!!</h4>
                        <input type="hidden" value='.$question_id.' name="questionId"/>
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
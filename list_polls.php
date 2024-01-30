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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...." crossorigin="anonymous" />
    <title>Listado encuestas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="list_polls.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>

    <h1 id="reg">Listado de Encuestas</h1>

    <?php
    $userId = $_SESSION['user_id'];
    echo '<table id="questionTable">
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Estado</th>
                </tr>
            </thead>';
    try {
        $dsn = "mysql:host=localhost;dbname=p2_votos";
        $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
        $query = $pdo->prepare("SELECT * FROM questions WHERE creator_id = $userId ORDER BY question_id DESC;");
        $query->execute();
        $row = $query->fetch();
        $correct = false;
        $use= true;
        echo '<tbody>';
        while ($row) {
            if(isset($_POST['questionId']) && $use){
                $question = $row['question'];
                echo '<tr style="border: 2px solid black; font-weight: bold;">';
                echo '<td>' . $question . '</td>';
                echo '<td>Activa</td>';
                echo '</tr>';
                $row = $query->fetch();
                $correct = true;
                $use = false;
            }else{
            $question = $row['question'];
            echo '<tr>';
            echo '<td>' . $question . '</td>';
            echo '<td>Activa</td>';
            echo '</tr>';
            $row = $query->fetch();
            $correct = true;}
        }
        echo '</tbody>';
        if (!$correct) {
            echo ' <div class="error-window">
            <div class="title-bar">
                <div class="close-button"></div>
            </div>
            <div class="content">
                <img src="img/error.png" alt="Error Image" class="error-image">
                <div class="text-and-button">
                    <h2>Error</h2>
                    <p>No existen encuestas creadas</p>
                    <button class="accept-button">Aceptar</button>
                </div>
            </div>
        </div>';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

    </table>

    <?php include('footer.php'); ?>
</body>
</html>
<?php
}
?>

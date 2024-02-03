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
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php include('header.php'); ?>

    <h1 id="reg">Listado de Encuestas</h1>

    <?php
    $userId = $_SESSION['user_id'];
    echo '<table id="questionTable">
            <thead>
                <tr>
                    <th style="text-align: center";>Pregunta</th>
                    <th style="text-align: center";>Estado</th>
                    <th colspan="2" style="text-align: center";>Acciones</th>
                </tr>
            </thead>';
    include('sistemLog.php');
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
                $questionId = $row['question_id'];
                echo '<tr style="border: 2px solid black; font-weight: bold;">';
                echo '<td>' . $question . '</td>';

                echo '<td style="text-align: center";>';
                    if ($row["estadoPregunta"] == "hidden") {
                        echo "<span class='visibilityPollItem'>Oculto</span>";
                    } else if ($row["estadoRespuesta"] == "public") {
                        echo "<span class='visibilityPollItem'>Público</span>";
                    } else {
                        echo "<span class='visibilityPollItem'>Privado</span>";
                    }
                echo '</td>';
                echo '<form action="detailsPoll.php" method="POST">';
                echo '<input style="text-align: center"; type="hidden" name="questionId" value='.$questionId.'></input>';
                echo '<td style="text-align: center";><button style="text-align: center";>Detalles</button></td>';
                echo '</form>';
                echo '<form action="inviteVoters.php" method="POST">';
                echo '<input type="hidden" name="questionId" value='.$questionId.'></input>';
                echo '<td style="text-align: center";><button style="text-align: center";>Invitar</button></td>';
                echo '</form>';
                echo '</tr>';
                $row = $query->fetch();
                $correct = true;
                $use = false;
            }else{
            $question = $row['question'];
            $questionId = $row['question_id'];
            echo '<tr>';
            echo '<td>' . $question . '</td>';
            echo '<td>';
                    if ($row["estadoPregunta"] == "hidden") {
                        echo "<span class='visibilityPollItem'>Oculto</span>";
                    } else if ($row["estadoRespuesta"] == "public") {
                        echo "<span class='visibilityPollItem'>Público</span>";
                    } else {
                        echo "<span class='visibilityPollItem'>Privado</span>";
                    }
                echo '</td>';
                echo '<form action="detailsPoll.php" method="POST">';
                echo '<input type="hidden" name="questionId" value='.$questionId.'></input>';
                echo '<td><button>Detalles</button></td>';
                echo '</form>';
                echo '<form action="inviteVoters.php" method="POST">';
                echo '<input type="hidden" name="questionId" value='.$questionId.'></input>';
                echo '<td><button>Invitar</button></td>';
                echo '</form>';
            echo '</tr>';
            $row = $query->fetch();
            $correct = true;}
        }
        echo '</tbody>';
        if (!$correct) {
            registrarEvento("ERROR LIST POLL (ID USER: $userId): No existen encuestas creadas");

            echo '<div class="error-window">
                    <div class="title-bar"></div>
                    <div class="content">
                        <div class="text-and-button">
                            <h2>INFORMACIÓN</h2>
                            <p>De momento no existen encuestas creadas</p>
                        </div>
                    </div>
                </div>';
            echo '<script>';
            echo 'var errorWindow = $(".error-window");';
            echo 'var closeButton = $("<button>").addClass("accept-button").text("Aceptar").click(function () {';
            echo '$("body").css("filter", "none");';
            echo 'errorWindow.remove();';
            echo '});';
            echo 'errorWindow.find(".text-and-button").append(closeButton);';
            echo '</script>';
        }
    } catch (PDOException $e) {
        registrarEvento("ERROR LIST POLL (ID USER: $userId): ". $e->getMessage());
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

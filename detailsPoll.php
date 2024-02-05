<?php
session_start();
$_SESSION['page'] = 'detailsPoll';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
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
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />

    <script src="https://kit.fontawesome.com/8946387bf5.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.js"></script>
    <title>Detalles de Encuesta</title>
    <script src="detailsPoll.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    <h1 id="reg">Detalles de la Encuesta</h1>
    <?php
    include('sistemLog.php');
    try {
        $hostname = "localhost";
        $dbname = "p2_votos";
        $username = "martimehdi";
        $pw = "P@ssw0rd";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        registrarEvento("DETAILS POLL: Failed to get DB handle: " . $e->getMessage() . "\n");
        exit;
    }
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['QuestionVisibility']) && isset($_POST['AnswerVisibility'])){
            $questionVisibility = $_POST['QuestionVisibility'];
            $answerVisibility = $_POST['AnswerVisibility'];
            $id= $_SESSION['questionId'];
            $querystr = "UPDATE questions SET estadoPregunta = ?, estadoRespuesta = ? WHERE question_id = ?";
            $query = $pdo->prepare($querystr);
            $query->execute([$questionVisibility, $answerVisibility, $id]);
        }

    }
    ?>
    <div class="container">
    <div id="box2">
    <?php 
    
        try {
            try {
                $hostname = "localhost";
                $dbname = "p2_votos";
                $username = "martimehdi";
                $pw = "P@ssw0rd";
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                registrarEvento("DETAILS POLL: Failed to get DB handle: " . $e->getMessage() . "\n");
                exit;
            }
            

            
            $query = $pdo->prepare("SELECT * FROM questions WHERE question_id = ?");
            $id= $_SESSION['questionId'];
            $query->bindParam(1, $id);
            $query->execute();
            
            $row = $query->fetch();
            $correct = false;
            $questions = 0;
            if ($row) {
                echo "<div class='pollTextDetails'>";
                echo "<h2>Pregunta: ".$row["question"]."</h2>";

                echo  "<div id='box3'>";

                $startDate = new DateTime($row["date_start"]);
                echo "<h4>Fecha de inicio: ".$startDate->format("d/m/Y h:i")."</h4>";
                $endDate = new DateTime($row["date_end"]);
                echo "<h4>Fecha de fin: ".$endDate->format("d/m/Y h:i")."</h4>";
                echo "<br>";

                echo "<h4>Estado de publicación:   ";
                echo "<select id='questionVisibility'>";
                echo "<option value='hidden' ".($row["estadoPregunta"] == "hidden" ? "selected" : "").">Oculto</option>";
                echo "<option value='public' ".($row["estadoPregunta"] == "public" ? "selected" : "").">Público</option>";
                echo "<option value='private' ".($row["estadoPregunta"] == "private" ? "selected" : "").">Privado</option>";
                echo "</select></h4>";
                echo "<h4>Estado de resultados:   ";
                echo "<select id='answerVisibility'>";
                echo "<option value='hidden' ".($row["estadoRespuesta"] == "hidden" ? "selected" : "").">Oculto</option>";
                echo "<option value='public' ".($row["estadoRespuesta"] == "public" ? "selected" : "").">Público</option>";
                echo "<option value='private' ".($row["estadoRespuesta"] == "private" ? "selected" : "").">Privado</option>";
                echo "</select></h4>";
                echo "<br>";
                echo "<button id='saveChanges'>Guardar cambios</button>";
                echo "</div>";
                echo "</div>";


                $query = $pdo->prepare("SELECT COUNT(*) as vote_count
                                    FROM options
                                    WHERE question_id = ?;");
                $query->bindParam(1, $id);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $vote_count = $result['vote_count'];
                    echo "<h1>Votos realizados: $vote_count</h1>";
                } else {
                    echo "<h1>No hay votos para la encuesta seleccionada</h1>";
                }




                echo "
                <div id='pollGraphs'>
                    <div id='pollGraphButtons'>
                        <button id='barChartButton' disabled>Barras</button>
                        <button id='pieChartButton'>Pastel</button>
                    </div>
                    <br>
                    <div id='graphContainer'>
                        <canvas id='graph'  width='400px' height='200px'>
                        </canvas>
                    </div>
                </div>
                ";
            }

            $query = $pdo->prepare("SELECT a.option_id AS ID,a.option_text AS nombreVoto,
                                    COUNT(v.vote_id) AS contador
                                    FROM options a
                                    JOIN votes v ON a.option_id = v.option_id
                                    JOIN questions q ON a.question_id = q.question_id
                                    WHERE q.question_id = ?
                                    GROUP BY a.option_id;");
            $query->bindParam(1, $id);

            $query -> execute();
            $row = $query->fetch();
            echo "<script>\n";
            echo "getVotes([";
            
            while ($row) {
                echo "{answer:'".$row["nombreVoto"]."', count:".$row["contador"]."},";
                $row = $query->fetch();
            }
            echo "]);";
            echo "</script>";
        } catch (PDOException $e){
            echo $e->getMessage();
            registrarEvento("DETAILS POLL: Failed to get DB handle: " . $e->getMessage() . "\n");

        }
    ?>
    <form id="hiddenForm" style="display: none" method="POST">
    </form>
    </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
<?php
}
?>
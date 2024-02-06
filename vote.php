<?php 
session_start();
$_SESSION['page'] = 'Vote';

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
    session_start();
    include('header.php');
    include('sistemLog.php');

        $token = $_GET['token'];
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

        if(isset($_GET['token']) && !isset($_POST['vote'])) {
            $_SESSION['available'] = true;
            $token = $_GET['token'];
            $_SESSION['token'] = $token;
            $_SESSION['token_status'] = $token_status;
            // Buscar el token en la base de datos
            $querystr = "SELECT * FROM invitations WHERE token = ?";
            $query = $pdo->prepare($querystr);
            $query->execute([$token]);
            if ($query->rowCount() > 0) {
                $invitation = $query->fetch();
                $question_id = $invitation['question_id'];
                $email = $invitation['email'];
      
                if($invitation['token_status']){

                // Verificar si el token ya ha sido aceptado
               
                    // Marcar el token como aceptado
                    $querystr = "SELECT * FROM questions WHERE question_id = :question_id";
                    $query = $pdo->prepare($querystr);

                    // Asignar el valor del parámetro
                    $query->bindParam(':question_id', $question_id, PDO::PARAM_INT);

                    // Ejecutar la consulta
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div id="box2">
                        <div id="voting-container">
                        <h2 id="vote" >'.$row['question'].'</h2>';
                        echo '<form action="vote.php" method="post">';
                        echo'<input type="hidden" value="'.$question_id.'" name="questionId"></input>';
                        echo'<input type="hidden" value="'.$email.'" name="email"></input>';
                        echo '<input type="hidden" value="'.date('Y-m-d H:i:s').'" name="date">';
                    }
                    $querystr = "SELECT * FROM options WHERE question_id = :question_id";
                    $query = $pdo->prepare($querystr);

                    // Asignar el valor del parámetro
                    $query->bindParam(':question_id', $question_id, PDO::PARAM_INT);

                    // Ejecutar la consulta
                    $query->execute();
                    echo '<div class="options-container">';
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '
                        <div class="option">
                            <input type="radio" name="vote" id='.$row['option_id'].' value="'.$row['option_id'].'">
                            <label for="'.$row['option_id'].'">'.$row['option_text'].'</label>
                        </div>';
                        
                    }
                    echo '</div>
                    
                            <button id="send-button">Enviar Votación</button>
                        </form>
                        </div>
                        </div>';
                }else{
                    registrarEvento("VOTOS ERROR: Inteto de realizar un voto de nuevo!!");
                    echo '<div id="account_created" class="container">
                    <div id="box">
                        <form action="index.php" method="POST">
                            <h4>Error, el voto ya a sido efectuado!!</h4>
                            <button class="accept-button" type="submit">Aceptar</button>
                        </form>
                    </div>
                </div>';
                include('footer.php');
                exit;
                }
                    
                //
                
            } else {
                registrarEvento("VOTOS ERROR: Un token inexistente!!");
                header("Location: errores/error404.php");
                include('footer.php');

                exit;
            }
        } elseif(isset($_POST['vote'])){

            if($_SESSION['available']){

                $date = $_POST['date'];
                $email = $_POST['email'];
                $vote = $_POST['vote'];
                // echo $date." ";
                // echo $email." ";
                // echo $vote." ";
                $querystr = "INSERT INTO votes (option_id, email, vote_date) VALUES (:optionId, :email, :currentDate)";
                $query = $pdo->prepare($querystr);

                // Asignar los valores a los parámetros
                $query->bindParam(':optionId', $vote, PDO::PARAM_INT);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->bindParam(':currentDate', $date, PDO::PARAM_STR);

                // Ejecutar la consulta
                $query->execute();

                $token = $_SESSION['token'];
                // echo $token;
                $updateQuery = $pdo->prepare("UPDATE invitations SET token_status = FALSE WHERE token = :token");
                $updateQuery->bindParam(':token', $token);
                $updateQuery->execute();
                $_SESSION['available'] = false;
                registrarEvento("VOTOS CONFIRMADO: Voto realizado correctamente!");
                echo '<div id="account_created" class="container">
                        <div id="box">
                            <form action="index.php" method="POST">
                            <h3>Voto realizado correctamente!!</h3>
                            <h4>¡Gracias por tu voto!</h4>
                            <button class="accept-button" type="submit">Aceptar</button>
                            </form>
                        </div>
                    </div>';
                    include('footer.php');
                    exit;   
            } else {
                
            }   
        }  
    ?>
    
        


    <?php
    
    include('footer.php');

    ?>

</body>
</html>



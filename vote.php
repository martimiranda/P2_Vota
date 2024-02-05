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
    include('header.php');

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

        if(isset($_GET['token'])) {
            $token = $_GET['token'];
        
            // Buscar el token en la base de datos
            $querystr = "SELECT * FROM invitations WHERE token = ?";
            $query = $pdo->prepare($querystr);
            $query->execute([$token]);
            if ($query->rowCount() > 0) {
                $invitation = $query->fetch();
                $question_id = $invitation['question_id'];

        
                // Verificar si el token ya ha sido aceptado
               
                    // Marcar el token como aceptado
                    $querystr = "SELECT * FROM questions WHERE question_id = :question_id";
                    $query = $pdo->prepare($querystr);

                    // Asignar el valor del parámetro
                    $query->bindParam(':question_id', $question_id, PDO::PARAM_INT);

                    // Ejecutar la consulta
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div id="voteBox">
                        <div id="voting-container">
                        <h2 id="vote" >'.$row['question'].'</h2>
                    
                        <div class="options-container">
                        <div class="option">
                            <input type="radio" name="vote" id="option1">
                            <label for="option1">Opción 1</label>
                        </div>
                    
                        <div class="option">
                            <input type="radio" name="vote" id="option2">
                            <label for="option2">Opción 2</label>
                        </div>
                    
                        <div class="option">
                            <input type="radio" name="vote" id="option3">
                            <label for="option3">Opción 3</label>
                        </div>
                        </div>
                    
                            <button id="send-button">Enviar Votación</button>
                        </div>
                        </div>';
                    }
                  
                
            } else {
                echo "Token inválido.";
            }
        } else {
            echo "Token no proporcionado.";
        }

        

        
    
    ?>
    
        


    <?php
    
    include('footer.php');

    ?>

</body>
</html>



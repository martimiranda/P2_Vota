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

    if(isset($_POST['anonymous'])){
        $anonymous = $_POST['anonymous'];
        if($anonymous == 'si'){
            echo '<div id="voteBox">
        <div id="voting-container">
        <h2>¿Cuál es tu opción favorita?</h2>
    
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
        } else{

        }
        
    }else{
        echo '<div id="voteBox">
        <div id="anonymous-container">
            <h2>¿Deseas que tu encuesta sea anónima?</h2>
        
            <form action="vote.php" method="post">
              <div class="option">
                <input type="radio" name="anonymous" id="yes" value="si">
                <label for="yes">Sí, quiero que sea anónima</label>
              </div>
        
              <div class="option">
                <input type="radio" name="anonymous" id="no" value="no">
                <label for="no">No, quiero que sea pública</label>
              </div>
        
              <button type="submit" id="send-button">Enviar Opción</button>
            </form>
          </div>
</div>';
    }
    ?>
    
        


    <?php
    
    include('footer.php');

    ?>

</body>
</html>



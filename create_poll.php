<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación Encuesta</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="create_poll.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start();
    if(isset($_POST['question'])){
    $creator = $_SESSION['user'];
    $question = $_POST["question"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    
    $options = isset($_POST["option"]) ? $_POST["option"] : [];

    echo "Pregunta: $question<br>";
    echo "Fecha de inicio: $start<br>";
    echo "Fecha de fin: $end<br>";

    if (!empty($options)) {
        echo "Opciones seleccionadas:<br>";
        foreach ($options as $option) {
            echo "$option<br>";
        }
    } else {
        echo "No se seleccionaron opciones.";
    }

    }
    ?>
</body>
</html>
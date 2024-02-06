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
                <th style="text-align: center;" colspan="2">Pregunta</th>
                <th style="text-align: center;" colspan="1">Acciones</th>
            </tr>
        </thead>
        </table>';





        
    include('sistemLog.php');
    
    ?>

    </table>
    <!-- </div> -->
    <?php include('footer.php'); ?>
</body>
</html>
<?php
}
?>

<?php
session_start();
$_SESSION['page'] = 'register'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8mb4">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="register.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php
    include('header.php');
    ?>
    <h1 id="reg">Pagina de Registro</h1>
    <?php
    include('sistemLog.php');

try {
    $dsn = "mysql:host=localhost;dbname=p2_votos;charset=utf8";
    $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    $query = $pdo->prepare("select name from countries;");
    $query->execute();
    $row = $query->fetch();
    $correct = false;
    $arrayCountries = [];
    while ( $row ) {
        array_push($arrayCountries,$row['name']);
        $row = $query->fetch();
        $correct=true;
    }
    if(!$correct){
        registrarEvento("ERROR REGISTER: No encuetra la tabla de paises");
        echo "No encuetra la tabla de países";
    }
    } catch (PDOException $e){
        registrarEvento("REGISTER: ".$e->getMessage());
        echo $e->getMessage();
    }
    echo '<script>var countries_php = ' . json_encode($arrayCountries) . ';</script>';
    if(isset($_POST['user'])){
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        $mail = $_POST['email'];
        $phone = $_POST['tel'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $code = $_POST['postal'];

        try {

            $query = $pdo->prepare("SELECT name FROM users WHERE email LIKE :mail OR phone = :phone");
            
            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
            
            $query->execute();
            
            $row = $query->fetch();
            
            if ($row) {
                registrarEvento("ERROR REGISTER: Ya existe una cuenta asociada con $user o el tel $phone");
                echo ' <div class="error-window">
                <div class="title-bar">
                    <div class="close-button"></div>
                </div>
                <div class="content">
                    <img src="img/error.png" alt="Error Image" class="error-image">
                    <div class="text-and-button">
                        <h2>Error</h2>
                        <form action="register.php">
                        <p>Ya existe una cuenta asociada con estos datos de registro</p>
                        <button class="accept-button">Aceptar</button>
                        </form>
                    </div>
                </div>
            </div>';
            } else {
                registrarEvento("REGISTER: Cuenta de $user creada correctamente!!");
                echo '<div id="account_created" class="container">
                <div id="box">
                    <form action="index.php" method="POST">
                        <h4>Cuenta creada correctamente!!</h4>
                        <button class="accept-button" type="submit">Aceptar</button>
                    </form>
                </div>
            </div>';
                try {
                    $query = $pdo->prepare("INSERT INTO users (name, email, password, phone, country_name, city, postal_code)
                            VALUES (:user, :mail, SHA2(:pwd, 512), :phone, :country, :city, :code)");
    
                            $query->bindParam(':user', $user, PDO::PARAM_STR);
                            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
                            $query->bindParam(':pwd', $pwd, PDO::PARAM_STR);
                            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
                            $query->bindParam(':country', $country, PDO::PARAM_STR);
                            $query->bindParam(':city', $city, PDO::PARAM_STR);
                            $query->bindParam(':code', $code, PDO::PARAM_INT);
                            
                            $query->execute();

                            $correct = ($query->rowCount() > 0);

                            if (!$correct) {
                                //echo "incorrecto";
                            } else {
                                //echo "correcto";
                            }
                    } catch (PDOException $e){
                        registrarEvento("ERROR REGISTER: ". $e->getMessage());
                        echo $e->getMessage();
                    }
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            registrarEvento("ERROR REGISTER: ". $e->getMessage());
        }
        
            
    }
?>
    <?php
    include('footer.php');
    ?>
</body>

</html>

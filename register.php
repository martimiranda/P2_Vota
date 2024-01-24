<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <h1>REGISTRO MARGOMI VOTOS</h1>
        <div class="menu">
            <a class='menul' href='index.php'><h2>inicio</h2></a>
            <a class='menul' href='register.php'><h2>registrarse</h2></a>
        </div>
    </header>
    <h1 id="reg"></h1>
    <?php
try {
    $dsn = "mysql:host=localhost;dbname=p2_votos";
    $pdo = new PDO($dsn, 'marti', 'M*12_EGbb56');
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
        echo "incorrecto";
    }
    } catch (PDOException $e){
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
                echo ' <div class="error-window">
                <div class="title-bar">
                    <div class="close-button"></div>
                </div>
                <div class="content">
                    <img src="error.png" alt="Error Image" class="error-image">
                    <div class="text-and-button">
                        <h2>Error</h2>
                        <p>Ya existe una cuenta asociada a este correo electrónico</p>
                        <button class="accept-button">Aceptar</button>
                    </div>
                </div>
            </div>';
            } else {
                //echo "Cuenta creada con exito";
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
                        echo $e->getMessage();
                    }
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
            
    }
?>
<footer>
        <div id="contacte">
            <h2>Contactos</h2>
            <div id="contactes">
                <div id="contacte1">
                    <h4>Marcelo González</h4>
                    <p>
                        Teléfon: <a href="tel:+661794022">661-794-022</a><br>
                        Gmail: <a href="mailto:marcelogr2004@gmail.com">marcelogr2004@gmail.com</a><br>
                        Instagram: <a href="https://www.instagram.com/mgonnzalezz" target="_blank">@mgonnzalezz</a>
                    </p>
                </div>
                <div id="contacte2">
                    <h4>Martí Miranda</h4>
                    <p>
                        Teléfon: <a href="tel:+123456789">689-667-587</a><br>
                        Gmail: <a href="mailto:info@example.com">martimiranda2356@gmail.com</a><br>
                        Instagram: <a href="https://www.instagram.com/martimiranda" target="_blank">@martimiranda</a>
                    </p>
                </div>
            </div>
        </div>
        
        <div id="enllacos">
            <h2>Enlaces</h2>
            <p>
                Instituto: <a href="https://www.iesesteveterradas.cat/" target="_blank">Institut Esteve Terrades</a><br>
                GitHub: <a href="https://github.com/Marcelogr04/P2_Vota.git" target="_blank">GitHub</a>
            </p>
        </div>
    </footer>
</body>

</html>
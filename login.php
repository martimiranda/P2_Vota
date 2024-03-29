<?php
session_start();
$_SESSION['page'] = 'login';
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
</head>
<body>
    <?php
    include('header.php');
    ?>
        <h1 id="reg">Login</h1>

        <div class="container">
                <div id="box2">
                <h1 style="text-align: left;">Iniciar sesión</h1>
                    <form action="login.php" method="post">
                        <label for="email">Email:</label>
                        <input type="email" name="email" required>

                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" required>

                        <button type="submit">Logearse</button>
                    </form>
                </div>
        </div>
    <?php

        //phpinfo();
        include('sistemLog.php');

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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $contraseña = $_POST["password"];

            $querystr = "SELECT * FROM users WHERE email=:email AND password=SHA2(:contrasena, 512)";
            $query = $pdo->prepare($querystr);

            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':contrasena', $contraseña, PDO::PARAM_STR);

            $query->execute();

            
            $filas = $query->rowCount();
            if ($filas > 0) {
                $usuario = $query->fetch(PDO::FETCH_ASSOC);
                $_SESSION['usuario'] = $usuario["name"];
                $_SESSION['user_id'] = $usuario["user_id"]; 
                $token_status = $usuario["token_status"];
                $conditions_status = $usuario["conditions_status"];
                
                if ($token_status) {
                    registrarEvento("LOGIN: ".$_SESSION["usuario"]. " ha iniciado sesión");

                    echo '<div class="error-window">
                            <div class="title-bar">
                                <div class="close-button"></div>
                            </div>
                            <div class="content">
                                <div id="contenedor">
                                    <div class="loader" id="loader">Loading...</div>
                                </div>
                                <div class="text-and-button">
                                    <h3>Hola '. $usuario["name"].'</h3>
                                    <form action="login.php">
                                        <h4>Iniciando sesión...</h4>
                                    </form>
                                </div>
                            </div>
                        </div>';
                    if ($conditions_status){
                        echo '<script>
                                setTimeout(function() {
                                    window.location.href = "dashboard.php";
                                }, 2000); // 2000 milliseconds (2 seconds)
                            </script>';
                    } else {
                        echo '<script>
                                setTimeout(function() {
                                    window.location.href = "verificar_terminos.php";
                                }, 2000); // 2000 milliseconds (2 seconds)
                            </script>';
                    }
                    
                } else {
                    registrarEvento("ERROR LOGIN: Usuario ".$_SESSION["usuario"]. " No a validado el correo");
                    echo '<div class="error-window">
                        <div class="title-bar">
                            <div class="close-button"></div>
                        </div>
                        <div class="content">
                            <img src="img/error.png" alt="Error Image" class="error-image">
                            <div class="text-and-button">
                                <h2>Notificación</h2>
                                <form action="login.php">
                                    <p>Su correo no ha sido validado. Por favor, verifique su correo electrónico para completar el proceso de registro....</p>
                                    <button class="accept-button">Aceptar</button>
                                </form>
                            </div>
                        </div>
                    </div>';

                    echo '<script>';
                    echo 'var closeButton = $("<div>").addClass("close-button").click(function () {';
                    echo '$("body").css("filter", "none");';
                    echo 'errorWindow.remove();';
                    echo '});';
                    echo '</script>';
                }
            } else {
                registrarEvento("ERROR LOGIN: Usuario o contraseña incorrectos");
                echo '<div class="error-window">
                    <div class="title-bar">
                        <div class="close-button"></div>
                    </div>
                    <div class="content">
                        <img src="img/error.png" alt="Error Image" class="error-image">
                        <div class="text-and-button">
                            <h2>Error</h2>
                            <form action="login.php">
                                <p>Usuario o contraseña incorrectos</p>
                                <button class="accept-button">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>';

                echo '<script>';
                echo 'var closeButton = $("<div>").addClass("close-button").click(function () {';
                echo '$("body").css("filter", "none");';
                echo 'errorWindow.remove();';
                echo '});';
                echo '</script>';
            }
            unset($pdo);
            unset($query);
        }
    
    ?>
    <?php
    include('footer.php');
    ?>

</body>
</html>
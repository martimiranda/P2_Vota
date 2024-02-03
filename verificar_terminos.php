<?php
session_start();
$_SESSION['page'] = 'logout';
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    http_response_code(403);
    include('errores/error403.php');
    exit;
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
    <link rel="stylesheet" href="style.css?no-cache=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="img/vote_icon_logo.png" />
</head>
<body>
    <?php
    include('header.php');
    ?>
    <h1 id="reg"></h1>
    <div class="container">
        <div id="box2">
            <form method="post">
                <h2>Aceptación de Condiciones para la Página Web Votaieti:</h2>
                <label for="acceptTerms">Al utilizar Votaieti, aceptas nuestra política de privacidad y seguridad. Comprometidos con tu confidencialidad, no compartimos tus datos sin consentimiento. Utiliza la plataforma de manera ética y legal, respetando derechos de propiedad intelectual. Aceptas recibir comunicaciones relacionadas con la plataforma. Nos reservamos el derecho de terminar cuentas por violaciones o actividades perjudiciales. ¡Gracias por ser parte de Votaieti!</label>
                <br><br>
                <input type="checkbox" id="acceptTerms" name="acceptTerms" required>
                <label for="acceptTerms">Acepto los términos y condiciones    </label>
                <button type="submit">Aceptar</button>
            </form>
        </div>
    </div>
    <?php
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
            if (isset($_POST["acceptTerms"])) {
                if(isset($_SESSION['user_id'])) {
                    
                    
                    // Marcar el token como aceptado
                    $querystr = "UPDATE users SET conditions_status = TRUE WHERE user_id = ?";
                    $query = $pdo->prepare($querystr);
                    $query->execute([$_SESSION['user_id']]);
                    


                    include('footer.php');
                    echo '<div class="error-window">
                            <div class="title-bar">
                                <div class="close-button"></div>
                            </div>
                            <div class="content">
                                <div id="contenedor">
                                    <div class="loader" id="loader">Loading...</div>
                                </div>
                                <div class="text-and-button">
                                    <h3>CONDICIONES</h3>
                                    <form action="login.php">
                                        <h4>Aceptando condiciones...</h4>
                                    </form>
                                </div>
                            </div>
                        </div>';
                    echo '<script>
                                setTimeout(function() {
                                    window.location.href = "dashboard.php";
                                }, 2000); // 2000 milliseconds (2 seconds)
                            </script>';
                } else {
                    echo "Id usuario no disponible";
            }
            }
        }
    }

    ?>



</body>
</html>
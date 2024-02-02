<?php
session_start();
$_SESSION['page'] = 'logout'
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

        if(isset($_GET['token'])) {
            $token = $_GET['token'];
        
            // Buscar el token en la base de datos
            $querystr = "SELECT * FROM users WHERE token = ?";
            $query = $pdo->prepare($querystr);
            $query->execute([$token]);
            if ($query->rowCount() > 0) {
                $user = $query->fetch();
        
                // Verificar si el token ya ha sido aceptado
                if ($user['token_status']) {
                    // Redirigir al usuario a la página de error 404
                    header("Location: errores/error404.php");
                    exit;
                } else {
                    // Marcar el token como aceptado
                    $querystr = "UPDATE users SET token_status = TRUE WHERE token = ?";
                    $query = $pdo->prepare($querystr);
                    $query->execute([$token]);
        
                    echo '<script>
                            setTimeout(function() {
                                window.location.href = "login.php";
                            }, 1000); // 1000 milliseconds (1 seconds)
                        </script>';
                    exit;
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
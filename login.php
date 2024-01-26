<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('header.php');
    ?>
        <div class="container">
            <div id="box">
                <h1 style="text-align: left;">Login</h1>
                <form action="login.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" required>

                    <button type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>

    <section>

    </section>
    <?php
    include('footer.php');
    ?>
</body>
</html>
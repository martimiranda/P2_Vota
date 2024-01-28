<?php

if ($_SESSION['page'] == 'register' || $_SESSION['page'] == 'login') {
    ?>
    <header>
    <!-- <h1>REGISTRO MARGOMI VOTOS</h1>  -->
    <a style="text-decoration: none;" href='index.php'><h1>MARGOMI VOTOS</h1></a>
    <div class="menu">
        <a class='menul' href='login.php'><h2>Logearse</h2></a>
        <a class='menul' href='register.php'><h2>Registrarse</h2></a>
    </div>
</header>
<?php
}    
?>

<?php
if ($_SESSION['page'] == 'index' ) {
    ?>
    <header>
    <!-- <h1>REGISTRO MARGOMI VOTOS</h1>  -->
    <h1>MARGOMI VOTOS</h1>
    <div class="menu">
        <a class='menul' href='login.php'><h2>Logearse</h2></a>
        <a class='menul' href='register.php'><h2>Registrarse</h2></a>
    </div>
</header>
<?php
}    
?>

<?php
if ($_SESSION['page'] == 'dashboard') {
    ?>
    <header>
    <!-- <h1>REGISTRO MARGOMI VOTOS</h1>  -->
    <h1>Hola, <?php echo $_SESSION['usuario'] ?></h1>
    <div class="menu">
        <a class='menul' href='logout.php'><h2>Cerrar sessión</h2></a>
    </div>
</header>
<?php
}    
?>


<?php

if ($_SESSION['page'] == 'register' || $_SESSION['page'] == 'login') {
    ?>
    <header>
    <h1>MARGOMI VOTOS</h1>

    <div class="menu">
        <a class='menul' href='index.php'><h2>Inicio</h2></a>
        <?php
            if ($_SESSION['page'] == 'register' ) {
        ?>
            <a class='menul' href='login.php'><h2>Logearse</h2></a>
        <?php
            } else {
        ?>
            <a class='menul' href='register.php'><h2>Registrarse</h2></a>
        <?php
            } 
        ?>
    </div>
</header>
<?php
}    
?>

<?php
if ($_SESSION['page'] == 'index' ) {
    ?>
    <header>
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
    <h1>MARGOMI VOTOS</h1>
    <h2 class="usuario_log">Hola, <?php echo $_SESSION['usuario'] ?></h2>
    <div class="menu">
        <a class='menul' href='logout.php'><h2>Cerrar sesión</h2></a>
    </div>
</header>
<?php
}    
?>
<?php
if ($_SESSION['page'] == 'create_poll' || $_SESSION['page'] == 'list_polls' || $_SESSION['page'] == 'Invite Voters') {
    ?>
    <header>
        <h1>MARGOMI VOTOS</h1>
        <h2 class="usuario_log"><i class="fas fa-user"></i><?php echo "  ".$_SESSION['usuario'] ?></h2>
        <div class="menu">
            <a class='menul' href='dashboard.php'><h2>Panel de control</h2></a>
            <a class='menul' href='logout.php'><h2>Cerrar sesión</h2></a>
        </div>
    </header>
<?php
}    
?>

<?php

if ($_SESSION['page'] == 'logout') {
    ?>
    <header>
    <a style="text-decoration: none;" href='index.php'><h1>MARGOMI VOTOS</h1></a>
</header>
<?php
}    
?>
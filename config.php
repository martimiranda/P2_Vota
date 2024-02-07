<?php
$gestor = fopen('/var/www/html/P2_Vota/config.txt', 'r');
if ($gestor) {
    $email = trim(fgets($gestor));
    $password = trim(fgets($gestor));
    // Cierra el archivo
    fclose($gestor);
}
?>
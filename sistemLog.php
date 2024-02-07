<?php
$logDirectory = "/var/www/html/P2_Vota/sistemErrorLogs/";
$archivoLog = $logDirectory . "log_" . date("Y-m-d") . ".txt";
date_default_timezone_set('Europe/Madrid');
function registrarEvento($mensaje) {
    global $archivoLog;

    $mensajeRegistro = "[" . date("Y-m-d H:i:s") . "] $mensaje" . PHP_EOL;

    file_put_contents($archivoLog, $mensajeRegistro, FILE_APPEND | LOCK_EX);
}
?>
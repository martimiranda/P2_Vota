<?php
$logDirectory = "sistemErrorLogs/";
$logDirectory2 = "/var/www/html/P2_Vota/sistemErrorLogs/";

$archivoLog = $logDirectory . "log_" . date("Y-m-d") . ".txt";
$archivoLog2 = $logDirectory2 . "log_" . date("Y-m-d") . ".txt";

date_default_timezone_set('Europe/Madrid');
function registrarEvento($mensaje) {
    global $archivoLog2;
    global $archivoLog;
    
    $mensajeRegistro = "[" . date("Y-m-d H:i:s") . "] $mensaje" . PHP_EOL;

    try {
        file_put_contents($archivoLog2, $mensajeRegistro, FILE_APPEND | LOCK_EX);
    } catch (Exception $e) {
        file_put_contents($archivoLog, $mensajeRegistro, FILE_APPEND | LOCK_EX);
    }
}
?>
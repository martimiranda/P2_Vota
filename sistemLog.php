<?php
$logDirectory = "sistemErrorLogs/";
$archivoLog = $logDirectory . "log_" . date("Y-m-d") . ".txt";

function registrarEvento($mensaje) {
    global $archivoLog;

    $mensajeRegistro = "[" . date("Y-m-d H:i:s") . "] $mensaje" . PHP_EOL;

    file_put_contents($archivoLog, $mensajeRegistro, FILE_APPEND | LOCK_EX);
}
?>
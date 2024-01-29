<?php
$logDirectory = "sistemErrorLogs/";
$archivoLog = $logDirectory . "log_" . date("Y-m-d") . ".txt";

function registrarEvento($mensaje) {
    global $archivoLog;

    // Crear el mensaje de registro con la marca de tiempo
    $mensajeRegistro = "[" . date("Y-m-d H:i:s") . "] $mensaje" . PHP_EOL;

    // Añadir el mensaje al final del archivo de registro o crear el archivo si no existe
    file_put_contents($archivoLog, $mensajeRegistro, FILE_APPEND | LOCK_EX);
}
?>
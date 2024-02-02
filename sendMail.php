<?php
include('sistemLog.php');
try {
    $dsn = "mysql:host=localhost;dbname=p2_votos";
    $pdo = new PDO($dsn, 'martimehdi', 'P@ssw0rd');
    $query = $pdo->prepare("SELECT * FROM invitations WHERE invited = FALSE LIMIT 5;");
    $query->execute();
    $row = $query->fetch();
    $correct = false;
    $use= true;
    while ($row) {
        $to = $row['email'];
        $subject = 'INVITACIÓN DE MARGOMI';
        $message = '';
        $headers = 'From: invitations@margomi.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion() . "\r\n" .
                    'Content-Type: text/html; charset=UTF-8';


        // Agregar imagen embebida (si es necesario)
        $message .= '<br><img src="img/encuestas-online.png">';

        // Enlace de verificación
        //$verificationLink = 'https://aws26.ieti.site/verificar_token.php?token=' . $token;
        //$message .= '<br>Por favor, verifica tu cuenta haciendo clic en el siguiente enlace: <a href="' . $verificationLink . '">Verificar cuenta</a>';
        $message .= '<br>Estoy haciendo pruebas';
        if (mail($to, $subject, $message, $headers)) {
            registrarEvento("El correo se envió correctamente a ".$row['email']."");
        } else {
            $lastError = error_get_last();
            $errorMessage = isset($lastError['message']) ? $lastError['message'] : 'No se pudo obtener detalles del error.';
            registrarEvento("Error al enviar el correo a ".$row['email'].";. Detalles del error: $errorMessage");
        }
        $row = $query->fetch();
        $correct = true;}

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

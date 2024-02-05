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
        $token = $row['token'];
        $to = $row['email'];
        $subject = 'INVITACIÓN A VOTO';
        $fromName = 'MARGOMI VOTOS';
        $fromEmail = 'invitations@margomi.com';
        $headers = 'From: ' . $fromName . ' <' . $fromEmail . '>' . "\r\n" .
                    "X-Mailer: PHP/" . phpversion() . "\r\n" .
                    'Content-Type: text/html; charset=UTF-8';
        
        // Enlace de verificación
        $verificationLink = 'https://aws26.ieti.site/inviteVoters.php?token=' . $token;
        $message .= "<div>
        <br><br>¡Has sido invitado para participar en una encuesta de MARGOMI VOTOS!
        <br><br>
        Vota pulsando el siguiente enlace: <a href=' '> Votar</a>
        <br><br>
        <br>Gracias,
        <br> MARGOMI VOTOS
        <br><br>";

        if (mail($to, $subject, $message, $headers)) {
            registrarEvento("El correo se envió correctamente a $mail");
        } else {
            $lastError = error_get_last();
            $errorMessage = isset($lastError['message']) ? $lastError['message'] : 'No se pudo obtener detalles del error.';
            registrarEvento("Error al enviar el correo a $mail. Detalles del error: $errorMessage");
        }
        $row = $query->fetch();
        $correct = true;}

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

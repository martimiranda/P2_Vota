<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require "vendor/autoload.php";
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
        $mail = $row['email'];
        $to = $mail;
        $token = $row['token'];
        
        // Crear instancia de PHPMailer
        $mail = new PHPMailer();
        
        // Configurar SMTP
        $mail->IsSMTP();
        $mail->SMTPDebug  = 0;  // Activa el debug para ver errores
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com"; // SMTP server
        include 'config.php';
        $mail->Username = $email;
        $mail->Password = $password;

        // Configurar cabeceras del correo
        $mail->IsHTML(true);
        $mail->SetFrom("vote@margomi.com", "MARGOMI VOTOS");
        $mail->AddAddress($to); // Añadir destinatario
        $mail->Subject = 'INVITACION A VOTO';
        
        // Construir el mensaje
        $verificationLink = 'https://aws26.ieti.site/vote.php?token=' . $token;
        $message = "<div><br>¡Has sido invitado para participar en una votación!<br><br>";
        $message .= "Vota pulsando el siguiente enlace: <a href='" . $verificationLink . "'>Participar en la votación</a><br><br>";
        $message .= "Saludos.<br><br> MARGOMI VOTOS <br><br>";
        $message .= "<img style='width: 200px;' src='https://media.istockphoto.com/id/1038070776/it/vettoriale/icona-del-colore-del-voto-vettoriale-con-la-busta-dellinserto-a-mano-dellelettore-nelle.jpg?s=612x612&w=0&k=20&c=rUwkFns-OCnwyaQ72-e__cqek9q75w-BYE6AWyyguho=' alt='Imagen de ejemplo'>"; // Agregar la imagen
        $mail->MsgHTML($message);

        if (!$mail->Send()) {
            registrarEvento("Error al enviar el correo a $to.");
        } else {
            // Registro exitoso, ahora actualizamos la base de datos
            $updateQuery = $pdo->prepare("UPDATE invitations SET invited = TRUE WHERE token = :token");
            $updateQuery->bindParam(':token', $token);
            $updateQuery->execute();
            registrarEvento("El correo se envió correctamente a $to");
        }

        
        $row = $query->fetch();
        $correct = true;}

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

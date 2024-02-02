<?php
$to = 'mehdiregb@gmail.com';
$subject = 'Servidor Mehdi root';
$message = 'Este es el cuerpo del correo. Mi servidor root.';
$headers = 'From: root@mregbaouiregbaoui.ieti.local' . "\r\n" .
    'Reply-To: root@mregbaouiregbaoui.ieti.local' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'El correo se envi   correctamente.';
} else {
    echo 'Error al enviar el correo.';
}
?>
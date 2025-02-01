<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require __DIR__ . '/../../PHPMailer/src/Exception.php';
require __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../../PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mvc.correo.peliculas@gmail.com';
    $mail->Password   = 'ocrn fghp bvqn nmow';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = "465";

    $mail->setFrom('mvc.correo.peliculas@gmail.com', 'Peliculas');
    $mail->addAddress($_GET['email'], $_GET['nombre']); // Aquí puedes utilizar el correo del usuario

    $mail->isHTML(true);
    $mail->CharSet = "UTF8";
    $mail->Subject = 'Verificación de Cuenta';

    // Usamos el token para crear el enlace de verificación
    $token = $_GET['token'];
    $verificarEnlace = "http://localhost/DWES/unidad_8_mvc/MVC/web-peliculas-mvc/web/index.php?ctl=verificarToken&token=" . urlencode($token);

    $mail->Body = '
        <h1>Hola, verifica tu cuenta</h1>
        <p>Para activar tu cuenta, haz clic en el siguiente enlace:</p>
        <p>
            <a href="'.$verificarEnlace.'">
               Verificar cuenta
            </a>
        </p>
    ';
    $mail->AltBody = "Hola, verifica tu cuenta copiando y pegando este enlace en tu navegador: ".$verificarEnlace;

    $mail->send();
    echo 'El mensaje se ha enviado con éxito';
} catch (Exception $e) {
    echo "El mensaje no se ha enviado: {$mail->ErrorInfo}";
}
?>
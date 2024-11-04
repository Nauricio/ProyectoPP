<?php
// Incluir la biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'vendor/autoload.php';
// Incluir la biblioteca PHPMailer

include('bdd.php');

$correo = $_POST['correo'];

// Establecer la conexión a la base de datos (asumiendo que $conexion es tu variable de conexión)
$queryusuario = mysqli_query($conexion, "SELECT * FROM personal WHERE correo = '$correo'");
$nr = mysqli_num_rows($queryusuario); 

if ($nr == 1) {

    //generar token y hora de expiracion
    $token= bin2hex(random_bytes(50));
    $expiracion= date("Y-m-d H:i:s",strtotime('+20 minutes'));

    $updateQuery= "UPDATE personal SET RESET_TOKEN = ?, TOKEN_EXPI = ? WHERE correo = ?";
    $updatestmt = mysqli_prepare($conexion,$updateQuery);
    msqli_stmt_bind_param($updatestmt,"sss",$token,$expiracion,$correo);
    mysqli_stmt_execute($updatestmt);



    $mostrar = mysqli_fetch_array($queryusuario); 
   

    $paracorreo = $correo;
    $titulo = "Recuperar Clave";


    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer();

    // Configurar PHPMailer para usar SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'estaminayisus@gmail.com'; // Coloca aquí tu dirección de correo de Gmail
    $mail->Password = 'zvrm hehq pqwe qezj'; // Coloca aquí tu contraseña de Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configurar el remitente y el destinatario del correo electrónico
    $mail->setFrom('estaminayisus@gmail.com', 'practicas');
    $mail->addAddress($paracorreo);

    // Configurar el asunto y el cuerpo del correo electrónico
    $mail->Subject = $titulo;
    $mail->Body = 'Haz click en el siguiente enlace para recuperar tu contraseña <a href="//http://museook.free.nf/recuperar_contra.php?token = '.$token.'">recuperar contraseña</a>' ;                  //terminar

    // Enviar el correo electrónico
    if ($mail->send()) {
        echo "<script> alert('Contraseña enviada');window.location= 'login.php' </script>";
    } else {
        echo "<script> alert('Error al enviar el correo');window.location= 'recuperar.php' </script>";
    }
} else {
    echo "<script> alert('Este correo no existe');window.location= 'recuperar.php' </script>";
}
<?php
require_once('./modulos/administracion/comisiones/UploadFiles.php');
require_once('./modulos/mail/Mail.php');
require_once('./configuracion/DeleteAnexos.php');
echo 'Prueba del servidor avido - dedo' ;


//$path = './anexos/5729';
//echo realpath($path);
//DeleteAnexos::delete(realpath($path));


//$mail = new Mail();
//$asunto = "Prueba 1";
//$mensaje = "mi primer mensaje";
//$mail->enviar($asunto,$mensaje);

//echo realpath ( "./librerias");
phpinfo();
/*
$to       = 'lfernando.orozco@udea.edu.co';
$subject  = 'Testing sendmail';
$message  = 'Hi, you just received an email using sendmail!';
$headers  = 'From: luisfernandorzcrzc@gmail.com';
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";

*/
//$cadena = "ñññaññó";
//$salida = UploadFiles::quitar_tildes($cadena);
//echo $salida;

//require_once('./librerias/PHPMailer/PHPMailerAutoload.php');
//require_once('./librerias/PHPMailer/class.smtp.php');
	/*
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'codedo.udea@gmail.com';                 // SMTP username
	$mail->Password = 'sistc0ded0'; 
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->setFrom('codedo.udea@gmail.com', '');
	$mail->addAddress('lfernando.orozco@udea.edu.co', 'Joe User');     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = 'Prueba';
	$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}*/

?>

<?php
	/*
	* Autor Luis Fernando Orozco
	* Esta clase se encarga de enviar correos electronicos, para la cual es necesario realizar la configuracion inicial
	*/
	//require_once('../../configuracion/path.php');
	$raiz = '/backup/admondoc/';
	//$raiz = $_SERVER['DOCUMENT_ROOT'].'/';
	require_once('../../../librerias/PHPMailer/PHPMailerAutoload.php');

	class Mail{
		
       		
			

		static function enviar($asunto,$mensaje,$email){
			//echo $asunto.'</br>';
			//echo $mensaje.'</br>';
			//echo $email.'</br>';
			$mail = new PHPMailer();
			$mail->isSMTP(); //Usar smtp
	
			$mail->Host = 'smtp.gmail.com';  // smtp de google
			$mail->SMTPAuth = true; //habilitar autenticación en el smtp de google
			
			//datos de la cuenta que envia el correo
			//$mail->Username = 'codedo.udea@gmail.com';  
			//$mail->Password = 'sistc0ded0'; 
			
			$mail->Username = 'sistemasdocencia@udea.edu.co';  
			$mail->Password = 'sistvicedoc'; 
			
			$mail->SMTPSecure = 'ssl'; //encriptacion
			$mail->Port = 465; //puerto empleado por el servidor smtp
			$mail->addAddress($email, '');
			$mail->setFrom('codedo.udea@gmail.com', 'Codedo'); //correo que envia el mensaje
			
			$mail->isHTML(true); //habilitar html en el mensaje
			$mail->Subject = $asunto;
			$mail->Body    = $mensaje;
			
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				
			} else {
				//echo 'Message has been sent';
			}
			
		}
	}
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
	}
	*/
?>
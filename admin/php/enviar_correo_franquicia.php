<?php
	session_start();
	
	//Se valida que esten todos los datos necesarios para el proceso
	if(isset($_POST["nombre_contacto"]) && isset($_POST["mensaje_contacto"]) && isset($_POST["correo_contacto"]) && isset($_POST["correo_franquicia"])){
		
		//Se valida si el nombre no este vacio
		if(empty($_POST["nombre_contacto"])){
			$_SESSION["mensaje-sistema"] = "Faltan datos en el formulario, favor intentar de nuevo.";
			header("location: contacto.php");
		}else{
			$nombre_contacto = $_POST["nombre_contacto"];
		}
		
		//Se valida que el mensaje no este vacio
		if(empty($_POST["mensaje_contacto"])){
			$_SESSION["mensaje-sistema"] = "Faltan datos en el formulario, favor intentar de nuevo.";
			header("location: contacto.php");
		}else{
			$mensaje_contacto = $_POST["mensaje_contacto"];
		}
		
		//Se valida que el correo tenga la sintaxis correcta
		if(filter_var($_POST["correo_contacto"], FILTER_VALIDATE_EMAIL)){
			$correo_contacto = $_POST["correo_contacto"];
		}else{
			$_SESSION["mensaje-sistema"] = "Error de sintaxis en el correo, favor ingresar uno valido.";
			header("location: contacto.php");
		}
		
		$correo_franquicia = $_POST["correo_franquicia"];
		
		//Se inicia el proceso de envio del correo
		
		//$to = "msanchez@mateosanchez.cl";
		$to = $correo_franquicia;
		$subject = "Consulta hecha a traves del sitio mateosanchez.cl.";
		$message = $mensaje_contacto."\n\n\n";
		$message .= "Enviado por: ".$nombre_contacto.", Fono: ".$telefono_contacto.".";
		$from = "$correo_contacto";
		$headers = "From: $nombre_contacto <$correo_contacto>\r\n";

		require_once("class.phpmailer.php");
		require_once("class.smtp.php");
		
		$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		try {
			$mail->SMTPDebug = 4;                               // Enable verbose debug output
			$mail->isSMTP();                                    // Set mailer to use SMTP
			$mail->SMTPDebug = false;
			$mail->do_debug = 0;
			$mail->Host = gethostbyname('mail.mateosanchez.cl'); 		// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                             // Enable SMTP authentication
			$mail->Username = 'no-reply@mateosanchez.cl';   // SMTP username
			$mail->Password = 'mateo.,123';                     // SMTP password
			$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
			$mail->From = $correo_contacto;
			$mail->FromName = $nombre_contacto;
			$mail->addAddress($correo_franquicia, "Mateo Sanchez Propiedades - contacto");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
			$mail->addReplyTo($correo_franquicia, "Mateo Sanchez Propiedades - contacto");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(false);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->AltBody = 'Enviado por el sistema de propiedades mateosanchez.cl';
			if(!$mail->send()) {
				
				$_SESSION["mensaje-sistema"] = 'Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["mensaje-sistema"] = 'Mensaje enviado con exito, lo contactaremos a la brevedad.';
			}
			$errors[] = "Send mail sucsessfully";
		} catch (phpmailerException $e) {
			$errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			$errors[] = $e->getMessage(); //Boring error messages from anything else!
		}
		
		
	}else{
		$_SESSION["mensaje-sistema"] = "Su mensaje no se pudo enviar, favor intentar nuevamente.";
	}
	
	//foreach ($errors as $valor) {
	//	echo $valor."<br>";
	//}
	//echo $message;
	//echo $_SESSION["mensaje-sistema"];
	
	header("location: ../../ficha-franquicia.php?id_franquicia=".$_POST["id_franquicia"]);
?>
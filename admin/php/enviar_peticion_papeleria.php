<?php
	session_start();
	require_once('rutinas.php');
	$message = "Buenas, este mensaje fue creado con el formulario de pedidos de carteles integrado a el sistema mateosanchez.cl - viene con el siguiente pedido: \n";
	date_default_timezone_set("America/Santiago");
	$fecha_peticion = date("Y-m-d G:i:s");
	
	
	if(isset($_POST["sobre_americano"]) && !empty($_POST["sobre_americano"])){
		$message .= "Sobre americano: ".$_POST["sobre_americano"]."\n";
	}
	
	if(isset($_POST["esquela_carta"]) && !empty($_POST["esquela_carta"])){
		$message .= "Esquela carta: ".$_POST["esquela_carta"]."\n";
	}
	
	if(isset($_POST["esquela_oficio"]) && !empty($_POST["esquela_oficio"])){
		$message .= "Esquela oficio: ".$_POST["esquela_oficio"]."\n";
	}
	
	if(isset($_POST["carpeta_corporativa_carta"]) && !empty($_POST["carpeta_corporativa_carta"])){
		$message .= "Carpeta corporativa carta: ".$_POST["carpeta_corporativa_carta"]."\n";
	}
	
	if(isset($_POST["carpeta_corporativa_oficio"]) && !empty($_POST["carpeta_corporativa_oficio"])){
		$message .= "Carpeta corporativa oficio: ".$_POST["carpeta_corporativa_oficio"]."\n";
	}
	
	if(isset($_POST["sobre_saco_carta"]) && !empty($_POST["sobre_saco_carta"])){
		$message .= "Sobre saco carta: ".$_POST["sobre_saco_carta"]."\n";
	}
	
	if(isset($_POST["sobre_saco_oficio"]) && !empty($_POST["sobre_saco_oficio"])){
		$message .= "Sobre saco oficio: ".$_POST["sobre_saco_oficio"]."\n";
	}
	
	if(isset($_POST["tarjeta_presentacion"]) && !empty($_POST["tarjeta_presentacion"])){
		$message .= "Tarjeta presentacion: ".$_POST["tarjeta_presentacion"]."\n";
	}
	
	if(isset($_POST["folleteria"]) && !empty($_POST["folleteria"])){
		$message .= "Folleteria: ".$_POST["folleteria"]."\n";
	}
	
	if(isset($_POST["otras_peticiones"]) && !empty($_POST["otras_peticiones"])){
		$message .= "Otras peticiones: ".$_POST["otras_peticiones"]."\n";
	}
	
	//Armamos la SQL para crear la nueva cuenta
	$sql = "INSERT INTO peticion_carteles ";
	$sql .= "(fecha_peticion_cartel, "; //:param_01
	$sql .= "detalle_peticion_cartel) "; //:param_02
	$sql .= "VALUES ";
	$sql .= "(:param_01, ";
	$sql .= ":param_02)";
	
	//Con el SQL listo se armara la transaccion PDO
	$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexion -> beginTransaction();
	$inserta = $conexion -> prepare($sql);
	$inserta -> bindValue(':param_01', $fecha_peticion);
	$inserta -> bindValue(':param_02', utf8_decode($message));
	
	//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
	$inserta -> execute();
	$conexion -> commit();
	
	//$to = "msanchez@mateosanchez.cl";
	$to = "msanchez@mateosanchez.cl";
	$subject = "Peticion carteles hecha a traves del sitio mateosanchez.cl.";
	$from = "msanchez@mateosanchez.cl";
	$headers = "From: Mateo Sanchez <msanchez@mateosanchez.cl>\r\n";

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
		$mail->From = "msanchez@mateosanchez.cl";
		$mail->FromName = "Enviado por Mateo Sanchez";
		$mail->addAddress("ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
		$mail->addReplyTo("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(false);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = nl2br($message);
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
		$mail->From = "msanchez@mateosanchez.cl";
		$mail->FromName = "Enviado por Mateo Sanchez";
		$mail->addAddress("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
		$mail->addReplyTo("ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		$mail->isHTML(false);                                  // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = nl2br($message);
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
	
	$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Petici&oacute;n realizada nos contactaremos dentro de poco.</div>";
	
	header("location: ../pages/enviar-peticion-papeleria.php");
?>
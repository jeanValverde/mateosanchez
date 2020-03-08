<?php
	session_start();
	require_once("rutinas.php");
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	$is_fail = 0; //iniciador del indicador si hubo algun fallo durante el proceso, 0->No; 1->Si
	$is_test = 0; //indicador si esta en formato de pruebas, 0->No; 1->Si
	$_SESSION["mensaje-sistema"] = ""; //Inicializar el mensaje del sistema para adherir errores o exitos
	
	//Se valida si vienen los datos necesarios para el proceso
	if(isset($_GET["id_propiedad"])){
		//Se valida que la persona que esta realizando el proceso sea la misma persona que entro al sistema
		
		//Se actualiza el registro segun el valor generado anteriormente
		$sql = "UPDATE propiedades SET";
		$sql .= " is_hidden = '0'";
		$sql .= " WHERE id_propiedad = ".$_GET["id_propiedad"];
		
		if($is_test == 1){
			echo "El codigo SQL es: ".$sql."<br />";
		}
		
		if($is_test == 0){
			$modifica = $conexion->prepare($sql);
			$modifica->execute();
			
			$sql_propiedad = "SELECT * FROM propiedades WHERE id_propiedad=".$_GET["id_propiedad"];
			$cursor_propiedad = $conexion -> query($sql_propiedad);
			$propiedad = $cursor_propiedad -> fetch();
			
			$cod_propiedad = $propiedad["cod_propiedad"];
			
			if(isset($_SESSION["correo_cuenta"]) && !empty($_SESSION["correo_cuenta"])){
				$correo_cuenta = $_SESSION["correo_cuenta"];
			}elseif(isset($_COOKIE["correo_cuenta"]) && !empty($_COOKIE["correo_cuenta"])){
				$correo_cuenta = $_COOKIE["correo_cuenta"];
			}else{
				$correo_cuenta = "No se pudo identificar";
			}
			
			//Codigo de envio de correo para cuenta de barbara u otro coordinador
			$subject = "Alerta por ACTIVACION DE PROPIEDAD a sistema mateosanchez.cl.";
			$message = "Este es un mensaje automatico avisando que la propiedad codigo: ".$cod_propiedad." fue activado en el sistema de mateosanchez.cl por la cuenta: ".$correo_cuenta." \n\n";
			$message .= "Puede ver más detalle de la propiedad vealo en: <a href='http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=".$cod_propiedad."'>Este enlace</a> \n";

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
				$mail->From = "no-reply@mateosanchez.cl";
				$mail->FromName = "Sistema mateosanchez.cl";
				$mail->addAddress("barbara.marcoleta@mateosanchez.cl", "Barbara Marcoleta");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
				$mail->addAddress("barbara.rendic@mateosanchez.cl", "Barbara Rendic");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
				$mail->addReplyTo("msanchez@mateosanchez.cl", "Mateo Sanchez");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
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
		}
		
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Proceso terminado con exito.</div>";
		
	}else{
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Problema con la asignaci&oacute;n de la propiedad favor intentar nuevamente.</div>";
	}
	
	header("location: ../pages/ver-propiedades.php?is_hidden=1");//Entrada a la pagina sin el formulario correspondiente.
?>
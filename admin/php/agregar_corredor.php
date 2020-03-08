<?php
	session_start();
	require_once('rutinas.php');
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_POST['nombre_persona']) && !empty($_POST['nombre_persona'])){
		$nombre_persona = $_POST['nombre_persona'];
		
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Nombre de la franquicia no fue ingresado.</div>";
		
	}
	
	if(isset($_POST['id_franquicia']) && !empty($_POST['id_franquicia'])){
		$sql_validar = "SELECT * FROM franquicias WHERE id_franquicia='".$_POST['id_franquicia']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_franquicia = $cursor_validar -> rowCount();
		
		if($validar_franquicia == 1){
			$id_franquicia = $_POST['id_franquicia'];
			
			
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>La region entregada no esta dentro de los registros.</div>";
			
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Region no ingresado.</div>";
		
	}
	
	if(isset($_POST['telefono_persona']) && !empty($_POST['telefono_persona'])){
		$telefono_persona = $_POST['telefono_persona'];
		
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Telefono fijo de la franquicia no ingresada.</div>";
		
	}
	
	if(isset($_POST['correo_cuenta']) && filter_var($_POST['correo_cuenta'], FILTER_VALIDATE_EMAIL)){
		$sql_validar = "SELECT * FROM cuentas WHERE correo_cuenta='".$_POST['correo_cuenta']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_correo = $cursor_validar -> rowCount();
		
		if($validar_correo == 0){
			$correo_cuenta = $_POST['correo_cuenta'];
			
			
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Este correo electr&oacute;nico ya se encuentra en nuestros registros.</div>";
			
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Correo electr&oacute;nico no ingresado.</div>";
	}
	
	if($is_fail == 0 && $is_test == 0){
	
		//Armamos los datos que serian la nueva cuenta asociada a la franquicia matriz
		$nombre_cuenta = "cuenta_corredor_".$id_franquicia;
		$clave_cuenta = getUniqueCode();
		$nivel_cuenta = "4";
		
		//Armamos la SQL para crear la nueva cuenta
		$sql = "INSERT INTO cuentas ";
		$sql .= "(nombre_cuenta, "; //:param_01
		$sql .= "clave_cuenta, "; //:param_02
		$sql .= "correo_cuenta, "; //:param_03
		$sql .= "lvl_cuenta, "; //:param_04
		$sql .= "nombre_persona, "; //:param_05
		$sql .= "telefono_persona, ";
		$sql .= "id_franquicia) "; //:param_06
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04, ";
		$sql .= ":param_05, ";
		$sql .= ":param_06, ";
		$sql .= ":param_07)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $nombre_cuenta);
		$inserta -> bindValue(':param_02', $clave_cuenta);
		$inserta -> bindValue(':param_03', $correo_cuenta);
		$inserta -> bindValue(':param_04', $nivel_cuenta);
		$inserta -> bindValue(':param_05', $nombre_persona);
		$inserta -> bindValue(':param_06', $telefono_persona);
		$inserta -> bindValue(':param_07', $id_franquicia);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
		
		$to = "$correo_cuenta";
		$subject = "Cuenta de corredor ha sido creada con exito\n";
		$message = "Correo: ".$correo_cuenta."\n";
		$message .= "Clave: ".$clave_cuenta."\n";
		$message .= "Recuerde de cambiar su clave para su comodidad y seguridad.\n";
		$from = "no-reply@mateosanchez.cl";
		$headers = "From: Sistema de Mateo Sanchez <no-reply@mateosanchez.cl>\r\n";
		try {
			require_once("class.phpmailer.php");
			require_once("class.smtp.php");
			
			$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
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
			$mail->From = "info@mateosanchez.cl";
			$mail->FromName = "Mateo Sanchez Propiedades";
			$mail->addAddress($correo_cuenta, $nombre_persona);     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
			$mail->addReplyTo($correo_cuenta, $nombre_persona);
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
		} catch (Exception $e) {
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No se pudo enviar un correo al representante de esta franquicia, favor hacerlo a travez de la secci&oacute;n de franquicias.</div>";
			
		}
	}
	
	header("location: ../pages/home.php");
?>
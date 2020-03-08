<?php
	// Motrar todos los errores de PHP
	error_reporting(-1);
	 
	// Motrar todos los errores de PHP
	error_reporting(E_ALL);
	 
	// Motrar todos los errores de PHP
	ini_set('error_reporting', E_ALL);
	
	session_start();
	require_once('rutinas.php');
	include('SimpleImage.php');
	$is_test = 0;
	$is_fail = 0;
	$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir
	$_SESSION["mensaje-sistema"] = "";
	
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_POST['nombre_franquicia']) && !empty($_POST['nombre_franquicia'])){
		$nombre_franquicia = $_POST['nombre_franquicia'];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Nombre de la franquicia no fue ingresado.</div>";
	}
	
	if(isset($_POST['id_region']) && !empty($_POST['id_region'])){
		$sql_validar = "SELECT * FROM regiones WHERE id_region='".$_POST['id_region']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_region = $cursor_validar -> rowCount();
		
		if($validar_region == 1){
			$id_region = $_POST['id_region'];
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>La region entregada no esta dentro de los registros.</div>";
			
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Region no ingresado.</div>";
		
	}
	
	if(isset($_POST['id_comuna']) && !empty($_POST['id_comuna'])){
		$sql_validar = "SELECT * FROM comunas WHERE id_comuna='".$_POST['id_comuna']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_comuna = $cursor_validar -> rowCount();
		
		if($validar_comuna == 1){
			$id_comuna = $_POST['id_comuna'];
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>La comuna no se encuentra dentro de nuestros registros.</div>";
			
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Comuna no ingresada.</div>";
		
	}
	
	if(isset($_POST['direccion_franquicia']) && !empty($_POST['direccion_franquicia'])){
		$direccion_franquicia = $_POST['direccion_franquicia'];
		
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Direcci&oacute;n de la franquicia no ingresada.</div>";
		
	}
	
	if(isset($_POST['telefono_movil_franquicia']) && !empty($_POST['telefono_movil_franquicia'])){
		$telefono_movil_franquicia = $_POST['telefono_movil_franquicia'];
		
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Telefono m&oacute;vil de la franquicia no ingresada.</div>";
		
	}
	
	if(isset($_POST['correo_franquicia']) && filter_var($_POST['correo_franquicia'], FILTER_VALIDATE_EMAIL)){
		$sql_validar = "SELECT * FROM cuentas WHERE correo_cuenta='".$_POST['correo_franquicia']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_correo = $cursor_validar -> rowCount();
		
		if($validar_correo == 0){
			$correo_franquicia = $_POST['correo_franquicia'];
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Este correo electr&oacute;nico ya se encuentra en nuestros registros.</div>";
			
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Correo electr&oacute;nico no ingresado.</div>";
		
	}
	
	if(isset($_POST['representante_franquicia']) && !empty($_POST['representante_franquicia'])){
		$representante_franquicia = $_POST['representante_franquicia'];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Nombre del representante no ingresado.</div>";
		
	}
	
	if(isset($_POST['fono_contacto_representante']) && !empty($_POST['fono_contacto_representante'])){
		$fono_contacto_representante = $_POST['fono_contacto_representante'];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Telefono de contacto del representante no ingresado.</div>";
		
	}
	
	if(isset($_POST['detalle_franquicia']) && !empty($_POST['detalle_franquicia'])){
		$detalle_franquicia = $_POST['detalle_franquicia'];
	}else{
		$detalle_franquicia = "";
		
	}
	
	$array = explode(".", strtolower($_FILES["img_franquicia"]["name"]));
	$extension = end($array);

	if ((($_FILES["img_franquicia"]["type"] == "image/gif") || ($_FILES["img_franquicia"]["type"] == "image/jpeg")
	|| ($_FILES["img_franquicia"]["type"] == "image/png")
	|| ($_FILES["img_franquicia"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_franquicia']['size'] < 6000000){
		if ($_FILES["img_franquicia"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo.";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_franquicia = "franquicia-".getUniqueCode().".".$extension;
			}while(file_exists($img_franquicia));
			
			if (is_uploaded_file($_FILES["img_franquicia"]["tmp_name"]) && $is_test == 0){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_franquicia"]["tmp_name"], $img_franquicia);
				
				$img = new abeautifulsite\SimpleImage($img_franquicia);
				$img->resize(270, 255)->save($img_franquicia);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_franquicia,"../../images/img-franquicias/".$img_franquicia);
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				$is_fail = 1;
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No se pudo subir la imagen presentada.</div>";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>la imagen no cumple con la espectativas.</div>";
	}
	
	if($is_fail == 0 && $is_test == 0){
		//Armamos la SQL para crear la Franquicia
		$sql = "INSERT INTO franquicias ";
		$sql .= "(nombre_franquicia, "; //:param_01
		$sql .= "id_region, "; //:param_02
		$sql .= "id_comuna, "; //:param_03
		$sql .= "direccion_franquicia, "; //:param_04
		$sql .= "telefono_movil_franquicia, "; //:param_06
		$sql .= "correo_franquicia, "; //:param_07
		$sql .= "representante_franquicia, "; //:param_08
		$sql .= "fono_contacto_representante, "; //:param_09
		$sql .= "detalles_franquicia, "; //:param_10
		$sql .= "img_franquicia) "; //:param_11
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04, ";
		$sql .= ":param_06, ";
		$sql .= ":param_07, ";
		$sql .= ":param_08, ";
		$sql .= ":param_09, ";
		$sql .= ":param_10, ";
		$sql .= ":param_11)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', utf8_decode($nombre_franquicia));
		$inserta -> bindValue(':param_02', $id_region);
		$inserta -> bindValue(':param_03', $id_comuna);
		$inserta -> bindValue(':param_04', utf8_decode($direccion_franquicia));
		$inserta -> bindValue(':param_06', $telefono_movil_franquicia);
		$inserta -> bindValue(':param_07', $correo_franquicia);
		$inserta -> bindValue(':param_08', utf8_decode($representante_franquicia));
		$inserta -> bindValue(':param_09', $fono_contacto_representante);
		$inserta -> bindValue(':param_10', utf8_decode($detalle_franquicia));
		$inserta -> bindValue(':param_11', $img_franquicia);
		
		if($inserta -> execute()){
			$id_franquicia = $conexion -> lastInsertId();
			$conexion -> commit();
			
			//Armamos los datos que serian la nueva cuenta asociada a la franquicia matriz
			$nombre_cuenta = "cuenta_franquicia_".$id_franquicia;
			$clave_cuenta = getUniqueCode();
			$correo_cuenta = $correo_franquicia;
			$nivel_cuenta = "3";
			$nombre_persona = $representante_franquicia;
			$telefono_persona = $fono_contacto_representante;
			
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
			$subject = "Cuenta de su franquicia ha sido creada con exito\n";
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
			
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Exito!</strong> La Franquicia con su cuenta correspondientes fueron creadas.</div>";
		}else{
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Problema con el proceso de inscripcion de la franquicia.</div>";
		}
	}
	header("location: ../pages/agregar-franquicia.php");
?>
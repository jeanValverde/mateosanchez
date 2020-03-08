<?php
	session_start();
	require_once('rutinas.php');
	$is_fail = 0;
	
	// Validar datos de ingreso
	if(!isset($_POST['correo_cuenta']) || !filter_var($_POST['correo_cuenta'], FILTER_VALIDATE_EMAIL) || empty($_POST['correo_cuenta'])){
		echo "E01"; //Error: correo proporcionado no es valido
		$_SESSION["mensaje-sistema"] = "Error: El correo de la cuenta no corresponden, favor revisar si escribio bien los datos pedidos.";
		$is_fail = 1;
	}else{
		
		$correo_cuenta = $_POST['correo_cuenta'];
			
		// Verifica que el correo exista en la base de datos
		$sql = "SELECT * FROM cuentas WHERE correo_cuenta='".$correo_cuenta."'";
		$cursor = $conexion -> query($sql);
		if($cuenta = $cursor -> fetch()){
			$correo_contacto = "no-reply@mateosanchez.cl";
			
			$to = $correo_cuenta;
			$subject = "Petición de recuperación de cuenta a www.mateosanchez.cl";
			$message = "Buenas\n";
			$message .= "El sistema de cuentas de www.mateosanchez.cl ha recibido una petición de recuperación de su cuenta, su clave de acceso es el siguiente.\n\n";
			$message .= "Clave cuenta: ".$cuenta["clave_cuenta"]."\n";
			$message .= "Si logro iniciar sesión sin la necesidad de cambiar la clave, no tome en cuenta este correo.";
			$from = "$correo_contacto";
			$headers = "From: www.mateosanchez.cl <$correo_contacto>\r\n";
			try {
				if(mail($to,$subject,$message,$headers)){
					echo "S01"; //Proceso terminado con exito, se envia el correo.
					$_SESSION["mensaje-sistema"] = "Exito: Petici&oacute;n realizada, favor de revisar su correo para obtener su contrase&ntilde;a.";
				}else{
					echo "E04"; //Error: Problemas con el envio de correos.
					$_SESSION["mensaje-sistema"] = "Error: No se pudo realizar el envio, favor de intentarlo m&aacute;s tarde.";
					$is_fail = 1;
				}
			} catch (Exception $e) {
				echo "E05"; //Error: Problema para iniciar proceso de envio.
				$_SESSION["mensaje-sistema"] = "Error: Hubo un problema con el sistema, favor contactar al administrador del sitio.";
				$is_fail = 1;
			}
		}else{
			echo "E02"; //Error: No existe cuenta con el correo proporcionado.
			$_SESSION["mensaje-sistema"] = "Error: El nombre de usuario o el correo de la cuenta no se encuentran registrados en este sitio, favor revisar los datos ingresados.";
			$is_fail = 1;
		}
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	header("location: ../pages/recuperar-cuenta.php");
?>
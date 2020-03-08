<?php
	session_start();
	require_once('rutinas.php');
	$is_fail = 0;
	
	// Validar datos de ingreso
	if(!isset($_POST['clave_cuenta']) || !isset($_POST['clave_nueva']) || !isset($_POST['clave_repetida']) || !isset($_POST['nombre_persona']) || !isset($_POST['telefono_persona'])){
		$_SESSION["mensaje-sistema"] = "Error: Datos entregados no cumplen con los requisitos del sistema.";
	}else{
		if(!isset($_SESSION["nombre_cuenta"])){
			$nombre_cuenta = $_COOKIE["nombre_cuenta"];
		}else{
			$nombre_cuenta = $_SESSION["nombre_cuenta"];
		}
		
		if(!isset($_SESSION["clave_cuenta"])){
			$clave_cuenta = $_COOKIE["clave_cuenta"];
		}else{
			$clave_cuenta = $_SESSION["clave_cuenta"];
		}
		
		//Se busca los datos de la cuenta que se encuentra activa
		$sql = "SELECT * FROM cuentas WHERE nombre_cuenta='".$nombre_cuenta."' AND clave_cuenta='".$clave_cuenta."'";
		$cursor = $conexion -> query($sql);
		if($cuenta = $cursor -> fetch()){
			
			if($_POST['clave_cuenta'] != $cuenta["clave_cuenta"]){
				$is_fail = 1;
			}
			
			if(isset($_POST['nombre_persona']) && !empty($_POST["nombre_persona"])){
				$nombre_persona = $_POST['nombre_persona'];
			}else{
				$is_fail = 1;
			}
			
			if(preg_match('/^[0-9-()+]{3,20}/', $_POST['telefono_persona'])){
				$telefono_persona = $_POST['telefono_persona'];
			}else{
				$is_fail = 1;
			}
			
			
			
			if(isset($_POST['clave_nueva']) && isset($_POST['clave_repetida']) && !empty($_POST['clave_nueva']) && !empty($_POST['clave_repetida']) && $_POST['clave_repetida'] == $_POST['clave_nueva']){
				$clave_cuenta = $_POST['clave_nueva'];
			}else{
				$clave_cuenta = $cuenta["clave_cuenta"];
			}
			
			if($is_fail == 0){
				//Armamos la sentencia SQL de UPDATE
				$sql = "UPDATE cuentas SET ";
				$sql .= "nombre_persona = '".utf8_decode($nombre_persona)."', ";
				$sql .= "telefono_persona = '".$telefono_persona."', ";
				$sql .= "clave_cuenta = '".$clave_cuenta."' ";
				$sql .= "WHERE id_cuenta = ".$cuenta["id_cuenta"];
				$modifica = $conexion->prepare($sql);
				
				if($modifica->execute()){
					
					$_SESSION["clave_cuenta"] = $clave_cuenta;
					
					$_SESSION["mensaje-sistema"] = "Exito: Proceso terminado sin problemas, saludos.";
				}else{
					$_SESSION["mensaje-sistema"] = "Error: Hubo un problema con el sistema, favor contactar al administrador del sitio.";
					$if_fail = 1;
				}
			}else{
				$_SESSION["mensaje-sistema"] = "Error: La clave actual de la cuenta no se encuentra registrado en el sistema, favor revisar e intentar de nuevo.";
			}
		}else{
			$_SESSION["mensaje-sistema"] = "Error: Cuenta no encontrada dentro de los registros.";
		}
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	header("location: ../pages/editar-cuenta.php");
?>
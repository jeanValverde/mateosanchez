<?php
	session_start();
	require_once('rutinas.php');
	$is_fail = 0;
	
	// Validar datos de ingreso
	if(!isset($_POST['nombre_comuna']) || !isset($_POST['id_comuna'])){
		$_SESSION["mensaje-sistema"] = "Error: Datos entregados no cumplen con los requisitos del sistema.";
	}else{
		if(isset($_POST["nombre_comuna"]) && !empty($_POST["nombre_comuna"])){
			$nombre_comuna = ucwords($_POST["nombre_comuna"]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"])){
			$id_comuna = $_POST["id_comuna"];
		}else{
			$is_fail = 1;
		}
		
		if($is_fail == 0){
			//Armamos la sentencia SQL de UPDATE
			$sql = "UPDATE comunas SET ";
			$sql .= "nombre_comuna = '".utf8_decode($nombre_comuna)."' ";
			$sql .= "WHERE id_comuna = ".$id_comuna;
			$modifica = $conexion->prepare($sql);
			echo $sql;
			if($modifica->execute()){
				
				$_SESSION["mensaje-sistema"] = "Exito: Proceso terminado sin problemas, saludos.";
			}else{
				$_SESSION["mensaje-sistema"] = "Error: Hubo un problema con el sistema, favor contactar al administrador del sitio.";
				$if_fail = 1;
			}
		}else{
			$_SESSION["mensaje-sistema"] = "Error: La clave actual de la cuenta no se encuentra registrado en el sistema, favor revisar e intentar de nuevo.";
		}
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	header("location: ../pages/ver-comunas.php");
?>
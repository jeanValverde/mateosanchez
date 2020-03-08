<?php
	session_start();
	require_once('rutinas.php');
	$is_fail = 0;
	
	// Validar datos de ingreso
	if(!isset($_POST['nombre_sector']) || !isset($_POST['id_sector'])){
		$_SESSION["mensaje-sistema"] = "Error: Datos entregados no cumplen con los requisitos del sistema.";
	}else{
		if(isset($_POST["nombre_sector"]) && !empty($_POST["nombre_sector"])){
			$nombre_sector = ucwords($_POST["nombre_sector"]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"])){
			$id_sector = $_POST["id_sector"];
		}else{
			$is_fail = 1;
		}
		
		if($is_fail == 0){
			//Armamos la sentencia SQL de UPDATE
			$sql = "UPDATE sectores SET ";
			$sql .= "nombre_sector = '".utf8_decode($nombre_sector)."' ";
			$sql .= "WHERE id_sector = ".$id_sector;
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
	
	header("location: ../pages/ver-sectores.php");
?>
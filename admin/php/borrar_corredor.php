<?php
	require_once('rutinas.php');
	$is_fail = 0;
	$is_test = 0;
	$message = "";
	
	if(isset($_GET["id_cuenta"]) && !empty($_GET["id_cuenta"])){
		$message .= "Dato asignado.<br>";
		$id_cuenta = $_GET["id_cuenta"];
		
		$message .= "Verificar que cuenta tiene propiedades anexadas.<br>";
		$sql_propiedad = "SELECT * FROM propiedades WHERE id_cuenta=".$id_cuenta;
		$cursor_propiedad = $conexion -> query($sql_propiedad);
		if(!$validar_propiedad = $cursor_propiedad -> rowCount()){
			$validar_propiedad = 0;
		}
		
		if($validar_propiedad != 0){
			$message .= "Cuenta tiene ".$validar_propiedad." propiedades asignadas.<br>";
			$sql = "UPDATE propiedades SET ";
			$sql .= "id_cuenta = 1 ";
			$sql .= "WHERE id_cuenta = ".$id_cuenta;
			$modifica = $conexion->prepare($sql);
			if($is_test == 0){
				$modifica->execute();
				$message .= "Propiedades asignadas a Mateo Sanchez<br>";
			}else{
				$message .= "Codigo sql para re asignar las propiedades: ".$sql;
			}
			
		}else{
			$message .= "Cuenta no tiene propiedades asignadas.<br>";
			
		}
		
		$message .= "Verificar que la cuenta tenga notas anexadas.<br>";
		$sql_mensaje = "SELECT * FROM mensajes WHERE id_cuenta=".$id_cuenta;
		$cursor_mensaje = $conexion -> query($sql_mensaje);
		if(!$validar_mensaje = $cursor_mensaje -> rowCount()){
			$validar_mensaje = 0;
		}
		
		if($validar_mensaje != 0){
			$message .= "Cuenta tiene ".$validar_mensaje." notas anexadas<br>";
			$sql = "UPDATE mensajes SET ";
			$sql .= "id_cuenta = 1 ";
			$sql .= "WHERE id_cuenta = ".$id_cuenta;
			$modifica = $conexion->prepare($sql);
			if($is_test == 0){
				$modifica->execute();
				$message .= "Notas asignadas a Mateo Sanchez<br>";
			}else{
				$message .= "Codigo sql para re asignar las notas: ".$sql."<br>";
			}
		}else{
			$message .= "Cuenta no tiene notas asignadas.<br>";
		}
		
		//FALTARIA AGREGAR SECCION DE DOCUMENTOS DE VERANO
		
		if($is_fail == 0){
			$message .= "Se inicia el proceso de borrado de la cuenta.<br>";
			$sql = "DELETE FROM cuentas WHERE id_cuenta=".$id_cuenta;
			$borra = $conexion->prepare($sql);
			if($is_test == 0){
				$borra->execute();
				$message .= "Cuenta borrada con exito.<br>";
			}else{
				$message .= "Codigo sql para borrar cuenta: ".$sql."<br>";
			}
		}
	}else{
		$message .= "Dato no asignado.<br>";
	}
	
	if($is_fail == 0){
		$message .= "Proceso terminado con exito.<br>";
	}else{
		$message .= "Proceso fallo dentro su trabajo.<br>";
	}
	
	if($is_test == 1){
		echo $message;
	}else{
		header("location: ../pages/ver-corredores.php");
	}
?>
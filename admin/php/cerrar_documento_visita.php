<?php
	session_start();
	require_once('rutinas.php');
	$is_fail = 0;
	
	// Validar datos de ingreso
	if(isset($_POST["id_documento_visita_propiedad"]) && !empty($_POST["id_documento_visita_propiedad"])){
		$id_documento_visita_propiedad = $_POST["id_documento_visita_propiedad"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["reporte_documento_visita_propiedad"]) && !empty($_POST["reporte_documento_visita_propiedad"])){
		$reporte_documento_visita_propiedad = $_POST["reporte_documento_visita_propiedad"];
	}else{
		$is_fail = 1;
	}
	
	$fecha_cierre_documento_visita_propiedad = date("Y-m-d");
	
	if($is_fail == 0){
		//Armamos la sentencia SQL de UPDATE
		$sql = "UPDATE documento_visita_propiedades SET ";
		$sql .= "reporte_documento_visita_propiedad = '".$reporte_documento_visita_propiedad."', ";
		$sql .= "is_close_documento_visita_propiedad = 1, ";
		$sql .= "fecha_cierre_documento_visita_propiedad = '".$fecha_cierre_documento_visita_propiedad."' ";
		$sql .= "WHERE id_documento_visita_propiedad = ".$id_documento_visita_propiedad;
		$modifica = $conexion->prepare($sql);
		echo $sql;
		if($modifica->execute()){
			
			$_SESSION["mensaje-sistema"] = "Exito: Proceso terminado sin problemas, saludos.";
		}else{
			$_SESSION["mensaje-sistema"] = "Error: Hubo un problema con el sistema, favor contactar al administrador del sitio.";
			$if_fail = 1;
		}
	}else{
		$_SESSION["mensaje-sistema"] = "Error: Recuerde que debe haber informacion dentro del reporte, favor intentar nuevamente.";
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	echo $_SESSION["mensaje-sistema"];
	//header("location: ../pages/ver-documento-visita.php");
?>
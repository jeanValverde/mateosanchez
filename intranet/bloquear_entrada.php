<?php
	session_start();
	require_once('../admin/php/rutinas.php');
	$_SESSION["mensaje-login"] = "Usuario o clave incorrecto.";
	$is_fail = 1;
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-login"] = getMessage($tipo_mensaje, $_SESSION["mensaje-login"]);
	
	header("location: index.php");
?>
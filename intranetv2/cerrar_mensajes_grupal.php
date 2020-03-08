<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	$array = $_POST["to_close_id_mensaje"];
	foreach ($array as &$valor) {
		//Se actualiza el registro segun el valor generado anteriormente
		$sql = "UPDATE mensajes SET";
		$sql .= " is_close = '1'";
		$sql .= " WHERE id_mensaje = ".$valor;
		
		$modifica = $conexion->prepare($sql);
		$modifica->execute();
	}
	header("location: ver-notas.php?id_receptor=");
?>
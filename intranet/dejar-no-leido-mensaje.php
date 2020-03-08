<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	//Armamos la SQL para crear la nueva cuenta
	$sql = "UPDATE mensajes SET ";
	$sql .= "is_reeded = 0 ";
	$sql .= "WHERE id_mensaje = ".$_GET["id_mensaje"];
	
	//Con el SQL listo se armara la transaccion PDO
	$modifica = $conexion->prepare($sql);
	
	//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
	$modifica->execute();
	
	header("Location: ".$_SESSION["url_mensaje"]);
?>
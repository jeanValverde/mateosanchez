<?php
	require_once('../php/session_life.php');
	session_start();
	require_once('../php/rutinas.php');
	//$_SESSION["is_link_externo"] == 0;
	//$_SESSION["cache-navegacion"] == "";
	if(isset($_COOKIE["nombre_cuenta"]) && isset($_COOKIE["clave_cuenta"])){
		$nombre_cuenta = $_COOKIE["nombre_cuenta"];
		$clave_cuenta = $_COOKIE["clave_cuenta"];
		$sql_validar_cuenta = "SELECT * FROM cuentas WHERE nombre_cuenta='".$nombre_cuenta."' AND clave_cuenta='".$clave_cuenta."' AND can_admin=1";
		$cursor_validar_cuenta = $conexion -> query($sql_validar_cuenta);
		$validar_cuenta = $cursor_validar_cuenta -> rowCount();
		if($validar_cuenta != 1){
			//$_SESSION["is_link_externo"] == 1;
			//$_SESSION["cache-navegacion"] == $_SERVER["REQUEST_URI"];
			$_SESSION["mensaje-login"] = getMessage("alert-danger", "Los datos no corresponden, favor iniciar sesi&oacute;n");
			header("location: ../index.html");
		}
		$cuenta = $cursor_validar_cuenta -> fetch();
	}else{
		//$_SESSION["is_link_externo"] == 1;
		//$_SESSION["cache-navegacion"] == $_SERVER["REQUEST_URI"];
		$_SESSION["mensaje-login"] = getMessage("alert-danger", "Los datos no corresponden, favor iniciar sesi&oacute;n");
		header("location: ../index.html");
	}
?>
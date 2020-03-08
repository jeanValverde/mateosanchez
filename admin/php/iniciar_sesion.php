<?php
	session_start();
	require_once('rutinas.php');
	$_SESSION["mensaje-login"] = "";
	$is_fail = 0;
	$pagina_destino = "";
	
	// Validar datos de ingreso
	if(!isset($_POST['correo_cuenta']) || !isset($_POST['clave_cuenta'])){
		$_SESSION["mensaje-login"] = "Usuario o clave no ingresado.";
		$is_fail = 1;
	}else{
		
		$correo_cuenta = $_POST['correo_cuenta'];
		$clave_cuenta = $_POST['clave_cuenta'];
		
		$sql = "SELECT * FROM cuentas WHERE correo_cuenta='".$correo_cuenta."' AND clave_cuenta='".$clave_cuenta."' AND can_admin=1";
		$cursor = $conexion -> query($sql);
		if($cuenta = $cursor -> fetch()){
			$_SESSION["nombre_cuenta"] = $cuenta["nombre_cuenta"];
			setcookie("nombre_cuenta", $cuenta["nombre_cuenta"], time()+28800,'/'); //Cookie con duracion de 8 horas
			$_SESSION["correo_cuenta"] = $cuenta["correo_cuenta"];
			setcookie("correo_cuenta", $cuenta["correo_cuenta"], time()+28800,'/'); //Cookie con duracion de 8 horas
			$_SESSION["clave_cuenta"] = $cuenta["clave_cuenta"];
			setcookie("clave_cuenta", $cuenta["clave_cuenta"], time()+28800,'/'); //Cookie con duracion de 8 horas
			$_SESSION["nivel_cuenta"] = $cuenta["lvl_cuenta"];
			setcookie("nivel_cuenta", $cuenta["lvl_cuenta"], time()+28800,'/'); //Cookie con duracion de 8 horas
			$_SESSION["id_cuenta"] = $cuenta["id_cuenta"];
			setcookie("id_cuenta", $cuenta["id_cuenta"], time()+28800,'/'); //Cookie con duracion de 8 horas
			$_SESSION["id_franquicia"] = $cuenta["id_franquicia"];
			setcookie("id_franquicia", $cuenta["id_franquicia"], time()+28800,'/'); //Cookie con duracion de 8 horas
		}else{
			$_SESSION["mensaje-login"] = "Usuario o clave incorrecto.";
			$is_fail = 1;
		}
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-login"] = getMessage($tipo_mensaje, $_SESSION["mensaje-login"]);
	
	//if(isset($_SESSION["is_link_externo"]) && $_SESSION["is_link_externo"] == 1){
	//	$pagina_destino = $_SESSION["cache-navegacion"];
	//}else{
	//	$pagina_destino = "../pages/home.php";
	//}
	
	header("location: ../pages/home.php");
?>
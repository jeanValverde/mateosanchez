<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_POST['id_mensaje']) && !empty($_POST['id_mensaje'])){
		$id_mensaje = $_POST['id_mensaje'];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["id_cuenta"]) && !empty($_POST["id_cuenta"])){
		$id_cuenta = $_POST["id_cuenta"];
	}else{
		$is_fail = 1;
	}
	
	if($is_fail == 0 && $is_test == 0){
	
		//Armamos la SQL para crear la nueva cuenta
		$sql = "UPDATE mensajes SET ";
		$sql .= "id_cuenta = ".$id_cuenta.", ";
		$sql .= "is_reeded = 0 ";
		$sql .= "WHERE id_mensaje = ".$id_mensaje;
		
		//Con el SQL listo se armara la transaccion PDO
		$modifica = $conexion->prepare($sql);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$modifica->execute();
		$_SESSION["mensaje-sistema"] = "Nota reenviada con exito, que tenga un buen d&iacute;a.";
	}else{
		$_SESSION["mensaje-sistema"] = "Problema con los datos entregados, favor contactar con PCDStudio.";
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	echo $sql;
	header("location: ver-notas.php?id_receptor=");
	
?>
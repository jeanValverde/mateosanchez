<?php
	session_start();
	require_once('rutinas.php');
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_POST['nombre_persona']) && !empty($_POST['nombre_persona'])){
		$nombre_persona = $_POST['nombre_persona'];
		
		echo "Nombre de la persona: ".$_POST['nombre_persona'];
		echo "<br>";
	}else{
		$is_fail = 1;
		echo "Nombre de la persona: No disponible";
		echo "<br>";
	}
	
	if(isset($_POST['telefono_persona']) && !empty($_POST['telefono_persona'])){
		$telefono_persona = $_POST['telefono_persona'];
		
		echo "Telefono de la persona: ".$_POST['telefono_persona'];
		echo "<br>";
	}else{
		$is_fail = 1;
		echo "Telefono de la persona: No disponible";
		echo "<br>";
	}
	
	if(isset($_POST['correo_persona']) && filter_var($_POST['correo_persona'], FILTER_VALIDATE_EMAIL)){
		$correo_persona = $_POST['correo_persona'];
			
		echo "Correo electronico de la persona: ".$_POST['correo_persona'];
		echo "<br>";
		
	}else{
		$is_fail = 1;
		echo "Correo electronico de la persona: No disponible";
		echo "<br>";
	}
	
	if(isset($_POST['detalle_persona']) && !empty($_POST['detalle_persona'])){
		$detalle_persona = $_POST['detalle_persona'];
		echo "Detalle de la peticion: ".$_POST['detalle_persona'];
		echo "<br>";
	}else{
		$detalle_persona = "";
		echo "Detalle de la peticion: No disponible";
		echo "<br>";
	}
	
	if(isset($_POST['id_franquicia'])){
		$id_franquicia = $_POST['id_franquicia'];
	}else{
		$is_fail=1;
	}
	
	if($is_fail == 0 && $is_test == 0){
		//Armamos la SQL para crear la peticion
		$sql = "INSERT INTO peticiones ";
		$sql .= "(nombre_persona_peticion, "; //:param_01
		$sql .= "telefono_persona_peticion, "; //:param_02
		$sql .= "correo_persona_peticion, "; //:param_03
		$sql .= "detalle_persona_peticion, "; //:param_04
		$sql .= "fecha_inscripcion_peticion, "; //:param_05
		$sql .= "fecha_cierre_peticion, ";
		$sql .= "id_franquicia) "; //:param_06
		$sql .= "VALUES ";
		$sql .= "('".utf8_decode($nombre_persona)."', ";
		$sql .= "'".$telefono_persona."', ";
		$sql .= "'".$correo_persona."', ";
		$sql .= "'".utf8_decode($detalle_persona)."', ";
		$sql .= "now(), ";
		$sql .= "now(),";
		$sql .= "'".$id_franquicia."');";
		
		//Con el SQL listo se armara la transaccion PDO
		$inserta = $conexion -> prepare($sql);
		
		if($inserta -> execute()){
			$_SESSION["mensaje-sistema"] .= "Petici&oacute;n ingresada, muchas gracias por su preocupaci&oacute;n.";
		}else{
			$_SESSION["mensaje-sistema"] .= "Problema con el proceso de la petici&oacute;n, favor intentar nuevamente.";
		}
		
		header("location: ../../resultado-buscador.php");
	}else{
		$_SESSION["mensaje-sistema"] .= "Datos ingresados no concuerdan con lo pedido.";
		echo "<a href='../../resultado-buscador.php'>Volver</a>";
	}
?>
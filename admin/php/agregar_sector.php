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
	
	if(isset($_POST['nombre_sector']) && !empty($_POST['nombre_sector'])){
		$nombre_sector = ucwords($_POST['nombre_sector']);
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST['id_comuna']) && !empty($_POST['id_comuna'])){
		$id_comuna = $_POST['id_comuna'];
	}else{
		$is_fail = 1;
	}
	
	if($is_fail == 0 && $is_test == 0){
	
		//Armamos la SQL para crear la nueva cuenta
		$sql = "INSERT INTO sectores ";
		$sql .= "(id_comuna, "; //:param_01
		$sql .= "nombre_sector) "; //:param_02
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $id_comuna);
		$inserta -> bindValue(':param_02', utf8_decode($nombre_sector));
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
		
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Proceso terminado con exito.</div>";
	}else{
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Error con el nombre del sector, favor intentar nuevamente.</div>";
	}
	
	header("location: ../pages/ver-sectores.php");
?>
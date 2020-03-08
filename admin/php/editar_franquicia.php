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
	
	if(isset($_POST["id_franquicia"]) && !empty($_POST["id_franquicia"])){
		$sql_franquicia = "SELECT * FROM franquicias WHERE id_franquicia=".$_POST["id_franquicia"];
		$cursor_franquicia = $conexion -> query($sql_franquicia);
		if($franquicia = $cursor_franquicia -> fetch()){
			$id_franquicia = $_POST["id_franquicia"];
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Franquicia no registrada favor intentar de nuevo.</div>";
		}
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Franquicia no registrada favor intentar de nuevo.</div>";
	}
	
	if(isset($_POST['nombre_franquicia']) && !empty($_POST['nombre_franquicia']) && $_POST['nombre_franquicia'] != $franquicia['nombre_franquicia']){
		$nombre_franquicia = $_POST['nombre_franquicia'];
		
		echo "Nombre de la Franquicia: ".$_POST['nombre_franquicia'];
		echo "<br>";
	}else{
		$nombre_franquicia = $franquicia['nombre_franquicia'];
	}
	
	if(isset($_POST['id_region']) && !empty($_POST['id_region']) && $_POST['id_region'] != $franquicia["id_region"]){
		$sql_validar = "SELECT * FROM regiones WHERE id_region='".$_POST['id_region']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_region = $cursor_validar -> rowCount();
		
		if($validar_region == 1){
			$id_region = $_POST['id_region'];
			
			echo "ID de la Region; ".$_POST['id_region'];
			echo "<br>";
		}else{
			$id_region = $franquicia['id_region'];
		}
	}else{
		$id_region = $franquicia['id_region'];
	}
	
	if(isset($_POST['id_comuna']) && !empty($_POST['id_comuna']) && $_POST['id_comuna'] != $franquicia["id_comuna"]){
		$sql_validar = "SELECT * FROM comunas WHERE id_comuna='".$_POST['id_comuna']."'";
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_comuna = $cursor_validar -> rowCount();
		
		if($validar_comuna == 1){
			$id_comuna = $_POST['id_comuna'];
			
			echo "ID de la comuna: ".$_POST['id_comuna'];
			echo "<br>";
		}else{
			$id_comuna = $franquicia['id_comuna'];
		}
	}else{
		$id_comuna = $franquicia['id_comuna'];
	}
	
	if(isset($_POST['direccion_franquicia']) && !empty($_POST['direccion_franquicia']) && $_POST['direccion_franquicia'] != $franquicia['direccion_franquicia']){
		$direccion_franquicia = $_POST['direccion_franquicia'];
		
		echo "Direccion de la franquicia: ".$_POST['direccion_franquicia'];
		echo "<br>";
	}else{
		$direccion_franquicia = $franquicia['direccion_franquicia'];
	}
	
	if(isset($_POST['telefono_fijo_franquicia']) && !empty($_POST['telefono_fijo_franquicia']) && $_POST['telefono_fijo_franquicia'] != $franquicia['telefono_fijo_franquicia']){
		$telefono_fijo_franquicia = $_POST['telefono_fijo_franquicia'];
		
		echo "Telefono fijo de la Franquicia: ".$_POST['telefono_fijo_franquicia'];
		echo "<br>";
	}else{
		$telefono_fijo_franquicia = $franquicia['telefono_fijo_franquicia'];
	}
	
	if(isset($_POST['telefono_fijo_franquicia']) && !empty($_POST['telefono_fijo_franquicia']) && $_POST['telefono_fijo_franquicia'] != $franquicia['telefono_movil_franquicia']){
		$telefono_movil_franquicia = $_POST['telefono_movil_franquicia'];
		
		echo "Telefono movil de la Franquicia: ".$_POST['telefono_movil_franquicia'];
		echo "<br>";
	}else{
		$telefono_movil_franquicia = $franquicia['telefono_movil_franquicia'];
	}
	
	if(isset($_POST['representante_franquicia']) && !empty($_POST['representante_franquicia']) && $_POST['representante_franquicia'] = $_POST['representante_franquicia']){
		$representante_franquicia = $_POST['representante_franquicia'];
		
		echo "Nombre del Representante de la Franquicia: ".$_POST['representante_franquicia'];
		echo "<br>";
	}else{
		$representante_franquicia = $franquicia['representante_franquicia'];
	}
	
	if(isset($_POST['fono_contacto_representante']) && !empty($_POST['fono_contacto_representante']) && $_POST['fono_contacto_representante'] != $_POST['fono_contacto_representante']){
		$fono_contacto_representante = $_POST['fono_contacto_representante'];
		
		echo "Telefono de contacto del Representante: ".$_POST['fono_contacto_representante'];
		echo "<br>";
	}else{
		$fono_contacto_representante = $franquicia['fono_contacto_representante'];
	}
	
	if(isset($_POST['detalle_franquicia']) && !empty($_POST['detalle_franquicia']) && $_POST['detalle_franquicia'] != $franquicia['detalles_franquicia']){
		$detalle_franquicia = $_POST['detalle_franquicia'];
		
		echo "Detalle de la Franquicia: ".$_POST['detalle_franquicia'];
		echo "<br>";
	}else{
		$detalle_franquicia = $franquicia['detalles_franquicia'];
	}
	
	if($is_fail == 0 && $is_test == 0){
		//Armamos la SQL para crear la Franquicia
		$sql = "UPDATE franquicias ";
		$sql .= "SET nombre_franquicia = '".$nombre_franquicia."', "; //:param_01
		$sql .= "id_region = '".$id_region."', "; //:param_02
		$sql .= "id_comuna = '".$id_comuna."', "; //:param_03
		$sql .= "direccion_franquicia = '".$direccion_franquicia."', "; //:param_04
		$sql .= "telefono_fijo_franquicia = '".$telefono_fijo_franquicia."', "; //:param_05
		$sql .= "telefono_movil_franquicia = '".$telefono_movil_franquicia."', "; //:param_06
		$sql .= "representante_franquicia = '".$representante_franquicia."', "; //:param_08
		$sql .= "fono_contacto_representante = '".$fono_contacto_representante."', "; //:param_09
		$sql .= "detalles_franquicia = '".nl2br($detalle_franquicia)."' "; //:param_10
		$sql .= "WHERE id_franquicia = '".$id_franquicia."'";
		
		$modifica = $conexion->prepare($sql);
		if($modifica->execute()){
			
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Exito!</strong> La Franquicia fue editada sin problemas.</div>";
		}else{
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Problema con el proceso de edici&oacute;n de la franquicia.</div>";
		}
		
		
		header("location: ../pages/ver-franquicias.php");
	}else{
		echo "<a href='../pages/ver-franquicias.php'>Volver</a>";
	}
?>
<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '0'); //Muestra de errores desactivado
	require_once("rutinas.php");
	
	$sql_tipo_documento = "SELECT * FROM tipo_documentos WHERE id_tipo_documento=".$_GET["id_tipo_documento"];
	$cursor_tipo_documento = $conexion -> query($sql_tipo_documento);
	$tipo_documento = $cursor_tipo_documento -> fetch();
	
	if(!isset($_GET["porcentaje_tipo_documento"]) || empty($_GET["porcentaje_tipo_documento"])){
		$_GET["porcentaje_tipo_documento"] = $tipo_documento["porcentaje_base_tipo_documento"];
	}
	
	switch ($_GET["id_tipo_documento"]) {
		case 1:
			require_once("cargar-pdf-orden-arriendo-comercial.php");
			break;
		case 2:
			require_once("cargar-pdf-orden-arriendo-residencial.php");
			break;
		case 3:
			require_once("cargar-pdf-orden-venta-comercial.php");
			break;
		case 4:
			require_once("cargar-pdf-orden-venta-residencial.php");
			break;
	}
	
	$is_reservado = 1;
	$is_hidden = 1;
	
	$sql_validar = "SELECT * FROM propiedades WHERE cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_validar = $conexion -> query($sql_validar);
	
	if(!$validar = $cursor_validar -> rowCount()){
		$validar = 0;
	}
	
	if($validar == 0){
		$sql = "INSERT INTO propiedades ";
		$sql .= "(cod_propiedad, "; //:param_01
		$sql .= "is_reservado, "; //:param_02
		$sql .= "is_hidden, "; //:param_03
		$sql .= "id_cuenta) "; //:param_04
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04)";
		
		//Con el SQL listo se armara la transaccion PDO
		
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $_GET["cod_propiedad"]);
		$inserta -> bindValue(':param_02', $is_reservado);
		$inserta -> bindValue(':param_03', $is_hidden);
		$inserta -> bindValue(':param_04', $_GET["id_cuenta"]);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
		
		$sql = "INSERT INTO documentos_propiedades ";
		$sql .= "(id_tipo_documento, "; //:param_01
		$sql .= "porcentaje_editado_documento_propiedad, "; //:param_02
		$sql .= "cod_propiedad) "; //:param_03
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03)";
		
		//Con el SQL listo se armara la transaccion PDO
		
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $_GET["id_tipo_documento"]);
		$inserta -> bindValue(':param_02', $_GET["porcentaje_tipo_documento"]);
		$inserta -> bindValue(':param_03', $_GET["cod_propiedad"]);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
	}
	
	exit;
?>
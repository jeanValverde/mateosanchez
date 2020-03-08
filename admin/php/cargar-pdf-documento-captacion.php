<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '0'); //Muestra de errores desactivado
	require_once("rutinas.php");
	
	$sql_documento = "SELECT * FROM documentos_propiedades WHERE cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_documento = $conexion->query($sql_documento);
	$documento = $cursor_documento->fetch();
	
	$_GET["id_tipo_documento"] = $documento["id_tipo_documento"];
	
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
	
	exit;
?>

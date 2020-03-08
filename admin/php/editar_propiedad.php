<?php
	session_start();
	require_once('rutinas.php');
	include('SimpleImage.php');
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	$is_test = 0; //indicador si esta en formato de pruebas, 0->No; 1->Si
	$is_fail = 0; //iniciador del indicador si hubo algun fallo durante el proceso, 0->No; 1->Si
	$is_fail_documentador = 0;
	$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "BMP", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir
	$_SESSION["mensaje-sistema"] = ""; //Inicializar el mensaje del sistema para adherir errores o exitos
	$_SESSION["mensaje-prueba"] = ""; //Inicializar el mensaje de pruebas para revisiones
	
	//Verificacion de datos---------------------------------------------------------------------------------------------
	if(isset($_POST["id_propiedad"]) && is_numeric($_POST["id_propiedad"])){
		$sql_validar = "SELECT * FROM propiedades WHERE id_propiedad=".$_POST["id_propiedad"];
		$cursor_validar = $conexion -> query($sql_validar);
		$validar_propiedad = $cursor_validar -> rowCount();
		
		if($validar_propiedad == 0){
			$is_fail = 1;
			//echo "<p>Propiedad: no encontrada</p>";
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Propiedad no encontrada para editar, favor intentar nuevamente.</div>";
		}else{
			$propiedad = $cursor_validar -> fetch();
			//echo "<p>Propiedad: encontrada</p>";
		}
	}else{
		$is_fail = 1;
		//echo "<p>Propiedad: no valida</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Propiedad no valida, favor contactar a PCDStudio.</div>";
	}
	
	if(isset($_POST["observaciones_propietario"]) && !empty($_POST["observaciones_propietario"])){
		$observacion_propietario = $_POST["observaciones_propietario"];
		//echo "<p>Observaciones propietario: ".$observacion_propietario."</p>";
	}else{
		$observacion_propietario = $propiedad["observaciones_propietario"];
		//echo "<p>Observaciones propietario: Error - Se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No hay cambios en las observaciones sobre el propietario, se mantendran las actuales.</div>";
	}
	
	if(isset($POST["rol_propiedad"])){
		$rol_propiedad = $POST["rol_propiedad"];
	}else{
		$rol_propiedad = $propiedad["rol_propiedad"];
		//echo "<p>Rol propiedad: Error - Se mantiene el actual.</p>";
	}
		
	
	if(isset($_POST["id_tipo_codigo"]) && !empty($_POST["id_tipo_codigo"])){
		$id_tipo_codigo = $_POST["id_tipo_codigo"];
		
		$sql_validar_codigo = "SELECT * FROM propiedades WHERE cod_propiedad=".$_POST["cod_propiedad"];
		$cursor_validar_codigo = $conexion -> query($sql_validar_codigo);
		if(!$validar_codigo = $cursor_validar_codigo -> rowCount()){
			$validar_codigo = 0;
		}
		
		if($validar_codigo == 0){
			$cod_propiedad = $_POST["cod_propiedad"];
			//echo "<p>Codigo de captacion propietario: ".$cod_propiedad."</p>";
			//echo "<p>Codigo de captacion propietario: Valido</p>";
		}else{
			$cod_propiedad = $propiedad["cod_propiedad"];
			//echo "<p>Codigo de captacion propietario: Repetido</p>";
		}
		
	}else{
		$id_tipo_codigo = $propiedad["id_tipo_codigo"];
		$cod_propiedad = $propiedad["cod_propiedad"];
		//echo "<p>Codigo de captacion propietario: Codigo no valido, se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Codigo no valido, se mantiene el actual.</div>";
	}
	
	if(isset($_POST["id_tipo_operacion"]) && !empty($_POST["id_tipo_operacion"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_operacion = $_POST["id_tipo_operacion"];
		//echo "<p>Tipo de operacion: ".$id_tipo_operacion."</p>";
	}else{
		$id_tipo_operacion = $propiedad["id_tipo_operacion"];
		//echo "<p>Tipo de operacion: Error - Se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Tipo de operaci&oacute;n no valido, se mantiene el actual.</div>";
	}
	
	if(isset($_POST["id_tipo_propiedad"]) && !empty($_POST["id_tipo_propiedad"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_propiedad = $_POST["id_tipo_propiedad"];
		//echo "<p>Tipo de propiedad: ".$id_tipo_propiedad."</p>";
	}else{
		$id_tipo_propiedad = $propiedad["id_tipo_propiedad"];
		//echo "<p>Tipo de propiedad: Error - no asignado, se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Tipo de propiedad no valida, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["direccion_propiedad"]) && !empty($_POST["direccion_propiedad"])){
		$direccion_propiedad = $_POST["direccion_propiedad"];
		//echo "<p>Direccion de la propiedad: ".$direccion_propiedad."</p>";
	}else{
		$direccion_propiedad = $propiedad["direccion_propiedad"];
		//echo "<p>Direccion de la propiedad: Error - no asignado, se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No se ingreso direcci&oacute;n de la propiedad, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["id_region"]) && !empty($_POST["id_region"]) && is_numeric($_POST["id_region"])){
		$id_region = $_POST["id_region"];
		//echo "<p>Region de la propiedad: ".$id_region."</p>";
	}else{
		$id_region = $propiedad["id_region"];
		//echo "<p>Region de la propiedad: Error - no asignado, se mantiene la actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Region ingresada no valida, se mantiene la actual.</div>";
	}
	
	if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"]) && is_numeric($_POST["id_comuna"])){
		$id_comuna = $_POST["id_comuna"];
		//echo "<p>Comuna de la propiedad: ".$id_comuna."</p>";
	}else{
		$id_comuna = $propiedad["id_comuna"];
		//echo "<p>Comuna de la propiedad: Error - no asignado, se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Comuna ingresada no valida, se mantiene el actual.</div>";
	}
	
	if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"]) && is_numeric($_POST["id_sector"])){
		$id_sector = $_POST["id_sector"];
		//echo "<p>Sector de la propiedad: ".$id_sector."</p>";
	}else{
		$id_sector = $propiedad["id_sector"];
		//echo "<p>Sector de la propiedad: Error - no asignado, se mantiene el actual.</p>";
		
	}
	
	$is_comercial = 0;
	
	$id_tipo_giro = $_POST["id_tipo_giro"];
	
	if(isset($_POST["valor"]) && !empty($_POST["valor"])){
		$valor_propiedad = str_replace(",",".", $_POST["valor"]);
		if(substr($valor_propiedad, -1) == "."){
			$valor_propiedad = substr($valor_propiedad, 0, -1);
		}
		//echo "<p>Valor de la propiedad: ".$valor_propiedad."</p>";
	}else{
		$valor_propiedad = $propiedad["valor_propiedad"];
		//echo "<p>Valor de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar cifras num&eacute;ricas para valor de la propiedad, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["id_tipo_valor"]) && !empty($_POST["id_tipo_valor"]) && is_numeric($_POST["id_tipo_valor"])){
		$id_tipo_valor = $_POST["id_tipo_valor"];
		//echo "<p>Tipo de valor de la propiedad: ".$id_tipo_valor."</p>";
	}else{
		$id_tipo_valor = $propiedad["id_tipo_valor"];
		//echo "<p>Tipo de valor de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Tipo de valor no valido, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["dormitorios_propiedad"]) && is_numeric($_POST["dormitorios_propiedad"])){
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		//echo "<p>Numero de habitaciones de la propiedad: ".$dormitorios_propiedad."</p>";
	}else{
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		//echo "<p>Numero de habitaciones de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para el n&uacute;mero de habitaciones, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["banos_propiedad"]) && is_numeric($_POST["banos_propiedad"])){
		$banos_propiedad = $_POST["banos_propiedad"];
		//echo "<p>Numero de ba&ntilde;os de la propiedad: ".$banos_propiedad."</p>";
	}else{
		$banos_propiedad = $propiedad["banos_propiedad"];
		//echo "<p>Numero de ba&ntilde;os de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para el n&uacute;mero de ba&ntilde;os, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["nro_estacionamiento"]) && is_numeric($_POST["nro_estacionamiento"])){
		$nro_estacionamiento = $_POST["nro_estacionamiento"];
		//echo "<p>Numero de estacionamientos de la propiedad: ".$nro_estacionamiento."</p>";
	}else{
		$nro_estacionamiento = $propiedad["nro_estacionamiento"];
		//echo "<p>Numero de estacionamientos de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para el n&uacute;mero de estacionamientos, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["nro_bodega"]) && is_numeric($_POST["nro_bodega"])){
		$nro_bodega = $_POST["nro_bodega"];
		//echo "<p>Numero de bodegas de la propiedad: ".$nro_bodega."</p>";
	}else{
		$nro_bodega = $propiedad["nro_bodega"];
		//echo "<p>Numero de bodegas de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para el n&uacute;mero de bodegas, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["cantidad_superficie_total_propiedad"]) && is_numeric($_POST["cantidad_superficie_total_propiedad"])){
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		//echo "<p>Cantidad de la superficie total de la propiedad: ".$cantidad_superficie_total_propiedad."</p>";
	}else{
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		//echo "<p>Cantidad de la superficie total de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para la superficie total, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["cantidad_superficie_construida_propiedad"]) && is_numeric($_POST["cantidad_superficie_construida_propiedad"])){
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"];
		//echo "<p>Cantidad de la superficie construida de la propiedad: ".$cantidad_superficie_construida_propiedad."</p>";
	}else{
		$cantidad_superficie_construida_propiedad = $propiedad["cantidad_superficie_construida_propiedad"];
		//echo "<p>Cantidad de la superficie construida de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Solo ingresar valores num&eacute;ricas para la superficie construida, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["id_unidad_medida"]) && !empty($_POST["id_unidad_medida"]) && is_numeric($_POST["id_unidad_medida"])){
		$id_unidad_medida = $_POST["id_unidad_medida"];
		//echo "<p>Unidad de medida de la propiedad: ".$id_unidad_medida."</p>";
	}else{
		$id_unidad_medida = $_POST["id_unidad_medida"];
		//echo "<p>Unidad de medida de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Tipo de medici&oacute;n no valido, se mantendra el actual.</div>";
	}
	
	if(isset($_POST["detalle_propiedad"]) && !empty($_POST["detalle_propiedad"])){
		$detalle_propiedad = $_POST["detalle_propiedad"];
		//echo "<p>Detalle de la propiedad: ".$detalle_propiedad."</p>";
	}else{
		$detalle_propiedad = $_POST["detalle_propiedad"];
		//echo "<p>Detalle de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Debe tener informaci&oacute;n el detalle para la propiedad, se mantendra el actual.</div>";
	}
	//validacion detalle corredor
	if(isset($_POST["detalle_corredor"]) && !empty($_POST["detalle_corredor"])){
		$detalle_corredor = $_POST["detalle_corredor"];
		//echo "<p>Detalle del corredor: ".$detalle_corredor."</p>";
	}else{
		$detalle_corredor = $_POST["detalle_corredor"];
		//echo "<p>Detalle del corredor: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Debe tener informaci&oacute;n el detalle para la propiedad, se mantendra el actual.</div>";
	}
	if(isset($_POST["titulo_propiedad"]) && !empty($_POST["titulo_propiedad"])){
		$titulo_ppropiedad = $_POST["titulo_propiedad"];
		//echo "<p>titulo propiedad: ".$titulo_propiedad."</p>";
	}else{
		$titulo_ppropiedad = $_POST["titulo_propiedad"];
		//echo "<p>Detalle de la propiedad: Error - no asignado, se mantendra el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Debe tener informaci&oacute;n el detalle para la propiedad, se mantendra el actual.</div>";
	}
	
	//echo "Proceso de subida de archivos iniciado...<br>";
	if(isset($_POST["flag_estado"]) && is_numeric($_POST["flag_estado"])){
		$flag_estado = $_POST["flag_estado"];
	}else{
		$flag_estado = 0;
	}
	
	if(isset($_POST["is_promesado"]) && is_numeric($_POST["is_promesado"])){
		$is_promesado = $_POST["is_promesado"];
	}else{
		$is_promesado = 0;
	}
	
	if(isset($_POST["is_exclusivo"]) && is_numeric($_POST["is_exclusivo"])){
		$is_exclusivo = $_POST["is_exclusivo"];
	}else{
		$is_exclusivo = 0;
	}
	
	if(isset($_POST["is_oportunidad"]) && is_numeric($_POST["is_oportunidad"])){
		$is_oportunidad = $_POST["is_oportunidad"];
	}else{
		$is_oportunidad = 0;
	}
	
	if(isset($_POST["id_convenio"])){
		$id_convenio = $_POST["id_convenio"];

		$sql = "DELETE FROM propiedades_convenios WHERE id_propiedad=".$propiedad["id_propiedad"];
		$borra = $conexion->prepare($sql);
		$borra->execute();
		
		foreach ($id_convenio as $id=>$value) {
			$sql = "INSERT INTO propiedades_convenios ";
			$sql .= "(id_propiedad, "; //:param_01
			$sql .= "id_convenio) "; //:param_02
			$sql .= "VALUES ";
			$sql .= "(:param_01, ";
			$sql .= ":param_02)";
			
			//Con el SQL listo se armara la transaccion PDO
			$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion -> beginTransaction();
			$inserta = $conexion -> prepare($sql);
			$inserta -> bindValue(':param_01', $propiedad["id_propiedad"]);
			$inserta -> bindValue(':param_02', $value);
			
			$inserta -> execute();
			$conexion -> commit();
		}
	}
	
	//-------------------------------SECCION DOCUMENTADOR----------------------------------
	if(isset($_POST["nombre_cliente"])){
		$nombre_cliente = $_POST["nombre_cliente"];
	}
	
	if(isset($_POST["direccion_cliente"])){
		$direccion_cliente = $_POST["direccion_cliente"];
	}
	
	if(isset($_POST["rut_cliente"])){
		$rut_cliente = $_POST["rut_cliente"];
	}
	
	if(isset($_POST["telefono_cliente"])){
		$telefono_cliente = $_POST["telefono_cliente"];
	}
	
	if(isset($_POST["correo_cliente"])){
		$correo_cliente = $_POST["correo_cliente"];
	}
	
	if(isset($_POST["nombre_contacto_cliente"]) && !empty($_POST["nombre_contacto_cliente"])){
		$nombre_contacto_cliente = $_POST["nombre_contacto_cliente"];
	}
	
	if(isset($_POST["telefono_contacto_cliente"]) && !empty($_POST["telefono_contacto_cliente"])){
		$telefono_contacto_cliente = $_POST["telefono_contacto_cliente"];
	}
	
	if(isset($_POST["plazo_exclusividad_inicio"]) && !empty($_POST["plazo_exclusividad_inicio"])){
		$plazo_exclusividad_inicio = $_POST["plazo_exclusividad_inicio"];
	}else{
		$plazo_exclusividad_inicio= "00-00-0000";
	}
	
	if(isset($_POST["plazo_exclusividad_fin"]) && !empty($_POST["plazo_exclusividad_fin"])){
		$plazo_exclusividad_fin = $_POST["plazo_exclusividad_fin"];
	}else{
		$plazo_exclusividad_fin = "00-00-0000";
	}

	if(!isset($_POST["is_exclusivo"])){
		$is_fail_documentador = 1;
	}
	
	if($is_fail_documentador == 0){
		$sql = "UPDATE documentos_propiedades SET ";
		$sql .= "is_exclusivo='".$_POST["is_exclusivo"]."', ";
		$sql .= "is_publicidad='".$_POST["is_publicidad"]."', ";
		$sql .= "plazo_exclusividad_inicio='".$plazo_exclusividad_inicio."', ";
		$sql .= "plazo_exclusividad_fin='".$plazo_exclusividad_fin."', ";
		$sql .= "is_renovable='".$_POST["is_renovable"]."', ";
		$sql .= "is_entrega_llaves='".$_POST["is_entrega_llaves"]."', ";
		$sql .= "inscrito_fojas='".$_POST["inscrito_fojas"]."', ";
		$sql .= "inscrito_numero='".$_POST["inscrito_numero"]."', ";
		$sql .= "inscrito_ano='".$_POST["inscrito_ano"]."', ";
		$sql .= "inscrito_cbr='".$_POST["inscrito_cbr"]."', ";
		$sql .= "nombre_cliente='".$_POST["nombre_cliente"]."', ";
		$sql .= "direccion_cliente='".$_POST["direccion_cliente"]."', ";
		$sql .= "rut_cliente='".$_POST["rut_cliente"]."', ";
		$sql .= "telefono_cliente='".$_POST["telefono_cliente"]."', ";
		$sql .= "correo_cliente='".$_POST["correo_cliente"]."', ";
		$sql .= "nombre_contacto_cliente='".$_POST["nombre_contacto_cliente"]."', ";
		$sql .= "telefono_contacto_cliente='".$_POST["telefono_contacto_cliente"]."' ";
		$sql .= "WHERE cod_propiedad=".$propiedad["cod_propiedad"];
		echo $sql;
		$modifica = $conexion->prepare($sql);
		$modifica->execute();
	}
	
	//-------------------------------FIN SECCION DOCUMENTADOR----------------------------------
	
	if($_POST["flag_borrar_img_01"] == 1){
		if($propiedad["img_01_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_01_propiedad"]);
		}
		$img_01_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_01_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_01_propiedad"]["type"] == "image/gif") || ($_FILES["img_01_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_01_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_01_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_01_propiedad']['size'] < 6000000){
			if ($_FILES["img_01_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_01_propiedad = $propiedad["img_01_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_01_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_01_propiedad));
				
				if (is_uploaded_file($_FILES["img_01_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_01_propiedad"]["tmp_name"], $img_01_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_01_propiedad);
					$size = getimagesize($img_01_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_01_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename($img_01_propiedad,"../../propiedades/".$img_01_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename($img_01_propiedad,"../../propiedades/".$img_01_propiedad);
					
					if($propiedad["img_01_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_01_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_01_propiedad = $propiedad["img_01_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_01_propiedad = $propiedad["img_01_propiedad"];
		}
	}
	
	
	
	if($_POST["flag_borrar_img_02"] == 1){
		if($propiedad["img_02_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_02_propiedad"]);
		}
		$img_02_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_02_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_02_propiedad"]["type"] == "image/gif") || ($_FILES["img_02_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_02_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_02_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_02_propiedad']['size'] < 6000000){
			if ($_FILES["img_02_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_02_propiedad = $propiedad["img_02_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_02_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_02_propiedad));
				
				if (is_uploaded_file($_FILES["img_02_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_02_propiedad"]["tmp_name"], $img_02_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_02_propiedad);
					$size = getimagesize($img_02_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_02_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_02_propiedad,"../../propiedades/".$img_02_propiedad);
					if($propiedad["img_02_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_02_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 02: Imagen en orden pero no se sube.<br>";
					$img_02_propiedad = $propiedad["img_02_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 02: Fallido.<br>";
			$img_02_propiedad = $propiedad["img_02_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_03"] == 1){
		if($propiedad["img_03_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_03_propiedad"]);
		}
		$img_03_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_03_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_03_propiedad"]["type"] == "image/gif") || ($_FILES["img_03_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_03_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_03_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_03_propiedad']['size'] < 6000000){
			if ($_FILES["img_03_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_03_propiedad = $propiedad["img_03_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_03_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_03_propiedad));
				
				if (is_uploaded_file($_FILES["img_03_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_03_propiedad"]["tmp_name"], $img_03_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_03_propiedad);
					$size = getimagesize($img_03_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_03_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_03_propiedad,"../../propiedades/".$img_03_propiedad);
					if($propiedad["img_03_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_03_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 03: Imagen en orden pero no se sube.<br>";
					$img_03_propiedad = $propiedad["img_03_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 03: Fallido.<br>";
			$img_03_propiedad = $propiedad["img_03_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_04"] == 1){
		if($propiedad["img_04_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_04_propiedad"]);
		}
		$img_04_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_04_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_04_propiedad"]["type"] == "image/gif") || ($_FILES["img_04_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_04_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_04_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_04_propiedad']['size'] < 6000000){
			if ($_FILES["img_04_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_04_propiedad = $propiedad["img_04_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_04_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_04_propiedad));
				
				if (is_uploaded_file($_FILES["img_04_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_04_propiedad"]["tmp_name"], $img_04_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_04_propiedad);
					$size = getimagesize($img_04_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_04_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_04_propiedad,"../../propiedades/".$img_04_propiedad);
					if($propiedad["img_04_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_04_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_04_propiedad = $propiedad["img_04_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_04_propiedad = $propiedad["img_04_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_05"] == 1){
		if($propiedad["img_05_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_05_propiedad"]);
		}
		$img_05_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_05_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_05_propiedad"]["type"] == "image/gif") || ($_FILES["img_05_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_05_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_05_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_05_propiedad']['size'] < 6000000){
			if ($_FILES["img_05_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_05_propiedad = $propiedad["img_05_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_05_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_05_propiedad));
				
				if (is_uploaded_file($_FILES["img_05_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_05_propiedad"]["tmp_name"], $img_05_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_05_propiedad);
					$size = getimagesize($img_05_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_05_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_05_propiedad,"../../propiedades/".$img_05_propiedad);
					if($propiedad["img_05_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_05_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_05_propiedad = $propiedad["img_05_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_05_propiedad = $propiedad["img_05_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_06"] == 1){
		if($propiedad["img_06_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_06_propiedad"]);
		}
		$img_06_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_06_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_06_propiedad"]["type"] == "image/gif") || ($_FILES["img_06_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_06_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_06_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_06_propiedad']['size'] < 6000000){
			if ($_FILES["img_06_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_06_propiedad = $propiedad["img_06_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_06_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_06_propiedad));
				
				if (is_uploaded_file($_FILES["img_06_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_06_propiedad"]["tmp_name"], $img_06_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_06_propiedad);
					$size = getimagesize($img_06_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_06_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_06_propiedad,"../../propiedades/".$img_06_propiedad);
					if($propiedad["img_06_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_06_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_06_propiedad = $propiedad["img_06_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_06_propiedad = $propiedad["img_06_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_07"] == 1){
		if($propiedad["img_07_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_07_propiedad"]);
		}
		$img_07_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_07_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_07_propiedad"]["type"] == "image/gif") || ($_FILES["img_07_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_07_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_07_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_07_propiedad']['size'] < 6000000){
			if ($_FILES["img_07_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_07_propiedad = $propiedad["img_07_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_07_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_07_propiedad));
				
				if (is_uploaded_file($_FILES["img_07_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_07_propiedad"]["tmp_name"], $img_07_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_07_propiedad);
					$size = getimagesize($img_07_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_07_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_07_propiedad,"../../propiedades/".$img_07_propiedad);
					if($propiedad["img_07_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_07_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_07_propiedad = $propiedad["img_07_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_07_propiedad = $propiedad["img_07_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_08"] == 1){
		if($propiedad["img_08_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_08_propiedad"]);
		}
		$img_08_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_08_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_08_propiedad"]["type"] == "image/gif") || ($_FILES["img_08_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_08_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_08_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_08_propiedad']['size'] < 6000000){
			if ($_FILES["img_08_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_08_propiedad = $propiedad["img_08_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_08_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_08_propiedad));
				
				if (is_uploaded_file($_FILES["img_08_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_08_propiedad"]["tmp_name"], $img_08_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_08_propiedad);
					$size = getimagesize($img_07_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_07_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_08_propiedad,"../../propiedades/".$img_08_propiedad);
					if($propiedad["img_08_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_08_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_08_propiedad = $propiedad["img_08_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_08_propiedad = $propiedad["img_08_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_09"] == 1){
		if($propiedad["img_09_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_09_propiedad"]);
		}
		$img_09_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_09_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_09_propiedad"]["type"] == "image/gif") || ($_FILES["img_09_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_09_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_09_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_09_propiedad']['size'] < 6000000){
			if ($_FILES["img_09_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_09_propiedad = $propiedad["img_09_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_09_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_09_propiedad));
				
				if (is_uploaded_file($_FILES["img_09_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_09_propiedad"]["tmp_name"], $img_09_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_09_propiedad);
					$size = getimagesize($img_09_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_09_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_09_propiedad,"../../propiedades/".$img_09_propiedad);
					if($propiedad["img_09_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_09_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_09_propiedad = $propiedad["img_09_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_09_propiedad = $propiedad["img_09_propiedad"];
		}
	}
	
	if($_POST["flag_borrar_img_10"] == 1){
		if($propiedad["img_10_propiedad"] != "imagen-referencial.png"){
			unlink("../../propiedades/".$propiedad["img_10_propiedad"]);
		}
		$img_10_propiedad = "imagen-referencial.png";
	}else{
		$array = explode(".", strtolower($_FILES["img_10_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_10_propiedad"]["type"] == "image/gif") || ($_FILES["img_10_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_10_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_10_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_10_propiedad']['size'] < 6000000){
			if ($_FILES["img_10_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_10_propiedad = $propiedad["img_10_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la actual.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_10_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_10_propiedad));
				
				if (is_uploaded_file($_FILES["img_10_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_10_propiedad"]["tmp_name"], $img_10_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_10_propiedad);
					$size = getimagesize($img_10_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_10_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_10_propiedad,"../../propiedades/".$img_10_propiedad);
					if($propiedad["img_10_propiedad"] != "imagen-referencial.png"){
						unlink("../../propiedades/".$propiedad["img_10_propiedad"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					$img_10_propiedad = $propiedad["img_10_propiedad"];
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			$img_10_propiedad = $propiedad["img_10_propiedad"];
		}
	}
	
	if($is_fail == 0 && $is_test == 0){ //Se valida que el proceso anterior haya sido exitoso.
		//Una vez terminado esos dos ultimos procesos se inicia la generacion y ejecucion del SQL
		
		$sql = "UPDATE propiedades SET ";
		$sql .= "cod_propiedad = '".$cod_propiedad."', "; //:param_01
		$sql .= "is_comercial = '".$is_comercial."', "; //:param_02
		$sql .= "observacion_propietario = '".$observacion_propietario."', "; //:param_06
		$sql .= "id_tipo_operacion = '".$id_tipo_operacion."', "; //:param_07
		$sql .= "id_tipo_propiedad = '".$id_tipo_propiedad."', "; //:param_08
		$sql .= "id_region = '".$id_region."', "; //:param_09
		$sql .= "id_comuna = '".$id_comuna."', "; //:param_10
		$sql .= "id_sector = '".$id_sector."', "; //:param_11
		$sql .= "cantidad_superficie_total_propiedad = '".$cantidad_superficie_total_propiedad."', "; //:param_12
		$sql .= "cantidad_superficie_construida_propiedad = '".$cantidad_superficie_construida_propiedad."', "; //:param_13
		$sql .= "id_unidad_medida = '".$id_unidad_medida."', "; //:param_14
		$sql .= "valor_propiedad = '".$valor_propiedad."', "; //:param_15
		$sql .= "id_tipo_valor = '".$id_tipo_valor."', "; //:param_16
		$sql .= "dormitorios_propiedad = '".$dormitorios_propiedad."', "; //:param_17
		$sql .= "banos_propiedad = '".$banos_propiedad."', ";
		$sql .= "nro_estacionamiento = '".$nro_estacionamiento."', ";
		$sql .= "nro_bodega = '".$nro_bodega."', "; //:param_18
		$sql .= "direccion_propiedad = '".$direccion_propiedad."', "; //:param_19
		$sql .= "detalle_propiedad = '".$detalle_propiedad."', "; //:param_20
		$sql .= "img_01_propiedad = '".$img_01_propiedad."', "; //:param_22
		$sql .= "img_02_propiedad = '".$img_02_propiedad."', "; //:param_23
		$sql .= "img_03_propiedad = '".$img_03_propiedad."', "; //:param_24
		$sql .= "img_04_propiedad = '".$img_04_propiedad."', "; //:param_26
		$sql .= "img_05_propiedad = '".$img_05_propiedad."', "; //:param_26
		$sql .= "img_06_propiedad = '".$img_06_propiedad."', "; //:param_26
		$sql .= "img_07_propiedad = '".$img_07_propiedad."', "; //:param_26
		$sql .= "img_08_propiedad = '".$img_08_propiedad."', "; //:param_26
		$sql .= "img_09_propiedad = '".$img_09_propiedad."', "; //:param_26
		$sql .= "img_10_propiedad = '".$img_10_propiedad."', "; //:param_26
		$sql .= "id_tipo_codigo = '".$id_tipo_codigo."', ";
		$sql .= "rol_propiedad = '".$rol_propiedad."', ";  //:param_26
		$sql .= "detalle_corredor = '".$detalle_corredor."' , ";  //:param_30
		$sql .= "titulo_propiedad = '".$titulo_propiedad."', ";  //:param_31
		$sql .= "id_tipo_giro = '".$id_tipo_giro."', ";
		$sql .= "is_promesado = '".$is_promesado."', ";
		$sql .= "is_exclusivo = '".$is_exclusivo."', ";
		$sql .= "is_oportunidad = '".$is_oportunidad."', ";
		$sql .= "flag_estado = '".$flag_estado."' ";  
		$sql .= "WHERE id_propiedad = ".$propiedad["id_propiedad"];
		$modifica = $conexion->prepare($sql);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		if($modifica->execute()){
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Propiedad creada con exito.</div>";
		}else{
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Se presento un problema inesperado, favor contactar al administrador del sistema.</div>";
		}
		//Fin seccion proceso agregado de propiedad
	}
	//Una vez terminado el proceso de INSERT se manda de vuelta a agregar propiedad
	if($is_test == 0){header("location: ../pages/editar-propiedad.php?id_propiedad=".$_POST["id_propiedad"]);}
?>
<a href="../pages/editar-propiedad.php?id_propiedad=<?php echo $_POST["id_propiedad"];?>">Volver</a>

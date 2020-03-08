<?php
	session_start();
	require_once('rutinas.php');
	include('SimpleImage.php');
	//<strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.
	//Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.
	
	$is_test = 0; //indicador si esta en formato de pruebas, 0->No; 1->Si
	$is_fail = 0; //iniciador del indicador si hubo algun fallo durante el proceso, 0->No; 1->Si
	$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir
	$_SESSION["mensaje-sistema"] = ""; //Inicializar el mensaje del sistema para adherir errores o exitos
	$_SESSION["mensaje-prueba"] = ""; //Inicializar el mensaje de pruebas para revisiones
	
	
	//Se extraen los datos de la base de datos
	if(!isset($_SESSION["id_cuenta"])){
		$id_cuenta = $_COOKIE["id_cuenta"];
	}else{
		$id_cuenta = $_SESSION["id_cuenta"];
	}

	if(isset($_POST["id_prospecto"]) && is_numeric($_POST["id_prospecto"])){
		$sql_validar_prospecto = "SELECT * FROM prospectos WHERE id_prospecto =".$_POST["id_prospecto"];
		$cursor_validar_prospecto = $conexion -> query($sql_validar_prospecto);
		if(!$validar_prospecto = $cursor_validar_prospecto -> rowCount()){
			$validar_prospecto = 0;
		}
		
		if($validar_prospecto == 1){
			$prospecto = $cursor_validar_prospecto -> fetch();
		}else{
			$is_fail = 1;
		}
	}else{
		$is_fail = 1;
	}
	
	//Verificacion de datos---------------------------------------------------------------------------------------------
	if(isset($_POST["observaciones_propietario"]) && !empty($_POST["observaciones_propietario"])){
		$observacion_propietario = $_POST["observaciones_propietario"];
	}else{
		$observacion_propietario = $prospecto["observacion_propietario"];
		$_SESSION["mensaje-sistema"] .= "No hay observaciones sobre el propietario.";
	}
	
	if(isset($_POST["cod_propiedad"]) && !empty($_POST["cod_propiedad"])){
		$sql_validar_codigo = "SELECT * FROM propiedades WHERE cod_propiedad=".$_POST["cod_propiedad"];
		$cursor_validar_codigo = $conexion -> query($sql_validar_codigo);
		if(!$validar_codigo = $cursor_validar_codigo -> rowCount()){
			$validar_codigo = 0;
		}
		
		if($validar_codigo != 0){
			$is_fail = 1;
		}else{
			$cod_propiedad = $_POST["cod_propiedad"];
		}
	}else{
		$is_fail = 1;
	}
	
	$id_tipo_codigo = $_POST["id_tipo_codigo"];
	
	if(isset($_POST["rol_propiedad"]) && !empty($_POST["rol_propiedad"])){
		$sql_validar_rol = "SELECT * FROM propiedades WHERE rol_propiedad='".$_POST["rol_propiedad"]."'";
		$cursor_validar_rol = $conexion -> query($sql_validar_rol);
		if(!$validar_rol = $cursor_validar_rol -> rowCount()){
			$validar_rol = 0;
		}
		
		if($validar_rol == 0){
			$rol_propiedad = $_POST["rol_propiedad"];
			//echo "<p>Rol propiedad: Valido</p>";
			//echo "<p>Rol propiedad: ".$rol_propiedad."</p>";
		}else{
			$rol_propiedad = $prospecto["rol_propiedad"];
			//echo "<p>Rol propiedad: No Valido</p>";
		}
		
	}else{
		$rol_propiedad = $prospecto["rol_propiedad"];
	}
	
	if(isset($_POST["id_tipo_operacion"]) && !empty($_POST["id_tipo_operacion"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_operacion = $_POST["id_tipo_operacion"];
		//echo "<p>Tipo de operacion: ".$id_tipo_operacion."</p>";
	}else{
		$id_tipo_operacion = $prospecto["id_tipo_operacion"];
	}
	
	if(isset($_POST["id_tipo_propiedad"]) && !empty($_POST["id_tipo_propiedad"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_propiedad = $_POST["id_tipo_propiedad"];
		//echo "<p>Tipo de propiedad: ".$id_tipo_propiedad."</p>";
	}else{
		$id_tipo_propiedad = $prospecto["id_tipo_prospecto"];
	}
	
	if(isset($_POST["direccion_propiedad"]) && !empty($_POST["direccion_propiedad"])){
		$direccion_propiedad = $_POST["direccion_propiedad"];
		//echo "<p>Direccion de la propiedad: ".$direccion_propiedad."</p>";
	}else{
		$direccion_propiedad = $_POST["direccion_prospecto"];
	}
	
	if(isset($_POST["id_region"]) && !empty($_POST["id_region"]) && is_numeric($_POST["id_region"])){
		$id_region = $_POST["id_region"];
		//echo "<p>Region de la propiedad: ".$id_region."</p>";
	}else{
		$id_region = $prospecto["id_region"];
	}
	
	if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"]) && is_numeric($_POST["id_comuna"])){
		$id_comuna = $_POST["id_comuna"];
		//echo "<p>Comuna de la propiedad: ".$id_comuna."</p>";
	}else{
		$id_comuna = $prospecto["id_comuna"];
	}
	
	if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"]) && is_numeric($_POST["id_sector"])){
		$id_sector = $_POST["id_sector"];
		//echo "<p>Sector de la propiedad: ".$id_sector."</p>";
	}else{
		$id_sector = $prospecto["id_sector"];
	}
	
	if(isset($_POST["is_comercial"]) && is_numeric($_POST["is_comercial"])){
		$is_comercial = $_POST["is_comercial"];
		//echo "<p>Propiedad con giro comercial: ".$is_comercial."</p>";
	}else{
		$is_comercial = $prospecto["is_comercial"];
	}
	
	if(isset($_POST["valor"]) && !empty($_POST["valor"]) && is_numeric($_POST["valor"])){
		$valor_propiedad = $_POST["valor"];
		//echo "<p>Valor de la propiedad: ".$valor_propiedad."</p>";
	}else{
		$valor_propiedad = $prospecto["valor_prospecto"];
	}
	
	if(isset($_POST["id_tipo_valor"]) && !empty($_POST["id_tipo_valor"]) && is_numeric($_POST["id_tipo_valor"])){
		$id_tipo_valor = $_POST["id_tipo_valor"];
		//echo "<p>Tipo de valor de la propiedad: ".$id_tipo_valor."</p>";
	}else{
		$id_tipo_valor = $prospecto["id_tipo_valor"];
	}
	
	if(isset($_POST["dormitorios_propiedad"]) && is_numeric($_POST["dormitorios_propiedad"])){
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		//echo "<p>Numero de habitaciones de la propiedad: ".$dormitorios_propiedad."</p>";
	}else{
		$dormitorios_propiedad = $prospecto["dormitorios_prospecto"];
	}
	
	if(isset($_POST["banos_propiedad"]) && is_numeric($_POST["banos_propiedad"])){
		$banos_propiedad = $_POST["banos_propiedad"];
		//echo "<p>Numero de ba&ntilde;os de la propiedad: ".$banos_propiedad."</p>";
	}else{
		$banos_propiedad = $prospecto["banos_prospecto"];
	}
	
	if(isset($_POST["nro_estacionamiento"]) && is_numeric($_POST["nro_estacionamiento"])){
		$nro_estacionamiento = $_POST["nro_estacionamiento"];
		//echo "<p>Numero de estacionamientos de la propiedad: ".$nro_estacionamiento."</p>";
	}else{
		$nro_estacionamiento = $prospecto["nro_estacionamiento"];
	}
	
	if(isset($_POST["nro_bodega"]) && is_numeric($_POST["nro_bodega"])){
		$nro_bodega = $_POST["nro_bodega"];
		//echo "<p>Numero de bodegas de la propiedad: ".$nro_bodega."</p>";
	}else{
		$nro_bodega = $prospecto["nro_bodega"];
	}
	
	if(isset($_POST["cantidad_superficie_total_propiedad"]) && is_numeric($_POST["cantidad_superficie_total_propiedad"])){
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		//echo "<p>Cantidad de la superficie total de la propiedad: ".$cantidad_superficie_total_propiedad."</p>";
	}else{
		$cantidad_superficie_total_propiedad = $prospecto["cantidad_superficie_total_prospecto"];
	}
	
	if(isset($_POST["cantidad_superficie_construida_propiedad"]) && is_numeric($_POST["cantidad_superficie_construida_propiedad"])){
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"];
		//echo "<p>Cantidad de la superficie construida de la propiedad: ".$cantidad_superficie_construida_propiedad."</p>";
	}else{
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_prospecto"];
	}
	
	if(isset($_POST["id_unidad_medida"]) && !empty($_POST["id_unidad_medida"]) && is_numeric($_POST["id_unidad_medida"])){
		$id_unidad_medida = $_POST["id_unidad_medida"];
		//echo "<p>Unidad de medida de la propiedad: ".$id_unidad_medida."</p>";
	}else{
		$id_unidad_medida = $prospecto["id_unidad_medida"];
	}
	
	if(isset($_POST["detalle_propiedad"]) && !empty($_POST["detalle_propiedad"])){
		$detalle_propiedad = $_POST["detalle_propiedad"];
		//echo "<p>Detalle de la propiedad: ".$detalle_propiedad."</p>";
	}else{
		$detalle_propiedad = $prospecto["detalle_prospecto"];
	}
		
	//echo "Proceso de subida de archivos iniciado...<br>";
	
	if(isset($_POST["flag_borrar_img_01"]) && $_POST["flag_borrar_img_01"] == 1){
		if($prospecto["img_01_prospecto"] != "imagen-referencial.png"){
			unlink("../../img/prospectos/".$prospecto["img_01_prospecto"]);
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
				$img_01_propiedad = $prospecto["img_01_prospecto"];
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
					$img->resize(400, 300)->save($img_01_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename($img_01_propiedad,"../../img/propiedades/".$img_01_propiedad);
					
					if($prospecto["img_01_prospecto"] != "imagen-referencial.png"){
						unlink("../../img/prospectos/".$prospecto["img_01_prospecto"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					rename("../../img/prospectos/".$prospecto["img_01_prospecto"],"../../img/propiedades/".$img_01_propiedad);
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			do{
				$img_01_propiedad = "propiedad-".getUniqueCode().".".$extension;
			}while(file_exists($img_01_propiedad));
			
			rename("../../img/prospectos/".$prospecto["img_01_prospecto"],"../../img/propiedades/".$img_01_propiedad);
		}
	}
	
	if(isset($_POST["flag_borrar_img_02"]) && $_POST["flag_borrar_img_02"] == 1){
		if($prospecto["img_02_prospecto"] != "imagen-referencial.png"){
			unlink("../../img/propiedades/".$prospecto["img_02_prospecto"]);
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
				$img_02_propiedad = $prospecto["img_02_prospecto"];
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
					$img->resize(400, 300)->save($img_02_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_02_propiedad,"../../img/propiedades/".$img_02_propiedad);
					if($prospecto["img_02_prospecto"] != "imagen-referencial.png"){
						unlink("../../img/propiedades/".$prospecto["img_02_prospecto"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 02: Imagen en orden pero no se sube.<br>";
					rename("../../img/prospectos/".$prospecto["img_02_prospecto"],"../../img/propiedades/".$img_02_propiedad);
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 02: Fallido.<br>";
			do{
				$img_02_propiedad = "propiedad-".getUniqueCode().".".$extension;
			}while(file_exists($img_02_propiedad));
			
			rename("../../img/prospectos/".$prospecto["img_02_prospecto"],"../../img/propiedades/".$img_02_propiedad);
		}
	}
		
	if(isset($_POST["flag_borrar_img_03"]) && $_POST["flag_borrar_img_03"] == 1){
		if($prospecto["img_03_prospecto"] != "imagen-referencial.png"){
			unlink("../../img/prospectos/".$prospecto["img_03_prospecto"]);
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
				$img_03_propiedad = $prospecto["img_03_prospecto"];
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
					$img->resize(400, 300)->save($img_03_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_03_propiedad,"../../img/propiedades/".$img_03_propiedad);
					if($prospecto["img_03_prospecto"] != "imagen-referencial.png"){
						unlink("../../img/prospectos/".$prospecto["img_03_prospecto"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 03: Imagen en orden pero no se sube.<br>";
					rename("../../img/prospectos/".$prospecto["img_03_prospecto"],"../../img/propiedades/".$img_03_propiedad);
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 03: Fallido.<br>";
			do{
				$img_03_propiedad = "propiedad-".getUniqueCode().".".$extension;
			}while(file_exists($img_03_propiedad));
			
			rename("../../img/prospectos/".$prospecto["img_03_prospecto"],"../../img/propiedades/".$img_03_propiedad);
		}
	}
	
	if(isset($_POST["flag_borrar_img_04"]) && $_POST["flag_borrar_img_04"] == 1){
		if($prospecto["img_04_prospecto"] != "imagen-referencial.png"){
			unlink("../../img/propiedades/".$prospecto["img_04_prospecto"]);
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
				$img_04_propiedad = $prospecto["img_04_prospecto"];
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
					$img->resize(400, 300)->save($img_04_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename ($img_04_propiedad,"../../img/propiedades/".$img_04_propiedad);
					if($prospecto["img_04_prospecto"] != "imagen-referencial.png"){
						unlink("../../img/propiedades/".$prospecto["img_04_prospecto"]);
					}
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
					rename("../../img/prospectos/".$prospecto["img_04_prospecto"],"../../img/propiedades/".$img_04_propiedad);
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 04: Fallido.<br>";
			do{
				$img_04_propiedad = "propiedad-".getUniqueCode().".".$extension;
			}while(file_exists($img_04_propiedad));
			
			rename("../../img/prospectos/".$prospecto["img_04_prospecto"],"../../img/propiedades/".$img_04_propiedad);
		}
	}
	
	if($is_fail == 0 && $is_test == 0){ //Se valida que el proceso anterior haya sido exitoso.
			
		//Una vez terminado esos dos ultimos procesos se inicia la generacion y ejecucion del SQL
		
		$sql = "INSERT INTO propiedades ";
		$sql .= "(cod_propiedad, "; //:param_01
		$sql .= "is_comercial, "; //:param_02
		$sql .= "observacion_propietario, "; //:param_06
		$sql .= "id_tipo_operacion, "; //:param_07
		$sql .= "id_tipo_propiedad, "; //:param_08
		$sql .= "id_region, "; //:param_09
		$sql .= "id_comuna, "; //:param_10
		$sql .= "id_sector, "; //:param_11
		$sql .= "cantidad_superficie_total_propiedad, "; //:param_12
		$sql .= "cantidad_superficie_construida_propiedad, "; //:param_13
		$sql .= "id_unidad_medida, "; //:param_14
		$sql .= "valor_propiedad, "; //:param_15
		$sql .= "id_tipo_valor, "; //:param_16
		$sql .= "dormitorios_propiedad, "; //:param_17
		$sql .= "banos_propiedad, "; //:param_18
		$sql .= "direccion_propiedad, "; //:param_19
		$sql .= "detalle_propiedad, "; //:param_20
		$sql .= "fecha_captacion_propiedad, "; //now()
		$sql .= "fecha_publicacion_propiedad, "; //now()
		$sql .= "id_cuenta, "; //:param_21
		$sql .= "img_01_propiedad, "; //:param_22
		$sql .= "img_02_propiedad, "; //:param_23
		$sql .= "img_03_propiedad, "; //:param_24
		$sql .= "img_04_propiedad, ";//:param_25
		$sql .= "rol_propiedad, "; //:param_26
		$sql .= "id_tipo_codigo, "; //:param_27
		$sql .= "nro_estacionamiento, "; //:param_28
		$sql .= "nro_bodega) "; //:param_29
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_06, ";
		$sql .= ":param_07, ";
		$sql .= ":param_08, ";
		$sql .= ":param_09, ";
		$sql .= ":param_10, ";
		$sql .= ":param_11, ";
		$sql .= ":param_12, ";
		$sql .= ":param_13, ";
		$sql .= ":param_14, ";
		$sql .= ":param_15, ";
		$sql .= ":param_16, ";
		$sql .= ":param_17, ";
		$sql .= ":param_18, ";
		$sql .= ":param_19, ";
		$sql .= ":param_20, ";
		$sql .= "now(), ";
		$sql .= "now(), ";
		$sql .= ":param_21, ";
		$sql .= ":param_22, ";
		$sql .= ":param_23, ";
		$sql .= ":param_24, ";
		$sql .= ":param_25, ";
		$sql .= ":param_26, ";
		$sql .= ":param_27, ";
		$sql .= ":param_28, ";
		$sql .= ":param_29)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $cod_propiedad);
		$inserta -> bindValue(':param_02', $is_comercial);
		$inserta -> bindValue(':param_06', $observacion_propietario);
		$inserta -> bindValue(':param_07', $id_tipo_operacion);
		$inserta -> bindValue(':param_08', $id_tipo_propiedad);
		$inserta -> bindValue(':param_09', $id_region);
		$inserta -> bindValue(':param_10', $id_comuna);
		$inserta -> bindValue(':param_11', $id_sector);
		$inserta -> bindValue(':param_12', $cantidad_superficie_total_propiedad);
		$inserta -> bindValue(':param_13', $cantidad_superficie_construida_propiedad);
		$inserta -> bindValue(':param_14', $id_unidad_medida);
		$inserta -> bindValue(':param_15', $valor_propiedad);
		$inserta -> bindValue(':param_16', $id_tipo_valor);
		$inserta -> bindValue(':param_17', $dormitorios_propiedad);
		$inserta -> bindValue(':param_18', $banos_propiedad);
		$inserta -> bindValue(':param_19', $direccion_propiedad);
		$inserta -> bindValue(':param_20', $detalle_propiedad);
		$inserta -> bindValue(':param_21', $id_cuenta);
		$inserta -> bindValue(':param_22', $img_01_propiedad);
		$inserta -> bindValue(':param_23', $img_02_propiedad);
		$inserta -> bindValue(':param_24', $img_03_propiedad);
		$inserta -> bindValue(':param_25', $img_04_propiedad);
		$inserta -> bindValue(':param_26', $rol_propiedad);
		$inserta -> bindValue(':param_27', $id_tipo_codigo);
		$inserta -> bindValue(':param_28', $nro_estacionamiento);
		$inserta -> bindValue(':param_29', $nro_bodega);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		if($inserta -> execute()){
			$conexion -> commit();
			
			if($prospecto["img_01_prospecto"] != "imagen-referencial.png"){
				unlink("../../img/prospectos/".$prospecto["img_01_prospecto"]);
			}
			
			if($prospecto["img_02_prospecto"] != "imagen-referencial.png"){
				unlink("../../img/prospectos/".$prospecto["img_02_prospecto"]);
			}
			
			if($prospecto["img_03_prospecto"] != "imagen-referencial.png"){
				unlink("../../img/prospectos/".$prospecto["img_03_prospecto"]);
			}
			
			if($prospecto["img_04_prospecto"] != "imagen-referencial.png"){
				unlink("../../img/prospectos/".$prospecto["img_04_prospecto"]);
			}
			
			$sql = "DELETE FROM prospectos WHERE id_prospecto=".$prospecto["id_prospecto"];
			$borra = $conexion->prepare($sql);
			$borra->execute();
			
			$_SESSION["mensaje-sistema"] .= "Propiedad creada con exito.";
		}else{
			$_SESSION["mensaje-sistema"] .= "Se presento un problema inesperado, favor contactar al administrador del sistema.";
		}
		
		//Fin seccion proceso agregado de propiedad
	}
	
	//Una vez terminado el proceso de INSERT se manda de vuelta a agregar propiedad
	if($is_test == 0){header("location: ../pages/ver-prospectos.php");}
?>
<a href="../pages/ver-prospectos.php">Volver</a>

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
	$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "BMP", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir
	$_SESSION["mensaje-sistema"] = ""; //Inicializar el mensaje del sistema para adherir errores o exitos
	$_SESSION["mensaje-prueba"] = ""; //Inicializar el mensaje de pruebas para revisiones
	
	//Verificacion de datos---------------------------------------------------------------------------------------------
	if(isset($_POST["cod_propiedad"]) && is_numeric($_POST["cod_propiedad"])){
		$sql_validar = "SELECT * FROM propiedades WHERE cod_propiedad=".$_POST["cod_propiedad"];
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
	
	if(isset($_POST["nombre_cliente"]) && !empty($_POST["nombre_cliente"])){
		$nombre_cliente = $_POST["nombre_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["direccion_cliente"]) && !empty($_POST["direccion_cliente"])){
		$direccion_cliente = $_POST["direccion_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["rut_cliente"]) && !empty($_POST["rut_cliente"])){
		$rut_cliente = $_POST["rut_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["telefono_cliente"]) && !empty($_POST["telefono_cliente"])){
		$telefono_cliente = $_POST["telefono_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["correo_cliente"]) && !empty($_POST["correo_cliente"])){
		$correo_cliente = $_POST["correo_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["nombre_contacto_cliente"]) && !empty($_POST["nombre_contacto_cliente"])){
		$nombre_contacto_cliente = $_POST["nombre_contacto_cliente"];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST["telefono_contacto_cliente"]) && !empty($_POST["telefono_contacto_cliente"])){
		$telefono_contacto_cliente = $_POST["telefono_contacto_cliente"];
	}else{
		$is_fail = 1;
	}
	
	$fecha_contrato_cliente = $_POST["fecha_contrato_cliente"];
	
	if(isset($_POST["observaciones_propietario"]) && !empty($_POST["observaciones_propietario"])){
		$observacion_propietario = $_POST["observaciones_propietario"];
		//echo "<p>Observaciones propietario: ".$observacion_propietario."</p>";
	}else{
		$observacion_propietario = $propiedad["observaciones_propietario"];
		//echo "<p>Observaciones propietario: Error - Se mantiene el actual.</p>";
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No hay cambios en las observaciones sobre el propietario, se mantendran las actuales.</div>";
	}
	
	$rol_propiedad = $_POST["rol_propiedad"];
	
	$id_tipo_codigo = $_POST["id_tipo_codigo"];
	$cod_propiedad = $_POST["cod_propiedad"];
	
	if(isset($_POST["id_tipo_operacion"]) && !empty($_POST["id_tipo_operacion"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_operacion = $_POST["id_tipo_operacion"];
		//echo "<p>Tipo de operacion: ".$id_tipo_operacion."</p>";
	}
	
	if(isset($_POST["id_tipo_propiedad"]) && !empty($_POST["id_tipo_propiedad"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_propiedad = $_POST["id_tipo_propiedad"];
		//echo "<p>Tipo de propiedad: ".$id_tipo_propiedad."</p>";
	}
	
	if(isset($_POST["direccion_propiedad"]) && !empty($_POST["direccion_propiedad"])){
		$direccion_propiedad = $_POST["direccion_propiedad"];
		//echo "<p>Direccion de la propiedad: ".$direccion_propiedad."</p>";
	}
	
	if(isset($_POST["id_region"]) && !empty($_POST["id_region"]) && is_numeric($_POST["id_region"])){
		$id_region = $_POST["id_region"];
		//echo "<p>Region de la propiedad: ".$id_region."</p>";
	}
	
	if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"]) && is_numeric($_POST["id_comuna"])){
		$id_comuna = $_POST["id_comuna"];
		//echo "<p>Comuna de la propiedad: ".$id_comuna."</p>";
	}
	
	if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"]) && is_numeric($_POST["id_sector"])){
		$id_sector = $_POST["id_sector"];
		//echo "<p>Sector de la propiedad: ".$id_sector."</p>";
	}
	
	$is_comercial = 0;
	
	$id_tipo_giro = $_POST["id_tipo_giro"];
	
	if(isset($_POST["valor"]) && !empty($_POST["valor"])){
		$valor_propiedad = str_replace(",",".", $_POST["valor"]);
		if(substr($valor_propiedad, -1) == "."){
			$valor_propiedad = substr($valor_propiedad, 0, -1);
		}
	}
	
	if(isset($_POST["id_tipo_valor"]) && !empty($_POST["id_tipo_valor"]) && is_numeric($_POST["id_tipo_valor"])){
		$id_tipo_valor = $_POST["id_tipo_valor"];
		//echo "<p>Tipo de valor de la propiedad: ".$id_tipo_valor."</p>";
	}
	
	if(isset($_POST["dormitorios_propiedad"]) && is_numeric($_POST["dormitorios_propiedad"])){
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		//echo "<p>Numero de habitaciones de la propiedad: ".$dormitorios_propiedad."</p>";
	}
	
	if(isset($_POST["banos_propiedad"]) && is_numeric($_POST["banos_propiedad"])){
		$banos_propiedad = $_POST["banos_propiedad"];
		//echo "<p>Numero de ba&ntilde;os de la propiedad: ".$banos_propiedad."</p>";
	}
	
	if(isset($_POST["nro_estacionamiento"]) && is_numeric($_POST["nro_estacionamiento"])){
		$nro_estacionamiento = $_POST["nro_estacionamiento"];
		//echo "<p>Numero de estacionamientos de la propiedad: ".$nro_estacionamiento."</p>";
	}
	
	if(isset($_POST["nro_bodega"]) && is_numeric($_POST["nro_bodega"])){
		$nro_bodega = $_POST["nro_bodega"];
		//echo "<p>Numero de bodegas de la propiedad: ".$nro_bodega."</p>";
	}
	
	if(isset($_POST["cantidad_superficie_total_propiedad"]) && is_numeric($_POST["cantidad_superficie_total_propiedad"])){
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		//echo "<p>Cantidad de la superficie total de la propiedad: ".$cantidad_superficie_total_propiedad."</p>";
	}
	
	if(isset($_POST["cantidad_superficie_construida_propiedad"]) && is_numeric($_POST["cantidad_superficie_construida_propiedad"])){
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"];
		//echo "<p>Cantidad de la superficie construida de la propiedad: ".$cantidad_superficie_construida_propiedad."</p>";
	}
	
	if(isset($_POST["id_unidad_medida"]) && !empty($_POST["id_unidad_medida"]) && is_numeric($_POST["id_unidad_medida"])){
		$id_unidad_medida = $_POST["id_unidad_medida"];
		//echo "<p>Unidad de medida de la propiedad: ".$id_unidad_medida."</p>";
	}
	
	if(isset($_POST["detalle_propiedad"]) && !empty($_POST["detalle_propiedad"])){
		$detalle_propiedad = $_POST["detalle_propiedad"];
		//echo "<p>Detalle de la propiedad: ".$detalle_propiedad."</p>";
	}
	
	//validacion detalle corredor
	if(isset($_POST["detalle_corredor"]) && !empty($_POST["detalle_corredor"])){
		$detalle_corredor = $_POST["detalle_corredor"];
		//echo "<p>Detalle del corredor: ".$detalle_corredor."</p>";
	}else{
		$detalle_corredor = "No ingresado";
	}
	
	if(isset($_POST["titulo_propiedad"]) && !empty($_POST["titulo_propiedad"])){
		$titulo_propiedad = $_POST["titulo_propiedad"];
		//echo "<p>titulo propiedad: ".$titulo_propiedad."</p>";
	}else{
		$titulo_propiedad = "";
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
	
	$array = explode(".", strtolower($_FILES["img_01_propiedad"]["name"]));
	$extension = end($array);
	
	list($width, $height) = getimagesize($_FILES["img_01_propiedad"]["tmp_name"]);

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
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
				$img_01_propiedad = "imagen-referencial.png";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		//echo "Imagen 01: Fallido.<br>";
		$img_01_propiedad = "imagen-referencial.png";
	}
	
	$array = explode(".", strtolower($_FILES["img_02_propiedad"]["name"]));
	$extension = end($array);

	list($width, $height) = getimagesize($_FILES["img_02_propiedad"]["tmp_name"]);
	
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
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				//echo "Imagen 02: Imagen en orden pero no se sube.<br>";
				$img_02_propiedad = "imagen-referencial.png";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		//echo "Imagen 02: Fallido.<br>";
		$img_02_propiedad = "imagen-referencial.png";
	}
	
	$array = explode(".", strtolower($_FILES["img_03_propiedad"]["name"]));
	$extension = end($array);
	
	list($width, $height) = getimagesize($_FILES["img_03_propiedad"]["tmp_name"]);

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
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				//echo "Imagen 03: Imagen en orden pero no se sube.<br>";
				$img_03_propiedad = "imagen-referencial.png";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		//echo "Imagen 03: Fallido.<br>";
		$img_03_propiedad = "imagen-referencial.png";
	}
	
	$array = explode(".", strtolower($_FILES["img_04_propiedad"]["name"]));
	$extension = end($array);
	
	list($width, $height) = getimagesize($_FILES["img_04_propiedad"]["tmp_name"]);

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
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				//echo "Imagen 04: Imagen en orden pero no se sube.<br>";
				$img_04_propiedad = "imagen-referencial.png";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		//echo "Imagen 04: Fallido.<br>";
		$img_04_propiedad = "imagen-referencial.png";
	}
	
	if(!empty($_FILES["img_05_propiedad"])){
		$array = explode(".", strtolower($_FILES["img_05_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_05_propiedad"]["tmp_name"]);

		if ((($_FILES["img_05_propiedad"]["type"] == "image/gif") || ($_FILES["img_05_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_05_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_05_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_05_propiedad']['size'] < 6000000){
			if ($_FILES["img_05_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_05_propiedad = $propiedad["img_05_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
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
					rename($img_05_propiedad,"../../propiedades/".$img_05_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_05_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_05_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_05_propiedad = "imagen-referencial.png";
	}
	
	if(!empty($_FILES["img_06_propiedad"])){
		$array = explode(".", strtolower($_FILES["img_06_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_06_propiedad"]["tmp_name"]);

		if ((($_FILES["img_06_propiedad"]["type"] == "image/gif") || ($_FILES["img_06_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_06_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_06_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_06_propiedad']['size'] < 6000000){
			if ($_FILES["img_06_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_06_propiedad = $propiedad["img_06_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
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
					rename($img_06_propiedad,"../../propiedades/".$img_06_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_06_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_06_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_06_propiedad = "imagen-referencial.png";
	}
	
	if($_FILES["img_07_propiedad"]){
		$array = explode(".", strtolower($_FILES["img_07_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_07_propiedad"]["tmp_name"]);

		if ((($_FILES["img_07_propiedad"]["type"] == "image/gif") || ($_FILES["img_07_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_07_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_07_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_07_propiedad']['size'] < 6000000){
			if ($_FILES["img_07_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_07_propiedad = $propiedad["img_07_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
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
					rename($img_07_propiedad,"../../propiedades/".$img_07_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_07_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_07_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_07_propiedad = "imagen-referencial.png";
	}
	
	if(!empty($_FILES["img_08_propiedad"])){
		$array = explode(".", strtolower($_FILES["img_08_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_08_propiedad"]["tmp_name"]);

		if ((($_FILES["img_08_propiedad"]["type"] == "image/gif") || ($_FILES["img_08_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_08_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_08_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_08_propiedad']['size'] < 6000000){
			if ($_FILES["img_08_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_08_propiedad = $propiedad["img_08_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
			}else{
				
				//Se guarda la direccion en que se guarda el archivo nuevo
				do{
					$img_08_propiedad = "propiedad-".getUniqueCode().".".$extension;
				}while(file_exists($img_08_propiedad));
				
				if (is_uploaded_file($_FILES["img_08_propiedad"]["tmp_name"]) && $is_test == 0){
					
					//Se sube el archivo a la carpeta correspondiente
					move_uploaded_file($_FILES["img_08_propiedad"]["tmp_name"], $img_08_propiedad);
					
					$img = new abeautifulsite\SimpleImage($img_08_propiedad);
					$size = getimagesize($img_08_propiedad);
					//$size[0] -> Width
					//$size[1] -> Height
					if($size[1] > $size[0]){
						$width_img = 460;
						$height_img = 770;
					}else{
						$width_img = 770;
						$height_img = 460;
					}
					$img -> resize($width_img, $height_img) -> save($img_08_propiedad);
					
					//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
					rename($img_08_propiedad,"../../propiedades/".$img_08_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_08_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_08_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_08_propiedad = "imagen-referencial.png";
	}
	
	if(!empty($_FILES["img_09_propiedad"])){
		$array = explode(".", strtolower($_FILES["img_09_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_09_propiedad"]["tmp_name"]);

		if ((($_FILES["img_09_propiedad"]["type"] == "image/gif") || ($_FILES["img_09_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_09_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_09_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_09_propiedad']['size'] < 6000000){
			if ($_FILES["img_09_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_09_propiedad = $propiedad["img_09_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
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
					rename($img_09_propiedad,"../../propiedades/".$img_09_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_09_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_09_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_09_propiedad = "imagen-referencial.png";
	}
	
	if(!empty($_FILES["img_10_propiedad"])){
		$array = explode(".", strtolower($_FILES["img_10_propiedad"]["name"]));
		$extension = end($array);
		
		list($width, $height) = getimagesize($_FILES["img_10_propiedad"]["tmp_name"]);

		if ((($_FILES["img_10_propiedad"]["type"] == "image/gif") || ($_FILES["img_10_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_10_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_10_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_10_propiedad']['size'] < 6000000){
			if ($_FILES["img_10_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_10_propiedad = $propiedad["img_10_propiedad"];
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";
				
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
					rename($img_10_propiedad,"../../propiedades/".$img_10_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_10_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			//echo "Imagen 01: Fallido.<br>";
			$img_10_propiedad = "imagen-referencial.png";
		}
	}else{
		$img_10_propiedad = "imagen-referencial.png";
	}
	
	if(isset($_POST["is_recepcion_municipal"]) && !empty($_POST["is_recepcion_municipal"])){
		$is_recepcion_municipal = $_POST["is_recepcion_municipal"];
	}else{
		$is_recepcion_municipal = 0;
	}
	
	if(isset($_POST["observaciones_contrato"]) && !empty($_POST["observaciones_contrato"])){
		$observaciones_contrato = $_POST["observaciones_contrato"];
	}else{
		$observaciones_contrato = "";
	}
	
	if(isset($_POST["observaciones_contrato"]) && !empty($_POST["observaciones_contrato"])){
		$observaciones_contrato = $_POST["observaciones_contrato"];
	}else{
		$observaciones_contrato = "";
	}
	
	if(isset($_POST["is_administrado"]) && !empty($_POST["is_administrado"])){
		$is_administrado = $_POST["is_administrado"];
	}else{
		$is_administrado = 0;
	}
	
	if(isset($_POST["pisos_propiedad"]) && !empty($_POST["pisos_propiedad"])){
		$pisos_propiedad = $_POST["pisos_propiedad"];
	}else{
		$pisos_propiedad = 0;
	}
	
	if(isset($_POST["contribucion_propiedad"]) && !empty($_POST["contribucion_propiedad"])){
		$contribucion_propiedad = $_POST["contribucion_propiedad"];
	}else{
		$contribucion_propiedad = 0;
	}
	
	if(isset($_POST["ano_construccion_propiedad"]) && !empty($_POST["ano_construccion_propiedad"])){
		$ano_construccion_propiedad = $_POST["ano_construccion_propiedad"];
	}else{
		$ano_construccion_propiedad = 0;
	}
	
	if(isset($_POST["gasto_comun_propiedad"]) && !empty($_POST["gasto_comun_propiedad"])){
		$gasto_comun_propiedad = $_POST["gasto_comun_propiedad"];
	}else{
		$gasto_comun_propiedad = 0;
	}
	
	if(isset($_POST["flag_living_comedor_propiedad"]) && !empty($_POST["flag_living_comedor_propiedad"])){
		$flag_living_comedor_propiedad = $_POST["flag_living_comedor_propiedad"];
	}else{
		$flag_living_comedor_propiedad = 0;
	}
	
	if(isset($_POST["flag_living_propiedad"]) && !empty($_POST["flag_living_propiedad"])){
		$flag_living_propiedad = $_POST["flag_living_propiedad"];
	}else{
		$flag_living_propiedad = 0;
	}
	
	if(isset($_POST["flag_comedor_propiedad"]) && !empty($_POST["flag_comedor_propiedad"])){
		$flag_comedor_propiedad = $_POST["flag_comedor_propiedad"];
	}else{
		$flag_comedor_propiedad = 0;
	}
	
	if(isset($_POST["flag_cocina_propiedad"]) && !empty($_POST["flag_cocina_propiedad"])){
		$flag_cocina_propiedad = $_POST["flag_cocina_propiedad"];
	}else{
		$flag_cocina_propiedad = 0;
	}
	
	if(isset($_POST["flag_comedor_diario_propiedad"]) && !empty($_POST["flag_comedor_diario_propiedad"])){
		$flag_comedor_diario_propiedad = $_POST["flag_comedor_diario_propiedad"];
	}else{
		$flag_comedor_diario_propiedad = 0;
	}
	
	if(isset($_POST["flag_sector_logia_propiedad"]) && !empty($_POST["flag_sector_logia_propiedad"])){
		$flag_sector_logia_propiedad = $_POST["flag_sector_logia_propiedad"];
	}else{
		$flag_sector_logia_propiedad = 0;
	}
	
	if(isset($_POST["flag_chimenea_propiedad"]) && !empty($_POST["flag_chimenea_propiedad"])){
		$flag_chimenea_propiedad = $_POST["flag_chimenea_propiedad"];
	}else{
		$flag_chimenea_propiedad = 0;
	}
	
	if(isset($_POST["flag_lavadero_propiedad"]) && !empty($_POST["flag_lavadero_propiedad"])){
		$flag_lavadero_propiedad = $_POST["flag_lavadero_propiedad"];
	}else{
		$flag_lavadero_propiedad = 0;
	}
	
	if(isset($_POST["flag_principal_suite_propiedad"]) && !empty($_POST["flag_principal_suite_propiedad"])){
		$flag_principal_suite_propiedad = $_POST["flag_principal_suite_propiedad"];
	}else{
		$flag_principal_suite_propiedad = 0;
	}
	
	if(isset($_POST["flag_dormitorio_servicio_propiedad"]) && !empty($_POST["flag_dormitorio_servicio_propiedad"])){
		$flag_dormitorio_servicio_propiedad = $_POST["flag_dormitorio_servicio_propiedad"];
	}else{
		$flag_dormitorio_servicio_propiedad = 0;
	}
	
	if(isset($_POST["flag_walking_closet_propiedad"]) && !empty($_POST["flag_walking_closet_propiedad"])){
		$flag_walking_closet_propiedad = $_POST["flag_walking_closet_propiedad"];
	}else{
		$flag_walking_closet_propiedad = 0;
	}
	
	if(isset($_POST["flag_clasic_propiedad"]) && !empty($_POST["flag_clasic_propiedad"])){
		$flag_clasic_propiedad = $_POST["flag_clasic_propiedad"];
	}else{
		$flag_clasic_propiedad = 0;
	}
	
	if(isset($_POST["flag_bano_completo_propiedad"]) && !empty($_POST["flag_bano_completo_propiedad"])){
		$flag_bano_completo_propiedad = $_POST["flag_bano_completo_propiedad"];
	}else{
		$flag_bano_completo_propiedad = 0;
	}
	
	if(isset($_POST["flag_bano_servicio_propiedad"]) && !empty($_POST["flag_bano_servicio_propiedad"])){
		$flag_bano_servicio_propiedad = $_POST["flag_bano_servicio_propiedad"];
	}else{
		$flag_bano_servicio_propiedad = 0;
	}
	
	if(isset($_POST["flag_medio_bano_propiedad"]) && !empty($_POST["flag_medio_bano_propiedad"])){
		$flag_medio_bano_propiedad = $_POST["flag_medio_bano_propiedad"];
	}else{
		$flag_medio_bano_propiedad = 0;
	}
	
	if(isset($_POST["flag_antejardin_propiedad"]) && !empty($_POST["flag_antejardin_propiedad"])){
		$flag_antejardin_propiedad = $_POST["flag_antejardin_propiedad"];
	}else{
		$flag_antejardin_propiedad = 0;
	}
	
	if(isset($_POST["flag_patio_trasero_propiedad"]) && !empty($_POST["flag_patio_trasero_propiedad"])){
		$flag_patio_trasero_propiedad = $_POST["flag_patio_trasero_propiedad"];
	}else{
		$flag_patio_trasero_propiedad = 0;
	}
	
	if(isset($_POST["flag_quincho_propiedad"]) && !empty($_POST["flag_quincho_propiedad"])){
		$flag_quincho_propiedad = $_POST["flag_quincho_propiedad"];
	}else{
		$flag_quincho_propiedad = 0;
	}
	
	if(isset($_POST["flag_sala_internet_propiedad"]) && !empty($_POST["flag_sala_internet_propiedad"])){
		$flag_sala_internet_propiedad = $_POST["flag_sala_internet_propiedad"];
	}else{
		$flag_sala_internet_propiedad = 0;
	}
	
	if(isset($_POST["flag_juegos_infantiles_propiedad"]) && !empty($_POST["flag_juegos_infantiles_propiedad"])){
		$flag_juegos_infantiles_propiedad = $_POST["flag_juegos_infantiles_propiedad"];
	}else{
		$flag_juegos_infantiles_propiedad = 0;
	}
	
	if(isset($_POST["flag_piscina_temperada_propiedad"]) && !empty($_POST["flag_piscina_temperada_propiedad"])){
		$flag_piscina_temperada_propiedad = $_POST["flag_piscina_temperada_propiedad"];
	}else{
		$flag_piscina_temperada_propiedad = 0;
	}
	
	if(isset($_POST["flag_piscina_propiedad"]) && !empty($_POST["flag_piscina_propiedad"])){
		$flag_piscina_propiedad = $_POST["flag_piscina_propiedad"];
	}else{
		$flag_piscina_propiedad = 0;
	}
	
	if(isset($_POST["flag_lavanderia_propiedad"]) && !empty($_POST["flag_lavanderia_propiedad"])){
		$flag_lavanderia_propiedad = $_POST["flag_lavanderia_propiedad"];
	}else{
		$flag_lavanderia_propiedad = 0;
	}
	
	if(isset($_POST["flag_sala_multiuso_propiedad"]) && !empty($_POST["flag_sala_multiuso_propiedad"])){
		$flag_sala_multiuso_propiedad = $_POST["flag_sala_multiuso_propiedad"];
	}else{
		$flag_sala_multiuso_propiedad = 0;
	}
	
	if(isset($_POST["flag_conserjeria_propiedad"]) && !empty($_POST["flag_conserjeria_propiedad"])){
		$flag_conserjeria_propiedad = $_POST["flag_conserjeria_propiedad"];
	}else{
		$flag_conserjeria_propiedad = 0;
	}
	
	if(isset($_POST["flag_gimnasio_propiedad"]) && !empty($_POST["flag_gimnasio_propiedad"])){
		$flag_gimnasio_propiedad = $_POST["flag_gimnasio_propiedad"];
	}else{
		$flag_gimnasio_propiedad = 0;
	}
	
	if(isset($_POST["flag_recepcion_propiedad"]) && !empty($_POST["flag_recepcion_propiedad"])){
		$flag_recepcion_propiedad = $_POST["flag_recepcion_propiedad"];
	}else{
		$flag_recepcion_propiedad = 0;
	}
	
	if(isset($_POST["detalle_contrato_propiedad"]) && !empty($_POST["detalle_contrato_propiedad"])){
		$detalle_contrato_propiedad = $_POST["detalle_contrato_propiedad"];
	}else{
		$detalle_contrato_propiedad = "";
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
	$sql .= "is_recepcion_municipal='".$is_recepcion_municipal."', ";
	$sql .= "observaciones_contrato='".$observaciones_contrato."', ";
	$sql .= "is_administrado='".$is_administrado."', ";
	$sql .= "pisos_propiedad='".$pisos_propiedad."', ";
	$sql .= "contribucion_propiedad='".$contribucion_propiedad."', ";
	$sql .= "ano_construccion_propiedad='".$ano_construccion_propiedad."', ";
	$sql .= "flag_living_comedor_propiedad='".$flag_living_comedor_propiedad."', ";
	$sql .= "flag_living_propiedad='".$flag_living_propiedad."', ";
	$sql .= "flag_comedor_propiedad='".$flag_comedor_propiedad."', ";
	$sql .= "flag_cocina_propiedad='".$flag_cocina_propiedad."', ";
	$sql .= "flag_comedor_diario_propiedad='".$flag_comedor_diario_propiedad."', ";
	$sql .= "flag_sector_logia_propiedad='".$flag_sector_logia_propiedad."', ";
	$sql .= "flag_chimenea_propiedad='".$flag_chimenea_propiedad."', ";
	$sql .= "flag_lavadero_propiedad='".$flag_lavadero_propiedad."', ";
	$sql .= "flag_principal_suite_propiedad='".$flag_principal_suite_propiedad."', ";
	$sql .= "flag_dormitorio_servicio_propiedad='".$flag_dormitorio_servicio_propiedad."', ";
	$sql .= "flag_walking_closet_propiedad='".$flag_walking_closet_propiedad."', ";
	$sql .= "flag_clasic_propiedad='".$flag_clasic_propiedad."', ";
	$sql .= "flag_bano_completo_propiedad='".$flag_bano_completo_propiedad."', ";
	$sql .= "flag_bano_servicio_propiedad='".$flag_bano_servicio_propiedad."', ";
	$sql .= "flag_medio_bano_propiedad='".$flag_medio_bano_propiedad."', ";
	$sql .= "flag_antejardin_propiedad='".$flag_antejardin_propiedad."', ";
	$sql .= "flag_patio_trasero_propiedad='".$flag_patio_trasero_propiedad."', ";
	$sql .= "flag_quincho_propiedad='".$flag_quincho_propiedad."', ";
	$sql .= "flag_sala_internet_propiedad='".$flag_sala_internet_propiedad."', ";
	$sql .= "flag_juegos_infantiles_propiedad='".$flag_juegos_infantiles_propiedad."', ";
	$sql .= "flag_piscina_temperada_propiedad='".$flag_piscina_temperada_propiedad."', ";
	$sql .= "flag_piscina_propiedad='".$flag_piscina_propiedad."', ";
	$sql .= "flag_lavanderia_propiedad='".$flag_lavanderia_propiedad."', ";
	$sql .= "flag_sala_multiuso_propiedad='".$flag_sala_multiuso_propiedad."', ";
	$sql .= "flag_conserjeria_propiedad='".$flag_conserjeria_propiedad."', ";
	$sql .= "flag_gimnasio_propiedad='".$flag_gimnasio_propiedad."', ";
	$sql .= "flag_recepcion_propiedad='".$flag_recepcion_propiedad."', ";
	$sql .= "detalle_contrato_propiedad='".$detalle_contrato_propiedad."', ";
	$sql .= "telefono_contacto_cliente='".$_POST["telefono_contacto_cliente"]."', ";
	$sql .= "gasto_comun_propiedad='".$gasto_comun_propiedad."' ";
	$sql .= "WHERE cod_propiedad=".$propiedad["cod_propiedad"];
	$modifica = $conexion->prepare($sql);
	$modifica->execute();
	
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
	$sql .= "is_hidden = 0, ";
	$sql .= "is_reservado = 0, ";
	$sql .= "fecha_captacion_propiedad = '".$fecha_contrato_cliente."', ";
	$sql .= "fecha_publicacion_propiedad = NOW(), ";
	$sql .= "flag_estado = '".$flag_estado."' ";  
	$sql .= "WHERE id_propiedad = ".$propiedad["id_propiedad"];
	$modifica = $conexion->prepare($sql);
	
	//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
	if($modifica->execute()){
		//Codigo de envio de correo para cuenta de barbara u otro coordinador
		$subject = "Alerta por INGRESO DE PROPIEDAD a sistema mateosanchez.cl.";
		$message = "Este es un mensaje automatico avisando que la propiedad codigo: ".$cod_propiedad." fue ingresado al sistema de mateosanchez.cl \n\n";
		$message .= "Puede ver más detalle de la propiedad vealo en: <a href='http://www.mateosanchez.cl/propiedades-comercial/ficha-propiedad.php?cod_propiedad=".$cod_propiedad."'>Este enlace</a> \n";

		$sql_cuenta = "SELECT * FROM cuentas WHERE is_banned = 0 AND lvl_cuenta <= 2";
		$cursor_cuenta = $conexion -> query($sql_cuenta);
		

		require_once("class.phpmailer.php");
		require_once("class.smtp.php");
		
		$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		try {
			$mail->SMTPDebug = 4;                               // Enable verbose debug output
			$mail->isSMTP();                                    // Set mailer to use SMTP
			$mail->SMTPDebug = false;
			$mail->do_debug = 0;
			$mail->Host = gethostbyname('mail.mateosanchez.cl'); 		// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                             // Enable SMTP authentication
			$mail->Username = 'no-reply@mateosanchez.cl';   // SMTP username
			$mail->Password = 'mateo.,123';                     // SMTP password
			$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
			$mail->From = "no-reply@mateosanchez.cl";
			$mail->FromName = "Sistema mateosanchez.cl";
			while($cuenta = $cursor_cuenta -> fetch()){
				$mail->addAddress($cuenta["correo_cuenta"], $cuenta["nombre_persona"]);
			}

			//$mail->addAddress("barbara.marcoleta@mateosanchez.cl", "Barbara Marcoleta");     // Add a recipient test:
			//$mail->addAddress("curauma@mateosanchez.cl", "Alexis Saint");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
			//$mail->addAddress("barbara.rendic@mateosanchez.cl", "Barbara Rendic");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
			//$mail->addReplyTo("msanchez@mateosanchez.cl", "Mateo Sanchez");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(false);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->AltBody = 'Enviado por el sistema de propiedades mateosanchez.cl';
			if(!$mail->send()) {
				
				$_SESSION["mensaje-sistema"] = 'Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["mensaje-sistema"] = 'Mensaje enviado con exito, lo contactaremos a la brevedad.';
			}
			$errors[] = "Send mail sucsessfully";
		} catch (phpmailerException $e) {
			$errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			$errors[] = $e->getMessage(); //Boring error messages from anything else!
		}
		
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Propiedad creada con exito.</div>";
	}else{
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Se presento un problema inesperado, favor contactar al administrador del sistema.</div>";
	}
	header("location: ../pages/ver-propiedades.php?is_hidden=0");
?>
<a href="../pages/editar-propiedad.php?id_propiedad=<?php echo $_POST["id_propiedad"];?>">Volver</a>

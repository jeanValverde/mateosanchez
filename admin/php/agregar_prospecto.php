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
	
	//Verificacion de datos---------------------------------------------------------------------------------------------
	if(isset($_POST["observaciones_propietario"]) && !empty($_POST["observaciones_propietario"])){
		$observacion_propietario = $_POST["observaciones_propietario"];
		////echo "<p>Observaciones propietario: ".$observacion_propietario."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Observaciones propietario: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "No hay observaciones sobre el propietario.";
	}
	
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
			$rol_propiedad = "";
			//echo "<p>Rol propiedad: No Valido</p>";
		}
		
	}else{
		//$is_fail = 1;
		$rol_propiedad = "";
		////echo "<p>Rol propiedad: Error - no asignado.</p>";
		//$_SESSION["mensaje-sistema"] .= "No hay rol de propiedad anexado.";
	}
	
	if(isset($_POST["id_tipo_operacion"]) && !empty($_POST["id_tipo_operacion"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_operacion = $_POST["id_tipo_operacion"];
		//echo "<p>Tipo de operacion: ".$id_tipo_operacion."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Tipo de operacion: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Tipo de operaci&oacute;n no valido.";
	}
	
	if(isset($_POST["id_tipo_propiedad"]) && !empty($_POST["id_tipo_propiedad"]) && is_numeric($_POST["id_tipo_operacion"])){
		$id_tipo_propiedad = $_POST["id_tipo_propiedad"];
		//echo "<p>Tipo de propiedad: ".$id_tipo_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Tipo de propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Tipo de propiedad no valida.";
	}
	
	if(isset($_POST["direccion_propiedad"]) && !empty($_POST["direccion_propiedad"])){
		$direccion_propiedad = $_POST["direccion_propiedad"];
		//echo "<p>Direccion de la propiedad: ".$direccion_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Direccion de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "No se ingreso direcci&oacute;n de la propiedad.";
	}
	
	if(isset($_POST["id_region"]) && !empty($_POST["id_region"]) && is_numeric($_POST["id_region"])){
		$id_region = $_POST["id_region"];
		//echo "<p>Region de la propiedad: ".$id_region."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Region de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Region ingresada no valida.";
	}
	
	if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"]) && is_numeric($_POST["id_comuna"])){
		$id_comuna = $_POST["id_comuna"];
		//echo "<p>Comuna de la propiedad: ".$id_comuna."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Comuna de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Comuna ingresada no valida.";
	}
	
	if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"]) && is_numeric($_POST["id_sector"])){
		$id_sector = $_POST["id_sector"];
		//echo "<p>Sector de la propiedad: ".$id_sector."</p>";
	}else{
		$id_sector = 1;
		//echo "<p>Sector de la propiedad: Error - no asignado.</p>";
		
	}
	
	if(isset($_POST["is_comercial"]) && is_numeric($_POST["is_comercial"])){
		$is_comercial = $_POST["is_comercial"];
		//echo "<p>Propiedad con giro comercial: ".$is_comercial."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Propiedad con giro comercial: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "opci&oacute;n no valida para giro comercial.";
	}
	
	if(isset($_POST["valor"]) && !empty($_POST["valor"]) && is_numeric($_POST["valor"])){
		$valor_propiedad = $_POST["valor"];
		//echo "<p>Valor de la propiedad: ".$valor_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Valor de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar cifras num&eacute;ricas para valor de la propiedad.";
	}
	
	if(isset($_POST["id_tipo_valor"]) && !empty($_POST["id_tipo_valor"]) && is_numeric($_POST["id_tipo_valor"])){
		$id_tipo_valor = $_POST["id_tipo_valor"];
		//echo "<p>Tipo de valor de la propiedad: ".$id_tipo_valor."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Tipo de valor de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Tipo de valor no valido.";
	}
	
	if(isset($_POST["dormitorios_propiedad"]) && is_numeric($_POST["dormitorios_propiedad"])){
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		//echo "<p>Numero de habitaciones de la propiedad: ".$dormitorios_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Numero de habitaciones de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para el n&uacute;mero de habitaciones.";
	}
	
	if(isset($_POST["banos_propiedad"]) && is_numeric($_POST["banos_propiedad"])){
		$banos_propiedad = $_POST["banos_propiedad"];
		//echo "<p>Numero de ba&ntilde;os de la propiedad: ".$banos_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Numero de ba&ntilde;os de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para el n&uacute;mero de ba&ntilde;os.";
	}
	
	if(isset($_POST["nro_estacionamiento"]) && is_numeric($_POST["nro_estacionamiento"])){
		$nro_estacionamiento = $_POST["nro_estacionamiento"];
		//echo "<p>Numero de estacionamientos de la propiedad: ".$nro_estacionamiento."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Numero de estacionamientos de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para el n&uacute;mero de estacionamientos.";
	}
	
	if(isset($_POST["nro_bodega"]) && is_numeric($_POST["nro_bodega"])){
		$nro_bodega = $_POST["nro_bodega"];
		//echo "<p>Numero de bodegas de la propiedad: ".$nro_bodega."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Numero de bodegas de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para el n&uacute;mero de bodegas.";
	}
	
	if(isset($_POST["cantidad_superficie_total_propiedad"]) && is_numeric($_POST["cantidad_superficie_total_propiedad"])){
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		//echo "<p>Cantidad de la superficie total de la propiedad: ".$cantidad_superficie_total_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Cantidad de la superficie total de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para la superficie total.";
	}
	
	if(isset($_POST["cantidad_superficie_construida_propiedad"]) && is_numeric($_POST["cantidad_superficie_construida_propiedad"])){
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"];
		//echo "<p>Cantidad de la superficie construida de la propiedad: ".$cantidad_superficie_construida_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Cantidad de la superficie construida de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Solo ingresar valores num&eacute;ricas para la superficie construida.";
	}
	
	if(isset($_POST["id_unidad_medida"]) && !empty($_POST["id_unidad_medida"]) && is_numeric($_POST["id_unidad_medida"])){
		$id_unidad_medida = $_POST["id_unidad_medida"];
		//echo "<p>Unidad de medida de la propiedad: ".$id_unidad_medida."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Unidad de medida de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Tipo de medici&oacute;n no valido.";
	}
	
	if(isset($_POST["detalle_propiedad"]) && !empty($_POST["detalle_propiedad"])){
		$detalle_propiedad = $_POST["detalle_propiedad"];
		//echo "<p>Detalle de la propiedad: ".$detalle_propiedad."</p>";
	}else{
		$is_fail = 1;
		//echo "<p>Detalle de la propiedad: Error - no asignado.</p>";
		$_SESSION["mensaje-sistema"] .= "Debe tener informaci&oacute;n el detalle para la propiedad.";
	}
	
	
	//echo "Proceso de subida de archivos iniciado...<br>";
	
	$array = explode(".", strtolower($_FILES["img_01_propiedad"]["name"]));
	$extension = end($array);

	if ((($_FILES["img_01_propiedad"]["type"] == "image/gif") || ($_FILES["img_01_propiedad"]["type"] == "image/jpeg")
	|| ($_FILES["img_01_propiedad"]["type"] == "image/png")
	|| ($_FILES["img_01_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_01_propiedad']['size'] < 6000000){
		if ($_FILES["img_01_propiedad"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo.";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_01_propiedad = "prospecto-".getUniqueCode().".".$extension;
			}while(file_exists($img_01_propiedad));
			
			if (is_uploaded_file($_FILES["img_01_propiedad"]["tmp_name"]) && $is_test == 0){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_01_propiedad"]["tmp_name"], $img_01_propiedad);
				
				$img = new abeautifulsite\SimpleImage($img_01_propiedad);
				$img->resize(770, 577)->save($img_01_propiedad);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_01_propiedad,"../../img/prospectos/".$img_01_propiedad);
				
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

	if ((($_FILES["img_02_propiedad"]["type"] == "image/gif") || ($_FILES["img_02_propiedad"]["type"] == "image/jpeg")
	|| ($_FILES["img_02_propiedad"]["type"] == "image/png")
	|| ($_FILES["img_02_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_02_propiedad']['size'] < 6000000){
		if ($_FILES["img_02_propiedad"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo.";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_02_propiedad = "prospecto-".getUniqueCode().".".$extension;
			}while(file_exists($img_02_propiedad));
			
			if (is_uploaded_file($_FILES["img_02_propiedad"]["tmp_name"]) && $is_test == 0){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_02_propiedad"]["tmp_name"], $img_02_propiedad);
				
				$img = new abeautifulsite\SimpleImage($img_02_propiedad);
				$img->resize(770, 577)->save($img_02_propiedad);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_02_propiedad,"../../img/prospectos/".$img_02_propiedad);
				
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

	if ((($_FILES["img_03_propiedad"]["type"] == "image/gif") || ($_FILES["img_03_propiedad"]["type"] == "image/jpeg")
	|| ($_FILES["img_03_propiedad"]["type"] == "image/png")
	|| ($_FILES["img_03_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_03_propiedad']['size'] < 6000000){
		if ($_FILES["img_03_propiedad"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo.";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_03_propiedad = "prospecto-".getUniqueCode().".".$extension;
			}while(file_exists($img_03_propiedad));
			
			if (is_uploaded_file($_FILES["img_03_propiedad"]["tmp_name"]) && $is_test == 0){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_03_propiedad"]["tmp_name"], $img_03_propiedad);
				
				$img = new abeautifulsite\SimpleImage($img_03_propiedad);
				$img->resize(770, 577)->save($img_03_propiedad);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_03_propiedad,"../../img/prospectos/".$img_03_propiedad);
				
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

	if ((($_FILES["img_04_propiedad"]["type"] == "image/gif") || ($_FILES["img_04_propiedad"]["type"] == "image/jpeg")
	|| ($_FILES["img_04_propiedad"]["type"] == "image/png")
	|| ($_FILES["img_04_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_04_propiedad']['size'] < 6000000){
		if ($_FILES["img_04_propiedad"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo.";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_04_propiedad = "prospecto-".getUniqueCode().".".$extension;
			}while(file_exists($img_04_propiedad));
			
			if (is_uploaded_file($_FILES["img_04_propiedad"]["tmp_name"]) && $is_test == 0){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_04_propiedad"]["tmp_name"], $img_04_propiedad);
				
				$img = new abeautifulsite\SimpleImage($img_04_propiedad);
				$img->resize(770, 577)->save($img_04_propiedad);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_04_propiedad,"../../img/prospectos/".$img_04_propiedad);
				
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
	
	if($is_fail == 0 && $is_test == 0){ //Se valida que el proceso anterior haya sido exitoso.
			
		//Una vez terminado esos dos ultimos procesos se inicia la generacion y ejecucion del SQL
		
		$sql = "INSERT INTO prospectos ";
		$sql .= "(is_comercial, "; //:param_01
		$sql .= "observacion_propietario, "; //:param_02
		$sql .= "id_tipo_operacion, "; //:param_03
		$sql .= "id_tipo_prospecto, "; //:param_04
		$sql .= "id_region, "; //:param_05
		$sql .= "id_comuna, "; //:param_06
		$sql .= "id_sector, "; //:param_07
		$sql .= "cantidad_superficie_total_prospecto, "; //:param_08
		$sql .= "cantidad_superficie_construida_prospecto, "; //:param_09
		$sql .= "id_unidad_medida, "; //:param_10
		$sql .= "valor_prospecto, "; //:param_11
		$sql .= "id_tipo_valor, "; //:param_12
		$sql .= "dormitorios_prospecto, "; //:param_13
		$sql .= "banos_prospecto, "; //:param_14
		$sql .= "direccion_prospecto, "; //:param_15
		$sql .= "detalle_prospecto, "; //:param_16
		$sql .= "img_01_prospecto, "; //:param_17
		$sql .= "img_02_prospecto, "; //:param_18
		$sql .= "img_03_prospecto, "; //:param_19
		$sql .= "img_04_prospecto, ";//:param_20
		$sql .= "rol_prospecto, "; //:param_21
		$sql .= "nro_estacionamiento, "; //:param_22
		$sql .= "fecha_prospecto, "; //now()
		$sql .= "nro_bodega) "; //:param_23
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04, ";
		$sql .= ":param_05, ";
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
		$sql .= ":param_21, ";
		$sql .= ":param_22, ";
		$sql .= "now(), ";
		$sql .= ":param_23)";
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $is_comercial);
		$inserta -> bindValue(':param_02', $observacion_propietario);
		$inserta -> bindValue(':param_03', $id_tipo_operacion);
		$inserta -> bindValue(':param_04', $id_tipo_propiedad);
		$inserta -> bindValue(':param_05', $id_region);
		$inserta -> bindValue(':param_06', $id_comuna);
		$inserta -> bindValue(':param_07', $id_sector);
		$inserta -> bindValue(':param_08', $cantidad_superficie_total_propiedad);
		$inserta -> bindValue(':param_09', $cantidad_superficie_construida_propiedad);
		$inserta -> bindValue(':param_10', $id_unidad_medida);
		$inserta -> bindValue(':param_11', $valor_propiedad);
		$inserta -> bindValue(':param_12', $id_tipo_valor);
		$inserta -> bindValue(':param_13', $dormitorios_propiedad);
		$inserta -> bindValue(':param_14', $banos_propiedad);
		$inserta -> bindValue(':param_15', $direccion_propiedad);
		$inserta -> bindValue(':param_16', $detalle_propiedad);
		$inserta -> bindValue(':param_17', $img_01_propiedad);
		$inserta -> bindValue(':param_18', $img_02_propiedad);
		$inserta -> bindValue(':param_19', $img_03_propiedad);
		$inserta -> bindValue(':param_20', $img_04_propiedad);
		$inserta -> bindValue(':param_21', $rol_propiedad);
		$inserta -> bindValue(':param_22', $nro_estacionamiento);
		$inserta -> bindValue(':param_23', $nro_bodega);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		if($inserta -> execute()){
			$conexion -> commit();
			
			//Se inicia el proceso de envio del correo
			
			//$to = "msanchez@mateosanchez.cl";
				$correo_contacto = "no-reply@mateosanchez.cl";
				$subject = "Nuevo prospecto para el sitio mateosanchez.cl";
				$message = "Se ha resgitrado un nuevo prospecto, pueden ver esta propiedad a traves del sistema de administracion del sitio.\n";
				$from = "$correo_contacto";
				$headers = "From: Sistema mateosanchez <$correo_contacto>\r\n";

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
					$mail->From = $correo_contacto;
					$mail->FromName = "Sistema mateosanchez.cl";
					$mail->addAddress("info@mateosanchez.cl", "Mateo Sanchez Propiedades");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
					$mail->addReplyTo("info@mateosanchez.cl", "Mateo Sanchez Propiedades");
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
					$mail->From = $correo_contacto;
					$mail->FromName = "Sistema mateosanchez.cl";
					$mail->addAddress("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
					$mail->addReplyTo("msanchez@mateosanchez.cl", "Mateo Sanchez Propiedades");
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
			
			$_SESSION["mensaje-sistema"] .= "Propiedad creada con exito.";
		}else{
			$_SESSION["mensaje-sistema"] .= "Se presento un problema inesperado, favor contactar al administrador del sistema.";
		}
		
		//Fin seccion proceso agregado de propiedad
		header("location: ../../subir-prospecto.php");
	}else{
		echo $_SESSION["mensaje-sistema"];
	}
?>
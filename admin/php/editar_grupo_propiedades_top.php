<?php
	session_start();
	require('rutinas.php');
	include('SimpleImage.php');

	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>

	$is_fail = 0;
	$is_test = 0;
	$mensaje = '';
	$allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "BMP", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir

	if(isset($_POST["id_grupo_propiedad"]) && !empty($_POST["id_grupo_propiedad"])){
		$id_grupo_propiedad = $_POST["id_grupo_propiedad"];
		$sql_grupo = "SELECT * FROM grupos_propiedades_top WHERE id_grupo_propiedad = '".$id_grupo_propiedad."'";
		$cursor_grupo = $conexion -> query($sql_grupo);
		//echo $sql_grupo;
		if(!$validar = $cursor_grupo -> rowCount()){
			$validar = 0;
		}

		if($validar == 1){
			$grupo = $cursor_grupo -> fetch();

			if(isset($_POST["titulo_grupo_propiedad"]) && !empty($_POST["titulo_grupo_propiedad"])){
				$titulo_grupo_propiedad = $_POST["titulo_grupo_propiedad"];
			}else{
				$titulo_grupo_propiedad = $grupo["titulo_grupo_propiedad"];
			}

			if(!empty($_FILES["img_grupo_propiedad"])){
				$array = explode(".", strtolower($_FILES["img_grupo_propiedad"]["name"]));
				$extension = end($array);

				if ((($_FILES["img_grupo_propiedad"]["type"] == "image/gif") || ($_FILES["img_grupo_propiedad"]["type"] == "image/jpeg")
				|| ($_FILES["img_grupo_propiedad"]["type"] == "image/png")
				|| ($_FILES["img_grupo_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_grupo_propiedad']['size'] < 6000000){
					list($width, $height) = getimagesize($_FILES["img_grupo_propiedad"]["tmp_name"]);
					if ($_FILES["img_grupo_propiedad"]["error"] > 0){

						//Si hubo problemas se asigna a una imagen base para la muestra
						$img_grupo_propiedad = $propiedad["img_grupo_propiedad"];
						$_SESSION["mensaje-sistema"] .= "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen de la propiedad, se mantiene la propiedad.</div>";

					}else{

						//Se guarda la direccion en que se guarda el archivo nuevo
						do{
							$img_grupo_propiedad = "propiedad-".getUniqueCode().".".$extension;
						}while(file_exists($img_grupo_propiedad));

						if (is_uploaded_file($_FILES["img_grupo_propiedad"]["tmp_name"]) && $is_test == 0){

							//Se sube el archivo a la carpeta correspondiente
							move_uploaded_file($_FILES["img_grupo_propiedad"]["tmp_name"], $img_grupo_propiedad);

							$img = new abeautifulsite\SimpleImage($img_grupo_propiedad);
							$size = getimagesize($img_grupo_propiedad);
							//$size[0] -> Width
							//$size[1] -> Height
							if($size[1] > $size[0]){
								$width_img = 460;
								$height_img = 770;
							}else{
								$width_img = 770;
								$height_img = 460;
							}
							$img -> resize($width_img, $height_img) -> save($img_grupo_propiedad);

							//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
							rename($img_grupo_propiedad,"../../grupo-propiedades/".$img_grupo_propiedad);

						}else{
							//Si hubo problemas se asigna a una imagen base para la muestra
							//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
							$img_grupo_propiedad = $grupo["img_grupo_propiedad"];
						}
					}
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Fallido.<br>";
					$img_grupo_propiedad = $grupo["img_grupo_propiedad"];
				}
			}else{
				$img_grupo_propiedad = $grupo["img_grupo_propiedad"];
			}

			if(isset($_POST["detalle_grupo_propiedad"]) && !empty($_POST["detalle_grupo_propiedad"])){
				$detalle_grupo_propiedad = $_POST["detalle_grupo_propiedad"];
			}else{
				$detalle_grupo_propiedad = $grupo["detalle_grupo_propiedad"];
			}

			/*------------------------------------------------------*/

			if(isset($_POST["id_region"]) && !empty($_POST["id_region"]) && $_POST["id_region"] != '-'){
				$id_region = $_POST["id_region"];
			}else{
				$is_fail = 1;
			}

			if(isset($_POST["id_comuna"]) && !empty($_POST["id_comuna"]) && $_POST["id_comuna"] != '-'){
				$id_comuna = $_POST["id_comuna"];
			}else{
				$is_fail = 1;
			}

			if(isset($_POST["id_sector"]) && !empty($_POST["id_sector"]) && $_POST["id_sector"] != '-'){
				$id_sector = $_POST["id_sector"];
			}else{
				$id_sector = 1;
			}

			if(isset($_POST["id_tipo_propiedad"]) && !empty($_POST["id_tipo_propiedad"]) && $_POST["id_tipo_propiedad"] != '-'){
				$id_tipo_propiedad = $_POST["id_tipo_propiedad"];
			}else{
				$is_fail = 1;
			}

			if(isset($_POST["id_tipo_giro"]) && !empty($_POST["id_tipo_giro"]) && $_POST["id_tipo_giro"] != '-'){
				$id_tipo_giro = $_POST["id_tipo_giro"];
			}else{
				$is_fail = 1;
			}

			if(isset($_POST["detalle_propiedad"]) && !empty($_POST["detalle_propiedad"])){
				$detalle_propiedad = $_POST["detalle_propiedad"];
			}else{
				$is_fail = 1;
			}

			if($is_fail == 0){
				//echo "Proceso de subida de archivos iniciado...<br>";
				$array = explode(".", strtolower($_FILES["img_01_propiedad"]["name"]));
				$extension = end($array);

				/**/
				if ((($_FILES["img_01_propiedad"]["type"] == "image/gif") || ($_FILES["img_01_propiedad"]["type"] == "image/jpeg")
				|| ($_FILES["img_01_propiedad"]["type"] == "image/png")
				|| ($_FILES["img_01_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_01_propiedad']['size'] < 6000000){
					if ($_FILES["img_01_propiedad"]["error"] > 0){

						//Si hubo problemas se asigna a una imagen base para la muestra
						$img_01_propiedad = "imagen-referencial.png";
						$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen del articulo.</div>";

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
							rename ($img_01_propiedad,"../../propiedades/".$img_01_propiedad);

						}else{
							//Si hubo problemas se asigna a una imagen base para la muestra
							//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
							$img_01_propiedad = "imagen-referencial.png";
						}
					}
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					$img_01_propiedad = "imagen-referencial.png";
				}
				/**/

				$id_cuenta = $_SESSION["id_cuenta"];

				$sql_propiedad = "SELECT * FROM propiedades ORDER BY cod_propiedad DESC LIMIT 1";
				$cursor_propiedad = $conexion -> query($sql_propiedad);
				$propiedad = $cursor_propiedad -> fetch();
				$codigo_propiedad_base = $propiedad["cod_propiedad"]+1;
				$fecha_captacion_propiedad = date('Y-m-d');
				$fecha_publicacion_propiedad = date('Y-m-d');
				$observacion_propietario = 'Propiedad generada para grupo de propiedades Nro: '.$id_grupo_propiedad;
				$id_unidad_medida = 1; //Metros cuadrados

				$grupo_codigo_mensaje = "";

				if(isset($_POST["id_tipo_operacion"]) && !empty($_POST["id_tipo_operacion"])){
					foreach ($_POST["id_tipo_operacion"] as $key => $id_tipo_operacion) {
						$cod_propiedad = $codigo_propiedad_base + $key;
						$grupo_codigo_mensaje .= $cod_propiedad.', ';

						/**/
						//$id_tipo_operacion viene con el foreach
						$direccion_propiedad = $_POST["direccion_propiedad"][$key];
						$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"][$key];
						$valor_propiedad = $_POST["valor_propiedad"][$key];
						$id_tipo_valor = $_POST["id_tipo_valor"][$key];

						$sql = "INSERT INTO propiedades ";
						$sql .= "(cod_propiedad, "; //:param_01
						$sql .= "observacion_propietario, "; //:param_02
						$sql .= "id_tipo_operacion, "; //:param_03
						$sql .= "id_tipo_propiedad, "; //:param_04
						$sql .= "id_region, "; //:param_05
						$sql .= "id_comuna, "; //:param_06
						$sql .= "id_sector, "; //:param_07
						$sql .= "cantidad_superficie_construida_propiedad, "; //:param_08
						$sql .= "id_unidad_medida, "; //:param_09
						$sql .= "valor_propiedad, "; //:param_10
						$sql .= "id_tipo_valor, "; //:param_11
						$sql .= "direccion_propiedad, "; //:param_12
						$sql .= "detalle_propiedad, "; //:param_13
						$sql .= "fecha_captacion_propiedad, "; //:param_14
						$sql .= "fecha_publicacion_propiedad, "; //:param_15
						$sql .= "id_cuenta, "; //:param_16
						$sql .= "img_01_propiedad, "; //:param_17
						$sql .= "id_tipo_giro) "; //:param_18
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
						$sql .= ":param_18)";

						//Con el SQL listo se armara la transaccion PDO
						$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$conexion -> beginTransaction();
						$inserta = $conexion -> prepare($sql);
						$inserta -> bindValue(':param_01', $cod_propiedad);
						$inserta -> bindValue(':param_02', $observacion_propietario);
						$inserta -> bindValue(':param_03', $id_tipo_operacion);
						$inserta -> bindValue(':param_04', $id_tipo_propiedad);
						$inserta -> bindValue(':param_05', $id_region);
						$inserta -> bindValue(':param_06', $id_comuna);
						$inserta -> bindValue(':param_07', $id_sector);
						$inserta -> bindValue(':param_08', $cantidad_superficie_construida_propiedad);
						$inserta -> bindValue(':param_09', $id_unidad_medida);
						$inserta -> bindValue(':param_10', $valor_propiedad);
						$inserta -> bindValue(':param_11', $id_tipo_valor);
						$inserta -> bindValue(':param_12', $direccion_propiedad);
						$inserta -> bindValue(':param_13', $detalle_propiedad);
						$inserta -> bindValue(':param_14', $fecha_captacion_propiedad);
						$inserta -> bindValue(':param_15', $fecha_publicacion_propiedad);
						$inserta -> bindValue(':param_16', $id_cuenta);
						$inserta -> bindValue(':param_17', $img_01_propiedad);
						$inserta -> bindValue(':param_18', $id_tipo_giro);

						//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
						$inserta -> execute();
						$conexion -> commit();

						$sql = "INSERT INTO codigos_grupos_propiedades ";
						$sql .= "(cod_propiedad, ";
						$sql .= "id_grupo_propiedad) ";
						$sql .= "VALUES ";
						$sql .= "(:param_01, ";
						$sql .= ":param_02)";

						$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$conexion -> beginTransaction();
						$inserta = $conexion -> prepare($sql);
						$inserta -> bindValue(':param_01', $cod_propiedad);
						$inserta -> bindValue(':param_02', $id_grupo_propiedad);
						$inserta -> execute();
						$conexion -> commit();

						/**/
					}

					$grupo_codigo_mensaje = rtrim($grupo_codigo_mensaje, ", ");

					/**/
					//Codigo de envio de correo para cuenta de barbara u otro coordinador
					$subject = "Alerta por INGRESO DE PROPIEDAD a sistema mateosanchez.cl.";
					$message = "Este es un mensaje automatico avisando que la propiedad codigo(s): ".$grupo_codigo_mensaje." fue ingresado al sistema de mateosanchez.cl \n\n";
					$message .= "Puede ver mas detalle el grupo de propiedades vealo en: <a href='http://www.mateosanchez.cl/propiedades-comercial/ficha-grupo-propiedad.php?id_grupo_propiedad=".$id_grupo_propiedad."'>Este enlace</a> \n";

					$sql_cuenta = "SELECT * FROM cuentas WHERE is_banned = 0 AND lvl_cuenta <= 2";
					$cursor_cuenta = $conexion -> query($sql_cuenta);


					require_once("class.phpmailer.php");
					require_once("class.smtp.php");

					$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
					try {
						$mail->SMTPDebug = 2;                               // Enable verbose debug output
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
						/**/
						while($cuenta = $cursor_cuenta -> fetch()){
							$mail->addAddress($cuenta["correo_cuenta"], $cuenta["nombre_persona"]);
						}
						/**/
						//$mail->addAddress("ignacio.peralta@pcdstudio.cl", "Ignacio Peralta");     // Add a recipient test:
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
					/**/
				}
			}

			//Armamos la sentencia SQL de UPDATE
			$sql = "UPDATE grupos_propiedades_top SET ";
			$sql .= "titulo_grupo_propiedad='".$titulo_grupo_propiedad."', ";
			$sql .= "img_grupo_propiedad='".$img_grupo_propiedad."', ";
			$sql .= "detalle_grupo_propiedad='".$detalle_grupo_propiedad."' ";
			$sql .= "WHERE id_grupo_propiedad=".$id_grupo_propiedad;
			$modifica = $conexion->prepare($sql);
			//echo $sql;
			$modifica->execute();

			$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Proceso terminado con exito.</div>";

		}else{
			$is_fail = 1;

			$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No se encontro el grupo de propiedades a editar, favor intentar nuevamente.</div>";
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Problemas con la asignación de datos, favor contactar al Administrador de sistema.</div>";
	}



	if($is_test == 0){
		header('Location: ../pages/ver-grupos-propiedades-top.php');
	}else{
		echo $_SESSION["mensaje-sistema"];
	}
?>

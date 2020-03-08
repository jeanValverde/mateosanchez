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
	$_SESSION["mensaje-prueba."] = ""; //Inicializar el mensaje de pruebas para revisiones
	
	if(isset($_POST["titulo_grupo_propiedad"]) && !empty($_POST["titulo_grupo_propiedad"])){
		$titulo_grupo_propiedad = $_POST["titulo_grupo_propiedad"];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Titulo del grupo de propiedades.</div>";
	}
	
	if(isset($_POST["detalle_grupo_propiedad"]) && !empty($_POST["detalle_grupo_propiedad"])){
		$detalle_grupo_propiedad = $_POST["detalle_grupo_propiedad"];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Falta el detalle para el grupo de priedades.</div>";
	}
	
	if($is_fail == 0){
		//echo "Proceso de subida de archivos iniciado...<br>";
		$array = explode(".", strtolower($_FILES["img_grupo_propiedad"]["name"]));
		$extension = end($array);

		if ((($_FILES["img_grupo_propiedad"]["type"] == "image/gif") || ($_FILES["img_grupo_propiedad"]["type"] == "image/jpeg")
		|| ($_FILES["img_grupo_propiedad"]["type"] == "image/png")
		|| ($_FILES["img_grupo_propiedad"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_grupo_propiedad']['size'] < 6000000){
			if ($_FILES["img_grupo_propiedad"]["error"] > 0){
					
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_grupo_propiedad = "imagen-referencial.png";
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No fue ingresado la imagen del articulo.</div>";
				
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
					rename ($img_grupo_propiedad,"../../grupo-propiedades/".$img_grupo_propiedad);
					
				}else{
					//Si hubo problemas se asigna a una imagen base para la muestra
					//echo "Imagen 01: Imagen en orden pero no se sube.<br>";
					$img_grupo_propiedad = "imagen-referencial.png";
				}
			}
		}else{
			//Si hubo problemas se asigna a una imagen base para la muestra
			$img_grupo_propiedad = "imagen-referencial.png";
		}
		
		$sql = "INSERT INTO grupos_propiedades ";
		$sql .= "(titulo_grupo_propiedad, "; //:param_01
		$sql .= "img_grupo_propiedad, "; //:param_02
		$sql .= "detalle_grupo_propiedad) "; //:param_03
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03)";
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $titulo_grupo_propiedad);
		$inserta -> bindValue(':param_02', $img_grupo_propiedad);
		$inserta -> bindValue(':param_03', $detalle_grupo_propiedad);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$id_grupo_propiedad = $conexion->lastInsertId();
		$conexion -> commit();
		
		/*
		if(count($_POST['select_cod_propiedades']) > 0){
			$array = $_POST["select_cod_propiedades"];
			
			foreach ($array as &$valor) {
				$sql = "INSERT INTO codigos_grupos_propiedades ";
				$sql .= "(cod_propiedad, "; //:param_01
				$sql .= "id_grupo_propiedad) "; //:param_01
				$sql .= "VALUES ";
				$sql .= "(:param_01, ";
				$sql .= ":param_02)";
				//Con el SQL listo se armara la transaccion PDO
				$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conexion -> beginTransaction();
				$inserta = $conexion -> prepare($sql);
				$inserta -> bindValue(':param_01', $valor);
				$inserta -> bindValue(':param_02', $id_grupo_propiedad);
				
				$inserta -> execute();
				$conexion -> commit();
			}
		}
		*/
		
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Grupo ".$titulo_grupo_propiedad." creado con exito.</div>";
	}
	
	header("location: ../pages/crear-grupo-propiedades.php");
?>
<?php
	session_start();
	require_once('rutinas.php');
	include('SimpleImage.php');
	$is_fail = 0;
	$allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "JPEG", "GIF", "PNG"); //Extensiones permitidas de archivos a subir
	$_SESSION["mensaje-sistema"] = "";
	
	if(isset($_POST["id_cuenta"]) && !empty($_POST["id_cuenta"])){
		$id_cuenta = $_POST["id_cuenta"];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "Cuenta no compatible</br>";
	}
	
	if(isset($_POST['nombre_persona']) && !empty($_POST["nombre_persona"])){
		$nombre_persona = $_POST['nombre_persona'];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "Nombre del agente no es compatible</br>";
	}
	
	if(preg_match('/^[0-9-()+]{3,20}/', $_POST['telefono_persona'])){
		$telefono_persona = $_POST['telefono_persona'];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "Telefono no es compatible</br>";
	}
	
	if(isset($_POST['titulo_perfil_cuenta']) && !empty($_POST["titulo_perfil_cuenta"])){
		$titulo_perfil_cuenta = $_POST['titulo_perfil_cuenta'];
	}else{
		$titulo_perfil_cuenta = "";
		$_SESSION["mensaje-sistema"] .= "Titulo del perfil no es compatible</br>";
	}
	
	$array = explode(".", strtolower($_FILES["img_perfil_cuenta"]["name"]));
	$extension = end($array);

	if ((($_FILES["img_perfil_cuenta"]["type"] == "image/gif") || ($_FILES["img_perfil_cuenta"]["type"] == "image/jpeg")
	|| ($_FILES["img_perfil_cuenta"]["type"] == "image/png")
	|| ($_FILES["img_perfil_cuenta"]["type"] == "image/pjpeg")) && in_array($extension, $allowedExts) && $_FILES['img_perfil_cuenta']['size'] < 6000000){
		if ($_FILES["img_perfil_cuenta"]["error"] > 0){
				
			//Si hubo problemas se asigna a una imagen base para la muestra
			$img_perfil_cuenta = "";
			$_SESSION["mensaje-sistema"] .= "No fue ingresado la imagen del articulo</br>";
			
		}else{
			
			//Se guarda la direccion en que se guarda el archivo nuevo
			do{
				$img_perfil_cuenta = "perfil-".getUniqueCode().".".$extension;
			}while(file_exists($img_perfil_cuenta));
			
			if (is_uploaded_file($_FILES["img_perfil_cuenta"]["tmp_name"])){
				
				//Se sube el archivo a la carpeta correspondiente
				move_uploaded_file($_FILES["img_perfil_cuenta"]["tmp_name"], $img_perfil_cuenta);
				
				$img = new abeautifulsite\SimpleImage($img_perfil_cuenta);
				$img->resize(270, 260)->save($img_perfil_cuenta);
				
				//La imagen procesada se movera a la carpeta correspondiente para su futuro uso
				rename ($img_perfil_cuenta,"../../agentes/".$img_perfil_cuenta);
				
			}else{
				//Si hubo problemas se asigna a una imagen base para la muestra
				$img_perfil_cuenta = "";
				$_SESSION["mensaje-sistema"] .= "La imagen no pudo ser subida al servidor</br>";
			}
		}
	}else{
		//Si hubo problemas se asigna a una imagen base para la muestra
		$img_perfil_cuenta = "";
		$_SESSION["mensaje-sistema"] .= "La imagen presento un problema de extension o peso que no corresponde</br>";
	}
	
	if(isset($_POST['descripcion_perfil_cuenta']) && !empty($_POST["descripcion_perfil_cuenta"])){
		$descripcion_perfil_cuenta = $_POST['descripcion_perfil_cuenta'];
	}else{
		$descripcion_perfil_cuenta = "";
		$_SESSION["mensaje-sistema"] .= "Descripcion del perfil no es compatible</br>";
	}
	
	if($is_fail == 0){
		//Armamos la sentencia SQL de UPDATE
		$sql = "UPDATE cuentas SET ";
		$sql .= "nombre_persona = '".$nombre_persona."', ";
		$sql .= "telefono_persona = '".$telefono_persona."', ";
		$sql .= "titulo_perfil_cuenta = '".$titulo_perfil_cuenta."', ";
		$sql .= "img_perfil_cuenta = '".$img_perfil_cuenta."', ";
		$sql .= "descripcion_perfil_cuenta = '".$descripcion_perfil_cuenta."' ";
		$sql .= "WHERE id_cuenta = ".$id_cuenta;
		$modifica = $conexion->prepare($sql);
		
		if($modifica->execute()){
			
			$_SESSION["mensaje-sistema"] = "Exito: Proceso terminado sin problemas, saludos.";
		}else{
			$_SESSION["mensaje-sistema"] = "Error: Hubo un problema con el sistema, favor contactar al administrador del sitio.";
			$if_fail = 1;
		}
	}else{
		$_SESSION["mensaje-sistema"] = "Error: Uno de los datos no corresponde a lo pedido.";
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	//echo $_SESSION["mensaje-sistema"];
	header("location: ../pages/editar-corredor.php?id_cuenta=".$id_cuenta);
?>
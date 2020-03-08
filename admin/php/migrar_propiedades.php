<?php
	require_once("rutinas.php");
	$is_fail = 0;
	$file = fopen("mateosanchez-d.txt", "r");
	
	while(!feof($file)){
		$linea = fgets($file);
		$datos = explode(";", $linea);
		
		if(isset($datos[21])){
			$id_propiedad = trim($datos[21]);
		}else{
			$is_fail = 1;
		}
		
		$cod_propiedad = trim($datos[0]);
		
		if(isset($datos[25])){
			$nombre_propietario = trim($datos[25]);
		}else{
			$is_fail = 1;
		}
		
		$telefono_propietario = "";
		$correo_propietario = "";
		$rut_propietario = "";
		$observacion_propietario = "";
		$is_hidden = 0;
		
		if(isset($datos[16])){
			$cantidad_visitas_propiedad = trim($datos[16]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[2])){
			if($datos[2] == "A"){
					$id_tipo_operacion = "1";
			}else{
				$id_tipo_operacion = "2";
			}
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[3])){
			switch (trim($datos[3])) {
				case "C":
					$id_tipo_propiedad = 1;
					break;
				case "D":
					$id_tipo_propiedad = 2;
					break;
				case "S":
					$id_tipo_propiedad = 9;
					break;
				case "L":
					$id_tipo_propiedad = 10;
					break;
				case "P":
					$id_tipo_propiedad = 6;
					break;
				case "O":
					$id_tipo_propiedad = 11;
					break;
				case "G":
					$id_tipo_propiedad = 7;
					break;
				case "I":
					$id_tipo_propiedad = 8;
					break;
				default:
					$id_tipo_propiedad = 12;
			}
		}
		$id_region = 5;
		
		if(isset($datos[4])){
			switch (trim($datos[4])) {
				case 5501:
					$id_comuna = 1;
					break;
				case 5109:
					$id_comuna = 34;
					break;
				case 2:
					$id_comuna = 33;
					break;
				case 3:
					$id_comuna = 37;
					break;
				case 4:
					$id_comuna = 38;
					break;
				case 5507:
					$id_comuna = 36;
					break;
				case 5505:
					$id_comuna = 35;
					break;
				case 5:
					$id_comuna = 29;
					break;
				case 6:
					$id_comuna = 32;
					break;
				default:
					$id_comuna = trim($datos[4]);
			}
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[5])){
			$id_sector = trim($datos[5]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[7])){
			$cantidad_superficie_total_propiedad = trim($datos[7]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[6])){
			$cantidad_superficie_construida_propiedad = trim($datos[6]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[8])){
			if(trim($datos[8]) == "H"){
				$id_unidad_medida = 2;
			}else{
				$id_unidad_medida = 1;
			}
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[9])){
			$valor_propiedad = trim($datos[9]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[10])){
			if(trim($datos[10]) == "$"){
				$id_tipo_valor = 1;
			}else{
				$id_tipo_valor = 2;
			}
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[11])){
			$dormitorios_propiedad = trim($datos[11]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[12])){
			$banos_propiedad = trim($datos[12]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[15])){
			$nro_estacionamiento = trim($datos[15]);
		}else{
			$is_fail = 1;
		}
		
		if(isset($datos[18])){
			$detalle_propiedad = trim($datos[18]);
		}else{
			$is_fail = 1;
		}
		
		$fecha_captacion_propiedad = "2015-06-16";
		$fecha_publicacion_propiedad = "2015-06-16";
		$fecha_modificacion_propiedad = "2015-06-16";
		
		if(isset($datos[23])){
			$is_fotos = trim($datos[23]);
		}else{
			$is_fail = 1;
		}
		
		$id_cuenta = 1;
		
		if(isset($datos[27])){
			$direccion_propiedad = trim($datos[27]);
		}else{
			$is_fail = 1;
		}
		
		if($is_fail == 0){
			$sql = "INSERT INTO propiedades ";
			$sql .= "(id_propiedad, ";
			$sql .= "cod_propiedad, ";
			$sql .= "nombre_propietario, ";
			$sql .= "telefono_propietario, ";
			$sql .= "correo_propietario, ";
			$sql .= "rut_propietario, ";
			$sql .= "observacion_propietario, ";
			$sql .= "is_hidden, ";
			$sql .= "cantidad_visitas_propiedad, ";
			$sql .= "id_tipo_operacion, ";
			$sql .= "id_tipo_propiedad, ";
			$sql .= "id_region, ";
			$sql .= "id_comuna, ";
			$sql .= "id_sector, ";
			$sql .= "cantidad_superficie_total_propiedad, ";
			$sql .= "cantidad_superficie_construida_propiedad, ";
			$sql .= "id_unidad_medida, ";
			$sql .= "valor_propiedad, ";
			$sql .= "id_tipo_valor, ";
			$sql .= "dormitorios_propiedad, ";
			$sql .= "banos_propiedad, ";
			$sql .= "nro_estacionamiento, ";
			$sql .= "detalle_propiedad, ";
			$sql .= "fecha_captacion_propiedad, ";
			$sql .= "fecha_publicacion_propiedad, ";
			$sql .= "fecha_modificacion_propiedad, ";
			$sql .= "is_fotos, ";
			$sql .= "id_cuenta, ";
			$sql .= "direccion_propiedad) ";
			$sql .= "VALUES ";
			$sql .= "('$id_propiedad', ";
			$sql .= "'$cod_propiedad', ";
			$sql .= "'$nombre_propietario', ";
			$sql .= "'$telefono_propietario', ";
			$sql .= "'$correo_propietario', ";
			$sql .= "'$rut_propietario', ";
			$sql .= "'$observacion_propietario', ";
			$sql .= "'$is_hidden', ";
			$sql .= "'$cantidad_visitas_propiedad', ";
			$sql .= "'$id_tipo_operacion', ";
			$sql .= "'$id_tipo_propiedad', ";
			$sql .= "'$id_region', ";
			$sql .= "'$id_comuna', ";
			$sql .= "'$id_sector', ";
			$sql .= "'$cantidad_superficie_total_propiedad', ";
			$sql .= "'$cantidad_superficie_construida_propiedad', ";
			$sql .= "'$id_unidad_medida', ";
			$sql .= "'$valor_propiedad', ";
			$sql .= "'$id_tipo_valor', ";
			$sql .= "'$dormitorios_propiedad', ";
			$sql .= "'$banos_propiedad', ";
			$sql .= "'$nro_estacionamiento', ";
			$sql .= "'$detalle_propiedad', ";
			$sql .= "'$fecha_captacion_propiedad', ";
			$sql .= "'$fecha_publicacion_propiedad', ";
			$sql .= "'$fecha_modificacion_propiedad', ";
			$sql .= "'$is_fotos', ";
			$sql .= "'$id_cuenta', ";
			$sql .= "'$direccion_propiedad')";
			$conexion->query($sql);
		}
		
		echo fgets($file);
		
		if($is_fail == 0){
			echo "  <---- <span style='color: green;'>Correcto</span> <br>";
		}else{
			echo "  <---- <span style='color: red;'>Malo</span> <br>";
		}
		
	}
	
	fclose($file);
	
	
	//foreach ($lineas as $linea_num => $linea){
	//	if($linea != ";;;;;;;;;;;;;;;;;;;;;;;;;;;;"){
	//		$datos = explode(";",$linea);
	//		
	//		if(isset($datos[21])){
	//			$id_propiedad = trim($datos[21]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		$cod_propiedad = trim($datos[0]);
	//		
	//		if(isset($datos[25])){
	//			$nombre_propietario = trim($datos[25]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		$telefono_propietario = "";
	//		$correo_propietario = "";
	//		$rut_propietario = "";
	//		$observacion_propietario = "";
	//		$is_hidden = 0;
	//		
	//		if(isset($datos[16])){
	//			$cantidad_visitas_propiedad = trim($datos[16]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[2])){
	//			if($datos[2] == "A"){
	//					$id_tipo_operacion = "1";
	//			}else{
	//				$id_tipo_operacion = "2";
	//			}
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[3])){
	//			switch (trim($datos[3])) {
	//				case "C":
	//					$id_tipo_propiedad = 1;
	//					break;
	//				case "D":
	//					$id_tipo_propiedad = 2;
	//					break;
	//				case "S":
	//					$id_tipo_propiedad = 9;
	//					break;
	//				case "L":
	//					$id_tipo_propiedad = 10;
	//					break;
	//				case "P":
	//					$id_tipo_propiedad = 6;
	//					break;
	//				case "O":
	//					$id_tipo_propiedad = 11;
	//					break;
	//				case "G":
	//					$id_tipo_propiedad = 7;
	//					break;
	//				case "I":
	//					$id_tipo_propiedad = 8;
	//					break;
	//				default:
	//					$id_tipo_propiedad = 12;
	//			}
	//		}
	//		$id_region = 5;
	//		
	//		if(isset($datos[4])){
	//			switch (trim($datos[4])) {
	//				case 5501:
	//					$id_comuna = 1;
	//					break;
	//				case 5109:
	//					$id_comuna = 34;
	//					break;
	//				case 2:
	//					$id_comuna = 33;
	//					break;
	//				case 3:
	//					$id_comuna = 37;
	//					break;
	//				case 4:
	//					$id_comuna = 38;
	//					break;
	//				case 5507:
	//					$id_comuna = 36;
	//					break;
	//				case 5505:
	//					$id_comuna = 35;
	//					break;
	//				case 5:
	//					$id_comuna = 29;
	//					break;
	//				case 6:
	//					$id_comuna = 32;
	//					break;
	//				default:
	//					$id_comuna = trim($datos[4]);
	//			}
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[5])){
	//			$id_sector = trim($datos[5]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[7])){
	//			$cantidad_superficie_total_propiedad = trim($datos[7]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[6])){
	//			$cantidad_superficie_construida_propiedad = trim($datos[6]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[8])){
	//			if(trim($datos[8]) == "H"){
	//				$id_unidad_medida = 2;
	//			}else{
	//				$id_unidad_medida = 1;
	//			}
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[9])){
	//			$valor_propiedad = trim($datos[9]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[10])){
	//			if(trim($datos[10]) == "$"){
	//				$id_tipo_valor = 1;
	//			}else{
	//				$id_tipo_valor = 2;
	//			}
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[11])){
	//			$dormitorios_propiedad = trim($datos[11]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[12])){
	//			$banos_propiedad = trim($datos[12]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[15])){
	//			$nro_estacionamiento = trim($datos[15]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		if(isset($datos[18])){
	//			$detalle_propiedad = trim($datos[18]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		$fecha_captacion_propiedad = "2015-06-16";
	//		$fecha_publicacion_propiedad = "2015-06-16";
	//		$fecha_modificacion_propiedad = "2015-06-16";
	//		
	//		if(isset($datos[23])){
	//			$is_fotos = trim($datos[23]);
	//		}else{
	//			$is_fail = 1;
	//		}
	//		
	//		$id_cuenta = 1;
	//		
	//		$direccion_propiedad = trim($datos[27]);
	//	
	//		if($is_fail == 0){
	//			$sql = "INSERT INTO propiedades ";
	//			$sql .= "(id_propiedad, ";
	//			$sql .= "cod_propiedad, ";
	//			$sql .= "nombre_propietario, ";
	//			$sql .= "telefono_propietario, ";
	//			$sql .= "correo_propietario, ";
	//			$sql .= "rut_propietario, ";
	//			$sql .= "observacion_propietario, ";
	//			$sql .= "is_hidden, ";
	//			$sql .= "cantidad_visitas_propiedad, ";
	//			$sql .= "id_tipo_operacion, ";
	//			$sql .= "id_tipo_propiedad, ";
	//			$sql .= "id_region, ";
	//			$sql .= "id_comuna, ";
	//			$sql .= "id_sector, ";
	//			$sql .= "cantidad_superficie_total_propiedad, ";
	//			$sql .= "cantidad_superficie_construida_propiedad, ";
	//			$sql .= "id_unidad_medida, ";
	//			$sql .= "valor_propiedad, ";
	//			$sql .= "id_tipo_valor, ";
	//			$sql .= "dormitorios_propiedad, ";
	//			$sql .= "banos_propiedad, ";
	//			$sql .= "nro_estacionamiento, ";
	//			$sql .= "detalle_propiedad, ";
	//			$sql .= "fecha_captacion_propiedad, ";
	//			$sql .= "fecha_publicacion_propiedad, ";
	//			$sql .= "fecha_modificacion_propiedad, ";
	//			$sql .= "is_fotos, ";
	//			$sql .= "id_cuenta, ";
	//			$sql .= "direccion_propiedad) ";
	//			$sql .= "VALUES ";
	//			$sql .= "('$id_propiedad', ";
	//			$sql .= "'$cod_propiedad', ";
	//			$sql .= "'$nombre_propietario', ";
	//			$sql .= "'$telefono_propietario', ";
	//			$sql .= "'$correo_propietario', ";
	//			$sql .= "'$rut_propietario', ";
	//			$sql .= "'$observacion_propietario', ";
	//			$sql .= "'$is_hidden', ";
	//			$sql .= "'$cantidad_visitas_propiedad', ";
	//			$sql .= "'$id_tipo_operacion', ";
	//			$sql .= "'$id_tipo_propiedad', ";
	//			$sql .= "'$id_region', ";
	//			$sql .= "'$id_comuna', ";
	//			$sql .= "'$id_sector', ";
	//			$sql .= "'$cantidad_superficie_total_propiedad', ";
	//			$sql .= "'$cantidad_superficie_construida_propiedad', ";
	//			$sql .= "'$id_unidad_medida', ";
	//			$sql .= "'$valor_propiedad', ";
	//			$sql .= "'$id_tipo_valor', ";
	//			$sql .= "'$dormitorios_propiedad', ";
	//			$sql .= "'$banos_propiedad', ";
	//			$sql .= "'$nro_estacionamiento', ";
	//			$sql .= "'$detalle_propiedad', ";
	//			$sql .= "'$fecha_captacion_propiedad', ";
	//			$sql .= "'$fecha_publicacion_propiedad', ";
	//			$sql .= "'$fecha_modificacion_propiedad', ";
	//			$sql .= "'$is_fotos', ";
	//			$sql .= "'$id_cuenta', ";
	//			$sql .= "$direccion_propiedad)";
	//			$conexion->query($sql);
	//		}
	//	}
	//}
?>
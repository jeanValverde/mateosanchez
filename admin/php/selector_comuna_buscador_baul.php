<?php
	include("rutinas.php");

	$id_region=$_REQUEST["id"];
	//Este codigo es para llenar los combobox correspondientes
	if($id_region != "-"){
		//realizamos la consulta 
		$sql = "SELECT * FROM comunas ";
		$sql .= "WHERE id_region = ".$id_region." ";
		$sql .= "ORDER BY nombre_comuna";
		$cursor = $conexion->query($sql);
		
		echo "<option value='-'>Escoja</option>";
		while ($comuna=$cursor->fetch()){
			$sql_validar = "SELECT * FROM baul_propiedades WHERE id_comuna=".$comuna["id_comuna"];
			$cursor_validar = $conexion -> query($sql_validar);
			if(!$validar = $cursor_validar -> rowCount()){
				$validar = 0;
			}
			
			if($validar > 0){
				echo "<option value='".$comuna["id_comuna"]."'>".utf8_encode($comuna["nombre_comuna"])."</option>";
			}
		}
	}else{
		echo "<option value='-'>Escoja</option>";
	}
?>
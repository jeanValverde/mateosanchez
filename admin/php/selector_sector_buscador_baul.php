<?php
	include("rutinas.php");

	$id_comuna=$_REQUEST["id"];
	//Este codigo es para llenar los combobox correspondientes
	if($id_comuna != "-"){
		//realizamos la consulta 
		$sql = "SELECT * FROM sectores ";
		$sql .= "WHERE id_comuna = ".$id_comuna." ";
		$sql .= "ORDER BY nombre_sector";
		$cursor = $conexion->query($sql);
		
		echo "<option value='-'>Escoja</option>";
		while ($sector=$cursor->fetch()){
			$sql_validar = "SELECT * FROM baul_propiedades WHERE id_sector=".$sector["id_sector"];
			$cursor_validar = $conexion -> query($sql_validar);
			if(!$validar = $cursor_validar -> rowCount()){
				$validar = 0;
			}
			
			if($validar > 0){
				echo "<option value='".$sector["id_sector"]."'>".utf8_encode($sector["nombre_sector"])."</option>";
			}
		}
	}else{
		echo "<option value='-'>Escoja</option>";
	}
?>
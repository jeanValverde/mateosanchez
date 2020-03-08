<?php
	include("rutinas.php");

	$id_comuna=$_REQUEST["id"];
	//Este codigo es para llenar los combobox correspondientes
	if($id_comuna != "-"){
		//realizamos la consulta 
		$sql = "SELECT * FROM sectores ";
		$sql .= "WHERE id_comuna = ".$id_comuna." ORDER BY nombre_sector ASC";
		$cursor = $conexion->query($sql);
		
		echo "<option value='-'>Escoja un sector</option>";
		while ($sector=$cursor->fetch()){
			echo "<option value='".$sector["id_sector"]."'>".utf8_encode($sector["nombre_sector"])."</option>";
		}
	}else{
		echo "<option value='-'>Escoja primero una comuna</option>";
	}
?>
<?php
	include("rutinas.php");

	$id_region=$_REQUEST["id"];
	//Este codigo es para llenar los combobox correspondientes
	if($id_region != "-"){
		//realizamos la consulta
		$sql = "SELECT * FROM comunas ";
		$sql .= "WHERE id_region = ".$id_region." ORDER BY nombre_comuna ASC";
		$cursor = $conexion->query($sql);

		echo "<option value='-'>Escoja una comuna</option>";
		while ($comuna=$cursor->fetch()){
			echo "<option value='".$comuna["id_comuna"]."'>".utf8_encode($comuna["nombre_comuna"])."</option>";
		}
	}else{
		echo "<option value='-'>Escoja primero una region</option>";
	}
?>

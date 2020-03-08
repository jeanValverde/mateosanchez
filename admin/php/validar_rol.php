<?php
	require("rutinas.php");
	if(!empty($_POST["rol_propiedad"])){
		
		$sql_validar_rol = "SELECT * FROM propiedades INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta WHERE rol_propiedad='".$_POST["rol_propiedad"]."'";
		$cursor_validar_rol = $conexion -> query($sql_validar_rol);
		if(!$validar_rol = $cursor_validar_rol -> rowCount()){
			$validar_rol = 0;
		}
		
		if($validar_rol == 0){
			echo "Esta Libre";
		}else{
			$propiedad = $cursor_validar_rol -> fetch();
			echo "Esta asignado a: ".$propiedad["nombre_persona"];
		}
		
	}else{
		echo "Rol no ingresado";
	}
?>
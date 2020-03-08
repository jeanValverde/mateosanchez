<?php
	if(isset($_POST["observaciones_propietario"])){
		$observaciones_propietario = $_POST["observaciones_propietario"];
		setcookie("observaciones_propietario", $observaciones_propietario, time()+(5*60), "/");
	}
	
	if(isset($_POST["direccion_propiedad"])){
		$direccion_propiedad = $_POST["direccion_propiedad"];
		setcookie("direccion_propiedad", $direccion_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["valor"])){
		$valor = $_POST["valor"];
		setcookie("valor", $valor, time()+(5*60), "/");
	}
	
	if(isset($_POST["dormitorios_propiedad"])){
		$dormitorios_propiedad = $_POST["dormitorios_propiedad"];
		setcookie("dormitorios_propiedad", $dormitorios_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["banos_propiedad"])){
		$banos_propiedad = $_POST["banos_propiedad"];
		setcookie("banos_propiedad", $banos_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["nro_estacionamiento"])){
		$nro_estacionamiento = $_POST["nro_estacionamiento"];
		setcookie("nro_estacionamiento", $nro_estacionamiento, time()+(5*60), "/");
	}
	
	if(isset($_POST["nro_bodega"])){
		$nro_bodega = $_POST["nro_bodega"];
		setcookie("nro_bodega", $nro_bodega, time()+(5*60), "/");
	}
	
	if(isset($_POST["cantidad_superficie_total_propiedad"])){
		$cantidad_superficie_total_propiedad = $_POST["cantidad_superficie_total_propiedad"];
		setcookie("cantidad_superficie_total_propiedad", $cantidad_superficie_total_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["cantidad_superficie_construida_propiedad"])){
		$cantidad_superficie_construida_propiedad = $_POST["cantidad_superficie_construida_propiedad"];
		setcookie("cantidad_superficie_construida_propiedad", $cantidad_superficie_construida_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["detalle_propiedad"])){
		$detalle_propiedad = $_POST["detalle_propiedad"];
		setcookie("detalle_propiedad", $detalle_propiedad, time()+(5*60), "/");
	}
	
	if(isset($_POST["detalle_corredor"])){
		$detalle_corredor = $_POST["detalle_corredor"];
		setcookie("detalle_corredor", $detalle_corredor, time()+(5*60), "/");
	}
	
?>
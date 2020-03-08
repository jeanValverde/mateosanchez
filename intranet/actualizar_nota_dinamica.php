<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$sql_validar_nota = "SELECT * FROM notas_dinamicas WHERE id_cuenta = ".$_POST["id_cuenta"]." ORDER BY id_nota_dinamica DESC LIMIT 1";
	$cursor_validar_nota = $conexion -> query($sql_validar_nota);
	if(!$validar_nota = $cursor_validar_nota -> rowCount()){
		$validar_nota = 0;
	}
	
	if($validar_nota == 0){
		//Armamos la SQL para crear la nueva cuenta
		$sql = "INSERT INTO notas_dinamicas ";
		$sql .= "(id_cuenta, "; //:param_01
		$sql .= "detalle_nota_dinamica, "; //:param_02
		$sql .= "fecha_creacion_nota_dinamica, "; //NOW()
		$sql .= "fecha_borrado_nota_dinamica) "; //0000-00-00()
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= "NOW(), ";
		$sql .= "0000-00-00)";
		
		
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $_POST["id_cuenta"]);
		$inserta -> bindValue(':param_02', $_POST["detalle_nota_dinamica"]);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
	}else{
		$nota = $cursor_validar_nota -> fetch();
		$id_nota_dinamica = $nota["id_nota_dinamica"];
		
		//Armamos la SQL para crear la nueva cuenta
		$sql = "UPDATE notas_dinamicas SET ";
		$sql .= "detalle_nota_dinamica = '".$_POST["detalle_nota_dinamica"]."' ";
		$sql .= "WHERE id_nota_dinamica = ".$id_nota_dinamica;
		
		//Con el SQL listo se armara la transaccion PDO
		$modifica = $conexion->prepare($sql);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$modifica->execute();
	}
?>
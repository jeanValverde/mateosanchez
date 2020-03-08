<?php
	session_start();
	require('rutinas.php');
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = '';

	if(isset($_GET["id_grupo_propiedad"]) && !empty($_GET["id_grupo_propiedad"])){
		$sql_grupo = "SELECT * FROM grupos_propiedades_top WHERE id_grupo_propiedad = '".$_GET["id_grupo_propiedad"]."'";
		$cursor_grupo = $conexion -> query($sql_grupo);
		if(!$validar_grupo = $cursor_grupo -> rowCount()){
			$validar_grupo = 0;
		}

		if($validar_grupo == 1){
			$grupo = $cursor_grupo -> fetch();

			$sql = "DELETE FROM codigos_grupos_propiedades WHERE id_grupo_propiedad=".$_GET["id_grupo_propiedad"];
			$borra = $conexion->prepare($sql);
			$borra->execute();

			$sql = "DELETE FROM grupos_propiedades_top WHERE id_grupo_propiedad=".$_GET["id_grupo_propiedad"];
			$borra = $conexion->prepare($sql);
			$borra->execute();

			$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Proceso terminado con exito.</div>";
		}else{
			$_SESSION["mensaje-sistema"] = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Grupo no econtrado o duplicado.</div>";
		}
	}else{
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Grupo vacio o no asignado.</div>";
	}

	header('Location: ../pages/ver-grupos-propiedades-top.php');
?>

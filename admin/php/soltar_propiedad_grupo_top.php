<?php
	session_start();
	require_once('rutinas.php');

	$is_fail = 0;
	$is_test = 0;
	$_SESSION["mensaje-sistema"] = "";

	if(isset($_GET["id_grupo_propiedad"]) && !empty($_GET["id_grupo_propiedad"])){
		$id_grupo_propiedad = $_GET["id_grupo_propiedad"];
		if(isset($_GET["cod_propiedad"]) && !empty($_GET["cod_propiedad"])){
			$cod_propiedad = $_GET["cod_propiedad"];

			$sql_validar = "SELECT * FROM codigos_grupos_propiedades WHERE id_grupo_propiedad='".$id_grupo_propiedad."' AND cod_propiedad = '".$cod_propiedad."'";
			$cursor_validar = $conexion -> query($sql_validar);
			if(!$validar = $cursor_validar -> rowCount()){
				$validar = 0;
			}

			if($validar == 1){
				$propiedad_grupo = $cursor_validar -> fetch();

				$sql = "DELETE FROM codigos_grupos_propiedades WHERE id_codigo_grupo_propiedad=".$propiedad_grupo["id_codigo_grupo_propiedad"];
				$borra = $conexion->prepare($sql);
				$borra->execute();

				$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Propiedad desconectada del grupo.</div>";
			}else{
				$is_fail = 1;
				$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>No se encontro la propiedad anexada al grupo entregado, favor intentar nuevamente.</div>";
			}
		}else{
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>La propiedad entrega esta vacia o no asignada.</div>";
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>El grupo de propiedades entregado esta vacio o no existente.</div>";
	}

	if($is_test == 0){
		header('Location: ../pages/editar-grupo-propiedades-top.php?id_grupo_propiedad='.$_GET["id_grupo_propiedad"]);
	}
?>

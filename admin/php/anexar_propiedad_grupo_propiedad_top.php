<?php
	session_start();
	require_once('rutinas.php');

	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>

	$is_fail = 0;
	$is_test = 0;
	$_SESSION["mensaje-sistema"] = "";

	if(isset($_GET["id_grupo_propiedad"]) && !empty($_GET["id_grupo_propiedad"])){
		$id_grupo_propiedad = $_GET["id_grupo_propiedad"];
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Grupo de propiedades no asignado adecuadamente, favor intentar nuevamente.</div>";
	}

	if(isset($_GET["cod_propiedad"]) && !empty($_GET["cod_propiedad"])){
		$cod_propiedad = $_GET["cod_propiedad"];
		$sql_propiedad_grupo = "SELECT * FROM codigos_grupos_propiedades WHERE cod_propiedad='".$cod_propiedad."'";
		$cursor_propiedad_grupo = $conexion -> query($sql_propiedad_grupo);
		if(!$validar_propiedad_grupo = $cursor_propiedad_grupo -> rowCount()){
			$validar_propiedad_grupo = 0;
		}

		if($validar_propiedad_grupo != 0){
			$is_fail = 1;
			$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Esta propiedad ya esta en un grupo de propiedades.</div>";
		}
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] .= "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Codigo de propiedad no fue asignado correctamente, favor intentar nuevamente.</div>";
	}

	if($is_fail == 0){
		$sql = "INSERT INTO codigos_grupos_propiedades ";
		$sql .= "(cod_propiedad, "; //:param_01
		$sql .= "id_grupo_propiedad) "; //:param_02
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02)";

		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $cod_propiedad);
		$inserta -> bindValue(':param_02', $id_grupo_propiedad);

		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();

		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> La propiedad ".$cod_propiedad." anexada exitosamente.</div>";
	}

	if($is_test == 0){
		header('Location: ../pages/editar-grupo-propiedades-top.php?id_grupo_propiedad='.$_GET["id_grupo_propiedad"]);
	}
?>

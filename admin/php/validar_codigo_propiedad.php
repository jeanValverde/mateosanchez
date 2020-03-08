<?php
	require("rutinas.php");
	if(isset($_POST["cod_actual"]) && $_POST["cod_actual"] == $_POST["cod_propiedad"]){
		echo "S";
	}else{
		if(!empty($_POST["cod_propiedad"])){
			$sql_validar_codigo = "SELECT * FROM propiedades WHERE cod_propiedad='".$_POST["cod_propiedad"]."'";
			$cursor_validar_codigo = $conexion -> query($sql_validar_codigo);
			if(!$validar_codigo = $cursor_validar_codigo -> rowCount()){
				$validar_codigo = 0;
			}
			
			if($validar_codigo == 0){
				echo "S";
			}else{
				echo "E";
			}
			
		}else{
			echo "Empty";
		}
	}
?>
<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	session_start();
	require_once('rutinas.php');
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	$text_test = "";
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	//Validacion de datos
	if(isset($_POST["id_cuenta"]) && !empty($_POST["id_cuenta"])){
		$id_cuenta = $_POST["id_cuenta"];
		$text_test .= "Cuenta asignada: ".$_POST["id_cuenta"];
	}else{
		$is_fail = 1;
		$text_test .= "Cuenta asignada: ERROR";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["lunes_tarea"]) && !empty($_POST["lunes_tarea"])){
		$lunes_tarea = 1;
		$text_test .= "Lunes asignado: TRUE";
	}else{
		$lunes_tarea = 0;
		$text_test .= "Lunes asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["martes_tarea"]) && !empty($_POST["martes_tarea"])){
		$martes_tarea = 1;
		$text_test .= "Martes asignado: TRUE";
	}else{
		$martes_tarea = 0;
		$text_test .= "Martes asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["miercoles_tarea"]) && !empty($_POST["miercoles_tarea"])){
		$miercoles_tarea = 1;
		$text_test .= "Miercoles asignado: TRUE";
	}else{
		$miercoles_tarea = 0;
		$text_test .= "Miercoles asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["jueves_tarea"]) && !empty($_POST["jueves_tarea"])){
		$jueves_tarea = 1;
		$text_test .= "Jueves asignado: TRUE";
	}else{
		$jueves_tarea = 0;
		$text_test .= "Jueves asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["viernes_tarea"]) && !empty($_POST["viernes_tarea"])){
		$viernes_tarea = 1;
		$text_test .= "Viernes asignado: TRUE";
	}else{
		$viernes_tarea = 0;
		$text_test .= "Viernes asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["sabado_tarea"]) && !empty($_POST["sabado_tarea"])){
		$sabado_tarea = 1;
		$text_test .= "Sabado asignado: TRUE";
	}else{
		$sabado_tarea = 0;
		$text_test .= "Sabado asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["domingo_tarea"]) && !empty($_POST["domingo_tarea"])){
		$domingo_tarea = 1;
		$text_test .= "Domingo asignado: TRUE";
	}else{
		$domingo_tarea = 0;
		$text_test .= "Domingo asignado: FALSE";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["iteracion_tarea"]) && !empty($_POST["iteracion_tarea"])){
		$iteracion_tarea = $_POST["iteracion_tarea"];
		$text_test .= "Iteracion tarea: ".$_POST["iteracion_tarea"]." veces.";
	}else{
		$iteracion_tarea = 1;
		$text_test .= "Iteracion tarea: 1";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["intercalar_tarea"]) && !empty($_POST["intercalar_tarea"])){
		$intercalar_tarea = $_POST["intercalar_tarea"];
		$text_test .= "Intercalar tarea: ".$_POST["intercalar_tarea"]." veces.";
	}else{
		$intercalar_tarea = 1;
		$text_test .= "Intercalar tarea: 0";
	}
	
	$text_test .= "<br>";
	
	$fecha = date('Y-m-j');
	$cant_iteraciones=1;
	$cant_intercalar = 0;
	$string_fechas = "";
	
	while($cant_iteraciones <= $iteracion_tarea){
		$cant_dia_pasados = date ('N', strtotime($fecha));
		$cant_dias_restantes = 7-intval($cant_dia_pasados);
		$text_test .= "Semana con tarea dias: ";
		
		if($cant_intercalar == 0){
			for ($i = 0; $i <= $cant_dias_restantes; $i++) {
				$dia_fecha = date ('N', strtotime($fecha));
				
				if($dia_fecha == 1){ //Lunes
					if($lunes_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 2){ //Martes
					if($martes_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 3){ //Miercoles
					if($miercoles_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 4){ //Jueves
					if($jueves_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 5){ //Viernes
					if($viernes_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 6){ //Sabado
					if($sabado_tarea == 1){
						$text_test .= $fecha.", ";
						$string_fechas .= $fecha.", ";
					}
				}elseif($dia_fecha == 7){ //Domingo
					if($domingo_tarea == 1){
						$text_test .= $fecha;
						$string_fechas .= $fecha.", ";
					}
				}
				
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
				$fecha = $nuevafecha;
			}
			$cant_intercalar = $cant_intercalar+$intercalar_tarea;
			$cant_iteraciones +=1;
		}else{
			$cant_intercalar -= 1;
			$nuevafecha = strtotime ( '+7 day' , strtotime ( $fecha ) ) ;
			$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			$fecha = $nuevafecha;
		}
		
		$text_test .= "<br>";
	}
	
	$string_fechas = substr($string_fechas, 0, -1);
	$array_fechas = explode(',', $string_fechas);
	
	if(isset($_POST["id_tarea"]) && !empty($_POST["id_tarea"]) && $_POST["id_tarea"] != "-"){
		$id_tarea = $_POST["id_tarea"];
		$text_test .= "ID tarea: ".$_POST["id_tarea"];
	}elseif(isset($_POST["nueva_tarea"]) && !empty($_POST["nueva_tarea"])){
		//Limpiar y estadarizar
		$nueva_tarea = ucwords(strtolower($_POST["nueva_tarea"]));
		
		//Validar que no exista en la base de datos
		$sql_validar = "SELECT * FROM tareas WHERE nombre_tarea = '".$nueva_tarea."'";
		$cursor_validar = $conexion -> query($sql_validar);
		if(!$validar = $cursor_validar -> rowCount()){
			$validar = 0;
		}
		
		if($validar == 0){
			$sql = "INSERT INTO tareas ";
			$sql .= "(nombre_tarea) "; //:param_01
			$sql .= "VALUES ";
			$sql .= "(:param_01)";
			
			//Con el SQL listo se armara la transaccion PDO
			$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion -> beginTransaction();
			$inserta = $conexion -> prepare($sql);
			$inserta -> bindValue(':param_01', $nueva_tarea);
			
			//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
			$inserta -> execute();
			$id_tarea = $conexion -> lastInsertId();
			$conexion -> commit();
			$text_test .= "Tarea nueva ingresada ID: ".$id_tarea;
		}else{
			$tarea = $cursor_validar -> fetch();
			$id_tarea = $tarea["id_tarea"];
			$text_test .= "Tarea nueva ya existente ID: ".$id_tarea;
		}
	}else{
		$is_fail = 1;
		$text_test .= "Tarea ingresada: ERROR";
	}
	
	$text_test .= "<br>";
	
	if(isset($_POST["descripcion_tarea"]) && !empty($_POST["descripcion_tarea"])){
		$descripcion_tarea = $_POST["descripcion_tarea"];
		$text_test .= "Descripcion tarea: ".$_POST["descripcion_tarea"];
	}else{
		$descripcion_tarea = "";
		$text_test .= "Descripcion tarea: NO ASIGNADA";
	}
	
	$text_test .= "<br>";
	
	if($is_test != 0){
		echo $text_test;
	}else{
		if($is_fail == 0){
			$sql = "INSERT INTO cuentasxtareas ";
			$sql .= "(id_tarea, "; //:param_01
			$sql .= "id_cuenta, "; //:param_02
			$sql .= "descripcion_tarea) "; //:param_03
			$sql .= "VALUES ";
			$sql .= "(:param_01, ";
			$sql .= ":param_02, ";
			$sql .= ":param_03)";
			
			//Con el SQL listo se armara la transaccion PDO
			$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conexion -> beginTransaction();
			$inserta = $conexion -> prepare($sql);
			$inserta -> bindValue(':param_01', $id_tarea);
			$inserta -> bindValue(':param_02', $id_cuenta);
			$inserta -> bindValue(':param_03', $descripcion_tarea);
			
			//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
			$inserta -> execute();
			$id_cuentaxtarea = $conexion -> lastInsertId();
			$conexion -> commit();
			
			foreach ($array_fechas as &$fecha) {
				
				$sql = "INSERT INTO fechas ";
				$sql .= "(id_cuentaxtarea, "; //:param_01
				$sql .= "fecha_tarea)"; //:param_02
				$sql .= "VALUES ";
				$sql .= "(:param_01, ";
				$sql .= ":param_02)";
				
				//Con el SQL listo se armara la transaccion PDO
				$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conexion -> beginTransaction();
				$inserta = $conexion -> prepare($sql);
				$inserta -> bindValue(':param_01', $id_cuentaxtarea);
				$inserta -> bindValue(':param_02', date('Y-m-j',strtotime($fecha)));
				
				//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
				$inserta -> execute();
				$conexion -> commit();
			}
			
			$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Exito!</strong> Tarea asignada sin problemas, buen dia.</div>";
		
		}else{
			$_SESSION["mensaje-sistema"] = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Uno de los datos no es valido para asignar tarea, favor intentar nuevamente o contactar con PCDStudio.</div>";
		
		}
		
		header("location: ../pages/asignar-tarea.php");
	}
?>
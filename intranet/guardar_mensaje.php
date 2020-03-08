<?php
	session_start();
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	require_once("../admin/php/rutinas.php");
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_SESSION["id_cuenta"]) && !empty($_SESSION["id_cuenta"])){
		$id_cuenta = $_SESSION["id_cuenta"];
	}else{
		$id_cuenta = $_COOKIE["id_cuenta"];
	}
	
	if(isset($_POST['detalle_mensaje']) && !empty($_POST['detalle_mensaje'])){
		$detalle_mensaje = $_POST['detalle_mensaje'];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST['id_receptor'])){
		$id_receptor = $_POST['id_receptor'];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST['nombre_cliente'])){
		$nombre_cliente = $_POST['nombre_cliente'];
	}else{
		$nombre_cliente = "";
	}
	
	if(isset($_POST['telefono_cliente'])){
		$telefono_cliente = $_POST['telefono_cliente'];
	}else{
		$telefono_cliente = "";
	}
	
	if(isset($_POST['correo_cliente'])){
		$correo_cliente = $_POST['correo_cliente'];
	}else{
		$correo_cliente = "";
	}
	
	if(isset($_POST['codigo_propiedad_cliente'])){
		$codigo_propiedad_cliente = $_POST['codigo_propiedad_cliente'];
	}else{
		$codigo_propiedad_cliente = "";
	}
	
	if(isset($_POST['id_tipo_propiedad'])){
		$id_tipo_propiedad = $_POST['id_tipo_propiedad'];
	}else{
		$id_tipo_propiedad = 0;
	}
	
	$is_captacion = 0;
	if(isset($_POST['id_tipo_operacion'])){
		if($_POST["id_tipo_operacion"] == 'k'){
			$id_tipo_operacion = 0;
			$is_captacion = 1;
		}else{
			$id_tipo_operacion = $_POST['id_tipo_operacion'];
		}
	}else{
		$id_tipo_operacion = 0;
	}
	
	if(isset($_POST['valor_desde'])){
		$valor_desde = str_replace(",", "", substr($_POST['valor_desde'], 1));
	}else{
		$valor_desde = 0;
	}
	
	if(isset($_POST['valor_hasta'])){
		$valor_hasta = str_replace(",", "", substr($_POST['valor_hasta'], 1));
	}else{
		$valor_hasta = 0;
	}
	
	if(isset($_POST["id_tipo_valor"])){
		$id_tipo_valor = $_POST["id_tipo_valor"];
	}else{
		$id_tipo_valor = 0;
	}
	
	if(isset($_POST["id_region"])){
		$id_region = $_POST["id_region"];
	}else{
		$id_region = 0;
	}
	
	if(isset($_POST["id_comuna"]) && $_POST["id_comuna"] != "-"){
		$id_comuna = $_POST["id_comuna"];
	}else{
		$id_comuna = 0;
	}
	
	if(isset($_POST["id_sector"]) && $_POST["id_sector"] != "-"){
		$id_sector = $_POST["id_sector"];
	}else{
		$id_sector = 0;
	}
	
	if(isset($_POST["icasas_mensaje"])){
		$icasas_mensaje = 1;
	}else{
		$icasas_mensaje = 0;
	}
	
	if(isset($_POST["vivastreet_mensaje"])){
		$vivastreet_mensaje = 1;
	}else{
		$vivastreet_mensaje = 0;
	}
	
	if(isset($_POST["toctoc_mensaje"])){
		$toctoc_mensaje = 1;
	}else{
		$toctoc_mensaje = 0;
	}
	
	if(isset($_POST["economicos_mensaje"])){
		$economicos_mensaje = 1;
	}else{
		$economicos_mensaje = 0;
	}
	
	if(isset($_POST["fich_mensaje"])){
		$fich_mensaje = 1;
	}else{
		$fich_mensaje = 0;
	}
	
	if(isset($_POST["portal_inmobiliario_mensaje"])){
		$portal_inmobiliario_mensaje = 1;
	}else{
		$portal_inmobiliario_mensaje = 0;
	}
	
	if(isset($_POST["yapo_mensaje"])){
		$yapo_mensaje = 1;
	}else{
		$yapo_mensaje = 0;
	}
	
	if(isset($_POST["facebook_mensaje"])){
		$facebook_mensaje = 1;
	}else{
		$facebook_mensaje = 0;
	}
	
	if(isset($_POST["fan_page_mensaje"])){
		$fan_page_mensaje = 1;
	}else{
		$fan_page_mensaje = 0;
	}
	
	if(isset($_POST["instagram_mensaje"])){
		$instagram_mensaje = 1;
	}else{
		$instagram_mensaje = 0;
	}
	
	if(isset($_POST["pura_noticia_mensaje"])){
		$pura_noticia_mensaje = 1;
	}else{
		$pura_noticia_mensaje = 0;
	}
	
	if(isset($_POST["pagina_web_mensaje"])){
		$pagina_web_mensaje = 1;
	}else{
		$pagina_web_mensaje = 0;
	}
	
	if(isset($_POST["info_mateo_mensaje"])){
		$info_mateo_mensaje = 1;
	}else{
		$info_mateo_mensaje = 0;
	}
	
	if(isset($_POST["publicidad_terreno_mensaje"])){
		$publicidad_terreno_mensaje = 1;
	}else{
		$publicidad_terreno_mensaje = 0;
	}
	
	if(isset($_POST["llamado_telefonico"])){
		$llamado_telefonico = 1;
	}else{
		$llamado_telefonico = 0;
	}
	
	if($is_fail == 0 && $is_test == 0){
	
		//Armamos la SQL para crear la nueva cuenta
		$sql = "INSERT INTO mensajes ";
		$sql .= "(id_cuenta, "; //:param_01
		$sql .= "fecha_mensaje, "; 
		$sql .= "id_receptor, "; //:param_02
		$sql .= "detalle_mensaje, "; //:param_03
		$sql .= "nombre_cliente, "; //:param_04
		$sql .= "telefono_cliente, "; //:param_05
		$sql .= "correo_cliente, "; //:param_06
		$sql .= "codigo_propiedad_cliente, "; //:param_07
		$sql .= "id_tipo_propiedad, "; //:param_08
		$sql .= "id_tipo_operacion, "; //:param_09
		$sql .= "valor_desde, "; //:param_10
		//$sql .= "valor_hasta, "; //:param_11
		$sql .= "id_tipo_valor, "; //:param_12
		$sql .= "id_region, "; //:param_13
		$sql .= "id_comuna, "; //:param_14
		$sql .= "id_sector, "; //:param_15
		$sql .= "is_captacion, "; //:param_16
		$sql .= "icasas_mensaje, "; //:param_17
		$sql .= "vivastreet_mensaje, "; //:param_18
		$sql .= "toctoc_mensaje, "; //:param_19
		$sql .= "economicos_mensaje, "; //:param_20
		$sql .= "fich_mensaje, "; //:param_21
		$sql .= "portal_inmobiliario_mensaje, "; //:param_22
		$sql .= "yapo_mensaje, "; //:param_23
		$sql .= "facebook_mensaje, "; //:param_24
		$sql .= "fan_page_mensaje, "; //:param_25
		$sql .= "instagram_mensaje, "; //:param_26
		$sql .= "pura_noticia_mensaje, "; //:param_27
		$sql .= "pagina_web_mensaje, "; //:param_28
		$sql .= "info_mateo_mensaje, "; //:param_29
		$sql .= "publicidad_terreno_mensaje, "; //:param_30
		$sql .= "llamado_telefonico) "; //:param_31
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= "NOW(), ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04, ";
		$sql .= ":param_05, ";
		$sql .= ":param_06, ";
		$sql .= ":param_07, ";
		$sql .= ":param_08, ";
		$sql .= ":param_09, ";
		$sql .= ":param_10, ";
		//$sql .= ":param_11, ";
		$sql .= ":param_12, ";
		$sql .= ":param_13, ";
		$sql .= ":param_14, ";
		$sql .= ":param_15, ";
		$sql .= ":param_16, ";
		$sql .= ":param_17, ";
		$sql .= ":param_18, ";
		$sql .= ":param_19, ";
		$sql .= ":param_20, ";
		$sql .= ":param_21, ";
		$sql .= ":param_22, ";
		$sql .= ":param_23, ";
		$sql .= ":param_24, ";
		$sql .= ":param_25, ";
		$sql .= ":param_26, ";
		$sql .= ":param_27, ";
		$sql .= ":param_28, ";
		$sql .= ":param_29, ";
		$sql .= ":param_30, ";
		$sql .= ":param_31)";
		
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $id_cuenta);
		$inserta -> bindValue(':param_02', $id_receptor);
		$inserta -> bindValue(':param_03', $detalle_mensaje);
		$inserta -> bindValue(':param_04', $nombre_cliente);
		$inserta -> bindValue(':param_05', $telefono_cliente);
		$inserta -> bindValue(':param_06', $correo_cliente);
		$inserta -> bindValue(':param_07', $codigo_propiedad_cliente);
		$inserta -> bindValue(':param_08', $id_tipo_propiedad);
		$inserta -> bindValue(':param_09', $id_tipo_operacion);
		$inserta -> bindValue(':param_10', $valor_desde);
		//$inserta -> bindValue(':param_11', $valor_hasta);
		$inserta -> bindValue(':param_12', $id_tipo_valor);
		$inserta -> bindValue(':param_13', $id_region);
		$inserta -> bindValue(':param_14', $id_comuna);
		$inserta -> bindValue(':param_15', $id_sector);
		$inserta -> bindValue(':param_16', $is_captacion);
		$inserta -> bindValue(':param_17', $icasas_mensaje);
		$inserta -> bindValue(':param_18', $vivastreet_mensaje);
		$inserta -> bindValue(':param_19', $toctoc_mensaje);
		$inserta -> bindValue(':param_20', $economicos_mensaje);
		$inserta -> bindValue(':param_21', $fich_mensaje);
		$inserta -> bindValue(':param_22', $portal_inmobiliario_mensaje);
		$inserta -> bindValue(':param_23', $yapo_mensaje);
		$inserta -> bindValue(':param_24', $facebook_mensaje);
		$inserta -> bindValue(':param_25', $fan_page_mensaje);
		$inserta -> bindValue(':param_26', $instagram_mensaje);
		$inserta -> bindValue(':param_27', $pura_noticia_mensaje);
		$inserta -> bindValue(':param_28', $pagina_web_mensaje);
		$inserta -> bindValue(':param_29', $info_mateo_mensaje);
		$inserta -> bindValue(':param_30', $publicidad_terreno_mensaje);
		$inserta -> bindValue(':param_31', $llamado_telefonico);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
		
		$_SESSION["mensaje-sistema"] = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Mensaje guardado con exito.</div>";
	}
	header("location: crear-nota.php");
?>
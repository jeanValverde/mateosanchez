<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$is_test = 0;
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	//<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Success!</strong> Maecenas non lorem sed elit molestie tincidunt.</div>
	//<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Sed in molestie lectus. Curabitur non est neque. Maecenas id luctus ligula.</div>
	//<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Vestibulum tincidunt libero urna, ut dignissim purus accumsan nec.</div>
	//<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Mauris dignissim ante eu arcu ultricies, at sodales orci aliquet.</div>
	
	// Validar datos de ingreso
	
	if(isset($_POST['id_mensaje']) && !empty($_POST['id_mensaje'])){
		$id_mensaje = $_POST['id_mensaje'];
	}else{
		$is_fail = 1;
	}
	
	if(isset($_POST['detalle_mensaje']) && !empty($_POST['detalle_mensaje'])){
		$detalle_mensaje = $_POST['detalle_mensaje'];
	}else{
		$is_fail = 1;
	}
	
	$id_tipo_propiedad = $_POST['id_tipo_propiedad'];
	
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
	
	$nombre_cliente = $_POST["nombre_cliente"];
	$telefono_cliente = $_POST["telefono_cliente"];
	$correo_cliente = $_POST["correo_cliente"];
	$codigo_propiedad_cliente = $_POST["codigo_propiedad_cliente"];
	//$valor_desde = str_replace(".", "", (str_replace(",", "", substr($_POST['valor_desde'], 1))));
	$valor_hasta = str_replace(".", "", (str_replace(",", "", substr($_POST['valor_hasta'], 1))));
	
	if(isset($_POST["id_tipo_valor"]) && $_POST["id_tipo_valor"] != "-"){
		$id_tipo_valor = $_POST["id_tipo_valor"];
	}else{
		$id_tipo_valor = 0;
	}
	
	if(isset($_POST["id_region"]) && $_POST["id_region"] != "-"){
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
	
	$id_estado_mensaje = $_POST["id_estado_mensaje"];
	
	if($is_fail == 0 && $is_test == 0){
	
		//Armamos la SQL para crear la nueva cuenta
		$sql = "UPDATE mensajes SET ";
		$sql .= "detalle_mensaje = '".$detalle_mensaje."', ";
		$sql .= "id_tipo_propiedad = '".$id_tipo_propiedad."', ";
		$sql .= "id_tipo_operacion = '".$id_tipo_operacion."', ";
		$sql .= "nombre_cliente = '".$nombre_cliente."', ";
		$sql .= "telefono_cliente = '".$telefono_cliente."', ";
		$sql .= "correo_cliente = '".$correo_cliente."', ";
		$sql .= "codigo_propiedad_cliente = '".$codigo_propiedad_cliente."', ";
		//$sql .= "valor_desde = ".$valor_desde.", ";
		$sql .= "valor_hasta = '".$valor_hasta."', ";
		$sql .= "id_tipo_valor = '".$id_tipo_valor."', ";
		$sql .= "id_region = '".$id_region."', ";
		$sql .= "id_comuna = '".$id_comuna."', ";
		$sql .= "id_sector = '".$id_sector."', ";
		$sql .= "is_captacion = '".$is_captacion."', ";
		$sql .= "icasas_mensaje = '".$icasas_mensaje."', ";
		$sql .= "vivastreet_mensaje = '".$vivastreet_mensaje."', ";
		$sql .= "toctoc_mensaje = '".$toctoc_mensaje."', ";
		$sql .= "economicos_mensaje = '".$economicos_mensaje."', ";
		$sql .= "fich_mensaje = '".$fich_mensaje."', ";
		$sql .= "portal_inmobiliario_mensaje = '".$portal_inmobiliario_mensaje."', ";
		$sql .= "yapo_mensaje = '".$yapo_mensaje."', ";
		$sql .= "facebook_mensaje = '".$facebook_mensaje."', ";
		$sql .= "fan_page_mensaje = '".$fan_page_mensaje."', ";
		$sql .= "instagram_mensaje = '".$instagram_mensaje."', ";
		$sql .= "pura_noticia_mensaje = '".$pura_noticia_mensaje."', ";
		$sql .= "pagina_web_mensaje = '".$pagina_web_mensaje."', ";
		$sql .= "info_mateo_mensaje = '".$info_mateo_mensaje."', ";
		$sql .= "publicidad_terreno_mensaje = '".$publicidad_terreno_mensaje."', ";
		$sql .= "llamado_telefonico = '".$llamado_telefonico."', ";
		$sql .= "id_estado_mensaje = '".$id_estado_mensaje."' ";
		$sql .= "WHERE id_mensaje = ".$id_mensaje;
		
		//Con el SQL listo se armara la transaccion PDO
		$modifica = $conexion->prepare($sql);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$modifica->execute();
	}else{
		$_SESSION["mensaje-sistema"] = "Problema con los datos entregados, favor contactar con PCDStudio.";
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	echo $sql;
	header("location: ficha-mensaje.php?id_mensaje=".$id_mensaje);
	
?>
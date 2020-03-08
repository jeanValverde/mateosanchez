<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$sql_nota_dinamica = "SELECT * FROM notas_dinamicas WHERE id_cuenta = ".$_SESSION["id_cuenta"]." ORDER BY id_nota_dinamica DESC LIMIT 1";
	$cursor_nota_dinamica = $conexion->query($sql_nota_dinamica);
	if(!$validar_nota_dinamica = $cursor_nota_dinamica->rowCount()){
		$validar_nota_dinamica = 0;
	}
	
	if($validar_nota_dinamica == 0){
		$nota_dinamica["detalle_nota_dinamica"] = "Nota: ";
	}else{
		$nota_dinamica = $cursor_nota_dinamica->fetch();
	}
	
	$_GET["is_and"] = 0;
	
	$sql_mensaje = "SELECT * FROM mensajes INNER JOIN cuentas ON mensajes.id_cuenta = cuentas.id_cuenta WHERE mensajes.is_close = 0";
	
	if(isset($_GET["query"]) && !empty($_GET["query"])){
		$query = $_GET["query"];
		$array = explode(" ", $query);
		$is_first = 0;
		//$is_plural += 1;
		
		$sql_mensaje .= " AND (";
		
		foreach ($array as $query) {
			if($is_first == 0){
				$sql_mensaje .= "mensajes.detalle_mensaje LIKE '%".$query."%'";
			}else{
				$sql_mensaje .= " OR mensajes.detalle_mensaje LIKE '%".$query."%'";
			}
			
			$is_first += 1;
		}
		
		$sql_mensaje .= ")";
	}else{
		if(isset($_GET["id_mensaje"]) && !empty($_GET["id_mensaje"])){
			$sql_mensaje .= " AND mensajes.id_mensaje = ".$_GET["id_mensaje"];
		}
		
		if(isset($_GET["id_tipo_propiedad"]) && $_GET["id_tipo_propiedad"] != 0){
		
			if(isset($_GET["id_tipo_operacion"]) && ($_GET["id_tipo_operacion"] != 0 || $_GET["id_tipo_operacion"] == 'k')){
				$sql_mensaje .= " AND (id_tipo_propiedad=".$_GET["id_tipo_propiedad"];
				if($_GET["is_and"] == 1){
					$sql_mensaje .= " AND";
				}else{
					$sql_mensaje .= " OR";
				}
				
				if($_GET["id_tipo_operacion"] == 'k'){
					$sql_mensaje .= " is_captacion='1')";
				}else{
					$sql_mensaje .= " id_tipo_operacion=".$_GET["id_tipo_operacion"].")";
				}
				
			}else{
				$sql_mensaje .= " AND id_tipo_propiedad=".$_GET["id_tipo_propiedad"];
			}
		}elseif(isset($_GET["id_tipo_operacion"]) && ($_GET["id_tipo_operacion"] != 0 || $_GET["id_tipo_operacion"] == 'k')){
			
			if($_GET["id_tipo_operacion"] == 'k'){
				$sql_mensaje .= " AND is_captacion='1'";
			}else{
				$sql_mensaje .= " AND id_tipo_operacion=".$_GET["id_tipo_operacion"];
			}
		}
		
		if(isset($_GET["id_region"]) && !empty($_GET["id_region"]) && $_GET["id_region"] != "-"){
			$sql_mensaje .= " AND id_region=".$_GET["id_region"];
		}
		if(isset($_GET["id_comuna"]) && !empty($_GET["id_comuna"]) && $_GET["id_comuna"] != "-"){
			$sql_mensaje .= " AND id_comuna=".$_GET["id_comuna"];
		}
		if(isset($_GET["id_sector"]) && !empty($_GET["id_sector"]) && $_GET["id_sector"] != "-"){
			$sql_mensaje .= " AND id_sector=".$_GET["id_sector"];
		}
	}
	
	if(isset($_GET["id_receptor"]) && !empty($_GET["id_receptor"])){
		$sql_mensaje .= " AND mensajes.id_receptor = ".$_GET["id_receptor"];
	}
	
	//if(isset($_GET["fecha_inicio"]) && !empty($_GET["fecha_inicio"]) && isset($_GET["fecha_final"]) && !empty($_GET["fecha_final"])){
	//	$sql_mensaje .= " AND fecha_mensaje BETWEEN '".$_GET["fecha_inicio"]."' AND '".$_GET["fecha_final"]."'";
	//}elseif(isset($_GET["fecha_final"]) && !empty($_GET["fecha_final"])){
	//	$fecha_final = strtotime ('+1 day' , strtotime($_GET["fecha_final"]));
	//	$fecha_final = date ('Y-m-d' , $fecha_final);
	//	$sql_mensaje .= " AND fecha_mensaje NOT BETWEEN '".$fecha_final."' AND '".date("Y-m-d")."'";
	//}elseif(isset($_GET["fecha_inicio"]) && !empty($_GET["fecha_inicio"])){
	//	$sql_mensaje .= " AND fecha_mensaje BETWEEN '".$_GET["fecha_inicio"]."' AND '".date("Y-m-d")."'";
	//}
	
	//if(isset($_GET["valor_desde"]) && !empty($_GET["valor_desde"]) && isset($_GET["valor_hasta"]) && !empty($_GET["valor_hasta"])){
	//	$_GET["valor_desde"] = str_replace(",", "", substr($_GET["valor_desde"], 1));
	//	$_GET["valor_hasta"] = str_replace(",", "", substr($_GET["valor_hasta"], 1));
	//	$valor_desde = $_GET["valor_desde"];
	//	$valor_hasta = $_GET["valor_hasta"];
	//	$sql_mensaje .= " AND ((valor_desde BETWEEN ".$valor_desde." AND ".$valor_hasta.") OR (valor_hasta BETWEEN ".$valor_desde." AND ".$valor_hasta."))";
	//
	//}elseif((isset($_GET["valor_desde"]) && !empty($_GET["valor_desde"])) && (!isset($_GET["valor_hasta"]) || empty($_GET["valor_hasta"]))){
	//	$_GET["valor_desde"] = str_replace(",", "", substr($_GET["valor_desde"], 1));
	//	$valor_desde = $_GET["valor_desde"];
	//	$sql_mensaje .= " AND valor_desde >= ".$valor_desde;
	//
	//}elseif((isset($_GET["valor_hasta"]) && !empty($_GET["valor_hasta"])) && (!isset($_GET["valor_desde"]) || empty($_GET["valor_desde"]))){
	//	$_GET["valor_hasta"] = str_replace(",", "", substr($_GET["valor_hasta"], 1));
	//	$valor_hasta = $_GET["valor_hasta"];
	//	$sql_mensaje .= " AND valor_hasta <= ".$valor_hasta;
	//}
	
	//if(isset($_GET["id_tipo_valor"]) && !empty($_GET["id_tipo_valor"])){
	//	$sql .= " AND id_tipo_valor=".$_GET["id_tipo_valor"];
	//}
	
	$hoy = date("Y-m-d");
	$dos_meses_atras = date("Y-m-d", strtotime("-3 Months")); //Esta seteado para 3 meses hacia atras
	
	$sql_mensaje .= " AND fecha_mensaje BETWEEN '".$dos_meses_atras."' AND '".$hoy."'";
	
	$sql_mensaje .= " ORDER BY mensajes.id_mensaje DESC, mensajes.is_reeded DESC";
	
	// Numero de registros por pagina
	$registros='12';

	// Tomamos el valor de GET de la pagina
	if(isset($_GET["pagina"])){
		$pagina = $_GET["pagina"];
	}
	
	// Comprobamos si pagina tiene valor numerico
	if (!isset($pagina)) {
		$inicio = 0;
		$pagina = 1;
		
	}else{
		$inicio = ($pagina - 1) * $registros;
	}
	
	$_SESSION["url_mensaje"] = basename($_SERVER["REQUEST_URI"]);

	$entradas = $conexion->query($sql_mensaje);
	if(!$total_registros = $entradas -> rowCount()){
		$total_registros = 0;
	}

	$sql_mensaje .= " LIMIT ".$inicio.",".$registros;
	$entradas = $conexion -> query($sql_mensaje);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php
		require_once('shared-code.php');
		?>
		<style>
			.not-reeded{
				font-weight: bold;
			}
		</style>
    </head>
    <body id="home" class="wide">
        <!-- PRELOADER -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="loader-logo"> <img src="assets/img/loader-logo.png" alt=""> </div>
                    <div class="object" id="first_object"> </div>
                    <div class="object" id="second_object"></div>
                    <div class="object" id="third_object"></div>
                </div>
            </div>
        </div>
        <!-- /PRELOADER -->

        <!-- WRAPPER -->
        <div class="wrapper">

            <?php
			require_once('header.php');
			?>

            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs text-right">
                    <div class="container">
                        <div class="page-header">
                            <h1>Ver notas</h1>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="home.php">Inicio</a></li>
							<li class="active">Inicio</li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE WITH SIDEBAR -->
                <section class="page-section with-sidebar sub-page">
                    <div class="container">
                        <div class="row" style="margin-bottom: 15px;">
							 <!-- CONTENT -->
							<div class="col-md-9 content property-listing" id="content">
								<?php
									if(isset($_SESSION["mensaje-sistema"])){
										echo $_SESSION["mensaje-sistema"];
										unset($_SESSION["mensaje-sistema"]);
									}
								?>
								
								<div class="row" style="margin-bottom: 15px;">
									<div class="form-search light" style="border: solid black 2px;">
										<form>
											<div class="form-title">
												<i class="fa fa-home"></i>
												<h2>Filtro de busqueda</h2>
											</div>

											<div class="row row-inputs" style="margin-bottom: 15px;">
												<div class="container-fluid">
													<!--
													<div class="col-md-3">
														<label>Fecha inicial</label>
														<input type="date" class="form-control" name="fecha_inicio" placeholder="Fecha inicial"></input>
													</div>
													<div class="col-md-3">
														<label>Fecha final</label>
														<input type="date" class="form-control" name="fecha_final" placeholder="Fecha final"></input>
													</div>
													-->
													<div class="col-md-6">
														<label>Receptor</label>
														<select class="form-control" name="id_receptor">
															<option value="">Cualquiera</option>
															<?php
															$sql_cuenta = "SELECT * FROM cuentas WHERE can_intranet = 1";
															$cursor_cuenta = $conexion -> query($sql_cuenta);
															while($cuenta = $cursor_cuenta -> fetch()){
																?>
																<option value="<?php echo $cuenta["id_cuenta"]; ?>" <?php if($cuenta["id_cuenta"] == $_SESSION["id_cuenta"]){echo "SELECTED";} ?>><?php echo $cuenta["correo_cuenta"]; ?></option>
																<?php
															}
															?>
														</select>
													</div>
													
													<div class="col-md-2">
														<label>N&uacute;mero Nota</label>
														<input type="number" class="form-control" name="id_mensaje" placeholder="N&deg; Nota"></input>
													</div>
													
													<!--
													<div class="col-md-3">
														<label>Monto inicial</label>
														<input type="text" class="form-control format_precio" name="valor_desde" placeholder="Agregar monto"></input>
													</div>
													-->
													<div class="col-md-4">
														<label>Monto valor</label>
														<input type="text" class="form-control format_precio" name="valor_hasta" placeholder="Agregar monto"></input>
													</div>
												</div>
											</div>

											<div class="row row-inputs">
												<div class="container-fluid">
													<div class="col-md-4">
														<label>Tipo valor</label>
														<select class="form-control" name="id_tipo_valor">
															<option value="0">Cualquiera</option>
															<?php
															$sql_valor = "SELECT * FROM tipo_valores";
															$cursor_valor = $conexion -> query($sql_valor);
															while($valor = $cursor_valor -> fetch()){
																?>
																<option value="<?php echo $valor["id_tipo_valor"]; ?>"><?php echo $valor["nombre_tipo_valor"]; ?></option>
																<?php
															}
															?>
														</select>
													</div>
													
													<div class="col-md-4">
														<label>Tipo de propiedad</label>
														<select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
															<option value="0">No considerado</option>
															<?php
															$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY nombre_tipo_propiedad";
															$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
															while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
																?>
																<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"]; ?>"><?php echo $tipo_propiedad["nombre_tipo_propiedad"]; ?></option>
																<?php
															}
															?>
														</select>
													</div>
													
													<!--
													<div class="col-md-4">
														<label>Y / O </label>
														<select class="form-control" id="is_and" name="is_and">
															<option value="0">O</option>
															<option value="1">Y</option>
														</select>
													</div>
													-->
													
													<div class="col-md-4">
														<label>Tipo de operaci&oacute;n</label>
														<select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
															<option value="0">No considerado</option>
															<?php
															$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY nombre_tipo_operacion";
															$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
															while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
																?>
																<option value="<?php echo $tipo_operacion["id_tipo_operacion"]; ?>"><?php echo $tipo_operacion["nombre_tipo_operacion"]; ?></option>
																<?php
															}
															?>
															<option value="k">Captaci&oacute;n</option>
														</select>
													</div>
												</div>
											</div>

											<div class="row row-inputs">
												<div class="container-fluid">
													<div class="col-md-4">
														<label>Regi&oacute;n</label>
														<select class="form-control" id="id_region" name="id_region">
															<option value="">No considerado</option>
															<?php
															$sql_region = "SELECT * FROM regiones ORDER BY id_region";
															$cursor_region = $conexion -> query($sql_region);
															while($region = $cursor_region -> fetch()){
																?>
																<option value="<?php echo $region["id_region"]; ?>"><?php echo $region["nombre_region"]; ?></option>
																<?php
															}
															?>
														</select>
													</div>
													
													<div class="col-md-4">
														<label>Comuna</label>
														<select class="form-control" id="id_comuna" name="id_comuna">
															<option value="">No considerado</option>
														</select>
													</div>
													
													<div class="col-md-4">
														<label>Sector</label>
														<select class="form-control" id="id_sector" name="id_sector">
															<option value="">No considerado</option>
														</select>
													</div>
												</div>
											</div>
											
											<div class="row row-inputs">
												<div class="container-fluid">
													<div class="col-md-12">
														<label>Busqueda libre</label>
														<input class="form-control" type="text" id="query" name="query" placeholder="Agregar terminos (Casa, Vi&ntilde;a, Pub, etc...)"></input>
													</div>
												</div>
											</div>
											
											<div class="row row-submit" style="margin-bottom: 15px;">
												<div class="container-fluid">
													<div class="inner" style="background-color:inherit;">
														<button type="submit" class="btn btn-submit ripple-effect btn-theme pull-right">Filtrar</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								
								<!--<p><?php echo $sql_mensaje; ?></p>-->
								
								<?php
								if($total_registros != 0){
								?>
								<form method="post" action="cerrar_mensajes_grupal.php">
									<table class="table">
										<thead>
											<th style="width: 70px;">Nota</th>
											<th>Receptor</th>
											<th>Mensaje</th>
											<th>Fecha</th>
											<th>Opci&oacute;n</th>
										</thead>
									<?php	
										while($mensaje = $entradas->fetch()){
										?>
										<!-- /Car Listing -->
										
											<tr <?php if($mensaje["is_reeded"] == 0){echo "class='not-reeded'";}?>>
												<td><input type="checkbox" name="to_close_id_mensaje[]" value="<?php echo $mensaje["id_mensaje"]; ?>"> <?php echo $mensaje["id_mensaje"]; ?></td>
												<td>
													<?php
													if($mensaje["id_receptor"] != 0){
														$sql_receptor = "SELECT * FROM cuentas WHERE id_cuenta=".$mensaje["id_receptor"];
														$cursor_receptor = $conexion -> query($sql_receptor);
														$receptor = $cursor_receptor -> fetch();
														
														echo str_replace("@mateosanchez.cl", "", $receptor["correo_cuenta"]);
													}else{
														echo "Para todos";
													}
													?>
												</td>
												<td><?php echo substr(strtolower($mensaje["detalle_mensaje"]), 0, 100)."...";?></td>
												<td><?php echo $mensaje["fecha_mensaje"]; ?></td>
												<td>
													<div><a href="ficha-mensaje.php?id_mensaje=<?php echo $mensaje["id_mensaje"];?>" class="btn btn-info" style="color: white;"> Ver mensaje </a></div>
													<div style="margin-top: 10px;"><a href="dejar-no-leido-mensaje.php?id_mensaje=<?php echo $mensaje["id_mensaje"];?>" class="btn btn-info" style="color: white;"> No leido </a></div>
												</td>
											</tr>
										
										<?php
										}
									?>
									</table>
									<?php
									}
									?>
									
									<!-- Pagination -->
									<div class="pagination-wrapper">
										<ul class="pagination">
											<?php
											if($total_registros>$registros){
												if(($pagina - 1) > 0) {
													?>
													<li><a href="<?php echo $_SESSION["url_mensaje"]."&pagina=".($pagina-1)?>"> <i class="fa fa-angle-double-left"></i> Anterior</a></li>
													<?php
												}else{
													?>
													<li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i> Anterior</a></li>
													<?php
												}
												
												// Numero de paginas a mostrar
												$num_paginas=ceil($total_registros/$registros);

												// Se asigna la cantidad total de paginas necesarias
												$total_paginas=$num_paginas;

												//limitando las paginas mostradas
												$pagina_intervalo=2;
											 
												// Calculamos desde que numero de pagina se mostrara
												$pagina_desde=$pagina-$pagina_intervalo;
												$pagina_hasta=$pagina+$pagina_intervalo;
											 
												// Verificar que pagina_desde sea negativo
												if($pagina_desde<1){
													// le sumamos la cantidad sobrante para mantener el numero de enlaces mostrados
													$pagina_hasta-=($pagina_desde-1);
													$pagina_desde=1;
												}
											 
												// Verificar que pagina_hasta no sea mayor que paginas_totales
												if($pagina_hasta>$total_paginas){
													$pagina_desde-=($pagina_hasta-$total_paginas);
													$pagina_hasta=$total_paginas;
													
													if($pagina_desde<1){
														$pagina_desde=1;
													}
												}
											 
												for ($i=$pagina_desde; $i<=$pagina_hasta; $i++){
													if ($pagina == $i){
														?>
														<li class="active"><a href="#"><?php echo $pagina; ?> <span class="sr-only">(activo)</span></a></li>
														<?php
													}else{
														?>
														<li><a href="<?php echo $_SESSION["url_mensaje"]."&pagina=".$i; ?>"><?php echo $i; ?></a></li>
														<?php
													} 
												}
											 
												if(($pagina + 1)<=$total_paginas) {
													?>
													<li><a href="<?php echo $_SESSION["url_mensaje"]."&pagina=".($pagina+1)?>">Siguiente <i class="fa fa-angle-double-right"></i></a></li>
													<?php
												}else{
													?>
													<li class="disabled"><a href="#">Siguiente <i class="fa fa-angle-double-right"></i></a></li>
													<?php
												}
											}
											?>
										</ul>
										<hr>
									</div>
									<!-- /Pagination -->
									
									
									<div class="col-md-12">
										<div class="row">
											<?php if($_SESSION["nivel_cuenta"] < 2){ ?>
											<button type="submit" class="btn btn-danger">Cerrar mensaje(s)</button>
											<?php } ?>
										</div>
									</div>
								</form>
							</div>
                            <!-- /CONTENT -->

							<?php
							require_once('sidebar.php');
							?>

                        </div>
                    </div>
                </section>
                <!-- /PAGE WITH SIDEBAR -->

            </div>
            <!-- /CONTENT AREA -->
			
            <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

        </div>
        <!-- /WRAPPER -->

        <!-- JS Global -->
		<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="assets/plugins/superfish/js/superfish.min.js"></script>
        <script src="assets/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
        <script src="assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
        <script src="assets/plugins/jquery.sticky.min.js"></script>
        <script src="assets/plugins/jquery.easing.min.js"></script>
        <script src="assets/plugins/jquery.smoothscroll.min.js"></script>
        <!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
        <script src="assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <!-- JS Page Level -->
        <script src="assets/js/theme-ajax-mail.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
        <script src="assets/js/theme.js"></script>
		<script src="assets/js/recurrent-code.js"></script>
		
		<script>
			$(document).ready(function(){
				$("#id_comuna").change(function(){
					$.post("../admin/php/selector_sector_buscador.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
				});
			})
			
			$(document).ready(function(){
				$("#id_region").change(function(){
					$.post("../admin/php/selector_comuna_buscador.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
				});
			})
		</script>

    </body>

<!-- Mirrored from event-theme.com/themes/reEstate/listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Apr 2016 04:42:27 GMT -->
</html>
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
	/*
	$xmlSource = "http://indicadoresdeldia.cl/webservice/indicadores.xml";
	$xml = simplexml_load_file($xmlSource);
	//echo $xml->santoral->ayer;
	//echo $xml->santoral->hoy;
	//echo $xml->santoral->maniana;
	//echo $xml->moneda->dolar;
	//echo $xml->moneda->euro;
	//echo $xml->moneda->dolar_clp; //Dolar interbancario
	//echo $xml->indicador->ivp;
	//echo $xml->indicador->uf;
	//echo $xml->indicador->ipc;
	//echo $xml->indicador->utm;
	//echo $xml->indicador->imacec;
	//echo $xml->bolsa->ipsa;
	//echo $xml->bolsa->igpa;
	//echo $xml->bolsa->banca;
	//echo $xml->bolsa->commodities;
	//echo $xml->bolsa->retail;
	//echo $xml->bolsa->consumo;
	//echo $xml->bolsa->utilities;
	
	/*
	$apiUrl = 'https://mindicador.cl/api';
	//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
	if ( ini_get('allow_url_fopen') ) {
		$json = file_get_contents($apiUrl);
	} else {
		//De otra forma utilizamos cURL
		$curl = curl_init($apiUrl);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$json = curl_exec($curl);
		curl_close($curl);
	}
	 
	$dailyIndicators = json_decode($json);
	
	//$valor_uf = round($dailyIndicators->uf->valor);
	$valor_uf = $xml->indicador->uf;
	$valor_uf = preparar_uf($valor_uf);
	*/
	$valor_uf = 28047;
	
	$sql_propiedad = "SELECT * FROM propiedades";
	$sql_propiedad .= " INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta";
	$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
	$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
	$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
	$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
	$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
	$sql_propiedad .= " INNER JOIN regiones ON propiedades.id_region=regiones.id_region";
	$sql_propiedad .= " INNER JOIN sectores ON propiedades.id_sector=sectores.id_sector";
	$sql_propiedad .= " INNER JOIN tipo_giros ON propiedades.id_tipo_giro=tipo_giros.id_tipo_giro";
	$sql_propiedad .= " WHERE is_hidden=0 AND cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_propiedad = $conexion -> query($sql_propiedad);
	$propiedad = $cursor_propiedad -> fetch();
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php
		require_once('shared-code.php');
		?>
		
		<style>
			
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
			
			<style>
				.owl-carousel .owl-item img{
					width: auto;
					max-height: 460px;
					display: block;
					margin: 0 auto;
				}
				
				.property-thumbnails img{
					max-width: 100%;
					height: 79px;
				}
				
				.property-big-card .property-thumbnails a{
					text-align: center;
				}
				
				.property-big-card .property-thumbnails{
					left: 50px;
				}
			</style>

            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs text-right">
                    <div class="container">
                        <div class="page-header">
                            <h1>Propiedad: <?php echo $propiedad["cod_propiedad"]; ?></h1>
                        </div>
                        <ul class="breadcrumb hidden-print">
                            <li><a href="home.php">Inicio</a></li>
                            <li><a href="<?php echo $_SESSION["url_buscador"]; ?>">Buscador</a></li>
                            <li class="active">Ficha propiedad</li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE WITH SIDEBAR -->
                <section class="page-section with-sidebar sub-page">
                    <div class="container">
                        <div class="row">
                            <!-- CONTENT -->
                            <div class="col-md-9 content" id="content">
								<?php
									if(isset($_SESSION["mensaje-sistema"])){
										echo $_SESSION["mensaje-sistema"];
										unset($_SESSION["mensaje-sistema"]);
									}
								?>
                                <div class="property-big-card alt hidden-print">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="owl-carousel img-carousel">
                                                <div class="item">
                                                    <a href="../propiedades/<?php echo $propiedad["img_01_propiedad"];?>" data-gal="prettyPhoto">
														<img class="img-responsive" src="../propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/>
														<!--
														<?php
														if($propiedad["is_promesado"] == 1){
															?>
															<img src="images/img-reservado.png" style="position: absolute; width: 100%; top: 0;">
															<?php
														}elseif($propiedad["is_exclusivo"] == 1){
															?>
															<img src="images/img-exclusivo.png" style="position: absolute; width: 100%; top: 0;">
															<?php
														}elseif($propiedad["is_oportunidad"] == 1){
															?>
															<img src="images/img-oportunidad.png" style="position: absolute; width: 100%; top: 0;">
															<?php
														}else{
															if($propiedad["flag_estado"] == 1){
																if($propiedad["id_tipo_operacion"] == 1 || $propiedad["id_tipo_operacion"] == 3){
																?>
																<img src="images/img-arrendado.png" style="position: absolute; width: 100%; top: 0;">
																<?php
																}else if($propiedad["id_tipo_operacion"] == 2){
																?>
																<img src="images/img-vendido.png" style="position: absolute; width: 100%; top: 0;">
																<?php
																}
															}
														}
														?>
														-->
													</a>
                                                </div>
                                                <div class="item">
                                                    <a href="../propiedades/<?php echo $propiedad["img_02_propiedad"];?>" data-gal="prettyPhoto"><img class="img-responsive" src="../propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt=""/></a>
                                                </div>
                                                <div class="item">
                                                    <a href="../propiedades/<?php echo $propiedad["img_03_propiedad"];?>" data-gal="prettyPhoto"><img class="img-responsive" src="../propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt=""/></a>
                                                </div>
                                                <div class="item">
                                                    <a href="../propiedades/<?php echo $propiedad["img_04_propiedad"];?>" data-gal="prettyPhoto"><img class="img-responsive" src="../propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt=""/></a>
                                                </div>
                                            </div>
                                            <div class="row property-thumbnails">
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0, 300]);"><img src="../propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [1, 300]);"><img src="../propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [2, 300]);"><img src="../propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [3, 300]);"><img src="../propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt=""/></a></div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
								<div class="visible-print-block">
									<div class="col-xs-2 col-sm-2 col-md-3"><img src="../propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/></div>
                                    <div class="col-xs-2 col-sm-2 col-md-3"><img src="../propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt=""/></div>
                                    <div class="col-xs-2 col-sm-2 col-md-3"><img src="../propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt=""/></div>
                                    <div class="col-xs-2 col-sm-2 col-md-3"><img src="../propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt=""/></div>
								</div>
                                <hr class="page-divider half transparent hidden-print"/>
								<a style="color: black;" class="btn btn-warning hidden-print" href="#" onclick="javascript: window.print()"><i class="fa fa-print"></i> Imprimir ficha</a>
								<a style="color: black;" class="btn btn-warning hidden-print" target="_BLANK" href="http://www.facebook.com/sharer.php?u=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-facebook"></i> Compartir</a>
								<a style="color: black;" class="btn btn-warning hidden-print" target="_BLANK" href="http://twitter.com/home?status=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-twitter"></i> Compartir</a>
								<a style="color: black;" class="btn btn-warning hidden-print" target="_BLANK" href="https://plus.google.com/share?url=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-google-plus"></i> Compartir</a>
								<a style="color: black;" class="btn btn-warning hidden-print" target="_BLANK" href="../cargar-pdf-propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>"><i class="fa fa-file-pdf-o"></i> Descargar PDF</a>
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal" style="margin-right: 10px; background-color: #000; border-color: #000;">Ver notas relacionadas</button>
								<hr class="page-divider half transparent hidden-print"/>
								<form id="form-enviar-ficha" class="form-inline" method="post" action="../admin/php/enviar_ficha_propiedad_correo.php">
									<input type="hidden" name="cod_propiedad" value="<?php echo $propiedad["cod_propiedad"];?>"></input>
									<button type="submit" style="color: black;" class="btn btn-warning hidden-print"><i class="fa fa-envelope-o"></i> Enviar ficha correo</button>
									<div class="form-group">
										<input type="email" class="form-control" style="border: 1px solid black; height: 34px;" id="correo_contacto" name="correo_contacto" placeholder="ejemplo@sitio.cl">
									</div>
								</form>
								<hr class="page-divider half transparent"/>
                                <h3 class="block-title alt"><i class="fa fa-angle-down"></i>Informaci&oacute;n: <?php echo $propiedad["nombre_tipo_propiedad"]; ?> - <?php echo $propiedad["nombre_comuna"]; ?> - <?php echo $propiedad["nombre_tipo_operacion"]; ?> - Visitas sitio: <?php echo $propiedad["cantidad_visitas_propiedad"]; ?></h3>
								<div class="widget shadow widget-details-reservation">
                                    <h4 class="widget-title">Agente asociado: <?php echo $propiedad["nombre_persona"]; ?> - Fecha captaci&oacute;n: <?php echo invertirFecha($propiedad["fecha_captacion_propiedad"]); ?></h4>
                                    <div class="widget-content property-big-card">
                                        <div class="property-details">
                                            <div class="list">
                                                <ul>                                                   
                                                    <li>Superficie Const: <?php echo $propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];?></li>
                                                    <li>Superficie Total: <?php echo $propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];?></li>
                                                    <li>Dormitorio(s): <?php echo $propiedad["dormitorios_propiedad"]; ?></li>
                                                    <li>Ba&ntilde;os: <?php echo $propiedad["banos_propiedad"]; ?></li>
                                                    <li>Estacionamientos: <?php echo $propiedad["nro_estacionamiento"]; ?></li>
													<li>Bodegas: <?php echo $propiedad["nro_bodega"]; ?></li>
                                                    <li>Destino: <?php echo $propiedad["nombre_tipo_giro"];?></li>
                                                </ul>
                                            </div>
                                            
                                                <strong>
												<?php
													if($propiedad["id_tipo_valor"] == 1){
														$precio_ajustado = round($propiedad["valor_propiedad"] / $valor_uf);
														echo "$".mostrarPrecio($propiedad["valor_propiedad"])." - (".number_format($precio_ajustado,0,",",".")." UF)";
													}else{
														$precio_ajustado = round($propiedad["valor_propiedad"] * $valor_uf);
														echo number_format($propiedad["valor_propiedad"],2,",",".")." UF - ($".number_format($precio_ajustado,0,",",".").")";
													}
												?>
												</strong>
                                          
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo utf8_decode($propiedad["detalle_propiedad"]); ?></p>

                            </div>
                            <!-- /CONTENT -->

                            <!-- SIDEBAR -->
                            <?php
							require_once('sidebar.php');
							?>
                            <!-- /SIDEBAR -->

                        </div>
                    </div>
                </section>
                <!-- /PAGE WITH SIDEBAR -->
				
            </div>
            <!-- /CONTENT AREA -->
			
            <div id="to-top" class="to-top hidden-print"><i class="fa fa-angle-up"></i></div>
			<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Notas relacionadas</h4>
			  </div>
			  <div class="modal-body">
				<?php
				$sql_mensaje = "SELECT * FROM mensajes ";
				$sql_mensaje .= "WHERE codigo_propiedad_cliente=".$propiedad["cod_propiedad"];
				
				$cursor_mensaje = $conexion -> query($sql_mensaje);
				if(!$validar = $cursor_mensaje -> rowCount()){
					$validar = 0;
					$is_filtered = 0;
				}
				if($validar > 0){
				$mensaje = $cursor_mensaje->fetch();
				?>
				<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
					<div class="caption col-md-12">
						<p><?php echo substr(strtolower($mensaje["detalle_mensaje"]), 0, 100)."...";?></p>
					</div>
					<div class="caption col-md-12">
						<table class="table">
							<tr>
								<?php
								if($mensaje["id_tipo_propiedad"] > 0){
								$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades WHERE id_tipo_propiedad=".$mensaje["id_tipo_propiedad"];
								$cursor_tipo_propiedad = $conexion->query($sql_tipo_propiedad);
								$tipo_propiedad = $cursor_tipo_propiedad->fetch();
								?>
								<td><i class="fa fa-expand"></i> Tipo propiedad: <?php echo $tipo_propiedad["nombre_tipo_propiedad"]?></td>
								<?php
								}else{
								?>
								<td><i class="fa fa-expand"></i> Tipo propiedad: N/A</td>
								<?php
								}
								?>
								
								<?php
								if($mensaje["id_tipo_operacion"] > 0){
								$sql_tipo_operacion = "SELECT * FROM tipo_operaciones WHERE id_tipo_operacion=".$mensaje["id_tipo_operacion"];
								$cursor_tipo_operacion = $conexion->query($sql_tipo_operacion);
								$tipo_operacion = $cursor_tipo_operacion->fetch();
								?>
								<td><i class="fa fa-expand"></i> Tipo operacion: <?php echo $tipo_operacion["nombre_tipo_operacion"]?></td>
								<?php
								}else{
								?>
								<td><i class="fa fa-expand"></i> Tipo operacion: N/A</td>
								<?php
								}
								?>
								
								<?php
								if($mensaje["id_region"] > 0){
								$sql_region = "SELECT * FROM regiones WHERE id_region=".$mensaje["id_region"];
								$cursor_region = $conexion->query($sql_region);
								$region = $cursor_region->fetch();
								?>
								<td><i class="fa fa-expand"></i> Region: <?php echo utf8_encode($region["nombre_region"]);?></td>
								<?php
								}else{
								?>
								<td><i class="fa fa-expand"></i> Region: N/A</td>
								<?php
								}
								?>
								
								<?php
								if($mensaje["id_comuna"] > 0){
								$sql_comuna = "SELECT * FROM comunas WHERE id_comuna=".$mensaje["id_comuna"];
								$cursor_comuna = $conexion->query($sql_comuna);
								$comuna = $cursor_comuna->fetch();
								?>
								<td><i class="fa fa-expand"></i> Comuna: <?php echo utf8_encode($comuna["nombre_comuna"]);?></td>
								<?php
								}else{
								?>
								<td><i class="fa fa-expand"></i> Comuna: N/A</td>
								<?php
								}
								?>
								
								<?php
								if($mensaje["id_sector"] > 0){
								$sql_sector = "SELECT * FROM sectores WHERE id_sector=".$mensaje["id_sector"];
								$cursor_sector = $conexion->query($sql_sector);
								$sector = $cursor_sector->fetch();
								?>
								<td><i class="fa fa-expand"></i> Sector: <?php echo utf8_encode($sector["nombre_sector"]);?></td>
								<?php
								}else{
								?>
								<td><i class="fa fa-expand"></i> Sector: N/A</td>
								<?php
								}
								?>

								<td class="buttons"><a class="btn btn-info" target="_blank" href="ficha-mensaje.php?id_mensaje=<?php echo $mensaje["id_mensaje"];?>" style="color: white; font-weight: bold;">Enlace nota <?php echo $mensaje["id_mensaje"];?></a></td>
							</tr>
						</table>
					</div>
				</div>
				<?php
				}
				?>
				
				<?php
				$sql_mensaje = "SELECT * FROM mensajes";
				$sql_mensaje .= " WHERE id_sector=".$propiedad["id_sector"];
				$sql_mensaje .= " ORDER BY id_mensaje DESC LIMIT 30";
				
				$cursor_mensaje = $conexion->query($sql_mensaje);
				if(!$validar=$cursor_mensaje->rowCount()){
					$validar=0;
				}
				if($validar > 1){
				while($mensaje = $cursor_mensaje -> fetch()){
					?>
					<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
						<div class="caption col-md-12">
							<p><?php echo substr(strtolower($mensaje["detalle_mensaje"]), 0, 100)."...";?></p>
						</div>
						<div class="caption col-md-12">
							<table class="table">
								<tr>
									<?php
									if($mensaje["id_tipo_propiedad"] > 0){
									$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades WHERE id_tipo_propiedad=".$mensaje["id_tipo_propiedad"];
									$cursor_tipo_propiedad = $conexion->query($sql_tipo_propiedad);
									$tipo_propiedad = $cursor_tipo_propiedad->fetch();
									?>
									<td><i class="fa fa-expand"></i> Tipo propiedad: <?php echo $tipo_propiedad["nombre_tipo_propiedad"]?></td>
									<?php
									}else{
									?>
									<td><i class="fa fa-expand"></i> Tipo propiedad: N/A</td>
									<?php
									}
									?>
									
									<?php
									if($mensaje["id_tipo_operacion"] > 0){
									$sql_tipo_operacion = "SELECT * FROM tipo_operaciones WHERE id_tipo_operacion=".$mensaje["id_tipo_operacion"];
									$cursor_tipo_operacion = $conexion->query($sql_tipo_operacion);
									$tipo_operacion = $cursor_tipo_operacion->fetch();
									?>
									<td><i class="fa fa-expand"></i> Tipo operacion: <?php echo $tipo_operacion["nombre_tipo_operacion"]?></td>
									<?php
									}else{
									?>
									<td><i class="fa fa-expand"></i> Tipo operacion: N/A</td>
									<?php
									}
									?>
									
									<?php
									if($mensaje["id_region"] > 0){
									$sql_region = "SELECT * FROM regiones WHERE id_region=".$mensaje["id_region"];
									$cursor_region = $conexion->query($sql_region);
									$region = $cursor_region->fetch();
									?>
									<td><i class="fa fa-expand"></i> Region: <?php echo utf8_encode($region["nombre_region"]);?></td>
									<?php
									}else{
									?>
									<td><i class="fa fa-expand"></i> Region: N/A</td>
									<?php
									}
									?>
									
									<?php
									if($mensaje["id_comuna"] > 0){
									$sql_comuna = "SELECT * FROM comunas WHERE id_comuna=".$mensaje["id_comuna"];
									$cursor_comuna = $conexion->query($sql_comuna);
									$comuna = $cursor_comuna->fetch();
									?>
									<td><i class="fa fa-expand"></i> Comuna: <?php echo utf8_encode($comuna["nombre_comuna"]);?></td>
									<?php
									}else{
									?>
									<td><i class="fa fa-expand"></i> Comuna: N/A</td>
									<?php
									}
									?>
									
									<?php
									if($mensaje["id_sector"] > 0){
									$sql_sector = "SELECT * FROM sectores WHERE id_sector=".$mensaje["id_sector"];
									$cursor_sector = $conexion->query($sql_sector);
									$sector = $cursor_sector->fetch();
									?>
									<td><i class="fa fa-expand"></i> Sector: <?php echo utf8_encode($sector["nombre_sector"]);?></td>
									<?php
									}else{
									?>
									<td><i class="fa fa-expand"></i> Sector: N/A</td>
									<?php
									}
									?>

									<td class="buttons"><a class="btn btn-info" target="_blank" href="ficha-mensaje.php?id_mensaje=<?php echo $mensaje["id_mensaje"];?>" style="color: white; font-weight: bold;">Enlace nota <?php echo $mensaje["id_mensaje"];?></a></td>
								</tr>
							</table>
						</div>
					</div>
					<?php
					}
				}
				?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>

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
        <script src="assets/js/theme.js"></script>
		<script src="assets/js/recurrent-code.js"></script>
		
		<script>
			
			$("#form-enviar-ficha").submit(function(){	
				var validar = true;
				var mensaje_error = "";
				
				if($("#correo_contacto").val() == ""){
					validar = false;
					mensaje_error += "Favor ingresar el correo del cliente.\n";
				}
				
				if(validar == false){
					alert(mensaje_error);
					event.preventDefault();
				}
			});
		</script>

    </body>
</html>
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
	
	$apiUrl = 'http://www.mindicador.cl/api';
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
	
	$valor_uf = round($dailyIndicators->uf->valor);
	//$valor_uf = 46183;
	
	$sql_propiedad = "SELECT * FROM ";
	$sql_propiedad .= "(SELECT *, CASE propiedades.id_tipo_valor";
	if($_GET["id_tipo_valor"] == 1){
		$sql_propiedad .= " WHEN 1 THEN valor_propiedad";
		$sql_propiedad .= " WHEN 2 THEN valor_propiedad*".$valor_uf;
		$sql_propiedad .= " ELSE valor_propiedad*1";
		$sql_propiedad .= " END AS valor_propiedad_ajustado FROM propiedades) AS propiedades";
	}else{
		$sql_propiedad .= " WHEN 1 THEN valor_propiedad/".$valor_uf;
		$sql_propiedad .= " WHEN 2 THEN valor_propiedad";
		$sql_propiedad .= " ELSE valor_propiedad*1";
		$sql_propiedad .= " END AS valor_propiedad_ajustado FROM propiedades) AS propiedades";
	}
	$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
	$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
	$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
	$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
	$sql_propiedad .= " WHERE propiedades.is_hidden = 0";
	
	if(isset($_GET["cod_propiedad"]) && !empty($_GET["cod_propiedad"])){
		$sql_propiedad .= " AND propiedades.cod_propiedad = ".$_GET["cod_propiedad"];
	}
	
	if(isset($_GET["id_tipo_operacion"]) && !empty($_GET["id_tipo_operacion"])){
		$sql_propiedad .= " AND propiedades.id_tipo_operacion = ".$_GET["id_tipo_operacion"];
	}
	
	if(isset($_GET["id_tipo_propiedad"]) && !empty($_GET["id_tipo_propiedad"])){
		$sql_propiedad .= " AND propiedades.id_tipo_propiedad = ".$_GET["id_tipo_propiedad"];
	}
	
	if(isset($_GET["direccion_propiedad"]) && !empty($_GET["direccion_propiedad"])){
		$array = explode(" ", $_GET["direccion_propiedad"]);
		$sql_propiedad .= " AND (";
		$is_second = 0;
		foreach ($array as $valor) {
			if(!empty(trim($valor))){
				if($is_second == 1){
					$sql_propiedad .= " OR ";
				}
				$sql_propiedad .= "propiedades.direccion_propiedad LIKE '%".$valor."%'";
				$is_second = 1;
			}
		}
		$sql_propiedad .= ")";
	}
	
	if(isset($_GET["lugar_propiedad"]) && !empty($_GET["lugar_propiedad"])){
		$lugar_propiedad = $_GET["lugar_propiedad"][0];
		$id_lugar_propiedad = substr($_GET["lugar_propiedad"], 1);
		
		switch ($lugar_propiedad) {
			case 'r':
				$sql_propiedad .= " AND propiedades.id_region = ".$id_lugar_propiedad;
				break;
			case 'c':
				$sql_propiedad .= " AND propiedades.id_comuna = ".$id_lugar_propiedad;
				break;
			case 's':
				$sql_propiedad .= " AND propiedades.id_sector = ".$id_lugar_propiedad;
				break;
		}
	}
	
	if(isset($_GET["id_tipo_giro"]) && !empty($_GET["id_tipo_giro"])){
		$sql_propiedad .= " AND id_tipo_giro=".$_GET["id_tipo_giro"];
	}
	
	if(isset($_GET["valor_desde"]) && !empty($_GET["valor_desde"])){
		$_GET["valor_desde"] = str_replace(",", "", substr($_GET["valor_desde"], 1));
		$_GET["valor_hasta"] = str_replace(",", "", substr($_GET["valor_hasta"], 1));
		if(isset($_GET["valor_desde"]) && is_numeric($_GET["valor_desde"]) && isset($_GET["valor_hasta"]) && is_numeric($_GET["valor_hasta"])){
			$valor_desde = $_GET["valor_desde"];
			$valor_hasta = $_GET["valor_hasta"];
			$sql_propiedad .= " AND valor_propiedad_ajustado BETWEEN ".$valor_desde." AND ".$valor_hasta = $_GET["valor_hasta"];
		}elseif(isset($_GET["valor_desde"]) && is_numeric($_GET["valor_desde"]) && !isset($_GET["valor_hasta"]) || !is_numeric($_GET["valor_hasta"])){
			$valor_desde = $_GET["valor_desde"];
			$sql_propiedad .= " AND valor_propiedad_ajustado > ".$valor_desde;
		}elseif(!isset($_GET["valor_desde"]) || !is_numeric($_GET["valor_desde"]) && isset($_GET["valor_hasta"]) && is_numeric($_GET["valor_hasta"])){
			$valor_hasta = $_GET["valor_hasta"];
			$sql_propiedad .= " AND valor_propiedad_ajustado < ".$valor_hasta;
		}
	}
	
	$sql_propiedad .= " ORDER BY propiedades.fecha_captacion_propiedad DESC";
	
	// Numero de registros por pagina
	$registros='6';

	// Tomamos el valor de GET de la pagina
	if(isset($_GET["pagina"])){$pagina = $_GET["pagina"];}
	// Comprobamos si pagina tiene valor numerico
	if (!isset($pagina)) {
	$inicio = 0;
	$pagina = 1;
	$_SESSION["url_buscador"] = basename($_SERVER["REQUEST_URI"]);
	}
	else {
	$inicio = ($pagina - 1) * $registros;
	}
	
	$entradas = $conexion->query($sql_propiedad);
	if(!$total_registros = $entradas -> rowCount()){
		$total_registros = 0;
	}
	
	$sql_propiedad .= " LIMIT ".$inicio.",".$registros;
	$entradas = $conexion -> query($sql_propiedad);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
		require_once('shared-code.php');
		?>
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
                            <h1>Buscador de propiedades</h1>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="home.php">Inicio</a></li>
                            <li class="active">Buscador</li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE WITH SIDEBAR -->
                <section class="page-section with-sidebar sub-page">
                    <div class="container">
						<div class="row">
                            <!-- CONTENT -->
                            <div class="col-md-9 content property-listing" id="content">
								<?php
								if($total_registros != 0){
									while($propiedad = $entradas->fetch()){
									?>
									<!-- Car Listing -->
									<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
										<div class="media col-md-3">
											<a class="media-link" data-gal="prettyPhoto" href="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>">
                                                <img src="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/>
												<?php
												if($propiedad["is_promesado"] == 1){
													?>
													<img src="../images/img-reservado.png" style="position: absolute; width: 100%; top: 0;">
													<?php
												}elseif($propiedad["is_exclusivo"] == 1){
													?>
													<img src="../images/img-exclusivo.png" style="position: absolute; width: 100%; top: 0;">
													<?php
												}elseif($propiedad["is_oportunidad"] == 1){
													?>
													<img src="../images/img-oportunidad.png" style="position: absolute; width: 100%; top: 0;">
													<?php
												}else{
													if($propiedad["flag_estado"] == 1){
														if($propiedad["id_tipo_operacion"] == 1 || $propiedad["id_tipo_operacion"] == 3){
														?>
														<img src="../images/img-arrendado.png" style="position: absolute; width: 100%; top: 0;">
														<?php
														}else if($propiedad["id_tipo_operacion"] == 2){
														?>
														<img src="../images/img-vendido.png" style="position: absolute; width: 100%; top: 0;">
														<?php
														}
													}
												}
												?>
                                                <span class="icon-view"><strong><i class="fa fa-arrows-alt"></i></strong></span></a>
											</a>
										</div>
										<div class="caption col-md-9">
											<div class="rating">
												<a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> Ver detalles </a>
											</div>
											<h4 class="caption-title"><a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>">Propiedad: <?php echo $propiedad["cod_propiedad"];?></a></h4>
											<h5 class="caption-title-sub">
											<?php
												if($_GET["id_tipo_valor"] == 1){
													echo "$".mostrarPrecio($propiedad["valor_propiedad_ajustado"]);
												}else{
													echo round($propiedad["valor_propiedad_ajustado"])." UF";
												}
												
											?>
											</h5>
											
											<table class="table">
												<tr>
													<td><i class="fa fa-expand"></i> 
														<?php
														if($propiedad["cantidad_superficie_total_propiedad"] > 0){
															echo $propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
														}else{
															echo $propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
														}
														?> 
													</td>
													<td><i class="fa fa-bed"></i> <?php echo $propiedad["dormitorios_propiedad"];?> Pieza(s)</td>
													<td><i class="fa fa-tint"></i> <?php echo $propiedad["banos_propiedad"];?> Ba&ntilde;o(s)</td>

													<td class="buttons"><a class="btn btn-theme" href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"><?php echo $propiedad["nombre_tipo_operacion"];?></a></td>
												</tr>
											</table>
										</div>
									</div>
									<!-- /Car Listing -->
									<?php
									}
								}
								?>
								
                                <!-- Pagination -->
								<div class="pagination-wrapper">
									<ul class="pagination">
										<?php
										if($total_registros>$registros){
											if(($pagina - 1) > 0) {
												?>
												<li><a href="<?php echo $_SESSION["url_buscador"]."?pagina=".($pagina-1)?>"> <i class="fa fa-angle-double-left"></i> Anterior</a></li>
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
													<li><a href="<?php echo $_SESSION["url_buscador"]."&pagina=".$i; ?>"><?php echo $i; ?></a></li>
													<?php
												} 
											}
										 
											if(($pagina + 1)<=$total_paginas) {
												?>
												<li><a href="<?php echo $_SESSION["url_buscador"]."&pagina=".($pagina+1)?>">Siguiente <i class="fa fa-angle-double-right"></i></a></li>
												<?php
											}else{
												?>
												<li class="disabled"><a href="#">Siguiente <i class="fa fa-angle-double-right"></i></a></li>
												<?php
											}
										}
										?>
									</ul>

								</div>
                                <!-- /Pagination -->

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
<?php

	session_start();
	require_once("../admin/php/rutinas.php");
	$is_plural = 0;

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
	// $valor_uf = 28047;

	$sql_propiedad = "SELECT *, propiedades.cod_propiedad as codigo_propiedad FROM ";
	$sql_propiedad .= "(SELECT *, CASE propiedades.id_tipo_valor";
	if($_GET["id_tipo_valor"] = 1){
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
	$sql_propiedad .= " INNER JOIN regiones ON propiedades.id_region=regiones.id_region";
	$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
	$sql_propiedad .= " INNER JOIN sectores ON propiedades.id_sector=sectores.id_sector";
	$sql_propiedad .= " LEFT JOIN codigos_grupos_propiedades ON propiedades.cod_propiedad = codigos_grupos_propiedades.cod_propiedad";
	$sql_propiedad .= " WHERE";

	if(isset($_GET["query"])){
		$query = $_GET["query"];
		$array = explode(" ", $query);
		$is_first = 0;
		$is_plural += 1;

		foreach ($array as $query) {
			if($is_first == 0){
				$sql_propiedad .= " comunas.nombre_comuna LIKE '%".$query."%'";
			}else{
				$sql_propiedad .= " OR comunas.nombre_comuna LIKE '%".$query."%'";
			}
			$sql_propiedad .= " OR sectores.nombre_sector LIKE '%".$query."%'";
			$sql_propiedad .= " OR propiedades.direccion_propiedad LIKE '%".$query."%'";
			$sql_propiedad .= " OR tipo_propiedades.nombre_tipo_propiedad LIKE '%".$query."%'";
			$sql_propiedad .= " OR tipo_operaciones.nombre_tipo_operacion LIKE '%".$query."%'";
			//$sql_propiedad .= " OR propiedades.detalle_propiedad LIKE '%".$query."%'";

			$is_first += 1;
		}

	}else{
		if(isset($_GET["id_tipo_propiedad"]) && is_numeric($_GET["id_tipo_propiedad"])){
			$id_tipo_propiedad = $_GET["id_tipo_propiedad"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}
			$sql_propiedad .= " propiedades.id_tipo_propiedad=".$id_tipo_propiedad;
		}

		if(isset($_GET["id_tipo_operacion"]) && is_numeric($_GET["id_tipo_operacion"])){
			$id_tipo_operacion = $_GET["id_tipo_operacion"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}

			if($id_tipo_operacion == 1){
				$sql_propiedad .= " (propiedades.id_tipo_operacion=1 OR propiedades.id_tipo_operacion=3)";
			}elseif($id_tipo_operacion == 2){
				$sql_propiedad .= " (propiedades.id_tipo_operacion=2 OR propiedades.id_tipo_operacion=4)";
			}else{
				$sql_propiedad .= " propiedades.id_tipo_operacion=".$id_tipo_operacion;
			}
		}

		if(isset($_GET["id_region"]) && is_numeric($_GET["id_region"])){
			$id_region = $_GET["id_region"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}
			$sql_propiedad .= " propiedades.id_region=".$id_region;
		}

		if(isset($_GET["id_comuna"]) && is_numeric($_GET["id_comuna"])){
			$id_comuna = $_GET["id_comuna"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}
			$sql_propiedad .= " propiedades.id_comuna=".$id_comuna;
		}

		if(isset($_GET["id_sector"]) && is_numeric($_GET["id_sector"])){
			$id_sector = $_GET["id_sector"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}
			$sql_propiedad .= " propiedades.id_sector=".$id_sector;
		}

		if(isset($_GET["valor_desde"]) && !empty($_GET["valor_desde"])){
			$_GET["valor_desde"] = str_replace(",", "", substr($_GET["valor_desde"], 1));
			$_GET["valor_hasta"] = str_replace(",", "", substr($_GET["valor_hasta"], 1));
			if(isset($_GET["valor_desde"]) && is_numeric($_GET["valor_desde"]) && isset($_GET["valor_hasta"]) && is_numeric($_GET["valor_hasta"])){
				$valor_desde = $_GET["valor_desde"];
				$valor_hasta = $_GET["valor_hasta"];
				$sql_propiedad .= " AND valor_propiedad_ajustado BETWEEN ".$valor_desde." AND ".$valor_hasta;
			}elseif(isset($_GET["valor_desde"]) && is_numeric($_GET["valor_desde"]) && !isset($_GET["valor_hasta"]) || !is_numeric($_GET["valor_hasta"])){
				$valor_desde = $_GET["valor_desde"];
				$sql_propiedad .= " AND valor_propiedad_ajustado > ".$valor_desde;
			}elseif(!isset($_GET["valor_desde"]) || !is_numeric($_GET["valor_desde"]) && isset($_GET["valor_hasta"]) && is_numeric($_GET["valor_hasta"])){
				$valor_hasta = $_GET["valor_hasta"];
				$sql_propiedad .= " AND valor_propiedad_ajustado < ".$valor_hasta;
			}
		}

		if(isset($_GET["cod_propiedad"]) && is_numeric($_GET["cod_propiedad"])){
			$cod_propiedad = $_GET["cod_propiedad"];
			$is_plural += 1;
			if($is_plural > 1){
				$sql_propiedad .= " AND";
			}
			$sql_propiedad .= " propiedades.cod_propiedad = '".$cod_propiedad."'";
		}

		if(isset($_GET["id_tipo_valor"]) && is_numeric($_GET["id_tipo_valor"])){
			$id_tipo_valor = $_GET["id_tipo_valor"];
		}else{
			$id_tipo_valor = 1;
		}
	}

	$is_plural += 1;
	if($is_plural > 1){
		$sql_propiedad .= " AND";
	}
	$sql_propiedad .= " propiedades.cod_propiedad NOT IN (SELECT cod_propiedad FROM codigos_grupos_propiedades)";

	$is_plural += 1;
	if($is_plural > 1){
		$sql_propiedad .= " AND";
	}
	$sql_propiedad .= " propiedades.is_hidden = 0 ";
	//$sql_propiedad .= "AND id_tipo_giro = 2 ";
	$sql_propiedad .= "AND img_01_propiedad <> 'imagen-referencial.png' ";
	$sql_propiedad .= "ORDER BY propiedades.fecha_captacion_propiedad DESC";

	// Numero de registros por pagina
	$registros='12';

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
		require_once('head-code.php');
	?>
	<style>
		nav.navbar{
			background: #252B2B;
		}
		.navbar{
			border-radius: 0;
		}
		section.top_sec{
			background: #252B2B;
			border-top: 0px;
		}

		.color-white{
			color: #fff;
		}
			.color-white:hover{
				color: #fff;
			}
		.inf_txt{

		}
		.top_rgt,.top_lft{
			border-bottom: 1px solid #343a3a;
		}
		.soc_ico{

		}
			.soc_ico .uf-dato{
				border-left: 1px solid #343a3a;
			}
			.soc_ico ul li{
				border-left: 1px solid #343a3a;
				margin-right: 0px;
			}
				.soc_ico ul li p{
					font-size: 14px !important;
				}
				.soc_ico ul li i{
					font-size: 22px !important;
					margin: 0 10px;
				}
		h3.subm_btn{
			background: #E40000;
		}
			h3.subm_btn a:hover{
				color: #FFCC00;
			}
		ul.nav.navbar-nav.navbar-right{
			background: initial;
			position: relative;
			bottom: -80px;
		}
			.navbar-nav > li > a{
				color: #aaaaaa;
			}
				.navbar-nav > li > a:hover{
					color: #cecece;
					border-bottom: 4px solid #E40000;
				}
		#slider.flexslider{
			border: 0px;
			height: 440px;
		}
			#slider.flexslider .slides img{
				position: relative;
				bottom: 200px;
			}
		#feat_videos{
			background: #252B2B;
			padding: 50px 0;
		}
			#feat_videos .titl_sec{
				background: initial;
				box-shadow: none;
			}
			.titl_sec h3.main_titl{
				border-bottom: 2px solid #000;
			}
			#videos.flexslider{
				background: initial;
				border: 0;
			}
				#videos.flexslider .slides img{
					padding: 5px;
				}

				#videos .flex-control-paging li a{
					background: #fff;
				}
					#videos .flex-control-paging li a.flex-active{
						background: #E40000;
					}
		section#srch_slide{
			margin-top: 0;
			position: initial;
			z-index: initial;
		}

		.srch_frm button.btn.btn-primary{
			border-radius: 0;
			height: 42px;
			font-size: 13px;
			font-weight: bold;
			padding: 0 20px;
			background: #E40000 !important;
			border: 0;
			text-transform: uppercase;
			margin-top: 5px;
		}

		.titulo-propiedad{
			background: #000;
			color: white;
			padding: 10px;
			text-align: center;
		}
		.pt-30{
			padding-top: 30px;
		}

		.img-propiedad{
			max-width: 270px;
			max-height: 320px;
		}

		.cuerpo-grupo{
			padding-top: 20px;
			padding-bottom: 20px;
		}

		.hidden{
			display: none;
		}

		.caja-overflow{
			height: 300px;
    		overflow: auto;
		}
	</style>

</head>

<body>
    <?php require_once('header.php'); ?>

    <!-- Header Stat Banner -->
    <header id="banner" class="stat_bann">
        <img style="width: 100%" src="images/header-buscador.jpg">
    </header>

    <div class="spacer-60"></div>

	<section id="srch_slide">

        <div class="container">

            <?php
			require_once('buscador.php');

			?>
        </div>

        <!-- /.container -->
    </section>

	<div class="spacer-60"></div>

    <!-- Featured Properties Section -->
    <section id="feat_propty">
        <div class="container">
            <div class="row">
				<?php
				if($total_registros != 0){
					$sql_grupo = "SELECT * FROM grupos_propiedades INNER JOIN codigos_grupos_propiedades ON grupos_propiedades.id_grupo_propiedad = codigos_grupos_propiedades.id_grupo_propiedad GROUP BY grupos_propiedades.id_grupo_propiedad";
	                $cursor_grupo = $conexion -> query($sql_grupo);
					if(!$validar = $cursor_grupo -> rowCount()){
						$validar = 0;
					}

					if($validar != 0){
					?>
					<div class="titl_sec">
	                    <div class="col-xs-12">
	                        <h3 class="main_titl text-left">
								Grupos de propiedades
							</h3>
	                    </div>
	                    <div class="clearfix"></div>
	                </div>
					<?php
					}

	                while($grupo = $cursor_grupo -> fetch()){
					?>
					<div class="col-md-4">
						<a href="ficha-grupo-propiedad.php?id_grupo_propiedad=<?php echo $grupo["id_grupo_propiedad"]; ?>"><img class="img-responsive img-hover" src="../grupo-propiedades/<?php echo $grupo["img_grupo_propiedad"]; ?>" alt=""></a>

					</div>
					<?php
					}

					if($validar != 0){
					?>
					<div class="spacer-30"></div>
					<?php
					}
					?>

					<div class="titl_sec">
	                    <div class="col-xs-12">
	                        <h3 class="main_titl text-left">
								Resultados buscador
							</h3>
	                    </div>
	                    <div class="clearfix"></div>
	                </div>

					<?php

					while($propiedad = $entradas->fetch()){
					?>
					<!-- Property 1 -->


					<div class="col-md-6 pt-30">
						<div class="srch_frm">
						<div class="row">
							<div class="col-md-6 text-center">
								<a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["codigo_propiedad"]; ?>"><img class="img-propiedad" class="img-responsive img-hover" src="../propiedades/<?php echo $propiedad["img_01_propiedad"]; ?>" alt=""></a>
							</div>
							<div class="col-md-6">
								<h5 class="titulo-propiedad">
										<?php echo $propiedad["nombre_tipo_propiedad"];?>
								 <?php
										if($_GET["id_tipo_valor"] == 1){
											echo "$".mostrarPrecio($propiedad["valor_propiedad_ajustado"]);
										}else{
											echo round($propiedad["valor_propiedad_ajustado"])." UF";
										}
									?>
								 <?php
										if($_GET["id_tipo_valor"] == 2){
											echo "$".mostrarPrecio($propiedad["valor_propiedad_ajustado"]);
										}else{
											echo " UF  ".round($propiedad["valor_propiedad_ajustado"] / $dailyIndicators->uf->valor) ;
										}
									?>
								</h5>

								<p style="text-align: justify;">
									<?php echo substr($propiedad["detalle_propiedad"], 0, 150)."...";?>
								</p>
								<a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["codigo_propiedad"]; ?>"  <button class="btn btn-success btn-lg" style="font-size: 13px;" style="color: #;">Ver Detalles</button> </a>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<a href="tel:+56996736137">
									<button class="btn btn-success btn-lg" style="font-size: 13px;" >
										¡Llamenos!
								</button>
								</a>
								<hr>

								<div class="inf_txt">




									<a href="https://api.whatsapp.com/send?phone=56996736137">
								<button class="btn btn-success btn-lg" style="font-size: 11px;" >
										<img src="images/social-buttons/whatsapp.png" style="width: 15px;">
									¡Whatsapp!
							</button>
							</a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a  class="color-black" href="mailto:info@mateosanchez.cl">
								<button type="button" class="btn btn-success btn-lg" style="font-size: 15px;" data-toggle="modal" data-target="#myModal" id="gastronomia" >
							<i class="fa fa-envelope-o"></i> Correo
							</button>
							</a>
							<!-- <div class="sharethis-inline-share-buttons"></div> -->

								<hr>

								<!-- <a  class="fb" title="Compartir en Facebook" id="facebook-share-button-linuxito.com" ><img src="images/social-buttons/facebook.png" style="width: 33px;"> Compartir en Facebook
								<script>
								var facebookShareButton = document.getElementById('facebook-share-button-linuxito.com');
								var facebookShareButtonHref='http://www.facebook.com/sharer/sharer.php?';
								facebookShareButtonHref += 'u='+document.URL;
								facebookShareButtonHref += '&title='+document.title;
								facebookShareButton.href = facebookShareButtonHref;
								</script>
							</a> -->
							</div>	</div>

								<!-- <div class="inf_txt">
								<p style="font-size: 12px;"><i class="fa fa-envelope-o"></i> <a class="color-black" href="mailto:info@mateosanchez.cl">info@mateosanchez.cl</a> <br> <a href="tel:+56996736137">Llamenos: +56 9 96736137 </a><a href="https://api.whatsapp.com/send?phone=56996736137">
												<img src="images/social-buttons/whatsapp.png" style="width: 33px;">
										</a> </p>

								</div>

								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
									¡Contáctenos!
							</button> -->
							</div>
						</div>
					</div>
					<?php
					}
				}else{
					?>
					<h2 class="text-center">No se han encontrado propiedades que cumplan con los parametros de busqueda usados, favor intentar con otros parametros. <a>
						<button class="btn btn-successs btn-lg" style="font-size: 15px;" data-toggle="modal" data-target="#modalForm">
							¡Contáctenos!
					</button></a>
						<a href="tel:+56996736137">
						<button class="btn btn-success btn-lg" style="font-size: 13px;" >
							¡Llamenos!
					</button>
					</a>
					</h2>
					<?php
				}
				?>



				<div class="spacer-30"></div>

				<!-- Pagination -->
				<div class="pagin text-right">
					<ul>
						<?php
						if($total_registros>$registros){
							if(($pagina - 1) > 0) {
								?>
								<li><a href="<?php echo $_SESSION["url_buscador"]."&pagina=".($pagina-1)?>"> <i class="fa fa-long-arrow-left"></i></a></li>
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
									<li><a class="active" href="#"><?php echo $pagina; ?></a></li>
									<?php
								}else{
									?>
									<li><a href="<?php echo $_SESSION["url_buscador"]."&pagina=".$i; ?>"><?php echo $i; ?></a></li>
									<?php
								}
							}

							if(($pagina + 1)<=$total_paginas) {
								?>
								<li><a href="<?php echo $_SESSION["url_buscador"]."&pagina=".($pagina+1)?>"> <i class="fa fa-long-arrow-right"></i></a></li>
								<?php
							}
						}
						?>
					</ul>
				</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <div class="spacer-60"></div>

    <!-- Footer -->
    <?php
	require_once('footer.php');
	?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Owl Carousel JavaScript -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Flexslider JavaScript -->
    <script src="js/jquery.flexslider-min.js"></script>


    <!-- Script to Activate the Carousels -->
    <script type="text/javascript">
		$(document).ready(function () {
			'use strict';

			$(window).load(function() {
			  $('#slide_grupos_propiedades').flexslider({
				animation: "slide",
				directionNav: false,
				animationLoop: true,
				slideshowSpeed: 8000,
				pauseOnHover: true,
			  });
			});
		});
    </script>

    <script>
        $('#buscador_propiedad').on('change', '#id_region', function(){
            $.ajax({
			    type: "POST",
			    url: "../admin/php/selector_comuna_buscador.php",
			    data: {id: $('#id_region').val()},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#id_comuna').html(html);
			    }
			});
        })

        $('#buscador_propiedad').on('change', '#id_comuna', function(){
            $.ajax({
			    type: "POST",
			    url: "../admin/php/selector_sector_buscador.php",
			    data: {id: $('#id_comuna').val()},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#id_sector').html(html);
			    }
			});
        });


				$('#buscador_propiedad2').on('change', '#id_region', function(){
            $.ajax({
			    type: "POST",
			    url: "../admin/php/selector_comuna_buscador.php",
			    data: {id: $('#id_region2').val()},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#id_comuna').html(html);
			    }
			});
        })





        $('#feat_propty').on('click', '.btn_toggle_propiedades', function(){
        	//$().removeClass("display", "block");
        	//$('#'+$(this).attr("id")).addClass('data_missing');
    		$('#grupo_'+$(this).attr("id")).toggleClass('hidden');
        	//alert('asdf');
        	event.preventDefault();
        });
    </script>

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e456b3594b979001209fa2e&product=inline-share-buttons&cms=website' async='async'></script>
</body>
</html>

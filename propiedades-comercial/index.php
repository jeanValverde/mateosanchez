<?php
	session_start();
	require_once('../admin/php/rutinas.php');
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
				/*border-left: 1px solid #343a3a;*/
				/*margin-right: 0px;*/
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
			bottom: -170px;
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

		.slide-info{
			top: 200px;
			bottom: initial;
		}

		.btn-success {
		color: #fff;
		background-color: rgba(244, 25, 5, 0.9);
		border-color: rgba(244, 25, 5, 0.9);
		}
		.btn-success:hover {
		color: #fff;
		background-color: rgba(244, 220, 5, 0.92);
		border-color: rgba(244, 220, 5, 0.92);
		}
		.btn-successs {
		color: #fff;
		background-color:  rgba(237, 215, 20, 0.84);
		border-color: rgba(237, 215, 20, 0.84);
		}
		.btn-successs:hover {
		color: #fff;
		background-color:  rgba(244, 25, 5, 0.9);
		border-color:  rgba(244, 25, 5, 0.9);
		}
		.flex-control-nav {
		    width: 100%;
		    position: absolute;
		    bottom: -32px;
		    text-align: center;
		}
	</style>

</head>

<body>

    <?php require_once('header.php'); ?>

    <!-- Header Stat Banner -->
    <header id="banner" class="stat_bann">
        <div id="slider" class="silde_img flexslider">
			<ul class="slides">
				<?php
				$sql_oportunidad = "SELECT * FROM propiedades";
					$sql_oportunidad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
					$sql_oportunidad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
				$sql_oportunidad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
				$sql_oportunidad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
				$sql_oportunidad .= " INNER JOIN cuentas ON propiedades.id_cuenta=cuentas.id_cuenta";
				$sql_oportunidad .= " WHERE is_oferta=1 AND id_franquicia=1 AND is_hidden=0 AND img_01_propiedad <> 'imagen-referencial.png' ORDER BY RAND()";
				$cursor_oportunidad = $conexion -> query($sql_oportunidad);

				while($oportunidad = $cursor_oportunidad -> fetch()){
				?>
				<!-- Slide 1 -->
				<li>
					<a href="ficha-propiedad.php?cod_propiedad=<?php echo $oportunidad["cod_propiedad"]; ?>">
						<img src="../propiedades/<?php echo $oportunidad["img_01_propiedad"]; ?>" alt="Slider image" />
						<div class="slide-info">

							<?php echo utf8_encode($oportunidad["nombre_tipo_propiedad"]); ?> &nbsp; &nbsp;
						<?php echo $oportunidad["simbologia_tipo_valor"].mostrarPrecio($oportunidad["valor_propiedad"]);?>
							<!-- <p class="sli_titl"><?php echo $oportunidad["cod_propiedad"];?> </p> -->
							<?php
							$monto_propiedad = $oportunidad["valor_propiedad"];
							if($oportunidad['id_tipo_valor'] == 2){
								$monto_propiedad = $oportunidad["valor_propiedad"] * $dailyIndicators->uf->valor;
							}
							?>
					&nbsp; &nbsp;	$<?php echo mostrarPrecio($monto_propiedad);?>

							<p class="sli_titl">
								<strong>Comuna:</strong> <?php echo utf8_encode ($oportunidad["nombre_comuna"]); ?>&nbsp;&nbsp;
								<?php
								if($oportunidad["cantidad_superficie_total_propiedad"] > 0){
									echo "Superficie: ".$oportunidad["cantidad_superficie_total_propiedad"]." ".$oportunidad["diminutivo_unidad_medida"];
								}else{
									echo "Superficie: ".$oportunidad["cantidad_superficie_construida_propiedad"]." ".$oportunidad["diminutivo_unidad_medida"];
								}
								?>
							</p>
							<p style="text-align: justify;" class="sli_desc"> <?php echo substr($oportunidad["detalle_propiedad"], 0, 80)."...";?> </p>
							<a href="ficha-propiedad.php?cod_propiedad=<?php echo $oportunidad["cod_propiedad"]; ?>">Ver Detalles</a>
						</div>
					</a>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
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
                <div class="titl_sec">
                    <div class="col-xs-12 text-center">
                        <h3 class="main_titl text-left">
							Propiedades Destacadas
						</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
				<!-- Place somewhere in the <body> of your page -->

				<div class="srch_frm">

				<div id="destacados" class="flexslider">
					<ul class="slides">
						<?php
						$sql_destacada = "SELECT * FROM propiedades";
							$sql_destacada .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
						$sql_destacada .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
						$sql_destacada .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
						$sql_destacada .= " INNER JOIN cuentas ON propiedades.id_cuenta=cuentas.id_cuenta";
						$sql_destacada .= " WHERE (id_tipo_giro=2 OR id_tipo_operacion=4) AND id_franquicia=1 AND is_hidden=0 AND img_01_propiedad <> 'imagen-referencial.png' ORDER BY RAND() LIMIT 8";
						$cursor_destacada = $conexion -> query($sql_destacada);

						while($destacada = $cursor_destacada -> fetch()){
						?>
						<li>
							<!-- Property 1 -->
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<a href="ficha-propiedad.php?cod_propiedad=<?php echo $destacada["cod_propiedad"]; ?>"><img class="img-responsive img-hover" src="../propiedades/<?php echo $destacada["img_01_propiedad"]; ?>" alt="" style="max-height: 200px;"></a>
									</div>
									<div class="col-md-6">
										<h5 class="titulo-propiedad">
											<?php echo utf8_encode($destacada["nombre_tipo_propiedad"]); ?>
											<?php echo $destacada["simbologia_tipo_valor"].mostrarPrecio($destacada["valor_propiedad"]);?>

										</h5>
										<?php echo $oportunidad["simbologia_tipo_valor"].mostrarPrecio($oportunidad["valor_propiedad"]);?>
											<!-- <p class="sli_titl"><?php echo $oportunidad["cod_propiedad"];?> </p> -->
											<?php
											$monto_propiedad = $destacada["valor_propiedad"];
											if($destacada['id_tipo_valor'] == 2){
												$monto_propiedad = $destacada["valor_propiedad"] * $dailyIndicators->uf->valor;
											}else{
												$monto_propiedad = $destacada["valor_propiedad"];
												if($destacada['id_tipo_valor'] == 2){
												$monto_propiedad = $destacada["valor_propiedad"] /$dailyIndicators->uf->valor;
											}}
											?>
									$<?php echo mostrarPrecio($monto_propiedad);?>

										<p style="text-align: justify;">
											<?php echo substr($destacada["detalle_propiedad"], 0, 87)."...";?>
										</p>
										<a href="ficha-propiedad.php?cod_propiedad=<?php echo $destacada["cod_propiedad"]; ?>" <button class="btn btn-success btn-lg" style="font-size: 13px;"  >Ver Detalles</button> </a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a  class="color-black" href="mailto:info@mateosanchez.cl">
											<button type="button" class="btn btn-success btn-lg" style="font-size: 15px;" data-toggle="modal" data-target="#myModal" id="gastronomia" >
										<i class="fa fa-envelope-o"></i> Correo
										</button>
										</a>
										<hr>
										<a href="tel:+56996736137">
											<button class="btn btn-success btn-lg" style="font-size: 14px;" >
												¡Llamenos!
										</button>
										</a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<button class="btn btn-success btn-lg" style="font-size: 13px;" >
										Whatsapp
								</button>
								<!-- <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
									¡Contáctenos!
							</button> -->
								</a>
									</div>
								</div>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
				</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <?php
    $sql_cuenta = "SELECT * FROM cuentas WHERE is_banned = 0 AND img_perfil_cuenta IS NOT NULL";
    $cursor_cuenta = $conexion->query($sql_cuenta);
    if(!$validar_cuenta = $cursor_cuenta->rowCount()){
    	$validar_cuenta = 0;
    }

    if($validar_cuenta > 0){
    ?>

    <div class="spacer-60"></div>

    <!-- Talented Agents Section -->
    <section id="talen_agent">
        <div class="container">
            <div class="row">
                <div class="titl_sec">
                    <div class="col-xs-12 text-center">
                        <h3 class="main_titl">
							Nuestro equipo
						</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="equipo" class="flexslider">
					<ul class="slides">
						<?php
						while($cuenta = $cursor_cuenta->fetch()){
						?>
						<li>
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-image">
										<img class="img-responsive img-hover" src="../agentes/<?php echo $cuenta["img_perfil_cuenta"]; ?>" alt="">
									</div>
									<div class="panel-body">
										<h3 class="sec_titl text-center">
											<a > <?php echo $cuenta["nombre_persona"]; ?> </a>
										</h3>

										<p class="sec_desc text-center">
											<?php echo $cuenta["titulo_perfil_cuenta"]; ?>
										</p>
										<div class="panel_hidd">
											<hr>
											<p class="phon text-center"> <a href="tel:<?php echo $cuenta["telefono_persona"]; ?>"> Contacto: <?php echo $cuenta["telefono_persona"]; ?> </a></p>

											<div class="text-center">
												<a href="mailto:<?php echo $cuenta["correo_cuenta"]; ?>"><?php echo $cuenta["correo_cuenta"]; ?></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?php
						}
						?>
					</ul>
				</div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

	<?php
	}
	?>

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

			$('#slider').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: true,
				slideshowSpeed: 8000,
				touch: false,
				pauseOnHover: false,
				pauseOnAction: true,
				after: function(slider) {
					/* auto-restart player if paused after action */
					if (!slider.playing) {
					  slider.play();
					}
				}
			});

			$('.flex-next').on('click',function () {
				$('.flexslider').flexslider("play");
			});
			$('.flex-prev').on('click',function () {
				$('.flexslider').flexslider("play");
			});
		});

		$(document).ready(function () {
			'use strict';

			$(window).load(function() {
			  $('#destacados').flexslider({
				animation: "slide",
				animationLoop: false,
				itemWidth: 600,
				itemMargin: 5,
				minItems: 2,
				maxItems: 4,
				directionNav: false
			  });
			});
		});

		$(document).ready(function () {
			'use strict';

			$(window).load(function() {
			  $('#videos').flexslider({
				animation: "slide",
				animationLoop: false,
				itemWidth: 210,
				minItems: 4,
				maxItems: 4,
				directionNav: false
			  });
			});
		});

		$(document).ready(function () {
			'use strict';

			$(window).load(function() {
			  $('#equipo').flexslider({
				animation: "slide",
				animationLoop: false,
				itemWidth: 210,
				minItems: 1,
				maxItems: 4,
				controlNav: false
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
        })
    </script>
</body>
</html>

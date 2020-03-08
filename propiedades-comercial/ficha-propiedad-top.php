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

	$sql = "UPDATE propiedades SET ";
	$sql .= "cantidad_visitas_propiedad = cantidad_visitas_propiedad+1 ";
	$sql .= "WHERE cod_propiedad = ".$_GET["cod_propiedad"];
	$modifica = $conexion->prepare($sql);
	$modifica->execute();

	$sql_propiedad = "SELECT * FROM propiedades";
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
	<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5e456b3594b979001209fa2e&product=custom-share-buttons&cms=website' async='async'></script>
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
		.datos-sobrepuesto{
			position: absolute;
		    top: 0px;
		    left: -415px;
		    z-index: 999;
		}
			.recuadro-dato{
				display: inline-block;
				margin: 0 10px;
				color: white;
				font-weight: bold;
				font-size: 16px;
				padding: 5px 10px;
			}
		.nav_proyectos{
			margin-left: 15px;
			margin-right: 15px;
		}
			.nav_proyectos a{
				color: black;
			}
		section#prop_detal .agen_desc p.sec_desc:after{
			margin: 9px 0;
		}

		.img-responsive{
			width: auto !important;
			height: 600px !important;
			margin: 0 auto !important;
		}

		.bx-prev{
			display:none;
		}

		.bx-next{
			display:none;
		}

		#slid_nav img{
			width: 130px;
		}

		.btn-successs {
color: #fff;
background-color:  rgba(230, 208, 23, 0.87);
border-color: rgba(230, 211, 46, 0.88);
}
.btn-successs:hover {
color: #fff;
background-color:  rgba(244, 25, 5, 0.9);
border-color:  rgba(244, 25, 5, 0.9);
}
.btn-group-lg>.btn, .btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 20px;
	}
	</style>

</head>

<body>
    <?php require_once('header.php'); ?>

    <!-- Header Stat Banner -->
    <!--
    <header id="banner" class="stat_bann">
        <img style="width: 100%" src="images/header-buscador.jpg">
    </header>
	-->
	<div class="srch_frm">
	<section id="srch_slide">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
					<h3><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]); ?>, <?php echo utf8_encode($propiedad["nombre_sector"]); ?></h3>
				</div>
                <div class="col-md-12">
					<span><strong>Tipo:</strong> <?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]); ?> | </span>
					<span><strong>Comuna:</strong> <?php echo utf8_encode($propiedad["nombre_comuna"]); ?> | </span>
					<span><strong>Sector:</strong> <?php echo utf8_encode($propiedad["nombre_sector"]); ?> | </span>
					<span><strong>Dormitorios:</strong> <?php echo utf8_encode($propiedad["dormitorios_propiedad"]); ?> | </span>
					<span><strong>Ba&ntilde;os:</strong> <?php echo utf8_encode($propiedad["banos_propiedad"]); ?> | </span>
					<!-- <span><strong>Fecha:</strong> <?php echo utf8_encode($propiedad["fecha_captacion_propiedad"]); ?> | </span> -->
					<span><strong>Mts. &Uacute;tiles:</strong> <?php echo utf8_encode($propiedad["cantidad_superficie_construida_propiedad"]); ?> mt&#178; (aprox.) |  </span>
					<span><strong>Mts. Totales:</strong> <?php echo utf8_encode($propiedad["cantidad_superficie_total_propiedad"]); ?> mt&#178; (aprox.) | </span>
					<span><strong>C&oacute;digo: </strong><?php echo utf8_encode($propiedad["cod_propiedad"]); ?></span>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
</div>
	<div class="spacer-60"></div>

    <div class="container">
        <div class="row">
            <!-- Proerty Details Section -->

            <section id="prop_detal" class="col-md-8">
                <div class="row">
                    <div class="panel panel-default">
                        <!-- Proerty Slider Images -->
                        <div class="container datos-sobrepuesto text-right">
							<p class="recuadro-dato" style="background: red;"> <?php echo utf8_encode($propiedad["nombre_tipo_operacion"]); ?></p>
							<p class="recuadro-dato" style="background: black; margin-right: 0;">
							<?php
								if($propiedad["id_tipo_valor"] == 1){
									echo "$".mostrarPrecio($propiedad["valor_propiedad"]);
								}else{
									echo round($propiedad["valor_propiedad"])."UF";
								}
								if($propiedad["id_tipo_valor"] == 1){
								echo  " UF:".mostrarPrecio($propiedad["valor_propiedad"]/$valor_uf);

							}
							?>
							</p>
						</div>
                        <div class="panel-image">
                            <ul id="prop_slid">
                                <li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt="Propiedad n1"></li>

                                <?php if(!empty($propiedad["img_02_propiedad"])){ ?>
                                <li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt="Propiedad n2"></li>
                            	<?php } ?>

                            	<?php if(!empty($propiedad["img_03_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt="Propiedad n3"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_04_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt="Propiedad n4"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_05_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_05_propiedad"];?>" alt="Propiedad n5"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_06_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_06_propiedad"];?>" alt="Propiedad n6"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_07_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_07_propiedad"];?>" alt="Propiedad n7"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_08_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_08_propiedad"];?>" alt="Propiedad n8"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_09_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_09_propiedad"];?>" alt="Propiedad n9"></li>
								<?php } ?>

								<?php if(!empty($propiedad["img_10_propiedad"])){ ?>
								<li><img style="width: 100%; height: 100%;" class="img-responsive" src="../propiedades/<?php echo $propiedad["img_10_propiedad"];?>" alt="Propiedad n10"></li>
								<?php } ?>
                            </ul>

                            <!-- Proerty Slider Thumbnails -->
                            <div class="col-md-12 rel_img">
                                <ul id="slid_nav">
                                    <?php $contador = 0; ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_01_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>

                                    <?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                    <?php if(!empty($propiedad["img_02_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_02_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                    <?php if(!empty($propiedad["img_03_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_03_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_04_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_04_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_05_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_05_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_06_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_06_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_07_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_07_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_08_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_08_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_09_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_09_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>

                                	<?php if($contador == 5){?>
                                	<li style="width: 100%;"><hr></li>
                                	<?php } ?>

                                	<?php if(!empty($propiedad["img_10_propiedad"])){ ?>
                                    <li>
                                        <a data-slide-index="<?php echo $contador; ?>" href="#"><img class="img-hover" src="../propiedades/<?php echo $propiedad["img_10_propiedad"]; ?>">
                                        </a>
                                    </li>
                                    <?php $contador += 1; ?>
                                	<?php } ?>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="spacer-30"></div>


            </section>


						<section id="sidebar" class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
												<div class="srch_frm" >
														<p style="text-align: justify;">
                        <?php echo $propiedad["detalle_propiedad"]; ?>
											</p>
                        <hr>
												<p>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<button class="btn btn-successs btn-lg" style="font-size: 15px;" data-toggle="modal" data-target="#modalForm">
														¡Contáctenos!
												</button></p>

												<div class="inf_txt">

													<a href="tel:+56996736137">
														<button class="btn btn-success btn-lg" style="font-size: 13px;" >
															¡Llamenos!
													</button>
													</a>

														<a  class="color-black" href="mailto:info@mateosanchez.cl">
															<button type="button" class="btn btn-success btn-lg" style="font-size: 14px;" data-toggle="modal" data-target="#myModal" id="gastronomia" >
														<i class="fa fa-envelope-o"style="font-size: 14px;"></i> Correo
														</button>
														</a>


													<a href="https://api.whatsapp.com/send?phone=56996736137">
												<button class="btn btn-success btn-lg" style="font-size: 12px;" >
														<img src="images/social-buttons/whatsapp.png" style="width: 15px;">
													¡Whatsapp!
											</button></a>


                        <hr>
												<div class="sharethis-inline-share-buttons"></div>

											<!-- <a  class="fb" title="Compartir en Facebook" id="facebook-share-button-linuxito.com" >
												<img src="images/social-buttons/facebook.png" style="width: 33px;"> Compartir en Facebook </a>

												<script>
												var facebookShareButton = document.getElementById('Mateo Sanchez Propiedades');
												var facebookShareButtonHref='http://www.facebook.com/sharer/sharer.php?';
												facebookShareButtonHref += 'u='+document.URL;
												facebookShareButtonHref += '&title='+document.title;
												facebookShareButton.href = facebookShareButtonHref;
												</script> -->

											</div>
</div>
  									<hr>
										<div class="titl_sec">
						                    <div class="col-xs-15">
						                        <h3 class="main_titl text-left">


						<?php
						$sql_contrato = "SELECT * FROM documentos_propiedades WHERE cod_propiedad=".$propiedad["cod_propiedad"];
						$cursor_contrato = $conexion -> query($sql_contrato);
						while($contrato = $cursor_contrato -> fetch()){
						?>
						<h4>Equipamiento</h4><hr>
						<p>
							<?php $is_empty = 1; ?>
							<strong>Distribuci&oacute;n</strong><br>

							<?php
							if($contrato["flag_living_comedor_propiedad"] == 1){
							$is_empty = 0;
							?>
							Living y comedor juntos<br>
							<?php } ?>

							<?php
							if($contrato["flag_living_propiedad"] == 1){
							$is_empty = 0;
							?>
							Living<br>
							<?php } ?>

							<?php
							if($contrato["flag_comedor_propiedad"] == 1){
							$is_empty = 0;
							?>
							Comedor<br>
							<?php } ?>

							<?php
							if($contrato["flag_cocina_propiedad"] == 1){
							$is_empty = 0;
							?>
							Cocina<br>
							<?php } ?>

							<?php
							if($contrato["flag_comedor_diario_propiedad"] == 1){
							$is_empty = 0;
							?>
							Comedor diario<br>
							<?php } ?>

							<?php
							if($contrato["flag_bano_servicio_propiedad"] == 1){
							$is_empty = 0;
							?>
							Ba&ntilde;o de visitas<br>
							<?php } ?>

							<?php
							if($is_empty == 1){
							?>
							Sin referencias<br>
							<?php
							}else{
							$is_empty = 1;
							}
							?>

						<hr>	<strong>Servicios</strong><br>

							<?php
							if($contrato["flag_sector_logia_propiedad"] == 1){
							$is_empty = 0;
							?>
							Loggia<br>
							<?php } ?>

							<?php
							if($contrato["flag_chimenea_propiedad"] == 1){
							$is_empty = 0;
							?>
							Loggia<br>
							<?php } ?>

							<?php
							if($contrato["flag_lavadero_propiedad"] == 1){
							$is_empty = 0;
							?>
							Loggia<br>
							<?php } ?>

							<?php
							if($is_empty == 1){
							?>
							Sin referencias<br>
							<?php
							}else{
							$is_empty = 1;
							}
							?>

							<hr><strong>Privados</strong><br>

							<?php
							if($contrato["flag_principal_suite_propiedad"] == 1){
							$is_empty = 0;
							?>
							Suite Principal<br>
							<?php } ?>

							<?php
							if($contrato["flag_dormitorio_servicio_propiedad"] == 1){
							$is_empty = 0;
							?>
							Dormitorio Servicio<br>
							<?php } ?>

							<?php
							if($contrato["flag_walking_closet_propiedad"] == 1){
							$is_empty = 0;
							?>
							Walking Closet<br>
							<?php } ?>

							<?php
							if($contrato["flag_clasic_propiedad"] == 1){
							$is_empty = 0;
							?>
							Habitaci&oacute;n Classic<br>
							<?php } ?>

							<?php
							if($is_empty == 1){
							?>
							Sin referencias<br>
							<?php
							}else{
							$is_empty = 1;
							}
							?>

							<hr><strong>Otros</strong><br>

							<?php
							if($contrato["flag_bano_completo_propiedad"] == 1){
							$is_empty = 0;
							?>
							Ba&ntilde;o Completo<br>
							<?php } ?>

							<?php
							if($contrato["flag_bano_servicio_propiedad"] == 1){
							$is_empty = 0;
							?>
							Ba&ntilde;o Servicio<br>
							<?php } ?>

							<?php
							if($contrato["flag_medio_bano_propiedad"] == 1){
							$is_empty = 0;
							?>
							Medio Ba&ntilde;o<br>
							<?php } ?>

							<?php
							if($contrato["flag_antejardin_propiedad"] == 1){
							$is_empty = 0;
							?>
							Antejardin<br>
							<?php } ?>

							<?php
							if($contrato["flag_patio_trasero_propiedad"] == 1){
							$is_empty = 0;
							?>
							Patio Trasero<br>
							<?php } ?>

							<?php
							if($contrato["flag_quincho_propiedad"] == 1){
							$is_empty = 0;
							?>
							Quincho<br>
							<?php } ?>

							<?php
							if($contrato["flag_sala_internet_propiedad"] == 1){
							$is_empty = 0;
							?>
							Sala de Internet<br>
							<?php } ?>

							<?php
							if($contrato["flag_juegos_infantiles_propiedad"] == 1){
							$is_empty = 0;
							?>
							Juegos Infantiles<br>
							<?php } ?>

							<?php
							if($contrato["flag_piscina_temperada_propiedad"] == 1){
							$is_empty = 0;
							?>
							Piscina Temperada<br>
							<?php } ?>

							<?php
							if($contrato["flag_piscina_propiedad"] == 1){
							$is_empty = 0;
							?>
							Piscina<br>
							<?php } ?>

							<?php
							if($contrato["flag_lavanderia_propiedad"] == 1){
							$is_empty = 0;
							?>
							Lavanderia<br>
							<?php } ?>

							<?php
							if($contrato["flag_sala_multiuso_propiedad"] == 1){
							$is_empty = 0;
							?>
							Sala Multiuso<br>
							<?php } ?>

							<?php
							if($contrato["flag_conserjeria_propiedad"] == 1){
							$is_empty = 0;
							?>
							Conserjeria<br>
							<?php } ?>

							<?php
							if($contrato["flag_gimnasio_propiedad"] == 1){
							$is_empty = 0;
							?>
							Gimnasio<br>
							<?php } ?>

							<?php
							if($contrato["flag_recepcion_propiedad"] == 1){
							$is_empty = 0;
							?>
							Recepci&oacute;n<br>
							<?php } ?>

							<?php
							if($is_empty == 1){
							?>
							Sin referencias<br>
							<?php
							}else{
							$is_empty = 1;
							}
							?>
						</p>
						<?php
						}
						?>
					</h3>
									</div>
									<div class="clearfix"></div>
							</div>
                    </div>
                </div>

            </section>


            <div class="spacer-60"></div>

        </div>
    </div>

    <div class="spacer-60"></div>

    <!-- Footer -->
    <?php
	require_once('footer.php');
	?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- BX Slider -->
    <script src="js/jquery.bxslider.min.js"></script>

	<!-- Script to Activate the Carousel -->
    <script>
        /* Product Slider Codes */
        $(document).ready(function () {
            'use strict';

            $('#prop_slid').bxSlider({
                pagerCustom: '#slid_nav',
				auto: true
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

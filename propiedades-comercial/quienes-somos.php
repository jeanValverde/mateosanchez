<?php
	session_start();
	require_once("../admin/php/rutinas.php");
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

		.slide-info{
			top: 245px;
			bottom: initial;
		}
	</style>
		<style>
			.agen_info .col-md-4{
				padding-right: 15px!important;
			}
		</style>
	</head>

	<body>

		<?php
			require_once('header.php');
		?>

		<!-- Header bradcrumb -->
		<header class="bread_crumb hidden-print">
			<div class="pg_links">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<p class="lnk_pag"><a href="index.php">Inicio</a> </p>
							<p class="lnk_pag"> / </p>
							<p class="lnk_pag">Quienes Somos</p>
						</div>
						<div class="col-md-6 text-right">
							<p class="lnk_pag"><a href="index.php">Ir a inicio</a> </p>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="spacer-60"></div>

		<div class="container">
			<div class="row">
				<!-- About Section -->
				<section id="abt_sec" class="col-md-8">
					<!-- Progressbars -->
					<div class="row skill_sec">
						<div class="titl_sec">
							<div class="col-lg-12"><h3 class="main_titl text-left">	Misi&oacute;n</h3></div>
							<div class="clearfix"></div>
						</div>
						<div class="col-xs-12 skill_ara">
							<div class="col-sm-12 p0">
								<p class="m0"> Buscamos brindar nuestra mejor atención ofreciendo precio y calidad a todos nuestros clientes, contando con una amplia cartera de propiedades comerciales, como también negocios pequeños y otros a gran escala. </p>
							</div>
						</div>
					</div>
					<!-- /.row -->

					<div class="spacer-30"></div>

					<!-- Progressbars -->
					<div class="row skill_sec">
						<div class="titl_sec">
							<div class="col-lg-12"><h3 class="main_titl text-left">	Visi&oacute;n</h3></div>
							<div class="clearfix"></div>
						</div>
						<div class="col-xs-12 skill_ara">
							<div class="col-sm-12 p0">
								<p class="m0"> Mateo Sánchez Propiedades Comerciales, busca mantener la relación precio/calidad entregando la mezcla exacta que nuestros clientes necesitan. </p>
							</div>
						</div>
					</div>
					<!-- /.row -->

					<div class="spacer-30"></div>

					<!-- Progressbars -->
					<div class="row skill_sec">
						<div class="titl_sec">
							<div class="col-lg-12"><h3 class="main_titl text-left">	Sobre nosotros</h3></div>
							<div class="clearfix"></div>
						</div>
						<div class="col-xs-12 skill_ara">
							<div class="col-sm-12 p0">
								<p class="m0"> Nuestra empresa se fundó en el año 1991, la que se ha mantenido en el tiempo gracias a nuestros fieles clientes e inversionistas que nos prefieren cada día.</p>
								<div class="spacer-30"></div>
								<p class="m0"> Nuestro equipo cuenta con el profesionalismo y excelencia adquirida con más de 25 años en el mercado inmobiliario. Nuestro interés es sumergirnos en nuevos desafíos contando con profesionales, tales como; ejecutivo comercial, departamento de administración y finanzas, departamento de publicidad, arquitectura, área legal y área contable. Garantizando un servicio óptimo de acuerdo a sus necesidades. Asimismo, ofrecemos precios accesibles y propiedades comerciales ubicadas en buenos sectores dentro y fuera de la 5ta. Región. Tanto es así, que actualmente nos hemos expandido gestionando proyectos inmobiliarios con empresas de primera categoría reconocidas a nivel nacional e internacional construyendo alianzas para futuros negocios.</p>
							</div>
						</div>

						<div class="spacer-10"></div>

						<img style="width: 100%;" src="images/banner-quienes-somos.png">

						<div class="spacer-10"></div>

						<div class="col-xs-12 skill_ara">
							<div class="col-sm-12 p0">
								<p class="m0"> Nuestra oficina se encuentra ubicada en Bellavista N° 5, edificio Olimpo del Mar, oficina 204, Reñaca, Viña Del Mar. </p>
								<p class="m0"> Aunque tambi&eacute;n puede contactarnos a trav&eacute;s de los siguientes medios: </p>

								<div style="margin: 10px;" class="agen_info2 panel_bottom">
									<div class="agen_feat">
										<p class="area">
											<a href="tel:+56 9-96736137"> <img style="width: 24px;" src="images/img-whatsapp.png"> +56 9-96736137 </a>
										</p>
										<p class="bedrom">
											<a href="mailto:info@mateosanchez.cl"> <i style="font-size: 18px;" class="fa fa-envelope"></i>info@mateosanchez.cl</a>
										</p>
										<p class="bedrom">
											<a href="http://mateosanchez.cl/"> <img style="width: 24px;" src="images/ico-logo.png"> www.mateosanchez.cl</a>
										</p>
									</div>
									<div class="agen_feat">
										<p class="bedrom">
											<a href="https://www.facebook.com/profile.php?id=100009799125591&ref=ts&fref=ts"> <img style="width: 24px;" src="images/img-facebook-small.png"> Mateo S&aacute;nchez Propiedades Vi&ntilde;a</a>
										</p>
									</div>
								</div>
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3347.285943586079!2d-71.54434968525324!3d-32.96985698039265!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9689de7575468567%3A0x659e087dbdf2b978!2sMateo%20sanchez%20propiedades!5e0!3m2!1ses-419!2scl!4v1581523356343!5m2!1ses-419!2scl" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
							</div>
						</div>
					</div>
					<!-- /.row -->

					<?php
				    $sql_cuenta = "SELECT * FROM cuentas WHERE is_banned = 0 AND img_perfil_cuenta IS NOT NULL";
				    $cursor_cuenta = $conexion->query($sql_cuenta);
				    if(!$validar_cuenta = $cursor_cuenta->rowCount()){
				    	$validar_cuenta = 0;
				    }

				    if($validar_cuenta > 0){
				    ?>

					<div class="row">
						<div class="titl_sec">
							<div class="col-lg-12"><h3 class="main_titl text-left">	Nuestro equipo</h3></div>
							<div class="clearfix"></div>
						</div>

						<?php while($cuenta = $cursor_cuenta->fetch()){ ?>

						<div class="agen_info">
							<div class="col-md-4">
								<?php if(!empty($cuenta["img_perfil_cuenta"])){?>
								<a href="#"><img class="img-responsive img-hover" src="../agentes/<?php echo $cuenta["img_perfil_cuenta"]; ?>" alt=""></a>
								<?php }else{ ?>
									<a href="#"><img class="img-responsive img-hover" src="../agentes/perfil-0ded8ee2bad2baec.jpg" alt=""></a>
								<?php } ?>
							</div>
							<div class="col-md-8">
								<div class="panel panel-default">

									<div class="panel-body">
										<div class="row agen_desc">
											<div class="col-md-12">
												<h3 class="sec_titl"><a href="#"> <?php echo $cuenta["nombre_persona"]; ?> </a></h3>
												<p class="sec_desc">
													<?php echo $cuenta["titulo_perfil_cuenta"]; ?>
												</p>
											</div>
										</div>
										<p class="sec_desc">
											<?php echo $cuenta["descripcion_perfil_cuenta"]; ?>
										</p>
										<div class="panel_bottom">
											<div class="agen_feat">
												<p class="area">
													<a href="tel:<?php echo $cuenta["telefono_persona"]; ?>"> <img style="width: 24px;" src="images/img-telefono.png"> <?php echo $cuenta["telefono_persona"]; ?> </a>
												</p>
												<p class="bedrom">
													<a href="mailto:<?php echo $cuenta["correo_cuenta"]; ?>"> <img style="width: 24px;" src="images/img-correo.png"> <?php echo $cuenta["correo_cuenta"]; ?></a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="spacer-30"></div>

						<?php if($cuenta = $cursor_cuenta->fetch()){ ?>
						<div class="agen_info">
							<div class="col-md-8">
								<div class="panel panel-default">

									<div class="panel-body">
										<div class="row agen_desc">
											<div class="col-md-12">
												<h3 class="sec_titl"><a href="#"> <?php echo $cuenta["nombre_persona"]; ?> </a></h3>
												<p class="sec_desc">
													<?php echo $cuenta["titulo_perfil_cuenta"]; ?>
												</p>
											</div>
										</div>
										<p class="sec_desc">
											<?php echo $cuenta["descripcion_perfil_cuenta"]; ?>
										</p>
										<div class="panel_bottom">
											<div class="agen_feat">
												<p class="area">
													<a href="tel:<?php echo $cuenta["telefono_persona"]; ?>"> <img style="width: 24px;" src="images/img-telefono.png"> <?php echo $cuenta["telefono_persona"]; ?> </a>
												</p>
												<p class="bedrom">
													<a href="mailto:<?php echo $cuenta["correo_cuenta"]; ?>"> <img style="width: 24px;" src="images/img-correo.png"> <?php echo $cuenta["correo_cuenta"]; ?></a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<a href="#"><img class="img-responsive img-hover" src="../agentes/<?php echo $cuenta["img_perfil_cuenta"]; ?>" alt=""></a>
							</div>
						</div>

						<div class="spacer-30"></div>
						<?php } ?>
						<?php
						}
						?>
					</div>

					<?php
					}
					?>

					<div class="spacer-60"></div>

				</section>

				<!-- Sidebar Section -->
				<?php
					require_once("sidebar.php");
				?>

				<div class="spacer-30"></div>

			</div>
		</div>

		<!-- Footer -->
		<?php
			require_once('footer.php');
		?>

		<!-- jQuery -->
		<script src="js/jquery.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- Counter JavaScript -->
		<script src="js/waypoints.min.js"></script>
		<script src="js/jquery.counterup.min.js"></script>

		<script>
			function number_format (number, decimals, dec_point, thousands_sep) {
				// Strip all characters but numerical ones.
				number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
				var n = !isFinite(+number) ? 0 : +number,
					prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
					sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
					dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
					s = '',
					toFixedFix = function (n, prec) {
						var k = Math.pow(10, prec);
						return '' + Math.round(n * k) / k;
					};
				// Fix for IE parseFloat(0.55).toFixed(0) = 0;
				s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
				if (s[0].length > 3) {
					s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
				}
				if ((s[1] || '').length < prec) {
					s[1] = s[1] || '';
					s[1] += new Array(prec - s[1].length + 1).join('0');
				}
				return s.join(dec);
			}

			$(document).ready(function(){
				$(".format_precio").keyup(function() {
					$(this).val("$"+number_format($(this).val()));
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

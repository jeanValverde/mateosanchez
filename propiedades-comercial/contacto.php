<?php
	session_start();
	require_once('../admin/php/rutinas.php');
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
		
		.agen_info .col-md-4, .agen_info .col-md-8{
			padding: auto;
		}
	</style>

</head>

<body>
    <?php require_once('header.php'); ?>

    <!-- Header bradcrumb -->
    <header class="bread_crumb">
        
        <div class="pg_links">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lnk_pag"><a href="index.php"> Principal </a> </p>
                        <p class="lnk_pag"> / </p>
                        <p class="lnk_pag"> Servicios </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lnk_pag"><a href="index.php"> Volver </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </header>
	
	<div class="spacer-60"></div>
	
	

    <div class="container">
		<div class="row">
			<!-- Contact Section -->
			<section id="contact_sec" class="col-md-8">
				<!-- Contact form -->
				<div class="row">
					<div class="titl_sec">
						<div class="col-lg-12">
							<h3 class="main_titl text-left">Formulario de contacto</h3>

						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-12">
						<div class="cont_frm">
							<form name="sentMessage" id="contactForm" action="../admin/php/enviar_correo.php" method="POST">
								<div class="control-group form-group col-md-6 first">
									<div class="controls">
										<input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" placeholder="Nombres">
										<div class="in_ico">
											<i class="fa fa-user"></i>
										</div>
										<p class="help-block"></p>
									</div>
									
									<div class="controls">
										<input type="text" class="form-control" id="apellido_contacto" name="apellido_contacto" placeholder="Apellidos">
										<div class="in_ico">
											<i class="fa fa-user"></i>
										</div>
										<p class="help-block"></p>
									</div>

									<div class="controls">
										<input type="email" class="form-control" id="correo_contacto" name="correo_contacto" placeholder="Correo electrónico">
										<div class="in_ico">
											<i class="fa fa-envelope-o"></i>
										</div>
										<p class="help-block"></p>
									</div>

									<div class="controls">
										<input type="number" class="form-control" id="telefono_contacto" name="telefono_contacto" placeholder="Teléfono de contacto">
										<div class="in_ico">
											<i class="fa fa-phone"></i>
										</div>
										<p class="help-block"></p>
									</div>

									<div class="clearfix"></div>
								</div>

								<div class="control-group form-group col-md-6">
									<div class="controls">
										<textarea rows="10" cols="100" class="form-control" id="mensaje_contacto" name="mensaje_contacto" maxlength="999" style="resize:none" placeholder="Mensaje"></textarea>
										<div class="in_ico">
											<i class="fa fa-paper-plane-o"></i>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Enviar mensaje</button>
								</div>
								<div class="clearfix"></div>
								<div id="success"></div>
								<!-- For success/fail messages -->
							</form>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</section>

			<!-- Sidebar Section -->
			<section id="sidebar" class="col-md-4">
				<!-- Contact Information -->
				<div class="row">
					<div class="titl_sec">
						<div class="col-lg-12">
							<h3 class="main_titl text-left">www.mateosanchez.cl</h3>
						</div>
						<div class="clearfix"></div>
					</div>

					<div class="cont_info">
						<div class="info_sec first">
							<div class="icon_box">
								<img style="width: 24px;" src="images/img-correo.png">
							</div>
							<p class="infos"><a href="mailto:info@mateosanchez.cl"> info@mateosanchez.cl </a>
							</p>
						</div>

						<div class="info_sec">
							<div class="icon_box" id="whatsapp">
								<img src="images/img-whatsapp.png">
							</div>
							<p class="infos"> <a href="tel:+56996736137"> +56 (9) 9673 6137 </a> </p>
						</div>

						<div class="info_sec">
							<div class="icon_box" id="facebook">
								<img src="images/img-facebook-small.png">
							</div>
							<p class="infos"><a href="https://www.facebook.com/profile.php?id=100009799125591&amp;fref=ts">Facebook - Mateo Sanchez Propiedades</a></p>
						</div>

					</div>
				</div>
				<!-- /.row -->
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

    <!-- Owl Carousel JavaScript -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Flexslider JavaScript -->
    <script src="js/jquery.flexslider-min.js"></script>

    
</body>
</html>
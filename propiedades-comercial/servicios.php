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
	
	<section id="srch_slide">

        <div class="container">

            <?php
			require_once('buscador.php');
			?>
        </div>
        <!-- /.container -->
    </section>

    <div class="spacer-60"></div>
    
	<div class="container">
        <div class="row">
			<!-- About Section -->
            <section id="abt_sec" class="col-md-12">
                <!-- Progressbars -->
                <div class="row skill_sec">
                    <div class="titl_sec">
                        <div class="col-lg-12">
                            <h3 class="main_titl text-left">
								Bienvenidos al Área de servicios de Mateo Sanchez Propiedades Comerciales.
							</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-xs-12 skill_ara">
                        <div class="col-sm-12 p0">
                            <p class="m0"> En Mateo Sanchez Propiedades Comerciales sabemos que cada empresa tiene requerimientos y necesidades distintas. Nuestro modelo integral podrá acceder a todos los servicios necesarios en una sola gestión optimizando y ahorrando tiempo y dinero. </p>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </section>
			
			<div class="spacer-30"></div>
			
			<!-- Agent Section -->
            <section id="agent_sec" class="col-md-12">
                <!-- Servicio 1 -->
                <div class="row" id="servicios_adicionales">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_5.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Servicios Adicionales</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									En Mateo Sanchez Propiedades sabemos que cada empresa tiene requerimientos y necesidades distintas. Nuestro modelo integral podr&aacute; acceder a todos los servicios necesarios en una sola gesti&oacute;n optimizando y ahorrando tiempo y dinero
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 2 -->
                <div class="row">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_1.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Arquitectura</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Dise&ntilde;o arquitect&oacute;nico / anteproyectos<br>
									Proyectos de arquitectura<br>
									C&aacute;lculos de estructura<br>
									Proyectos especializados (sanitario, el&eacute;ctrico,...)<br>
									Construcciones y remodelaciones: Materializamos su proyecto comercial, brindando un servicio &oacute;ptimo y de calidad. Contamos con la capacidad t&eacute;cnica y profesional que ud necesita. <br>
									Tasaciones de Inmuebles: Contamos con la experiencia y la capacidad técnica en tasaciones comerciales, lo que nos certifica en las siguientes áreas:
									<ul>
										<li>Terrenos Comerciales, Industriales, Habitacionales y Agrícolas.</li>
										<li>Propiedades Habitacionales.</li>
										<li>Propiedades Comerciales.</li>
										<li>Industria y Comercio</li>
									</ul>
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 3 -->
                <div class="row">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_8.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Asesor&iacute;a Legal y estudios de t&iacute;tulos</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Nuestros abogados brindaran asistencia legal durante toda la operación inmobiliaria en forma oportuna y veraz.
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 4 -->
                <div class="row">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_4.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Servicios de Publicidad inmobiliaria</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Nuestro servicio publicitario se enfoca en desarrollar letreros personalizados para su propiedad que permita al público tener una idea clara y precisa de lo que se esta promocionando.
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 5 -->
                <div class="row">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_2.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Servicio de limpieza y mantenci&oacute;n</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Este servicio engloba todas las labores de limpieza necesarias para la conservaci&oacute;n y mantenci&oacute;n de instalaciones comerciales, industriales o a fines
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 6 -->
                <div class="row" id="negocios_vende">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_3.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Negocios Vende</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Sabemos que usted necesita vender o arrendar su negocio, esto nos ha llevado a dar la solución que necesita, por tal motivo, hemos creado NEGOCIOS VENDE, donde transferimos o arrendamos el derecho de llaves evitando grandes demoras y engorrosos trámites en instituciones del estado.
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 7 -->
                <div class="row" id="constructora_ar">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_10.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Inmobiliaria y Constructora  AR</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									En AR Constructora e inmobiliaria desarrollamos proyectos propios y los de terceros que han confiado en nuestra capacidad técnica y experiencia inmobiliaria.
								</p>
								<p class="sec_desc">
									Próximamente Proyecto Urban View: Actualmente está en desarrollo un proyecto de departamentos estudio con una placa comercial de 10 Locales con fecha de entrega para el año 2021.
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 8 -->
                <div class="row" id="administraciones_comerciales">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_9.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Administraciones comerciales</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Nuestro equipo contable puede administrar su propiedad comercial, garantizando la tranquilidad y el profesionalismo que usted necesita.
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
				
				<!-- Servicio 8 -->
                <div class="row" id="arriendo_espacio_no_utilizado">
					<div class="col-md-4">
						<a href="#"><img class="img-responsive img-hover" src="../images/servicios/servicio_7.jpg" alt="">
						</a>
					</div>
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row agen_desc">
									<div class="col-md-8">
										<h3 class="sec_titl"><a href="#"> Arriendo espacios no utilizados</a>
									</div>
									<div class="col-md-4"></div>
								</div>
								<p class="sec_desc">
									Arrendamos tus metros cuadrados que se encuentran desocupados. Maximizando as&iacute;, el valor de sus inmuebles de forma eficiente y sencilla
								</p>
							</div>
						</div>
					</div>
                </div>

                <div class="spacer-30"></div>
                
            </section>
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
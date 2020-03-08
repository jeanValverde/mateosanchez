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
		.pt-30{
			padding-top: 30px;
		}
		
		.img-propiedad{
			max-width: 270px;
			max-height: 185px;
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
                <div class="titl_sec">
                    <div class="col-xs-12">
                        <h3 class="main_titl text-left">
							Resultados buscador
						</h3>
                    </div>
                    <div class="clearfix"></div>
                </div>

				<?php
				if(isset($_GET["id_grupo_propiedad"]) && !empty($_GET["id_grupo_propiedad"])){
					$sql_grupo = "SELECT * FROM grupos_propiedades WHERE id_grupo_propiedad = ".$_GET["id_grupo_propiedad"];
	                $cursor_grupo = $conexion -> query($sql_grupo);
	                if(!$validar_grupo = $cursor_grupo -> rowCount()){
	                	$validar_grupo = 0;
	                }

	                if($validar_grupo != 0){
		                $grupo = $cursor_grupo -> fetch();
						?>
						<div class="col-md-12">
							<div class="panel panel-default" style="padding: 20px;">
								<div class="panel-body">
									<div class="col-md-12 titulo-propiedad">
										<h5 class=" pull-left"> <?php echo utf8_encode($grupo["titulo_grupo_propiedad"]); ?> </h5>

										<h5 class=" pull-right"> Lista de propiedades </h5>
									</div>

									<div class="spacer-20"></div>

									<div class="col-md-4">
										<a href="#"><img class="img-responsive img-hover" src="../grupo-propiedades/<?php echo $grupo["img_grupo_propiedad"]; ?>" alt=""></a>
									</div>
									<div class="col-md-5">
										<p class="sec_desc">
											<?php echo $grupo["detalle_grupo_propiedad"]; ?>
										</p>
									</div>

									<div class="col-md-3 text-right">
										<div class="row caja-overflow">
											<?php
											$sql_grupo_propiedad = "SELECT * FROM codigos_grupos_propiedades INNER JOIN propiedades ON codigos_grupos_propiedades.cod_propiedad = propiedades.cod_propiedad WHERE id_grupo_propiedad = '".$grupo["id_grupo_propiedad"]."'";
											$cursor_grupo_propiedad = $conexion -> query($sql_grupo_propiedad);
											while($grupo_propiedad = $cursor_grupo_propiedad -> fetch()){
												?>
												<div class="col-md-12" style="margin-top: 10px;">
													<a target="_blank" class="btn btn-default" href="ficha-propiedad.php?cod_propiedad=<?php echo $grupo_propiedad["cod_propiedad"]; ?>">
														<div class="link-grupo-propiedad">
															<?php echo $grupo_propiedad["direccion_propiedad"]; ?> - Ver ficha
														</div>
													</a>
												</div>
												<?php
											}
											?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					}else{echo "No se encontro el grupo de propiedades pedido.";}
				}else{echo "Dato entregado faltante o vacio.";}
				?>

				<div class="spacer-30"></div>
				
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

        $('#feat_propty').on('click', '.btn_toggle_propiedades', function(){
        	//$().removeClass("display", "block");
        	//$('#'+$(this).attr("id")).addClass('data_missing');
    		$('#grupo_'+$(this).attr("id")).toggleClass('hidden');
        	//alert('asdf');
        	event.preventDefault();
        });
    </script>


</body>
</html>
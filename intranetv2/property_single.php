<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$sql_propiedad = "SELECT * FROM propiedades";
	$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
	$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
	$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
	$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
	$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
	$sql_propiedad .= " INNER JOIN regiones ON propiedades.id_region=regiones.id_region";
	$sql_propiedad .= " INNER JOIN sectores ON propiedades.id_sector=sectores.id_sector";
	$sql_propiedad .= " WHERE is_hidden=0 AND cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_propiedad = $conexion -> query($sql_propiedad);
	$propiedad = $cursor_propiedad -> fetch();
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Intranet Mateo Sanchez</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/ico-logo.png">
        <link rel="shortcut icon" href="assets/ico/ico-logo.png">

        <!-- CSS Global -->
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
        <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="assets/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet">
        <link href="assets/plugins/owl-carousel2/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="assets/plugins/owl-carousel2/assets/owl.theme.default.min.css" rel="stylesheet">
        <link href="assets/plugins/animate/animate.min.css" rel="stylesheet">
        <link href="assets/plugins/swiper/css/swiper.min.css" rel="stylesheet">

        <link href="assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="assets/plugins/countdown/jquery.countdown.css" rel="stylesheet">
        <link href="assets/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="assets/css/theme.css" rel="stylesheet">

        <!-- Head Libs -->
        <script src="assets/plugins/modernizr.custom.js"></script>

        <!--[if lt IE 9]>
        <script src="assets/plugins/iesupport/html5shiv.js"></script>
        <script src="assets/plugins/iesupport/respond.min.js"></script>
        <![endif]-->
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

            <!-- HEADER -->
            <header class="header fixed">
                <div class="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <!-- Navigation -->
                            <div class="col-md-8 left-menu">
                                <nav class="navigation closed clearfix">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <!-- navigation menu -->
                                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                                            <ul class="nav sf-menu">
                                                <li class="active"><a href="home.php">Inicio</a></li>                              
                                            </ul>
                                            <!-- /navigation menu -->
                                        </div>
                                    </div>
                                    <!-- Add Scroll Bar -->
                                    <div class="swiper-scrollbar"></div>
                                </nav>

                                <!-- Mobile menu toggle button -->
                                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                                <!-- /Mobile menu toggle button -->
                            </div>
                            <!-- /Navigation -->

                            <!-- Logo -->
                            <div class="col-md-4 no-padding top-logo">
                                <div class="logo">
                                    <a href="home.php"><img src="assets/img/logo-web.png" alt="Real Estate"/></a>
                                </div>
                            </div>
                            <!-- /Logo -->
                        </div>
                    </div>
                </div>

            </header>
            <!-- /HEADER -->

            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs text-right">
                    <div class="container">
                        <div class="page-header">
                            <h1>Propiedad: <?php echo $propiedad["cod_propiedad"]; ?></h1>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="home.php">Inicio</a></li>
                            <li><a href="#">Buscador</a></li>
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
                                <div class="property-big-card alt">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="owl-carousel img-carousel">
                                                <div class="item">
                                                    <a href="assets/img/preview/property/cat1-70x70x1.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/></a>
                                                </div>
                                                <div class="item">
                                                    <a href="assets/img/preview/property/cat1-1200x800x2.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="../img/propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt=""/></a>
                                                </div>
                                                <div class="item">
                                                    <a href="assets/img/preview/property/cat1-1200x800x3.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="../img/propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt=""/></a>
                                                </div>
                                                <div class="item">
                                                    <a href="assets/img/preview/property/cat1-1200x800x3.jpg" data-gal="prettyPhoto"><img class="img-responsive" src="../img/propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt=""/></a>
                                                </div>
                                            </div>
                                            <div class="row property-thumbnails">
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [0, 300]);"><img src="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [1, 300]);"><img src="../img/propiedades/<?php echo $propiedad["img_02_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [2, 300]);"><img src="../img/propiedades/<?php echo $propiedad["img_03_propiedad"];?>" alt=""/></a></div>
                                                <div class="col-xs-2 col-sm-2 col-md-3"><a href="#" onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [3, 300]);"><img src="../img/propiedades/<?php echo $propiedad["img_04_propiedad"];?>" alt=""/></a></div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                                <hr class="page-divider half transparent"/>

                                <h3 class="block-title alt"><i class="fa fa-angle-down"></i>Informaci&oacute;n - <?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]); ?> - <?php echo utf8_encode($propiedad["nombre_comuna"]); ?></h3>
                                <p><?php echo $propiedad["detalle_propiedad"]; ?></p>

                            </div>
                            <!-- /CONTENT -->

                            <!-- SIDEBAR -->
                            <aside class="col-md-3 sidebar" id="sidebar">
                                <!-- widget detail reservation -->
                                <div class="widget shadow widget-details-reservation">
                                    <h4 class="widget-title"><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></h4>
                                    <div class="widget-content property-big-card">
                                        <div class="property-details">
                                            <div class="list">
                                                <ul>                                                   
                                                    <li>Superficie Const: <?php echo $propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];?></li>
                                                    <li>Superficie Total: <?php echo $propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];?></li>
                                                    <li>Piezas: <?php echo $propiedad["dormitorios_propiedad"]; ?></li>
                                                    <li>Ba&ntilde;os: <?php echo $propiedad["banos_propiedad"]; ?></li>
                                                    <li>Estacionamientos: <?php echo $propiedad["nro_estacionamiento"]; ?></li>
													<li>Bodegas: <?php echo $propiedad["nro_bodega"]; ?></li>
                                                    <li>Propiedad Comercial: <?php if($propiedad["is_comercial"] == 1){echo "Si";}else{echo "No";}?></li>
                                                </ul>
                                            </div>
                                            
                                                <strong><?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></strong></i>
                                          
                                        </div>
                                    </div>
                                </div>
                                <!-- /widget detail reservation -->
								
                            </aside>
                            <!-- /SIDEBAR -->

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
        <script src="assets/plugins/swiper/js/swiper.jquery.min.js"></script>
        <script src="assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <!-- JS Page Level -->
        <script src="assets/js/theme-ajax-mail.js"></script>
        <script src="assets/js/theme.js"></script>

    </body>
</html>
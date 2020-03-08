<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <?php
		if(isset($_SESSION["is_intranet_active"]) && $_SESSION["is_intranet_active"] == 1){
			header("location: home.php");
		}
		?>
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
		
		<style>
			.logo a{
				text-align: right !important;
			}
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

            <!-- HEADER -->
            <header class="header fixed">
                <div class="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <!-- Logo -->
                            <div class="col-md-12 no-padding top-logo">
                                <div class="logo">
                                    <a href="index-2.html"><img src="assets/img/logo-web.png" alt="Real Estate"/></a>
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
			
                <section class="page-section breadcrumbs text-center">
                    <div class="container">
                        <div class="page-header">
                            <h1>Bienvenido al sistema intranet</h1>
                        </div>
                    </div>
                </section>
				
                <!-- PAGE -->
                <section class="page-section color">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
									if(isset($_SESSION["mensaje-login"])){
										echo $_SESSION["mensaje-login"];
										unset($_SESSION["mensaje-login"]);
									}
								?>
								<h3 class="block-title"><span>Iniciar sesi&oacute;n</span></h3>
                                <form action="iniciar_sesion.php" class="form-login" method="post">
                                    <div class="row">
                                        <div class="col-md-12 hello-text-wrap">
                                            <span class="hello-text text-thin">Utilize los datos correspondientes al sistema</span>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="text" name="correo_cuenta" placeholder="Correo electr&oacute;nico"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group"><input class="form-control" type="password" name="clave_cuenta" placeholder="Clave de la cuenta"></div>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <a class="forgot-password" href="#">Recuperar clave</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-theme btn-theme-dark pull-right" href="#">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

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
        <script src="assets/js/theme.js"></script>
		
		
    </body>
</html>
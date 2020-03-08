		<?php
		if(!isset($_SESSION["is_intranet_active"]) || $_SESSION["is_intranet_active"] != 1){
			header("location: bloquear_entrada.php");
		}
		?>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
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
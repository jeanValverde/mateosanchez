<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mateo Sanchez Corredor de propiedades">
    <meta name="author" content="pcdstudio">
    <link rel="shortcut icon" href="images/ico-logo.png" type="image/x-icon">

    <title>Mateo Sanchez Propiedades</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Owl Carousel Assets -->
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/owl.transitions.css" rel="stylesheet">

    <!-- Flexslider CSS -->
    <link href="css/flexslider.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main_style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<style>
		@font-face {
		font-family: "MindBlue_italic_demo";
		src: url("css/fonts/MindBlue_italic_demo.otf");
		}

		html {
			position: relative;
			min-height: 100%;
		}
		.carousel-fade .carousel-inner .item {
			opacity: 0;
			transition-property: opacity;
		}
		.carousel-fade .carousel-inner .active {
			opacity: 1;
		}
		.carousel-fade .carousel-inner .active.left,
		.carousel-fade .carousel-inner .active.right {
			left: 0;
			opacity: 0;
			z-index: 1;
		}
		.carousel-fade .carousel-inner .next.left,
		.carousel-fade .carousel-inner .prev.right {
			opacity: 1;
		}
		.carousel-fade .carousel-control {
			z-index: 2;
		}
		@media all and (transform-3d),
		(-webkit-transform-3d) {
			.carousel-fade .carousel-inner > .item.next,
			.carousel-fade .carousel-inner > .item.active.right {
				opacity: 0;
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
			.carousel-fade .carousel-inner > .item.prev,
			.carousel-fade .carousel-inner > .item.active.left {
				opacity: 0;
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
			.carousel-fade .carousel-inner > .item.next.left,
			.carousel-fade .carousel-inner > .item.prev.right,
			.carousel-fade .carousel-inner > .item.active {
				opacity: 1;
				-webkit-transform: translate3d(0, 0, 0);
				transform: translate3d(0, 0, 0);
			}
		}
		.item:nth-child(1) {
			background: url(images/bg-principal.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.item:nth-child(2) {
			background: url(images/bg-principal3.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.item:nth-child(3) {
			background: url(images/bg-principal7.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.carousel {
			z-index: -99;
		}
		.carousel .item {
			position: fixed;
			width: 100%;
			height: 100%;
		}

		@font-face {
			font-family: CaviarDreams;
			src: url(fonts/CaviarDreams.ttf);
		}

		h3 {
			font-family: CaviarDreams;
			font-size: 14px;
			font-style: normal;
			font-variant: normal;
			font-weight: 500;
			line-height: 15.4px;
		}

		body {
			/* Margin bottom by footer height */
			margin-bottom: 40px;
		}

		.footer {
			position: absolute;
			bottom: 0;
			width: 100%;
			/* Set the fixed height of the footer here */
			height: 40px;
			background-color: black;
		}

		header#banner{
			margin-top: 30px;
		}

		.panel{
			background-color: inherit;
		}

		h3.sec_titl{
			font-weight: bold;
			color: white;
			background-color: rgba(0, 0, 0, 0.7);
			margin-top: 0px;
		    font-size: 1.2rem;
		    padding: 5px;
		}

		.btn-search{
			font-size: 20px;
			background: #B71E24;
			color: white;
			border-color: #B71E24;
		}
			.btn-search:hover{
				color: #F1C930;
				background: #B71E24;
				border-color: #B71E24;
				border-left: none;
			}

		.img-responsive{
			display: initial;
			max-width: 90%;
			margin-top: 20px;
		}

		.bg-seccion{
			background: #222222;
			padding-bottom: 15px;
		}

		.rounded-circle{
			border-radius: 10%!important;
		}

		.text-white{
			color: white !important;
		}

		.center-align {
		  letter-spacing: -4px;
		  text-align: center;
		  font-size: 0;
		}

		.center-align [class*='col-'] {
		  display: inline-block;
		  vertical-align: top;
		  letter-spacing: 0;
		  font-size: 14px;
		  float: none;
		}

		#overlay_1 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#overlay_2 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#overlay_3 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#overlay_4 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#overlay_5 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#overlay_6 {
		 	position: absolute;
		    height: 92%;
		    width: 90%;
		    top: -1px;
		    left: 13px;
		   	display: none;
		}

		#texto_pasaje p{
			color: white;
			font-family: MindBlue_italic_demo;
			font-size: 2.35rem;
		}

		#texto_pasaje span{
			font-family: auto;
		}





    html {
    	font-size: 8px;
    }

    .social-bar {
    	position: fixed;
    	right: 0%;
    	top: 9%;
    	font-size: 1.5rem;
    	display: flex;
    	flex-direction: column;
    	align-items: flex-end;
    	z-index: 100;
    }

    .icon {
    	color: white;
    	text-decoration: none;
    	padding: .7rem;
    	display: flex;
    	transition: all .5s;
    }

    .icon-facebook {
    	background: #dfd21e;
    }

    .icon-twitter {
    	background: #339DC5;
    }

    .icon-youtube {
    	background: #E83028;
    }

    .icon-instagram {
    	background: #E83028;
    }

    .icon:first-child {
    	border-radius: 1rem 0 0 0;
    }

    .icon:last-child {
    	border-radius: 0 0 0 1rem;
    }

    .icon:hover {
    	padding-right: 3rem;
    	border-radius: 1rem 0 0 1rem;
    	box-shadow: 0 0 .5rem rgba(0, 0, 0, 0.42);
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


.col-md-3 {
    width: 33%;
}

.col-lg-3 {
    width: 25%;
    margin-left: -18px;
}

	</style>
</head>

<body>
    <!-- Inspired by https://codepen.io/transportedman/pen/NPWRGq -->

	<div class="carousel slide carousel-fade" data-ride="carousel">
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
			</div>


			<!--
			<div class="item">
			</div>
			<div class="item">
			</div>
			-->
		</div>
	</div>
  <section class="top_sec" >
      <div class="container">
        <div class="social-bar">
                      <a href="" class="icon icon-facebook" target="_blank" data-toggle="modal" data-target="#modalForm" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¡VENDE!&nbsp;&nbsp;</a>
                    <!--  <a href="https://www.youtube.com/c/devcodela" class="icon icon-youtube" target="_blank"></a> -->
                      <a href="" class="icon icon-instagram" target="_blank" data-toggle="modal" data-target="#modalForm">¡ARRIENDA!</a>
                    </div>
          <div class="row">
              <div class="col-xs-12 col-md-6 top_lft">
                  <div class="inf_txt">
                    <a href="tel:+56996736137">
                  <button class="btn btn-success btn-lg" style="font-size: 12px;" >
                    ¡Llamenos!
                </button>
                </a>
                <button class="btn btn-successs btn-lg" style="font-size:12px;"  data-toggle="modal" data-target="#modalForm">
                    ¡Contáctenos ahora!
                </button>
                  </div>
              </div>
              <!-- /.top-left -->
              <div class="col-xs-12 col-md-6 top_rgt">
                  <div class="soc_ico">
                      <ul>
                          <!--
                          <li class="inf_txt uf-dato">
              <p>$26.624,85</p>
            </li>
                          -->
                          <!-- Button to trigger modal -->
                          <!-- <button class="btn btn-success btn-lg" style="font-size:9px;"  data-toggle="modal" data-target="#modalForm">
                              ¡Contáctenos ahora!
                          </button> -->

            <li class="fb">
                              <a href="https://www.facebook.com/MateoSanchezPropiedades/" target="_blank">
                                  <img src="propiedades-comercial/images/social-buttons/fb2.png" style="width: 33px;">
                              </a>
                          </li>

            <li class="insta">
                              <a href="https://www.instagram.com/mateosanchezcomerciales/" target="_blank">
                                  <img src="propiedades-comercial/images/social-buttons/insta1.png" style="width: 33px;">
                              </a>
                          </li>
                          <li class="ytube">
                              <a href="https://www.youtube.com/channel/UCgX7kNlaOafuFvQoxpQbviQ" target="_blank">
                                    <img src="propiedades-comercial/images/social-buttons/you2.png" style="width: 33px;">
                              </a>
                          </li>

                          <li class="rss">
                              <a href="https://api.whatsapp.com/send?phone=56996736137" target="_blank">
                                  <img src="propiedades-comercial/images/social-buttons/wts1.png" style="width: 33px;">
                              </a>
                          </li>

                      </ul>
                  </div>
        <!--
                  <div class="submit_prop">
                      <h3 class="subm_btn"><a href="#prop_box" data-toggle="modal">
            <i class="fa fa-bars"></i>
            <span> Seleccionar propiedad </span></a>
          </h3>
                  </div>
        -->
              </div>
              <!-- /.top-right -->
          </div>
          <!-- /.row -->
      </div>
      <!-- /.container -->
  </section>
  <div class="modal fade" id="modalForm" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Cabecera -->
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Cerrar</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Formulario de Contacto</h4>
              </div>

              <!-- Modal Cuerpo contenido -->
              <div class="modal-body">
                  <p class="statusMsg"></p>
                  <form role="form">
                      <div class="form-group">
                          <label for="inputName">Nombre</label>
                          <input type="text" class="form-control" id="inputName" placeholder="Ingrese su nombre"/>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail">Email</label>
                          <input type="email" class="form-control" id="inputEmail" placeholder="Ingrese su email"/>
                      </div>
                      <div class="form-group">
                          <label for="inputPhone">Numero</label>
                          <textarea class="form-control" id="inputPhone" placeholder="Ingrese su Numero"></textarea>
                      </div>
                      <div class="form-group">
                          <label for="inputMessage">Mensaje</label>
                          <textarea class="form-control" id="inputMessage" placeholder="Ingrese su mensaje"></textarea>
                      </div>
                  </form>
              </div>

              <!-- Modal Pie de Página -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-primary submitBtn" onclick="EnviarFormulario()">Enviar Ahora</button>
              </div>
          </div>
      </div>
  </div>
	<!-- Remeber to put all the content you want on top of the slider below the slider code -->

	<!-- Header Stat Banner -->
	<header id="banner" class="stat_bann">

		<div class="container">
			<!-- <div class="col-md-9 text-left">
				<img class="visible-xs" src="images/logo-web.png" alt="Banner" style="width: 100%; margin-bottom: 20px;">
				<img class="hidden-xs" src="images/logo-web.png" alt="Banner" style="margin-bottom: 20px;">
			</div> -->

			<div class="col-lg-3">
				<form method="get" action="propiedades-comercial/resultado-buscador.php">
					<label style="color: white;">C&oacute;digo Propiedad</label>
					<div class="input-group">
						<input type="text" class="form-control" name="cod_propiedad" placeholder="Ingrese c&oacute;digo propiedad">
						<input type="hidden" name="id_tipo_valor" value="1">
						<span class="input-group-btn">
							<button class="btn btn-default btn-search" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</form>
			</div><!-- /.col-lg-6 -->
		</div>
	</header>
<div class="spacer-35"></div>
	<!-- Talented Agents Section -->
	<section id="pagina_principal">
		<div class="container center-align">
			<div class="row">
				<div class="col-lg-12 text-center">
					<!--
					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/">
								<div class="flip hidden-xs hidden-sm" id="comercial">
									<div class="front">
										<div class="panel-image text-center">
											<img class="img-responsive rounded-circle" src="images/imagenes-index/comercial.jpg" alt="">
										</div>
									</div>
									<div class="back">
										<div class="panel-image text-center">
											<img class="img-responsive rounded-circle" src="images/titulos-index/titulo-propiedades-comerciales.jpg" alt="">
										</div>
									</div>
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/comercial.jpg" alt="">
									<h3 class="sec_titl">PROPIEDADES COMERCIALES</h3>
								</div>
							</a>
						</div>
					</div>
					-->
          <div class="spacer-100"></div>
					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_1">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/LOGOMATEO500.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_1" src="images/imagenes-index/LOGOMATEO500.jpg" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/LOGOMATEO500.jpg" alt="">
									<h3 class="sec_titl">PROPIEDADES COMERCIALES</h3>
								</div>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/resultado-buscador.php?id_tipo_valor=1">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_2">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/BACARO500.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_2" src="images/imagenes-index/BACARO500.jpg" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/BACARO500.jpg" alt="">
									<h3 class="sec_titl">PROPIEDADES HABITACIONALES</h3>
								</div>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/servicios.php">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_3">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/bacaro.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_3" src="images/imagenes-index/bacaro.jpg" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/bacaro.jpg" alt="">
									<h3 class="sec_titl">RIOS DEL SUR</h3>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="row">
				<div class="col-lg-12 text-center">
					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/servicios.php#constructora_ar">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_4">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/constructora-inmobiliaria-ar.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_4" src="images/imagenes-index/constructora-inmobiliaria-ar.png" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/constructora-inmobiliaria-ar.jpg" alt="">
									<h3 class="sec_titl">CONSTRUCTORA INMOBILIARIA AR</h3>
								</div>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/servicios.php#administraciones_comerciales">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_5">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/administraciones-comerciales.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_5" src="images/imagenes-index/administraciones-comerciales.png" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/administraciones-comerciales.jpg" alt="">
									<h3 class="sec_titl">ADMINISTRACIONES COMERCIALES</h3>
								</div>
							</a>
						</div>
					</div>

					<div class="col-xs-12 col-md-3">
						<div class="panel panel-default text-center">
							<a href="propiedades-comercial/servicios.php#arriendo_espacio_no_utilizado">
								<div class="panel-image text-center hidden-xs hidden-sm" id="main_6">
									<img class="img-responsive rounded-circle" src="images/imagenes-index/arriendos-espacios-no-utilizados.jpg" alt="">
									<img class="img-responsive rounded-circle" id="overlay_6" src="images/imagenes-index/arriendos-espacios-no-utilizados.png" alt="">
								</div>

								<div class="panel panel-default text-center hidden-md hidden-lg">
									<img class="img-responsive" src="images/imagenes-index/arriendos-espacios-no-utilizados.jpg" alt="">
									<h3 class="sec_titl">ARRIENDOS DE ESPACIOS NO UTILIZADOS</h3>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div> -->
			<!-- /.row -->

			<div class="row text-center" style="margin-top: 70px;">
				<div id="texto_pasaje" class="col-md-6 text-center hidden-xs">
					<p>"Pero todo lo que para mi era ganancia lo he estimado como perdido<span class="nul_font">.</span> por amor a Cristo<span class="nul_font">.</span>"</p>
					<p>Filipenses 3:7</p>
				</div>
			</div>
		</div>
		<!-- /.container -->
	</section>
	<div class="spacer-30"></div>
	<!-- Footer -->
	<footer class="footer">
	  <div class="container" style="padding-top: 10px;">
		<p class="m-0 text-white pull-left">&copy;2018 Mateo Sanchez Propiedades</p>
		<p class="m-0 text-white pull-right hidden-xs">Dise&ntilde;ado y programado por <a href="#" class="external" style="color: #FF7F00">www.pcdstudio.cl</a></p>
	  </div>
	  <!-- /.container -->
	</footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Owl Carousel JavaScript -->
    <script src="js/owl.carousel.min.js"></script>

    <!-- Flexslider JavaScript -->
    <script src="js/jquery.flexslider-min.js"></script>

	<!-- Flip -->
	<script src="js/jquery.flip.min.js"></script>

	<script>

		$(function(){
			$(".flip").flip({
				trigger: 'hover'
			});
		});

		$('.carousel').carousel({
			autoplayTimeout: 2000
		});

		$(document).ready(function() {
		    $("#main_1").mouseenter(function() {
		               $("#overlay_1").show();
		    });

		    $("#main_1").mouseleave(function() {
		               $("#overlay_1").hide();
		    });

		    $("#main_2").mouseenter(function() {
		               $("#overlay_2").show();
		    });

		    $("#main_2").mouseleave(function() {
		               $("#overlay_2").hide();
		    });

		    $("#main_3").mouseenter(function() {
		               $("#overlay_3").show();
		    });

		    $("#main_3").mouseleave(function() {
		               $("#overlay_3").hide();
		    });

		    $("#main_4").mouseenter(function() {
		               $("#overlay_4").show();
		    });

		    $("#main_4").mouseleave(function() {
		               $("#overlay_4").hide();
		    });

		    $("#main_5").mouseenter(function() {
		               $("#overlay_5").show();
		    });

		    $("#main_5").mouseleave(function() {
		               $("#overlay_5").hide();
		    });

		    $("#main_6").mouseenter(function() {
		               $("#overlay_6").show();
		    });

		    $("#main_6").mouseleave(function() {
		               $("#overlay_6").hide();
		    });
		});

	</script>


	<script>
		$(document).ready(function(){
			$(this).scrollTop(0);
		});
	</script>
  <script>
  function EnviarFormulario(){
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var name = $('#inputName').val();
      var email = $('#inputEmail').val();
      var phone = $('#inputPhone').val();
      var message = $('#inputMessage').val();
      if(name.trim() == '' ){
      alert('Por Favor ingrese su nombre.');
          $('#inputName').focus();
      return false;
    }else if(email.trim() == '' ){
      alert('Por favor ingrese su email.');
          $('#inputEmail').focus();
      return false;
    }else if(email.trim() != '' && !reg.test(email)){
      alert('Por favor ingrese un email valido.');
          $('#inputEmail').focus();
      return false;
    }else if(phone.trim() == '' ){
      alert('Por favor ingrese su numero.');
          $('#inputPhone').focus();
      return false;
    }else if(message.trim() == '' ){
      alert('Por favor ingrese su mensaje.');
          $('#inputMessage').focus();
      return false;
    }else{
          $.ajax({
              type:'POST',
              url:'propiedades-comercial/EnviarForm.php',
              data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
              beforeSend: function () {
                  $('.submitBtn').attr("disabled","disabled");
                  $('.modal-body').css('opacity', '.5');
              },
              success:function(msg){
                  if(msg == 'bien'){
                      $('#inputName').val('');
                      $('#inputEmail').val('');
                      $('#inputPhone').val('');
                      $('#inputMessage').val('');
                      $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                  }else{
                      $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                  }
                  $('.submitBtn').removeAttr("disabled");
                  $('.modal-body').css('opacity', '');
              }
          });
      }
  }
  </script>
  <script>
  function EnviarFormulario(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#inputName').val();
    var email = $('#inputEmail').val();
    var phone = $('#inputPhone').val();
    var message = $('#inputMessage').val();
    if(name.trim() == '' ){
    alert('Por Favor ingrese su nombre.');
        $('#inputName').focus();
    return false;
  }else if(email.trim() == '' ){
    alert('Por favor ingrese su email.');
        $('#inputEmail').focus();
    return false;
  }else if(email.trim() != '' && !reg.test(email)){
    alert('Por favor ingrese un email valido.');
        $('#inputEmail').focus();
    return false;
  }else if(phone.trim() == '' ){
    alert('Por favor ingrese su numero.');
        $('#inputPhone').focus();
    return false;
  }else if(message.trim() == '' ){
    alert('Por favor ingrese su mensaje.');
        $('#inputMessage').focus();
    return false;
  }else{
        $.ajax({
            type:'POST',
            url:'propiedades-comercial/EnviarFormA.php',
            data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'bien'){
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputPhone').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
  }
  </script>
  <script>
  function EnviarFormulario(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var name = $('#inputName').val();
    var email = $('#inputEmail').val();
    var phone = $('#inputPhone').val();
    var message = $('#inputMessage').val();
    if(name.trim() == '' ){
    alert('Por Favor ingrese su nombre.');
        $('#inputName').focus();
    return false;
  }else if(email.trim() == '' ){
    alert('Por favor ingrese su email.');
        $('#inputEmail').focus();
    return false;
  }else if(email.trim() != '' && !reg.test(email)){
    alert('Por favor ingrese un email valido.');
        $('#inputEmail').focus();
    return false;
  }else if(phone.trim() == '' ){
    alert('Por favor ingrese su numero.');
        $('#inputPhone').focus();
    return false;
  }else if(message.trim() == '' ){
    alert('Por favor ingrese su mensaje.');
        $('#inputMessage').focus();
    return false;
  }else{
        $.ajax({
            type:'POST',
            url:'propiedades-comercial/EnviarFormV.php',
            data:'ContactoEnviar=1&name='+name+'&email='+email+'&phone='+phone+'&message='+message,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'bien'){
                    $('#inputName').val('');
                    $('#inputEmail').val('');
                    $('#inputPhone').val('');
                    $('#inputMessage').val('');
                    $('.statusMsg').html('<span style="color:green;">Gracias por contactarnos, nos pondremos en contacto con usted pronto.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Ha ocurrido algún problema, por favor intente de nuevo.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
  }
  </script>
</body>
</html>

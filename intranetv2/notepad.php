<?php
	session_start();
	require_once("../admin/php/rutinas.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php
		require_once('shared-code.php');
		?>
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

            <?php
			require_once('header.php');
			?>

            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs text-right">
                    <div class="container">
                        <div class="page-header">
                            <h1>Notepad</h1>
                        </div>
                        <ul class="breadcrumb">
                            <li class="active">Inicio</li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE WITH SIDEBAR -->
                <section class="page-section with-sidebar sub-page">
                    <div class="container">
                        <div class="row">
							 <!-- CONTENT -->
                            <div class="col-md-12 content property-listing" id="content">
								<form id="form-notepad">
								  <div class="form-group">
									<input type="text" class="form-control" value="<?php echo "Fecha de la sesi&oacute;n: " . date("d") . " del " . date("m") . " de " . date("Y"); ?>" readonly>
								  </div>
								  <div class="form-group">
									<label>Receptor</label>
									<select class="form-control" id="id_receptor" name="id_receptor">
										<?php
										$sql_cuenta = "SELECT * FROM cuentas WHERE can_intranet = 1";
										$cursor_cuenta = $conexion -> query($sql_cuenta);
										while($cuenta = $cursor_cuenta -> fetch()){
											?>
											<option value="<?php echo $cuenta["id_cuenta"]; ?>" <?php if($cuenta["id_cuenta"] == $_SESSION["id_cuenta"]){echo "SELECTED";} ?>><?php echo $cuenta["correo_cuenta"]; ?></option>
											<?php
										}
										?>
									</select>
								  </div>
								  <div class="form-group">
									<label for="detalle_mensaje">Detalles del mensaje</label>
									<textarea type="password" class="form-control" style="border: 1px solid black" id="detalle_mensaje" name="detalle_mensaje" rows="10"></textarea>
								  </div>
								  <button type="submit" class="btn btn-success pull-right">Ingresar notas</button>
								</form>
							</div>
                            <!-- /CONTENT -->

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
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
        <script src="assets/js/theme.js"></script>
		
		<script>
			$('#form-notepad').submit(function( event ) {
				if($('textarea#detalle_mensaje').val() == ""){
					alert('Mensaje vacio, no se puede guardar.');
				}else{
					var r = confirm('Seguro de guardar el mensaje?');
					if (r == true) {
						$.ajax({
							method: "POST",
							url: "guardar_mensaje.php",
							data: { id_receptor: $('#id_receptor').val(), detalle_mensaje: $('textarea#detalle_mensaje').val() }
						}).done(function() {
							alert('Mensaje guardado.');
							$('textarea#detalle_mensaje').val('');
						});
					}
					
				}
				event.preventDefault();
			});
		</script>
    </body>
</html>
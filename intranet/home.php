<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	$sql_nota_dinamica = "SELECT * FROM notas_dinamicas WHERE id_cuenta = ".$_SESSION["id_cuenta"]." ORDER BY id_nota_dinamica DESC LIMIT 1";
	$cursor_nota_dinamica = $conexion->query($sql_nota_dinamica);
	if(!$validar_nota_dinamica = $cursor_nota_dinamica->rowCount()){
		$validar_nota_dinamica = 0;
	}
	
	if($validar_nota_dinamica == 0){
		$nota_dinamica["detalle_nota_dinamica"] = "Nota: ";
	}else{
		$nota_dinamica = $cursor_nota_dinamica->fetch();
	}
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
                            <h1>Inicio intranet</h1>
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
							<div class="col-md-9 content property-listing" id="content">
								<?php
								$sql_tareas = "SELECT * FROM fechas ";
								$sql_tareas .= "INNER JOIN cuentasxtareas ON fechas.id_cuentaxtarea = cuentasxtareas.id_cuentaxtarea ";
								$sql_tareas .= "INNER JOIN tareas ON cuentasxtareas.id_tarea = tareas.id_tarea ";
								$sql_tareas .= "INNER JOIN cuentas ON cuentasxtareas.id_cuenta = cuentas.id_cuenta ";
								$sql_tareas .= "WHERE cuentasxtareas.id_cuenta = '".$_SESSION["id_cuenta"]."' AND fechas.fecha_tarea='".date('Y-m-j')."'";
								$cursor_tareas = $conexion -> query($sql_tareas);
								while($tarea = $cursor_tareas -> fetch()){
								?>
								<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
									<div class="caption col-md-4">
										<h4 class="caption-title"><a href="#">Tarea: <?php echo invertirFecha($tarea["fecha_tarea"]); ?></a></h4>
										<h5 class="caption-title-sub">
											<?php echo $tarea["nombre_tarea"]; ?>
										</h5>
									</div>
									<div class="caption col-md-8">
										<p><?php echo $tarea["descripcion_tarea"];?></p>
									</div>
								</div>
								<?php
								}
								?>
							</div>
                            <!-- /CONTENT -->

                            <?php
							require_once('sidebar.php');
							?>

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
        <script src="assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <!-- JS Page Level -->
        <script src="assets/js/theme-ajax-mail.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
        <script src="assets/js/theme.js"></script>
		<script src="assets/js/recurrent-code.js"></script>
		
		<script>
			$(document).ready(function(){
				$("#id_comuna").change(function(){
					$.post("../admin/php/selector_sector_buscador.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
				});
			})
			
			$(document).ready(function(){
				$("#id_region").change(function(){
					$.post("../admin/php/selector_comuna_buscador.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
				});
			})
		</script>

    </body>
</html>
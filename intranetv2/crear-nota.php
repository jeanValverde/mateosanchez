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
									if(isset($_SESSION["mensaje-sistema"])){
										echo $_SESSION["mensaje-sistema"];
										unset($_SESSION["mensaje-sistema"]);
									}
								?>
								<form id="form-notepad" action="guardar_mensaje.php" method="POST">
								  <div class="form-group">
									<input type="text" class="form-control" value="<?php echo "Fecha: " . date("d") . " / " . date("m") . " / " . date("Y"); ?>" readonly>
								  </div>
								  <div class="form-group col-md-4">
									<label>Receptor</label>
									<select class="form-control" id="id_receptor" name="id_receptor">
										<option value="0">Para todos</option>
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
								  
								  <div class="form-group col-md-4">
									<label>Tipo de propiedad</label>
									<select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
										<option value="0">No considerado</option>
										<?php
										$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY nombre_tipo_propiedad";
										$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
										while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
											?>
											<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"]; ?>"><?php echo $tipo_propiedad["nombre_tipo_propiedad"]; ?></option>
											<?php
										}
										?>
									</select>
								  </div>
								  
								  <div class="form-group col-md-4">
									<label>Tipo de operaci&oacute;n</label>
									<select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
										<option value="0">No considerado</option>
										<?php
										$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY nombre_tipo_operacion";
										$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
										while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
											?>
											<option value="<?php echo $tipo_operacion["id_tipo_operacion"]; ?>"><?php echo $tipo_operacion["nombre_tipo_operacion"]; ?></option>
											<?php
										}
										?>
										<option value="k">Captaci&oacute;n</option>
									</select>
								  </div>
								  
								  <div class="form-group col-md-6">
									  <label>Nombre cliente (*)</label>
									  <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente"></input>
								  </div>
								  
								  <div class="form-group col-md-6">
									  <label>Tel&eacute;fono (*)</label>
									  <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente"></input>
								  </div>
								  
								  <div class="form-group col-md-6">
									  <label>Correo electr&oacute;nico (*)</label>
									  <input type="text" class="form-control" id="correo_cliente" name="correo_cliente"></input>
								  </div>
								  
								  <div class="form-group col-md-6">
									  <label>C&oacute;digo propiedad</label>
									  <input type="text" class="form-control" id="codigo_propiedad_cliente" name="codigo_propiedad_cliente"></input>
								  </div>
								  
								  <!--
								  <div class="form-group col-md-6">
									  <label>Valor desde</label>
									  <input type="text" class="form-control format_precio" name="valor_desde" id="valor_desde">
								  </div>
								  -->
								  
								  <input type="hidden" name="valor_desde" value="$0">
								  
								  <div class="form-group col-md-6">
									  <label>Valor monto</label>
									  <input type="text" class="form-control format_precio" name="valor_hasta" id="valor_hasta">
								  </div>
								  
									<div class="form-group col-md-4">
										<label>Tipo valor</label>
										<select class="form-control" name="id_tipo_valor">
											<option value="0">Cualquiera</option>
											<?php
											$sql_valor = "SELECT * FROM tipo_valores";
											$cursor_valor = $conexion -> query($sql_valor);
											while($valor = $cursor_valor -> fetch()){
												?>
												<option value="<?php echo $valor["id_tipo_valor"]; ?>"><?php echo $valor["nombre_tipo_valor"]; ?></option>
												<?php
											}
											?>
										</select>
									</div>
								  
									<div class="form-group col-md-4">
										<label>Regi&oacute;n</label>
										<select class="form-control" id="id_region" name="id_region">
											<option value="0">No considerado</option>
											<?php
											$sql_region = "SELECT * FROM regiones ORDER BY id_region";
											$cursor_region = $conexion -> query($sql_region);
											while($region = $cursor_region -> fetch()){
												?>
												<option value="<?php echo $region["id_region"]; ?>"><?php echo $region["nombre_region"]; ?></option>
												<?php
											}
											?>
										</select>
									</div>
									
									<div class="form-group col-md-4">
										<label>Comuna</label>
										<select class="form-control" id="id_comuna" name="id_comuna">
											<option value="0">No considerado</option>
										</select>
									</div>
									
									<div class="form-group col-md-4">
										<label>Sector</label>
										<select class="form-control" id="id_sector" name="id_sector">
											<option value="0">No considerado</option>
										</select>
									</div>
									
									<div class="form-group col-md-12">
										<label>Portales WEB</label>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Icasas <input type="checkbox" name="icasas_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Vivastreet <input type="checkbox" name="vivastreet_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Toctoc <input type="checkbox" name="toctoc_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group">
											<label>
												Portal inmobiliario <input type="checkbox" name="portal_inmobiliario_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-3">
										<div class="form-group">
											<label>
												info@mateosanchez.cl <input type="checkbox" name="info_mateo_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Economicos <input type="checkbox" name="economicos_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Fich <input type="checkbox" name="fich_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Yapo <input type="checkbox" name="yapo_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Facebook <input type="checkbox" name="facebook_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Fan page <input type="checkbox" name="fan_page_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Instagram <input type="checkbox" name="instagram_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Pura noticia <input type="checkbox" name="pura_noticia_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="col-lg-2">
										<div class="form-group">
											<label>
												Pagina web <input type="checkbox" name="pagina_web_mensaje" value="1">
											</label>
										</div>
									</div>
									
									<div class="form-group col-md-12">
										<label for="detalle_mensaje">Detalles del mensaje (*)</label>
										<textarea type="password" class="form-control" style="border: 1px solid black" id="detalle_mensaje" name="detalle_mensaje" rows="10"></textarea>
									</div>
									
									<button type="submit" class="btn btn-success pull-right">Ingresar notas</button>
								</form>
								
								<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
								<script>
									$(document).ready(function(){
										$('#form-notepad').submit(function( event ) {
											if($('textarea#detalle_mensaje').val() == "" || $('#nombre_cliente').val() == "" || $('#telefono_cliente').val() == "" || $('#correo_cliente').val() == ""){
												alert('Falta algunos de los siguientes datos:\n-> Nombre del cliente.\n-> Telefono del cliente.\n-> Correo electronico del cliente.\n-> Detalles del mensaje.\n\nFavor de revisar y rellenar con lo que corresponder, gracias.');
												event.preventDefault();
											}
										});
									})
									
									$(document).ready(function(){
										$(".format_precio").keyup(function() {
											$(this).val("$"+number_format($(this).val()));
										});
									});
								</script>
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

<!-- Mirrored from event-theme.com/themes/reEstate/listing.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 13 Apr 2016 04:42:27 GMT -->
</html>
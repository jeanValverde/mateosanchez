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
		<style>
			.col-lg-3 img{
				width: 150px;
			}
			
		</style>
		<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
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
							<form role="form" action="enviar_peticion_carteles.php" method="post" id="form-enviar-peticion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="adhesivo_efecto_espejo_vertical" name="adhesivo_efecto_espejo_vertical" value="1"> Adhesivo efecto espejo vertical</label>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/efecto-espejo-arrendo.jpg"></div>
															
															<fieldset class="bateria_adhesivo_efecto_espejo_vertical margin-left-30" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_chico_arrendo" name="adhesivo_efecto_espejo_vertical_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_mediano_arrendo" name="adhesivo_efecto_espejo_vertical_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_grande_arrendo" name="adhesivo_efecto_espejo_vertical_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/efecto-espejo-vendio.jpg"></div>
															
															<fieldset class="bateria_adhesivo_efecto_espejo_vertical margin-left-30" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_chico_vendio" name="adhesivo_efecto_espejo_vertical_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_mediano_vendio" name="adhesivo_efecto_espejo_vertical_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_grande_vendio" name="adhesivo_efecto_espejo_vertical_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/efecto-espejo-arrienda.png"></div>
															
															<fieldset class="bateria_adhesivo_efecto_espejo_vertical margin-left-30" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_chico_arrienda" name="adhesivo_efecto_espejo_vertical_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_mediano_arrienda" name="adhesivo_efecto_espejo_vertical_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_grande_arrienda" name="adhesivo_efecto_espejo_vertical_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/efecto-espejo-vende.jpg"></div>
															
															<fieldset class="bateria_adhesivo_efecto_espejo_vertical margin-left-30" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_chico_vende" name="adhesivo_efecto_espejo_vertical_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_mediano_vende" name="adhesivo_efecto_espejo_vertical_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_espejo_vertical_grande_vende" name="adhesivo_efecto_espejo_vertical_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /.row (nested) -->
									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="adhesivo_efecto_normal_vertical" name="adhesivo_efecto_normal_vertical" value="1"> Adhesivo efecto normal vertical</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_chico_arrendo" name="adhesivo_efecto_normal_vertical_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_mediano_arrendo" name="adhesivo_efecto_normal_vertical_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_grande_arrendo" name="adhesivo_efecto_normal_vertical_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_chico_vendio" name="adhesivo_efecto_normal_vertical_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_mediano_vendio" name="adhesivo_efecto_normal_vertical_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_grande_vendio" name="adhesivo_efecto_normal_vertical_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_chico_arrienda" name="adhesivo_efecto_normal_vertical_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_mediano_arrienda" name="adhesivo_efecto_normal_vertical_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_grande_arrienda" name="adhesivo_efecto_normal_vertical_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_chico_vende" name="adhesivo_efecto_normal_vertical_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_mediano_vende" name="adhesivo_efecto_normal_vertical_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_vertical_grande_vende" name="adhesivo_efecto_normal_vertical_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="adhesivo_efecto_normal_horizontal" name="adhesivo_efecto_normal_horizontal" value="1"> Adhesivo efecto normal horizontal</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_chico_arrendo" name="adhesivo_efecto_normal_horizontal_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_mediano_arrendo" name="adhesivo_efecto_normal_horizontal_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_grande_arrendo" name="adhesivo_efecto_normal_horizontal_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_chico_vendio" name="adhesivo_efecto_normal_horizontal_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_mediano_vendio" name="adhesivo_efecto_normal_horizontal_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_grande_vendio" name="adhesivo_efecto_normal_horizontal_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_chico_arrienda" name="adhesivo_efecto_normal_horizontal_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_mediano_arrienda" name="adhesivo_efecto_normal_horizontal_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_grande_arrienda" name="adhesivo_efecto_normal_horizontal_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_adhesivo_efecto_normal_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_chico_vende" name="adhesivo_efecto_normal_horizontal_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_mediano_vende" name="adhesivo_efecto_normal_horizontal_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="adhesivo_efecto_normal_horizontal_grande_vende" name="adhesivo_efecto_normal_horizontal_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="trovicel_vertical" name="trovicel_vertical" value="1"> Trovicel vertical</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_vertical_chico_arrendo" name="trovicel_vertical_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_vertical_vertical_mediano_arrendo" name="trovicel_vertical_vertical_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_vertical_vertical_grande_arrendo" name="trovicel_vertical_vertical_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_vertical_vertical_chico_vendio" name="trovicel_vertical_vertical_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_vertical_vertical_mediano_vendio" name="trovicel_vertical_vertical_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_vertical_vertical_grande_vendio" name="trovicel_vertical_vertical_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_vertical_vertical_chico_arrienda" name="trovicel_vertical_vertical_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_vertical_vertical_mediano_arrienda" name="trovicel_vertical_vertical_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_vertical_vertical_grande_arrienda" name="trovicel_vertical_vertical_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_vertical_vertical_chico_vende" name="trovicel_vertical_vertical_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_vertical_vertical_mediano_vende" name="trovicel_vertical_vertical_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_vertical_vertical_grande_vende" name="trovicel_vertical_vertical_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="trovicel_horizontal" name="trovicel_horizontal" value="1"> Trovicel horizontal</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_horizontal_chico_arrendo" name="trovicel_horizontal_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_horizontal_mediano_arrendo" name="trovicel_horizontal_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_horizontal_grande_arrendo" name="trovicel_horizontal_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_horizontal_chico_vendio" name="trovicel_horizontal_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_horizontal_mediano_vendio" name="trovicel_horizontal_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_horizontal_grande_vendio" name="trovicel_horizontal_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_horizontal_chico_arrienda" name="trovicel_horizontal_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_horizontal_mediano_arrienda" name="trovicel_horizontal_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_horizontal_grande_arrienda" name="trovicel_horizontal_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_trovicel_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="trovicel_horizontal_chico_vende" name="trovicel_horizontal_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="trovicel_horizontal_mediano_vende" name="trovicel_horizontal_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="trovicel_horizontal_grande_vende" name="trovicel_horizontal_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="tela_pvc_vertical" name="tela_pvc_vertical" value="1"> Tela pvc vertical</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_vertical_chico_arrendo" name="tela_pvc_vertical_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_vertical_mediano_arrendo" name="tela_pvc_vertical_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_vertical_grande_arrendo" name="tela_pvc_vertical_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_vertical_chico_vendio" name="tela_pvc_vertical_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_vertical_mediano_vendio" name="tela_pvc_vertical_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_vertical_grande_vendio" name="tela_pvc_vertical_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_vertical_chico_arrienda" name="tela_pvc_vertical_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_vertical_mediano_arrienda" name="tela_pvc_vertical_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_vertical_grande_arrienda" name="tela_pvc_vertical_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-vertical-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_vertical" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_vertical_chico_vende" name="tela_pvc_vertical_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_vertical_mediano_vende" name="tela_pvc_vertical_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_vertical_grande_vende" name="tela_pvc_vertical_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label><input type="checkbox" id="tela_pvc_horizontal" name="tela_pvc_horizontal" value="1"> Tela pvc horizontal</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrendo.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_horizontal_chico_arrendo" name="tela_pvc_horizontal_chico_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_horizontal_mediano_arrendo" name="tela_pvc_horizontal_mediano_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_horizontal_grande_arrendo" name="tela_pvc_horizontal_grande_arrendo" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vendio.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_horizontal_chico_vendio" name="tela_pvc_horizontal_chico_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_horizontal_mediano_vendio" name="tela_pvc_horizontal_mediano_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_horizontal_grande_vendio" name="tela_pvc_horizontal_grande_vendio" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-arrienda.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_horizontal_chico_arrienda" name="tela_pvc_horizontal_chico_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_horizontal_mediano_arrienda" name="tela_pvc_horizontal_mediano_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_horizontal_grande_arrienda" name="tela_pvc_horizontal_grande_arrienda" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												
												<div class="col-lg-3">
													<div class="row">
														<div class="form-group">
															<div class="text-align-center"><img class="img-referencia" src="../img/cartel-efecto-normal-horizontal-vende.png"></div>
															
															<fieldset class="margin-left-30 bateria_tela_pvc_horizontal" disabled>
																<div class="checkbox">
																	<label>
																		Chico (35x43 cm) <input class="form-control" id="tela_pvc_horizontal_chico_vende" name="tela_pvc_horizontal_chico_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Mediano (50x62 cm) <input class="form-control" id="tela_pvc_horizontal_mediano_vende" name="tela_pvc_horizontal_mediano_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
																<div class="checkbox">
																	<label>
																		Grande (65x80 cm) <input class="form-control" id="tela_pvc_horizontal_grande_vende" name="tela_pvc_horizontal_grande_vende" type="number" placeholder="Cantidad">
																	</label>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<label>Otros tipos de pedidos</label>
									</div>
									
									<div class="panel-body">
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<textarea class="form-control" name="otras_peticiones" id="otras_peticiones" rows="4" value=""></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-12">
									<div class="row">
										<button type="submit" class="btn btn-success">Enviar</button>
									</div>
								</div>
							</form>
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
			
			$(document).ready(function(){
				$("#form-enviar-peticion").submit(function(){
					var mensaje_error = "Usted va a enviar la siguiente peticion para imprimir.\n";
					var is_valid = false;
					
					if($("input[name='adhesivo_efecto_espejo_vertical']").is(':checked')){
						//Bloque arrendo
						if($("#adhesivo_efecto_espejo_vertical_chico_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL CHICO ARRENDO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL MEDIANO ARRENDO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_grande_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL GRANDE ARRENDO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#adhesivo_efecto_espejo_vertical_chico_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL CHICO VENDIO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_mediano_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL MEDIANO VENDIO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_grande_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL GRANDE VENDIO - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#adhesivo_efecto_espejo_vertical_chico_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL CHICO ARRIENDA - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL MEDIANO ARRIENDA - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_grande_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL GRANDE ARRIENDA - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#adhesivo_efecto_espejo_vertical_chico_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL CHICO VENDE - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_mediano_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL MEDIANO VENDE - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_espejo_vertical_grande_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto espejo VERTICAL GRANDE VENDE - Cantidad: "+$("#adhesivo_efecto_espejo_vertical_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='adhesivo_efecto_normal_vertical']").is(':checked')){
						//Bloque arrendo
						if($("#adhesivo_efecto_normal_vertical_chico_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL CHICO ARRENDO - Cantidad: "+$("#adhesivo_efecto_normal_vertical_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL MEDIANO ARRENDO - Cantidad: "+$("#adhesivo_efecto_normal_vertical_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_grande_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL GRANDE ARRENDO - Cantidad: "+$("#adhesivo_efecto_normal_vertical_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#adhesivo_efecto_normal_vertical_chico_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL CHICO VENDIO - Cantidad: "+$("#adhesivo_efecto_normal_vertical_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_mediano_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL MEDIANO VENDIO - Cantidad: "+$("#adhesivo_efecto_normal_vertical_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_grande_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL GRANDE VENDIO- Cantidad: "+$("#adhesivo_efecto_normal_vertical_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#adhesivo_efecto_normal_vertical_chico_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL CHICO ARRIENDA- Cantidad: "+$("#adhesivo_efecto_normal_vertical_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL MEDIANO ARRIENDA - Cantidad: "+$("#adhesivo_efecto_normal_vertical_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_grande_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL GRANDE ARRIENDA - Cantidad: "+$("#adhesivo_efecto_normal_vertical_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#adhesivo_efecto_normal_vertical_chico_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL CHICO VENDE - Cantidad: "+$("#adhesivo_efecto_normal_vertical_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_mediano_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL MEDIANO VENDE - Cantidad: "+$("#adhesivo_efecto_normal_vertical_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_vertical_grande_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal VERTICAL GRANDE VENDE- Cantidad: "+$("#adhesivo_efecto_normal_vertical_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='adhesivo_efecto_normal_horizontal']").is(':checked')){
						//Bloque arrendo
						if($("#adhesivo_efecto_normal_horizontal_chico_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL CHICO ARRENDO - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL MEDIANO ARRENDO- Cantidad: "+$("#adhesivo_efecto_normal_horizontal_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_grande_arrendo").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL GRANDE ARRENDO - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#adhesivo_efecto_normal_horizontal_chico_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL CHICO VENDIO - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_mediano_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL MEDIANO VENDIO - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_grande_vendio").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL GRANDE VENDIO - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#adhesivo_efecto_normal_horizontal_chico_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL CHICO ARRIENDA - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL MEDIANO ARRIENDA- Cantidad: "+$("#adhesivo_efecto_normal_horizontal_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_grande_arrienda").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL GRANDE ARRIENDA- Cantidad: "+$("#adhesivo_efecto_normal_horizontal_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#adhesivo_efecto_normal_horizontal_chico_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL CHICO VENDE - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_mediano_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL MEDIANO VENDE - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#adhesivo_efecto_normal_horizontal_grande_vende").val() != ""){
							mensaje_error += "Item: Adhesivo con efecto normal HORIZONTAL GRANDE VENDE - Cantidad: "+$("#adhesivo_efecto_normal_horizontal_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='trovicel_vertical']").is(':checked')){
						//Bloque arrendo
						if($("#trovicel_vertical_chico_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL CHICO ARRENDO - Cantidad: "+$("#trovicel_vertical_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL MEDIANO ARRENDO- Cantidad: "+$("#trovicel_vertical_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_grande_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL GRANDE ARRENDO- Cantidad: "+$("#trovicel_vertical_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#trovicel_vertical_chico_vendio").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL CHICO VENDIO - Cantidad: "+$("#trovicel_vertical_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_mediano_vendio").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL MEDIANO VENDIO - Cantidad: "+$("#trovicel_vertical_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_grande_vendio").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL GRANDE VENDIO - Cantidad: "+$("#trovicel_vertical_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#trovicel_vertical_chico_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL CHICO ARRIENDA - Cantidad: "+$("#trovicel_vertical_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL MEDIANO ARRIENDA - Cantidad: "+$("#trovicel_vertical_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_grande_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL GRANDE ARRIENDA - Cantidad: "+$("#trovicel_vertical_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#trovicel_vertical_chico_vende").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL CHICO VENDE - Cantidad: "+$("#trovicel_vertical_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_mediano_vende").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL MEDIANO VENDE - Cantidad: "+$("#trovicel_vertical_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_vertical_grande_vende").val() != ""){
							mensaje_error += "Item: Trovicel VERTICAL GRANDE VENDE - Cantidad: "+$("#trovicel_vertical_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='trovicel_horizontal']").is(':checked')){
						//Bloque arrendo
						if($("#trovicel_horizontal_chico_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL CHICO ARRENDO - Cantidad: "+$("#trovicel_horizontal_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL MEDIANO ARRENDO - Cantidad: "+$("#trovicel_horizontal_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_grande_arrendo").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL GRANDE ARRENDO - Cantidad: "+$("#trovicel_horizontal_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#trovicel_horizontal_chico_vendio").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL CHICO VENDIO- Cantidad: "+$("#trovicel_horizontal_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_mediano_vendio").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL MEDIANO VENDIO - Cantidad: "+$("#trovicel_horizontal_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_grande_vendio").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL GRANDE VENDIO - Cantidad: "+$("#trovicel_horizontal_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#trovicel_horizontal_chico_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL CHICO ARRIENDA - Cantidad: "+$("#trovicel_horizontal_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL MEDIANO ARRIENDA - Cantidad: "+$("#trovicel_horizontal_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_grande_arrienda").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL GRANDE ARRIENDA - Cantidad: "+$("#trovicel_horizontal_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#trovicel_horizontal_chico_vende").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL CHICO VENDE - Cantidad: "+$("#trovicel_horizontal_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_mediano_vende").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL MEDIANO VENDE - Cantidad: "+$("#trovicel_horizontal_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#trovicel_horizontal_grande_vende").val() != ""){
							mensaje_error += "Item: Trovicel HORIZONTAL GRANDE VENDE - Cantidad: "+$("#trovicel_horizontal_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='tela_pvc_vertical']").is(':checked')){
						//Bloque arrendo
						if($("#tela_pvc_vertical_chico_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL CHICO ARRENDO - Cantidad: "+$("#tela_pvc_vertical_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL MEDIANO ARRENDO - Cantidad: "+$("#tela_pvc_vertical_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_grande_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL GRANDE ARRENDO - Cantidad: "+$("#tela_pvc_vertical_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#tela_pvc_vertical_chico_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL CHICO VENDIO - Cantidad: "+$("#tela_pvc_vertical_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_mediano_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL MEDIANO VENDIO - Cantidad: "+$("#tela_pvc_vertical_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_grande_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL GRANDE VENDIO - Cantidad: "+$("#tela_pvc_vertical_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#tela_pvc_vertical_chico_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL CHICO ARRIENDA - Cantidad: "+$("#tela_pvc_vertical_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL MEDIANO ARRIENDA - Cantidad: "+$("#tela_pvc_vertical_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_grande_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL GRANDE ARRIENDA - Cantidad: "+$("#tela_pvc_vertical_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#tela_pvc_vertical_chico_vende").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL CHICO VENDE - Cantidad: "+$("#tela_pvc_vertical_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_mediano_vende").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL MEDIANO VENDE - Cantidad: "+$("#tela_pvc_vertical_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_vertical_grande_vende").val() != ""){
							mensaje_error += "Item: Tela pvc VERTICAL GRANDE VENDE - Cantidad: "+$("#tela_pvc_vertical_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("input[name='tela_pvc_horizontal']").is(':checked')){
						//Bloque arrendo
						if($("#tela_pvc_horizontal_chico_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL CHICO ARRENDO - Cantidad: "+$("#tela_pvc_horizontal_chico_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_mediano_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL MEDIANO ARRENDO - Cantidad: "+$("#tela_pvc_horizontal_mediano_arrendo").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_grande_arrendo").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL GRANDE ARRENDO - Cantidad: "+$("#tela_pvc_horizontal_grande_arrendo").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vendio
						if($("#tela_pvc_horizontal_chico_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL CHICO VENDIO - Cantidad: "+$("#tela_pvc_horizontal_chico_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_mediano_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL MEDIANO VENDIO - Cantidad: "+$("#tela_pvc_horizontal_mediano_vendio").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_grande_vendio").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL GRANDE VENDIO - Cantidad: "+$("#tela_pvc_horizontal_grande_vendio").val()+"\n";
							is_valid = true;
						}
						
						//Bloque arrienda
						if($("#tela_pvc_horizontal_chico_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL CHICO ARRIENDA - Cantidad: "+$("#tela_pvc_horizontal_chico_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_mediano_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL MEDIANO ARRIENDA - Cantidad: "+$("#tela_pvc_horizontal_mediano_arrienda").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_grande_arrienda").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL GRANDE ARRIENDA - Cantidad: "+$("#tela_pvc_horizontal_grande_arrienda").val()+"\n";
							is_valid = true;
						}
						
						//Bloque vende
						if($("#tela_pvc_horizontal_chico_vende").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL CHICO VENDE - Cantidad: "+$("#tela_pvc_horizontal_chico_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_mediano_vende").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL MEDIANO VENDE - Cantidad: "+$("#tela_pvc_horizontal_mediano_vende").val()+"\n";
							is_valid = true;
						}
						
						if($("#tela_pvc_horizontal_grande_vende").val() != ""){
							mensaje_error += "Item: Tela pvc HORIZONTAL GRANDE VENDE - Cantidad: "+$("#tela_pvc_horizontal_grande_vende").val()+"\n";
							is_valid = true;
						}
					}
					
					if($("#otras_peticiones").val() != ""){
						mensaje_error += "Item: Peticion otros: "+$("#otras_peticiones").val()+"\n";
						is_valid = true;
					}
					
					if(is_valid == false){
						mensaje_error += "No se han ingresado items a la peticion.\n";
						alert(mensaje_error);
						event.preventDefault();
					}else{
						mensaje_error += "Seguro que desea enviarlo?"
						if(!confirm(mensaje_error)) {
							event.preventDefault();
						}
					}
				});
				
				$("#adhesivo_efecto_espejo_vertical").click(function(){  
					if($("#adhesivo_efecto_espejo_vertical").is(':checked')){
						$(".bateria_adhesivo_efecto_espejo_vertical").prop("disabled", false);  
					}else{  
						$(".bateria_adhesivo_efecto_espejo_vertical").prop("disabled", true);  
					}  
				});
				
				$("#adhesivo_efecto_normal_vertical").click(function() {  
					if($("#adhesivo_efecto_normal_vertical").is(':checked')) {  
						$(".bateria_adhesivo_efecto_normal_vertical").prop("disabled", false);  
					} else {  
						$(".bateria_adhesivo_efecto_normal_vertical").prop("disabled", true);  
					}  
				});
				
				$("#adhesivo_efecto_normal_horizontal").click(function(){
					if($("#adhesivo_efecto_normal_horizontal").is(':checked')){
						$(".bateria_adhesivo_efecto_normal_horizontal").prop("disabled", false);  
					}else{  
						$(".bateria_adhesivo_efecto_normal_horizontal").prop("disabled", true);  
					}  
				});
				
				$("#trovicel_vertical").click(function() {  
					if($("#trovicel_vertical").is(':checked')) {  
						$(".bateria_trovicel_vertical").prop("disabled", false);  
					} else {  
						$(".bateria_trovicel_vertical").prop("disabled", true);  
					}  
				});
				
				$("#trovicel_horizontal").click(function() {  
					if($("#trovicel_horizontal").is(':checked')) {  
						$(".bateria_trovicel_horizontal").prop("disabled", false);  
					} else {  
						$(".bateria_trovicel_horizontal").prop("disabled", true);  
					}  
				});
				
				$("#tela_pvc_vertical").click(function() {  
					if($("#tela_pvc_vertical").is(':checked')) {  
						$(".bateria_tela_pvc_vertical").prop("disabled", false);  
					} else {  
						$(".bateria_tela_pvc_vertical").prop("disabled", true);  
					}  
				});
				
				$("#tela_pvc_horizontal").click(function() {  
					if($("#tela_pvc_horizontal").is(':checked')) {  
						$(".bateria_tela_pvc_horizontal").prop("disabled", false);  
					} else {  
						$(".bateria_tela_pvc_horizontal").prop("disabled", true);  
					}  
				});
			})
		</script>

    </body>
</html>
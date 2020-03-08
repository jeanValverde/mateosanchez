<?php
	require_once('codigo_recurrente.php');
	
	$is_fail = 0;
	
	if(isset($_GET["id_prospecto"]) && is_numeric($_GET["id_prospecto"])){
		$sql_propiedad = "SELECT * FROM prospectos WHERE id_prospecto=".$_GET["id_prospecto"];
		$cursor_propiedad = $conexion -> query($sql_propiedad);
		
		if(!$propiedad = $cursor_propiedad -> fetch()){
			$is_fail = 1;
		}
	}else{
		$is_fail = 1;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('shared-code.php'); ?>
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php require('header.php');?>

            <?php require('sidebar.php');?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Validar nueva propiedad</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
                <div class="col-lg-12">
                    <?php
						if(isset($_SESSION["mensaje-sistema"])){
							echo $_SESSION["mensaje-sistema"];
							unset($_SESSION["mensaje-sistema"]);
						}
					?>
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Datos requeridos para editar la propiedad, existe las siguientes excepciones:
							<ul>
								<li>La imagenes que no se ingresen se les mantendra la imagen actual.</li>
								<li>Solo se mostrara el sector de la propiedad en el sitio si este es ingresado.</li>
							</ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<?php
									if($is_fail == 0){
									?>
									<form role="form" id="form-editar-propiedad" method="post" action="../php/validar_prospecto.php" enctype="multipart/form-data">
										<input type="hidden" name="id_prospecto" value="<?php echo $_GET["id_prospecto"];?>">
										<div class="form-group">
                                            <label>Observaciones propietario:</label>
                                            <textarea class="form-control" id="observaciones_propietario" name="observaciones_propietario" rows="4" value="<?php echo $propiedad["observacion_propietario"]?>"><?php echo $propiedad["observacion_propietario"];?></textarea>
                                        </div>
										
										<label>Rol de la propiedad:</label>
										<div class="form-group input-group" id="validar-rol">
                                            <input class="form-control" type="text" name="rol_propiedad" id="rol_propiedad" placeholder="Rol de la propiedad" value="<?php echo $propiedad["rol_prospecto"]?>">
											<span class="input-group-addon" id="resultado-validar-rol">Validar rol</span>
											<input type="hidden" id="is_fail_rol" value="1"></input>
                                        </div>
										
										<label>Codigo de la propiedad:</label>
										<div class="form-group input-group" id="validar_codigo">
											<input class="form-control" type="text" name="cod_propiedad" id="cod_propiedad" placeholder="Codigo de la propiedad" />
											<span class="input-group-addon" id="resultado-validar-codigo">Validar c&oacute;digo</span>
											<input type="hidden" id="is_fail_codigo" value="0"></input>
											<input type="hidden" id="codigo_actual_propiedad" value="<?php echo $propiedad["cod_propiedad"];?>"></input>
                                        </div>
										
										<div class="form-group">
                                            <div class="radio">
												<label>
                                                    <input type="radio" name="id_tipo_codigo" value="1" Checked> Digital (D)
                                                </label>
												<label>
													<input type="radio" name="id_tipo_codigo" value="2"> Documento (P)
												</label>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label>Tipo de operaci&oacute;n:</label>
                                            <select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
												<?php
													$sql = "SELECT * FROM tipo_operaciones";
													$cursor = $conexion->query($sql);
													while($tipo_operacion = $cursor->fetch()){
														
														$option_tipo_operacion = "<option value='".$tipo_operacion["id_tipo_operacion"]."'";
														if($propiedad["id_tipo_operacion"] == $tipo_operacion["id_tipo_operacion"]){
															$option_tipo_operacion .= " Selected";
														}
														$option_tipo_operacion .= ">".utf8_encode($tipo_operacion["nombre_tipo_operacion"])."</option>";
														
														echo $option_tipo_operacion;
														
													}
												?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Tipo de propiedad:</label>
                                            <select class="form-control" name="id_tipo_propiedad" id="id_tipo_propiedad">
												<option value="-">Escoja un tipo de propiedad</option>
												<?php
													$sql = "SELECT * FROM tipo_propiedades";
													$cursor = $conexion->query($sql);
													while($tipo_propiedad = $cursor->fetch()){
														$option_tipo_propiedad = "<option value='".$tipo_propiedad["id_tipo_propiedad"]."'";
														if($propiedad["id_tipo_prospecto"] == $tipo_propiedad["id_tipo_propiedad"]){
															$option_tipo_propiedad .= " Selected";
														}
														$option_tipo_propiedad .= ">".utf8_encode($tipo_propiedad["nombre_tipo_propiedad"])."</option>";
														echo $option_tipo_propiedad;
													}
												?>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Regi&oacute;n:</label>
                                            <select class="form-control" name="id_region" id="id_region">
												<?php
													$sql = "SELECT * FROM regiones";
													$cursor = $conexion -> query($sql);
													while($region = $cursor -> fetch()){
														if($region["id_region"] == 5){
															echo "<option value='".$region["id_region"]."' Selected>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
														}else{
															echo "<option value='".$region["id_region"]."'>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
														}
													}
												?>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Comuna:</label>
                                            <select class="form-control" name="id_comuna" id="id_comuna">
												<optgroup>
													<option value="34">Vi&ntilde;a del Mar</option>
													<option value="33">Valpara&iacute;so</option>
													<option value="37">Quilpu&eacute;</option>
													<option value="38">Villa Alemana</option>
												</optgroup>
												<optgroup label="-------------">
													<?php
														$sql = "SELECT * FROM comunas WHERE id_region=5";
														$cursor = $conexion -> query($sql);
														while($comuna = $cursor -> fetch()){
															
															$option_comuna = "<option value='".$comuna["id_comuna"]."'";
															if($propiedad["id_comuna"] == $comuna["id_comuna"]){
																$option_comuna .= " Selected";
															}
															$option_comuna .= ">".utf8_encode($comuna["nombre_comuna"])."</option>";
															
															echo $option_comuna;
														}
													?>
												</optgroup>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Sector:</label>
                                            <select class="form-control" name="id_sector" id="id_sector">
												<?php
													$sql = "SELECT * FROM sectores WHERE id_comuna=".$propiedad["id_comuna"];
													$cursor = $conexion -> query($sql);
													while($sector = $cursor -> fetch()){
														
														$option_sector = "<option value='".$sector["id_sector"]."'";
														if($propiedad["id_sector"] == $sector["id_sector"]){
															$option_sector .= " Selected";
														}
														$option_sector .= ">".utf8_encode($sector["nombre_sector"])."</option>";
														
														echo $option_sector;
													}
												?>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Direcci&oacute;n de la propiedad:</label>
                                            <input class="form-control" type="text" id="direccion_propiedad" name="direccion_propiedad" value="<?php echo $propiedad["direccion_prospecto"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>Giro comercial:</label>
                                            <select class="form-control" name="is_comercial" id="is_comercial">
												<option value="0" <?php if($propiedad["is_comercial"] == 0){echo "Selected";}?>>No</option>
												<option value="1" <?php if($propiedad["is_comercial"] == 1){echo "Selected";}?>>Si</option>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Valor de la propiedad:</label>
                                            <div class="radio">
												<input class="form-control" type="text" name="valor" id="valor" placeholder="Solo ingrese n&uacute;meros" value="<?php echo $propiedad["valor_prospecto"]?>" />
												<label>
                                                    <input type="radio" name="id_tipo_valor" value="1" <?php if($propiedad["id_tipo_valor"] == 1){echo " Checked";}?>> Pesos
                                                </label>
												<label>
													<input type="radio" name="id_tipo_valor" value="2" <?php if($propiedad["id_tipo_valor"] == 2){echo " Checked";}?>> UF
												</label>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label>N&uacute;mero de habitaciones / oficinas / Ambientes:</label>
                                            <input class="form-control" type="text" id="dormitorios_propiedad" name="dormitorios_propiedad" value="<?php echo $propiedad["dormitorios_prospecto"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>N&uacute;mero de ba&ntilde;os:</label>
                                            <input class="form-control" type="text" id="banos_propiedad" name="banos_propiedad" value="<?php echo $propiedad["banos_prospecto"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>N&uacute;mero de estacionamiento:</label>
                                            <input class="form-control" type="text" id="nro_estacionamiento" name="nro_estacionamiento" value="<?php echo $propiedad["nro_estacionamiento"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>N&uacute;mero de bodegas:</label>
                                            <input class="form-control" type="text" id="nro_bodega" name="nro_bodega" value="<?php echo $propiedad["nro_bodega"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>Superficie total de la propiedad:</label>
                                            <input class="form-control" type="text" id="cantidad_superficie_total_propiedad" name="cantidad_superficie_total_propiedad" value="<?php echo $propiedad["cantidad_superficie_total_prospecto"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>Superficie construida de la propiedad:</label>
                                            <input class="form-control" type="text" id="cantidad_superficie_construida_propiedad" name="cantidad_superficie_construida_propiedad" value="<?php echo $propiedad["cantidad_superficie_construida_prospecto"];?>" />
                                        </div>
										<div class="form-group">
                                            <label>Unidad de medida:</label>
                                            <select class="form-control" name="id_unidad_medida" id="id_unidad_medida">
												<option value="-">Escoja una unidad de medida</option>
												<?php
													$sql = "SELECT * FROM unidad_medidas";
													$cursor = $conexion -> query($sql);
													while($unidad_medida = $cursor -> fetch()){
														$option_unidad_medida = "<option value='".$unidad_medida["id_unidad_medida"]."'";
														if($propiedad["id_unidad_medida"] == $unidad_medida["id_unidad_medida"]){
															$option_unidad_medida .=  " Selected";
														}
														$option_unidad_medida .= ">".utf8_encode($unidad_medida["nombre_unidad_medida"])."</option>";
														
														echo $option_unidad_medida;
													}
												?>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Detalle de la propiedad:</label>
                                            <textarea class="form-control" name="detalle_propiedad" id="detalle_propiedad" rows="4" value="<?php echo $propiedad["detalle_propiedad"];?>"><?php echo $propiedad["detalle_prospecto"];?></textarea>
                                        </div>
										<div class="form-group">
											<label>Imagen propiedad n&uacute;mero 1</label>
                                            <input type="file" name="img_01_propiedad" id="img_01_propiedad">
											<img src="../../img/prospectos/<?php echo $propiedad["img_01_prospecto"];?>" />
                                        </div>
										<div class="form-group">
											<label><input type="checkbox" name="flag_borrar_img_01" value="1">Borrar imagen 1 (No podr&aacute; borrar la imagen referencial)</label>
										</div>
										<div class="form-group">
                                            <label>Imagen propiedad n&uacute;mero 2</label>
                                            <input type="file" name="img_02_propiedad" id="img_02_propiedad">
											<img src="../../img/prospectos/<?php echo $propiedad["img_02_prospecto"];?>" />
                                        </div>
										<div class="form-group">
											<label><input type="checkbox" name="flag_borrar_img_02" value="1">Borrar imagen 2 (No podr&aacute; borrar la imagen referencial)</label>
										</div>
										<div class="form-group">
                                            <label>Imagen propiedad n&uacute;mero 3</label>
                                            <input type="file" name="img_03_propiedad" id="img_03_propiedad">
											<img src="../../img/prospectos/<?php echo $propiedad["img_03_prospecto"];?>" />
                                        </div>
										<div class="form-group">
											<label><input type="checkbox" name="flag_borrar_img_03" value="1">Borrar imagen 3 (No podr&aacute; borrar la imagen referencial)</label>
										</div>
										<div class="form-group">
                                            <label>Imagen propiedad n&uacute;mero 4</label>
                                            <input type="file" name="img_04_propiedad" id="img_04_propiedad">
											<img src="../../img/prospectos/<?php echo $propiedad["img_04_prospecto"];?>" />
                                        </div>
										<div class="form-group">
											<label><input type="checkbox" name="flag_borrar_img_04" value="1">Borrar imagen 4 (No podr&aacute; borrar la imagen referencial)</label>
										</div>
										
                                        <button type="submit" class="btn btn-success">Validar propiedad</button>
                                    </form>
									<?php
									}else{
										echo "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Codigo de propiedad no valido.</div>";
									}
									?>
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
		require_once('librerias-js.php');
	?>
	<script src="../js/editar-prospecto.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#id_region").change(function(){
				$.post("../php/selector_comuna.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
			});
		})
		
		$(document).ready(function(){
			$("#id_comuna").change(function(){
				$.post("../php/selector_sector.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
			});
		})
	</script>
</body>

</html>

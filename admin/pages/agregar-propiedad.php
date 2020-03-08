<?php
	require_once('codigo_recurrente.php');
	
	$sql_codigo = "SELECT * FROM propiedades ORDER BY cod_propiedad DESC LIMIT 1";
	$cursor_codigo = $conexion -> query($sql_codigo);
	
	if(!$nro_registro = $cursor_codigo -> rowCount()){
		$codigo = 1;
	}else{
		$registro = $cursor_codigo -> fetch();
		$codigo = $registro["cod_propiedad"] + 1;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('shared-code.php'); ?>
	<style>
		.no-show{
			display: none;
		}
	</style>
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
                    <h1 class="page-header">Agregar Propiedad</h1>
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
                            Datos requeridos para la nueva propiedad, existe las siguientes excepciones:
							<ul>
								<li>La imagenes que no se ingresen se les anexaran una imagen base.</li>
								<li>Solo se mostrara el sector de la propiedad en el sitio si este es ingresado.</li>
								<li>Si no va a ingresar un codigo de propiedad, debe dejar la opcion de "Digital" seleccionado para que el sistema lo genere automaticamente.</li>
							</ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<form role="form" id="form-agregar-propiedad" method="post" action="../php/agregar_propiedad.php" enctype="multipart/form-data">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Observaciones propietario:</label>
												<textarea class="form-control" id="observaciones_propietario" name="observaciones_propietario" rows="4" value="<?php if(isset($_COOKIE["observaciones_propietario"])){echo $_COOKIE["observaciones_propietario"];}?>"><?php if(isset($_COOKIE["observaciones_propietario"])){echo $_COOKIE["observaciones_propietario"];}?></textarea>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Detalle del corredor:</label>
												<textarea class="form-control" name="detalle_corredor" id="detalle_corredor" rows="4" value="<?php if(isset($_COOKIE["detalle_propiedad"])){echo $_COOKIE["detalle_propiedad"];}?>"><?php if(isset($_COOKIE["detalle_propiedad"])){echo $_COOKIE["detalle_propiedad"];}?></textarea>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Convenios adheribles:</label>
												<div class="row">
													<?php
													$sql_convenio = "SELECT * FROM convenios";
													$cursor_convenio = $conexion -> query($sql_convenio);
													while($convenio = $cursor_convenio -> fetch()){
													?>
													<div class="col-lg-3">
														<input type="checkbox" name="id_convenio[]" value="<?php echo $convenio["id_convenio"]; ?>"> <?php echo $convenio["nombre_convenio"]; ?>
													</div>
													<?php
													}
													?>
												</div>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group input-group" id="validar-rol">
												<input class="form-control" type="text" name="rol_propiedad" id="rol_propiedad" placeholder="Rol de la propiedad">
												<span class="input-group-addon" id="resultado-validar-rol">Validar rol</span>
												<input type="hidden" id="is_fail_rol" value="1"></input>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group input-group" id="validar_codigo">
												<input class="form-control" type="text" name="cod_propiedad_documento" id="cod_propiedad_documento" placeholder="Codigo de la propiedad" />
												<span class="input-group-addon" id="resultado-validar-codigo">Validar c&oacute;digo</span>
												<input type="hidden" id="is_fail_codigo" value="0"></input>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<div class="radio">
													<label>
														<input type="radio" name="id_tipo_codigo" value="1" checked> Digital (D)
													</label>
													<label>
														<input type="radio" name="id_tipo_codigo" value="2"> Papel (P)
													</label>
													<input type="hidden" value="<?php echo $codigo;?>" name="cod_propiedad_digital"></input>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tipo de operaci&oacute;n:</label>
												<select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
													<option value="-">Escoja la operaci&oacute;n</option>
													<?php
														$sql = "SELECT * FROM tipo_operaciones";
														$cursor = $conexion->query($sql);
														while($tipo_operacion = $cursor->fetch()){
															echo "<option value='".$tipo_operacion["id_tipo_operacion"]."'>".utf8_encode($tipo_operacion["nombre_tipo_operacion"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tipo de propiedad:</label>
												<select class="form-control" name="id_tipo_propiedad" id="id_tipo_propiedad">
													<option value="-">Escoja un tipo de propiedad</option>
													<?php
														$sql = "SELECT * FROM tipo_propiedades";
														$cursor = $conexion->query($sql);
														while($tipo_propiedad = $cursor->fetch()){
															echo "<option value='".$tipo_propiedad["id_tipo_propiedad"]."'>".utf8_encode($tipo_propiedad["nombre_tipo_propiedad"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
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
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Comuna:</label>
												<select class="form-control" name="id_comuna" id="id_comuna">
													<option value="-">Escoja una comuna</option>
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
																echo "<option value='".$comuna["id_comuna"]."'>".utf8_encode($comuna["nombre_comuna"])."</option>";
															}
														?>
													</optgroup>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Sector:</label>
												<select class="form-control" name="id_sector" id="id_sector">
													<option value="-">Escoja primero una comuna</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Direcci&oacute;n de la propiedad:</label>
												<input class="form-control" type="text" id="direccion_propiedad" name="direccion_propiedad" value="<?php if(isset($_COOKIE["direccion_propiedad"])){echo $_COOKIE["direccion_propiedad"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Destino propiedad:</label>
												<select class="form-control" name="id_tipo_giro" id="id_tipo_giro">
													<?php
													$sql_tipo_giro = "SELECT * FROM tipo_giros";
													$cursor_tipo_giro = $conexion -> query($sql_tipo_giro);
													while($tipo_giro = $cursor_tipo_giro -> fetch()){
														
														?>
														<option value="<?php echo $tipo_giro["id_tipo_giro"];?>"><?php echo utf8_encode($tipo_giro["nombre_tipo_giro"]);?></option>
														<?php
													}
													?>
													<option value="k">Otro</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Valor de la propiedad:</label>
												<input class="form-control" type="number" name="valor" id="valor" value="<?php if(isset($_COOKIE["valor"])){echo $_COOKIE["valor"];}?>" placeholder="Solo ingrese n&uacute;meros" />
												<div class="radio">
													<label>
														<input type="radio" name="id_tipo_valor" value="1" checked> Pesos
													</label>
													<label>
														<input type="radio" name="id_tipo_valor" value="2"> UF
													</label>
												</div>
											</div>
										</div>
										
										<div id="sector-agregar-nombre-giro" class="col-lg-12 no-show">
											<div class="form-group input-group">
												<input type="text" class="form-control" id="nombre_tipo_giro">
												<span class="input-group-btn">
													<button class="btn btn-default" type="button" id="enviar-nuevo-giro">Agregar nuevo giro
													</button>
												</span>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>N&uacute;mero de habitaciones:</label>
												<input class="form-control" type="text" id="dormitorios_propiedad" name="dormitorios_propiedad" value="<?php if(isset($_COOKIE["dormitorios_propiedad"])){echo $_COOKIE["dormitorios_propiedad"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>N&uacute;mero de ba&ntilde;os:</label>
												<input class="form-control" type="text" id="banos_propiedad" name="banos_propiedad" value="<?php if(isset($_COOKIE["banos_propiedad"])){echo $_COOKIE["banos_propiedad"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-3">
										<div class="form-group">
                                            <label>N&uacute;mero de estacionamientos:</label>
                                            <input class="form-control" type="text" id="nro_estacionamiento" name="nro_estacionamiento" value="<?php if(isset($_COOKIE["nro_estacionamiento"])){echo $_COOKIE["nro_estacionamiento"];}?>" />
                                        </div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>N&uacute;mero de bodegas:</label>
												<input class="form-control" type="text" id="nro_bodega" name="nro_bodega" value="<?php if(isset($_COOKIE["nro_bodega"])){echo $_COOKIE["nro_bodega"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Superficie total de la propiedad:</label>
												<input class="form-control" type="text" id="cantidad_superficie_total_propiedad" name="cantidad_superficie_total_propiedad" value="<?php if(isset($_COOKIE["cantidad_superficie_total_propiedad"])){echo $_COOKIE["cantidad_superficie_total_propiedad"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Superficie construida de la propiedad:</label>
												<input class="form-control" type="text" id="cantidad_superficie_construida_propiedad" name="cantidad_superficie_construida_propiedad" value="<?php if(isset($_COOKIE["cantidad_superficie_construida_propiedad"])){echo $_COOKIE["cantidad_superficie_construida_propiedad"];}?>" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Unidad de medida:</label>
												<select class="form-control" name="id_unidad_medida" id="id_unidad_medida">
													<option value="-">Escoja una unidad de medida</option>
													<?php
														$sql = "SELECT * FROM unidad_medidas";
														$cursor = $conexion -> query($sql);
														while($unidad_medida = $cursor -> fetch()){
															echo "<option value='".$unidad_medida["id_unidad_medida"]."'>".utf8_encode($unidad_medida["nombre_unidad_medida"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Detalle de la propiedad:</label>
												<textarea class="form-control" name="detalle_propiedad" id="detalle_propiedad" rows="4" value="<?php if(isset($_COOKIE["detalle_corredor"])){echo $_COOKIE["detalle_corredor"];}?>"><?php if(isset($_COOKIE["detalle_corredor"])){echo $_COOKIE["detalle_corredor"];}?></textarea>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad PRINCIPAL</label>
												<input type="file" name="img_01_propiedad" id="img_01_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 2</label>
												<input type="file" name="img_02_propiedad" id="img_02_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 3</label>
												<input type="file" name="img_03_propiedad" id="img_03_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 4</label>
												<input type="file" name="img_04_propiedad" id="img_04_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<button type="submit" class="btn btn-success">Agregar propiedad</button>
											<button type="reset" class="btn btn-danger">Limpiar formulario</button>
										</div>
                                    </form>
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
	<script src="../js/agregar-propiedad.js" type="text/javascript"></script>
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
		
		$(document).ready(function(){
			$("#id_tipo_giro").change(function(){
				if($('#id_tipo_giro').val() == "k"){
					$('#sector-agregar-nombre-giro').removeClass("no-show");
				}else{
					$('#sector-agregar-nombre-giro').addClass("no-show");
				}
			});
		})
		
		$("#enviar-nuevo-giro").click(function(){	
			var nombre_tipo_giro = $("input#nombre_tipo_giro").val();
			
			var mensaje_error = "";
			
			if(nombre_tipo_giro == ""){
				mensaje_error += "Falta dato: Nombre del nuevo giro.\n";
			}
			
			if(mensaje_error != ""){
				alert(mensaje_error);
				event.preventDefault();
			}else{
				$.post("../php/agregar_nombre_tipo_giro.php",{ nombre_tipo_giro:$('#nombre_tipo_giro').val() },function(data){$("#id_tipo_giro").html(data);})
				$('#sector-agregar-nombre-giro').addClass("no-show");
			}
		});
		
		$(document).ready(function(){
			$("#observaciones_propietario").keyup(function(){
				$.post("../php/generar_cookie.php",{ observaciones_propietario:$(this).val() },function(data){})
			});
			
			$("#direccion_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ direccion_propiedad:$(this).val() },function(data){})
			});
			
			$("#valor").keyup(function(){
				$.post("../php/generar_cookie.php",{ valor:$(this).val() },function(data){})
			});
			
			$("#dormitorios_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ dormitorios_propiedad:$(this).val() },function(data){})
			});
			
			$("#banos_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ banos_propiedad:$(this).val() },function(data){})
			});
			
			$("#nro_estacionamiento").keyup(function(){
				$.post("../php/generar_cookie.php",{ nro_estacionamiento:$(this).val() },function(data){})
			});
			
			$("#nro_bodega").keyup(function(){
				$.post("../php/generar_cookie.php",{ nro_bodega:$(this).val() },function(data){})
			});
			
			$("#cantidad_superficie_total_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ cantidad_superficie_total_propiedad:$(this).val() },function(data){})
			});
			
			$("#cantidad_superficie_construida_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ cantidad_superficie_construida_propiedad:$(this).val() },function(data){})
			});
			
			$("#detalle_propiedad").keyup(function(){
				$.post("../php/generar_cookie.php",{ detalle_propiedad:$(this).val() },function(data){})
			});
			
			$("#detalle_corredor").keyup(function(){
				$.post("../php/generar_cookie.php",{ detalle_corredor:$(this).val() },function(data){})
			});
		})
	</script>
</body>

</html>

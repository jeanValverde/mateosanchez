<?php
	require_once('codigo_recurrente.php');
	
	$is_fail = 0;
	
	if(isset($_GET["cod_propiedad"]) && is_numeric($_GET["cod_propiedad"])){
		$sql_propiedad = "SELECT * FROM propiedades WHERE cod_propiedad=".$_GET["cod_propiedad"];
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
                    <h1 class="page-header">Ingresar Propiedad: <?php echo $_GET["cod_propiedad"]; ?></h1>
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
									<form role="form" id="form-editar-propiedad" method="post" action="../php/ingreasar_propiedad_documentador.php" enctype="multipart/form-data">
										<input type="hidden" name="id_propiedad" value="<?php echo $propiedad["id_propiedad"]; ?>">
										<div class="col-lg-12">
											<h3>Datos contrato</h3>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Fecha contrato</label>
												<input class="form-control" type="date" name="fecha_contrato_cliente" value="<?php echo date('Y-m-d'); ?>"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nombre cliente</label>
												<input class="form-control" name="nombre_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Direcci&oacute;n cliente</label>
												<input class="form-control" name="direccion_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Rut cliente</label>
												<input class="form-control" name="rut_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tel&eacute;fono cliente</label>
												<input class="form-control" name="telefono_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Correo cliente</label>
												<input class="form-control" name="correo_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nombre contacto</label>
												<input class="form-control" name="nombre_contacto_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tel&eacute;fono contacto</label>
												<input class="form-control" name="telefono_contacto_cliente"></input>
											</div>
										</div>
										
										<div class="col-lg-12">
											<h3>Condiciones</h3>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Es exclusivo?</label>
												<select class="form-control" name="is_exclusivo">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Autoriza publicidad</label>
												<select class="form-control" name="is_publicidad">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Plazo exclusividad - inicio</label>
												<input class="form-control" type="date" name="plazo_exclusividad_inicio"></input>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Plazo exclusividad - fin</label>
												<input class="form-control" type="date" name="plazo_exclusividad_fin"></input>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Es renovable?</label>
												<select class="form-control" name="is_renovable">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Entrega de llaves</label>
												<select class="form-control" name="is_entrega_llaves">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Valor propiedad: (Ej decimal: 34.23)</label>
												<input class="form-control" type="text" name="valor" id="valor" placeholder="Solo ingrese n&uacute;meros" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tipo de valor</label>
												<select class="form-control" name="id_tipo_valor">
													<option value="1">Pesos</option>
													<option value="2">UF</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-12">
											<h3>Individualizaci&oacute;n del inmueble</h3>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Direcci&oacute;n de la propiedad:</label>
												<input class="form-control" type="text" id="direccion_propiedad" name="direccion_propiedad" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Superficie total: (Ejemplo: 32.45)</label>
												<input class="form-control" type="text" id="cantidad_superficie_total_propiedad" name="cantidad_superficie_total_propiedad" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Superficie construida: (Ejemplo: 32.45)</label>
												<input class="form-control" type="text" id="cantidad_superficie_construida_propiedad" name="cantidad_superficie_construida_propiedad" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Unidad de medida:</label>
												<select class="form-control" name="id_unidad_medida" id="id_unidad_medida">
													<?php
														$sql = "SELECT * FROM unidad_medidas";
														$cursor = $conexion -> query($sql);
														while($unidad_medida = $cursor -> fetch()){
															$option_unidad_medida = "<option value='".$unidad_medida["id_unidad_medida"]."'";
															$option_unidad_medida .= ">".utf8_encode($unidad_medida["nombre_unidad_medida"])."</option>";
															
															echo $option_unidad_medida;
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div><label>ROL Propiedad</label></div>
											<div class="form-group input-group" id="validar-rol">
												<input class="form-control" type="text" name="rol_propiedad" id="rol_propiedad" placeholder="Rol de la propiedad">
												<span class="input-group-addon" id="resultado-validar-rol">Validar rol</span>
												<input type="hidden" id="is_fail_rol" value="1"></input>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Recepci&oacute;n definitiva municipal</label>
												<select class="form-control" name="is_recepcion_municipal">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>FOJAS</label>
												<input class="form-control" name="inscrito_fojas"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>FOJAS - N&uacute;mero</label>
												<input class="form-control" name="inscrito_numero"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>FOJAS - a&ntilde;o</label>
												<input class="form-control" name="inscrito_ano"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>FOJAS - CBR</label>
												<input class="form-control" name="inscrito_cbr"></input>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Observaciones contrato:</label>
												<textarea class="form-control" id="observaciones_contrato" name="observaciones_contrato" rows="3"></textarea>
											</div>
										</div>
										
										<input type="hidden" name="cod_propiedad" value="<?php echo $propiedad["cod_propiedad"];?>"></input>
										<input type="hidden" name="id_tipo_codigo" value="2"></input>
										
										<div class="col-lg-12">
											<h3>Descripci&oacute;n de la propiedad</h3>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tipo de propiedad:</label>
												<select class="form-control" name="id_tipo_propiedad" id="id_tipo_propiedad">
													<option value="-">Escoja un tipo de propiedad</option>
													<?php
														$sql = "SELECT * FROM tipo_propiedades";
														$cursor = $conexion->query($sql);
														while($tipo_propiedad = $cursor->fetch()){
															$option_tipo_propiedad = "<option value='".$tipo_propiedad["id_tipo_propiedad"]."'";
															if($propiedad["id_tipo_propiedad"] == $tipo_propiedad["id_tipo_propiedad"]){
																$option_tipo_propiedad .= " Selected";
															}
															$option_tipo_propiedad .= ">".utf8_encode($tipo_propiedad["nombre_tipo_propiedad"])."</option>";
															echo $option_tipo_propiedad;
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
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
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Sera administrado?</label>
												<select class="form-control" id="id_administrado" name="id_administrado">
													<option value="0">No</option>
													<option value="1">Si</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Pisos propiedad</label>
												<input class="form-control" name="pisos_propiedad" type="text" value="0"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Contribuciones</label>
												<input class="form-control" name="contribucion_propiedad" type="text"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>A&ntilde;o contrucci&oacute;n</label>
												<input class="form-control" name="ano_construcion_propiedad" type="text"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Gasto Com&uacute;n</label>
												<input class="form-control" name="gasto_comun_propiedad" type="text"></input>
											</div>
										</div>
										
										<div class="col-lg-12">
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
										
										<div id="sector-agregar-nombre-giro" class="col-lg-12 no-show">
											<div class="form-group input-group">
												<input type="text" class="form-control" id="nombre_tipo_giro">
												<span class="input-group-btn">
													<button class="btn btn-default" type="button" id="enviar-nuevo-giro">Agregar nuevo giro
													</button>
												</span>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Regi&oacute;n:</label>
												<select class="form-control" name="id_region" id="id_region">
													<option value="-">Escoja una region</option>
													<?php
														$sql = "SELECT * FROM regiones";
														$cursor = $conexion -> query($sql);
														while($region = $cursor -> fetch()){
															echo "<option value='".$region["id_region"]."'>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Comuna:</label>
												<select class="form-control" name="id_comuna" id="id_comuna">
													<option value="-">Escoja la region primero</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Sector:</label>
												<select class="form-control" name="id_sector" id="id_sector">
													<option value="-">Escoja la comuna primero</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-12">
											<h3>Distribuci&oacute;n de la propiedad</h3>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Living - Comedor <input type="checkbox" name="flag_living_comedor_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Living <input type="checkbox" name="flag_living_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Comedor <input type="checkbox" name="flag_comedor_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Cocina <input type="checkbox" name="flag_cocina_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Comedor diario <input type="checkbox" name="flag_comedor_diario_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Sector de logia <input type="checkbox" name="flag_sector_logia_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Chimenea <input type="checkbox" name="flag_chimenea_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>
													Lavadero <input type="checkbox" name="flag_lavadero_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>N&uacute;mero de habitaciones o privados:</label>
												<input class="form-control" type="text" id="dormitorios_propiedad" name="dormitorios_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													Principal en suite <input type="checkbox" name="flag_principal_suite_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													De servicio <input type="checkbox" name="flag_dormitorio_servicio_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													Walking closet <input type="checkbox" name="flag_walking_closet_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													Clasic <input type="checkbox" name="flag_clasic_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>N&uacute;mero de ba&ntilde;os:</label>
												<input class="form-control" type="text" id="banos_propiedad" name="banos_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													Ba&ntilde;o completo <input type="checkbox" name="flag_bano_completo_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													De servicio <input type="checkbox" name="flag_bano_servicio_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>
													Medio ba&ntilde;o <input type="checkbox" name="flag_medio_bano_propiedad" value="1">
												</label>
											</div>
										</div>
										
										<div class="col-lg-12">
											<h3>Caracter&iacute;sticas</h3>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Estacionamiento:</label>
												<input class="form-control" type="text" id="nro_estacionamiento" name="nro_estacionamiento" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Bodegas:</label>
												<input class="form-control" type="text" id="nro_bodega" name="nro_bodega" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Ante-jard&iacute;n:</label>
												<input class="form-control" type="text" id="flag_antejardin_propiedad" name="flag_antejardin_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Patio trasero:</label>
												<input class="form-control" type="text" id="flag_patio_trasero_propiedad" name="flag_patio_trasero_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Quincho:</label>
												<input class="form-control" type="text" id="flag_quincho_propiedad" name="flag_quincho_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Sala de internet:</label>
												<input class="form-control" type="text" id="flag_sala_internet_propiedad" name="flag_sala_internet_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Juegos infantiles:</label>
												<input class="form-control" type="text" id="flag_juegos_infantiles_propiedad" name="flag_juegos_infantiles_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Piscina temperada:</label>
												<input class="form-control" type="text" id="flag_piscina_temperada_propiedad" name="flag_piscina_temperada_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Piscina:</label>
												<input class="form-control" type="text" id="flag_piscina_propiedad" name="flag_piscina_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Lavanderia:</label>
												<input class="form-control" type="text" id="flag_lavanderia_propiedad" name="flag_lavanderia_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Sal&oacute;n multiuso:</label>
												<input class="form-control" type="text" id="flag_sala_multiuso_propiedad" name="flag_sala_multiuso_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Conserjeria:</label>
												<input class="form-control" type="text" id="flag_conserjeria_propiedad" name="flag_conserjeria_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Gimnasio:</label>
												<input class="form-control" type="text" id="flag_gimnasio_propiedad" name="flag_gimnasio_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Recepci&oacute;n:</label>
												<input class="form-control" type="text" id="flag_recepcion_propiedad" name="flag_recepcion_propiedad" value="0" />
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Observaci&oacute;n de la propiedad (Contrato):</label>
												<textarea class="form-control" name="detalle_contrato_propiedad" id="detalle_contrato_propiedad" rows="3"></textarea>
											</div>
										</div>
										
										<div class="col-lg-12">
											<h3>Datos propiedad para el sitio</h3>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Detalle de la propiedad:</label>
												<textarea class="form-control" name="detalle_propiedad" id="detalle_propiedad" rows="4"></textarea>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 1 (PRINCIPAL) - Obligatorio</label>
												<input type="file" class="img_propiedad" name="img_01_propiedad" id="img_01_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 2 - Obligatorio</label>
												<input type="file" class="img_propiedad" name="img_02_propiedad" id="img_02_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 3 - Obligatorio</label>
												<input type="file" class="img_propiedad" name="img_03_propiedad" id="img_03_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 4 - Obligatorio</label>
												<input type="file" class="img_propiedad" name="img_04_propiedad" id="img_04_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 5</label>
												<input type="file" class="img_propiedad" name="img_05_propiedad" id="img_05_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 6</label>
												<input type="file" class="img_propiedad" name="img_06_propiedad" id="img_06_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 7</label>
												<input type="file" class="img_propiedad" name="img_07_propiedad" id="img_07_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 8</label>
												<input type="file" class="img_propiedad" name="img_08_propiedad" id="img_08_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 9</label>
												<input type="file" class="img_propiedad" name="img_09_propiedad" id="img_09_propiedad">
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Imagen propiedad n&uacute;mero 10</label>
												<input type="file" class="img_propiedad" name="img_10_propiedad" id="img_10_propiedad">
											</div>
										</div>
										
										
										<div class="col-lg-12">
											<h3>Datos solo para el sistema</h3>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Observaciones propietario:</label>
												<textarea class="form-control" id="observaciones_propietario" name="observaciones_propietario" rows="4"></textarea>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Detalle del corredor:</label>
												<textarea class="form-control" name="detalle_corredor" id="detalle_corredor" rows="4"></textarea>
											</div>
										</div>
										
										<div class="col-lg-12">
											<button type="submit" class="btn btn-success">Ingresar propiedad</button>
										</div>
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
		});
		
		$(".img_propiedad").on('change', function() {
		  var totalSize = 0;

		  $(".img_propiedad").each(function() {
			for (var i = 0; i < this.files.length; i++) {
			  totalSize += this.files[i].size;
			}
		  });

		  var valid = totalSize <= 8400000;
		  if (!valid){ 
			alert('Esta sobre la capacidad maxima de archivos para subir, intente con archivos mas ligeros.');
			$(this).val('');
		  }
		});
		
		/*
		var _URL = window.URL || window.webkitURL;
		$("#img_01_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_01_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_02_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_02_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_03_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_03_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_04_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_04_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_05_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_05_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_06_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_06_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_07_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_07_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_08_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_08_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_09_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_09_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		
		$("#img_10_propiedad").change(function (e) {
			var file, img;
			if ((file = this.files[0])) {
				img = new Image();
				img.onload = function () {
					if(this.width < this.height){
						alert('Propiedad no valida por ser vertical, favor cambiarlo por uno horizontal');
						$("#img_10_propiedad").val("");
					}
				};
				img.src = _URL.createObjectURL(file);
			}
		});
		*/
		
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
		
		$("#form-editar-propiedad").submit(function(){	
			var validar = true;
			var mensaje_error = "";
			
			if($("#rol_propiedad").val() == "" || $("#resultado-validar-rol").html() != "Esta Libre"){
				validar = false;
				mensaje_error += "Ingrese el rol apropiado de la propiedad.\n";
			}
			
			if($("#observaciones_propietario").val() == ""){
				validar = false;
				mensaje_error += "Ingrese informacion a las observaciones del propietario.\n";
			}
			
			if($("#id_tipo_operacion").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese el tipo de operacion de la propiedad.\n";
			}
			
			if($("#id_tipo_propiedad").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese el tipo de propiedad.\n";
			}
			
			if($("#id_region").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese la region en la que se encuentra esta propiedad.\n";
			}
			
			if($("#id_comuna").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese la comuna en la que se encuentra esta propiedad.\n";
			}
			
			if($("#id_sector").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese el sector en la que se encuentra esta propiedad.\n";
			}
			
			if($("#direccion_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese la direccion de la propiedad.\n";
			}
			
			if($("#valor").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el valor de la propiedad.\n";
			}
			
			if($("#dormitorios_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el numero de propiedades de la propiedad.\n";
			}
			
			if($("#banos_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el numero de ba\u00f1os de la propiedad.\n";
			}
			
			if($("#nro_estacionamiento").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el numero de estacionamientos de la propiedad.\n";
			}
			
			if($("#nro_bodega").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el numero de bodegas de la propiedad.\n";
			}
			
			if($("#cantidad_superficie_total_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese la superficie total de la propiedad.\n";
			}
			
			if($("#cantidad_superficie_construida_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese la superficie construida de la propiedad.\n";
			}
			
			if($("#id_undidad_medida").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese que tipo de medida se usa para las superficies.\n";
			}
			
			if($("#detalle_propiedad").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el detalle de la propiedad.\n";
			}
			
			//if($("#img_01_propiedad").val() != ""){
			//	var iSize = ($("#img_01_propiedad")[0].files[0].size / 1024);
			//	iSize = (Math.round((iSize / 1024) * 100) / 100);
			//	
			//	if(iSize > 6){
			//		validar = false;
			//		mensaje_error += "Imagen nro 01 exede los 6 Mb.\n";
			//	}
			//	
			//}else{
			//	validar = false;
			//	mensaje_error += "Imagen nro 01 requiere un archivo asignado.\n";
			//}
			//
			//if($("#img_02_propiedad").val() != ""){
			//	var iSize = ($("#img_02_propiedad")[0].files[0].size / 1024);
			//	iSize = (Math.round((iSize / 1024) * 100) / 100);
			//	
			//	if(iSize > 6){
			//		validar = false;
			//		mensaje_error += "Imagen nro 02 exede los 6 Mb.\n";
			//	}
			//}else{
			//	validar = false;
			//	mensaje_error += "Imagen nro 02 requiere un archivo asignado.\n";
			//}
			//
			//if($("#img_03_propiedad").val() != ""){
			//	var iSize = ($("#img_03_propiedad")[0].files[0].size / 1024);
			//	iSize = (Math.round((iSize / 1024) * 100) / 100);
			//	
			//	if(iSize > 6){
			//		validar = false;
			//		mensaje_error += "Imagen nro 03 exede los 6 Mb.\n";
			//	}
			//}else{
			//	validar = false;
			//	mensaje_error += "Imagen nro 03 requiere un archivo asignado.\n";
			//}
			//
			//if($("#img_04_propiedad").val() != ""){
			//	var iSize = ($("#img_04_propiedad")[0].files[0].size / 1024);
			//	iSize = (Math.round((iSize / 1024) * 100) / 100);
			//	
			//	if(iSize > 6){
			//		validar = false;
			//		mensaje_error += "Imagen nro 04 exede los 6 Mb.\n";
			//	}
			//}else{
			//	validar = false;
			//	mensaje_error += "Imagen nro 04 requiere un archivo asignado.\n";
			//}
			
			if($("#img_05_propiedad").val() != ""){
				var iSize = ($("#img_05_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 05 exede los 6 Mb.\n";
				}
			}
			
			if($("#img_06_propiedad").val() != ""){
				var iSize = ($("#img_06_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 06 exede los 6 Mb.\n";
				}
			}
			
			if($("#img_07_propiedad").val() != ""){
				var iSize = ($("#img_07_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 07 exede los 6 Mb.\n";
				}
			}
			
			if($("#img_08_propiedad").val() != ""){
				var iSize = ($("#img_08_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 08 exede los 6 Mb.\n";
				}
			}
			
			if($("#img_09_propiedad").val() != ""){
				var iSize = ($("#img_09_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 09 exede los 6 Mb.\n";
				}
			}
			
			if($("#img_10_propiedad").val() != ""){
				var iSize = ($("#img_10_propiedad")[0].files[0].size / 1024);
				iSize = (Math.round((iSize / 1024) * 100) / 100);
				
				if(iSize > 6){
					validar = false;
					mensaje_error += "Imagen nro 10 exede los 6 Mb.\n";
				}
			}
			
			if(validar == false){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
	
		function number_format (number, decimals, dec_point, thousands_sep) {
			// Strip all characters but numerical ones.
			number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
			var n = !isFinite(+number) ? 0 : +number,
				prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
				sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
				dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
				s = '',
				toFixedFix = function (n, prec) {
					var k = Math.pow(10, prec);
					return '' + Math.round(n * k) / k;
				};
			// Fix for IE parseFloat(0.55).toFixed(0) = 0;
			s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
			if (s[0].length > 3) {
				s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
			}
			if ((s[1] || '').length < prec) {
				s[1] = s[1] || '';
				s[1] += new Array(prec - s[1].length + 1).join('0');
			}
			return s.join(dec);
		}
		
		$(document).ready(function(){
			$(".format_precio").keyup(function() {
				$(this).val("$"+number_format($(this).val()));
			});
		})
		
		$("#rol_propiedad").keyup(function(){
			$.ajax({
				url: "../php/validar_rol.php",
				type: "POST",
				data: {
					rol_propiedad:$(this).val()
				},
				cache: false,
				success: function(response) {
					/*
					if(response == "S"){
						$("#validar-rol").removeClass("has-error");
						$("#validar-rol").addClass("has-success");
						$("#resultado-validar-rol").html("Rol valido");
						$("#is_fail_rol").val("0");
					}else if(response == "E"){
						$("#validar-rol").addClass("has-error");
						$("#validar-rol").removeClass("has-success");
						$("#resultado-validar-rol").html("Rol no valido");
						$("#is_fail_rol").val("1");
					}else{
						$("#validar-rol").removeClass("has-error");
						$("#validar-rol").removeClass("has-success");
						$("#resultado-validar-rol").html("Validar rol");
						$("#is_fail_rol").val("1");
					}
					*/
					$("#resultado-validar-rol").html(response);
				},
			})
			
		});
	</script>
</body>

</html>

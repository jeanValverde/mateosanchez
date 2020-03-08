<?php
	require_once('codigo_recurrente.php');
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
                    <h1 class="page-header">Crear contrato temporada</h1>
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
                            Datos requeridos para el nuevo contrato, existe las siguientes excepciones:
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<form role="form" id="form-crear-contrato-temporada" method="post" action="../php/crear_contrato_temporada.php" enctype="multipart/form-data" target="_blank">
										<input type="hidden" name="id_propiedad" value="<?php echo $_GET["id_propiedad"]; ?>"></input>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Fecha contrato</label>
												<input class="form-control" type="date" id="fecha_contrato_temporada" name="fecha_contrato_temporada" value="<?php echo date('Y-m-d'); ?>"></input>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Nombre arrendatario</label>
												<input class="form-control" type="text" id="nombre_arrendatario_contrato_temporada" name="nombre_arrendatario_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Rut arrendatario</label>
												<input class="form-control" type="text" id="rut_arrendatario_contrato_temporada" name="rut_arrendatario_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Nombre arrendador</label>
												<input class="form-control" type="text" id="nombre_arrendador_contrato_temporada" name="nombre_arrendador_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Rut arrendador</label>
												<input class="form-control" type="text" id="rut_arrendador_contrato_temporada" name="rut_arrendador_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Tipo de identificaci&oacute;n:</label>
												<select class="form-control" id="id_tipo_identificacion" name="id_tipo_identificacion">
													<option value="1">C&eacute;dula de identidad</option>
													<option value="2">Pasaporte</option>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Domicilio arrendatario</label>
												<input class="form-control" type="text" id="domicilio_arrendatario_contrato_temporada" name="domicilio_arrendatario_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Ciudad arrendatario</label>
												<input class="form-control" type="text" id="ciudad_arrendatario_contrato_temporada" name="ciudad_arrendatario_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Pais arrendatario</label>
												<input class="form-control" type="text" id="pais_arrendatario_contrato_temporada" name="pais_arrendatario_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-8">
											<div class="form-group">
												<label>Direcci&oacute;n propiedad</label>
												<input class="form-control" type="text" id="domicilio_propiedad_contrato_temporada" name="domicilio_propiedad_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Numeraci&oacute;n propiedad</label>
												<input class="form-control" type="number" id="nro_domicilio_propiedad_contrato_temporada" name="nro_domicilio_propiedad_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Comuna propiedad</label>
												<input class="form-control" type="text" id="comuna_propiedad_contrato_temporada" name="comuna_propiedad_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Sector propiedad</label>
												<input class="form-control" type="text" id="sector_propiedad_contrato_temporada" name="sector_propiedad_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>N&uacute;mero estacionamiento propiedad</label>
												<input class="form-control" type="number" id="nro_estacionamiento_contrato_temporada" name="nro_estacionamiento_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Fecha inicio estad&iacute;a</label>
												<input class="form-control" type="date" name="fecha_contrato_cliente_inicio" id="fecha_contrato_cliente_inicio" value="<?php echo date('Y-m-d'); ?>"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Hora de inicio estad&iacute;a:</label>
												<select class="form-control" id="hora_inicio_arriendo_contrato_temporada" name="hora_inicio_arriendo_contrato_temporada">
													<option value="-">Escoja una hora</option>
													<?php
														$contador = 0;
														while($contador <= 24){
															echo "<option value='".$contador.":00 Hrs'>".$contador.":00 Hrs</option>";
															$contador += 1;
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Fecha fin estad&iacute;a</label>
												<input class="form-control" type="date" name="fecha_contrato_cliente_fin" id="fecha_contrato_cliente_fin" value="<?php echo date('Y-m-d'); ?>"></input>
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<label>Hora de fin estad&iacute;a:</label>
												<select class="form-control" id="hora_fin_arriendo_contrato_temporada" name="hora_fin_arriendo_contrato_temporada">
													<option value="-">Escoja una hora</option>
													<?php
														$contador = 0;
														while($contador <= 24){
															echo "<option value='".$contador.":00 Hrs'>".$contador.":00 Hrs</option>";
															$contador += 1;
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Monto total del arriendo</label>
												<input class="form-control" type="text" id="monto_arriendo_contrato_temporada" name="monto_arriendo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Monto reserva arriendo</label>
												<input class="form-control" type="text" id="monto_reserva_arriendo_contrato_temporada" name="monto_reserva_arriendo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Monto comisi&oacute;n arriendo</label>
												<input class="form-control" type="text" id="monto_comision_arriendo_contrato_temporada" name="monto_comision_arriendo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Monto aseo arriendo</label>
												<input class="form-control" type="text" id="monto_aseo_arriendo_contrato_temporada" name="monto_aseo_arriendo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Monto traslado arriendo</label>
												<input class="form-control" type="text" id="monto_traslado_arriendo_contrato_temporada" name="monto_traslado_arriendo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Marca veh&iacute;culo</label>
												<input class="form-control" type="text" id="marca_vehiculo_contrato_temporada" name="marca_vehiculo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Modelo veh&iacute;culo</label>
												<input class="form-control" type="text" id="modelo_vehiculo_contrato_temporada" name="modelo_vehiculo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>Placa veh&iacute;culo</label>
												<input class="form-control" type="text" id="placa_vehiculo_contrato_temporada" name="placa_vehiculo_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>N&uacute;mero de arrendatarios</label>
												<input class="form-control" type="number" id="nro_arrendatarios_contrato_temporada" name="nro_arrendatarios_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>N&uacute;mero de adultos</label>
												<input class="form-control" type="number" id="nro_adultos_contrato_temporada" name="nro_adultos_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												<label>N&uacute;mero de ni&ntilde;os</label>
												<input class="form-control" type="number" id="nro_ninos_contrato_temporada" name="nro_ninos_contrato_temporada" />
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Datos arrendatario(s)</label>
											</div>
										</div>
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<!--arrendatario n2-->
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<!--arrendatario n3-->
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<!--arrendatario n4-->
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<!--arrendatario n5-->
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<!--arrendatario n6-->
										
										<div class="col-lg-5">
											<div class="form-group">
												<input class="form-control" type="text" id="nombre_persona_contrato_temporada" name="nombre_persona_contrato_temporada[]" placeholder="Nombre..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="text" id="rut_persona_contrato_temporada" name="rut_persona_contrato_temporada[]" placeholder="Rut..." />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<input class="form-control" type="number" id="edad_persona_contrato_temporada" name="edad_persona_contrato_temporada[]" placeholder="Edad..." />
											</div>
										</div>
										
										<div class="col-lg-3">
											<div class="form-group">
												<input class="form-control" type="text" id="nacionalidad_persona_contrato_temporada" name="nacionalidad_persona_contrato_temporada[]" placeholder="Nacionalidad..." />
											</div>
										</div>
										
										<div class="col-lg-12">
											<button type="submit" class="btn btn-success">Crear contrato</button>
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
	
	<script>
		$("#form-crear-contrato-temporada").submit(function(){
			var mensaje_error = "";
			
			if($("#fecha_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Fecha de la creacion del contrato.\n";
			}
			
			if($("#nombre_arrendador_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Nombre del arrendador de la propiedad.\n";
			}
			
			if($("#rut_arrendador_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Rut del arrendador de la propiedad.\n";
			}
			
			if($("#nombre_arrendatario_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Nombre del arrendatario.\n";
			}
			
			if($("#rut_arrendatario_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Rut o Pasaporte del arrendatario.\n";
			}
			
			if($("#domicilio_arrendatario_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Domicilio del arrendatario.\n";
			}
			
			if($("#ciudad_arrendatario_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Ciudad del arrendatario.\n";
			}
			
			if($("#pais_arrendatario_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Pais del arrendatario.\n";
			}
			
			if($("#domicilio_propiedad_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Direccion de la propiedad a arrendar.\n";
			}
			
			if($("#nro_domicilio_propiedad_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Numeracion de la propiedad.\n";
			}
			
			if($("#comuna_propiedad_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Comuna de la propiedad.\n";
			}
			
			if($("#sector_propiedad_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Sector de la propiedad.\n";
			}
			
			if($("#nro_estacionamiento_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Cantidad de estacionamientos que vienen con la propiedad.\n";
			}
			
			if($("#fecha_contrato_cliente_inicio").val() == ""){
				mensaje_error += "Falta dato: Fecha en la que los arrendatarios llegan a la propiedad.\n";
			}
			
			if($("#hora_inicio_arriendo_contrato_temporada").val() == "-"){
				mensaje_error += "Falta dato: Hora de entrada de los arrendatarios.\n";
			}
			
			if($("#fecha_contrato_cliente_fin").val() == ""){
				mensaje_error += "Falta dato: Fecha en la que los arrendatarios salen de la propiedad.\n";
			}
			
			if($("#hora_fin_arriendo_contrato_temporada").val() == "-"){
				mensaje_error += "Falta dato: Hora de salida de los arrendatarios.\n";
			}
			
			if($("#monto_arriendo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Monto total del arriendo.\n";
			}
			
			if($("#monto_reserva_arriendo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Monto por reserva de la propiedad.\n";
			}
			
			if($("#monto_comision_arriendo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Monto de la comision por el contrato.\n";
			}
			
			if($("#monto_aseo_arriendo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Monto por el servicio de aseo en la propiedad.\n";
			}
			
			if($("#monto_traslado_arriendo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Monto del servicio de traslado.\n";
			}
			
			if($("#marca_vehiculo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Marca del vehiculo que se entregara por arriendo (Si no existe poner No aplicable).\n";
			}
			
			if($("#modelo_vehiculo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Modelo del vehiculo que se entrega por arriendo (Si no existe poner No aplicable).\n";
			}
			
			if($("#placa_vehiculo_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Placa del vehiculo que se entrega por arriendo (Si no existe poner No aplicable).\n";
			}
			
			if($("#nro_arrendatarios_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Cantidad de personas que son consideradas para la propiedad.\n";
			}
			
			if($("#nro_adultos_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Cantidad de adultos dentro del total de personas consideradas.\n";
			}
			
			if($("#nro_ninos_contrato_temporada").val() == ""){
				mensaje_error += "Falta dato: Cantidad de menores de edad dentro del total de personas consideradas.\n";
			}
			
			//var cant = 0;
			//var mensaje_array = "";
			//
			//$("input[name^='nombre_persona_contrato_temporada']").each(function() {
			//	if($(this).val() == "") {
			//		isValid = 0;
			//	}
			//	mensaje_array += $(this).val() + " - " + $("input[name^='rut_persona_contrato_temporada']").text(this.text()).get(0);
			//	cant = cant + 1;
			//	mensaje_array += "\n";
			//});
			
			if(mensaje_error != ""){
				//alert(mensaje_array);
				alert(mensaje_error);
				event.preventDefault();
			}
		});
	</script>
</body>

</html>

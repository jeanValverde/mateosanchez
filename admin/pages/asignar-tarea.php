<?php
	require_once('codigo_recurrente.php');
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
                    <h1 class="page-header">Asignar tarea</h1>
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
                            Datos requeridos para la nueva tarea, existe las siguientes excepciones:
							<ul>
								<li>Las tareas empiezan desde la semana misma en la que se crea la tarea.</li>
								<li>Las iteraciones son para saber cuantas semanas se aplica esta tarea, para dejar semanas de descanso entre semana de tarea agregar el intercalado.</li>
								<li>Cuando se agrega una nueva tarea a la bateria solo se agrega el nombre, la descripci&oacute;n es para la tarea asignada para la persona en cuestion.</li>
							</ul>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
									<form role="form" id="form-asignar-tarea" method="post" action="../php/asignar_tarea.php">
									
										<div class="col-lg-12">
											<div class="form-group">
												<label>Persona objetivo:</label>
												<select class="form-control" id="id_cuenta" name="id_cuenta">
													<option value="-">Escoja la persona</option>
													<?php
														$sql_cuenta = "SELECT * FROM cuentas WHERE is_banned = 0";
														$cursor_cuenta = $conexion -> query($sql_cuenta);
														while($cuenta = $cursor_cuenta -> fetch()){
															echo "<option value='".$cuenta["id_cuenta"]."'>".utf8_encode($cuenta["nombre_persona"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-8">
											<div class="form-group">
												<label>D&iacute;as:</label>
												<div class="checkbox">
													<label>
														<input class="validar_dia" type="checkbox" name="lunes_tarea" value="1">Lunes
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="martes_tarea" value="1">Martes
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="miercoles_tarea" value="1">Miercoles
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="jueves_tarea" value="1">Jueves
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="viernes_tarea" value="1">Viernes
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="sabado_tarea" value="1">Sabado
													</label>
													<label>
														<input class="validar_dia" type="checkbox" name="domingo_tarea" value="1">Domingo
													</label>
												</div>
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Iteraci&oacute;n:</label>
												<input class="form-control" type="number" id="iteracion_tarea" name="iteracion_tarea" value="1" />
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												<label>Intercalar cada:</label>
												<input class="form-control" type="number" id="intercalar_tarea" name="intercalar_tarea" value="0" />
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tarea:</label>
												<select class="form-control" name="id_tarea" id="id_tarea">
													<option value="-">Escoja una tarea</option>
													<?php
														$sql = "SELECT * FROM tareas";
														$cursor = $conexion->query($sql);
														while($tarea = $cursor->fetch()){
															echo "<option value='".$tarea["id_tarea"]."'>".utf8_encode($tarea["nombre_tarea"])."</option>";
														}
													?>
												</select>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nuevo:</label>
												<input class="form-control" type="text" id="nueva_tarea" name="nueva_tarea" />
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="form-group">
												<label>Descripci&oacute;n general:</label>
												<textarea class="form-control" id="descripcion_tarea" name="descripcion_tarea" rows="4"></textarea>
											</div>
										</div>
										
										<div class="col-lg-12">
											<button type="reset" class="btn btn-danger">Limpiar formulario</button>
											<button type="submit" class="btn btn-success pull-right">Asignar tarea</button>
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
		$("#form-asignar-tarea").submit(function(){	
			var validar = true;
			var mensaje_error = "";
			
			if($("#id_cuenta").val() == "-"){
				validar = false;
				mensaje_error += "Asigne a una persona especifica.\n";
			}
			
			if(!$('.validar_dia').is(":checked")){
				validar = false;
				mensaje_error += "Especifique dias de la semana para la tarea.\n";
			}
			
			if($("#id_tarea").val() == "-" && $("#nueva_tarea").val() == ""){
				validar = false;
				mensaje_error += "Asignar una tarea para la persona.\n";
			}
			
			if(validar == false){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
	</script>
</body>

</html>

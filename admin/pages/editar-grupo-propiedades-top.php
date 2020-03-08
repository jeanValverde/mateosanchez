 <?php
	require_once('codigo_recurrente.php');
	$is_fail = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once('shared-code.php'); ?>

	<style>
		.expanded{
			width: 100%;
			margin-bottom: 10px;
		}
	</style>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php require_once('header.php');?>

            <?php require_once('sidebar.php');?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editar grupo de propiedades Top</h1>
                </div>
            </div>
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
							Datos requeridos del nuevo grupo Top
						</div>
						<div class="panel-body">
							<div class="row">
								<?php
								if(isset($_GET["id_grupo_propiedad"]) && !empty($_GET["id_grupo_propiedad"])){
									$id_grupo_propiedad = $_GET["id_grupo_propiedad"];
									$sql_grupo = "SELECT * FROM grupos_propiedades_top WHERE id_grupo_propiedad = '".$id_grupo_propiedad."'";
									$cursor_grupo = $conexion -> query($sql_grupo);

									if(!$validar_grupo = $cursor_grupo -> rowCount()){
										$validar_grupo = 0;
									}

									if($validar_grupo == 1){
										$grupo = $cursor_grupo -> fetch();
										?>
										<form role="form" action="../php/editar_grupo_propiedades_top.php" method="post" id="editar-grupo-propiedades" enctype="multipart/form-data">
											<input type="hidden" name="id_grupo_propiedad" value="<?php echo $grupo["id_grupo_propiedad"]; ?>">

											<div class="col-lg-12">
												<h4>Datos del grupo</h4>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label>Titulo Grupo</label>
													<input class="form-control" id="titulo_grupo_propiedad" name="titulo_grupo_propiedad" value="<?php echo utf8_encode($grupo["titulo_grupo_propiedad"]); ?>">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label>Imagen REFERENCIAL</label>
													<input type="file" name="img_grupo_propiedad" id="img_grupo_propiedad">
													<img src="../../grupo-propiedades/<?php echo $grupo["img_grupo_propiedad"]; ?>" style="width: 100%;">
												</div>
											</div>

											<div class="col-lg-6">
												<div class="form-group">
													<label>Detalle del grupo:</label>
													<textarea class="form-control" name="detalle_grupo_propiedad" id="detalle_grupo_propiedad" rows="15" value="<?php echo $grupo["detalle_grupo_propiedad"]; ?>"><?php echo $grupo["detalle_grupo_propiedad"]; ?></textarea>
												</div>
											</div>

											<?php
												$sql_propiedad = "SELECT * FROM codigos_grupos_propiedades WHERE id_grupo_propiedad = '".$id_grupo_propiedad."'";
												$cursor_propiedad = $conexion -> query($sql_propiedad);
												if(!$validar_propiedad = $cursor_propiedad -> rowCount()){
													$validar_propiedad = 0;
												}

												if($validar_propiedad > 0){
													?>
													<div class="col-lg-12">
														<h4>Propiedades adjuntas</h4>
													</div>
													<?php
													while($propiedad = $cursor_propiedad -> fetch()){
														?>
														<div class="col-lg-2">
															<a target="_blank" href="../../propiedades-comercial/ficha-propiedad-top.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"]; ?>" class="btn btn-default"><?php echo $propiedad["cod_propiedad"]; ?></a>
															<a href="../php/soltar_propiedad_grupo_top.php?id_grupo_propiedad=<?php echo $grupo["id_grupo_propiedad"]; ?>&cod_propiedad=<?php echo $propiedad["cod_propiedad"]; ?>" class="btn btn-danger" onclick="return confirm('Esta seguro?');">X</a>
														</div>
														<?php
													}
												}

											?>

											<div class="col-lg-2">
												<a href="#" class="btn btn-primary" data-codigo="<?php echo $grupo["id_grupo_propiedad"]; ?>" data-toggle="modal" data-target="#myModal">Lista propiedades</a>
											</div>

											<div class="col-lg-12">
												<hr>
											</div>

											<div class="col-lg-12">
												<h4>Datos fijos para la(s) propiedad(s)</h4>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label>Region:</label>
													<select class="form-control" id="id_region" name="id_region">
														<option value="-">Seleccionar</option>
														<?php
														$sql_region = "SELECT * FROM regiones";
														$cursor_region = $conexion -> query($sql_region);
														while($region = $cursor_region -> fetch()){
															?>
															<option value="<?php echo $region["id_region"]; ?>"><?php echo utf8_encode($region["nombre_region"]); ?></option>
															<?php
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Comuna:</label>
													<select class="form-control" id="id_comuna" name="id_comuna">
														<option value="-">Seleccionar</option>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label>Sector:</label>
													<select class="form-control" id="id_sector" name="id_sector">
														<option value="-">Seleccionar</option>
													</select>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label>Tipo propiedad</label>
													<select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
														<option value="-">Seleccione</option>
														<?php
														$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY nombre_tipo_propiedad ASC";
														$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
														while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
															?>
															<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"]; ?>"><?php echo utf8_encode($tipo_propiedad["nombre_tipo_propiedad"]); ?></option>
															<?php
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label>Tipo giro</label>
													<select class="form-control" name="id_tipo_giro" id="id_tipo_giro">
														<option value="-">Seleccione</option>
														<?php
														$sql_tipo_giro = "SELECT * FROM tipo_giros ORDER BY nombre_tipo_giro ASC";
														$cursor_tipo_giro = $conexion -> query($sql_tipo_giro);
														while($tipo_giro = $cursor_tipo_giro -> fetch()){
															?>
															<option value="<?php echo $tipo_giro["id_tipo_giro"]; ?>"><?php echo utf8_encode($tipo_giro["nombre_tipo_giro"]); ?></option>
															<?php
														}
														?>
													</select>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="form-group">
													<label>Imagen Principal</label>
													<input type="file" class="img_propiedad" name="img_01_propiedad" id="img_01_propiedad">
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<label>Detalle para las propiedades:</label>
													<textarea class="form-control" name="detalle_propiedad" id="detalle_propiedad" rows="5"></textarea>
												</div>
											</div>

											<div class="col-lg-12">
												<hr>
											</div>

											<div class="col-lg-12">
												<h4>Datos dinamicos para la(s) propiedad(s)</h4>
											</div>

											<div id="listado_propiedades">

											</div>

											<div class="col-lg-12">
												<button type="button" class="btn btn-success pull-left" id="btn_agregar_linea_propiedad">Agregar propiedad</button>
											</div>

											<div class="col-lg-12">
												<button type="submit" class="btn btn-primary pull-right">Editar Grupo</button>
											</div>
										</form>
										<?php
									}else{
										?>
										<p>Grupo de propiedades no encontrado, favor intentar nuevamente...</p>
										<?php
									}
								}else{
									?>
									<p>Grupo de propiedades no asignado o vacio, favor intentar nuevamente...</p>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Listado de Propiedades</h4>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tipo</th>
                                            <th>Operaci&oacute;n</th>
                                            <th>Direcci&oacute;n</th>
											<th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_propiedad = "SELECT * FROM propiedades ";
										$sql_propiedad .= "INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad = tipo_propiedades.id_tipo_propiedad ";
										$sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
										$sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
										$sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
										$sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
										$sql_propiedad .= "INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta ";
										$sql_propiedad .= "WHERE is_hidden = 0 ";
										if($_COOKIE["nivel_cuenta"] == 3){
											if($_COOKIE["id_cuenta"] == 14){//Cuenta litty.kuschel@mateosanchez.cl
												$sql_propiedad .= "AND (propiedades.id_comuna = 29 OR propiedades.id_sector = 12 OR propiedades.id_sector = 237) ";
											}else{
												$sql_propiedad .= "AND cuentas.id_franquicia = '".$_COOKIE["id_franquicia"]."' ";
											}
										}elseif($_COOKIE["id_cuenta"] == 19 || $_COOKIE["id_cuenta"] == 3 || $_COOKIE["id_cuenta"] == 23){
											//$sql_propiedad .= "AND (propiedades.id_tipo_giro = 1 ";
											//$sql_propiedad .= "OR propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."') ";
										}elseif($_COOKIE["nivel_cuenta"] == 4){
											$sql_propiedad .= "AND propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."' ";
										}
										$sql_propiedad .= "ORDER BY id_propiedad DESC";
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										while($propiedad = $cursor_propiedad -> fetch()){
										?>
										<tr>
                                            <td><?php echo $propiedad["cod_propiedad"];?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></td>
                                            <td><?php echo $propiedad["direccion_propiedad"];?></td>
											<td><a href="../php/anexar_propiedad_grupo_propiedad_top.php?id_grupo_propiedad=<?php echo $grupo["id_grupo_propiedad"]; ?>&cod_propiedad=<?php echo $propiedad["cod_propiedad"]; ?>">Anexar al grupo</a></td>
                                        </tr>
										<?php
										}
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php
		require_once('librerias-js.php');
	?>

	<!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
					responsive: true,
					order: [[ 0, "desc" ]]
			});
		});
    </script>

	<script>

        $('#editar-grupo-propiedades').on('change', '#id_region', function(){
            $.ajax({
			    type: "POST",
			    url: "../php/selector_comuna.php",
			    data: {id: $('#id_region').val()},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#id_comuna').html(html);
			    }
			});
        })

        $('#editar-grupo-propiedades').on('change', '#id_comuna', function(){
            $.ajax({
			    type: "POST",
			    url: "../php/selector_sector.php",
			    data: {id: $('#id_comuna').val()},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#id_sector').html(html);
			    }
			});
        })

        $('#editar-grupo-propiedades').on('click', '#btn_agregar_linea_propiedad', function(){
        	//alert('Se agrega una nueva linea de propiedad, si necesita quitarla hacerle click a ');
        	$.ajax({
			    type: "POST",
			    url: "../php/agregar_linea_propiedad_grupo.php",
			    data: {},
			    cache: false,
			    beforeSend: function () {

			    },
			    success: function(html){
			        $('#listado_propiedades').append(html);
			    }
			});
        });

        $('#editar-grupo-propiedades').on('click', '.btn_quitar_linea_propiedad', function(){
        	$(this).parent().parent().parent().remove();
        });

        $( "#editar-grupo-propiedades" ).submit(function( event ) {
		  var valid = true,
		  message = 'Falta ingresar los siguientes datos para comenzar.\n';
		  var has_propiedad = 1;

		  if($('.id_tipo_operacion').val()){
			$(".id_tipo_operacion").each(function() {
			    var element = $(this);
			    if (element.val() == "-") {
			        valid = false;
			        message += 'Tipo operacion.\n';
			        has_propiedad = 0;
			    }
			 });
		  }else{
			has_propiedad = 0;
		  }

		  $(".direccion_propiedad").each(function() {
		     var element = $(this);
		     if (element.val() == "") {
		         valid = false;
		         message += 'Direccion de propiedad.\n';
		         has_propiedad = 0;
		     }
		  });

		  $(".valor_propiedad").each(function() {
		     var element = $(this);
		     if (element.val() == "") {
		         valid = false;
		         message += 'Valor de propiedad.\n';
		         has_propiedad = 0;
		     }
		  });

		  $(".cantidad_superficie_construida_propiedad").each(function() {
		     var element = $(this);
		     if (element.val() == "") {
		         valid = false;
		         message += 'Superficie de la propiedad.\n';
		         has_propiedad = 0;
		     }
		  });

		  if(has_propiedad == 1){
		  	if($('#id_region').val() == '-'){
		  	  valid = false;
		      message += 'Region.\n';
		  	}

		  	if($('#id_comuna').val() == '-'){
		  	  valid = false;
		      message += 'Comuna.\n';
		  	}

		  	if($('#id_tipo_propiedad').val() == '-'){
		  		valid = false;
		  		message += 'Tipo propiedad.\n';
		  	}

		  	if($('#id_tipo_giro').val() == '-'){
		  		valid = false;
		  		message += 'Tipo giro.\n';
		  	}

		  	$(".img_propiedad").on('change', function() {
			  var totalSize = 0;

			  $(".img_propiedad").each(function() {
				for (var i = 0; i < this.files.length; i++) {
				  totalSize += this.files[i].size;
				}
			  });

			  var valid = totalSize <= 5000000;
			  if (!valid){
				alert('Esta sobre la capacidad maxima de archivos para subir, intente con archivos mas ligeros.');
				$(this).val('');
			  }
			});

		  	if($('#detalle_propiedad').val() == ''){
		  		valid = false;
		  		message += 'Detalle para la propiedad.\n';
		  	}
		  }

		  if(valid == false) {
		    alert(message);
		    event.preventDefault();
		  }

		});
    </script>


</body>

</html>

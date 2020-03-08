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
            <?php require_once('header.php');?>

            <?php require_once('sidebar.php');?>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Marcadores</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php
										$sql_propiedad = "SELECT * FROM propiedades ";
										$sql_propiedad .= "WHERE is_hidden = 0 ";
										$sql_propiedad .= "ORDER BY id_propiedad";
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										$cant_propiedad = $cursor_propiedad -> rowCount();
										echo $cant_propiedad;
										?>
									</div>
                                    <div>Prop publicadas</div>
                                </div>
                            </div>
                        </div>
                        <a href="ver-propiedades.php?is_hidden=0">
                            <div class="panel-footer">
                                <span class="pull-left">Ver propiedades</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php
										$sql_prospecto = "SELECT * FROM prospectos ";
										$sql_prospecto .= "ORDER BY id_prospecto";
										$cursor_prospecto = $conexion -> query($sql_prospecto);
										$cant_prospecto = $cursor_prospecto -> rowCount();
										echo $cant_prospecto;
										?>
									</div>
                                    <div>Prop ofrecidas</div>
                                </div>
                            </div>
                        </div>
                        <a href="ver-prospectos.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php
										$sql_propiedad_oferta = "SELECT * FROM propiedades ";
										$sql_propiedad_oferta .= "WHERE is_hidden = 0 ";
										$sql_propiedad_oferta .= "AND is_oferta = 1 ";
										$sql_propiedad_oferta .= "ORDER BY id_propiedad";
										$cursor_propiedad_oferta = $conexion -> query($sql_propiedad_oferta);
										$cant_propiedad_oferta = $cursor_propiedad_oferta -> rowCount();
										echo $cant_propiedad_oferta;
										?>
									</div>
                                    <div>Prop en oferta</div>
                                </div>
                            </div>
                        </div>
                        <a href="ver-propiedades.php?is_hidden=0">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
									<?php
									$sql_peticion = "SELECT * FROM peticiones WHERE is_close=0 ORDER BY fecha_inscripcion_peticion DESC";
									$cursor_peticion = $conexion -> query($sql_peticion);
									$peticion = $cursor_peticion -> rowCount();
									echo $peticion;
									?>
									</div>
                                    <div>Peticiones</div>
                                </div>
                            </div>
                        </div>
						
                        <a href="ver-avisos.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				-->
				
				<!--
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo</th>
									<th>Operaci&oacute;n</th>
									<th>Comuna</th>
									<th>Sector</th>
									<th>Valor</th>
									<th>Fecha</th>
									<th>Captador</th>
									
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
								$sql_propiedad .= "WHERE is_hidden = 0 AND img_01_propiedad <> 'imagen-referencial.png'";
								$sql_propiedad .= "ORDER BY id_propiedad DESC LIMIT 100 ";
								$cursor_propiedad = $conexion -> query($sql_propiedad);
								while($propiedad = $cursor_propiedad -> fetch()){
								?>
								<tr>
									<td><a target="_blank" href="http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"><?php echo $propiedad["cod_propiedad"];?></a></td>
									<td><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?></td>
									<td><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></td>
									<td><?php echo utf8_encode($propiedad["nombre_comuna"]);?></td>
									<td><?php echo utf8_encode($propiedad["nombre_sector"]);?></td>
									<td><?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></td>
									<td><?php echo invertirFecha($propiedad["fecha_publicacion_propiedad"]); ?></td>
									<td><?php echo $propiedad["nombre_persona"];?></td>
									
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>

						<table>
						 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
							
								<tr>
								  
									<th>Captador</th>
									<th>Completadas</th>
									<th>Pendientes</th>
									
								</tr>
							</thead>
							<tbody>
								  <?php
								$sql_propiedad = "SELECT * FROM cuentas ";
								$sql_propiedad .= "INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_cuenta ";
								//$sql_propiedad.="where flag_estado=1";
								$cursor_propiedad = $conexion->query($sql_propiedad);
								while($propiedad = $cursor_propiedad->fetch()){
								
								?>
								<tr>
									<td><?php echo utf8_encode($propiedad["nombre_persona"]);?></td>
									<td>
										<?php
								$sql_propiedad = "SELECT * FROM cuentas ";
								$sql_propiedad .= "INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_cuenta ";
								$sql_propiedad.="where flag_estado=1";
								$cursor_propiedad = $conexion->query($sql_propiedad);
								if(!$cant=$cursor_propiedad -> rowCount()){
								$cant=0;
								}
									echo $cant;?></td>
									<td>
										<?php
								$sql_propiedad = "SELECT * FROM cuentas ";
								$sql_propiedad .= "INNER JOIN propiedades ON cuentas.id_cuenta=propiedades.id_cuenta ";
								$sql_propiedad.="where flag_estado=0";
								$cursor_propiedad = $conexion->query($sql_propiedad);
								if(!$cant=$cursor_propiedad -> rowCount()){
								$cant=0;
								}
									echo $cant;?></td></td>
									
								</tr>
								<?php
								if($propiedades['nombre_persona']="Ignacio Alejandro Peralta Moya"){break;}
								}
								
								?>
							</tbody>
						</table>
					</div>
					-->
				</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
		require_once('librerias-js.php');
	?>
	
	<!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>
	
	
	
</body>

</html>

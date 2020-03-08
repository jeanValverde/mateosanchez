 <?php
	require_once('codigo_recurrente.php');
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
                    <h1 class="page-header">Propiedades</h1>
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
						if(isset($_SESSION["mensaje-sistema-falla"])){
							echo $_SESSION["mensaje-sistema-falla"];
							unset($_SESSION["mensaje-sistema-falla"]);
						}
					?>
					<div class="panel panel-default">
                        <!--
						<div class="panel-heading">
                            <div class="form-group">
								<label>Filtrar franquicia</label>
								<select class="form-control" id="id_franquicia" name="id_franquicia">
									<option value="-">Escoja la franquicia</option>
									<?php
										$sql = "SELECT * FROM franquicias";
										$cursor = $conexion->query($sql);
										while($franquicia = $cursor->fetch()){
											echo "<option value='".$franquicia["id_franquicia"]."'>".utf8_encode($franquicia["nombre_franquicia"])."</option>";
										}
									?>
								</select>
							</div>
                        </div>-->
                        <!-- /.panel-heading -->
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
                                            <th>Descripci&oacute;n propietario</th>
											<th>Captador</th>
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
										$sql_propiedad .= "WHERE is_hidden = 0 AND propiedades.id_tipo_operacion = '3' AND flag_estado = 0 ";
										if($_COOKIE["nivel_cuenta"] == 3){
											$sql_propiedad .= "AND id_franquicia = '".$_COOKIE["id_franquicia"]."' ";
										}elseif($_COOKIE["nivel_cuenta"] == 4){
											$sql_propiedad .= "AND propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."' ";
										}
										$sql_propiedad .= "ORDER BY id_propiedad";
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										
										//echo $sql_propiedad;
										
										while($propiedad = $cursor_propiedad -> fetch()){
										?>
										<tr>
                                            <td><?php echo $propiedad["cod_propiedad"];?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_comuna"]);?></td>
											<td><?php echo utf8_encode($propiedad["nombre_sector"]);?></td>
											<td><?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></td>
											<td><?php echo $propiedad["observacion_propietario"];?></td>
											<td><?php echo utf8_encode($propiedad["nombre_persona"]);?></td>
											
                                            <td class="center">
												<a href="crear-contrato-temporada.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-warning btn-xs expanded">Crear contrato</a>
											</td>
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
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
		<script>
				$(document).ready(function(){
					$("#id_franquicia").change(function(){
						var url = "../php/filtrar_propiedad.php"; // El script a d�nde se realizar� la petici�n.
						$.ajax({
							type: "POST",
							url: url,
							data: {id_franquicia: $("#id_franquicia").val()},
							success: function(data){
								$("#dataTables-example").html(data); // Mostrar la respuestas del script PHP.
							}
						});
					});
				});
	</script>
</body>

</html>

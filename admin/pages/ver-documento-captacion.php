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
                    <h1 class="page-header">Editar contrato: Paso N&deg; 2</h1>
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
                        <div class="panel-heading">
                            <div class="form-group">
								<label>Codigos reservados</label>
								
							</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											<th>Corredor</th>
											<th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_propiedad = "SELECT * FROM propiedades ";
										$sql_propiedad .= "INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta ";
										$sql_propiedad .= "WHERE propiedades.is_hidden = 1 AND propiedades.is_reservado = 1 AND cuentas.is_banned = 0 ";
										if($_COOKIE["nivel_cuenta"] == 3){
											$sql_propiedad .= "AND cuentas.id_franquicia = '".$_COOKIE["id_franquicia"]."' ";
										}elseif($_COOKIE["id_cuenta"] == 17){
											//$sql_propiedad .= "AND propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."' ";
										}elseif($_COOKIE["nivel_cuenta"] == 4){
											$sql_propiedad .= "AND propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."' ";
										}
										$sql_propiedad .= "ORDER BY propiedades.cod_propiedad DESC";
										//echo $sql_propiedad;
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										
										while($propiedad = $cursor_propiedad -> fetch()){
										?>
										<tr>
                                            <td><?php echo $propiedad["cod_propiedad"];?></td>
											<td><?php echo $propiedad["nombre_persona"]; ?></td>
                                            <td class="center">
												<a href="ingresar-propiedad-documentador.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>" class="btn btn-warning">Ingresar contrato</a>
												<a href="../php/cargar-pdf-documento-captacion.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>" target="_blank" class="btn btn-success">Imprimir copia contrato</a>
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
						var url = "../php/filtrar_propiedad.php"; // El script a dónde se realizará la petición.
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

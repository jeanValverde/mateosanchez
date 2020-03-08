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
                    <h1 class="page-header">Franquicias</h1>
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
                            Datos y operaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Escondido?</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_franquicia = "SELECT * FROM franquicias ORDER BY id_franquicia";
										$cursor_franquicia = $conexion -> query($sql_franquicia);
										while($franquicia = $cursor_franquicia -> fetch()){
										?>
										<tr>
                                            <td><?php echo $franquicia["id_franquicia"];?></td>
                                            <td><?php echo $franquicia["nombre_franquicia"];?></td>
                                            <td><?php echo $franquicia["correo_franquicia"];?></td>
                                            <td class="center"><?php if($franquicia["is_hidden"] == 0){echo "No";}else{echo "Si";}?></td>
                                            <td class="center">
												<a href="editar-franquicia.php?id_franquicia=<?php echo $franquicia["id_franquicia"];?>" class="btn btn-warning btn-xs">Editar</a>
												<?php
												if($franquicia["is_hidden"] ==  0){
												?>
												<a href="../php/esconder_franquicia.php?id_franquicia=<?php echo $franquicia["id_franquicia"];?>" class="btn btn-danger btn-xs">Esconder</a>
												<?php
												}else{
												?>
												<a href="../php/mostrar_franquicia.php?id_franquicia=<?php echo $franquicia["id_franquicia"];?>" class="btn btn-info btn-xs">Mostrar</a>
												<?php
												}
												?>
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

</body>

</html>

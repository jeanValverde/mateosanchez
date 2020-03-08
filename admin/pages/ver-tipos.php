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
                    <h1 class="page-header">Tipos De Propiedad</h1>
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
                            Recuerde escribir con may&uacute;sculas y min&uacute;sculas donde corresponda.
                        </div>
						
						<div class="panel-body">
                            <div class="row">  
								<div class="col-lg-12">	
									<form role="form" action="../php/agregar_tipo.php" method="post" id="form-agregar-tipo">
                                        <div class="form-group">
                                            <label>Tipo Propiedad</label>
                                            <input class="form-control" id="nombre_tipo_propiedad" name="nombre_tipo_propiedad">
                                        </div>
										
                                        <button type="submit" class="btn btn-default">Agregar tipo propiedad</button>
									</form>
								</div>
							</div>
						</div>
                    </div>
					
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
                                            <th>Tipo De Propiedad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_tipo = "SELECT * FROM tipo_propiedades  ORDER BY id_tipo_propiedad ASC";
										$cursor_tipo = $conexion -> query($sql_tipo);
										while($tipo = $cursor_tipo -> fetch()){
										?>
										<tr>
                                            <td><?php echo utf8_encode($tipo["nombre_tipo_propiedad"]);?></td>
                                           
											<td>
												<?php
													$sql_contador_tipo = "SELECT * FROM propiedades WHERE id_tipo_propiedad = ".$tipo["id_tipo_propiedad"];
													$cursor_contador_tipo = $conexion -> query($sql_contador_tipo);
													if(!$contador_tipo = $cursor_contador_tipo -> rowCount()){
														$contador_tipo = 0;
													}
													echo $contador_tipo;
												?>
											</td>
                                            <td class="center">
												<a href="editar-tipo.php?id_tipo_propiedad=<?php echo $tipo["id_tipo_propiedad"];?>" class="btn btn-warning btn-xs">Editar</a>
												<?php
													if($contador_tipo == 0){
													?>
													<a href="../php/quitar_tipo.php?id_tipo_propiedad=<?php echo $tipo["id_tipo_propiedad"];?>" class="btn btn-danger btn-xs validar-quitar">Quitar</a>
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
	
	//$(document).ready(function(){
	//	$("#id_region").change(function(){
	//		$.post("../php/selector_comuna.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
	//	});
	//})
	
	$(".validar-quitar").click(function(event) {
		if(!confirm("Desea quitar este tipo?")){
			event.preventDefault();
		}
	}); 
	
	$("#form-agregar-tipo").submit(function(){
		var validar_datos = true;
		
		if($("input#nombre_tipo_propiedad").val() == ""){
			validar_datos = false;
		}
		
		if(validar_datos != true){
			alert("Falta ingresar alguno de los datos correspondientes.");
			event.preventDefault();
		}
	});
    </script>

</body>

</html>

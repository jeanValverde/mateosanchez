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
                    <h1 class="page-header">Comunas</h1>
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
								<form role="form" id="form-agregar-comuna" action="../php/agregar_comuna.php" method="post">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Regi&oacute;n</label>
											<select class="form-control" name="id_region" id="id_region">
												<option value="-">Escoja una regi&oacute;n</option>
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
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nombre comuna</label>
											<input type="text" class="form-control" id="nombre_comuna" name="nombre_comuna" placeholder="Nuevo nombre comuna...">
										</div>
									</div>
									<div class="col-lg-12">
										<button type="submit" class="btn btn-default">Agregar comuna</button>
										<button type="reset" class="btn btn-default">Limpiar formulario</button>
									</div>
								</form>
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
                                            <th>Regi&oacute;n</th>
                                            <th>Nombre comuna</th>
											<th>Propiedades / Sectores en comuna</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_comuna = "SELECT * FROM comunas INNER JOIN regiones ON regiones.id_region=comunas.id_region ORDER BY comunas.id_region";
										$cursor_comuna = $conexion -> query($sql_comuna);
										while($comuna = $cursor_comuna -> fetch()){
										?>
										<tr>
                                            <td><?php echo $comuna["nro_romano"];?></td>
                                            <td><?php echo utf8_encode($comuna["nombre_comuna"]);?></td>
											<td>
												<?php
													$sql_contador_propiedades = "SELECT * FROM propiedades WHERE id_comuna = ".$comuna["id_comuna"];
													$cursor_contador_propiedades = $conexion -> query($sql_contador_propiedades);
													if(!$contador_propiedades = $cursor_contador_propiedades -> rowCount()){
														$contador_propiedades = 0;
													}
													
													$sql_contador_sectores = "SELECT * FROM sectores WHERE id_comuna = ".$comuna["id_comuna"];
													$cursor_contador_sectores = $conexion -> query($sql_contador_sectores);
													if(!$contador_sectores = $cursor_contador_sectores -> rowCount()){
														$contador_sectores = 0;
													}
													
													echo $contador_propiedades." / ".$contador_sectores;
												?>
											</td>
                                            <td class="center">
												<a href="editar-comuna.php?id_comuna=<?php echo $comuna["id_comuna"];?>" class="btn btn-warning btn-xs">Editar</a>
												<?php
													if($contador_propiedades == 0 && $contador_sectores == 0){
													?>
													<a href="../php/quitar_comuna.php?id_comuna=<?php echo $comuna["id_comuna"];?>" class="btn btn-danger btn-xs validar-quitar">Quitar</a>
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
	
	$("#form-agregar-comuna").submit(function(){
		var validar_datos = true;
		
		if($("input#nombre_comuna").val() == ""){
			validar_datos = false;
		}
		
		if($("#id_region").val() == "-"){
			validar_datos = false;
		}
		
		if(validar_datos != true){
			alert("Falta ingresar el nombre de la comuna o seleccionar la region correspondiente.");
			event.preventDefault();
		}
	});
	
	$(".validar-quitar").click(function(event) {
		if(!confirm("Desea quitar esta comuna?")){
			event.preventDefault();
		}
	}); 
    </script>

</body>

</html>

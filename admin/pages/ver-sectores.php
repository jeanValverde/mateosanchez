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
                    <h1 class="page-header">Sectores</h1>
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
								<form role="form" id="form-agregar-sector" action="../php/agregar_sector.php" method="post">
									<div class="col-lg-4">
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
									<div class="col-lg-4">
										<div class="form-group">
											<label>Comunas</label>
											<select class="form-control" name="id_comuna" id="id_comuna">
												<option value="-">Escoja una regi&oacute;n primero</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Nombre Sector</label>
											<input type="text" class="form-control" id="nombre_sector" name="nombre_sector" placeholder="Nuevo nombre sector...">
										</div>
									</div>
									<div class="col-lg-12">
										<button type="submit" class="btn btn-default">Agregar sector</button>
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
                                            <th>Comuna</th>
                                            <th>Nombre sector</th>
											<th>Propiedades en sector</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_sector = "SELECT * FROM sectores INNER JOIN comunas ON comunas.id_comuna = sectores.id_comuna ORDER BY sectores.nombre_sector ASC";
										$cursor_sector = $conexion -> query($sql_sector);
										while($sector = $cursor_sector -> fetch()){
										?>
										<tr>
                                            <td><?php echo utf8_encode($sector["nombre_comuna"]);?></td>
                                            <td><?php echo utf8_encode($sector["nombre_sector"]);?></td>
											<td>
												<?php
													$sql_contador_propiedades = "SELECT * FROM propiedades WHERE id_sector = ".$sector["id_sector"];
													$cursor_contador_propiedades = $conexion -> query($sql_contador_propiedades);
													if(!$contador_propiedades = $cursor_contador_propiedades -> rowCount()){
														$contador_propiedades = 0;
													}
													echo $contador_propiedades;
												?>
											</td>
                                            <td class="center">
												<a href="editar-sector.php?id_sector=<?php echo $sector["id_sector"];?>" class="btn btn-warning btn-xs">Editar</a>
												<?php
													if($contador_propiedades == 0){
													?>
													<a href="../php/quitar_sector.php?id_sector=<?php echo $sector["id_sector"];?>" class="btn btn-danger btn-xs validar-quitar">Quitar</a>
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
	
	$(document).ready(function(){
		$("#id_region").change(function(){
			$.post("../php/selector_comuna.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
		});
	})
	
	$(".validar-quitar").click(function(event) {
		if(!confirm("Desea quitar este sector?")){
			event.preventDefault();
		}
	}); 
	
	$("#form-agregar-sector").submit(function(){
		var validar_datos = true;
		
		if($("input#nombre_sector").val() == ""){
			validar_datos = false;
		}
		
		if($("#id_region").val() == "-"){
			validar_datos = false;
		}
		
		if($("#id_comuna").val() == "-"){
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

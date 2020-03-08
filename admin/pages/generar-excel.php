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
                    <h1 class="page-header">Listado de propiedades Excel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Informativo
                        </div>
                        <form method="get" action="../php/generar_excel.php" target="_blank">
							<div class="panel-body">
								<p>Debera ingresar los filtros necesarios para poder generar el archivo de excel que descargara a su computador.</p>
								<div class="form-group">
									<label>Escoger destino</label>
									<select class="form-control" id="id_tipo_giro" name="id_tipo_giro">
										<?php
											$sql_tipo_giro = "SELECT * FROM tipo_giros";
											$cursor_tipo_giro = $conexion->query($sql_tipo_giro);
											echo "<option value='0'>Considerar todas</option>";
											while ($tipo_giro = $cursor_tipo_giro->fetch()){
												echo "<option value='".$tipo_giro["id_tipo_giro"]."'>".utf8_encode($tipo_giro["nombre_tipo_giro"])."</option>";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Tipo propiedad</label>
									<select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
										<?php
											$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades";
											$cursor_tipo_propiedad = $conexion->query($sql_tipo_propiedad);
											echo "<option value='0'>Considerar todas</option>";
											while ($tipo_propiedad = $cursor_tipo_propiedad->fetch()){
												$sql_validar = "SELECT * FROM propiedades WHERE is_hidden=0 AND id_tipo_propiedad=".$tipo_propiedad["id_tipo_propiedad"];
												$cursor_validar = $conexion -> query($sql_validar);
												if(!$validar=$cursor_validar->rowCount()){
													$validar = 0;
												}
												
												if($validar > 0){
													echo "<option value='".$tipo_propiedad["id_tipo_propiedad"]."'>".utf8_encode($tipo_propiedad["nombre_tipo_propiedad"])."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Regi&oacute;n</label>
									<select class="form-control" id="id_region" name="id_region">
										<?php
											$sql_region = "SELECT * FROM regiones";
											$cursor_region = $conexion->query($sql_region);
											echo "<option value='0'>Considerar todas</option>";
											while ($region = $cursor_region->fetch()){
												$sql_validar = "SELECT * FROM propiedades WHERE is_hidden=0 AND id_region=".$region["id_region"];
												$cursor_validar = $conexion -> query($sql_validar);
												if(!$validar=$cursor_validar->rowCount()){
													$validar = 0;
												}
												
												if($validar > 0){
													echo "<option value='".$region["id_region"]."'>".utf8_encode($region["nombre_region"])."</option>";
												}
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Comuna</label>
									<select class="form-control" id="id_comuna" name="id_comuna">
										<option value="0">Cualquiera</option>
									</select>
								</div>
								<div class="form-group">
									<label>Sector</label>
									<select class="form-control" id="id_sector" name="id_sector">
										<option value="0">Cualquiera</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Con propietario?</label>
									<select class="form-control" id="is_propietario" name="is_propietario">
										<option value="0">Cualquiera</option>
										<option value="1">Si</option>
										<option value="2">No</option>
									</select>
								</div>
							</div>
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-success btn-activar">Crear excel</button>
							</div>
						</form>
                    </div>
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
	
	<script>
		$(document).ready(function(){
			$("#id_comuna").change(function(){
				$.post("../php/selector_sector_buscador.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
			});
		})
		
		$(document).ready(function(){
			$("#id_region").change(function(){
				$.post("../php/selector_comuna_buscador.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
			});
		})
	</script>
	
</body>

</html>

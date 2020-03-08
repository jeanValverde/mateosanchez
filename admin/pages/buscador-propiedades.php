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
                    <h1 class="page-header">Agregar corredor</h1>
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
					<div class="panel panel-default" style="background: #ddd;">
                        <div class="panel-heading">
                            Datos requeridos del nuevo corredor
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
									<div class="form-group">
										<label>Tipo propiedad</label>
										<select class="form-control" name="id_tipo_propiedad" id="id_tipo_propiedad" required data-validation-required-message="Please select a type.">
											<option value="-">Cualquiera</option>
											<?php
											$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY id_tipo_propiedad";
											$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
											while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
												$sql_validar = "SELECT * FROM propiedades WHERE id_tipo_propiedad=".$tipo_propiedad["id_tipo_propiedad"];
												$cursor_validar = $conexion -> query($sql_validar);
												if(!$validar = $cursor_validar -> rowCount()){
													$validar = 0;
												}
												
												if($validar > 0){
												?>
												<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"];?>"><?php echo utf8_encode($tipo_propiedad["nombre_tipo_propiedad"]);?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Tipo operaci&oacute;n</label>
										<select name="id_tipo_operacion" id="id_tipo_operacion" class="form-control">
											<option value="-">Cualquiera</option>
											<?php
											$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY id_tipo_operacion";
											$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
											while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
											?>
												<option value="<?php echo $tipo_operacion["id_tipo_operacion"];?>"><?php echo utf8_encode($tipo_operacion["nombre_tipo_operacion"]);?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>C&oacute;digo</label>
										<input class="form-control" id="codigo_propiedad" name="codigo_propiedad">
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Regi&oacute;n</label>
										<select id="id_region" name="id_region" class="form-control">
											<option value="-">Cualquiera</option>
											<?php
											$sql_region = "SELECT * FROM regiones";
											$cursor_region = $conexion -> query($sql_region);
											while($region = $cursor_region -> fetch()){
												$sql_validar = "SELECT * FROM propiedades WHERE id_region=".$region["id_region"];
												$cursor_validar = $conexion -> query($sql_validar);
												if(!$validar = $cursor_validar -> rowCount()){
													$validar = 0;
												}
												
												if($validar > 0){
												?>
													<option value="<?php echo $region["id_region"];?>"><?php echo utf8_encode($region["nro_romano"]." - ".$region["nombre_region"]);?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Comuna</label>
										<select id="id_comuna" name="id_comuna" class="form-control">
											<option value="-">Cualquiera</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
										<label>Sector</label>
										<select id="id_sector" name="id_sector" class="form-control">
											<option value="-">Cualquiera</option>
										</select>
									</div>
								</div>
								<div class="col-lg-12">
									<label>Estado</label>
								</div>
								<div class="col-lg-10">
									<div class="form-group">
										
										<select id="is_active" class="form-control">
											<option value="0">Activa</option>
											<option value="1">De baja</option>
										</select>
									</div>
								</div>
								<div class="col-lg-2">
									<button type="submit" class="btn btn-default pull-right">Buscar</button>
								</div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					
					<div class="panel panel-default" id="resultado_busqueda">
					
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
	
	<script src="../js/agregar-franquicia.js"></script>
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
	
	<!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>
</body>

</html>

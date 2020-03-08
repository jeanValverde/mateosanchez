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
                    <h1 class="page-header">Agregar Franquicia</h1>
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
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Datos requeridos para la nueva franquicia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="../php/agregar_franquicia.php" method="post" id="form-agregar-franquicia" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nombre Franquicia</label>
                                            <input class="form-control" id="nombre_franquicia" name="nombre_franquicia">
                                            <p class="help-block">Este dato sera presentado por el sitio</p>
                                        </div>
										<div class="form-group">
                                            <label>Regi&oacute;n</label>
                                            <select class="form-control" id="id_region" name="id_region">
                                                <option value="-">Escoja la regi&oacute;n</option>
												<?php
													$sql_region = "SELECT * FROM regiones";
													$cursor_region = $conexion->query($sql_region);
													while ($region = $cursor_region->fetch()){
														echo "<option value='".$region["id_region"]."'>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
													}
												?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Comuna</label>
                                            <select class="form-control" id="id_comuna" name="id_comuna">
                                                <option value="-">Escoja una regi&oacute;n primero</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Direcci&oacute;n</label>
                                            <input class="form-control" id="direccion_franquicia" name="direccion_franquicia">
                                            <p class="help-block">Este dato sera interno</p>
                                        </div>
										<div class="form-group">
                                            <label>Tel&eacute;fono fijo</label>
                                            <input class="form-control" id="telefono_fijo_franquicia" name="telefono_fijo_franquicia">
                                            <p class="help-block">Este dato sera presentado por el sitio</p>
                                        </div>
										<div class="form-group">
                                            <label>Tel&eacute;fono m&oacute;vil</label>
                                            <input class="form-control" id="telefono_movil_franquicia" name="telefono_movil_franquicia">
                                            <p class="help-block">Este dato sera presentado por el sitio</p>
                                        </div>
										<div class="form-group">
                                            <label>Correo electr&oacute;nico</label>
                                            <input class="form-control" id="correo_franquicia" name="correo_franquicia">
                                            <p class="help-block">Este dato sera presentado por el sitio</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Nombre Representante</label>
                                            <input class="form-control" id="representante_franquicia" name="representante_franquicia">
                                            <p class="help-block">Este dato sera interno</p>
                                        </div>
										<div class="form-group">
                                            <label>N&uacute;mero de contacto</label>
                                            <input class="form-control" id="fono_contacto_representante" name="fono_contacto_representante">
                                            <p class="help-block">Este dato sera interno</p>
                                        </div>
										<div class="form-group">
                                            <label>Imagen de franquicia</label>
                                            <input type="file" name="img_franquicia" id="img_franquicia">
                                        </div>
										<div class="form-group">
                                            <label>Detalles (No obligatorio)</label>
                                            <textarea class="form-control" rows="3" id="detalle_franquicia" name="detalle_franquicia"></textarea>
											<p class="help-block">Este dato sera interno</p>
                                        </div>
                                        <button type="submit" class="btn btn-default">Agregar Franquicia</button>
                                        <button type="reset" class="btn btn-default" style="float: right">Limpiar Formulario</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
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
			$("#id_region").change(function(){
				$.post("../php/selector_comuna.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
			});
		})
	</script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>
    <script src="../bower_components/morrisjs/morris.min.js"></script>
    <script src="../js/morris-data.js"></script>
</body>

</html>

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
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Datos requeridos del nuevo corredor
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" action="../php/agregar_corredor.php" method="post" id="form-agregar-corredor">
										<input type="hidden" name="id_franquicia" value="<?php echo $cuenta["id_franquicia"];?>"></input>
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input class="form-control" id="nombre_persona" name="nombre_persona">
                                        </div>
										<div class="form-group">
                                            <label>Correo electr&oacute;nico</label>
                                            <input class="form-control" id="correo_cuenta" name="correo_cuenta">
                                        </div>
										<div class="form-group">
                                            <label>Tel&eacute;fono</label>
                                            <input class="form-control" id="telefono_persona" name="telefono_persona">
                                        </div>
                                        <button type="submit" class="btn btn-default">Agregar corredor</button>
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

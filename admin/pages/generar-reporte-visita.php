<?php
	require_once('codigo_recurrente.php');	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('shared-code.php'); ?>
	
	<!-- CSS editar-cuenta -->
    <link href="../css-modificado/editar-cuenta.css" rel="stylesheet">
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
                    <h1 class="page-header">Cerrar documento de visita</h1>
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
                            Fecha de cierre del documento: <?php echo date("d-m-Y"); ?>
                        </div>
						<div class="panel-body">
                           
								<form role="form" id="form-cerrar-visita" action="../php/cerrar_documento_visita.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id_documento_visita_propiedad" value="<?php echo $_GET["id_documento"];?>"></input>
									
									<div class="form-group">
										<label>Detalles perfil</label>
										<textarea class="form-control" rows="3" id="reporte_documento_visita_propiedad" name="reporte_documento_visita_propiedad"></textarea>
										<p class="help-block">Este dato es obligatorio</p>
									</div>
									<button type="submit" class="btn btn-default">Cerrar documento visita</button>
								</form>
						</div>
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

</body>

</html>

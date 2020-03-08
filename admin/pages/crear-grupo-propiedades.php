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
                    <h1 class="page-header">Crear grupo de propiedades</h1>
                </div>
            </div>
            
			<form role="form" action="../php/crear_grupo_propiedades.php" method="post" id="crear-grupo-propiedades" enctype="multipart/form-data">
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
								Datos requeridos del nuevo grupo
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<form role="form" action="../php/crear_grupo_propiedades.php" method="post" id="crear-grupo-propiedades" enctype="multipart/form-data">
											<div class="form-group">
												<label>Titulo Grupo</label>
												<input class="form-control" id="titulo_grupo_propiedad" name="titulo_grupo_propiedad">
											</div>
											<div class="form-group">
												<label>Imagen REFERENCIAL</label>
												<input type="file" name="img_grupo_propiedad" id="img_grupo_propiedad">
											</div>
											<div class="form-group">
												<label>Detalle de la propiedad:</label>
												<textarea class="form-control" name="detalle_grupo_propiedad" id="detalle_grupo_propiedad" rows="4"></textarea>
											</div>
											<button type="submit" class="btn btn-default">Agregar Grupo</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
        </div>
    </div>

    <?php
		require_once('librerias-js.php');
	?>
</body>

</html>

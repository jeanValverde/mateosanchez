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
                    <h1 class="page-header">Agregar corredor</h1>
                </div>
            </div>

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
									<div class="form-group">
										<label>Titulo Grupo Top</label>
										<input class="form-control" id="titulo_grupo_propiedad" name="titulo_grupo_propiedad">
									</div>
									<button type="button" class="btn btn-default">Buscar propiedad</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Propiedades para adjuntar</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="dataTable_wrapper">
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
									<thead>
										<tr>
											<th>#</th>
											<th>Titulo</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql_propiedad = "SELECT * FROM grupos_propiedades_top ORDER BY titulo_grupo_propiedad";
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										while($propiedad = $cursor_propiedad -> fetch()){
										?>
										<tr>
											<td><?php echo $propiedad["id_grupo_propiedad"]; ?></td>
											<td>
												<?php echo utf8_encode($propiedad["titulo_grupo_propiedad"]);?>
											</td>
											<td style="width: 20%;">
												<a href="editar-grupo-propiedades-top.php?id_grupo_propiedad=<?php echo $propiedad["id_grupo_propiedad"]; ?>" class="btn btn-warning">Editar</a>
												<a href="../php/quitar_grupo_propiedades_top.php?id_grupo_propiedad=<?php echo $propiedad["id_grupo_propiedad"]; ?>" class="btn btn-danger validar_accion">Quitar</a>
											</td>
										</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>

    <?php
		require_once('librerias-js.php');
	?>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
		$(document).ready(function() {
			$('#dataTables-example').DataTable({
					responsive: true
			});
		});

		$('.validar_accion').click(function(){
			if (!confirm('Al borrar el grupo NO se borraran las propiedades, desea seguir con la accion?')) {
				event.preventDefault();
			}



		});
    </script>
</body>

</html>

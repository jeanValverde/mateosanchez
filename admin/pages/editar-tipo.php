<?php
	require_once('codigo_recurrente.php');
	$sql="SELECT * FROM tipo_propiedades WHERE id_tipo_propiedad='".$_GET["id_tipo_propiedad"]."'";
	$cursor = $conexion -> query($sql);
	$tipo = $cursor -> fetch();
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
                    <h1 class="page-header">Cambiar nombre tipo</h1>
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
                            Recuerde revisar la ortografia de los datos que ingresa.
                        </div>
						<div class="panel-body">
                            <div class="row">
								<form role="form" id="form-editar-tipo" action="../php/editar_tipo.php" method="post">
									<input type="hidden" value="<?php echo $tipo["id_tipo_propiedad"];?>" name="id_tipo_propiedad"></input>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nombre actual</label>
											<input type="text" class="form-control" value="<?php echo utf8_encode("tipo: ".$tipo["nombre_tipo_propiedad"]);?>" disabled>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nombre nuevo</label>
											<input type="text" class="form-control" id="nombre_tipo_propiedad" name="nombre_tipo_propiedad" placeholder="Ingrese nuevo nombre del tipo...">
										</div>
									</div>
									<div class="col-lg-12">
										<button type="submit" class="btn btn-default">Editar tipo</button>
									</div>
								</form>
							</div>
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
	
	<!-- jQuery -->
    <script>
		$("#form-editar-tipo").submit(function(){
			var validar_datos = true;
			var mensaje_error = "";
			
			if($("input#nombre_tipo_propiedad").val() == ""){
				mensaje_error += "Ingrese nuevo nombre para el tipo.\n";
				validar_datos = false;
			}
			
			if(validar_datos != true){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
	</script>

</body>

</html>

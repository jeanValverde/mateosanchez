<?php
	require_once('codigo_recurrente.php');
	$sql="SELECT * FROM cuentas WHERE nombre_cuenta='".$_SESSION["nombre_cuenta"]."' AND clave_cuenta='".$_SESSION["clave_cuenta"]."'";
	$cursor = $conexion -> query($sql);
	$cuenta = $cursor -> fetch();
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
                    <h1 class="page-header">Cambiar clave cuenta</h1>
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
                            Recuerde de ingresar la clave actual para realizar el proceso.
                        </div>
						<div class="panel-body">
                            <div class="row">
								<form role="form" id="form-cambiar-cuenta" action="../php/editar_cuenta.php" method="post">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Clave nueva</label>
											<input type="password" class="form-control" id="clave_nueva" name="clave_nueva" placeholder="Ingresa clave valida (alfanumerico, punto, coma, guion y guion bajo)...">
										</div>
										<div class="form-group">
											<label>Repetir clave</label>
											<input type="password" class="form-control" id="clave_repetida" name="clave_repetida" placeholder="Ingrese nuevamente la clave nueva...">
										</div>
										<div class="form-group">
											<label>Clave actual</label>
											<input type="password" class="form-control" id="clave_cuenta" name="clave_cuenta" placeholder="Ingresar clave para validar el proceso...">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Nombre completo</label>
											<input type="text" class="form-control" id="nombre_persona" name="nombre_persona" placeholder="Nombre completo..." value="<?php echo utf8_encode($cuenta["nombre_persona"]);?>">
										</div>
										<div class="form-group">
											<label>Tel&eacute;fono contacto</label>
											<input type="text" class="form-control" id="telefono_persona" name="telefono_persona" placeholder="Telefono fijo o m&oacute;vil..." value="<?php echo $cuenta["telefono_persona"];?>">
										</div>
										<button type="submit" class="btn btn-default">Editar cuenta</button>
										<button type="reset" class="btn btn-default">Limpiar formulario</button>
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
    <script src="../js/editar-cuenta.js"></script>

</body>

</html>

<?php
	require_once('codigo_recurrente.php');
	$sql_corredor = "SELECT * FROM cuentas WHERE id_cuenta=".$_GET["id_cuenta"];
	$cursor_corredor = $conexion -> query($sql_corredor);
	$corredor = $cursor_corredor -> fetch();
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
                           
								<form role="form" id="form-cambiar-cuenta" action="../php/editar_corredor.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id_cuenta" name="id_cuenta" value="<?php echo $corredor["id_cuenta"];?>"></input>
									<div class="form-group">
										<label>Nombre completo</label>
										<input type="text" class="form-control" id="nombre_persona" name="nombre_persona" placeholder="Nombre completo..." value="<?php echo utf8_encode($corredor["nombre_persona"]); ?>">
									</div>
									<div class="form-group">
										<label>Tel&eacute;fono contacto</label>
										<input type="text" class="form-control" id="telefono_persona" name="telefono_persona" placeholder="Telefono fijo o m&oacute;vil..." value="<?php echo $corredor["telefono_persona"];?>">
									</div>
									<div class="form-group">
										<label>Titulo perfil</label>
										<input class="form-control" id="titulo_perfil_cuenta" name="titulo_perfil_cuenta" value="<?php echo $corredor["titulo_perfil_cuenta"];?>">
										<p class="help-block">Ej: Agente asociado</p>
									</div>
									<div class="form-group">
										<label>Imagen del perfil</label>
										<input type="file" name="img_perfil_cuenta" id="img_perfil_cuenta">
										<?php if(!empty($corredor["img_perfil_cuenta"])){ ?>
										<img style="max-width: 300px;" src="../../agentes/<?php echo $corredor["img_perfil_cuenta"]; ?>">
										<?php } ?>
									</div>
									<div class="form-group">
										<label>Detalles perfil</label>
										<textarea class="form-control" rows="3" id="descripcion_perfil_cuenta" name="descripcion_perfil_cuenta" value="<?php echo $corredor["descripcion_perfil_cuenta"];?>"><?php echo $corredor["descripcion_perfil_cuenta"];?></textarea>
										<p class="help-block">Este dato sera interno</p>
									</div>
									<button type="submit" class="btn btn-default">Editar cuenta</button>
									<button type="reset" class="btn btn-default">Limpiar formulario</button>
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
	
	<!-- jQuery -->
    <script src="../js/editar-cuenta.js"></script>

</body>

</html>

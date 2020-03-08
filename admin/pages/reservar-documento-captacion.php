<?php
	require_once('codigo_recurrente.php');

	$sql_codigo = "SELECT * FROM propiedades ORDER BY cod_propiedad DESC LIMIT 1";
	$cursor_codigo = $conexion -> query($sql_codigo);

	if(!$nro_registro = $cursor_codigo -> rowCount()){
		$codigo = 1;
	}else{
		$registro = $cursor_codigo -> fetch();
		$codigo = $registro["cod_propiedad"] + 1;
	}
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
                    <h1 class="page-header">Crear contrato: Paso N&deg; 1</h1>
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
                        <form method="get" action="../php/crear_documento_pdf.php" target="_blank">
							<input type="hidden" name="cod_propiedad" value="<?php echo $codigo; ?>"></input>
							<div class="panel-body">
								<p>Al hacer click en el boton que sale m&aacute;s abajo creara un documento en PDF que el cual podra ser usado para tomar los datos de la propiedad a captar, este codigo quedara reservado tanto para ingresarlo al sistema como para crear m&aacute;s copias del documento.</p>
								<div class="form-group">
									<label>Documento a crear</label>
									<select class="form-control" id="id_tipo_documento" name="id_tipo_documento">
										<?php
											$sql_tipo_documento = "SELECT * FROM tipo_documentos";
											$cursor_tipo_documento = $conexion->query($sql_tipo_documento);
											while ($tipo_documento = $cursor_tipo_documento->fetch()){
												echo "<option value='".$tipo_documento["id_tipo_documento"]."'>".utf8_encode($tipo_documento["nombre_tipo_documento"])."</option>";
											}
										?>
									</select>
								</div>

								<div class="form-group">
									<label>Corredor asignado</label>
									<select class="form-control" id="id_cuenta" name="id_cuenta">
										<?php if($_COOKIE["nivel_cuenta"] < 3){?>
										<option value="-">Asignar corredor</option>
										<?php
											$sql_cuenta = "SELECT * FROM cuentas WHERE id_franquicia=".$_COOKIE["id_franquicia"]." AND is_banned = 0";
											$cursor_cuenta = $conexion->query($sql_cuenta);
											while ($cuenta = $cursor_cuenta->fetch()){
												echo "<option value='".$cuenta["id_cuenta"]."'>".$cuenta["nombre_persona"]."</option>";
											}
										?>
										<?php }else{ ?>
											<option value="<?php echo $_COOKIE["id_cuenta"]; ?>">Agente activo</option>
										<?php } ?>
									</select>
								</div>

								<?php if($_COOKIE["nivel_cuenta"] == 1){ ?>
								<div class="form-group">
									<label>Usar nuevo porcentaje</label>
									<input type="number" class="form-control" id="porcentaje_tipo_documento" name="porcentaje_tipo_documento" name="direccion_franquicia">
									<p class="help-block">Solo n&uacute;meros, 1 al 100 (Vacio = base)</p>
								</div>
								<?php } ?>
							</div>
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-success btn-activar">Crear nuevo documento</button>
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
		$(".btn-activar").click(function() {
			if($('select#id_cuenta').val() != '-'){
				confirmar=confirm("Esta seguro de generar un nuevo documento?");

				if(!confirmar){
					event.preventDefault();
				}
			}else{
				alert('Tiene que asignar un corredor para la propiedad.');
				event.preventDefault();
			}
		});
	</script>

</body>

</html>

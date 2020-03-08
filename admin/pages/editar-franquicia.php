<?php
	require_once('codigo_recurrente.php');
	$sql_franquicia = "SELECT * FROM franquicias WHERE id_franquicia=".$_GET["id_franquicia"];
	$cursor_franquicia = $conexion -> query($sql_franquicia);
	$validar_franquicia = $cursor_franquicia -> rowCount();
	if($validar_franquicia == 1){
		$franquicia = $cursor_franquicia -> fetch();
	}else{
		$_SESSION["mensaje-sistema-falla"] = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>Franquicia no encontrada, favor intentar nuevamente.</div>";
		header("location: ver-franquicias.php");
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
                    <h1 class="page-header">Editar Franquicia</h1>
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
							Sobreescriba los datos que quiera cambiar
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<form role="form" action="../php/editar_franquicia.php" method="post" id="form-editar-franquicia">
										<input type="hidden" name="id_franquicia" value="<?php echo $franquicia["id_franquicia"];?>"></input>
										<div class="form-group">
											<label>Nombre Franquicia</label>
											<input class="form-control" id="nombre_franquicia" name="nombre_franquicia" value="<?php echo utf8_encode($franquicia["nombre_franquicia"]);?>">
											<p class="help-block">Este dato sera presentado por el sitio</p>
										</div>
										<div class="form-group">
											<label>Regi&oacute;n</label>
											<select class="form-control" id="id_region" name="id_region">
												<?php
													$sql_region = "SELECT * FROM regiones";
													$cursor_region = $conexion->query($sql_region);
													while ($region = $cursor_region->fetch()){
														if($region["id_region"] == $franquicia["id_region"]){
															echo "<option value='".$region["id_region"]."' selected>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
														}else{
															echo "<option value='".$region["id_region"]."'>".$region["nro_romano"]." - ".utf8_encode($region["nombre_region"])."</option>";
														}
														
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label>Comuna</label>
											<select class="form-control" id="id_comuna" name="id_comuna">
												<?php
												$sql_comuna = "SELECT * FROM comunas WHERE id_comuna=".$franquicia["id_comuna"];
												$cursor_comuna = $conexion -> query($sql_comuna);
												$comuna = $cursor_comuna -> fetch();
												?>
												<option value="<?php echo $comuna["id_comuna"];?>"><?php echo utf8_encode($comuna["nombre_comuna"]);?></option>
											</select>
										</div>
										<div class="form-group">
											<label>Direcci&oacute;n</label>
											<input class="form-control" id="direccion_franquicia" name="direccion_franquicia" value="<?php echo $franquicia["direccion_franquicia"];?>">
											<p class="help-block">Este dato sera interno</p>
										</div>
										<div class="form-group">
											<label>Tel&eacute;fono fijo</label>
											<input class="form-control" id="telefono_fijo_franquicia" name="telefono_fijo_franquicia" value="<?php echo $franquicia["telefono_fijo_franquicia"];?>">
											<p class="help-block">Este dato sera presentado por el sitio</p>
										</div>
										<div class="form-group">
											<label>Tel&eacute;fono m&oacute;vil</label>
											<input class="form-control" id="telefono_movil_franquicia" name="telefono_movil_franquicia" value="<?php echo $franquicia["telefono_movil_franquicia"];?>">
											<p class="help-block">Este dato sera presentado por el sitio</p>
										</div>
										<div class="form-group">
											<label>Nombre Representante</label>
											<input class="form-control" id="representante_franquicia" name="representante_franquicia" value="<?php echo utf8_encode($franquicia["representante_franquicia"]);?>">
											<p class="help-block">Este dato sera interno</p>
										</div>
										<div class="form-group">
											<label>N&uacute;mero de contacto</label>
											<input class="form-control" id="fono_contacto_representante" name="fono_contacto_representante" value="<?php echo $franquicia["fono_contacto_representante"];?>">
											<p class="help-block">Este dato sera interno</p>
										</div>
										<div class="form-group">
											<label>Detalles (No obligatorio)</label>
											<textarea class="form-control" rows="3" id="detalle_franquicia" name="detalle_franquicia" value="<?php echo $franquicia["detalles_franquicia"];?>"><?php echo utf8_encode($franquicia["detalles_franquicia"]);?></textarea>
											<p class="help-block">Este dato sera interno</p>
										</div>
										<button type="submit" class="btn btn-default">Editar franquicia</button>
										<a href="ver-franquicias.php" class="btn btn-default">Volver a franquicias</a>
									</form>
								</div>
								<!-- /.col-lg-12 -->
							</div>
							<!-- /.row -->
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
	
	<script src="../js/editar-franquicia.js"></script>
	<script>
		$(document).ready(function(){
			$("#id_region").change(function(){
				$.post("../php/selector_comuna.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
			});
		})
	</script>
</body>

</html>

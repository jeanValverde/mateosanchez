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
                    <h1 class="page-header">Manejar Comunas y Sectores</h1>
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
                            Recuerde escribir con may&uacute;sculas y min&uacute;sculas donde corresponda.
                        </div>
						<div class="panel-body">
                            <div class="row">
								<form role="form" id="form-agregar-comuna" action="../php/agregar_comuna.php" method="post">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Nombre comuna</label>
											<input type="text" class="form-control" id="nombre_comuna" name="nombre_comuna" placeholder="Nuevo nombre comuna...">
										</div>
										
										<button type="submit" class="btn btn-default">Agregar comuna</button>
										<button type="reset" class="btn btn-default">Limpiar formulario</button>
									</div>
								</form>
							</div>
						</div>
                    </div>
					<div class="panel panel-default">
						<div class="panel-heading">
                            Tiene que seleccionar de que comuna sera el sector que agregue, recuerde escribir con may&uacute;sculas y min&uacute;sculas donde corresponda.
                        </div>
						<div class="panel-body">
                            <div class="row">
								<form role="form" id="form-agregar-sector" action="../php/agregar_sector.php" method="post">
									<div class="col-lg-6">
										<div class="form-group">
                                            <label>Comuna:</label>
                                            <select class="form-control" name="id_comuna" id="id_comuna_agregar_sector">
												<option value="-">Escoja una comuna</option>
												<optgroup Label="Acceso rapido">
													<option value="34">Vi&ntilde;a del Mar</option>
													<option value="33">Valpara&iacute;so</option>
													<option value="37">Quilpu&eacute;</option>
													<option value="38">Villa Alemana</option>
												</optgroup>
												<optgroup label="-------------">
													<?php
														$sql = "SELECT * FROM comunas WHERE id_region=5";
														$cursor = $conexion -> query($sql);
														while($comuna = $cursor -> fetch()){
															echo "<option value='".$comuna["id_comuna"]."'>".utf8_encode($comuna["nombre_comuna"])."</option>";
														}
													?>
												</optgroup>
											</select>
                                        </div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label>Agregar sector</label>
											<input type="text" class="form-control" id="nombre_sector" name="nombre_sector" placeholder="Nuevo nombre sector...">
										</div>
									</div>
									
									<div class="col-lg-12">
										<button type="submit" class="btn btn-default">Agregar sector</button>
										<button type="reset" class="btn btn-default">Limpiar formulario</button>
									</div>
								</form>
							</div>
						</div>
                    </div>
					<div class="panel panel-default">
						<div class="panel-heading">
                            Recuerde de ingresar la clave actual para realizar el proceso.
                        </div>
						<div class="panel-body">
                            <div class="row">
								<form role="form" id="form-editar-comuna-sector" action="../php/editar_comuna_sector.php" method="post">
									<div class="col-lg-6">
										<div class="form-group">
                                            <label>Comuna:</label>
                                            <select class="form-control" name="id_comuna" id="id_comuna">
												<option value="-">Escoja una comuna</option>
												<optgroup Label="Acceso rapido">
													<option value="34">Vi&ntilde;a del Mar</option>
													<option value="33">Valpara&iacute;so</option>
													<option value="37">Quilpu&eacute;</option>
													<option value="38">Villa Alemana</option>
												</optgroup>
												<optgroup label="-------------">
													<?php
														$sql = "SELECT * FROM comunas WHERE id_region=5";
														$cursor = $conexion -> query($sql);
														while($comuna = $cursor -> fetch()){
															echo "<option value='".$comuna["id_comuna"]."'>".utf8_encode($comuna["nombre_comuna"])."</option>";
														}
													?>
												</optgroup>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Sector</label>
                                            <select size="5" class="form-control" name="id_sector" id="id_sector">
                                                <option value="-">Para editar una secci&oacute;n debe escoger la comuna correspondiente</option>
                                            </select>
                                        </div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Editar comuna</label>
											<input type="text" class="form-control" id="nombre_comuna_editar" name="nombre_comuna" placeholder="Nuevo nombre comuna...">
										</div>
										<div class="form-group">
											<label>Editar sector</label>
											<input type="text" class="form-control" id="nombre_sector_editar" name="nombre_sector" placeholder="Nuevo nombre sector...">
										</div>
										<button type="submit" class="btn btn-default">Editar</button>
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
	<script>
		$(document).ready(function(){
			$("#id_comuna").change(function(){
				$.post("../php/selector_sector.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
			});
		})
		
		$("#form-agregar-comuna").submit(function(){
			
			var validar = true;
			var mensaje_error = "";
			
			if($("#nombre_comuna").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el nombre de la nueva comuna.\n";
			}
			
			if(validar == false){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
		
		$("#form-agregar-sector").submit(function(){
			
			var validar = true;
			var mensaje_error = "";
			
			if($("#id_comuna_agregar_sector").val() == "-"){
				validar = false;
				mensaje_error += "Ingrese la comuna en la que se encontrara el nuevo sector.\n";
			}
			
			if($("#nombre_sector").val() == ""){
				validar = false;
				mensaje_error += "Ingrese el nombre del nuevo sector.\n";
			}
			
			if(validar == false){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
		
		$("#form-editar-comuna-sector").submit(function(){
			
			var validar = false;
			var mensaje_error = "";
			
			if(validar == false){
				alert(mensaje_error);
				event.preventDefault();
			}
		});
	</script>

</body>

</html>

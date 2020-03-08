<?php
	require_once('codigo_recurrente.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('shared-code.php'); ?>
	<style>
		.margin-left-30{
			
		}
		.img-referencia{
			width: 140px;
		}
		.text-align-center{
			text-align: center !important;
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
                    <h1 class="page-header">Enviar petici&oacute;n papeleria</h1>
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
					<form role="form" action="../php/enviar_peticion_papeleria.php" method="post" id="form-enviar-peticion-papeleria">
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Sobre americano</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="sobre_americano" name="sobre_americano" type="number" placeholder="Cantidad">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Esquela</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="esquela_carta" name="esquela_carta" type="number" placeholder="Cantidad en carta">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="esquela_oficio" name="esquela_oficio" type="number" placeholder="Cantidad en oficio">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Carpeta corporativa</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="carpeta_corporativa_carta" name="carpeta_corporativa_carta" type="number" placeholder="Cantidad en carta">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="carpeta_corporativa_oficio" name="carpeta_corporativa_oficio" type="number" placeholder="Cantidad en oficio">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Sobre saco</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="sobre_saco_carta" name="sobre_saco_carta" type="number" placeholder="Cantidad en carta">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="sobre_saco_oficio" name="sobre_saco_oficio" type="number" placeholder="Cantidad en oficio">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Tarjeta de presentaci&oacute;n</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="tarjeta_presentacion" name="tarjeta_presentacion" type="number" placeholder="Cantidad">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Folleteria (vertical)</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<input class="form-control" id="folleteria" name="folleteria" type="number" placeholder="Cantidad">
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading">
								<label>Otros tipos de pedidos</label>
							</div>
							
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<textarea class="form-control" name="otras_peticiones" id="otras_peticiones" rows="4" value=""></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="row">
								<button type="submit" class="btn btn-success">Enviar</button>
							</div>
						</div>
					</form>
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
	
	<script>
		$("#form-enviar-peticion-papeleria").submit(function(){
			var mensaje_error = "Usted va a enviar la siguiente peticion para imprimir.\n";
			var is_valid = false;
			var $inputs = $('#form-enviar-peticion-papeleria input:text');
			
			if($("#sobre_americano").val() != ""){
				mensaje_error += "SOBRE AMERICANO: "+$("#sobre_americano").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#esquela_carta").val() != ""){
				mensaje_error += "ESQUELA CARTA: "+$("#esquela_carta").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#esquela_oficio").val() != ""){
				mensaje_error += "ESQUELA OFICIO: "+$("#esquela_oficio").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#carpeta_corporativa_carta").val() != ""){
				mensaje_error += "CARPETA CORPORATIVA CARTA: "+$("#carpeta_corporativa_carta").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#carpeta_corporativa_oficio").val() != ""){
				mensaje_error += "CARPETA CORPORATIVA OFICIO: "+$("#carpeta_corporativa_oficio").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#sobre_saco_carta").val() != ""){
				mensaje_error += "SOBRE SACO CARTA: "+$("#sobre_saco_carta").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#sobre_saco_oficio").val() != ""){
				mensaje_error += "SOBRE SACO OFICIO: "+$("#sobre_saco_oficio").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#tarjeta_presentacion").val() != ""){
				mensaje_error += "TARJETA PRESENTACION: "+$("#tarjeta_presentacion").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#folleteria").val() != ""){
				mensaje_error += "FOLLETERIA: "+$("#folleteria").val()+".\n";
				is_valid = true;
				
			}
			
			if($("#otras_peticiones").val() != ""){
				mensaje_error += "OTRAS PETICIONES: "+$("#otras_peticiones").val()+".\n";
				is_valid = true;
				
			}
			
			if(is_valid == false){
				mensaje_error += "No se han ingresado items a la peticion.\n";
				alert(mensaje_error);
				event.preventDefault();
			}else{
				mensaje_error += "Seguro que desea enviarlo?"
				if(!confirm(mensaje_error)) {
					event.preventDefault();
				}
			}
		});
	</script>
</body>

</html>

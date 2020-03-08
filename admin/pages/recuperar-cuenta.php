<?php
	session_start();
	require_once('../php/rutinas.php');
	if(isset($_SESSION["correo_cuenta"]) && isset($_SESSION["clave_cuenta"])){
		$sql_validar_cuenta = "SELECT * FROM pcd_cuentas WHERE correo_cuenta='".$_SESSION["correo_cuenta"]."' AND clave_cuenta='".$_SESSION["clave_cuenta"]."'";
		$cursor_validar_cuenta = $conexion -> query($sql_validar_cuenta);
		$validar_cuenta = $cursor_validar_cuenta -> rowCount();
		if($validar_cuenta == 1){
			header("Location: home.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once('shared-code.php'); ?>
	
	<!-- CSS recuperar-cuenta -->
    <link href="../css-modificado/recuperar-cuenta.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Recuperar cuenta</h3>
                    </div>
                    <div class="panel-body">
                        <form action="../php/recuperar_cuenta.php" method="post" role="form" id="form-recuperar-cuenta">
							<div class="form-group">
								<label>Correo asociado a la cuenta</label>
								<input class="form-control" id="correo_cuenta" name="correo_cuenta" placeholder="La clave sera entregada a travez del correo correspondiente...">
							</div>
							<button type="submit" class="btn btn-default">Recuperar cuenta</button>
							<button type="button" onClick="document.location.href = 'index.php';" class="btn btn-default">Volver</button>
						</form>
                    </div>
                </div>
				<?php
					if(isset($_SESSION["mensaje-sistema"])){
						echo $_SESSION["mensaje-sistema"];
						unset($_SESSION["mensaje-sistema"]);
					}
				?>
            </div>
        </div>
    </div>

    <?php
		require_once('librerias-js.php');
	?>
	
	<!-- jQuery -->
    <script src="../js/recuperar-cuenta.js"></script>

</body>

</html>

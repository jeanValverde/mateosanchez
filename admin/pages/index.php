<?php
	session_start();
	require_once('../php/rutinas.php');
	if(isset($_COOKIE["nombre_cuenta"]) && isset($_COOKIE["clave_cuenta"])){
		$nombre_cuenta = $_COOKIE["nombre_cuenta"];
		$clave_cuenta = $_COOKIE["clave_cuenta"];
		$sql_validar_cuenta = "SELECT * FROM cuentas WHERE nombre_cuenta='".$nombre_cuenta."' AND clave_cuenta='".$clave_cuenta."'";
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

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form action="../php/iniciar_sesion.php" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo electronico" name="correo_cuenta" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Clave de la cuenta" name="clave_cuenta" type="password">
                                </div>
                                <div class="form-group">
                                    <a href="recuperar-cuenta.php">Recupera tu cuenta</a>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Iniciar Sesi&oacute;n</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
				<?php
					if(isset($_SESSION["mensaje-login"])){
						echo $_SESSION["mensaje-login"];
						unset($_SESSION["mensaje-login"]);
					}
				?>
            </div>
        </div>
    </div>

    <?php
		require_once('librerias-js.php');
	?>

</body>

</html>

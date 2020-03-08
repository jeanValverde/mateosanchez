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
                    <h1 class="page-header">Propiedades</h1>

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
						if(isset($_SESSION["mensaje-sistema-falla"])){
							echo $_SESSION["mensaje-sistema-falla"];
							unset($_SESSION["mensaje-sistema-falla"]);
						}
					?>

					<div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="dataTable_wrapper">

                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">


                                    <thead>
                                        <tr>
                      <th>#</th>
                      <th>Tipo</th>
                      <th>Operaci&oacute;n</th>
                      <th>Comuna</th>
											<th>Sector</th>
											<th>Valor</th>
                      <th>Descripci&oacute;n propietario</th>
											<th>Captador</th>
                      <th>Fecha Publicacion</th>
                      <th>Mt2</th>
                      <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$sql_propiedad = "SELECT * FROM propiedades ";
										$sql_propiedad .= "INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad = tipo_propiedades.id_tipo_propiedad ";
										$sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
										$sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
										$sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
										$sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
										$sql_propiedad .= "INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta ";
										$sql_propiedad .= "WHERE is_hidden = ".$_GET["is_hidden"]." ";
										if($_COOKIE["nivel_cuenta"] == 3){
											if($_COOKIE["id_cuenta"] == 14){//Cuenta litty.kuschel@mateosanchez.cl
												$sql_propiedad .= "AND (propiedades.id_comuna = 29 OR propiedades.id_sector = 12 OR propiedades.id_sector = 237) ";
											}else{
												$sql_propiedad .= "AND cuentas.id_franquicia = '".$_COOKIE["id_franquicia"]."' ";
											}
										}elseif($_COOKIE["id_cuenta"] == 19 || $_COOKIE["id_cuenta"] == 3 || $_COOKIE["id_cuenta"] == 23){
											//$sql_propiedad .= "AND (propiedades.id_tipo_giro = 1 ";
											//$sql_propiedad .= "OR propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."') ";
										}elseif($_COOKIE["nivel_cuenta"] == 4){
											$sql_propiedad .= "AND propiedades.id_cuenta = '".$_COOKIE["id_cuenta"]."' ";
										}
										$sql_propiedad .= "ORDER BY id_propiedad DESC";
										$cursor_propiedad = $conexion -> query($sql_propiedad);
										while($propiedad = $cursor_propiedad -> fetch()){
										?>
										<tr>
                                            <td><?php echo $propiedad["cod_propiedad"];?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></td>
                                            <td><?php echo utf8_encode($propiedad["nombre_comuna"]);?></td>
											<td><?php echo utf8_encode($propiedad["nombre_sector"]);?></td>
											<td><?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></td>
											<td><?php echo $propiedad["observacion_propietario"];?></td>
											<td><?php echo $propiedad["nombre_persona"];?></td>

                      <td><?php echo $propiedad["fecha_captacion_propiedad"];?></td>
                      <td><?php echo $propiedad["cantidad_superficie_total_propiedad"];?></td>
                      <td class="center">
  <a href="editar-propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-warning btn-xs expanded">Editar</a>
  <?php
  if($propiedad["is_hidden"] ==  0){
    ?>
    <a href="../php/esconder_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-danger btn-xs expanded">Dar baja</a>
    <?php
    if($_COOKIE["id_cuenta"] != 13){
    ?>
      <?php
      if($propiedad["is_oferta"] ==  0){
      ?>
      <a href="../php/ofertar_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-info btn-xs expanded">Oferta</a>
      <?php
      }else{
      ?>
      <a href="../php/quitar_oferta_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-danger btn-xs expanded">Quitar oferta</a>
      <?php
      }
      ?>
    <?php
    }
    ?>
  <?php
  }else{
  ?>
  <a href="../php/mostrar_propiedad.php?id_propiedad=<?php echo $propiedad["id_propiedad"];?>" class="btn btn-info btn-xs expanded">Activar</a>
  <?php
  }
  ?>
  <?php
    $sql_validar = "SELECT * FROM documentos_propiedades WHERE cod_propiedad=".$propiedad["cod_propiedad"];

    $cursor_validar = $conexion -> query($sql_validar);
    if(!$validar = $cursor_validar -> rowCount()){
      $validar = 0;
    }

    if($validar != 0){
    ?>
    <a target="_BLANK" class="btn btn-success btn-xs expanded" href="../php/mostrar_documento_propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"]; ?>"> Ver documento </a>
    <?php
    }
  ?>
</td>
                                        </tr>
										<?php
										}
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
					responsive: true,
					order: [[ 0, "desc" ]]
			});
		});
    </script>
</body>

</html>

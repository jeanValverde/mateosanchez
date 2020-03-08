<?php
	session_start();
	require_once("../admin/php/rutinas.php");
	
	$sql_nota_dinamica = "SELECT * FROM notas_dinamicas WHERE id_cuenta = ".$_SESSION["id_cuenta"]." ORDER BY id_nota_dinamica DESC LIMIT 1";
	$cursor_nota_dinamica = $conexion->query($sql_nota_dinamica);
	if(!$validar_nota_dinamica = $cursor_nota_dinamica->rowCount()){
		$validar_nota_dinamica = 0;
	}
	
	if($validar_nota_dinamica == 0){
		$nota_dinamica["detalle_nota_dinamica"] = "Nota: ";
	}else{
		$nota_dinamica = $cursor_nota_dinamica->fetch();
	}
	
	$sql = "UPDATE mensajes SET";
	$sql .= " is_reeded = '1'";
	$sql .= " WHERE id_mensaje = ".$_GET["id_mensaje"];
	$modifica = $conexion->prepare($sql);
	$modifica->execute();
	
	$hoy = date("Y-m-d");
	
	$sql_validar_registro = "SELECT * FROM registro_notas_vistas WHERE id_mensaje = ".$_GET["id_mensaje"]." AND fecha_registro_nota_vista = '".$hoy."' AND id_cuenta = ".$_SESSION["id_cuenta"];
	$cursor_validar_registro = $conexion -> query($sql_validar_registro);
	if(!$validar_registro = $cursor_validar_registro -> rowCount()){
		$validar_registro = 0;
	}
	
	if($validar_registro == 0){
		$sql = "INSERT INTO registro_notas_vistas ";
		$sql .= "(id_mensaje, "; //:param_01
		$sql .= "fecha_registro_nota_vista, "; //NOW
		$sql .= "id_cuenta) "; //:param_02
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= "NOW(), ";
		$sql .= ":param_02)";
		
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $_GET["id_mensaje"]);
		$inserta -> bindValue(':param_02', $_SESSION["id_cuenta"]);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
	}
	
	
	$sql_mensaje = "SELECT * FROM mensajes INNER JOIN cuentas ON mensajes.id_cuenta = cuentas.id_cuenta WHERE id_mensaje = ".$_GET["id_mensaje"];
	$cursor_mensaje = $conexion -> query($sql_mensaje);
	$mensaje = $cursor_mensaje -> fetch();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <?php
		require_once('shared-code.php');
		?>
		<style>
			.img-carousel.owl-theme .owl-controls .owl-dots{
				bottom: -35px;
			}
			
			.img-carousel.owl-theme .owl-controls .owl-nav [class*=owl-]{
				height: inherit;
				padding: 55px 0px;
				background: #B81517;
				color: white;
			}
			
			.img-carousel.owl-theme .owl-controls .owl-nav .owl-prev{
				left: -45px;
			}
			
			.img-carousel.owl-theme .owl-controls .owl-nav .owl-next{
				right: -45px;
			}
		</style>
    </head>
    <body id="home" class="wide">
        <!-- PRELOADER -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="loader-logo"> <img src="assets/img/loader-logo.png" alt=""> </div>
                    <div class="object" id="first_object"> </div>
                    <div class="object" id="second_object"></div>
                    <div class="object" id="third_object"></div>
                </div>
            </div>
        </div>
        <!-- /PRELOADER -->

        <!-- WRAPPER -->
        <div class="wrapper">

            <?php
			require_once('header.php');
			?>

            <!-- CONTENT AREA -->
            <div class="content-area">

                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs text-right">
                    <div class="container">
                        <div class="page-header">
                            <h1>Ficha nota: <?php echo $mensaje["id_mensaje"]; ?></h1>
                        </div>
                        <ul class="breadcrumb">
                            <li><a href="home.php">Inicio</a></li>
							<li><a href="<?php echo $_SESSION["url_mensaje"]; ?>">Ver notas</a></li>
							<li class="active">Ficha nota</li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

                <!-- PAGE -->
                <section class="page-section with-sidebar sub-page">
                    <div class="container">
                        <div class="row">
							 <!-- CONTENT -->
                            <div class="col-md-12 content property-listing" id="content">
								<form id="form-notepad-ficha" action="actualizar_mensaje.php" method="post">
								  <input type="hidden" name="id_mensaje" value="<?php echo $mensaje["id_mensaje"];?>"></input>
								  <div class="form-group col-md-6">
									<label>Fecha de la nota</label>
									<input type="text" class="form-control" value="<?php echo invertirFecha($mensaje["fecha_mensaje"]); ?>" readonly>
								  </div>
								  <div class="form-group col-md-6">
									<label for="detalle_mensaje">Remitente</label>
									<input type="text" class="form-control" value="<?php echo $mensaje["nombre_persona"]; ?>" readonly>
								  </div>
								  <div class="form-group col-md-6">
									<label>Tipo de propiedad</label>
									<select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
										<option value="0">No considerado</option>
										<?php
										$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY nombre_tipo_propiedad";
										$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
										while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
											?>
											<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"]; ?>" <?php if($mensaje["id_tipo_propiedad"] == $tipo_propiedad["id_tipo_propiedad"]){echo "SELECTED";} ?>><?php echo $tipo_propiedad["nombre_tipo_propiedad"]; ?></option>
											<?php
										}
										?>
									</select>
								  </div>
								  <div class="form-group col-md-6">
									<label>Tipo de operaci&oacute;n</label>
									<select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
										<option value="0">No considerado</option>
										<?php
										$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY nombre_tipo_operacion";
										$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
										while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
											?>
											<option value="<?php echo $tipo_operacion["id_tipo_operacion"]; ?>" <?php if($mensaje["is_captacion"] == 0 && $mensaje["id_tipo_operacion"] == $tipo_operacion["id_tipo_operacion"]){echo "SELECTED";} ?>><?php echo $tipo_operacion["nombre_tipo_operacion"]; ?></option>
											<?php
										}
										?>
										<option value="k" <?php if($mensaje["is_captacion"] == 1){echo "SELECTED";} ?>>Captaci&oacute;n</option>
									</select>
								  </div>
								  
								  <div class="form-group col-md-6">
									<label for="detalle_mensaje">Nombre cliente</label>
									<input type="text" class="form-control" value="<?php echo $mensaje["nombre_cliente"]; ?>" name="nombre_cliente">
								  </div>
								  <div class="form-group col-md-6">
									<label for="detalle_mensaje">Tel&eacute;fono</label>
									<input type="text" class="form-control" value="<?php echo $mensaje["telefono_cliente"]; ?>" name="telefono_cliente">
								  </div>
								  <div class="form-group col-md-6">
									<label for="detalle_mensaje">Correo electr&oacute;nico</label>
									<input type="text" class="form-control" value="<?php echo $mensaje["correo_cliente"]; ?>" name="correo_cliente">
								  </div>
								  <div class="form-group col-md-6">
									<label for="detalle_mensaje">C&oacute;digo propiedad(es)</label>
									<input type="text" class="form-control" value="<?php echo $mensaje["codigo_propiedad_cliente"]; ?>" name="codigo_propiedad_cliente">
								  </div>
								  
								  <!--
								  <div class="form-group col-md-6">
									  <label>Valor desde</label>
									  <input type="text" class="form-control format_precio" name="valor_desde" id="valor_desde" value="<?php if(!empty($mensaje["valor_desde"])){echo "$".mostrarPrecio($mensaje["valor_desde"]);}else{echo "$0";}?>">
								  </div>
									-->
									
									
								  <div class="form-group col-md-6">
									  <label>Valor hasta</label>
									  <input type="text" class="form-control format_precio" name="valor_hasta" id="valor_hasta" value="<?php if(!empty($mensaje["valor_hasta"])){echo "$".mostrarPrecio($mensaje["valor_hasta"]);}else{echo "$0";}?>">
								  </div>
								  
								  <div class="form-group col-md-6">
									<label>Tipo valor</label>
									<select class="form-control" name="id_tipo_valor">
										<option value="0">Cualquiera</option>
										<?php
										$sql_valor = "SELECT * FROM tipo_valores";
										$cursor_valor = $conexion -> query($sql_valor);
										while($valor = $cursor_valor -> fetch()){
											?>
											<option value="<?php echo $valor["id_tipo_valor"]; ?>" <?php if($mensaje["id_tipo_valor"] == $valor["id_tipo_valor"]){echo "SELECTED";}?>><?php echo $valor["nombre_tipo_valor"]; ?></option>
											<?php
										}
										?>
									</select>
								</div>
							  
								<div class="form-group col-md-4">
									<label>Regi&oacute;n</label>
									<select class="form-control" id="id_region" name="id_region">
										<option value="0">No considerado</option>
										<?php
										$sql_region = "SELECT * FROM regiones ORDER BY id_region";
										$cursor_region = $conexion -> query($sql_region);
										while($region = $cursor_region -> fetch()){
											?>
											<option value="<?php echo $region["id_region"]; ?>" <?php if($mensaje["id_region"] == $region["id_region"]){echo "SELECTED";}?>><?php echo $region["nombre_region"]; ?></option>
											<?php
										}
										?>
									</select>
								</div>
								
								<div class="form-group col-md-4">
									<label>Comuna</label>
									<select class="form-control" id="id_comuna" name="id_comuna">
										<option value="0">No considerado</option>
										<?php
										$sql_comuna = "SELECT * FROM comunas ";
										if($mensaje["id_region"] != 0){
											$sql_comuna .= "WHERE id_region =".$mensaje["id_region"]." ";
										}
										$sql_comuna .= "ORDER BY id_comuna";
										$cursor_comuna = $conexion -> query($sql_comuna);
										while($comuna = $cursor_comuna -> fetch()){
											?>
											<option value="<?php echo $comuna["id_comuna"]; ?>" <?php if($mensaje["id_comuna"] == $comuna["id_comuna"] && $mensaje["id_comuna"] != 0){echo "SELECTED";}?>><?php echo $comuna["nombre_comuna"]; ?></option>
											<?php
										}
										?>
									</select>
								</div>
								
								<div class="form-group col-md-4">
									<label>Sector</label>
									<select class="form-control" id="id_sector" name="id_sector">
										<option value="0">No considerado</option>
										<?php
										$sql_sector = "SELECT * FROM sectores ";
										if($mensaje["id_comuna"] != 0){
											$sql_sector .= "WHERE id_comuna =".$mensaje["id_comuna"]." ";
										}
										$sql_sector .= "ORDER BY id_sector";
										$cursor_sector = $conexion -> query($sql_sector);
										while($sector = $cursor_sector -> fetch()){
											?>
											<option value="<?php echo $sector["id_sector"]; ?>" <?php if($mensaje["id_sector"] == $sector["id_sector"] && $mensaje["id_sector"] != 0){echo "SELECTED";}?>><?php echo $sector["nombre_sector"]; ?></option>
											<?php
										}
										?>
									</select>
								</div>
									
								<div class="form-group col-md-12">
									<label>Portales WEB</label>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Icasas <input type="checkbox" name="icasas_mensaje" value="1" <?php if($mensaje["icasas_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Vivastreet <input type="checkbox" name="vivastreet_mensaje" value="1" <?php if($mensaje["vivastreet_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Toctoc <input type="checkbox" name="toctoc_mensaje" value="1" <?php if($mensaje["toctoc_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="form-group">
										<label>
											Portal inmobiliario <input type="checkbox" name="portal_inmobiliario_mensaje" value="1" <?php if($mensaje["portal_inmobiliario_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="form-group">
										<label>
											info@mateosanchez.cl <input type="checkbox" name="info_mateo_mensaje" value="1" <?php if($mensaje["info_mateo_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Economicos <input type="checkbox" name="economicos_mensaje" value="1" <?php if($mensaje["economicos_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Fich <input type="checkbox" name="fich_mensaje" value="1" <?php if($mensaje["fich_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Yapo <input type="checkbox" name="yapo_mensaje" value="1" <?php if($mensaje["yapo_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Facebook <input type="checkbox" name="facebook_mensaje" value="1" <?php if($mensaje["facebook_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Fan page <input type="checkbox" name="fan_page_mensaje" value="1" <?php if($mensaje["fan_page_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Instagram <input type="checkbox" name="instagram_mensaje" value="1" <?php if($mensaje["instagram_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Pura noticia <input type="checkbox" name="pura_noticia_mensaje" value="1" <?php if($mensaje["pura_noticia_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								
								<div class="col-lg-2">
									<div class="form-group">
										<label>
											Pagina web <input type="checkbox" name="pagina_web_mensaje" value="1" <?php if($mensaje["pagina_web_mensaje"]){echo 'checked';}?>>
										</label>
									</div>
								</div>
								  
								<div class="form-group col-md-12">
									<label for="detalle_mensaje">Detalles del mensaje</label>
									<textarea class="form-control" id="detalle_mensaje" name="detalle_mensaje" rows="10" value="<?php echo $mensaje["detalle_mensaje"]; ?>"><?php echo $mensaje["detalle_mensaje"]; ?></textarea>
								</div>
								
								<?php if($_SESSION["nivel_cuenta"] < 2){ ?>
								<a href="cerrar_mensaje.php?id_mensaje=<?php echo $mensaje["id_mensaje"];?>" class="btn btn-danger pull-right" style="color: white;">Cerrar nota</a>
								<?php } ?>
								<!-- Trigger the modal with a button -->
								<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal" style="margin-right: 10px; background-color: #000; border-color: #000;">Ver propiedades hermanadas</button>
								<a href="<?php echo $_SESSION["url_mensaje"]; ?>" class="btn btn-info pull-right" style="color: white; margin-right: 10px;">Volver a ver notas</a>
								<button type="submit" class="btn btn-success pull-left">Actualizar nota</button>
								</form>
							</div>
                            <!-- /CONTENT -->

                        </div>
                    </div>
                </section>
                <!-- /PAGE -->

            </div>
            <!-- /CONTENT AREA -->
			
            <div id="to-top" class="to-top"><i class="fa fa-angle-up"></i></div>

        </div>
        <!-- /WRAPPER -->

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Propiedades coincidentes</h4>
			  </div>
			  <div class="modal-body">
				<?php
				if(!empty($mensaje["codigo_propiedad_cliente"]) && is_numeric($mensaje["codigo_propiedad_cliente"])){
					$sql_propiedad = "SELECT * FROM propiedades ";
					$sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
					$sql_propiedad .= "INNER JOIN unidad_medidas ON propiedades.id_unidad_medida = unidad_medidas.id_unidad_medida ";
					$sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
					$sql_propiedad .= "WHERE propiedades.cod_propiedad=".$mensaje["codigo_propiedad_cliente"]." ";
					$cursor_propiedad = $conexion -> query($sql_propiedad);
					if(!$validar = $cursor_propiedad -> rowCount()){
						$validar = 0;
						$is_filtered = 0;
					}
				}else{
					$validar = 0;
				}
				if($validar > 0){
				$propiedad = $cursor_propiedad->fetch();
				?>
				<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
					<div class="media col-md-3">
						<a class="media-link" data-gal="prettyPhoto" href="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>">
							<img src="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/>
							<?php
							if($propiedad["is_promesado"] == 1){
								?>
								<img src="../images/img-reservado.png" style="position: absolute; width: 100%; top: 0;">
								<?php
							}elseif($propiedad["is_exclusivo"] == 1){
								?>
								<img src="../images/img-exclusivo.png" style="position: absolute; width: 100%; top: 0;">
								<?php
							}elseif($propiedad["is_oportunidad"] == 1){
								?>
								<img src="../images/img-oportunidad.png" style="position: absolute; width: 100%; top: 0;">
								<?php
							}else{
								if($propiedad["flag_estado"] == 1){
									if($propiedad["id_tipo_operacion"] == 1 || $propiedad["id_tipo_operacion"] == 3){
									?>
									<img src="../images/img-arrendado.png" style="position: absolute; width: 100%; top: 0;">
									<?php
									}else if($propiedad["id_tipo_operacion"] == 2){
									?>
									<img src="../images/img-vendido.png" style="position: absolute; width: 100%; top: 0;">
									<?php
									}
								}
							}
							?>
							<span class="icon-view"><strong><i class="fa fa-arrows-alt"></i></strong></span></a>
						</a>
					</div>
					<div class="caption col-md-9">
						<div class="rating">
							Propiedad: <?php if($propiedad["is_hidden"] == 0){ ?>Disponible <a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> Ver detalles </a><?php }else{ ?>No disponible<?php } ?>
						</div>
						<h4 class="caption-title"><a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>">Propiedad: <?php echo $propiedad["cod_propiedad"];?></a></h4>
						<h5 class="caption-title-sub">
						<?php
							if($propiedad["id_tipo_valor"] == 1){
								echo "$".mostrarPrecio($propiedad["valor_propiedad"]);
							}else{
								echo round($propiedad["valor_propiedad"])." UF";
							}
							
						?>
						</h5>
						
						<table class="table">
							<tr>
								<td><i class="fa fa-expand"></i> 
									<?php
									if($propiedad["cantidad_superficie_total_propiedad"] > 0){
										echo $propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
									}else{
										echo $propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
									}
									?> 
								</td>
								<td><i class="fa fa-bed"></i> <?php echo $propiedad["dormitorios_propiedad"];?> Pieza(s)</td>
								<td><i class="fa fa-tint"></i> <?php echo $propiedad["banos_propiedad"];?> Ba&ntilde;o(s)</td>

								<td class="buttons"><a class="btn btn-theme" href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></a></td>
							</tr>
						</table>
					</div>
				</div>
				<?php
				}
				?>
				
				<?php
				$is_first = 1;
				$propiedad_operacion_activa = 0;
				$is_filtered = 0;
				
				$sql_propiedad = "SELECT * FROM propiedades ";
				$sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
				$sql_propiedad .= "INNER JOIN unidad_medidas ON propiedades.id_unidad_medida = unidad_medidas.id_unidad_medida ";
				$sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
				$sql_propiedad .= "WHERE";
				
				//if(!empty($mensaje["codigo_propiedad_cliente"])){
				//	$codigo_propiedad_cliente = str_replace('  ', '', $mensaje["codigo_propiedad_cliente"]);
				//	$array_codigo_propiedad_cliente = explode(" ", $codigo_propiedad_cliente);
				//	foreach ($array_codigo_propiedad_cliente as &$valor) {
				//		if($is_first == 1){
				//			$sql_propiedad .= " cod_propiedad=".$valor;
				//			$is_first = 0;
				//		}else{
				//			$sql_propiedad .= " OR cod_propiedad=".$valor;
				//		}
				//	}
				//}
				
				//if(!empty($mensaje["codigo_propiedad_cliente"]) && is_numeric($mensaje["codigo_propiedad_cliente"])){
				//	if($is_first == 1){
				//		$sql_propiedad .= " cod_propiedad=".$mensaje["codigo_propiedad_cliente"];
				//		$is_first = 0;
				//	}else{
				//		$sql_propiedad .= " OR cod_propiedad=".$mensaje["codigo_propiedad_cliente"];
				//	}
				//	$is_filtered = 1;
				//}
				
				if($mensaje["id_tipo_propiedad"] > 0 && $mensaje["id_tipo_operacion"] > 0){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_tipo_propiedad=".$mensaje["id_tipo_propiedad"]." AND propiedades.id_tipo_operacion=".$mensaje["id_tipo_operacion"];
						$is_first = 0;
					}else{
						$sql_propiedad .= " OR propiedades.id_tipo_propiedad=".$mensaje["id_tipo_propiedad"]." AND propiedades.id_tipo_operacion=".$mensaje["id_tipo_operacion"];
					}
					$propiedad_operacion_activa = 1;
					$is_filtered = 1;
				}elseif($mensaje["id_tipo_propiedad"] > 0){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_tipo_propiedad=".$mensaje["id_tipo_propiedad"];
						$is_first = 0;
					}else{
						$sql_propiedad .= " OR propiedades.id_tipo_propiedad=".$mensaje["id_tipo_propiedad"];
					}
					$propiedad_operacion_activa = 1;
					$is_filtered = 1;
				}elseif($mensaje["id_tipo_operacion"] > 0){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_tipo_operacion=".$mensaje["id_tipo_operacion"];
						$is_first = 0;
					}else{
						$sql_propiedad .= " OR propiedades.id_tipo_operacion=".$mensaje["id_tipo_operacion"];
					}
					$propiedad_operacion_activa = 1;
					$is_filtered = 1;
				}
				
				if($mensaje["id_sector"] > 0){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_sector=".$mensaje["id_sector"];
						$is_first = 0;
					}else{
						if($propiedad_operacion_activa == 0){
							$sql_propiedad .= " OR propiedades.id_sector=".$mensaje["id_sector"];
						}else{
							$sql_propiedad .= " AND propiedades.id_sector=".$mensaje["id_sector"];
						}
					}
					$is_filtered = 1;
				}elseif($mensaje["id_comuna"] > 0){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_comuna=".$mensaje["id_comuna"];
						$is_first = 0;
					}else{
						if($propiedad_operacion_activa == 0){
							$sql_propiedad .= " OR propiedades.id_comuna=".$mensaje["id_comuna"];
						}else{
							$sql_propiedad .= " AND propiedades.id_comuna=".$mensaje["id_comuna"];
						}
					}
					$is_filtered = 1;
				}elseif($mensaje["id_region"]){
					if($is_first == 1){
						$sql_propiedad .= " propiedades.id_region=".$mensaje["id_region"];
						$is_first = 0;
					}else{
						if($propiedad_operacion_activa == 0){
							$sql_propiedad .= " OR propiedades.id_region=".$mensaje["id_region"];
						}else{
							$sql_propiedad .= " AND propiedades.id_region=".$mensaje["id_region"];
						}
					}
					$is_filtered = 1;
				}
				
				if($is_first == 1){
					$sql_propiedad .= " propiedades.is_hidden=0";
					$is_first = 0;
				}else{
					$sql_propiedad .= " AND propiedades.is_hidden=0";
				}
				
				$sql_propiedad .= " LIMIT 10";
				$cursor_propiedad = $conexion -> query($sql_propiedad);
				if(!$validar = $cursor_propiedad -> rowCount()){
					$validar = 0;
					$is_filtered = 0;
				}
				
				if($is_filtered == 1){
					while($propiedad = $cursor_propiedad->fetch()){
					?>
					<div class="thumbnail no-border no-padding thumbnail-property-card clearfix">
						<div class="media col-md-3">
							<a class="media-link" data-gal="prettyPhoto" href="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>">
								<img src="../img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>" alt=""/>
								<?php
								if($propiedad["is_promesado"] == 1){
									?>
									<img src="../images/img-reservado.png" style="position: absolute; width: 100%; top: 0;">
									<?php
								}elseif($propiedad["is_exclusivo"] == 1){
									?>
									<img src="../images/img-exclusivo.png" style="position: absolute; width: 100%; top: 0;">
									<?php
								}elseif($propiedad["is_oportunidad"] == 1){
									?>
									<img src="../images/img-oportunidad.png" style="position: absolute; width: 100%; top: 0;">
									<?php
								}else{
									if($propiedad["flag_estado"] == 1){
										if($propiedad["id_tipo_operacion"] == 1 || $propiedad["id_tipo_operacion"] == 3){
										?>
										<img src="../images/img-arrendado.png" style="position: absolute; width: 100%; top: 0;">
										<?php
										}else if($propiedad["id_tipo_operacion"] == 2){
										?>
										<img src="../images/img-vendido.png" style="position: absolute; width: 100%; top: 0;">
										<?php
										}
									}
								}
								?>
								<span class="icon-view"><strong><i class="fa fa-arrows-alt"></i></strong></span></a>
							</a>
						</div>
						<div class="caption col-md-9">
							<div class="rating">
								<a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> Ver detalles </a>
							</div>
							<h4 class="caption-title"><a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>">Propiedad: <?php echo $propiedad["cod_propiedad"];?></a></h4>
							<h5 class="caption-title-sub">
							<?php
								if($propiedad["id_tipo_valor"] == 1){
									echo "$".mostrarPrecio($propiedad["valor_propiedad"]);
								}else{
									echo round($propiedad["valor_propiedad"])." UF";
								}
								
							?>
							</h5>
							
							<table class="table">
								<tr>
									<td><i class="fa fa-expand"></i> 
										<?php
										if($propiedad["cantidad_superficie_total_propiedad"] > 0){
											echo $propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
										}else{
											echo $propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
										}
										?> 
									</td>
									<td><i class="fa fa-bed"></i> <?php echo $propiedad["dormitorios_propiedad"];?> Pieza(s)</td>
									<td><i class="fa fa-tint"></i> <?php echo $propiedad["banos_propiedad"];?> Ba&ntilde;o(s)</td>

									<td class="buttons"><a class="btn btn-theme" href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"><?php echo utf8_encode($propiedad["nombre_tipo_operacion"]);?></a></td>
								</tr>
							</table>
						</div>
					</div>
					<?php
					}
				}else{
				?>
				<h4 class="text-center" style="color: #14181c">No hay propiedades como referencia</h4>
				<?php } ?>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>

        <!-- JS Global -->
		<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="assets/plugins/superfish/js/superfish.min.js"></script>
        <script src="assets/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
        <script src="assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
        <script src="assets/plugins/jquery.sticky.min.js"></script>
        <script src="assets/plugins/jquery.easing.min.js"></script>
        <script src="assets/plugins/jquery.smoothscroll.min.js"></script>
        <!--<script src="assets/plugins/smooth-scrollbar.min.js"></script>-->
        <script src="assets/plugins/datetimepicker/js/moment-with-locales.min.js"></script>
        <script src="assets/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <!-- JS Page Level -->
        <script src="assets/js/theme-ajax-mail.js"></script>
        <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
        <script src="assets/js/theme.js"></script>
		<script src="assets/js/recurrent-code.js"></script>
		
		<script>
			
			$(document).ready(function(){
				$("#id_comuna").change(function(){
					$.post("../admin/php/selector_sector_buscador.php",{ id:$(this).val() },function(data){$("#id_sector").html(data);})
				});
			})
			
			$(document).ready(function(){
				$("#id_region").change(function(){
					$.post("../admin/php/selector_comuna_buscador.php",{ id:$(this).val() },function(data){$("#id_comuna").html(data);})
				});
			})
			
			$(document).ready(function(){
				$(".format_precio").keyup(function() {
					$(this).val("$"+number_format($(this).val()));
				});
			});
		</script>

    </body>
</html>
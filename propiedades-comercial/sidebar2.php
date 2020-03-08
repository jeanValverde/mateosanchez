


					<!-- Sidebar Section -->
					<section style="float:right; padding-right:5% ; left: 6px; height: 120px;  top: 6em;  "   id="sidebar2" class="col-md-5">
						<!-- Search Form -->
						<div class="row">
							<div class="col-md-14">
								<div class="srch_frmm" >
									<h3 style="color:rgba(255, 255, 255, 0.85)" >Buscador  </h3>
									<form name="sentMessage" id="buscador_propiedad2" action="resultado-buscador.php" novalidate>
										<div class="control-group form-group">
											<div class="controls col-md-4 first">
												<label style="color:rgba(255, 255, 255, 0.85)" >Tipo </label>
												<select style="color:rgba(255, 255, 255, 0.85)" class="form-control" name="id_tipo_propiedad" id="id_tipo_propiedad" required data-validation-required-message="Please select a type.">
													<option value="-">Propiedad </option>
													<?php
													$sql_tipo_propiedad = "SELECT * FROM tipo_propiedades ORDER BY id_tipo_propiedad";
													$cursor_tipo_propiedad = $conexion -> query($sql_tipo_propiedad);
													while($tipo_propiedad = $cursor_tipo_propiedad -> fetch()){
														$sql_validar = "SELECT * FROM propiedades WHERE id_tipo_propiedad=".$tipo_propiedad["id_tipo_propiedad"];
														$cursor_validar = $conexion -> query($sql_validar);
														if(!$validar = $cursor_validar -> rowCount()){
															$validar = 0;
														}

														if($validar > 0){
														?>
														<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"];?>"><?php echo utf8_encode($tipo_propiedad["nombre_tipo_propiedad"]);?></option>
														<?php
														}
													}
													?>
												</select>
											</div>
											<div class="controls col-md-4 second">
												<label style="color:rgba(255, 255, 255, 0.85)" >Operaci&oacute;n </label>
												<select style="color:rgba(255, 255, 255, 0.85)" name="id_tipo_operacion" id="id_tipo_operacion" class="form-control">
													<option value="-">Operaci&oacute;n</option>
													<option value="1">Arriendo</option>
													<option value="2">Venta</option>
													<option value="4">Der. a llave</option>
													<!--
													<?php
													$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY id_tipo_operacion";
													$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
													while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
													?>
														<option value="<?php echo $tipo_operacion["id_tipo_operacion"];?>"><?php echo utf8_encode($tipo_operacion["nombre_tipo_operacion"]);?></option>
													<?php
													}
													?>
													-->
												</select>
											</div>

										</div>
										<div class="control-group form-group">
											<div class="controls col-md-4 second">
												<label style="color:rgba(255, 255, 255, 0.85)" >Regi&oacute;n </label>
												<select style="color:rgba(255, 255, 255, 0.85)" id="id_region2" name="id_region" class="form-control">
													<option value="-">Cualquiera</option>
													<?php
													$sql_region = "SELECT * FROM regiones";
													$cursor_region = $conexion -> query($sql_region);
													while($region = $cursor_region -> fetch()){
														$sql_validar = "SELECT * FROM propiedades WHERE id_region=".$region["id_region"];
														$cursor_validar = $conexion -> query($sql_validar);
														if(!$validar = $cursor_validar -> rowCount()){
															$validar = 0;
														}

														if($validar > 0){
														?>
															<option value="<?php echo $region["id_region"];?>"><?php echo utf8_encode($region["nro_romano"]." - ".$region["nombre_region"]);?></option>
														<?php
														}
													}
													?>
												</select>
											</div>
											<!-- <div class="controls col-md-4 second">
												<label>Comuna </label>
												<select id="id_comuna" name="id_comuna" class="form-control">
													<option value="-">Cualquiera</option>
												</select>
											</div> -->
											<div class="clearfix"></div>
										</div>
										<!-- <div class="control-group form-group">
											<label>Sector </label>
											<select id="id_sector" name="id_sector" class="form-control">
												<option value="-">Cualquiera</option>
											</select>
											<div class="clearfix"></div>
										</div> -->
										<!-- <div class="control-group form-group">
											<div class="controls col-md-6 col-xs-6 first">
												<label style="color: #B71E24; font-weight: bold;">C&oacute;digo </label>
												<input style="background: rgba(241, 201, 48, 0.3); font-weight: bold;" type="number" class="form-control" id="cod_propiedad" name="cod_propiedad">
												<p class="help-block"></p>
											</div>
											<div class="controls col-md-6 col-xs-6 second">
												<label>Tipo moneda</label>
												<select name="id_tipo_valor" class="form-control">
													<?php
													$sql_tipo_valor = "SELECT * FROM tipo_valores ORDER BY id_tipo_valor";
													$cursor_tipo_valor = $conexion -> query($sql_tipo_valor);
													while($tipo_valor = $cursor_tipo_valor -> fetch()){
													?>
														<option value="<?php echo $tipo_valor["id_tipo_valor"];?>"><?php echo utf8_encode($tipo_valor["nombre_tipo_valor"]);?></option>
													<?php
													}
													?>
												</select>
											</div>
											<div class="clearfix"></div>
										</div> -->
										<!-- <div class="control-group form-group">
											<div class="controls col-md-6 col-xs-6 first">
												<label>Desde</label>
												<input type="text" class="form-control format_precio" name="valor_desde">
											</div>
											<div class="controls col-md-6 col-xs-6 second">
												<label>Hasta </label>
												<input type="text" class="form-control format_precio" name="valor_hasta">
											</div>
											<div class="clearfix"></div>
										</div> -->
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-primary">Buscar</button>
									</form>
								</div>
							</div>
						</div>
						<!-- /.row -->

						<!--
						<div class="spacer-30"></div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel">
									<div class="panel-image">
										<a href="#"><img class="img-responsive img-hover" src="images/aviso-1.jpg" alt=""></a>
									</div>
									<div class="spacer-10"></div>
									<div class="panel-image">
										<a href="#"><img class="img-responsive img-hover" src="images/aviso-2.jpg" alt=""></a>
									</div>
									<div class="spacer-10"></div>
									<div class="panel-image">
										<a href="#"><img class="img-responsive img-hover" src="images/aviso-3.jpg" alt=""></a>
									</div>
								</div>
							</div>
						</div>
						-->
						<!--
						<div class="spacer-30"></div>
						<?php
						$sql_propiedad_sidebar = "SELECT * FROM propiedades";
						$sql_propiedad_sidebar .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
						$sql_propiedad_sidebar .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
						$sql_propiedad_sidebar .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
						$sql_propiedad_sidebar .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
						$sql_propiedad_sidebar .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
						if(isset($propiedad["id_region"])){
							$sql_propiedad_sidebar .= " WHERE is_hidden=0 AND propiedades.id_region=".$propiedad["id_region"]." AND propiedades.img_01_propiedad <> 'imagen-referencial.png' ORDER BY RAND() DESC LIMIT 3";
						}else{
							$sql_propiedad_sidebar .= " WHERE is_hidden=0 AND propiedades.img_01_propiedad <> 'imagen-referencial.png' ORDER BY propiedades.id_propiedad DESC LIMIT 3";
						}
						$cursor_propiedad_sidebar = $conexion -> query($sql_propiedad_sidebar);
						if(!$validar_propiedad_sidebar = $cursor_propiedad_sidebar -> rowCount()){
							$validar_propiedad_sidebar = 0;
						}

						if($validar_propiedad_sidebar != 0){
						?>
						<div class="row">
							<div class="titl_sec">
								<div class="col-lg-12">
									<h3 class="main_titl text-left">
										Propiedades relacionadas
									</h3>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<?php
						}

						while($propiedad_sidebar = $cursor_propiedad_sidebar -> fetch()){
						?>
						<div class="row">
							<div class="col-md-12">
								<a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad_sidebar["cod_propiedad"];?>">
									<div class="panel panel-default">
										<div class="panel-image">
											<img class="img-responsive img-hover" src="img/propiedades/<?php echo $propiedad_sidebar["img_01_propiedad"];?>">
											<?php
											if($propiedad_sidebar["flag_estado"] == 1){
												if($propiedad_sidebar["id_tipo_operacion"] == 1 || $propiedad_sidebar["id_tipo_operacion"] == 3){
												?>
												<img src="images/img-arrendado.png" style="position: absolute; width: 100%; top: 0;">
												<?php
												}else if($propiedad_sidebar["id_tipo_operacion"] == 2){
												?>
												<img src="images/img-vendido.png" style="position: absolute; width: 100%; top: 0;">
												<?php
												}
											}
											?>
											<div class="img_hov_eff">
												<div>
													<span style="color: white;"><?php echo utf8_encode(substr($propiedad_sidebar["detalle_propiedad"], 0, 355))."...";?></span>
												</div>
												<div style="text-align: right; margin-top: 10px;">
													<a class="btn btn-default btn_trans" href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad_sidebar["cod_propiedad"];?>"> Ver m&aacute;s </a>
												</div>
											</div>
										</div>
										<div class="sal_labl">
											En <?php echo utf8_encode($propiedad_sidebar["nombre_tipo_operacion"]);?>
										</div>

										<div class="sal_labl cod_labl">
											COD: <?php echo $propiedad_sidebar["cod_propiedad"];?>
										</div>

										<div class="panel-body">
											<div class="prop_feat">
												<p class="area"><i class="fa fa-home"></i>
												<?php
													if($propiedad_sidebar["cantidad_superficie_total_propiedad"] > 0){
														echo "Superficie: ".$propiedad_sidebar["cantidad_superficie_total_propiedad"]." ".$propiedad_sidebar["diminutivo_unidad_medida"];
													}else{
														echo "Superficie: ".$propiedad_sidebar["cantidad_superficie_construida_propiedad"]." ".$propiedad_sidebar["diminutivo_unidad_medida"];
													}
												?>
												</p>
												<?php if($propiedad_sidebar["dormitorios_propiedad"] > 0){ ?>
												<p class="bedrom"><i class="fa fa-bed"></i> <?php echo $propiedad_sidebar["dormitorios_propiedad"];?> Dormitorios</p>
												<?php } ?>
											</div>
											<h3 class="sec_titl">
												<?php echo utf8_encode($propiedad_sidebar["nombre_tipo_propiedad"]);?> - <?php echo utf8_encode($propiedad_sidebar["nombre_comuna"]); ?>
											</h3>

											<p class="sec_desc">
												<?php echo substr($propiedad_sidebar["detalle_propiedad"], 0, 70)."...";?>
											</p>

											<div class="panel_bottom">
												<div class="col-md-6">
													<p class="price text-left"> <?php echo $propiedad_sidebar["simbologia_tipo_valor"].mostrarPrecio($propiedad_sidebar["valor_propiedad"]);?></p>
												</div>
												<div class="col-md-6">
													<p class="readmore text-right"> <a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad_sidebar["cod_propiedad"];?>"> Ver m&aacute;s </a> </p>
												</div>
											</div>
										</div>
									</div>
									<div class="share_btn">
										<i class="fa fa-share-alt"></i>
										<div class="soc_btn">
											<ul>
												<li>
													<a href="http://www.facebook.com/sharer.php?u=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-facebook"></i> </a>
												</li>
												<li>
													<a target="_BLANK" href="http://twitter.com/home?status=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-twitter"></i> </a>
												</li>
												<li>
													<a target="_BLANK" href="https://plus.google.com/share?url=http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> <i class="fa fa-google-plus"></i> </a>
												</li>
											</ul>
										</div>
									</div>
								</a>
							</div>
						</div>

						<div class="spacer-30"></div>
						<?php
						}
						?>
						-->

						<!-- Featured Properties -->
						<!--
						<div class="row">
							<div class="titl_sec">
								<div class="col-lg-12">
									<h3 class="main_titl text-left">
										Ultimas propiedades
									</h3>
								</div>
								<div class="clearfix"></div>
							</div>

							<div class="side_feat">
								<?php
								$sql_ultimo = "SELECT * FROM propiedades INNER JOIN unidad_medidas ON propiedades.id_unidad_medida = unidad_medidas.id_unidad_medida WHERE propiedades.is_hidden=0 ORDER BY propiedades.cod_propiedad DESC LIMIT 3";
								$cursor_ultimo = $conexion -> query($sql_ultimo);
								while($ultimo = $cursor_ultimo -> fetch()){
								?>

								<div class="panel panel-default">
									<div class="panel-image col-md-3">
										<a href="ficha-propiedad.php?cod_propiedad=<?php echo $ultimo["cod_propiedad"];?>"> <img class="img-responsive img-hover" src="img/propiedades/<?php echo $ultimo["img_01_propiedad"];?>"> </a>
									</div>

									<div class="panel-body col-md-9">
										<h3 class="sec_titl">
											<a href="ficha-propiedad.php?cod_propiedad=<?php echo $ultimo["cod_propiedad"];?>"> <?php echo substr($ultimo["detalle_propiedad"], 0, 70)."...";?> </a>
										</h3>

										<div class="prop_feat">
											<p class="area"><i class="fa fa-home"></i>
												<?php
													if($ultimo["cantidad_superficie_total_propiedad"] > 0){
														echo $ultimo["cantidad_superficie_total_propiedad"]." ".$ultimo["diminutivo_unidad_medida"];
													}else{
														echo $ultimo["cantidad_superficie_construida_propiedad"]." ".$ultimo["diminutivo_unidad_medida"];
													}
												?>
											</p>
											<?php if($ultimo["nro_estacionamiento"] > 0){ ?>
											<p class="bedrom"><i class="fa fa-car"></i> <?php echo $ultimo["nro_estacionamiento"];?> Garage</p>
											<?php } ?>
										</div>

									</div>
								</div>

								<?php
								}
								?>

							</div>
						</div>
						-->
						<!-- /.row -->

						<div class="spacer-30"></div>

					</section>

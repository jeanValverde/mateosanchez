					<?php
						include("rutinas.php"); 
						
						$sql_propiedad 	= "SELECT * FROM propiedades";
						$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
						$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
						$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
						$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
						$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
						$sql_propiedad .= " WHERE is_hidden=0 AND img_01_propiedad <> 'imagen-referencial.png' ORDER BY RAND()LIMIT 9";
						
					
						$cursor_propiedad = $conexion -> query($sql_propiedad);
						$triple = 0;
						while($propiedad = $cursor_propiedad -> fetch()){
						
					?>
					<div class="col-md-4 class-propiedades">
												<div class="panel panel-default">
								<div class="panel-image">
									<img class="img-responsive img-hover" src="img/propiedades/<?php echo $propiedad["img_01_propiedad"];?>">
									<div class="img_hov_eff">
										<div>
											<span style="color: white;"><?php echo substr($propiedad["detalle_propiedad"], 0, 345)."...";?></span>
										</div>
										<div style="text-align: right; margin-top: 10px;">
											<a class="btn btn-default btn_trans" href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> Ver m&aacute;s </a>
										</div>
									</div>
								</div>
								<div class="sal_labl">
									En <?php if($propiedad["id_tipo_operacion"] == 1 || $propiedad["id_tipo_operacion"] == 3){echo "Arriendo";}else{echo utf8_encode($propiedad["nombre_tipo_operacion"]);}?>
								</div>
								
								<div class="sal_labl cod_labl">
									COD: <?php echo $propiedad["cod_propiedad"];?>
								</div>
								<div class="panel-body">
									<!--
									<div class="prop_feat">
										<p class="area"><i class="fa fa-home"></i>
										<?php
											if($propiedad["cantidad_superficie_total_propiedad"] > 0){
												echo "Superficie: ".$propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
											}else{
												echo "Superficie: ".$propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
											}
										?>
										</p>
										<p class="bedrom"><i class="fa fa-bed"></i> <?php echo $propiedad["dormitorios_propiedad"];?> Piezas</p>
										<p class="bedrom"><i class="fa fa-money"></i> CLP </p>
									</div>
									<h3 class="sec_titl">
										<?php echo utf8_encode($propiedad["nombre_tipo_propiedad"]);?> - <?php echo utf8_encode($propiedad["nombre_comuna"]); ?>
									</h3>
									
									<p class="sec_desc">
										<?php echo substr($propiedad["detalle_propiedad"], 0, 70)."...";?>
									</p>
									-->
									<div class="panel_bottom">
										<div class="col-md-6">
											<p class="price text-left"> <?php echo $propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"]);?></p>
										</div>
										<div class="col-md-6">
											<p class="readmore text-right"> <a href="ficha-propiedad.php?cod_propiedad=<?php echo $propiedad["cod_propiedad"];?>"> Ver m&aacute;s </a> </p>
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
						</div>					
						<?php
						$triple += 1;
						if(fmod($triple, 3) == 0){
						?>
						<div class="spacer-30"></div>
						<?php
						}
						?>
						<?php
							}
						?>
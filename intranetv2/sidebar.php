							
							<!-- SIDEBAR -->
                            <aside class="col-md-3 sidebar" id="sidebar">
								<!-- widget -->
                                <div class="widget shadow widget-find-property">
                                    <h4 class="widget-title">Buscar propiedades</h4>
                                    <div class="widget-content">
                                        <!-- Search form -->
                                        <div class="form-search light">
                                            <form action="resultado-buscador.php">
                                                <div class="form-group has-icon has-label">
                                                    <label for="formSearchUpLocation3">C&oacute;digo</label>
                                                    <input type="text" class="form-control" name="cod_propiedad" id="formSearchUpLocation3">
                                                </div>

                                                <div class="form-group has-label">
                                                    <label>Tipo operaci&oacute;n</label>
                                                    <select name="id_tipo_operacion" class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" title="Select">
                                                        <option value="">Cualquiera</option>
														<?php
														$sql_tipo_operacion = "SELECT * FROM tipo_operaciones ORDER BY id_tipo_operacion";
														$cursor_tipo_operacion = $conexion -> query($sql_tipo_operacion);
														while($tipo_operacion = $cursor_tipo_operacion -> fetch()){
														?>
															<option value="<?php echo $tipo_operacion["id_tipo_operacion"];?>"><?php echo $tipo_operacion["nombre_tipo_operacion"];?></option>
														<?php
														}
														?>
                                                    </select>
                                                </div>

                                                <div class="form-group has-label">
                                                    <label>Tipo propiedad</label>
                                                    <select name="id_tipo_propiedad" class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" data-size="5" title="Select">
                                                        <option value="">Cualquiera</option>
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
															<option value="<?php echo $tipo_propiedad["id_tipo_propiedad"];?>"><?php echo $tipo_propiedad["nombre_tipo_propiedad"];?></option>
															<?php
															}
														}
														?>
                                                    </select>
                                                </div>
												
												<div class="form-group has-label">
                                                    <label>Lugar</label>
                                                    <select name="lugar_propiedad" class="selectpicker input-price" data-live-search="true" data-width="100%" data-toggle="tooltip" data-size="5" title="Select">
														<option value="">Cualquiera</option>
														<optgroup label="Regiones">
														<?php
														$sql_region = "SELECT * FROM regiones INNER JOIN propiedades ON regiones.id_region = propiedades.id_region GROUP BY regiones.id_region";
														
														$cursor_region = $conexion -> query($sql_region);
														while($region = $cursor_region -> fetch()){
															echo "<option value='r".$region["id_region"]."'>".$region["nro_romano"]." - ".$region["nombre_region"]."</option>";
														}
														?>
														</optgroup>
														
														<optgroup label="Comunas">
														<?php
														$sql_comuna = "SELECT * FROM comunas INNER JOIN propiedades ON comunas.id_comuna = propiedades.id_comuna GROUP BY comunas.id_comuna";
														
														$cursor_comuna = $conexion -> query($sql_comuna);
														while($comuna = $cursor_comuna -> fetch()){
															echo "<option value='c".$comuna["id_comuna"]."'>".$comuna["nombre_comuna"]."</option>";
														}
														?>
														</optgroup>
														
														<optgroup label="Sectores">
														<?php
														$sql_sector = "SELECT * FROM sectores INNER JOIN propiedades ON sectores.id_sector = propiedades.id_sector GROUP BY sectores.id_sector";
														
														$cursor_sector = $conexion -> query($sql_sector);
														while($sector = $cursor_sector -> fetch()){
															echo "<option value='s".$sector["id_sector"]."'>".$sector["nombre_sector"]."</option>";
														}
														?>
														</optgroup>
                                                    </select>
                                                </div>
												
												<div class="form-group has-label">
                                                    <label>Direcci&oacute;n</label>
                                                    <input type="text" class="form-control" name="direccion_propiedad">
                                                </div>
												
												<div class="form-group">
                                                    <label>Destino</label>
                                                    <select name="id_tipo_giro" class="selectpicker input-price">
														<option value="">Cualquiera</option>
														<?php
														$sql_tipo_giro = "SELECT * FROM tipo_giros ORDER BY id_tipo_giro";
														$cursor_tipo_giro = $conexion -> query($sql_tipo_giro);
														while($tipo_giro = $cursor_tipo_giro -> fetch()){
														?>
															<option value="<?php echo $tipo_giro["id_tipo_giro"];?>"><?php echo $tipo_giro["nombre_tipo_giro"];?></option>
														<?php
														}
														?>
                                                    </select>
                                                </div>
												
												<div class="form-group">
                                                    <label>Tipo moneda</label>
                                                    <select name="id_tipo_valor" class="selectpicker input-price">
														<?php
														$sql_tipo_valor = "SELECT * FROM tipo_valores ORDER BY id_tipo_valor";
														$cursor_tipo_valor = $conexion -> query($sql_tipo_valor);
														while($tipo_valor = $cursor_tipo_valor -> fetch()){
														?>
															<option value="<?php echo $tipo_valor["id_tipo_valor"];?>"><?php echo $tipo_valor["nombre_tipo_valor"];?></option>
														<?php
														}
														?>
                                                    </select>
                                                </div>
												
												<div class="form-group has-label">
                                                    <label>Valor desde</label>
                                                    <input type="text" class="form-control format_precio" name="valor_desde">
                                                </div>
												
												<div class="form-group has-label">
                                                    <label>Valor hasta</label>
                                                    <input type="text" class="form-control format_precio" name="valor_hasta">
                                                </div>

                                                <button type="submit" id="formSearchSubmit3" class="btn btn-submit btn-theme btn-theme-dark btn-block">Buscar</button>

                                            </form>
                                        </div>
                                        <!-- /Search form -->
                                    </div>
                                </div>
                                <!-- /widget -->
                            </aside>
                            <!-- /SIDEBAR -->
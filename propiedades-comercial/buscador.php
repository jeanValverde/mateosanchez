			<!-- Search Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="srch_frm">
                        <h3>Busca tu propiedad</h3>
                        <form action="resultado-buscador.php" id="buscador_propiedad">
                            <div class="control-group form-group">
                                <!--
								<div class="controls col-md-3 first">
                                    <label>Palabra clave </label>
                                    <input type="text" class="form-control" id="keyword" required="" data-validation-required-message="Please enter a keyword." placeholder="Palabra clave">
                                    <p class="help-block"></p>
                                </div>
								-->

								<div class="controls col-md-3 first">
                                    <label>C&oacute;digo </label>
                                    <input type="text" class="form-control" id="cod_propiedad" name="cod_propiedad" placeholder="EJ: 6789">
                                </div>

                                <div class="controls col-md-3">
                                    <label>Regi&oacute;n</label>
                                    <select name="id_region" id="id_region" class="form-control">
                                        <option value="" selected="selected">Cualquier lugar</option>
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

								<div class="controls col-md-3">
                                    <label>Comuna</label>
                                    <select class="form-control" id="id_comuna" name="id_comuna">
                                        <option value="-" selected="selected">Cualquiera</option>
                                    </select>
                                </div>

								<div class="controls col-md-3">
                                    <label>Sector</label>
                                    <select class="form-control" id="id_sector" name="id_sector">
                                        <option value="-" selected="selected">Cualquiera</option>
                                    </select>
                                </div>

                                <div class="clearfix"></div>
                            </div>

                            <div class="control-group form-group col-md-11">
                                <div class="controls col-md-3 first">
                                    <label>Tipo propiedad </label>
                                    <select class="form-control" id="id_tipo_propiedad" name="id_tipo_propiedad">
                                        <option value="-">Cualquiera</option>
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

								<div class="controls col-md-3">
                                    <label>Tipo Operaci&oacute;n </label>
                                    <select class="form-control" id="id_tipo_operacion" name="id_tipo_operacion">
                                        <option value="-">Cualquiera</option>
                                        <option value="1">Arrienda</option>
                                        <option value="2">Vende</option>
                                        <option value="5">Derecho a Llave</option>
                                    </select>
                                </div>
                                <!-- <div class="controls col-md-3">
                                  <label>Valor Desde</label>
                                  <input type="text" class="form-control format_precio" name="valor_desde">
                                </div>
                                <div class="controls col-md-3">
                                  <label>Valor Hasta </label>
                                  <input type="text" class="form-control format_precio" name="valor_hasta">
                                </div> -->

								<!-- <div class="controls col-md-3">
                                    <label>Mostrar en </label>
                                    <select class="form-control" name="id_tipo_valor" id="id_tipo_valor">
                                        <option value="1" selected="selected"> Pesos (CLP) </option>
                                        <option value="2">Unidad de Fomento (UF)</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div> -->
                                <div class="clearfix"></div>

                            </div>
                            <div class="sub_btn col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                            <div class="clearfix"></div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <script>
                $('#buscador_propiedad').on('change', '#id_region', function(){
                    $.ajax({
                  type: "POST",
                  url: "../admin/php/selector_comuna_buscador.php",
                  data: {id: $('#id_region').val()},
                  cache: false,
                  beforeSend: function () {

                  },
                  success: function(html){
                      $('#id_comuna').html(html);
                  }
              });
                })

                $('#buscador_propiedad').on('change', '#id_comuna', function(){
                    $.ajax({
                  type: "POST",
                  url: "../admin/php/selector_sector_buscador.php",
                  data: {id: $('#id_comuna').val()},
                  cache: false,
                  beforeSend: function () {

                  },
                  success: function(html){
                      $('#id_sector').html(html);
                  }
              });
                });


                $('#buscador_propiedad2').on('change', '#id_region', function(){
                    $.ajax({
                  type: "POST",
                  url: "../admin/php/selector_comuna_buscador.php",
                  data: {id: $('#id_region').val()},
                  cache: false,
                  beforeSend: function () {

                  },
                  success: function(html){
                      $('#id_comuna').html(html);
                  }
              });
                })

                $('#buscador_propiedad2').on('change', '#id_comuna', function(){
                    $.ajax({
                  type: "POST",
                  url: "../admin/php/selector_sector_buscador.php",
                  data: {id: $('#id_comuna').val()},
                  cache: false,
                  beforeSend: function () {

                  },
                  success: function(html){
                      $('#id_sector').html(html);
                  }
                });
                });



                $('#feat_propty').on('click', '.btn_toggle_propiedades', function(){
                  //$().removeClass("display", "block");
                  //$('#'+$(this).attr("id")).addClass('data_missing');
                $('#grupo_'+$(this).attr("id")).toggleClass('hidden');
                  //alert('asdf');
                  event.preventDefault();
                });
            </script>

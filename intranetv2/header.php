			<!-- HEADER -->
            <header class="header fixed hidden-print">
                <div class="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <!-- Navigation -->
                            <div class="col-md-8 left-menu">
                                <nav class="navigation closed clearfix">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <!-- navigation menu -->
                                            <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>
                                            <ul class="nav sf-menu">
                                                <li><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
												<li><a href="crear-nota.php">Crear notas</a></li>
												<li><a href="ver-notas.php?id_receptor=">Ver notas</a></li>
												<?php
												if($_SESSION["id_cuenta"] == 7 || $_SESSION["id_cuenta"] == 8){
												?>
												<li><a href="cotizar-letreros.php">Cotizar letreros</a></li>
												<?php
												}
												?>
												<li><a href="http://mateosanchez.cl/" target="_blank">Ir al sitio</a></li>
												<li><a href="cerrar_sesion.php">Cerrar sesi&oacute;n</a></li>
                                            </ul>
                                            <!-- /navigation menu -->
                                        </div>
                                    </div>
                                </nav>

                                <!-- Mobile menu toggle button -->
                                <a href="#" class="menu-toggle btn ripple-effect btn-theme-transparent"><i class="fa fa-bars"></i></a>
                                <!-- /Mobile menu toggle button -->
                            </div>
                            <!-- /Navigation -->

                            <!-- Logo -->
                            <div class="col-md-4 no-padding top-logo" style="position: absolute; right: -50px; top: -60px;">
                                <div class="form-group col-md-12">
									<input type="hidden" id="id_cuenta_nota_dinamica" value="<?php echo $_SESSION["id_cuenta"]; ?>"></input>
									<textarea class="form-control" style="border: 1px solid black" id="detalle_nota_dinamica" rows="8"><?php echo $nota_dinamica["detalle_nota_dinamica"]; ?></textarea>
								</div>
								<button type="button" id="btn-borrar-nota-dinamica" class="btn btn-success pull-right">Borrar</button>
                            </div>
                            <!-- /Logo -->
                        </div>
                    </div>
                </div>
            </header>
            <!-- /HEADER -->
			<script>
				
			</script>
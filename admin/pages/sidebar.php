			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li><a href="home.php">Inicio</a></li>
                        <li><a href="ver-propiedades.php?is_hidden=0">Ver propiedades activas</a></li>
						<li><a href="ver-propiedades.php?is_hidden=1">Ver baul propiedades</a></li>
						<?php if($_COOKIE["nivel_cuenta"] < 3){ ?>
						<li>
                            <a href="#"><span>Agentes asociados</span></a>
                            <ul class="nav nav-second-level">
								<li>
                                    <a href="agregar-corredor.php">Agregar agente</a>
                                </li>
                                <li>
                                    <a href="ver-corredores.php">Manejar agentes</a>
                                </li>
                            </ul>
                        </li>
						<?php } ?>
						<!--
						<li>
                            <a href="#"><i class="fa fa-inbox fa-fw"></i> Listado de propiedades<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">


								<li>
                                    <a href="ver-propiedades-entregadas.php">Ver propiedades entregadas</a>
                                </li>
								<?php
								if($_COOKIE["nivel_cuenta"] < 3){
								?>
								<li>
                                    <a href="ver-propiedades-antiguas.php?is_hidden=1">Ver baul propiedades</a>
                                </li>
								<?php
								}
								?>

                            </ul>
                        </li>
                    	-->
						<?php
						if($_COOKIE["nivel_cuenta"] <= 4 || $_COOKIE["id_cuenta"] == 15){
						?>
						<li><a href="reservar-documento-captacion.php">Crear contrato: Paso N&deg; 1</a></li>
						<li><a href="ver-documento-captacion.php">Editar contrato: Paso N&deg; 2</a></li>
                        <?php
						if($_COOKIE["nivel_cuenta"] <= 2){
						?>
						<li>
                            <a href="#">Grupo de Propiedades<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="crear-grupo-propiedades.php">Crear Nuevo Grupo</a>
                                </li>
								<li>
                                    <a href="ver-grupos-propiedades.php">Ver listado de grupos</a>
                                </li>
                            </ul>

                        </li>
												<li>
						                            <a href="#">Propiedades TOP<span class="fa arrow"></span></a>
						                            <ul class="nav nav-second-level">
						                                <li>
						                                    <a href="crear-grupo-propiedades-top.php">Crear Nuevo Grupo Top</a>
						                                </li>
														<li>
						                                    <a href="ver-grupos-propiedades-top.php">Ver listado de grupos Top</a>
						                                </li>
						                            </ul>

						                        </li>
						<?php
						}
						?>
						<?php
						}
						?>
						<!--
						<?php
						if($_COOKIE["nivel_cuenta"] <= 1){
						?>
						<li>
                            <a href="#"><i class="fa fa-inbox fa-fw"></i> Documentador: Orden de Visita (EN PRUEBA) <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="generar-documento-visita.php">Crear documento visita</a>
                                </li>
								<li>
                                    <a href="ver-documento-visita.php">Ver documento visita activos</a>
                                </li>
                            </ul>
                        </li>
						<?php
						}
						?>
						-->
						<!--
						<?php
						if($_COOKIE["nivel_cuenta"] < 3){
						?>
						<li>
							<a href="#"><i class="fa fa-inbox fa-fw"></i> Contratos temporales (EN PRUEBA)<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li>
									<a href="ver-propiedades-temporada.php">Crear contrato temporada</a>
								</li>
								<li>
									<a href="ver-contrato-temporada.php">Ver estado de propiedades de temporada</a>
								</li>
							</ul>
						</li>
						<?php
						}
						?>
						-->
						<?php
						if($_COOKIE["nivel_cuenta"] < 2){
						?>
						<li><a href="enviar-peticion.php">Solicitud instlaci&oacute;n carteles</a></li>
						<?php
						}
						?>
						<?php if($_COOKIE["nivel_cuenta"] < 3 || $_COOKIE["id_cuenta"] == 20 || $_COOKIE["id_cuenta"] == 19 || $_COOKIE["id_cuenta"] == 3){?>
						<li>
							<a href="generar-excel-baul.php"> Generar Excel propiedades</a>
						</li>
						<!--
						<li>
							<a href="generar-excel.php"> Generar Excel propiedades activas</a>
						</li>
						-->
						<?php } ?>
						<?php if($_COOKIE["nivel_cuenta"] < 4 || $_COOKIE["id_cuenta"] == 15){ ?>
                        <li><a href="ver-comunas.php">Crear / Editar Comunas</a></li>
						<li><a href="ver-sectores.php">Crear / Editar Sectores</a></li>
						<?php } ?>
						<li><a href="editar-cuenta.php">Edita tu cuenta</a></li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

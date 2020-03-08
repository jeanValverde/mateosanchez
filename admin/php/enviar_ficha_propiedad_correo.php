<?php
	session_start();
	require_once('rutinas.php');
	
	$is_fail = 0;
	$_SESSION["mensaje-sistema"] = "";
	
	//$_POST["cod_propiedad"] = "8066";
	//$_POST["correo_contacto"] = "ignacio.peralta@pcdstudio.cl";
	
	
	//Se valida que esten todos los datos necesarios para el proceso
	if(isset($_POST["correo_contacto"]) && isset($_POST["cod_propiedad"])){
		$sql_propiedad = "SELECT * FROM propiedades";
		$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
		$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
		$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
		$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
		$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
		$sql_propiedad .= " INNER JOIN regiones ON propiedades.id_region=regiones.id_region";
		$sql_propiedad .= " INNER JOIN sectores ON propiedades.id_sector=sectores.id_sector";
		$sql_propiedad .= " WHERE is_hidden=0 AND cod_propiedad=".$_POST["cod_propiedad"];
		
		$cursor_propiedad = $conexion -> query($sql_propiedad);
		$propiedad = $cursor_propiedad -> fetch();
		
		$html = "<html>";
		$html .= "
			<head>
				<style>
					body { font-family: cursive; font-size: 11pt; }
					p { text-align: justify; margin-bottom: 4pt;  margin-top:0pt; }

					hr {width: 70%; height: 1px; 
					text-align: center; color: #999999; 
					margin-top: 8pt; margin-bottom: 8pt; }

					a {	color: #b71e24; font-style: normal; text-decoration: underline; 
					font-weight: normal; }

					pre { font-family: cursive; font-size: 9pt; margin-top: 5pt; margin-bottom: 5pt; }

					h1 {font-weight: normal; font-size: 26pt; color: #000; 
					font-family: cursive; margin-top: 18pt; margin-bottom: 6pt; 
					border-top: 0.075cm solid #B81517; border-bottom: 0.075cm solid #B81517; 
					page-break-after:avoid; }

					h2 {font-weight: bold; font-size: 12pt; color: #000; 
					font-family: cursive; margin-top: 6pt; margin-bottom: 6pt; 
					border-top: 0.07cm solid #B81517; border-bottom: 0.07cm solid #B81517; 
					text-transform: uppercase; page-break-after:avoid; }

					h3 {font-weight: normal; font-size: 26pt; color: #B81517; 
					font-family: cursive; margin-top: 0pt; margin-bottom: 6pt; 
					border-top: 0; border-bottom: 0; 
					page-break-after:avoid; }

					h4 {font-weight: ; font-size: 13pt; color: #9f2b1e; 
					font-family: cursive; margin-top: 10pt; margin-bottom: 7pt; 
					font-variant: small-caps;
					margin-collapse:collapse; page-break-after:avoid; }

					h5 {font-weight: bold; font-style:italic; ; font-size: 11pt; color: #000044; 
					font-family: cursive; margin-top: 8pt; margin-bottom: 4pt; 
					page-break-after:avoid; }

					h6 {font-weight: bold; font-size: 9.5pt; color: #333333; 
					font-family: cursive; margin-top: 6pt; margin-bottom: ; 
					text-align: ;  page-break-after:avoid; }


					.breadcrumb {
					text-align: right; font-size: 8pt; font-family: DejaVuSerifCondensed, serif; color: #666666;
					font-weight: bold; font-style: normal; margin-bottom: 6pt; }

					.infobox { margin-top:10pt; background-color:#DDDDBB; text-align:center; border:1px solid #880000; }

					.big { font-size: 1.5em; }
					.red { color: #880000; }
					.slanted { font-style: italic; }

					table {font-family: cursive; font-size: 14pt; line-height: 1.2; 
					margin-top: 2pt; margin-bottom: 5pt;
					border-collapse: collapse; color: #fff;}

					thead {	font-weight: bold; vertical-align: bottom; }
					tfoot {	font-weight: bold; vertical-align: top; }
					thead td { font-weight: bold; }
					tfoot td { font-weight: bold; }

					.headerrow td, .headerrow th { background-gradient: linear #b7cebd #f5f8f5 0 1 0 0.2;  }
					.footerrow td, .footerrow th { background-gradient: linear #b7cebd #f5f8f5 0 1 0 0.2;  }

					th {	font-weight: bold; 
					vertical-align: top; 
					padding-left: 2mm; 
					padding-right: 2mm; 
					padding-top: 0.5mm; 
					padding-bottom: 0.5mm; 
					}

					td {	padding-left: 2mm; 
					vertical-align: top; 
					padding-right: 2mm; 
					padding-top: 0.5mm; 
					padding-bottom: 0.5mm;
					color: #fff;
					}

					th p { margin:0pt;  }
					td p { margin:0pt; color: #fff; }
				</style>
			</head>
		";
		$html .= "<body style='background: rgba(255, 203, 8, 0.3);'>";
			$html .= "";
			$html .= "<table align='center' style='width: 750px; background-image: url(http://mateosanchez.cl/css/images/texture.jpg); background-color: #2a2625;'>";
				$html .= "<tbody>";
					$html .= "<tr>";
						$html .= "<td colspan='3'>";
							$html .= "<img style='padding: 7px;' src='http://mateosanchez.cl/images/logo-web.png'>";
						$html .= "</td>";
					$html .= "</tr>";
					$html .= "<tr>";
						$html .= "<td colspan='3'>";
							$html .= "<h4 style='color: #9f2b1e;'>Propiedad c&oacute;digo: ".$propiedad["cod_propiedad"]."</h4>";
						$html .= "</td>";
					$html .= "</tr>";
					$html .= "<tr>";
						$html .= "<td width='50%'>";
							$html .= "<table width = '100%'>";
								$html .= "<tr>";
									$html .= "<td width = '50%' style='color: #fff;'>Tipo de propiedad: </td>";
									$html .= "<td width = '50%' style='color: #fff;' align='right'>".$propiedad["nombre_tipo_propiedad"]."</td>";
								$html .= "</tr>";
								
								$html .= "<tr>";
									$html .= "<td style='color: #fff;'>Tipo de operaci&oacute;n: </td>";
									$html .= "<td style='color: #fff;' align='right'>".$propiedad["nombre_tipo_operacion"]."</td>";
								$html .= "</tr>";
									
								$html .= "<tr>";	
									$html .= "<td style='color: #fff;'>Precio de la propiedad: </td>";
									$html .= "<td style='color: #fff;' align='right'>".$propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"])."</td>";
								$html .= "</tr>";
									
									if($propiedad["cantidad_superficie_total_propiedad"] > 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Superficie total: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"]."</td>";
										$html .= "</tr>";
									}
									
									if($propiedad["cantidad_superficie_construida_propiedad"] > 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Superficie construida: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"]."</td>";
										$html .= "</tr>";
									}
									
									if($propiedad["nro_estacionamiento"] > 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Estacionamientos: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["nro_estacionamiento"]."</td>";
										$html .= "</tr>";
									}
									
									$html .= "<tr>";
										$html .= "<td style='color: #fff;'>Regi&oacute;n: </td>";
										$html .= "<td style='color: #fff;' align='right'>".$propiedad["nombre_region"]."</td>";
									$html .= "</tr>";
										
									$html .= "<tr>";
										$html .= "<td style='color: #fff;'>Comuna: </td>";
										$html .= "<td style='color: #fff;' align='right'>".$propiedad["nombre_comuna"]."</td>";
									$html .= "</tr>";
									
									if($propiedad["id_sector"] != 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Sector: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["nombre_sector"]."</td>";
										$html .= "</tr>";
									}
									
									if( $propiedad["banos_propiedad"] != 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Ba&ntilde;os: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["banos_propiedad"]."</td>";
										$html .= "</tr>";
									}
									
									if($propiedad["dormitorios_propiedad"] != 0){
										$html .= "<tr>";
											$html .= "<td style='color: #fff;'>Dormitorios: </td>";
											$html .= "<td style='color: #fff;' align='right'>".$propiedad["dormitorios_propiedad"]."</td>";
										$html .= "</tr>";
									}
								
							$html .= "</table>";
						$html .= "</td>";
						//$html .= "<td width='4%'></td>";
						$html .= "<td width='50%'>";
							$html .= "<table width = '100%'>";
								$html .= "<tr>";
									$html .= "<td><img width='325' src='http://mateosanchez.cl/img/propiedades/".$propiedad["img_01_propiedad"]."'><td>";
								$html .= "</tr>";
								$html .= "<tr>";
									$html .= "<td align='center'><a style='color: #9f2b1e;' href='http://www.mateosanchez.cl/ficha-propiedad.php?cod_propiedad=".$propiedad["cod_propiedad"]."'>M&aacute;s informaci&oacute;n aqu&iacute;</a></td>";
								$html .= "</tr>";
							$html .= "</table>";
						$html .= "</td>";
					$html .= "</tr>";
					
					//$html .= "<tr>";
					//	$html .= "<td colspan='3'>";
					//		$html .= "<h4>&nbsp;</h4>";
					//	$html .= "</td>";
					//$html .= "</tr>";
					//
					//$html .= "<tr>";
					//	$html .= "<td colspan='3'>";
					//		$html .= "<h4>&nbsp;</h4>";
					//	$html .= "</td>";
					//$html .= "</tr>";
					
					$html .= "<tr>";
						$html .= "<td colspan='3'>";
							$html .= "<h4 style='color: #9f2b1e;'>Detalles propiedad</h4>";
						$html .= "</td>";
					$html .= "</tr>";
					
					$html .= "<tr>";
						$html .= "<td colspan='3' style='text-align: justify;'>";
							$html .= "<p style='color: #fff;'>".utf8_decode($propiedad["detalle_propiedad"])."</p>";
						$html .= "</td>";
					$html .= "</tr>";
					
					//$html .= "<tr>";
					//	$html .= "<td colspan='3' style='text-align: justify;'>";
					//		$html .= "<table width = '100%'>";
					//			$html .= "<tr>";
					//				if($propiedad["img_02_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='http://mateosanchez.cl/img/propiedades/".$propiedad["img_02_propiedad"]."'><td>";}
					//				if($propiedad["img_03_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='http://mateosanchez.cl/img/propiedades/".$propiedad["img_03_propiedad"]."'><td>";}
					//				if($propiedad["img_04_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='http://mateosanchez.cl/img/propiedades/".$propiedad["img_04_propiedad"]."'><td>";}
					//			$html .= "</tr>";
					//		$html .= "</table>";
					//	$html .= "</td>";
					//$html .= "</tr>";
					$html .= "<tr>";
						$html .= "<td colspan='3'>";
							$html .= "<h4>&nbsp;</h4>";
						$html .= "</td>";
					$html .= "</tr>";
					$html .= "<tr>";
						$html .= "<td colspan='3'>";
							$html .= "<img src='http://mateosanchez.cl/images/img-pie-pagina-blanco.png'>";
						$html .= "</td>";
					$html .= "</tr>";
					
					
				$html .= "</tbody>";
			$html .= "</table>";
		$html .= "</body>";
		$html .= "</html>";
		
		$correo_contacto = $_POST["correo_contacto"];
		
		//Se inicia el proceso de envio del correo
		$subject = "Envio de ficha de propiedad: ".$_POST["cod_propiedad"];
		$message = $html;

		require_once("class.phpmailer.php");
		require_once("class.smtp.php");
		
		$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
		try {
			$mail->SMTPDebug = 4;                               // Enable verbose debug output
			$mail->isSMTP();                                    // Set mailer to use SMTP
			$mail->SMTPDebug = false;
			$mail->do_debug = 0;
			$mail->Host = gethostbyname('mail.mateosanchez.cl'); 		// Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                             // Enable SMTP authentication
			$mail->Username = 'no-reply@mateosanchez.cl';   // SMTP username
			$mail->Password = 'mateo.,123';                     // SMTP password
			$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
			$mail->From = "info@mateosanchez.cl";
			$mail->FromName = "Mateo Sanchez Propiedades";
			$mail->addAddress($correo_contacto, "Cliente");     // Add a recipient test: "ignacio.peralta@pcdstudio.cl", "Ignacio Peralta Sistema"
			//$mail->addReplyTo("ignacio.peralta.l2@gmail.com", "Ignacio Peralta Prueba");		//Add recipient original: "info@mateosanchez.cl", "Mateo Sanchez Propiedades"
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(false);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $message;
			$mail->AltBody = 'Enviado por el sistema de propiedades mateosanchez.cl';
			if(!$mail->send()) {
				$is_fail = 1;
				$_SESSION["mensaje-sistema"] = 'Error: ' . $mail->ErrorInfo;
			} else {
				$_SESSION["mensaje-sistema"] = 'Ficha de la propiedad enviada con exito, que tenga un buen dia.';
			}
			$errors[] = "Send mail sucsessfully";
		} catch (phpmailerException $e) {
			$errors[] = $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			$errors[] = $e->getMessage(); //Boring error messages from anything else!
		}
		
		
	}else{
		$is_fail = 1;
		$_SESSION["mensaje-sistema"] = "Falta correo de la persona, favor intentar nuevamente.";
	}
	
	if($is_fail != 0){
		$tipo_mensaje = "alert-danger";
	}else{
		$tipo_mensaje = "alert-success";
	}
	
	$_SESSION["mensaje-sistema"] = getMessage($tipo_mensaje, $_SESSION["mensaje-sistema"]);
	
	//echo $html;
	header("location: ../../intranet/ficha-propiedad.php?cod_propiedad=".$_POST["cod_propiedad"]);
?>
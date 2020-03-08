<?php
	session_start();
	require_once('rutinas.php');
	
	
	
	$is_reservado = 1;
	$is_hidden = 1;
	
	$html = "
		<head>
			<style>
				body { font-family: DejaVuSansCondensed, sans-serif; font-size: 10pt;  }
				p { text-align: justify; margin-bottom: 4pt;  margin-top:0pt; }

				hr {width: 70%; height: 1px; 
				text-align: center; color: #999999; 
				margin-top: 8pt; margin-bottom: 8pt; }

				a {	color: #000066; font-style: normal; text-decoration: underline; 
				font-weight: normal; }

				pre { font-family: DejaVuSansMono, monospaced; font-size: 9pt; margin-top: 5pt; margin-bottom: 5pt; }

				h1 {font-weight: normal; font-size: 26pt; color: #000; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 18pt; margin-bottom: 6pt; 
				border-top: 0.075cm solid #B81517; border-bottom: 0.075cm solid #B81517; 
				text-align: ; page-break-after:avoid; }

				h2 {font-weight: bold; font-size: 12pt; color: #000; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 6pt; margin-bottom: 6pt; 
				border-top: 0.07cm solid #B81517; border-bottom: 0.07cm solid #B81517; 
				text-align: ;  text-transform: uppercase; page-break-after:avoid; }

				h3 {font-weight: normal; font-size: 26pt; color: #B81517; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 0pt; margin-bottom: 6pt; 
				border-top: 0; border-bottom: 0; 
				text-align: ; page-break-after:avoid; }

				h4 {font-weight: ; font-size: 13pt; color: #9f2b1e; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 10pt; margin-bottom: 7pt; 
				font-variant: small-caps;
				text-align: ;  margin-collapse:collapse; page-break-after:avoid; }

				h5 {font-weight: bold; font-style:italic; ; font-size: 11pt; color: #000044; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 8pt; margin-bottom: 4pt; 
				text-align: ;  page-break-after:avoid; }

				h6 {font-weight: bold; font-size: 9.5pt; color: #333333; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 6pt; margin-bottom: ; 
				text-align: ;  page-break-after:avoid; }


				.breadcrumb {
				text-align: right; font-size: 8pt; font-family: DejaVuSerifCondensed, serif; color: #666666;
				font-weight: bold; font-style: normal; margin-bottom: 6pt; }

				.infobox { margin-top:10pt; background-color:#DDDDBB; text-align:center; border:1px solid #880000; }

				.big { font-size: 1.5em; }
				.red { color: #880000; }
				.slanted { font-style: italic; }

				table {font-family: 'DejaVu Sans Condensed'; font-size: 14pt; line-height: 1.2; 
				margin-top: 2pt; margin-bottom: 5pt;
				border-collapse: collapse; }

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
				}

				th p { margin:0pt;  }
				td p { margin:0pt;  }
			</style>
		</head>
		
		<body style='background-image: url(../../images/bg-pdf-opacity.png); background-repeat: no-repeat; background-position: 45% 45%;'>
	";
	$html .= "<!--mpdf";
		$html .= "<htmlpagefooter name='myfooter'>";
			$html .= "<div>";
				$html .= "<img src='../../images/img-pie-pagina.png'>";
			$html .= "</div>";
		$html .= "</htmlpagefooter>";

		$html .= "<sethtmlpageheader name='myheader' value='on' show-this-page='1' />";
		$html .= "<sethtmlpagefooter name='myfooter' value='on' />";
		$html .= "mpdf-->";
		
		
		$html .= "<img src='../../images/logo-web.png'>";
		$html .= "<h1>Contrato Arriendo Habitacional c&oacute;digo: ".$_GET["cod_propiedad"]."</h1>";
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Vi&ntilde;a del mar, a _____________________________________________ de 20__.";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Don(a) _______________________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Domicilio ____________________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Rut __________________________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Tel&eacute;fono _____________________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Email ________________________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Nombre contacto ____________________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "N&uacute;mero telef&oacute;nico contacto __________________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='text-align: justify;'>";
						$html .= "Por intermedio del presente documento, el suscrito pone a disposici&oacute;n de do&ntilde;a <b>BARBARA SYBELLA MARCOLETA SILVA PROPIEDADES E.I.R.L, Rut: 76.190.666-6,</b> para todos los efectos <b>MATEO SANCHEZ PROPIEDADES,</b> la propiedad que a continuaci&oacute;n se singulariza, con el fin de que esta oficina de corretaje intermedie en forma:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<b>CONDICIONES:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='width: 340px; border: 1px solid black;'>";
						$html .= "AUTORIZA EXCLUSIVIDAD: SI <input type='checkbox'> NO <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "AUTORIZA PUBLICIDAD: SI <input type='checkbox'> NO <input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black; padding: 10px;'>";
						$html .= "PLAZO DE EXCLUSIVIDAD: DESDE ___________  HASTA ____________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "ENTREGA DE LLAVES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI <input type='checkbox'> NO <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "VALOR:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UF <input type='checkbox'> $ <input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<b>INDIVIDUALIZACI&Oacute;N DEL INMUEBLE:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black;' height='50'>";
						$html .= "DIRECCI&Oacute;N:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "SUPERFICIE TOTAL:";
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "SUPERFICIE CONSTRUIDA:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black; width: 200px;'>";
						$html .= "N&deg; DE ROL:";
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black;'>";
						$html .= "RECEPCI&Oacute;N DEFINITIVA MUNICIPAL:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black; padding: 10px;'>";
						$html .= "INSCRITA A FOJAS _____, N&Uacute;MERO _____, C.B.R. ____________ A&Ntilde;O ____";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
			$html .= "</tbody>";
		$html .= "</table>";
		
		// FIN PAGINA 1
		
		$html .= "<img src='../../images/logo-web.png'>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='4'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='2'>";
						$html .= "<b>TIPO DE PROPIEDAD:</b>";
					$html .= "</td>";
					
					$html .= "<td colspan='2'>";
						$html .= "<b>TIPO DE OPERACI&Oacute;N:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='width: 300px;'>";
						$html .= "CASA";
					$html .= "</td>";
					
					$html .= "<td style='width: 100px;' align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td style='width: 300px;'>";
						$html .= "VENTA";
					$html .= "</td>";
					
					$html .= "<td style='width: 100px;' align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "DEPARTAMENTO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "ARRIENDO A&Ntilde;O CORRIDO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "LOCAL";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "ARRIENDO TEMPORADA";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "OFICINA";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "ADMINISTRACI&Oacute;N";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "GALP&Oacute;N";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "DERECHO DE LLAVE";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "TERRENO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "OTRO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td colspan='2'>";
						$html .= "_____________________________________________";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='4'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "PISOS PROPIEDAD: ";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "A&Ntilde;O CONSTRUCCI&Oacute;N:";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='4'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='5'>";
						$html .= "<b>GIRO</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "HABITACIONAL <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMERCIAL <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "INDUSTRIAL <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "AGR&Iacute;COLA <input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "OFICINA <input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='5'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "<b>UBICACI&Oacute;N</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "REGI&Oacute;N";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "CIUDAD";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black' width='150'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMUNA";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black' width='150'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='10'>";
						$html .= "<b>DISTRIBUCI&Oacute;N DE LA PROPIEDAD:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "LIVING - COMEDOR";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "LIVING";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMEDOR";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COCINA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMEDOR DIARIO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "SECTOR DE LOGIA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "BODEGA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "CHIMENEA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "LAVADERO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='10'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='8'>";
						$html .= "<b>DORMITORIOS: N&deg;___ O PRIVADOS: N&deg;___</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "PRINCIPAL EN SUITE";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "DE SERVICIO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "WALKING CLOSET";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "CLASIC";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='8'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "<b>BA&Ntilde;OS: N&deg;___</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "BA&Ntilde;O COMPLETO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "DE SERVICIO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "MEDIO BA&Ntilde;O";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "<b>CARACTER&Iacute;STICAS:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "ESTACIONAMIENTO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "N&deg;: ___ ANTE-JARDIN";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "PATIO TRASERO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "QUINCHO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "SALA DE INTERNET";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "JUEGOS INFANTILES";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "PISINA T&deg;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "PISCINA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "LAVANDERIA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "SAL&Oacute;N MULTIUSO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "CONSERJERIA";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "GIMNASIO";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "RECEPCI&Oacute;N";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<input type='checkbox'>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='6'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		//---------------------------FIN PAGINA 2------------------------
		
		$html .= "<img src='../../images/logo-web.png'>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>OBSERVACI&Oacute;N GENERAL:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black' height='150'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				
				$html .= "<tr>";
					$html .= "<td style='text-align: justify;'>";
						$html .= "De concretarse en definitiva el arriendo de esta <b>propiedad residencial,</b> a trav&eacute;s de esta oficina de corretaje el cliente pagar&aacute; un honorario equivalente al 50% del valor del arriendo, m&aacute;s el impuesto respectivo. (IVA).";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='text-align: justify;'>";
						$html .= "En virtud de lo anterior, el Cliente, pagar&aacute; este honorario igualmente, si en forma directa o indirecta procediera a su venta, prescindiendo de la intermediaci&oacute;n de esta oficina de corretaje, siempre y cuando los clientes hayan sido presentados por <b>MATEO SANCHEZ PROPIEDADES.</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='text-align: justify;'>";
						$html .= "Cualquiera dificultad sobre la procedencia, monto o el cobro de los honorarios aqu&iacute; pactados, ser&aacute; resuelta por el abogado habilitado don <b>FRANCISCO RIOSECO ARAG&Oacute;N,</b> o en su defecto por el abogado habilitado don <b>JUAN CARLOS LOBOS PEREZ,</b> quienes actuar&aacute;n como &aacute;rbitros arbitradores y amigables componedores, sobre los cuales no proceder&aacute; reclamo sin forma alguna de juicio ni recurso alguno.";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='text-align: justify;'>";
						$html .= "Para todos los efectos legales, se deja constancia que las partes fijan domicilio en la ciudad de Vi&ntilde;a del Mar, someti&eacute;ndose a la Jurisdicci&oacute;n de sus Tribunales.";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>BARBARA SYBELLA MARCOLETA</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Nombre: </b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>SILVA PROPIEDADES E.I.R.L</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Rut: </b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>Rut N&deg; 76.190.666-6</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>&nbsp;</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>pp. _______________________________</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Firma: ____________________________</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>Rut. _______________________________</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		//----------------------FIN PAGINA 3--------------------------------
	$html .= "</body>";
	
	include("../../pdf/mpdf.php");
	$mpdf=new mPDF('', 'FOLIO'); 

	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

	// LOAD a stylesheet
	//$stylesheet = file_get_contents('css/cargar-pdf-propiedad.css');
	//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

	$mpdf->WriteHTML($html);

	$mpdf->Output('ficha-propiedad-mateoshanchezcl.pdf','I');
	
	$sql_validar = "SELECT * FROM propiedades WHERE cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_validar = $conexion -> query($sql_validar);
	
	if(!$validar = $cursor_validar -> rowCount()){
		$validar = 0;
	}
	
	if($validar == 0){
		$sql = "INSERT INTO propiedades ";
		$sql .= "(cod_propiedad, "; //:param_01
		$sql .= "is_reservado, "; //:param_02
		$sql .= "is_hidden) "; //:param_03
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03)";
		
		//Con el SQL listo se armara la transaccion PDO
		
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $_GET["cod_propiedad"]);
		$inserta -> bindValue(':param_02', $is_reservado);
		$inserta -> bindValue(':param_03', $is_hidden);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		$inserta -> execute();
		$conexion -> commit();
	}
	
	exit;
?>

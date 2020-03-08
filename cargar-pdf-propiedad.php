<?php
	session_start();
	require_once('admin/php/rutinas.php');
	
	if(isset($_GET["id_propiedad"])){
		$sql_propiedad = "SELECT * FROM propiedades";
		$sql_propiedad .= " INNER JOIN unidad_medidas ON propiedades.id_unidad_medida=unidad_medidas.id_unidad_medida";
		$sql_propiedad .= " INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion=tipo_operaciones.id_tipo_operacion";
		$sql_propiedad .= " INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad=tipo_propiedades.id_tipo_propiedad";
		$sql_propiedad .= " INNER JOIN tipo_valores ON propiedades.id_tipo_valor=tipo_valores.id_tipo_valor";
		$sql_propiedad .= " INNER JOIN comunas ON propiedades.id_comuna=comunas.id_comuna";
		$sql_propiedad .= " INNER JOIN regiones ON propiedades.id_region=regiones.id_region";
		$sql_propiedad .= " INNER JOIN sectores ON propiedades.id_sector=sectores.id_sector";
		$sql_propiedad .= " WHERE is_hidden=0 AND id_propiedad=".$_GET["id_propiedad"];
		
		$cursor_propiedad = $conexion -> query($sql_propiedad);
		if(!$validar_propiedad = $cursor_propiedad -> rowCount()){
			$validar_propiedad = 0;
		}
	}else{
		$validar_propiedad = 0;
	}
	
	$propiedad = $cursor_propiedad -> fetch();
	
	$html = "
		<head>
			<style>
				body { font-family: DejaVuSansCondensed, sans-serif; font-size: 11pt;  }
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
		
		<body style='background-image: url(images/bg-pdf.png); background-repeat: no-repeat; background-position: 45% 45%; background-image-opacity: 0.3;'>
	";
	$html .= "<!--mpdf";
		$html .= "<htmlpagefooter name='myfooter'>";
			$html .= "<div>";
				$html .= "<img src='images/img-pie-pagina.png'>";
			$html .= "</div>";
		$html .= "</htmlpagefooter>";

		$html .= "<sethtmlpageheader name='myheader' value='on' show-this-page='1' />";
		$html .= "<sethtmlpagefooter name='myfooter' value='on' />";
		$html .= "mpdf-->";
		
		
		$html .= "<img src='images/logo-web.png'>";
		$html .= "<h1>Propiedad c&oacute;digo: ".$propiedad["cod_propiedad"]."</h1>";
		$html .= "<p class='breadcrumb'>www.mateosanchez.cl &raquo; ficha propiedad</p>";
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>Ficha propiedad</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				$html .= "<tr>";
					$html .= "<td width='50%'>";
						$html .= "<table width = '100%'>";
							$html .= "<tr>";
								$html .= "<td width = '50%'>Tipo de propiedad: </td>";
								$html .= "<td width = '50%' align='right'>".utf8_encode($propiedad["nombre_tipo_propiedad"])."</td>";
							$html .= "</tr>";
							
							$html .= "<tr>";
								$html .= "<td>Tipo de operaci&oacute;n: </td>";
								$html .= "<td align='right'>".utf8_encode($propiedad["nombre_tipo_operacion"])."</td>";
							$html .= "</tr>";
								
							$html .= "<tr>";	
								$html .= "<td>Precio de la propiedad: </td>";
								$html .= "<td align='right'>".$propiedad["simbologia_tipo_valor"].mostrarPrecio($propiedad["valor_propiedad"])."</td>";
							$html .= "</tr>";
								
								if($propiedad["cantidad_superficie_total_propiedad"] > 0){
									$html .= "<tr>";
										$html .= "<td>Superficie total: </td>";
										$html .= "<td align='right'>".$propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"]."</td>";
									$html .= "</tr>";
								}
								
								if($propiedad["cantidad_superficie_construida_propiedad"] > 0){
									$html .= "<tr>";
										$html .= "<td>Superficie construida: </td>";
										$html .= "<td align='right'>".$propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"]."</td>";
									$html .= "</tr>";
								}
								
								if($propiedad["nro_estacionamiento"] > 0){
									$html .= "<tr>";
										$html .= "<td>Estacionamientos: </td>";
										$html .= "<td align='right'>".$propiedad["nro_estacionamiento"]."</td>";
									$html .= "</tr>";
								}
								
								$html .= "<tr>";
									$html .= "<td>Regi&oacute;n: </td>";
									$html .= "<td align='right'>".utf8_encode($propiedad["nombre_region"])."</td>";
								$html .= "</tr>";
									
								$html .= "<tr>";
									$html .= "<td>Comuna: </td>";
									$html .= "<td align='right'>".utf8_encode($propiedad["nombre_comuna"])."</td>";
								$html .= "</tr>";
								
								if($propiedad["id_sector"] != 0){
									$html .= "<tr>";
										$html .= "<td>Sector: </td>";
										$html .= "<td align='right'>".utf8_encode($propiedad["nombre_sector"])."</td>";
									$html .= "</tr>";
								}
								
								if( $propiedad["banos_propiedad"] != 0){
									$html .= "<tr>";
										$html .= "<td>Ba&ntilde;os: </td>";
										$html .= "<td align='right'>".$propiedad["banos_propiedad"]."</td>";
									$html .= "</tr>";
								}
								
								if($propiedad["dormitorios_propiedad"] != 0){
									$html .= "<tr>";
										$html .= "<td>Dormitorios: </td>";
										$html .= "<td align='right'>".$propiedad["dormitorios_propiedad"]."</td>";
									$html .= "</tr>";
								}
							
						$html .= "</table>";
					$html .= "</td>";
					//$html .= "<td width='4%'></td>";
					$html .= "<td width='50%'>";
						$html .= "<table width = '100%'>";
							$html .= "<tr>";
								$html .= "<td><img width='325' src='propiedades/".$propiedad["img_01_propiedad"]."'><td>";
							$html .= "</tr>";
							$html .= "<tr>";
								$html .= "<td align='center'><a href='http://mateosanchez.cl/propiedades-comercial/ficha-propiedad.php?cod_propiedad=".$propiedad["cod_propiedad"]."'>Ver m&aacute;s fotografias</a></td>";
							$html .= "</tr>";
						$html .= "</table>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>&nbsp;</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<h4>Detalles propiedad</h4>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='text-align: justify;'>";
						$html .= "<p>".$propiedad["detalle_propiedad"]."</p>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='text-align: justify;'>";
						$html .= "<table width = '100%'>";
							$html .= "<tr>";
								if($propiedad["img_02_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='propiedades/".$propiedad["img_02_propiedad"]."'><td>";}
								if($propiedad["img_03_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='propiedades/".$propiedad["img_03_propiedad"]."'><td>";}
								if($propiedad["img_04_propiedad"] != "imagen-referencial.png"){$html .= "<td><img width='215' src='propiedades/".$propiedad["img_04_propiedad"]."'><td>";}
							$html .= "</tr>";
						$html .= "</table>";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
	$html .= "</body>";
	
	include("pdf/mpdf.php");
	$mpdf=new mPDF(); 

	$mpdf->SetDisplayMode('fullpage');
	$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list

	// LOAD a stylesheet
	//$stylesheet = file_get_contents('css/cargar-pdf-propiedad.css');
	//$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text

	$mpdf->WriteHTML($html);

	$mpdf->Output('ficha-propiedad-'.$propiedad["cod_propiedad"].'.pdf','I');
	
	echo $html;
	
	exit;
?>

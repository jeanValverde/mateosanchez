<?php
	session_start();
	require_once("rutinas.php");
	
	$sql_documento_propiedad = "SELECT * FROM documentos_propiedades ";
	$sql_documento_propiedad .= "INNER JOIN tipo_documentos ON documentos_propiedades.id_tipo_documento = tipo_documentos.id_tipo_documento ";
	$sql_documento_propiedad .= "WHERE documentos_propiedades.cod_propiedad = ".$_GET["cod_propiedad"];
	$cursor_documento_propiedad = $conexion -> query($sql_documento_propiedad);
	$documento_propiedad = $cursor_documento_propiedad -> fetch();
	
	$sql_propiedad = "SELECT * FROM propiedades ";
	$sql_propiedad .= "INNER JOIN unidad_medidas ON propiedades.id_unidad_medida = unidad_medidas.id_unidad_medida ";
	$sql_propiedad .= "INNER JOIN regiones ON propiedades.id_region = regiones.id_region ";
	$sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
	$sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
	$sql_propiedad .= "WHERE cod_propiedad=".$_GET["cod_propiedad"];
	$cursor_propiedad = $conexion->query($sql_propiedad);
	$propiedad = $cursor_propiedad -> fetch();
	
	$array_fecha = explode("-",$propiedad["fecha_captacion_propiedad"]);
		
	$dia = $array_fecha[2];
	$mes = $array_fecha[1];
	if ($mes==1){$mes="Enero";}
	if ($mes==2){$mes="Febrero";}
	if ($mes==3){$mes="Marzo";}
	if ($mes==4){$mes="Abril";}
	if ($mes==5){$mes="Mayo";}
	if ($mes==6){$mes="Junio";}
	if ($mes==7){$mes="Julio";}
	if ($mes==8){$mes="Agosto";}
	if ($mes==9){$mes="Setiembre";}
	if ($mes==10){$mes="Octubre";}
	if ($mes==11){$mes="Noviembre";}
	if ($mes==12){$mes="Diciembre";}
	$ano = $array_fecha[0];
	
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

				table {
					font-family: 'DejaVu Sans Condensed'; font-size: 10pt; line-height: 1.2; 
					margin-bottom: 10px;
					border-collapse: separate; 
					border-spacing:  5px 5px;
				}

				td {
					vertical-align: top; 
					padding-left: 2mm; 
					padding-right: 2mm; 
					padding-top: 0.5mm; 
					padding-bottom: 0.5mm;
				}
			</style>
		</head>
	";
	
	$html .= "<body style='background-image: url(../../images/bg-pdf-opacity.png); background-repeat: no-repeat; background-position: 45% 45%;'>";
		$html .= '
		<!-- defines the headers/footers - this must occur before the headers/footers are set -->

		<!--mpdf

		<htmlpageheader name="myHTMLHeader1">
			<table width="100%">
				<tr>
					<td><img src="../../images/logo-web.png" /></td>
				</tr>
			</table>
		</htmlpageheader>

		<htmlpageheader name="myHTMLHeader1Even">
			<table width="100%">
				<tr>
					<td><img src="../../images/logo-web.png" /></td>
				</tr>
			</table>
		</htmlpageheader>

		<htmlpageheader name="myHTMLHeader2">
			<table width="100%">
				<tr>
					<td><img src="../../images/logo-web.png" /></td>
				</tr>
			</table>
		</htmlpageheader>

		<htmlpageheader name="myHTMLHeader2Even">
			<table width="100%">
				<tr>
					<td><img src="../../images/logo-web.png" /></td>
				</tr>
			</table>
		</htmlpageheader>

		mpdf-->

		<!-- set the headers/footers - they will occur from here on in the document -->
		<!--mpdf
		<sethtmlpageheader name="myHTMLHeader1" page="O" value="on" show-this-page="1" />
		<sethtmlpageheader name="myHTMLHeader1Even" page="E" value="on" />
		mpdf-->
		
		<!--mpdf
		<htmlpagefooter name="myfooter">
			<div>
				<img src="../../images/img-pie-pagina.png">
			</div>
		</htmlpagefooter>
		
		<htmlpagefooter name="myfooterEven">
			<div>
				<img src="../../images/img-pie-pagina.png">
			</div>
		</htmlpagefooter>
		
		<sethtmlpagefooter name="myfooter" value="on" />
		<sethtmlpagefooter name="myfooterEven" page="E" value="on" />
		mpdf-->
		';
		
		switch ($documento_propiedad["id_tipo_documento"]) {
			case 1:
				$html .= "<h1>Contrato Arriendo Comercial c&oacute;digo: ".$documento_propiedad["cod_propiedad"]."</h1>";
				break;
			case 2:
				$html .= "<h1>Contrato Arriendo Habitacional c&oacute;digo: ".$documento_propiedad["cod_propiedad"]."</h1>";
				break;
			case 3:
				$html .= "<h1>Contrato Venta Comercial c&oacute;digo: ".$documento_propiedad["cod_propiedad"]."</h1>";
				break;
			case 4:
				$html .= "<h1>Contrato Venta Habitacional c&oacute;digo: ".$documento_propiedad["cod_propiedad"]."</h1>";
				break;
		}
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
			
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Vi&ntilde;a del mar, a ".str_pad($dia." de ".$mes." del ".$ano, 100, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Don(a) ".str_pad($documento_propiedad["nombre_cliente"], 110, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Domicilio ".str_pad($documento_propiedad["direccion_cliente"], 106, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Rut ".str_pad($documento_propiedad["rut_cliente"], 113, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Tel&eacute;fono ".str_pad($documento_propiedad["telefono_cliente"], 106, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Email ".str_pad($documento_propiedad["correo_cliente"], 112, "_", STR_PAD_LEFT);
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Nombre contacto ".str_pad($documento_propiedad["nombre_contacto_cliente"], 100, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "N&uacute;mero telef&oacute;nico contacto ".str_pad($documento_propiedad["telefono_contacto_cliente"], 87, "_", STR_PAD_LEFT).".";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='text-align: justify;'>";
						$html .= "Por intermedio del presente documento, el suscrito pone a disposici&oacute;n de do&ntilde;a <b>BARBARA SYBELLA MARCOLETA SILVA PROPIEDADES E.I.R.L, Rut: 76.190.666-6,</b> para todos los efectos <b>MATEO SANCHEZ PROPIEDADES,</b> la propiedad que a continuaci&oacute;n se singulariza, con el fin de que esta oficina de corretaje intermedie en forma:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<b>CONDICIONES:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='width: 340px; border: 1px solid black; padding: 7px;'>";
						//esta tomando el is_exclusivo de propiedades hay que separar los dos campos.
						if($documento_propiedad["is_exclusivo"] == 1){
							$html .= "AUTORIZA EXCLUSIVIDAD: SI <input checked='checked' type='checkbox'> NO <input type='checkbox'>";
						}else{
							$html .= "AUTORIZA EXCLUSIVIDAD: SI <input type='checkbox'> NO <input checked='checked' type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						if($documento_propiedad["is_publicidad"] == 1){
							$html .= "AUTORIZA PUBLICIDAD: SI <input checked='checked' type='checkbox'> NO <input type='checkbox'>";
						}else{
							$html .= "AUTORIZA PUBLICIDAD: SI <input type='checkbox'> NO <input checked='checked' type='checkbox'>";
						}
						
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black; padding: 7px;'>";
						if($documento_propiedad["is_exclusivo"] == 1){
							$html .= "PLAZO DE EXCLUSIVIDAD: DESDE ".invertirFecha($documento_propiedad["plazo_exclusividad_inicio"])."  HASTA ".invertirFecha($documento_propiedad["plazo_exclusividad_fin"])." RENOVABLE AUTOMATICAMENTE "; 
							if($documento_propiedad["is_renovable"] == 1){
								$html .= "SI <input checked='checked' type='checkbox'> NO <input type='checkbox'>";
							}else{
								$html .= "SI <input type='checkbox'> NO <input checked='checked' type='checkbox'>";
							}
						}else{
							$html .= "PLAZO DE EXCLUSIVIDAD: DESDE ___________  HASTA ____________ RENOVABLE AUTOMATICAMENTE SI <input type='checkbox'> NO <input checked='checked' type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						if($documento_propiedad["is_entrega_llaves"] == 1){
							$html .= "ENTREGA DE LLAVES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI <input checked='checked' type='checkbox'> NO <input type='checkbox'>";
						}else{
							$html .= "ENTREGA DE LLAVES:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI <input type='checkbox'> NO <input checked='checked' type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						if($propiedad["id_tipo_valor"] == 1){
							$html .= "VALOR:".str_replace('~', '&nbsp;', str_pad('$'.mostrarPrecio($propiedad["valor_propiedad"]), 50, '~', STR_PAD_LEFT))." UF <input type='checkbox'> $ <input checked='checked' type='checkbox'>";
						}else{
							$html .= "VALOR:".str_replace('~', '&nbsp;', str_pad(mostrarPrecio($propiedad["valor_propiedad"]), 50, '~', STR_PAD_LEFT))." UF <input checked='checked' type='checkbox'> $ <input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<b>INDIVIDUALIZACI&Oacute;N DEL INMUEBLE:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black;' height='50'>";
						$html .= "DIRECCI&Oacute;N:";
						$html .= "<div style='width: 100%; display: block'>".$propiedad["direccion_propiedad"]."</div>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						if($propiedad["cantidad_superficie_total_propiedad"] > 0){
							$html .= "SUPERFICIE TOTAL: ".$propiedad["cantidad_superficie_total_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
						}else{
							$html .= "SUPERFICIE TOTAL: ";
						}
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						if($propiedad["cantidad_superficie_construida_propiedad"] > 0){
							$html .= "SUPERFICIE CONSTRUIDA: ".$propiedad["cantidad_superficie_construida_propiedad"]." ".$propiedad["diminutivo_unidad_medida"];
						}else{
							$html .= "SUPERFICIE CONSTRUIDA: ";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black; width: 200px; padding: 7px;'>";
						$html .= "N&deg; DE ROL: ".$propiedad["rol_propiedad"];
					$html .= "</td>";
					
					$html .= "<td style='width: 10px;'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black; padding: 7px;'>";
						$html .= "RECEPCI&Oacute;N DEFINITIVA MUNICIPAL:";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black; padding: 7px;'>";
						$html .= "INSCRITA A FOJAS ".str_pad($documento_propiedad["inscrito_fojas"], 5, "_", STR_PAD_LEFT).", N&Uacute;MERO ".str_pad($documento_propiedad["inscrito_numero"], 5, "_", STR_PAD_LEFT).", A&Ntilde;O ".str_pad($documento_propiedad["inscrito_ano"], 5, "_", STR_PAD_LEFT).", C.B.R. ".str_pad($documento_propiedad["inscrito_cbr"], 10, "_", STR_PAD_LEFT)." ";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3' style='border: 1px solid black;' height='50'>";
						$html .= "OBSERVACIONES:";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				
				$html .= "<tr>";
					$html .= "<td colspan='2'>";
						$html .= "<b>DESCRIPCI&Oacute;N DE LA PROPIEDAD:</b>";
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
						if($propiedad["id_tipo_propiedad"] == 1){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td style='width: 300px;'>";
						$html .= "VENTA";
					$html .= "</td>";
					
					$html .= "<td style='width: 100px;' align='right'>";
						if($propiedad["id_tipo_operacion"] == 2){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "DEPARTAMENTO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_propiedad"] == 2){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "ARRIENDO A&Ntilde;O CORRIDO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_operacion"] == 1){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "LOCAL";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_propiedad"] == 10){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "ARRIENDO TEMPORADA";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_operacion"] == 3){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "OFICINA";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_propiedad"] == 11){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
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
						if($propiedad["id_tipo_propiedad"] == 7){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "DERECHO DE LLAVE";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_operacion"] == 4){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "TERRENO";
					$html .= "</td>";
					
					$html .= "<td align='right'>";
						if($propiedad["id_tipo_propiedad"] == 3){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
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
					$html .= "<td>";
						$html .= "CONTRIBUCIONES: ";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black'>";
						$html .= "&nbsp;";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "GASTO COM&Uacute;N:";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='10'>";
						$html .= "<b>GIRO</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "HABITACIONAL";
					$html .= "</td>";
					
					$html .= "<td>";
						if($propiedad["id_tipo_giro"] == 1){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMERCIAL";
					$html .= "</td>";
					
					$html .= "<td>";
						if($propiedad["id_tipo_giro"] == 2){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "INDUSTRIAL";
					$html .= "</td>";
					
					$html .= "<td>";
						if($propiedad["id_tipo_giro"] == 3){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "AGR&Iacute;COLA";
					$html .= "</td>";
					
					$html .= "<td>";
						if($propiedad["id_tipo_giro"] == 5){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "TRASPASO DE NEGOCIO";
					$html .= "</td>";
					
					$html .= "<td>";
						if($propiedad["id_tipo_giro"] == 4){
							$html .= "<input checked='checked' type='checkbox'>";
						}else{
							$html .= "<input type='checkbox'>";
						}
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
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
						$html .= "".$propiedad["nro_romano"]."";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "COMUNA";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black' width='150'>";
						$html .= utf8_encode($propiedad["nombre_comuna"]);
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "SECTOR";
					$html .= "</td>";
					
					$html .= "<td style='border: 1px solid black' width='150'>";
						$html .= utf8_encode($propiedad["nombre_sector"]);
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
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
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
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
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
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
						$html .= "ANTE-JARDIN";
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
						$html .= "PISCINA T&deg;";
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
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%'>";
			$html .= "<tbody>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>OBSERVACI&Oacute;N A LA PROPIEDAD:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td style='border: 1px solid black' height='110'>";
						$html .= "&nbsp;";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		switch ($documento_propiedad["id_tipo_documento"]) {
			case 1:
				$html .= "<table style='width: 100%'>";
					$html .= "<tbody>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "De concretarse en definitiva el arriendo de esta <b>propiedad comercial,</b> a trav&eacute;s de esta oficina de corretaje el cliente pagar&aacute; un honorario equivalente al ".$documento_propiedad["porcentaje_editado_documento_propiedad"]."% del valor del arriendo, m&aacute;s el impuesto respectivo.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "En virtud de lo anterior, el Cliente, pagar&aacute; este honorario igualmente, si en forma directa o indirecta procediera a su venta, prescindiendo de la intermediaci&oacute;n de esta oficina de corretaje, siempre y cuando los clientes hayan sido presentados por <b>MATEO SANCHEZ PROPIEDADES.</b> Para este efecto deber&aacute; presentar la orden de visita que corresponda donde se acredite la mencionada visita.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Cualquiera dificultad sobre la procedencia, monto o el cobro de los honorarios aqu&iacute; pactados, ser&aacute; resuelta por el abogado habilitado don <b>FRANCISCO RIOSECO ARAG&Oacute;N,</b> o en su defecto por el abogado habilitado don <b>Erick Avsolomovich Pendola,</b> quienes actuar&aacute;n como &aacute;rbitros arbitradores y amigables componedores, sobre los cuales no proceder&aacute; reclamo sin forma alguna de juicio ni recurso alguno.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Para todos los efectos legales, se deja constancia que las partes fijan domicilio en la ciudad de Vi&ntilde;a del Mar, someti&eacute;ndose a la Jurisdicci&oacute;n de sus Tribunales.";
							$html .= "</td>";
						$html .= "</tr>";
						
					$html .= "</tbody>";
				$html .= "</table>";
				break;
			case 2:
				$html .= "<table style='width: 100%'>";
					$html .= "<tbody>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "De concretarse en definitiva el arriendo de esta <b>propiedad habitacional,</b> a trav&eacute;s de esta oficina de corretaje el cliente pagar&aacute; un honorario equivalente al ".$documento_propiedad["porcentaje_editado_documento_propiedad"]."% del valor del arriendo, m&aacute;s el impuesto respectivo.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "En virtud de lo anterior, el Cliente, pagar&aacute; este honorario igualmente, si en forma directa o indirecta procediera a su venta, prescindiendo de la intermediaci&oacute;n de esta oficina de corretaje, siempre y cuando los clientes hayan sido presentados por <b>MATEO SANCHEZ PROPIEDADES.</b> Para este efecto deber&aacute; presentar la orden de visita que corresponda donde se acredite la mencionada visita.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Cualquiera dificultad sobre la procedencia, monto o el cobro de los honorarios aqu&iacute; pactados, ser&aacute; resuelta por el abogado habilitado don <b>FRANCISCO RIOSECO ARAG&Oacute;N,</b> o en su defecto por el abogado habilitado don <b>Erick Avsolomovich Pendola,</b> quienes actuar&aacute;n como &aacute;rbitros arbitradores y amigables componedores, sobre los cuales no proceder&aacute; reclamo sin forma alguna de juicio ni recurso alguno.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Para todos los efectos legales, se deja constancia que las partes fijan domicilio en la ciudad de Vi&ntilde;a del Mar, someti&eacute;ndose a la Jurisdicci&oacute;n de sus Tribunales.";
							$html .= "</td>";
						$html .= "</tr>";
						
					$html .= "</tbody>";
				$html .= "</table>";
				break;
			case 3:
				$html .= "<table style='width: 100%'>";
					$html .= "<tbody>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "De concretarse en definitiva el arriendo de esta <b>propiedad comercial,</b> a trav&eacute;s de esta oficina de corretaje el cliente pagar&aacute; un honorario equivalente al ".$documento_propiedad["porcentaje_editado_documento_propiedad"]."% del valor de la compraventa, m&aacute;s el impuesto respectivo.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "En virtud de lo anterior, el Cliente, pagar&aacute; este honorario igualmente, si en forma directa o indirecta procediera a su venta, prescindiendo de la intermediaci&oacute;n de esta oficina de corretaje, siempre y cuando los clientes hayan sido presentados por <b>MATEO SANCHEZ PROPIEDADES.</b> Para este efecto deber&aacute; presentar la orden de visita que corresponda donde se acredite la mencionada visita.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Cualquiera dificultad sobre la procedencia, monto o el cobro de los honorarios aqu&iacute; pactados, ser&aacute; resuelta por el abogado habilitado don <b>FRANCISCO RIOSECO ARAG&Oacute;N,</b> o en su defecto por el abogado habilitado don <b>Erick Avsolomovich Pendola,</b> quienes actuar&aacute;n como &aacute;rbitros arbitradores y amigables componedores, sobre los cuales no proceder&aacute; reclamo sin forma alguna de juicio ni recurso alguno.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Para todos los efectos legales, se deja constancia que las partes fijan domicilio en la ciudad de Vi&ntilde;a del Mar, someti&eacute;ndose a la Jurisdicci&oacute;n de sus Tribunales.";
							$html .= "</td>";
						$html .= "</tr>";
						
					$html .= "</tbody>";
				$html .= "</table>";
				break;
			case 4:
				$html .= "<table style='width: 100%'>";
					$html .= "<tbody>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "De concretarse en definitiva el arriendo de esta <b>propiedad habitacional,</b> a trav&eacute;s de esta oficina de corretaje el cliente pagar&aacute; un honorario equivalente al ".$documento_propiedad["porcentaje_editado_documento_propiedad"]."% del valor de la compraventa, m&aacute;s el impuesto respectivo.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "En virtud de lo anterior, el Cliente, pagar&aacute; este honorario igualmente, si en forma directa o indirecta procediera a su venta, prescindiendo de la intermediaci&oacute;n de esta oficina de corretaje, siempre y cuando los clientes hayan sido presentados por <b>MATEO SANCHEZ PROPIEDADES.</b> Para este efecto deber&aacute; presentar la orden de visita que corresponda donde se acredite la mencionada visita.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Cualquiera dificultad sobre la procedencia, monto o el cobro de los honorarios aqu&iacute; pactados, ser&aacute; resuelta por el abogado habilitado don <b>FRANCISCO RIOSECO ARAG&Oacute;N,</b> o en su defecto por el abogado habilitado don <b>Erick Avsolomovich Pendola,</b> quienes actuar&aacute;n como &aacute;rbitros arbitradores y amigables componedores, sobre los cuales no proceder&aacute; reclamo sin forma alguna de juicio ni recurso alguno.";
							$html .= "</td>";
						$html .= "</tr>";
						
						$html .= "<tr>";
							$html .= "<td style='text-align: justify;'>";
								$html .= "Para todos los efectos legales, se deja constancia que las partes fijan domicilio en la ciudad de Vi&ntilde;a del Mar, someti&eacute;ndose a la Jurisdicci&oacute;n de sus Tribunales.";
							$html .= "</td>";
						$html .= "</tr>";
						
					$html .= "</tbody>";
				$html .= "</table>";
				break;
		}
		
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
	
	//echo $html;
	
	//==============================================================
	//==============================================================
	//==============================================================

	include("../../pdf/mpdf.php");

	$mpdf=new mPDF('','FOLIO','','',10,10,42,30,10,10); 

	$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

	$mpdf->WriteHTML($html);

	$mpdf->Output('ORDEN ARRIENDO COMERCIAL COD'.$_GET["cod_propiedad"].'.pdf','I');


	//==============================================================
	//==============================================================
	//==============================================================
	
	exit;
?>
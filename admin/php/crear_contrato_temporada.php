<?php
	session_start();
	require_once("rutinas.php");
	
	//$sql_documento_propiedad = "SELECT * FROM documentos_propiedades ";
	//$sql_documento_propiedad .= "INNER JOIN tipo_documentos ON documentos_propiedades.id_tipo_documento = tipo_documentos.id_tipo_documento ";
	//$sql_documento_propiedad .= "WHERE documentos_propiedades.cod_propiedad = ".$_GET["cod_propiedad"];
	//$cursor_documento_propiedad = $conexion -> query($sql_documento_propiedad);
	//$documento_propiedad = $cursor_documento_propiedad -> fetch();
	
	$sql_propiedad = "SELECT * FROM propiedades ";
	$sql_propiedad .= "INNER JOIN unidad_medidas ON propiedades.id_unidad_medida = unidad_medidas.id_unidad_medida ";
	$sql_propiedad .= "INNER JOIN regiones ON propiedades.id_region = regiones.id_region ";
	$sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
	$sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
	$sql_propiedad .= "WHERE id_propiedad=".$_POST["id_propiedad"];
	$cursor_propiedad = $conexion->query($sql_propiedad);
	$propiedad = $cursor_propiedad -> fetch();
	
	$array_fecha = explode("-",$_POST["fecha_contrato_temporada"]);
		
	$dia = $array_fecha[2];
	$mes = date("F", $array_fecha[1]);
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Setiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";
	$ano = $array_fecha[0];
	
	function generar_string($base_string){
		$string_len = strlen($base_string);
		$string_final = str_replace(' ',"&nbsp;",str_pad($base_string, $string_len + 3, " ", STR_PAD_BOTH)); //STR_PAD_BOTH STR_PAD_LEFT
		return $string_final;
	}
	
	$nombre_arrendador_contrato_temporada_string = generar_string($_POST["nombre_arrendador_contrato_temporada"]);
	
	$rut_arrendador_contrato_temporada_string = generar_string($_POST["rut_arrendador_contrato_temporada"]);
	
	$nombre_arrendatario_contrato_temporada_string = generar_string($_POST["nombre_arrendatario_contrato_temporada"]);
	
	$rut_arrendatario_contrato_temporada_string = generar_string($_POST["rut_arrendatario_contrato_temporada"]);
	
	$domicilio_arrendatario_contrato_temporada_string = generar_string($_POST["domicilio_arrendatario_contrato_temporada"]);
	
	$ciudad_arrendatario_contrato_temporada_string = generar_string($_POST["ciudad_arrendatario_contrato_temporada"]);
	
	$pais_arrendatario_contrato_temporada_string = generar_string($_POST["pais_arrendatario_contrato_temporada"]);
	
	$domicilio_propiedad_contrato_temporada_string = generar_string($_POST["domicilio_propiedad_contrato_temporada"]);
	
	$nro_domicilio_propiedad_contrato_temporada_string = generar_string($_POST["nro_domicilio_propiedad_contrato_temporada"]);
	
	$comuna_propiedad_contrato_temporada_string = generar_string($_POST["comuna_propiedad_contrato_temporada"]);
	
	$sector_propiedad_contrato_temporada_string = generar_string($_POST["sector_propiedad_contrato_temporada"]);
	
	$nro_estacionamiento_contrato_temporada_string = generar_string($_POST["nro_estacionamiento_contrato_temporada"]);
	
	$fecha_contrato_cliente_inicio_string = generar_string(invertirFecha($_POST["fecha_contrato_cliente_inicio"])." - ".$_POST["hora_inicio_arriendo_contrato_temporada"]);
	
	$fecha_contrato_cliente_fin_string = generar_string(invertirFecha($_POST["fecha_contrato_cliente_fin"])." - ".$_POST["hora_fin_arriendo_contrato_temporada"]);
	
	$monto_arriendo_contrato_temporada_string = generar_string(mostrarPrecio($_POST["monto_arriendo_contrato_temporada"]));
	
	$nombre_persona_contrato_temporada = $_POST["nombre_persona_contrato_temporada"];
	
	$rut_persona_contrato_temporada = $_POST["rut_persona_contrato_temporada"];
	
	$edad_persona_contrato_temporada = $_POST["edad_persona_contrato_temporada"];
	
	$nacionalidad_persona_contrato_temporada = $_POST["nacionalidad_persona_contrato_temporada"];
	
	//Validar que la propiedad no se encuentra ya arrendada usando fechas
	$sql_contrato = "SELECT * FROM contratos_temporada WHERE cod_propiedad='".$propiedad["cod_propiedad"]."' AND '".$_POST["fecha_contrato_cliente_inicio"]."' BETWEEN fecha_contrato_cliente_inicio AND fecha_contrato_cliente_fin";
	$cursor_contrato = $conexion -> query($sql_contrato);
	if(!$validar_contrato = $cursor_contrato -> rowCount()){
		$validar_contrato = 0;
	}
	
	//Grabar datos en contratos_temporada
	if($validar_contrato == 0){
		$sql = "INSERT INTO contratos_temporada ";
		$sql .= "(cod_propiedad, "; //:param_01
		$sql .= "fecha_contrato_cliente_inicio, "; //:param_02
		$sql .= "fecha_contrato_cliente_fin, "; //:param_03
		$sql .= "fecha_contrato_temporada, "; //:param_04
		$sql .= "nombre_arrendador_contrato_temporada, "; //:param_05
		$sql .= "rut_arrendador_contrato_temporada, "; //:param_06
		$sql .= "nombre_arrendatario_contrato_temporada, "; //:param_07
		$sql .= "rut_arrendatario_contrato_temporada, "; //:param_08
		$sql .= "id_tipo_identificacion, "; //:param_09
		$sql .= "domicilio_arrendatario_contrato_temporada, "; //:param_10
		$sql .= "ciudad_arrendatario_contrato_temporada, "; //:param_11
		$sql .= "pais_arrendatario_contrato_temporada, "; //:param_12
		$sql .= "domicilio_propiedad_contrato_temporada, "; //:param_13
		$sql .= "nro_domicilio_propiedad_contrato_temporada, "; //:param_14
		$sql .= "comuna_propiedad_contrato_temporada, "; //:param_15
		$sql .= "sector_propiedad_contrato_temporada, "; //:param_16
		$sql .= "nro_estacionamiento_contrato_temporada, "; //:param_17
		$sql .= "hora_inicio_arriendo_contrato_temporada, "; //:param_18
		$sql .= "hora_fin_arriendo_contrato_temporada, "; //:param_19
		$sql .= "monto_arriendo_contrato_temporada, "; //:param_20
		$sql .= "monto_reserva_arriendo_contrato_temporada, "; //:param_21
		$sql .= "monto_comision_arriendo_contrato_temporada, "; //:param_22
		$sql .= "monto_aseo_arriendo_contrato_temporada, "; //:param_23
		$sql .= "monto_traslado_arriendo_contrato_temporada, "; //:param_24
		$sql .= "marca_vehiculo_contrato_temporada, "; //:param_25
		$sql .= "modelo_vehiculo_contrato_temporada, "; //:param_26
		$sql .= "placa_vehiculo_contrato_temporada, "; //:param_27
		$sql .= "nro_arrendatarios_contrato_temporada, "; //:param_28
		$sql .= "nro_adultos_contrato_temporada, "; //:param_29
		$sql .= "nro_ninos_contrato_temporada) "; //:param_30
		$sql .= "VALUES ";
		$sql .= "(:param_01, ";
		$sql .= ":param_02, ";
		$sql .= ":param_03, ";
		$sql .= ":param_04, ";
		$sql .= ":param_05, ";
		$sql .= ":param_06, ";
		$sql .= ":param_07, ";
		$sql .= ":param_08, ";
		$sql .= ":param_09, ";
		$sql .= ":param_10, ";
		$sql .= ":param_11, ";
		$sql .= ":param_12, ";
		$sql .= ":param_13, ";
		$sql .= ":param_14, ";
		$sql .= ":param_15, ";
		$sql .= ":param_16, ";
		$sql .= ":param_17, ";
		$sql .= ":param_18, ";
		$sql .= ":param_19, ";
		$sql .= ":param_20, ";
		$sql .= ":param_21, ";
		$sql .= ":param_22, ";
		$sql .= ":param_23, ";
		$sql .= ":param_24, ";
		$sql .= ":param_25, ";
		$sql .= ":param_26, ";
		$sql .= ":param_27, ";
		$sql .= ":param_28, ";
		$sql .= ":param_29, ";
		$sql .= ":param_30)";
		
		
		//Con el SQL listo se armara la transaccion PDO
		$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conexion -> beginTransaction();
		$inserta = $conexion -> prepare($sql);
		$inserta -> bindValue(':param_01', $propiedad["cod_propiedad"]);
		$inserta -> bindValue(':param_02', $_POST["fecha_contrato_cliente_inicio"]);
		$inserta -> bindValue(':param_03', $_POST["fecha_contrato_cliente_fin"]);
		$inserta -> bindValue(':param_04', $_POST["fecha_contrato_temporada"]);
		$inserta -> bindValue(':param_05', $_POST["nombre_arrendador_contrato_temporada"]);
		$inserta -> bindValue(':param_06', $_POST["rut_arrendador_contrato_temporada"]);
		$inserta -> bindValue(':param_07', $_POST["nombre_arrendatario_contrato_temporada"]);
		$inserta -> bindValue(':param_08', $_POST["rut_arrendatario_contrato_temporada"]);
		$inserta -> bindValue(':param_09', $_POST["id_tipo_identificacion"]);
		$inserta -> bindValue(':param_10', $_POST["domicilio_arrendatario_contrato_temporada"]);
		$inserta -> bindValue(':param_11', $_POST["ciudad_arrendatario_contrato_temporada"]);
		$inserta -> bindValue(':param_12', $_POST["pais_arrendatario_contrato_temporada"]);
		$inserta -> bindValue(':param_13', $_POST["domicilio_propiedad_contrato_temporada"]);
		$inserta -> bindValue(':param_14', $_POST["nro_domicilio_propiedad_contrato_temporada"]);
		$inserta -> bindValue(':param_15', $_POST["comuna_propiedad_contrato_temporada"]);
		$inserta -> bindValue(':param_16', $_POST["sector_propiedad_contrato_temporada"]);
		$inserta -> bindValue(':param_17', $_POST["nro_estacionamiento_contrato_temporada"]);
		$inserta -> bindValue(':param_18', $_POST["hora_inicio_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_19', $_POST["hora_fin_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_20', $_POST["monto_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_21', $_POST["monto_reserva_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_22', $_POST["monto_comision_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_23', $_POST["monto_aseo_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_24', $_POST["monto_traslado_arriendo_contrato_temporada"]);
		$inserta -> bindValue(':param_25', $_POST["marca_vehiculo_contrato_temporada"]);
		$inserta -> bindValue(':param_26', $_POST["modelo_vehiculo_contrato_temporada"]);
		$inserta -> bindValue(':param_27', $_POST["placa_vehiculo_contrato_temporada"]);
		$inserta -> bindValue(':param_28', $_POST["nro_arrendatarios_contrato_temporada"]);
		$inserta -> bindValue(':param_29', $_POST["nro_adultos_contrato_temporada"]);
		$inserta -> bindValue(':param_30', $_POST["nro_ninos_contrato_temporada"]);
		
		//Se genera el ejecutar de la sentencia con una salvaguarda por si falla
		if($inserta -> execute()){
			$id_contrato_temporada = $conexion->lastInsertId();
			$conexion -> commit();
			
			//Grabar personas anexadas al contrato
			if(count($_POST["nombre_persona_contrato_temporada"]) > 0){
				$array = $_POST["nombre_persona_contrato_temporada"];
				$cant = 0;
				foreach ($array as &$valor) {
					if(!empty($valor)){
						$sql = "INSERT INTO personas_contrato_temporada ";
						$sql .= "(nombre_persona_contrato_temporada, ";
						$sql .= "rut_persona_contrato_temporada, ";
						$sql .= "edad_persona_contrato_temporada, ";
						$sql .= "nacionalidad_persona_contrato_temporada, ";
						$sql .= "id_contrato_temporada) ";
						$sql .= "VALUES ";
						$sql .= "(:param_01, ";
						$sql .= ":param_02, ";
						$sql .= ":param_03, ";
						$sql .= ":param_04, ";
						$sql .= ":param_05)";
						
						//Con el SQL listo se armara la transaccion PDO
						$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$conexion -> beginTransaction();
						$inserta = $conexion -> prepare($sql);
						$inserta -> bindValue(':param_01', $valor);
						$inserta -> bindValue(':param_02', $_POST["rut_persona_contrato_temporada"][$cant]);
						$inserta -> bindValue(':param_03', $_POST["edad_persona_contrato_temporada"][$cant]);
						$inserta -> bindValue(':param_04', $_POST["nacionalidad_persona_contrato_temporada"][$cant]);
						$inserta -> bindValue(':param_05', $id_contrato_temporada);
						
						$inserta -> execute();
						$conexion -> commit();
					}
					$cant += 1;
				}
			}
		}
	}
	
	
	$html = "
		<head>
			<style>
				body { font-family: DejaVuSansCondensed, sans-serif; font-size: 10pt; }
				p { text-align: justify; margin-bottom: 4pt; margin-top:0pt; }

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
				text-align: center; text-transform: uppercase; text-decoration: underline; page-break-after:avoid; }

				h3 {font-weight: normal; font-size: 26pt; color: #B81517; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 0pt; margin-bottom: 6pt; 
				border-top: 0; border-bottom: 0; 
				text-align: ; page-break-after:avoid; }

				h4 {font-weight: ; font-size: 13pt; color: #9f2b1e; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 10pt; margin-bottom: 7pt; 
				font-variant: small-caps;
				text-align: ; margin-collapse:collapse; page-break-after:avoid; }

				h5 {font-weight: bold; font-style:italic; ; font-size: 11pt; color: #000044; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 8pt; margin-bottom: 4pt; 
				text-align: ; page-break-after:avoid; }

				h6 {font-weight: bold; font-size: 9.5pt; color: #333333; 
				font-family: DejaVuSansCondensed, sans-serif; margin-top: 6pt; margin-bottom: ; 
				text-align: ; page-break-after:avoid; }


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
					border-spacing: 5px 4px;
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
		
		$html .= "<h2>CONTATO ARRIENDO DE VERANO: ".$propiedad["cod_propiedad"]."</h2>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3' style='text-align: justify;'>";
						$html .= "En Vi&ntilde;a del Mar, a ".$dia." de ".$mes." del ".$ano.", comparecen: Por una parte, como 'arrendador', Don/a <u>".$nombre_arrendador_contrato_temporada_string."</u>, ";
						$html .= "Cedula de identidad <u>".$rut_arrendador_contrato_temporada_string."</u>, representado/a por Mateo S&aacute;nchez Propiedades, Rut: 76.190.666-6, domiciliado en arlegui N&deg;1109 local 46 ";
						$html .= "- galer&iacute;a plaza mercado, Vi&ntilde;a del Mar y por la otra, como 'arrendatario', Don/a <u>".$nombre_arrendatario_contrato_temporada_string."</u> cedulad de identidad o pasaporte N&deg; ";
						$html .= "<u>".$rut_arrendatario_contrato_temporada_string."</u> este &uacute;ltimo con domicilio en <u>".$domicilio_arrendatario_contrato_temporada_string."</u>, ciudad <u>".$ciudad_arrendatario_contrato_temporada_string."</u>, ";
						$html .= "pa&iacute;s <u>".$pais_arrendatario_contrato_temporada_string."</u> los comparecientes mayores de edad, quienes acreditaron su identidad con las c&eacute;dulas referidas, y exponen: que han convenido en ";
						$html .= "celebrar un contrato de arriendo de verano; el cu&aacute;l se regir&aacute; por las cl&aacute;usulas y disposiciones que a continuaci&oacute;n se establecen: Mateo S&aacute;nchez propiedades esta mandatado ";
						$html .= "para arrendar la propiedad ra&iacute;z ubicada en <u>".$domicilio_propiedad_contrato_temporada_string."</u> N&deg; <u>".$nro_domicilio_propiedad_contrato_temporada_string."</u>, ";
						$html .= "sector <u>".$comuna_propiedad_contrato_temporada_string."</u> de la comuna de <u>".$sector_propiedad_contrato_temporada_string."</u> y <u>".$nro_estacionamiento_contrato_temporada_string."</u> estacionamiento(s). ";
						$html .= "Por este instrumento mateo S&aacute;nchez propiedades da en arrendamiento de verano el inmueble antes se&ntilde;alado el cual regir&aacute; desde <u>".$fecha_contrato_cliente_inicio_string."</u> hasta ";
						$html .= "<u>".$fecha_contrato_cliente_fin_string."</u> y ser&aacute; la cantidad de <u>$".$monto_arriendo_contrato_temporada_string."</u>. Las partes acuerdan que en este contrato de verano, se adjunta un inventario ";
						$html .= "el que es parte integrante del presente arrendamiento. La entrega material del inmueble se realizara en este acto, sin embargo el uso de la propiedad se regular&aacute; por normas de buen vivir, urbanidad y ";
						$html .= "cultura, adem&aacute;s del reglamento de copropiedad que afecta a la propiedad si existiere. <b>MATEO SANCHEZ PROPIEDADES</b>, por sus servicios profesionales cobrar&aacute; un honorario que es conocido y ";
						$html .= "aceptado por las partes equivalente al 10% del valor total del arrendamiento. En caso que la arrendataria se desista de arrendar la propiedad antes singularizada, perder&aacute; el total de la Reserva del ";
						$html .= "arrendamiento. Las partes fijan su domicilio en la ciudad de Vi&ntilde;a del Mar, para todos los efectos legales derivados del presente contrato, otorgando competencia a sus Tribunales de Justicia.";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "NOTA: el ingreso 'check-in' ser&aacute; desde las 16:00hrs y la salida se extender&aacute; 'check out' hasta las 13:00hrs. Se podr&aacute; aplicar la modalidad 'late check-out' la que deber&aacute; ";
						$html .= "ser acordada con el agente Sr. Mateo Sanchez , fono: +56996736137 - +56984284536, E-mail: msanchez@mateosanchez.cl.";
					$html .= "</td>";
				$html .= "</tr>";
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "<b>RESUMEN FICHA T&Eacute;CNICA</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Fecha de entrada: <u>".generar_string(invertirFecha($_POST["fecha_contrato_cliente_inicio"]))."</u> Hora: <u>".generar_string($_POST["hora_inicio_arriendo_contrato_temporada"])."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Fecha de salida: <u>".generar_string(invertirFecha($_POST["fecha_contrato_cliente_fin"]))."</u> Hora: <u>".generar_string($_POST["hora_fin_arriendo_contrato_temporada"])."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Total arriendo: <u>$".$monto_arriendo_contrato_temporada_string."</u> Valor reserva: <u>$".generar_string(mostrarPrecio($_POST["monto_reserva_arriendo_contrato_temporada"]))."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Valor comisi&oacute;n: <u>$".$_POST["monto_comision_arriendo_contrato_temporada"]."</u> Valor aseo: <u>$".generar_string(mostrarPrecio($_POST["monto_aseo_arriendo_contrato_temporada"]))."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Valor traslado: <u>$".generar_string(mostrarPrecio($_POST["monto_traslado_arriendo_contrato_temporada"]))."</u> (Costo adicional m&iacute;nimo de $10.000.- solo para traslados dentro de la comuna de Vi&ntilde;a del Mar.)";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Veh&iacute;culo";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Marca: <u>".generar_string($_POST["marca_vehiculo_contrato_temporada"])."</u> Modelo: <u>".generar_string($_POST["modelo_vehiculo_contrato_temporada"])."</u> Placa patente: <u>".generar_string($_POST["placa_vehiculo_contrato_temporada"])."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Veh&iacute;culo";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td colspan='3'>";
						$html .= "Ingreso de personas N&deg;: <u>".generar_string($_POST["nro_arrendatarios_contrato_temporada"])."</u> Adultos: <u>".generar_string($_POST["nro_adultos_contrato_temporada"])."</u> Ni&ntilde;os: <u>".generar_string($_POST["nro_ninos_contrato_temporada"])."</u>";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-bottom: 0px;'>";
			$html .= "<tbody>";
				$cant = 0;
				foreach ($nombre_persona_contrato_temporada as &$valor) {
					$html .= "<tr>";
						$html .= "<td colspan='3' style='width: 340px; border: 1px solid black; padding: 2px;'>";
							$html .= "Nombre: ".$valor;
						$html .= "</td>";
					$html .= "</tr>";
					
					$html .= "<tr>";
						$html .= "<td style='width: 200px; border: 1px solid black; padding: 2px;'>";
							$html .= "Rut: ".$rut_persona_contrato_temporada[$cant];
						$html .= "</td>";
						
						$html .= "<td style='width: 70px; border: 1px solid black; padding: 2px;'>";
							$html .= "Edad: ".$edad_persona_contrato_temporada[$cant];
						$html .= "</td>";
						
						$html .= "<td style='width: 150px; border: 1px solid black; padding: 2px;'>";
							$html .= "Nacionalidad: ".$nacionalidad_persona_contrato_temporada[$cant];
						$html .= "</td>";
					$html .= "</tr>";
					$cant += 1;
				}
			$html .= "</tbody>";
		$html .= "</table>";
		
		$html .= "<table style='width: 100%; margin-top: 10px;'>";
			$html .= "<tbody>";
			
				$html .= "<tr>";
					$html .= "<td colspan='2'>";
						$html .= "<img width='60' style='margin-left: 60px;' src='../../images/firma-digital-mateo-reducido.png'>";
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
						$html .= "<b>Mateo S&aacute;nchez Propiedades</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Nombre: </b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>Cel: +569 9673 6137</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Rut: </b>";
					$html .= "</td>";
				$html .= "</tr>";
				
				$html .= "<tr>";
					$html .= "<td>";
						$html .= "<b>E-mail: info@mateosanchez.cl</b>";
					$html .= "</td>";
					
					$html .= "<td>";
						$html .= "<b>Tel&eacute;fono:</b>";
					$html .= "</td>";
				$html .= "</tr>";
				
			$html .= "</tbody>";
		$html .= "</table>";
		//----------------------FIN PAGINA 1--------------------------------
	$html .= "</body>";
	
	//echo $html;
	
	//==============================================================
	//==============================================================
	//==============================================================

	include("../../pdf/mpdf.php");

	$mpdf=new mPDF('','FOLIO','','',10,10,10,10,10,10);
	//20 -> margin top pagina y el que le sigue es el bottom

	$mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins

	$mpdf->WriteHTML($html);

	$mpdf->Output('CONTRATO TEMPORADA ".$dia." de ".$mes." del ".$ano." COD'.$propiedad["cod_propiedad"].'.pdf','I');


	//==============================================================
	//==============================================================
	//==============================================================
	
	exit;
?>
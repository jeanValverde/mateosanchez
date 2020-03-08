<?php
	//Se asignan variables para hacer mas sencillo el codigo
	$direccion_servidor = "localhost";
	$nombre_base_datos = "msanchez_bd";
	$nombre_cuenta_bd = "root";
	$contrasena_cuenta_bd = "";

		//Se intenta realizar la conexion en base a PDO
	try{
		$conexion = new PDO('mysql:host='.$direccion_servidor.';dbname='.$nombre_base_datos, $nombre_cuenta_bd, $contrasena_cuenta_bd);
	}catch(PDOException $e){
		//Cuando se presenta error se genera un mensaje para una pagina de aviso de este error
		echo "Ha ocurrido el siguiente error: ".$e->getMessage();
	}

	function verificar_url($url){
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}

	function valida_rut($rut){
		$suma = 0;
		if(strpos($rut,"-")==false){
			$RUT[0] = substr($rut, 0, -1);
			$RUT[1] = substr($rut, -1);
		}else{
			$RUT = explode("-", trim($rut));
		}
		$elRut = str_replace(".", "", trim($RUT[0]));
		$factor = 2;
		for($i = strlen($elRut)-1; $i >= 0; $i--):
			$factor = $factor > 7 ? 2 : $factor;
			$suma += $elRut{$i}*$factor++;
		endfor;
		$resto = $suma % 11;
		$dv = 11 - $resto;
		if($dv == 11){
			$dv=0;
		}else if($dv == 10){
			$dv="k";
		}else{
			$dv=$dv;
		}
		if($dv == trim(strtolower($RUT[1]))){
			return true;
		}else{
			return false;
		}
	}

	function estandarizar_rut($rut) {
		$i = 0;
		$displayRut = "";

		//Mientras que el contador sea menor al largo de la cadena realizara el proceso de limpieza
		while($i < strlen($rut)){

			//Reviza si el caracter es un numero para colocarlo en otra cadena
			if(is_numeric($rut[$i])){
				$displayRut .= $rut[$i];
			}

			//Avanza en 1 el contador
			$i += 1;
		}

		$rut = $displayRut;
		if(is_numeric($rut)){
			return number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );
		}else{
			return 0;
		}
	}

	function mostrarPrecio($precio){
		//Inicializar el contador y la cadena que arma el precio
		$i = 0;
		$displayPrecio = $precio;

		if(!empty($displayPrecio)){
			//Ahora con la cadena de solo numeros se da el formato de $123.123
			return number_format($displayPrecio,0,",",".");
		}else{
			return "";
		}
	}

	function getUniqueCode($length = 16){

		//Se genera aleatoreamente un codigo alfan?merico de 16 caracteres, puede ser de menos si se entrega el valor al convocar la funci?n
		$code = md5(uniqid(rand(), true));

		//Evalua si existe un valor para el largo de la cadena esta devuelve el codigo md5
		if ($length != ""){
			return substr($code, 0, $length);
		}else{
			return $code;
		}
	}

	function invertirFecha($fecha){
		$array_fecha = explode("-",$fecha);

		$fecha = $array_fecha[2]."/".$array_fecha[1]."/".$array_fecha[0];
		return $fecha;
	}

	function getMessage($tipo, $mensaje){
		return "<div class='alert ".$tipo." alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$mensaje."</div>";
	}

	function getDatesFromRange($start, $end, $format = 'Y-m-d') {
		$array = array();
		$interval = new DateInterval('P1D');

		$realEnd = new DateTime($end);
		$realEnd->add($interval);

		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

		foreach($period as $date) {
			$array[] = $date->format($format);
		}

		return $array;
	}

	function preparar_uf($uf){
		$uf_tratado = str_replace('.', '', $uf);
		$uf_tratado = floor($uf_tratado);

		return $uf_tratado;
	}

	function precio_uf_a_pesos($monto_propiedad){
		$apiUrl = 'https://mindicador.cl/api';
		//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
		if ( ini_get('allow_url_fopen') ) {
		    $json = file_get_contents($apiUrl);
		} else {
		    //De otra forma utilizamos cURL
		    $curl = curl_init($apiUrl);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $json = curl_exec($curl);
		    curl_close($curl);
		}

		$dailyIndicators = json_decode($json);

		$monto_pesos = $monto_propiedad*$dailyIndicators->uf->valor;
		return $monto_pesos;
	}

	function getUF(){
		$apiUrl = 'https://mindicador.cl/api';
		//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
		if ( ini_get('allow_url_fopen') ) {
		    $json = file_get_contents($apiUrl);
		} else {
		    //De otra forma utilizamos cURL
		    $curl = curl_init($apiUrl);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    $json = curl_exec($curl);
		    curl_close($curl);
		}

		$dailyIndicators = json_decode($json);
		return round($dailyIndicators->uf->valor);
	}
?>

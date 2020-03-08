<?

$dif_horaria = 3;

function enviar_email ($from, $to, $cc, $bcc, $subject, $message) { 
$headers = "";
if ($from <> "") {
  $headers .= "From: ".$from." \r\n";
}
if ($cc <> "") {
  $headers .= "Cc: ".$cc." \r\n";
}
if ($bcc <> "") {
  $headers .= "Bcc: ".$bcc." \r\n";
}
$xxx = mail($to, $subject, $message, $headers);
return $xxx;
}


function es_entero ($num) {
$x = (is_numeric($num) ? intval($num) == $num : false);
return $x;
}


function validar_entero ($num, $min, $max, $vari, $opc) {
$err = "";
$num = trim($num);
if (strlen($num) == 0) {
  $err = "está vacío ...";
}
if (($err == "") and (!is_numeric($num))) {
  $err = "no es numérico ...";
}
if (($err == "") and !es_entero($num)) {
  $err = "no es entero ...";
}
if (($err == "") and ($num < $min)) {
  $err = "debe ser mayor o igual a <b>$min</b> ...";
}
if (($err == "") and ($num > $max)) {
  $err = "debe ser mayor o igual a <b>$min</b> y menor o igual a <b>$max</b> ...";
}
if ($err <> "") {
  $err = "<font color='ff0033'>Error : </font>el valor ingresado en [ <b>$vari</b> ] ".$err;
}
if (($err <> "") and ($opc == "*")) {
  print "<br>$err<br>";
}
return $err;
}


function mensaje ($texto, $opc) {
$bg = '0000cc';
if ($opc == "E") { // Error
  $bg = 'ff0000';
}
$t = "<table width='50%' align='center' cellpadding='7'><tr bgcolor='$bg'><td><center><font color='#FFFFFF' face='Tahoma' size='2'><b>$texto</b></font></table>";
return $t;
}


function hoy ( $opc ) {
global $dif_horaria;
$time_cl = gmdate("U") - ($dif_horaria * 3600);
if ($opc == "F") {
  $x = gmdate("d-m-Y",$time_cl);
}
if ($opc == "H") {
  $x = gmdate("H:i:s",$time_cl);
}
if ($opc == "S") {
  $x = gmdate("W",$time_cl);
}
if ($opc == "I") {
  $x = gmdate("H",$time_cl) * 60 + gmdate("i",$time_cl);
}
if ($opc == "") {
  $x = intval($time_cl / 86400);
}
if ($opc == "C") {
//  $x = intval($time_cl / 86400) * 10000 + gmdate("h",$time_cl) * 60 + gmdate("i",$time_cl);
  $x = intval($time_cl / 86400) * 100000 + intval($time_cl % 86400);
}
return $x;
}


function fecha_numero ( $dia, $mes, $ano ) {
$x = intval(mktime(0,0,0,$mes,$dia,$ano) / 86400);
return $x;
}


function mostrar_fecha ( $fech, $opc ) {
if ($opc == "C") {
  $fres = gmdate("d-m-Y H:i:s",$fech);
} else {
  $aux = $fech * 86400 + 43200;
}
if ($opc == "D") {
  $dsem = "DomLunMarMieJueVieSab";
  $pos = gmdate("w",$aux) * 3;
  $fres = substr($dsem,$pos,3);
}
if ($opc == "") {
  $fres = gmdate("d-M-Y",$aux);
}
if ($opc == "N") {
  $fres = gmdate("d-m-Y",$aux);
}
if ($opc == "M") {
  $fres = gmdate("d-M",$aux);
}
if ($opc == "/") {
  $fres = gmdate("d/m",$aux);
}
if ($opc == "S") {
  $fres = gmdate("W",$aux);
}
if ($opc == "Y") {
  $fres = gmdate("Y",$aux);
}
if ($opc == "R") {
  $fres = gmdate("d-m-y",$aux);
}
return $fres;
}


function mostrar_hora ( $hora ) {
$h = intval($hora / 60);
if (strlen($h) == 1) {
  $h = "0".$h;
}
$m = intval($hora % 60);
if (strlen($m) == 1) {
  $m = "0".$m;
}
return $h.":".$m;
}


function fecha_hora ( $dato ) {
$f = intval($dato / 100000) * 86400 + intval($dato % 100000);
$f1 = mostrar_fecha($f,"C");
return $f1;
}


function lunes_semana ( $fech, $opc ) {
$aux = $fech * 86400 + 43200;
$x = gmdate("w",$aux);
$lun = 0;
if ($x == 0) {
  $lun = 6;
} else {
  if ($x > 1) {
    $lun = $x - 1;
  }
}
$res = $fech - $lun;
return $res;
}

?>
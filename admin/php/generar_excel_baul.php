<?php
 require_once('rutinas.php');
 
 if(!isset($_GET["id_tipo_giro"])){
	$_GET["id_tipo_giro"] = 0;
 }
 
 if(!isset($_GET["id_tipo_propiedad"])){
	$_GET["id_tipo_propiedad"] = 0;
 }
 
 if(!isset($_GET["id_region"]) || $_GET["id_region"] == "-"){
	$_GET["id_region"] = 0;
 }
 
 if(!isset($_GET["id_comuna"]) || $_GET["id_comuna"] == "-"){
	$_GET["id_comuna"] = 0;
 }
 
 if(!isset($_GET["id_sector"]) || $_GET["id_sector"] == "-"){
	$_GET["id_sector"] = 0;
 }
 
 if(!isset($_GET["is_propietario"])){
	$_GET["is_propietario"] = 0;
 }
 
 $campos_buscar = "cod_propiedad, ";
 $campos_buscar .= "nombre_tipo_propiedad, ";
 $campos_buscar .= "nombre_tipo_operacion, ";
 $campos_buscar .= "nombre_comuna, ";
 $campos_buscar .= "nombre_sector, ";
 $campos_buscar .= "simbologia_tipo_valor, ";
 $campos_buscar .= "valor_propiedad, ";
 $campos_buscar .= "dormitorios_propiedad, ";
 $campos_buscar .= "cantidad_superficie_construida_propiedad, ";
 $campos_buscar .= "cantidad_superficie_total_propiedad";
 if($_GET["is_propietario"] == 1){
	$campos_buscar .= ", observacion_propietario";
 }
 
 
  
 $sql_baul_propiedad = "SELECT ".$campos_buscar." FROM baul_propiedades ";
 $sql_baul_propiedad .= "INNER JOIN tipo_propiedades ON baul_propiedades.id_tipo_propiedad = tipo_propiedades.id_tipo_propiedad ";
 $sql_baul_propiedad .= "INNER JOIN tipo_operaciones ON baul_propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
 $sql_baul_propiedad .= "INNER JOIN comunas ON baul_propiedades.id_comuna = comunas.id_comuna ";
 $sql_baul_propiedad .= "INNER JOIN sectores ON baul_propiedades.id_sector = sectores.id_sector ";
 $sql_baul_propiedad .= "INNER JOIN tipo_valores ON baul_propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
 $sql_baul_propiedad .= "INNER JOIN cuentas ON baul_propiedades.id_cuenta = cuentas.id_cuenta ";
 $sql_baul_propiedad .= "WHERE baul_propiedades.is_hidden = 0 ";
 
 if($_GET["id_tipo_giro"] != "-"){
	$sql_baul_propiedad .= "AND baul_propiedades.is_comercial = ".$_GET["id_tipo_giro"]." ";
 }
 
 if($_GET["id_tipo_propiedad"] != 0){
	$sql_baul_propiedad .= "AND baul_propiedades.id_tipo_propiedad = ".$_GET["id_tipo_propiedad"]." ";
 }
 
 if($_GET["id_region"] != 0){
	$sql_baul_propiedad .= "AND baul_propiedades.id_region = ".$_GET["id_region"]." ";
 }
 
 if($_GET["id_comuna"] != 0){
	$sql_baul_propiedad .= "AND baul_propiedades.id_comuna = ".$_GET["id_comuna"]." ";
 }
 
 if($_GET["id_sector"] != 0){
	$sql_baul_propiedad .= "AND baul_propiedades.id_sector = ".$_GET["id_sector"]." ";
 }
 
 $sql_propiedad = "SELECT ".$campos_buscar." FROM propiedades ";
 $sql_propiedad .= "INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad = tipo_propiedades.id_tipo_propiedad ";
 $sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
 $sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
 $sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
 $sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
 $sql_propiedad .= "INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta ";
 $sql_propiedad .= "WHERE propiedades.is_hidden = 0 ";
 
 if($_GET["id_tipo_giro"] != "-"){
	$sql_propiedad .= "AND propiedades.is_comercial = ".$_GET["id_tipo_giro"]." ";
 }
 
 if($_GET["id_tipo_propiedad"] != 0){
	$sql_propiedad .= "AND propiedades.id_tipo_propiedad = ".$_GET["id_tipo_propiedad"]." ";
 }
 
 if($_GET["id_region"] != 0){
	$sql_propiedad .= "AND propiedades.id_region = ".$_GET["id_region"]." ";
 }
 
 if($_GET["id_comuna"] != 0){
	$sql_propiedad .= "AND propiedades.id_comuna = ".$_GET["id_comuna"]." ";
 }
 
 if($_GET["id_sector"] != 0){
	$sql_propiedad .= "AND propiedades.id_sector = ".$_GET["id_sector"]." ";
 }
 
 $sql_union_propiedad = "SELECT ".$campos_buscar." FROM (".$sql_baul_propiedad." UNION ".$sql_propiedad.") AS dato ORDER BY dato.cod_propiedad ASC";
 
 $cursor = $conexion -> query($sql_union_propiedad);
 
 //echo $sql_union_propiedad;
 
 if(!$registros = $cursor -> rowCount()){
	$registros = 0;
 }
 
 if ($registros > 0) {
	require_once 'Classes/PHPExcel.php';
   $objPHPExcel = new PHPExcel();
   
   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("www.pcdstudio.cl")
        ->setLastModifiedBy("www.pcdstudio.cl")
        ->setTitle("Listado de propiedades")
        ->setSubject("Archivo www.mateosanchez.cl")
        ->setDescription("Documento generado de propiedades")
        ->setKeywords("Excel Propiedades")
        ->setCategory("Propiedades");
		
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A1', utf8_encode("Código"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('B1', "Tipo Propiedad");
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('C1', utf8_encode("Tipo Operación"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('D1', "Comuna");
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('E1', "Sector");
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('F1', "Valor Propiedad");
	//$objPHPExcel->setActiveSheetIndex(0)
	//	->setCellValue('G1', "Es comercial");
	if($_GET["is_propietario"] == 1){
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('H1', "Propietario");
	}
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('I1', "Dormitorios");
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('J1', "Mt2 Total");
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('K1', "Mt2 Construida");

	$i = 2;    
	while ($registro = $cursor -> fetch()) {
       
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $registro["cod_propiedad"]);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('B'.$i, utf8_encode($registro["nombre_tipo_propiedad"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('C'.$i, utf8_encode($registro["nombre_tipo_operacion"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('D'.$i, utf8_encode($registro["nombre_comuna"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('E'.$i, utf8_encode($registro["nombre_sector"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('F'.$i, $registro["simbologia_tipo_valor"].mostrarPrecio($registro["valor_propiedad"]));
		
		//if($registro["is_comercial"] == 0){
		//$objPHPExcel->setActiveSheetIndex(0)
		//	->setCellValue('G'.$i, "No");
		//}elseif($registro["is_comercial"] == 1){
		//$objPHPExcel->setActiveSheetIndex(0)
		//	->setCellValue('G'.$i, "Si");
		//}else{
		//$objPHPExcel->setActiveSheetIndex(0)
		//	->setCellValue('G'.$i, "No Aplica");
		//}
		
		if($_GET["is_propietario"] == 1){
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('H'.$i, utf8_encode($registro["observacion_propietario"]));
		}
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('I'.$i, $registro["dormitorios_propiedad"]);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('J'.$i, $registro["cantidad_superficie_total_propiedad"]);
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('K'.$i, $registro["cantidad_superficie_construida_propiedad"]);
 
      $i++;
      
	}
   
	// Auto size columns for each worksheet
	foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

		$objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

		$sheet = $objPHPExcel->getActiveSheet();
		$cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		$cellIterator->setIterateOnlyExistingCells(true);
		/** @var PHPExcel_Cell $cell */
		foreach ($cellIterator as $cell) {
			$sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		}
	}
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="listado-propiedades-baul.xlsx"');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysql_close ();
?>
<script>
	$(element).click(function(){
		window.close();
	});
</script>

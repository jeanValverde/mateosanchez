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
  
 $sql_propiedad = "SELECT * FROM propiedades ";
 $sql_propiedad .= "INNER JOIN tipo_propiedades ON propiedades.id_tipo_propiedad = tipo_propiedades.id_tipo_propiedad ";
 $sql_propiedad .= "INNER JOIN tipo_operaciones ON propiedades.id_tipo_operacion = tipo_operaciones.id_tipo_operacion ";
 $sql_propiedad .= "INNER JOIN comunas ON propiedades.id_comuna = comunas.id_comuna ";
 $sql_propiedad .= "INNER JOIN sectores ON propiedades.id_sector = sectores.id_sector ";
 $sql_propiedad .= "INNER JOIN tipo_valores ON propiedades.id_tipo_valor = tipo_valores.id_tipo_valor ";
 $sql_propiedad .= "INNER JOIN tipo_giros ON propiedades.id_tipo_giro = tipo_giros.id_tipo_giro ";
 $sql_propiedad .= "INNER JOIN cuentas ON propiedades.id_cuenta = cuentas.id_cuenta ";
 $sql_propiedad .= "WHERE is_hidden = 0 ";
 
 if($_GET["id_tipo_giro"] != 0){
	$sql_propiedad .= "AND propiedades.id_tipo_giro = ".$_GET["id_tipo_giro"]." ";
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
 
 $sql_propiedad .= "ORDER BY propiedades.cod_propiedad DESC";
 $cursor = $conexion -> query($sql_propiedad);
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
		->setCellValue('B1', utf8_encode("Tipo Propiedad"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('C1', utf8_encode("Tipo Operación"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('D1', utf8_encode("Comuna"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('E1', utf8_encode("Sector"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('F1', utf8_encode("Valor Propiedad"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('G1', utf8_encode("Destino"));
	if($_GET["is_propietario"] == 1){
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('H1', utf8_encode("Propietario"));
	}
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('I1', utf8_encode("Dormitorios"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('J1', utf8_encode("Mt2 Total"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('K1', utf8_encode("Mt2 Construida"));
	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('L1', utf8_encode("Fecha de Publicación"));	

   $i = 2;    
   while ($registro = $cursor -> fetch()) {
       
		$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, utf8_encode($registro["cod_propiedad"]));
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
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('G'.$i, utf8_encode($registro["nombre_tipo_giro"]));
		if($_GET["is_propietario"] == 1){
			$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('H'.$i, $registro["observacion_propietario"]);
		}
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('I'.$i, utf8_encode($registro["dormitorios_propiedad"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('J'.$i, utf8_encode($registro["cantidad_superficie_total_propiedad"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('K'.$i, utf8_encode($registro["cantidad_superficie_construida_propiedad"]));
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('L'.$i, invertirFecha($registro["fecha_publicacion_propiedad"]));
 
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
header('Content-Disposition: attachment;filename="listado-propiedades.xlsx"');
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

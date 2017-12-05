<?php
	require_once('sessioncontrol.php');
    require_once('../../inc/config.php');
	require_once('dbconnect.php');
	require('../excel/PHPExcel.php');
	require('../excel/PHPExcel/Writer/Excel5.php');

	$session = new sessioncontrol();
	
	$id = $_GET['id'];

	$dbdata = array(
		'host' => DB_HOST,
		'user' => DB_USER,
		'pass' => DB_PASSWORD,
		'db' => DB_NAME
	);

	$database = new dbConnect();
	$database->connect($dbdata);

	$querystring = 'SELECT pilar.*, login.* FROM pilar 
						join pilar_login on pilar_login.pilar_id = pilar.id
						join login on pilar_login.login_id = login.id
						where pilar.id = '.$id.' order by nombreyapellidoInput';
					
	$personas = $database->getTableDataQuery($querystring);

	//print_r($personas);die;

	if(!empty($personas)){
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> setActiveSheetIndex(0);
		$objPHPExcel -> getProperties() -> setCreator("NOOLLAB");
		$objPHPExcel -> getProperties() -> setLastModifiedBy("NOOLLAB");

		$sheet = $objPHPExcel -> getActiveSheet();

		$style_global = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER), 'font' => array('size' => 9, 'textWrap' => 1));

		$style_titles = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '0DB7E2')), 'font' => array('bold' => true));

		$sheet -> getDefaultStyle() -> applyFromArray($style_global);

		$sheet -> getDefaultRowDimension() -> setRowHeight(18);
		$sheet -> getRowDimension('2') -> setRowHeight(27);

		for ($i = 'B'; $i <= 'G'; $i++) {
			$sheet -> getStyle($i . '2') -> applyFromArray($style_titles);
			$sheet -> getStyle($i . '3') -> applyFromArray($style_titles);
		}

		$datetime = strtotime($personas[0]['fecha']);
		$date = date("d/m/Y", $datetime);

		$titulo = $personas[0]['pilar'].' '.$date;

		$sheet -> mergeCells('B2:F2');
		$sheet -> setCellValue('B2', $titulo);

		//$sheet -> setCellValue('B3', 'Nombre');
		$sheet -> getColumnDimension('B') -> setWidth(5);
		$sheet -> setCellValue('C3', 'Nombre');
		$sheet -> getColumnDimension('C') -> setWidth(50);
		$sheet -> setCellValue('D3', 'CI');
		$sheet -> getColumnDimension('D') -> setWidth(25);
		$sheet -> setCellValue('E3', 'País');
		$sheet -> getColumnDimension('E') -> setWidth(25);
		$sheet -> setCellValue('F3', 'Teléfono');
		$sheet -> getColumnDimension('F') -> setWidth(25);
		$sheet -> setCellValue('G3', 'Id');
		$sheet -> getColumnDimension('G') -> setWidth(10);

		$row = 4;

		foreach ($personas as $k => $v) {
			for ($i = 'B'; $i <= 'G'; $i++) {
				$sheet -> getStyle($i . $row) -> applyFromArray(array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'E5E5FE'))));
				$sheet -> getStyle($i . $row) -> getAlignment() -> setWrapText(true);
			}

			$sheet -> setCellValue('B' . $row, $k + 1);
			$sheet -> getStyle('C' . $row) -> getAlignment() -> setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$sheet -> setCellValueExplicit('C' . $row, $v['nombreyapellidoInput']);
			$sheet -> setCellValueExplicit('D' . $row, $v['idNumber']);
			$sheet -> setCellValueExplicit('E' . $row, $v['pais']);
			$sheet -> setCellValueExplicit('F' . $row, $v['telefono']);
			$sheet -> setCellValueExplicit('G' . $row, $v['id']);

			$row++;
		}


		$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
		HEADER("Content-Type: application/vnd.ms-excel; charset=UTF-8");
		HEADER("Content-Disposition: attachment; filename=".$titulo.".xls");
		HEADER("Pragma: no-cache");
		HEADER("Expires: 0");
		$objWriter -> save('php://output');
		exit ;
	}		
?>
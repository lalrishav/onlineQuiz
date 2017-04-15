<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Php_excel {

    public function generate($data, $filename, $type) {
		
		$filename = $filename.'.xls';
		
		require_once(APPPATH.'third_party/excel/PHPExcel.php');
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setTitle($type);

		$objPHPExcel->setActiveSheetIndex(0);

	//	print_r($data);
		
		for ($i=1; $i<=count($data); $i++) {
			for ($j=0; $j<count($data[1]); $j++) {
				if (isset($data[$i][$j])) {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($j, $i, $data[$i][$j]);
				}
				if ($j == 0) {
				
				}
			}	
		}
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');

		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
    }
}


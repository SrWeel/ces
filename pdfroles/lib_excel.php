<?php
/*
// save this file to: ExcelService.class.php

Create new folder 'libs' under your project dir, and download PHPExcel-1.8 library .zip from here..
use this clone url: git@github.com:PHPOffice/PHPExcel.git 
OR https://github.com/PHPOffice/PHPExcel.
*/

define('TMP_FILES', "temp/"); // temp folder where it stores the files into.

/** include PHPExcel classes */
/* I have in my project directory under the libs/ folder. */
$basePath = 'libs/PHPExcel-1.8/Classes/'; // make sure path and dir's are correct.
include_once ($basePath . 'PHPExcel.php');
include_once ($basePath . 'PHPExcel/IOFactory.php');

class ExcelService {

	private function generateRandomName() {
		$randName = substr(md5(date('m/d/y h:i:s:u')), 0, 8);
		if(file_exists(TMP_FILES . $randName . '.html')) {
			return $this -> generateRandomName();
		}
		return $randName;
	}

       /* Function to generate excel file from html content using php (phpexcel 2007)*/
	public function generateExcel($content,$name) { // $content <- html_content
		
		$filename = $this -> generateRandomName();

		if( !ini_get('date.timezone') ) {
		    date_default_timezone_set('GMT');
		}
		
		if(!is_dir( TMP_FILES )) { // check if temp folder not not exists
			mkdir( TMP_FILES, 0777 ); // create new temp dir for storing xlsx files.
		}

		$htmlfile = TMP_FILES . $filename . '.html'; // create new html file under temp folder
		file_put_contents($htmlfile, utf8_decode($content)); // copy the html contents into tmp created html file
		
		$objReader = new PHPExcel_Reader_HTML; // new loader
		$objPHPExcel = $objReader->load($htmlfile); // load .html file that generated under temp folder
		
		// Set properties
		$objPHPExcel->getProperties()->setCreator("Gad Concordia");
		$objPHPExcel->getProperties()->setLastModifiedBy("Gad Concordia");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Document");
		$objPHPExcel->getProperties()->setSubject("XLSX Report");
		$objPHPExcel->getProperties()->setDescription("XLSX report document for Office 2007");
    
                /* simple style to make sure all cell's text have HORIZONTAL_LEFT alignment */
		$style = array(
		    'alignment' => array(
		        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
		     )
		);

		//Apply the style
	        $objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($style);
    
	        $excelFile = TMP_FILES . $name.$filename . '.xlsx'; // create excel file under temp folder.
	    
		// Creates a writer to output the $objPHPExcel's content
	 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save($excelFile); // saving the excel file

		unlink($htmlfile); // delete .html file
		
		if(file_exists($excelFile)) {
			return $name.$filename . '.xlsx';
		}
		
		return false;		
	}

	/* Function to download file using php.*/
	public function downloadFile($nombre_archivo) {
		$fields = array("fileName");
		
		$fileName = TMP_FILES . $nombre_archivo;
		$fileNamePieces = explode( '.', $fileName);
		if(count($fileNamePieces) > 1) {
			$fileType = array_pop($fileNamePieces);
		}

		if(file_exists($fileName) && ($fileType == 'html' || $fileType == 'xlsx')) {
			if($fileType == 'xlsx') {
				header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Pragma: ');
				header('Cache-Control: ');
				header('Content-disposition: attachment; filename="'. $nombre_archivo.'"');
			}
			else {
				header('Content-Type: text/html');
			}

			readfile($fileName);
			unlink($fileName); // each asset can only be accessed once, delete after access
			exit();
		}
	}
}
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
@$tiempossss = 4445000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
$system = 1;
@$director = "../../";
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director . "libreria/variables/variables.php");

require_once "../Classes/PHPExcel.php";

$url = "ARCHIVO_LABORATORIO_CODE.xlsx";
$filecontent = file_get_contents($url);
$tmpfname = tempnam(sys_get_temp_dir(), "tmpxls");
file_put_contents($tmpfname, $filecontent);

@$ejecuta = $_GET["ejecuta"];

$lista_tabs = explode(",", "TARIFARIO");

$cuenta_data = 0;

$lista_campo = '';

$concatena_campos = '';
$concatena_campos_valores = '';

$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
$excelObj = $excelReader->load($tmpfname);
$sheetnames = $excelReader->listWorksheetNames($tmpfname);

//print_r($sheetnames);

for ($iexcl = 0; $iexcl < count($lista_tabs); $iexcl++) {

	$index_val = 0;
	for ($i = 0; $i < count($sheetnames); $i++) {
		//echo $sheetnames[$i]." -- ".trim($lista_tabs[$iexcl])."<br>";
		if (trim($sheetnames[$i]) == trim($lista_tabs[$iexcl])) {
			$index_val = $i;
		}
	}

	//echo $index_val."<br>";
	$excelObj->setActiveSheetIndex($index_val);

	$worksheet = $excelObj->getSheet($index_val);
	$lastRow = $worksheet->getHighestRow();

	//print_r($worksheet);

	///=========================================================


	$array_letra = array();
	$array_tipo = array();
	$array_nombrecampo = array();
	$contador_letra = 0;

	$array_letra[$contador_letra] = "A";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "1";

	$contador_letra++;

	$array_letra[$contador_letra] = "B";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "2";

	$contador_letra++;

	$array_letra[$contador_letra] = "C";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "3";

	$contador_letra++;

	$array_letra[$contador_letra] = "D";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "4";

	$contador_letra++;

	$array_letra[$contador_letra] = "E";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "5";

	$contador_letra++;

	$array_letra[$contador_letra] = "F";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "6";


	$contador_letra++;

	$array_letra[$contador_letra] = "G";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "7";

	$contador_letra++;

	$array_letra[$contador_letra] = "H";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "8";

	$contador_letra++;

	$array_letra[$contador_letra] = "I";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "9";

	$contador_letra++;

	$array_letra[$contador_letra] = "J";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "10";

	$contador_letra++;

	$array_letra[$contador_letra] = "K";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "11";

	$contador_letra++;

	$array_letra[$contador_letra] = "L";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "12";

	$contador_letra++;

	$array_letra[$contador_letra] = "M";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "13";

	$contador_letra++;

	$array_letra[$contador_letra] = "N";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "14";

	$contador_letra++;

	$array_letra[$contador_letra] = "O";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "15";

	$contador_letra++;

	$array_letra[$contador_letra] = "P";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "16";

	$contador_letra++;

	$array_letra[$contador_letra] = "Q";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "17";

	$contador_letra++;

	$array_letra[$contador_letra] = "R";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "18";

	$contador_letra++;

	$array_letra[$contador_letra] = "S";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "19";

	$contador_letra++;

	$array_letra[$contador_letra] = "T";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "20";

	$contador_letra++;

	$array_letra[$contador_letra] = "U";
	$array_tipo[$contador_letra] = "text";
	$array_nombrecampo[$contador_letra] = "21";

	// $lastRow=12;

	$row = '';
	for ($row = 0; $row <= $lastRow; $row++) {
		$datos = array();

		for ($ilet = 0; $ilet < count($array_letra); $ilet++) {

			//+++++++++++++++++++++++++++++++++++++++++++++++
			switch ($array_tipo[$ilet]) {
				case 'DATE': {
						$valorfecha = $worksheet->getCell($array_letra[$ilet] . $row)->getValue();
						$datos[$array_nombrecampo[$ilet]] = PHPExcel_Style_NumberFormat::toFormattedString($valorfecha, "YYYY-MM-DD");
					}
					break;
				case 'DATETIME': {
						$date = '';
						$valorfecha = $worksheet->getCell($array_letra[$ilet] . $row)->getValue();
						$date = date_create($valorfecha);
						$datos[$array_nombrecampo[$ilet]] = @date_format($date, 'Y-m-d H:i:s');
					}
					break;
				default: {

						// @$datos[$array_nombrecampo[$ilet]]=$worksheet->getCell($array_letra[$ilet].$row)->getCalculatedValue();
						@$datos[$array_nombrecampo[$ilet]] = str_replace("'", "\'", $worksheet->getCell($array_letra[$ilet] . $row)->getCalculatedValue());
						if (@$datos[$array_nombrecampo[$ilet]] == '') {
							@$datos[$array_nombrecampo[$ilet]] = '';
						}
					}
			}

			//+++++++++++++++++++++++++++++++++++++++++++++++	

		}

		//print_r($datos);		

		//$excelObj->getActiveSheet()->SetCellValue('B12', 'DAF123');

		$idcuenta = 0;

		if (trim($datos[4]) == 'SERVICIOS') {
			$array_convenios = array();
			//print_r($datos);	
			for ($id = 6; $id <= count($datos); $id++) {
				//echo $datos[$id];
				$busca_idconv = "select * from cesdb_arextension.dns_convenios where conve_nombre='" . trim($datos[$id]) . "'";
				$rs_bdataidconv = $DB_gogess->executec($busca_idconv);
				echo $busca_idconv . "<br>";
				echo "En el Excel" . trim($datos[$id]) . " --> " . $rs_bdataidconv->fields["conve_id"] . " --> " . $rs_bdataidconv->fields["conve_nombre"] . "<br>";

				if ($rs_bdataidconv->fields["conve_nombre"]) {
					$array_convenios[$idcuenta]["ID"] = $id;
					$array_convenios[$idcuenta]["ID_CONVENIO"] = $rs_bdataidconv->fields["conve_id"];
					$array_convenios[$idcuenta]["NCONVENIO"] = $rs_bdataidconv->fields["conve_nombre"];

					$idcuenta++;
				}
			}

			//print_r($array_convenios);

		}



		//inserta en tarifario

		$nombre_tarifario = trim($datos[4]);
		$numera = trim($datos[1]);


		if ($nombre_tarifario != '' and $numera > 0) {
			//++++++++++++++++++++++++++++++++++++++++++++++++++

			$busca_codigo = "select * from efacsistema_producto where prod_nombre like '%" . $nombre_tarifario . "%'";
			$rs_bdata = $DB_gogess->executec($busca_codigo);

			$lista_campo .= $rs_bdata->fields["prod_codigo"] . ',' . $rs_bdata->fields["prod_nombre"] . ',' . $nombre_tarifario . "\n";

			//echo 'B'.$row;
			//++++++++++++++++++++++++++++++++++++++++++++++++++
		}

		//busca en el tarifario para modificar valores
		if (trim($datos[2])) {

			$codigo_tar = '';
			$codigo_tar = trim($datos[2]);

			if (!(is_numeric($datos[5]))) {
				$datos[5] = 0;
			}

			@$prod_precio = (str_replace(",", ".", $datos[5])) * 1;

			$busca_codigox = "select * from efacsistema_producto where prod_codigo like '" . $codigo_tar . "'";
			echo "<br>------------------<br>" . $busca_codigox . "<br>----------------------<br>";
			$rs_bdatax = $DB_gogess->executec($busca_codigox);

			echo "<br>---------NOMBRE SISTEMA-----------<br>" . $rs_bdatax->fields["prod_nombre"] . "<br>------------NOMBRE EXCEL--------<br>" . trim($datos[3]) . "<br>----------------------------------------------<br>";


			if ($rs_bdatax->fields["prod_id"] > 0) {
				$update_registror = "update efacsistema_producto set prod_preciorespaldo=prod_precio where prod_id='" . $rs_bdatax->fields["prod_id"] . "'";
				$rs_bdregirxy = $DB_gogess->executec($update_registror);

				echo "RESPALDA PRECIO: " . $update_registror . "<br>";

				$update_registro = "update efacsistema_producto set prod_precio='" . $prod_precio . "' where prod_id='" . $rs_bdatax->fields["prod_id"] . "'";
				$rs_bdataxxy = $DB_gogess->executec($update_registro);

				echo "ACTUALIZA PRECIO: " . $update_registro . "<br>";

				echo $rs_bdatax->fields["prod_enlace"] . "<br>";

				$prod_enlace = $rs_bdatax->fields["prod_enlace"];
				//agrega convenios
				//print_r($array_convenios);

				$prod_enlace = $rs_bdatax->fields["prod_enlace"];


				for ($icv = 0; $icv < count($array_convenios); $icv++) {

					//CONVENIOS

					$busca_conveniox = "select * from cesdb_arextension.dns_gridconvenios where prod_enlace='" . $rs_bdatax->fields["prod_enlace"] . "' and gconve_convenio='" . $array_convenios[$icv]["ID_CONVENIO"] . "'";
					$rs_buscaconvx = $DB_gogess->executec($busca_conveniox);

					echo $busca_conveniox . "<br>---------<br>-----<br>";

					if ($rs_buscaconvx->fields["gconve_id"] > 0) {
						if (!(is_numeric($datos[$array_convenios[$icv]["ID"]]))) {
							$datos[$array_convenios[$icv]["ID"]] = 0;
						}
						@$gconve_precio = (str_replace(",", ".", $datos[$array_convenios[$icv]["ID"]])) * 1;
						//if($gconve_precio>0)
						//{					
						$actualiza_precio = "update cesdb_arextension.dns_gridconvenios set gconve_precio='" . $gconve_precio . "' where gconve_id='" . $rs_buscaconvx->fields["gconve_id"] . "'";
						echo $actualiza_precio . "<br>";
						$rs_acprecio = $DB_gogess->executec($actualiza_precio);
						if ($rs_acprecio) {
							echo "<br>Actualizado<br>------<br>";
						}
						// }
					} else {
						if (!(is_numeric($datos[$array_convenios[$icv]["ID"]]))) {
							$datos[$array_convenios[$icv]["ID"]] = 0;
						}
						@$gconve_precio = (str_replace(",", ".", $datos[$array_convenios[$icv]["ID"]])) * 1;
						$gconve_convenio = $array_convenios[$icv]["ID_CONVENIO"];
						$usua_id = 1;
						$centrod_id = 0;
						$gconve_fecharegistro = date("Y-m-d H:i:s");

						if ($gconve_precio > 0) {
							$inserta_data2 = "INSERT INTO cesdb_arextension.dns_gridconvenios ( prod_enlace, gconve_convenio, gconve_precio, usua_id, centrod_id, gconve_fecharegistro) VALUES
					('" . $prod_enlace . "','" . $gconve_convenio . "','" . $gconve_precio . "','" . $usua_id . "','" . $centrod_id . "','" . $gconve_fecharegistro . "');";
							echo $inserta_data2 . "<br>";
							$rs_ok2 = $DB_gogess->executec($inserta_data2, array());
						}
					}

					//CONVENIOS


				}


				//agrega convenios

			}
		}
		//inserta en tarifario


	}

	//Guardamos los cambios

	echo "<br><br><br>Actualizados=" . $cuenta_data . "<br>";

	///=========================================================


	// $fechahoy=date('Ymd');		
	//$fh = fopen("Generaconcodigos-".$fechahoy.".csv", 'w') or die("Se produjo un error al crear el archivo");
	//fwrite($fh, $lista_campo) or die("No se pudo escribir en el archivo");  
	//fclose($fh);




}

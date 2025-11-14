<?php
ini_set('display_errors',0);
error_reporting(E_ALL);

$fechahoy=date("Y-m-d");
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename="."OCASIONALES_".$fechahoy.".xls");
$banderaimp=1;

//header('Content-Type: text/html; charset=UTF-8'); 
$tiempossss=44440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);

$genr_id=$_GET["genr_id"];
$valcedula_val=@$_GET["valcedula_val"];

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include("lib_rep.php");
include("HtmlExcel.php");
 
$objformulario= new  ValidacionesFormulario();
$obj_funciones=new util_funciones();

$emp_id=1;
$nombre_empresa="select * from app_empresa where emp_id='".$emp_id."'"; 
$resultl_empresa = $DB_gogess->executec($nombre_empresa,array());

$lista_rolg="select * from conco_generarroles where genr_id='".$genr_id."'";
$resultl_rolg = $DB_gogess->executec($lista_rolg,array());

$genr_anio=$resultl_rolg->fields["genr_anio"];
$genr_mes=$resultl_rolg->fields["genr_mes"];

$mes=array();
$mes[1]='ENERO';
$mes[2]='FEBRERO';
$mes[3]='MARZO';
$mes[4]='ABRIL';
$mes[5]='MAYO';
$mes[6]='JUNIO';
$mes[7]='JULIO';
$mes[8]='AGOSTO';
$mes[9]='SEPTIEMBRE';
$mes[10]='OCTUBRE';
$mes[11]='NOVIEMBRE';
$mes[12]='DICIEMBRE';


$documento='';

$cabecera='<html xmlns:x="urn:schemas-Microsoft-com:office:Excel">
<head>
    <!--[if gte mso 9]>
    <xml>
        <x:ExcelWorkbook>
            <x:ExcelWorksheets>
                <x:ExcelWorksheet>
                    <x:Name>Prueba</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
				
				<x:ExcelWorksheet>
                    <x:Name>Prueba2</x:Name>
                    <x:WorksheetOptions>
                        <x:Print>
                            <x:ValidPrinterInfo/>
                        </x:Print>
                    </x:WorksheetOptions>
                </x:ExcelWorksheet>
				
            </x:ExcelWorksheets>
        </x:ExcelWorkbook>
    </xml>
    <![endif]-->
</head>

<body>';

$pie='</body>
</html>';

//echo $cabecera;
$documento1=genera_reporte('info_tipodecontrato','Prueba',$genr_id,$DB_gogess);
$documento2=genera_reporte('info_tipodecontrato','Prueba2',$genr_id,$DB_gogess);

$css='';

$xls = new HtmlExcel();
$xls->setCss($css);
$xls->addSheet("Numbers",$documento1);
$xls->addSheet("Names",$documento2);
$xls->headers();
echo $xls->buildFile();
//echo $pie;


//$nombrexls="Ocacionales_".date("YmdHis");
 
//$obj_xlsx = new  ExcelService();

//$nombre_file=$obj_xlsx->generateExcel($documento,$nombrexls);
 
//$obj_xlsx->downloadFile($nombre_file);


}

?>
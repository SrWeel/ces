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


$lista_filtro="info_regimenlaboral,info_convenios,info_convenios,info_convenios,info_puestoinstitucional,info_convenios,info_admmies,info_tipodecontrato,info_tipodecontrato,info_tipodecontrato,info_tipodecontrato";
$array_filtro=array();
$array_filtro=explode(",",$lista_filtro);

$lista_vfiltro="2,1,2,4,73,3,1,8,4,9,10";
$array_vfiltro=array();
$array_vfiltro=explode(",",$lista_vfiltro);


$lista_titulo="CODIGO,EDUCADORES,DISCAPACIDAD,LUZ ESPERANZA,CONCEJALES,ADULTO MAYOR,MIES,LIBRE REMOCION,OCACIONALES,PERMANENTE,PROVICIONAL";
$array_titulo=array();
$array_titulo=explode(",",$lista_titulo);


$lista_cab1="GOBIERNO AUT&Oacute;NOMO DESCENTRALIZADO DEL CANT&Oacute;N LA CONCORDIA,";



$documento='';
//echo $cabecera;


$css='';

$xls = new HtmlExcel();
$xls->setCss($css);

for($i=0;$i<count($array_filtro);$i++)
{

$documento1='';
$documento1=genera_reporte($lista_cab1,$array_titulo[$i]." ".$mes[$genr_mes]."-".$genr_anio,$array_filtro[$i],$array_vfiltro[$i],$array_titulo[$i],$genr_id,$DB_gogess);
$xls->addSheet($array_titulo[$i],$documento1);

}


$xls->headers();
echo $xls->buildFile();
//echo $pie;




}

?>
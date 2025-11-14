<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$cuenta=999;
$secuencial_i=2499;

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$busca_archivo="select * from lpin_tomafisica where tomfis_id='".$_POST["tomfis_id"]."'";
$rs_barchivo = $DB_gogess->executec($busca_archivo,array());

$barchivo=$rs_barchivo->fields["tomfis_archivo"];
$centro_id=$rs_barchivo->fields["centro_id"];

if($centro_id==1)
{
  $centro_id=55;
}

$fp = fopen("../../archivoinv/".$barchivo, "r");

$cuentad=0;

$perio_id=5;

while (!feof($fp)){

    $linea = fgets($fp);
    $list_d=explode(",",$linea);
	
    //print_r($list_d);
	$nrc_data='';
	@$nrc_data=$list_d[5];
	
	$nivel_txt='';
	@$nivel_txt=$list_d[3];
	
	$carr_id='19';
	
		
		if(@$list_d[0])
		{

    $tomfis_enlace=$rs_barchivo->fields["tomfis_enlace"];	
	
	
$lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".trim(@$list_d[1])."'";
  $rs_nproducto = $DB_gogess->executec($lista_nproducto,array());
	  
	
$cuadrobm_id=$rs_nproducto->fields["cuadrobm_id"];	
	
$datos_produ="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);

$busca_und="select uniddesg_id from dns_principalstockactual where centro_id='".$centro_id."' and cuadrobm_id='".$cuadrobm_id."' order by stock_id  desc limit 1";
$rs_und = $DB_gogess->executec($busca_und);

$unid_idx=$rs_und->fields["uniddesg_id"];
	
	
	$unid_id=$unid_idx;	
	$ajuspr_cantidad=$rs_stactua->fields["stactual"];	
	$ajuspr_creal=@$list_d[8];
	

//calcula data
$ajuspr_diferencia=$ajuspr_cantidad-$ajuspr_creal;
//calcula data
   
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$ajuspr_fecharegistro=date("Y-m-d H:i:s");	  
	
if($cuadrobm_id>0)
{		  

if(!($unid_id))
{
  $unid_id=1;
}

$ingresa_pro="INSERT INTO lpin_ajusteproducto ( tomfis_enlace,cuadrobm_id, unid_id, ajuspr_cantidad, ajuspr_creal, ajuspr_diferencia, usua_id, ajuspr_fecharegistro) VALUES ('".$tomfis_enlace."','".$cuadrobm_id."','".$unid_id."','".$ajuspr_cantidad."','".$ajuspr_creal."','".$ajuspr_diferencia."','".$usua_id."','".$ajuspr_fecharegistro."')";

$rs_und = $DB_gogess->executec($ingresa_pro);
echo ".";		  
}
else
{
echo trim(@$list_d[1])."<br>";

}		  
		
		}
	
	
}

fclose($fp);

echo $cuentad;


?>
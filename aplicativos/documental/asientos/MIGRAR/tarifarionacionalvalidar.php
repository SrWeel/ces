<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$cuenta_data=0;
$target_path="HOMOLOGACIONTF.csv";
$url = $target_path;
$aux=array();
$archivo = fopen($url,'r');
$numlinea=0;
while ($linea = fgets($archivo)) {
   //echo $linea.'<br/>';
   
    $aux=array();
    $aux = explode(",",$linea); 
	
	//print_r($aux);
	
	if($aux[7])
	{
	

	$cuadrobm_codigoatc=trim($aux[7]);
	
	$cuadrobm_codigoispol=trim($aux[0]);
	$cuadrobm_preciotecho=trim($aux[2]);
	$cuadrobm_descripciontn=trim($aux[1]);
	$cuadrobm_dnivel1=trim($aux[3]);
	$cuadrobm_dnivel3=trim($aux[4]);
	$cuadrobm_concentraciontf=trim($aux[5]);
	$cuadrobm_presentaciontf=trim($aux[6]);
	
	$nombre_excel=trim($aux[8]);
	
	$busca_encuadrob="select * from dns_cuadrobasicomedicamentos where 	cuadrobm_codigoatc='".$cuadrobm_codigoatc."'";
	$rs_bdata = $DB_gogess->executec($busca_encuadrob);
	
	$cuadrobm_id=$rs_bdata->fields["cuadrobm_id"];
	
	$tarrp_obs='';
	if($cuadrobm_id>0)
	{
	  $tarrp_obs='';
	  //echo $nombre_excel."->".$rs_bdata->fields["cuadrobm_principioactivo"]."<br>";
	  $cuenta_data++;
	  
	}
	else
	{
	  $tarrp_obs='NO EXISTE';
	  echo $cuadrobm_codigoatc." -> ".$tarrp_obs."<br>";
	}
	
	  
	// $inserta_data="INSERT INTO lpin_tarifarioredpublica ( cuadrobm_codigoatc, tarrp_descripcion, tarrp_valortecho, tarrp_niveluno, tarrp_niveltres, tarrp_concentracion, tarrp_precentacioncomericial, cuadrobm_id,tarrp_obs) VALUES ('".$cuadrobm_codigoatc."','".$tarrp_descripcion."','".$tarrp_valortecho."','".$tarrp_niveluno."','".$tarrp_niveltres."','".$tarrp_concentracion."','".$tarrp_precentacioncomericial."','".$cuadrobm_id."','".$tarrp_obs."');";
	 
	 
	  //$rs_ok = $DB_gogess->executec($inserta_data);
	  
	
	}
	
	
	}
	
echo $cuenta_data."<br>";	

}

?>
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



$target_path="1792935261001_RETENCIONES CL&Iacute,NICA DE ESPECIALIDADES DEL SUR.txt";
$url = $target_path;
$aux=array();
$archivo = fopen($url,'r');
$numlinea=0;
while ($linea = fgets($archivo)) {
   //echo $linea.'<br/>';
   
    $aux=array();
    $aux = explode(" ",$linea); 
	//echo $aux[0]."<br>";
	if($aux[0]=='Comprobante')
	{	
	  $separa_retenciones=array();
	  $separa_retenciones=explode("	",$aux[2]);
	  print_r($separa_retenciones);
	  
	  $rete_numerodoc=$separa_retenciones[1];
	  $rete_ruc=$separa_retenciones[2];
	  $rete_acceso=$separa_retenciones[3];
	  
	  $fecha_data=array();
	  $fecha_data=explode("/",$separa_retenciones[5]);	  
	  $rete_fecha=$fecha_data[2]."-".$fecha_data[1]."-".$fecha_data[0];
	  
	  
	  $rete_xml=$separa_retenciones[1];
	  $rete_xml='';
	  
	  //busca registro local
	  $busca_data="select * from comprobante_retencion_cab where compretcab_nretencion='".$rete_numerodoc."'";
	  $rs_bdata = $DB_gogess->executec($busca_data);
	  
	  $compretcab_id=$rs_bdata->fields["compretcab_id"];
	  $rete_estado=$rs_bdata->fields["compretcab_estadosri"];	  
	  //busca registro local
	  
	  $inserta_data="INSERT INTO rete_data (rete_numerodoc, rete_ruc, rete_acceso, rete_fecha, rete_xml,rete_baselocal,rete_estado) VALUES ('".$rete_numerodoc."','".$rete_ruc."','".$rete_acceso."','".$rete_fecha."','".$rete_xml."','".$compretcab_id."','".$rete_estado."');";
	  $rs_ok = $DB_gogess->executec($inserta_data);
	  
	  
	}
	   
    $numlinea++;
}

fclose($archivo);


}

?>
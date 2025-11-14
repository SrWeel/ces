<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_GET["exls"]==1)
{

header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."ld_".$fechahoy.".csv");

}
if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario(); 

$contador=0;

$variable_concateba='';

$variable_concateba.="No|FECHA|CODIGO ASIENTO|CUENTA|DETALLE|DEBE|HABER|\n";


$fecha_i=$_POST["fecha_i"];
$fecha_f=$_POST["fecha_f"];

$suma_debetotal=0;
$suma_habertotal=0;
 
$listadiario="select * from lpin_comprobantecontable where comcont_anulado=0 and comcont_fecha>='".$fecha_i."' and comcont_fecha<='".$fecha_f."' order by comcont_fecha,comcont_id asc";
$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 
	 $listadbehaberc="select count(*) as total from lpin_detallecomprobantecontable where 	comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."'"; 
	 $rs_debehaberc = $DB_gogess->executec($listadbehaberc,array());
	 
	 if($rs_debehaberc->fields["total"]>0)
	 {
	 $suma_debe=0;
	 $suma_haber=0;
	 $contador++;
	 //==========================================================
	 
	 $variable_concateba.="".$contador."|".$rs_listadiario->fields["comcont_fecha"]."|".$rs_listadiario->fields["comcont_id"]."||".$rs_listadiario->fields["comcont_concepto"].' N.Comprobante:'.$rs_listadiario->fields["comcont_numeroc"]."|||\n";

	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."' and detcc_debe>0"; 
	 $rs_debehaber = $DB_gogess->executec($listadbehaber,array());
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	   
	     
		 $variable_concateba.="|||".$rs_debehaber->fields["detcc_cuentacontable"]."|".$rs_debehaber->fields["detcc_descricpion"]."|".$rs_debehaber->fields["detcc_debe"]."||\n";
		 
		  $suma_debe=$suma_debe+$rs_debehaber->fields["detcc_debe"];
		  $suma_debetotal=$suma_debetotal+$rs_debehaber->fields["detcc_debe"];
		 
		 $rs_debehaber->MoveNext();
	   }
	 }
	 //=====================================================================
	 
	 $listadbehaber="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_listadiario->fields["comcont_enlace"]."' and detcc_haber>0"; 
	 $rs_debehaber = $DB_gogess->executec($listadbehaber,array());
	 
	 if($rs_debehaber)
     {
       while (!$rs_debehaber->EOF) {
	   
	     
		 $variable_concateba.="|||".$rs_debehaber->fields["detcc_cuentacontable"]."|".$rs_debehaber->fields["detcc_descricpion"]."||".$rs_debehaber->fields["detcc_haber"]."|\n";
	     
		 
		   $suma_haber=$suma_haber+$rs_debehaber->fields["detcc_haber"];
		   
		   $suma_habertotal=$suma_habertotal+$rs_debehaber->fields["detcc_haber"];
		   
		 $rs_debehaber->MoveNext();
	   }
	 } 
	 
	 $alertavalor='#F0F0F0';
	 if(trim($suma_debe)!==trim($suma_haber))
	 {
	   $alertavalor=' #F9D2E2 ';
	 }
	 
	  $variable_concateba.="|TOTAL||||".$suma_debe."|".$suma_haber."|\n"; 

	 //==========================================================
	 }  

	$rs_listadiario->MoveNext();	
		} 
 
 }  
?>
<?php

 $variable_concateba.="|TOTAL||||".$suma_debetotal."|".$suma_habertotal."|\n";


echo $variable_concateba;
?>

<?php
}
?>

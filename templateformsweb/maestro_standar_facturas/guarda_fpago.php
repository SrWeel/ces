<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$busca_total="select * from beko_documentocabecera where doccab_id='".$_POST["doccab_id"]."'";
$rs_btotal = $DB_gogess->executec($busca_total,array());

$total_apagar=$rs_btotal->fields["doccab_total"];

$busca_codep="select * from beko_formapago where frm_codigo='".$_POST["fpago_valor"]."'";
$rs_codep = $DB_gogess->executec($busca_codep,array());

$frm_id=$rs_codep->fields["frm_id"];




$busca_existepago="select count(*) as total from beko_documentoformapago where doccab_id='".$_POST["doccab_id"]."' and docfpag_valor>0";
$rs_existepago = $DB_gogess->executec($busca_existepago,array());


if($rs_existepago->fields["total"]==1)
{
     $busca_sidata="select docfpag_id,docfpag_valor from beko_documentoformapago where doccab_id='".$_POST["doccab_id"]."' and docfpag_valor>0";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());

     if($rs_bdata->fields["docfpag_id"])
	 {

	   $actualiza="update beko_documentoformapago set docfpag_valor=".$total_apagar.",frm_id='".$frm_id."' where docfpag_id='".$rs_bdata->fields["docfpag_id"]."'";

	   $rs_actualiza = $DB_gogess->executec($actualiza,array());

	 }
	 
}

if(!($rs_existepago->fields["total"]))
{
    $inserta="insert into beko_documentoformapago (frm_id,doccab_id,docfpag_valor) values ('".$frm_id."','".$_POST["doccab_id"]."',".$total_apagar.")";
    $rs_inserta = $DB_gogess->executec($inserta,array());

}





?>
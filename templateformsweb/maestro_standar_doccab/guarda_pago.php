<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_inicio'])
{

     $busca_sidata="select docfpag_id,docfpag_valor from app_documentoformapago where frm_id=".$_POST["frm_idp"]." and doccab_id='".$_POST["doccab_idp"]."'";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());
	 if($rs_bdata->fields["docfpag_id"])
	 {
	   $actualiza="update app_documentoformapago set docfpag_valor=".$_POST["valorp"]." where frm_id=".$_POST["frm_idp"]." and doccab_id='".$_POST["doccab_idp"]."'";
	   $rs_actualiza = $DB_gogess->executec($actualiza,array());
	 }
	 else
	 {
	   $inserta="insert into app_documentoformapago (frm_id,doccab_id,docfpag_valor) values (".$_POST["frm_idp"].",'".$_POST["doccab_idp"]."',".$_POST["valorp"].")";
	   $rs_inserta = $DB_gogess->executec($inserta,array());
	 
	 }



}
?>

<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$tabla_combo=$rs_fields->fields["fie_tblcombogrid"];
$idtabla_combo=$rs_fields->fields["fie_campoidcombogrid"];

$campos_datainserta=array();
$campos_datainserta=explode(",",$rs_fields->fields["fie_tablasubgridcampos"]);

$campo_enlace='';
$campo_enlace=$rs_fields->fields["fie_campoenlacesub"];

$campo_fecharegistro='';
$campo_fecharegistro=$rs_fields->fields["fie_campofecharegistro"];

$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];

$lista_combo="select * from ".$tabla_combo;
$post_data=array();
$rs_lcombo = $DB_gogess->executec($lista_combo,array());
if($rs_lcombo)
{
	  while (!$rs_lcombo->EOF) {	
	  
	  $post_data=array();
	  $post_data["areev_idx"]=$rs_lcombo->fields["areev_id"];
	  $post_data["pedneuro_marcadorx"]='';
	  $post_data["pedneuro_observacionesx"]='';
	  $post_data["pedneuro_observacionesx"]='';
      
	  $busca_existe="select areev_id from ".$sub_tabla." where ".$campo_enlace."='".$_POST["enlace"]."' and areev_id=".$post_data["areev_idx"];
	  $rs_bexiste = $DB_gogess->executec($busca_existe,array());
	  
	  if(!(@$rs_bexiste->fields["areev_id"]))
	  {
	    $rs_inserta ='';
	    $sql_inserta=$objvarios->genera_insert($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d"),$post_data,$campos_datainserta);
	    $rs_inserta = $DB_gogess->executec($sql_inserta,array());
	  }

	  
	  $rs_lcombo->MoveNext();
	  }
 }	  
?>
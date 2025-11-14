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

$iddata=$_POST["iddata"];

$datos_fields="select * from gogess_sisfield where fie_id=".$_POST["fie_id"];
$rs_fields = $DB_gogess->executec($datos_fields,array());

$sub_tabla='';
$sub_tabla=$rs_fields->fields["fie_tablasubgrid"];

$campo_enlace='';
$campo_enlace=$rs_fields->fields["fie_campoenlacesub"];

$campo_fecharegistro='';
$campo_fecharegistro=$rs_fields->fields["fie_campofecharegistro"];

$campo_combollena=array();

$lista_campos="select * from gogess_gridfield where fie_id=".$_POST["fie_id"]."";
$rs_lcanp = $DB_gogess->executec($lista_campos,array());
 if($rs_lcanp)
 {
	  while (!$rs_lcanp->EOF) {
	  
	 
	 if($rs_lcanp->fields["gridfield_llenarconcombo"]==1)
	 {
	 $tabla_combo=$rs_lcanp->fields["gridfield_tablecmb"];
	 @$campo_combollena=explode(",",@$rs_lcanp->fields["gridfield_camposcmb"]);
	 @$campo_verificax=substr($rs_lcanp->fields["gridfield_nameid"],0,-1);
	 }
	 
	 
	 if($rs_lcanp->fields["gridfield_valordefecto"])
	 {
	    @$campo_defa=substr($rs_lcanp->fields["gridfield_nameid"],0,-1);
		@$campo_afecta_valor=$rs_lcanp->fields["gridfield_valordefecto"];
	 }
	  
	  
	  $rs_lcanp->MoveNext();
	  
	  }
}


$campos_datainserta=array();
if(trim(@$campo_defa))
{
$campos_datainserta=explode(",",$campo_verificax.",".@$campo_defa.",clie_id");
}
else
{
$campos_datainserta=explode(",",$campo_verificax.",clie_id");
}

$lista_combo="select * from ".$tabla_combo." where ".$campo_combollena[0]."='".$iddata."'";
$post_data=array();
$rs_lcombo = $DB_gogess->executec($lista_combo,array());
if($rs_lcombo)
{
	  while (!$rs_lcombo->EOF) {	
	  
	  //echo $campo_verificax."<br>";
	  
	  $post_data=array();
	  @$post_data[$campo_verificax."x"]=$rs_lcombo->fields[$campo_verificax];
	  @$post_data[$campo_defa."x"]=$campo_afecta_valor;
	  @$post_data["clie_idx"]=$_POST["clie_id"];
	  
      
	  //$busca_existe="select ".$campo_verificax." from ".$sub_tabla." where clie_id='".$_POST["clie_id"]."' and ".$campo_verificax."='".$post_data[$campo_verificax."x"]."'";
	 // $rs_bexiste = $DB_gogess->executec($busca_existe,array());
	  
	  //if(!(@$rs_bexiste->fields[$campo_verificax]))
	  //{
	    $campo_enlace='anam_enlace';
	    $rs_inserta ='';
	    $sql_inserta=$objvarios->genera_insert($sub_tabla,$campo_enlace,$campo_fecharegistro,$_POST["enlace"],$_POST["sess_id"],date("Y-m-d H:i:s"),$post_data,$campos_datainserta);
	    $rs_inserta = $DB_gogess->executec($sql_inserta,array());
	 // }

	  
	  $rs_lcombo->MoveNext();
	  }
 }	  
?>
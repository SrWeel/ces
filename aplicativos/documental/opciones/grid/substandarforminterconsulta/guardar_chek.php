<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['datafrank1109_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)

 {

  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;


//tabla:tabla,
	//campo:campo,
	//valor:valor_obj,
	//id:id
	

if($_POST["valor"]==1)
{

  $estado_val=1;
}
else
{
  $estado_val=0;

}


$busca_regi="select * from ".$_POST["tabla"]." where clie_id=".$_POST["clie_id"]." and even_id=".$_POST["even_id"];
$rs_regi = $DB_gogess->executec($busca_regi,array());
if($rs_regi)
{
   
    if($rs_regi->fields["clieve_id"])
	{
	   $actualiza_data="update app_clienteeventos set clieve_activo=".$estado_val." where clieve_id=".$rs_regi->fields["clieve_id"];
	   $rs_actuok = $DB_gogess->executec($actualiza_data,array());
	
	}
	else
	{
	   $inserta_data="insert into app_clienteeventos (clie_id,even_id,clieve_activo,clieve_fecharegistro) values ('".$_POST["clie_id"]."','".$_POST["even_id"]."','".$estado_val."','".date("Y-m-d")."')";
	   $rs_insok = $DB_gogess->executec($inserta_data,array());
	   
	
	}

}





}



?>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44540000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();





$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");



include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)

 {



  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");



 } 



$objformulario= new  ValidacionesFormulario();



$objtableform= new templateform();



 if (@$table)



  {



  $objtableform->select_templateform(@$table,$DB_gogess);	



  }



$objformulario->sisfield_arr=$gogess_sisfield;

$objformulario->sistable_arr=$gogess_sistable;





$busca_datos="select * from faesa_asigahorario where eteneva_id=".$_POST["eteneva_id"];

$rs_bdatos = $DB_gogess->executec($busca_datos,array());

$actualiza_data='';

if($rs_bdatos->fields["asighor_id"])

{



   $actualiza_data="update faesa_asigahorario set eteneva_id='".$_POST["eteneva_id"]."',grup_id='".$_POST["grup_idx"]."',asighor_fecha='".$_POST["asighor_fechax"]."',clie_id='".$_POST["clie_id"]."',atenc_id='".$_POST["atenc_id"]."' where asighor_id=".$rs_bdatos->fields["asighor_id"];

  $rs_actdata = $DB_gogess->executec($actualiza_data,array());

}

else

{

   $actualiza_data="insert into faesa_asigahorario (eteneva_id,grup_id,asighor_fecha,clie_id,atenc_id) values ('".$_POST["eteneva_id"]."','".$_POST["grup_idx"]."','".$_POST["asighor_fechax"]."','".$_POST["clie_id"]."','".$_POST["atenc_id"]."')";

  $rs_actdata = $DB_gogess->executec($actualiza_data,array());

}

?>

 
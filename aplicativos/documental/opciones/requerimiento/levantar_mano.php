<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

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

$hoy='';
$hoy = date("Y-m-d H:i:s");

$busca_existe="select requ_id,manol_aceptado from app_manolevantada where requ_id=".$_POST["requidq"]." and usua_id=".$_POST["usuaidp"];
$rs_okexiste = $DB_gogess->executec($busca_existe,array());
$imagen_foto='';

if($rs_okexiste->fields["manol_aceptado"]==1)
{
  
   $imagen_foto='images/mlevantada.png';

}
else
{
if($rs_okexiste->fields["requ_id"])
{
   $quita_mano="delete from app_manolevantada where requ_id=".$rs_okexiste->fields["requ_id"];
   $rs_okquita = $DB_gogess->executec($quita_mano,array());
   $imagen_foto='images/mcerrada.png';
   
  
}
else
{

   $selecciona_req="insert into app_manolevantada (requ_id,usua_id,manol_fecha) values ('".$_POST["requidq"]."','".$_POST["usuaidp"]."','".$hoy."')";
   $rs_ok = $DB_gogess->executec($selecciona_req,array());
   $imagen_foto='images/mlevantada.png';
}
}

?>
<img src="<?php echo $imagen_foto; ?>">
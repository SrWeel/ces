<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['ces1313777_sessid_emp_id'])
{

function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}
 

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

 $lista_detalle="select * from app_facturatemporal where facttmp_estado=1 and clie_id=".$_POST["clie_id"]; 
 $rs_detalle = $DB_gogess->executec($lista_detalle,array());
 
 if($rs_detalle->fields["facttmp_id"])
 {
  
  echo "Cliente esta siendo atendido...No de atención:<br><b>".$rs_detalle->fields["facttmp_id"]."</b>";
 
 }
 else
 {
 

 
 $aleatorio_php=$_SESSION['ces1313777_sessid_emp_id']."-".$_POST["clie_id"]."-".generarCodigo(5).date("Ymdhis");
 //asigna pedido.
 
 $asignar_pedido="insert into app_facturatemporal (emp_id,clie_id,facttmp_codetemp,facttmp_fecha,facttmp_estado) values ('".$_SESSION['ces1313777_sessid_emp_id']."','".$_POST["clie_id"]."','".$aleatorio_php."','".date("Y-m-d")."','1')";
 $rs_asignar = $DB_gogess->executec($asignar_pedido,array());
 $idnuevo=$DB_gogess->funciones_nuevoID();
 
 echo "Cliente ingresado...N.- de atenci&oacute;n:<br><b><h1>".$idnuevo."</h1></b>";
 //asigna pedido
 
 
 }
 
 
 }
 else
 {
 echo "<center><b>Su sesión ha terminado por favor de clic en F5 para continuar...</b></center>";
 }

?>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$detapre_id=$_POST["detapre_id"];

$busca_precuenta="select * from dns_detalleprecuenta where detapre_id='".$detapre_id."'";
$rs_precuenta= $DB_gogess->executec($busca_precuenta,array());
$moviin_id=$rs_precuenta->fields["moviin_id"];
$precu_id=$rs_precuenta->fields["precu_id"];


if($moviin_id>0)
{
$borrar_movimientodata="delete from dns_movimientoinventario where moviin_id='".$moviin_id."'";
$rs_bmovi= $DB_gogess->executec($borrar_movimientodata,array());


$busca_medi="delete from dns_detalleprecuenta where detapre_id='".$detapre_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());

//borrar asiento


 //borra comporbante contable
	  $borra_detallescc="delete from lpin_detallecomprobantecontable where comcont_enlace in (select comcont_enlace from lpin_comprobantecontable where comcont_tabla='dns_precuenta' and comcont_idtabla='".$precu_id."' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."')";
	  $ok_b1=$DB_gogess->executec($borra_detallescc);
	  
	  $file = fopen("log/e_borraras".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_detallescc."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	  
	  $borra_data1="delete from lpin_comprobantecontable where comcont_tabla='dns_precuenta' and comcont_idtabla='".$precu_id."' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."'";
	  $ok_b2=$DB_gogess->executec($borra_data1);
	  
	  $file = fopen("log/e_borraras".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_data1."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
//borra comporbante contable


//borrar asiento


}
else
{
$busca_medi="delete from dns_detalleprecuenta where detapre_id='".$detapre_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());



//borrar asiento


 //borra comporbante contable
	  $borra_detallescc="delete from lpin_detallecomprobantecontable where comcont_enlace in (select comcont_enlace from lpin_comprobantecontable where comcont_tabla='dns_precuenta' and comcont_idtabla='".$precu_id."' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."')";
	  $ok_b1=$DB_gogess->executec($borra_detallescc);
	  
	  $file = fopen("log/e_borraras".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_detallescc."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	  
	  $borra_data1="delete from lpin_comprobantecontable where comcont_tabla='dns_precuenta' and comcont_idtabla='".$precu_id."' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."'";
	  $ok_b2=$DB_gogess->executec($borra_data1);
	  
	  $file = fopen("log/e_borraras".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_data1."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
//borra comporbante contable


//borrar asiento





}

?>


<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
 //$_POST["ptabla"];
 //$_POST["pcampo"];
// $_POST["pvalor"];

//tabla

$busva_tbl="select * from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
$bu_tbl=$DB_gogess->executec($busva_tbl);



//borra transacciones y retencion

$borrat="delete from lpin_lqtransacciones where tpliq_enlace='".$bu_tbl->fields["tpliq_enlace"]."'";
//echo $borrat."<br>";
$bu_borrat=$DB_gogess->executec($borrat);

$lista_renta="delete from tarjeta_retencion_detalle  where tpliq_enlace='".$bu_tbl->fields["tpliq_enlace"]."'";
//echo $lista_renta."<br>";
$rs_listadata = $DB_gogess->executec($lista_renta,array());

$busca_comprobante="select *  from lpin_comprobantecontable where comcont_tabla='lpin_lqtarjetacredito' and comcont_idtabla='".$_POST["pvalor"]."'";
$rs_bucomprobante = $DB_gogess->executec($busca_comprobante,array());
//echo $busca_comprobante."<br>";

$comcont_enlace=$rs_bucomprobante->fields["comcont_enlace"];
//echo $comcont_enlace."<br>";

$busca_comprobantedetalle="delete  from lpin_detallecomprobantecontable where comcont_enlace='".$comcont_enlace."'";
//echo $busca_comprobantedetalle."<br>";
$rs_bucomprobantedetalle = $DB_gogess->executec($busca_comprobantedetalle,array());


$borra_comprobante="delete  from lpin_comprobantecontable where comcont_tabla='lpin_lqtarjetacredito' and comcont_idtabla='".$_POST["pvalor"]."'";
//echo $borra_comprobante."<br>";
$rs_borracomprobante = $DB_gogess->executec($borra_comprobante,array());


//borra transacciones y retencion

//tabla
 
$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
 //echo $_POST["pvalor"];
$ok=$DB_gogess->executec($creascripborrado);
 

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 }
 
 }
 else
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';
 
 }
?>

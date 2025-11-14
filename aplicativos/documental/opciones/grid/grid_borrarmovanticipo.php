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

//busca si ya fue usado


$busca_cruveus="select * from lpin_crucedocumentos inner join cesdb_arextension.lpin_cruceanticipos on lpin_crucedocumentos.crudoc_enlace=cesdb_arextension.lpin_cruceanticipos.crudoc_enlace where cruant_anticipo='".$_POST["pvalor"]."'";
$bu_crucereg=$DB_gogess->executec($busca_cruveus);

$doccabcr_id=$bu_crucereg->fields["doccabcr_id"];
$compracr_id=$bu_crucereg->fields["compracr_id"];

if($doccabcr_id!='' or $compracr_id>0)
{
  
  $busca_venta="select * from beko_documentocabecera where 	doccab_id='".$doccabcr_id."'";
  $bu_buventa=$DB_gogess->executec($busca_venta);
  
  $doccab_ndocumento=$bu_buventa->fields["doccab_ndocumento"];
  
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado ya esta usado en un documento...COMPRA_ID='.$compracr_id.' o VENTA='.$doccab_ndocumento.'</div>';
  
  ?>
  
<script type="text/javascript">
<!--

alert("Registro bloqueado ya esta usado en un documento...COMPRA_ID=<?php echo $compracr_id; ?> o VENTA=<?php echo $doccab_ndocumento; ?>")


-->
</script>
  
  <?php
  
}
else
{

$busca_registroaborra="select * from ".$_POST["ptabla"]." where anti_id='".$_POST["pvalor"]."'";
$busca_reg=$DB_gogess->executec($busca_registroaborra);

$file = fopen("log/e_borrarbancoant".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$busca_registroaborra."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);


	   
	   //borra comporbante contable
	  $borra_detallescc="delete from lpin_detallecomprobantecontable where comcont_enlace in (select comcont_enlace from lpin_comprobantecontable where comcont_tabla='app_anticipos' and comcont_idtabla='".$_POST["pvalor"]."')";
	  $ok_b1=$DB_gogess->executec($borra_detallescc);
	  
	  $file = fopen("log/e_borrarbancoant".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_detallescc."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	  
	  $borra_data1="delete from lpin_comprobantecontable where comcont_tabla='app_anticipos' and comcont_idtabla='".$_POST["pvalor"]."'";
	  $ok_b2=$DB_gogess->executec($borra_data1);
	  
	  $file = fopen("log/e_borrarbancoant".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
      fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borra_data1."-->".date("Y-m-d H:i:s"). PHP_EOL);
      fclose($file);
	   //borra comporbante contable
	  

$borrar_detalles="delete  from lpin_movanticipos where anti_enlace='".$busca_reg->fields["anti_enlace"]."'";
$ok_b3=$DB_gogess->executec($borrar_detalles);

$file = fopen("log/e_borrarbancoant".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$borrar_detalles."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);

	  
 
$creascripborrado="delete from ".$_POST["ptabla"]." where ".$_POST["pcampo"]."=".$_POST["pvalor"];
 echo $_POST["pvalor"];
$ok=$DB_gogess->executec($creascripborrado);
 
$file = fopen("log/e_borrarbancoant".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$creascripborrado."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);


 //borra detalles
 
 //borra detalles
 
 

 if($ok)
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro borrado con exito...</div>';
 }
 else
 {
  echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Registro bloqueado intente nuevamente...</div>';
 }
 
 
 }
 
 }
 else
 {
 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">Sesi&oacute;n ha caducado F5 para continuar...</div>';
 
 }
 
 
 
 
 
?>

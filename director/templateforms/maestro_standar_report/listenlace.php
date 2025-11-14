<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
?>

<style type="text/css">
<!--
.TableScroll_tablas {
        z-index:99;
		width:720px;
        height:100px;	
        overflow: auto;
      }


-->
</style>


<?php
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
//agregatablas
$listaasig='';
$list_data="select distinct reptdet_tabla from sth_reportdetalle where rept_id=".$_POST["rept_id"];

$resultlistat = $DB_gogess->Execute($list_data);
	if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
						  
						  
						// echo $resultlistat->fields["reptdet_tabla"]."<br>";
						 $listaasig=$listaasig."'".$resultlistat->fields["reptdet_tabla"]."',";
						 
						 $buscasiexiste="select rptenlc_tabla from sth_reportenlaces where rptenlc_tabla='".$resultlistat->fields["reptdet_tabla"]."' and rept_id=".$_POST["rept_id"];
						 
						 $resultbct = $DB_gogess->Execute($buscasiexiste);
						 if($resultbct)
						 {
							 
							 if(!($resultbct->fields["rptenlc_tabla"]))
							 {
								 
								 $insertatablaenlc="insert into sth_reportenlaces (rept_id,rptenlc_tabla) values ('".$_POST["rept_id"]."','".$resultlistat->fields["reptdet_tabla"]."')";
								 
								// echo $insertatablaenlc;
								 $okinsertt=$DB_gogess->Execute($insertatablaenlc);
								 
								 
							 }
							 
						 }
						 
						  
					  $resultlistat->MoveNext();
					  }
					 } 	  
					 
					 $listabd=substr($listaasig,0,-1);
					 
					 //borranoregistrados
					  $borrando="delete from sth_reportenlaces where rept_id=".$_POST["rept_id"]." and rptenlc_tabla not in (".$listabd.")";
					 $DB_gogess->Execute($borrando);

?>
<div align="center">
<div class="TableScroll_tablas">
<table width="700" border="0" cellpadding="2" cellspacing="2">
<?php
$listatablas="select * from sth_reportenlaces where  rept_id=".$_POST["rept_id"];
$resulttbl = $DB_gogess->Execute($listatablas);
	if($resulttbl)
					{  
					  while (!$resulttbl->EOF) {
	?>	
     <tr>
    <td width="176" bgcolor="#E0E8ED"><?php echo $resulttbl->fields["rptenlc_tabla"]; ?></td>
    <td width="207" bgcolor="#E0E8ED"><input name="campoa_<?php echo $resulttbl->fields["rptenlc_id"]; ?>" type="text" id="campoa_<?php echo $resulttbl->fields["rptenlc_id"]; ?>" onKeyUp="ver_actualizacampos('<?php echo $resulttbl->fields["rptenlc_id"]; ?>')" value="<?php echo $resulttbl->fields["rptenlc_campoa"]; ?>" size="40"></td>
    <td width="297" bgcolor="#E0E8ED"><input name="campob_<?php echo $resulttbl->fields["rptenlc_id"]; ?>" type="text" id="campob_<?php echo $resulttbl->fields["rptenlc_id"]; ?>" onKeyUp="ver_actualizacampos('<?php echo $resulttbl->fields["rptenlc_id"]; ?>')" value="<?php echo $resulttbl->fields["rptenlc_campob"]; ?>" size="40" ></td>
  </tr>				  
	<?php					  
						 $resulttbl->MoveNext();
					  }
					}
					
?>
 
</table>
</div>
</div>
<?php
}
else
{
echo "<div style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#FF0000'><b>A caducado la sesi&oacute;n vuelva a ingresar al sistema presione F5</b></div>";

}		
?>
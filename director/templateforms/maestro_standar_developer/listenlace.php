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
$list_data="select distinct vardevdet_tabla from sth_vddetalle where vardev_id=".$_POST["vardev_id"];

$resultlistat = $DB_gogess->Execute($list_data);
	if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {
						  
						if($resultlistat->fields["vardevdet_tabla"])
						{
						  
						// echo $resultlistat->fields["vardevdet_tabla"]."<br>";
						 $listaasig=$listaasig."'".$resultlistat->fields["vardevdet_tabla"]."',";
						 
						 $buscasiexiste="select vardevenlc_id,vardevenlc_tabla from sth_vdenlaces where vardevenlc_tabla='".$resultlistat->fields["vardevdet_tabla"]."' and vardev_id=".$_POST["vardev_id"];
						 
						 $resultbct = $DB_gogess->Execute($buscasiexiste);
						 if($resultbct)
						 {
							 //echo $resultbct->fields["vardevenlc_id"];
							 if(!(@$resultbct->fields["vardevenlc_id"]))
							 {
								//echo 'si';
								 $insertatablaenlc="insert into sth_vdenlaces (vardev_id,vardevenlc_tabla) values ('".$_POST["vardev_id"]."','".trim($resultlistat->fields["vardevdet_tabla"])."')";
								 
								 //echo $insertatablaenlc;
								$okinsertt=$DB_gogess->Execute($insertatablaenlc);
							
							 }
							 
						 }
						 
						  
						  }
					  $resultlistat->MoveNext();
					  }
					 } 	  
					 
					 $listabd=substr($listaasig,0,-1);
					 
					 //borranoregistrados
					  $borrando="delete from sth_vdenlaces where vardev_id=".$_POST["vardev_id"]." and vardevenlc_tabla not in (".$listabd.")";
					 $DB_gogess->Execute($borrando);

?>
<div align="center">
<div class="TableScroll_tablas">
<table width="700" border="0" cellpadding="2" cellspacing="2">
<?php
$listatablas="select * from sth_vdenlaces where  vardev_id=".$_POST["vardev_id"];
$resulttbl = $DB_gogess->Execute($listatablas);
	if($resulttbl)
					{  
					  while (!$resulttbl->EOF) {
	?>	
     <tr>
    <td width="176" bgcolor="#E0E8ED"><?php echo $resulttbl->fields["vardevenlc_tabla"]; ?></td>
    <td width="207" bgcolor="#E0E8ED"><input name="campoa_<?php echo $resulttbl->fields["vardevenlc_id"]; ?>" type="text" id="campoa_<?php echo $resulttbl->fields["vardevenlc_id"]; ?>" onKeyUp="ver_actualizacampos('<?php echo $resulttbl->fields["vardevenlc_id"]; ?>')" value="<?php echo $resulttbl->fields["vardevenlc_campoa"]; ?>" size="40"></td>
    <td width="297" bgcolor="#E0E8ED"><input name="campob_<?php echo $resulttbl->fields["vardevenlc_id"]; ?>" type="text" id="campob_<?php echo $resulttbl->fields["vardevenlc_id"]; ?>" onKeyUp="ver_actualizacampos('<?php echo $resulttbl->fields["vardevenlc_id"]; ?>')" value="<?php echo $resulttbl->fields["vardevenlc_campob"]; ?>" size="40" ></td>
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
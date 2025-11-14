<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$tiempossss=14000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$SUMA_T=0;
$mensaje='';

if($_SESSION['ces1313777_sessid_inicio'])
{
?>
<style type="text/css">
<!--
.txt_fpago {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>

<script language="javascript">
<!--
function guarda_fpago(valor,frm_id,doccab_id)
{
   $("#div_gpago").load("templateformsweb/maestro_standar_multiplefacturas/guarda_pago.php",{
valorp:valor,
frm_idp:frm_id,
doccab_idp:doccab_id
    },function(result){       

			 

   });  

  $("#div_gpago").html("Espere un momento...");
  
}
//-->
</script>
<table width="500" border="0" align="center" cellpadding="2" cellspacing="1">
<?php
$lista_fpago='';
$lista_fpago="select * from beko_formapago where frm_activo=1";
$rs_data = $DB_gogess->executec($lista_fpago,array());

if($rs_data)
{

	  while (!$rs_data->EOF) {	
	  
	 $busca_sidata="select docfpag_id,docfpag_valor from beko_multipledocumentoformapago where frm_id=".$rs_data->fields["frm_id"]." and doccab_id='".$_POST["pVar1"]."'";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());
?>
  <tr bgcolor="#CCE0E1">
    <td width="240"><span class="txt_fpago"><b><?php echo $rs_data->fields["frm_nombre"]; ?></b></span></td>
    <td width="144"><input name="valor_pag<?php echo $rs_data->fields["frm_id"]; ?>" type="text" id="valor_pag<?php echo $rs_data->fields["frm_id"]; ?>" value="<?php echo @$rs_bdata->fields["docfpag_valor"]; ?>" size="7" class="txt_fpago" onBlur="guarda_fpago($('#valor_pag<?php echo $rs_data->fields["frm_id"]; ?>').val(),'<?php echo $rs_data->fields["frm_id"]; ?>','<?php echo $_POST["pVar1"]; ?>');"  onkeyup="this.value = this.value.replace (/[^_0-9-. ]/,'');" 
onkeypress="this.value = this.value.replace (/[^_0-9-. ]/,'');" ></td>
  </tr>
  <tr bgcolor="#8BB8BA">
    <td width="240" height="4" class="txt_fpago" >&nbsp;</td>
    <td width="144" height="4" class="txt_fpago" >&nbsp;</td>
  </tr>
 <?php
 $SUMA_T=$SUMA_T+@$rs_bdata->fields["docfpag_valor"];
 $rs_data->MoveNext();	   

	  }

  }
  

 ?> 
 <tr bgcolor="#8BB8BA">
    <td width="240" height="4" class="txt_fpago" >TOTAL</td>
    <td width="144" height="4" class="txt_fpago" ><div id="total_valor"><?php echo $SUMA_T; ?></div></td>
  </tr>
</table>
<center>
<div id="div_gpago" >
<?php
$lista_fpagot="select doccab_total from beko_multipledocumentocabecera where doccab_id='".$_POST["pVar1"]."'";
$rs_datat = $DB_gogess->executec($lista_fpagot,array());
?>
<table>
<tr bgcolor="#8BB8BA">
    <td width="240" height="4" class="txt_fpago" >TOTAL FACTURADO</td>
    <td width="144" height="4" class="txt_fpago" ><?php echo $rs_datat->fields["doccab_total"]; ?></td>
  </tr>
</table>
<?php

if($rs_datat->fields["doccab_total"]!=$SUMA_T)
{
	
	$mensaje="Valor no coincide con el total de la factura...";
}
echo $mensaje;
?>
</div>
</center>
<?php

//echo $rs_datat->fields["doccab_total"];
?>
<input type="button" name="Submit" value="Guardar">

<?php
}
?>

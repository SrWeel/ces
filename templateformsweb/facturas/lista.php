
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if($_SESSION['ces1313777_sessid_inicio'])
{

$usua_id=$_POST["usua_id"];
$asigextr_fechaaprobacion=$_POST["asigextr_fechaaprobacion"];

$mesfecha=array();
$mesfecha=explode("-",$asigextr_fechaaprobacion);

$datosusuario="select * from app_usuario where usua_id='".$usua_id."'";
$rs_usuario = $DB_gogess->executec($datosusuario,array());
$usua_ciruc=$rs_usuario->fields["usua_ciruc"];

$sacamosidcliente="select provee_id from app_proveedor where provee_ruc like '".$usua_ciruc."%' or provee_cedula like '".$usua_ciruc."%'";

?>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#D6EBEF">FACTURA</td>
    <td bgcolor="#D6EBEF">FECHA</td>
    <td bgcolor="#D6EBEF">VALOR</td>
  </tr>
 
<?php
$sumatotal=0;
$lista_facturas="select * from beko_documentocabecera where tippo_id=1 and proveeve_id in (".$sacamosidcliente.") and month(doccab_fechaemision_cliente)='".$mesfecha[1]."'";
$rs_listfac = $DB_gogess->executec($lista_facturas,array());
if($rs_listfac)
 {
     while (!$rs_listfac->EOF) {
	 
	
	 
	 $busca_pagado="select * from beko_documentocabecera_vista where doccab_id='".$rs_listfac->fields["doccab_id"]."'";
	 $rs_pagado = $DB_gogess->executec($busca_pagado,array());
	 $saldo=$rs_pagado->fields["saldo"];
	 if($saldo>0)
	 {
?>  
  <tr>
    <td nowrap><?php echo $rs_listfac->fields["doccab_ndocumento"]; ?></td>
    <td nowrap><?php echo $rs_listfac->fields["doccab_fechaemision_cliente"]; ?></td>
    <td nowrap><?php echo $rs_listfac->fields["doccab_total"]; ?></td>
  </tr>
<?php  
       $sumatotal=$sumatotal+$rs_listfac->fields["doccab_total"];
     }
	 
       $rs_listfac->MoveNext();	
	} 
 } 
?>  
<tr>
    <td nowrap>&nbsp;</td>
    <td nowrap>&nbsp;</td>
    <td nowrap><?php echo $sumatotal; ?></td>
  </tr>
</table>

<?php

}
?>
<input name="valor_mes" type="hidden" id="valor_mes" value="<?php echo $sumatotal ?>">
<input type="button" name="Submit" value="Enviar Valor" onClick="envia_valor();">

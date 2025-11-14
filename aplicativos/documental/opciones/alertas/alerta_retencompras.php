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
$anioac=0;
$anioac=$_POST["anioactual"];

?>
<div>

<table width="300" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS AUTORIZADAS:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS PENDIENTES:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_estadosri='' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong>
	</td>
  </tr>
  
   <tr>
     <td colspan="2" style="font-size:9px" ><?php
	$autorizlist_p="select compra_id from  comprobante_retencion_cab where compretcab_estadosri='' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_listp= $DB_gogess->executec($autorizlist_p,array());
	if($rs_listp)
	{
	   while (!$rs_listp->EOF) 
			{
			 
			 echo $rs_listp->fields["compra_id"].",";
			
			 $rs_listp->MoveNext();
			}
	}		
	
	?></td>
    </tr>
   <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS RECIBIDA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_estadosri='RECIBIDA' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS DEVUELTAS:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_estadosri='DEVUELTA' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS NO AUTORIZADA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_estadosri='NO AUTORIZADO' and compretcab_anulado=0 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr>
    <td width="257" style="font-size:9px" ><strong>RETENCIONES EN COMPRAS ANULADAS:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from  comprobante_retencion_cab where compretcab_anulado=1 and year(compretcab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
 </table> 
</div>
<?php
}
?>

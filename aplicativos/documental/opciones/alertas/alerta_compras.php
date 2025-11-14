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
   
    <td style="font-size:9px" ><strong>
      <?php
	$autorizadas="select tipdoc_nombre,count(*) as total from dns_compras left join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_anulado=0 and year(compra_fecha)='".$anioac."' group by tipdoc_nombre";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
    if($rs_autort)
    {
	    while (!$rs_autort->EOF) {	
	  
	         echo $rs_autort->fields["tipdoc_nombre"].": ".$rs_autort->fields["total"]."<br>";
		  
	      $rs_autort->MoveNext();
	    }
	 }
	
	?>
    </strong></td>
  </tr>
</table>

<table width="300" border="1" cellpadding="0" cellspacing="0">
 <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS PENDIENTES:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=0 and year(compra_fecha)='".$anioac."' and compra_estadosri=''";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS AUTORIZADAS:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=0 and year(compra_fecha)='".$anioac."' and compra_estadosri='AUTORIZADO'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
   <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS RECIBIDA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=0 and year(compra_fecha)='".$anioac."' and compra_estadosri='RECIBIDA'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS DEVUELTA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=0 and year(compra_fecha)='".$anioac."' and compra_estadosri='DEVUELTA'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS NO AUTORIZADA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=0 and year(compra_fecha)='".$anioac."' and compra_estadosri='NO AUTORIZADO'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
    <tr>
    <td width="257" style="font-size:9px" ><strong>LIQUIDACION DE COMPRAS ANULADA:</strong></td>
    <td width="45" style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from dns_compras where tipdoc_id='19' and compra_anulado=1 and year(compra_fecha)='".$anioac."'";
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

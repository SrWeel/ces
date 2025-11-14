<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

$fecha_desct=$_GET["fecha_desct"];
$centrod_id=$_GET["centrod_id"];

echo "<center><b>".$fecha_desct."</b></center>";
?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Tipo </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Bodega </div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Repuesto</div></td>
    </tr>
	
	<?php
	 $valor_total=0;
$lista_precuentas="select detapre_codigop,detapre_tipo,detapre_codigop,centrob_id,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,centro_nombre from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where centrob_id='".$centrod_id."' and detapre_fecharegistro like '".$fecha_desct."%' group by detapre_codigop,detapre_tipo,detapre_codigop,centrob_id,detapre_detalle";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
    if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
    if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     $estado_prec='TARIFARIO';
   
   }

   
	?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
      <td class="css_texto"><div align="center">
        <input type="checkbox" name="checkbox" value="checkbox" />
      </div></td>

    </tr>
	<?php
	   //$valor_total=$valor_total+($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>


</tr>
	  
  </table>
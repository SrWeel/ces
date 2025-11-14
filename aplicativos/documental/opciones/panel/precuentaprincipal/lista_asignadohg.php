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

$precu_id=$_POST["precu_id"];
?>
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Tipo </div></td>    
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Total</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	 $valor_total=0;
	$lista_precuentas="select * from dns_detalleprecuentaprincipal left join api_bodega on dns_detalleprecuentaprincipal.bodega_id=api_bodega.bode_id  where precu_id='".$precu_id."' and detapre_tipo=4";
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==4)
   {
     $estado_prec='MCGRAW HILL';
   
   }
   
   
   
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
         <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asighg('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td height="21" class="css_texto" style="font-size:10px" ><div align="center"><?php echo $estado_prec; ?></div></td>      
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precio"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

?>

<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	 <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><?php echo $valor_total; ?></b></div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>

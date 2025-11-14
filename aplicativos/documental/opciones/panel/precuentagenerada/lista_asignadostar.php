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
$lista_precuentas="select * from dns_detalleprecuenta left join api_bodega on dns_detalleprecuenta.bodega_id=api_bodega.bode_id  where precu_id='".$precu_id."' and detapre_tipo=3";
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==3)
   {
     $estado_prec='TARIFARIO';
   
   }
   
   
   
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
         <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigtar('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td height="21" class="css_texto" style="font-size:10px" ><div align="center"><?php echo $estado_prec; ?></div></td>      
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <!-- <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td> -->
	  <?php
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuenta'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id'; 
   
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_cantidad';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.round($rs_lprecuentas->fields[$ncampo_val],2).'" size="20" onblur="guardar_camposprcambcantidad('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.',$('.$comulla_simple.'#cmb_detapre_precio'.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';
	  
	  
	  ?>
	  
	  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>	  
	  	  <?php
		  
   
   
   		  
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.round($rs_lprecuentas->fields[$ncampo_val],2).'" size="20" onblur="guardar_camposprcamb('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.',$('.$comulla_simple.'#cmb_detapre_cantidad'.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';

      ?>
	 
	  <td class="css_texto"><div align="center"><div id="cmb_total<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo round(($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></div></td>	
	  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
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
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><div id="totales_gentar3"><?php echo round($valor_total,3); ?></div></b></div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>
<div id="campo_valort"></div>

<script type="text/javascript">
<!--


function guardar_camposprcamb(tabla,campo,id,valor,campoidtabla,cantidad,clie_id,precu_id,tipo)
{

$("#campo_valort").load("aplicativos/documental/opciones/panel/precuentagenerada/guarda_campostar.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla,
cantidad:cantidad,
clie_id:clie_id,
precu_id:precu_id,
tipo:tipo

 },function(result){       

  });  

$("#campo_valort").html("Espere un momento...");


}


function guardar_camposprcambcantidad(tabla,campo,id,valor,campoidtabla,cantidad,clie_id,precu_id,tipo)
{

$("#campo_valort").load("aplicativos/documental/opciones/panel/precuentagenerada/guarda_campostarcantidad.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla,
cantidad:cantidad,
clie_id:clie_id,
precu_id:precu_id,
tipo:tipo

 },function(result){       

  });  

$("#campo_valort").html("Espere un momento...");



}

//  End -->
</script>

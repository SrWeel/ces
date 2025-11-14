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
$centro_id=$_POST["centro_id"];

if($centro_id==1)
{
  $centro_id='55';
}

?>
<div id="corrige_precio"></div>
MEDICAMENTOS
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Bodega </div></td>  
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>    
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">P.Compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">PVP</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha</div></td>
<?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?>
	<td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CORRECION</div></td>
<?php
}
?>	   
    </tr>
	<?php
	$valor_total=0;
	$lista_precuentas="select * from dns_detalleprecuentaprincipal left join dns_centrosalud_ext on dns_detalleprecuentaprincipal.centrob_id=dns_centrosalud_ext.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1) order by detapre_id asc";
	
	//$lista_precuentas="select * from dns_detalleprecuentaprincipal left join dns_centrosalud on dns_detalleprecuentaprincipal.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuentaprincipal.centrob_id in (".$centro_id.",1,9999,8888)";
	
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
     
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 
   
  if($rs_lprecuentas->fields["centrob_id"]==55 or $rs_lprecuentas->fields["centrob_id"]==8888 or $rs_lprecuentas->fields["centrob_id"]==9999)
   {
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuentaprincipal'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';  
   
    ?>
    <tr>
      <td height="21" class="css_texto"><div align="center">
        <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigx('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>        
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <?php
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_campospr('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';
	  ?>
	  <td class="css_texto"><div align="center"><div id="cmb_detapre_precioventa<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></div></td>	  
	  <td class="css_texto"><div align="center"><div id="cmb_total<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></div></td>	  
	  <td class="css_texto" style="font-size:10px" onclick="ver_asientoc('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')"  ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
	  
	   
	  <?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?><td>
	  <input type="submit" name="Submit2" value="Corregir Precio" onclick="corregir_preciox('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')" />
	</td>  
<?php
}
?>	  
	  
	  
	  
    </tr>
   <?php
   }
   else
   {
	?>
    <tr>
      <td height="21" class="css_texto"><div align="center">
        <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigx('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>    
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>      
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
	  <td class="css_texto" style="font-size:10px" onclick="ver_asientoc('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')"  ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
	  
	    
<?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?><td>
	  <input type="submit" name="Submit2" value="Corregir Precio" onclick="corregir_preciox('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')" />
	  </td>
<?php
}
?>	  

	  
    </tr>
	<?php
	}
	
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);	
	$rs_lprecuentas->MoveNext();
	  }
  }
?>
<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><div id="totales_gen1"><?php echo round($valor_total,2); ?></div></b></div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>

<?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?>	
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
<?php
}
?>

	
</tr>
</table>
<br /><br />
INSUMOS
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Bodega </div></td>  
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>      
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">P.Compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">PVP</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha</div></td>
<?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?>
	<td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CORRECION</div></td>
<?php
}
?>	 
    </tr>
	<?php
	$valor_total=0;
	$lista_precuentas="select * from dns_detalleprecuentaprincipal left join dns_centrosalud_ext on dns_detalleprecuentaprincipal.centrob_id=dns_centrosalud_ext.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (2) order by detapre_id asc";
	
	//$lista_precuentas="select * from dns_detalleprecuentaprincipal left join dns_centrosalud on dns_detalleprecuentaprincipal.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_detalleprecuentaprincipal.centrob_id in (".$centro_id.",1,9999,8888)";
	
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
   
$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"]; 
       
   if($rs_lprecuentas->fields["centrob_id"]==55 or $rs_lprecuentas->fields["centrob_id"]==8888 or $rs_lprecuentas->fields["centrob_id"]==9999)
   {
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_detalleprecuentaprincipal'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';   
	?>
    <tr>
      <td height="21" class="css_texto"><div align="center">
      <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigx('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>       
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <?php
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_campospr('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';
	  ?>
	  <td class="css_texto"><div align="center"><div id="cmb_detapre_precioventa<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></div></td>	  
	  <td class="css_texto"><div align="center"><div id="cmb_total<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></div></td>	
	  <td class="css_texto" style="font-size:10px" onclick="ver_asientoc('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')"  ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
	  
	  <?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?><td>
	<input type="submit" name="Submit2" value="Corregir Precio" onclick="corregir_preciox('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')" /></td>
<?php
}
?>
	  
	  
    </tr>
	<?php
	}
	else
	{
	
	?>
    <tr>
      <td height="21" class="css_texto"><div align="center">
      <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigx('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $usuariod; ?></div></td>        
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"]; ?></div></td>
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
	  <td class="css_texto" style="font-size:10px" onclick="ver_asientoc('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')"  ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
	  
	  
	  <?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?><td>
<input type="submit" name="Submit2" value="Corregir Precio" onclick="corregir_preciox('<?php echo $precu_id; ?>','<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')" /></td>
<?php
}
?>	 
	  
    </tr>
	<?php
	
	
	}
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);	
	$rs_lprecuentas->MoveNext();
	  }
  }
?>
<tr>
    <td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td height="21" bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b><div id="totales_gen2"><?php echo round($valor_total,2); ?></div></b></div></td>
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
<?php
if($_SESSION['ces1313777_sessid_inicio']=='2')
{
 ?>	
	<td bgcolor="#CCCCCC" class="css_texto"><div align="center">&nbsp;</div></td>
<?php
}
?>
	
</tr>
</table>

<div id="campo_valorxx"></div>

<div id="campo_valor"></div>

<script type="text/javascript">
<!--

function corregir_preciox(precu_id,detapre_id)
{

if (confirm("Esata seguro en realizar el proceso") == true) {

$("#corrige_precio").load("aplicativos/documental/opciones/panel/precuentaprincipal/corrige_precio.php",{


precu_id:precu_id,
detapre_id:detapre_id

 },function(result){       
       desplegar_asignados();
  });  

$("#corrige_precio").html("Espere un momento...");


}

}


function guardar_campospr(tabla,campo,id,valor,campoidtabla,cantidad,clie_id,precu_id,tipo)
{

$("#campo_valor").load("aplicativos/documental/opciones/panel/precuentaprincipal/guarda_campopr.php",{

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

$("#campo_valor").html("Espere un momento...");



}

function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/precuentaprincipal/guarda_campop.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla

 },function(result){       

  });  

$("#campo_valorxx").html("Espere un momento...");



}



function ver_asientoc(precu_id,detapre_id)
{
   //if($('#doccab_ndocumento').val()!='-documento-')
	 //{
      myWindow3=window.open('pdfasientos/pdfasientoprecuenta_i.php?xml=' + precu_id+'&detapre_id='+detapre_id,'ventana_asientocontable','width=850,height=700,scrollbars=YES');
      myWindow3.focus();
    // }
  // else
   //{
   //alert("Por favor guarde el resgistro para ver el asiento contable");     
  // }
}

//  End -->
</script>
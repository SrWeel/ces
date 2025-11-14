<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$precu_id=$_POST["precu_id"];

$lista_precuentasc="select * from dns_detalleprecuenta where precu_id='".$precu_id."' limit 1"; 
$okvalorc=$DB_gogess->executec($lista_precuentasc); 

$busca_clientec="select * from app_cliente where clie_id='".$okvalorc->fields["clie_id"]."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	  
$conve_idc=$rs_bclientec->fields["conve_id"];
 
$n_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$conve_idc."'";
$rs_conve = $DB_gogess->executec($n_convenio,array());	


?>
<style type="text/css">
<!--
.css_titulo {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:9px;
font-weight: bold}

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:9px;

}

-->
</style>
<center><b><br>
<?php  echo str_pad($precu_id, 10, "0", STR_PAD_LEFT); ?><br>
CONVENIO O SEGURO: <?php echo $rs_conve->fields["conve_nombre"]; ?></b></center>
MEDICAMENTOS
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Tipo </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Bodega </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Usuario </div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	 $valor_total=0;
 $lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=1 order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $clie_id=$rs_lprecuentas->fields["clie_id"];

	  $busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
	  $rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
	  $conve_id=$rs_bcliente->fields["conve_id"];
	  

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



$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"];
 
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
   if($rs_lprecuentas->fields["centro_nombre"])
   {
   
  
?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $usuariod; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	}
	else
	{
	
	 $comulla_simple="'";	
	 $tabla_valordata="";
	 $campo_valor="";	
	 $tabla_valordata="'dns_detalleprecuenta'";
	 $campo_valor="'detapre_id'";
	 $ide_producto='detapre_id';
	?>
	
	<tr>
      <td height="21" class="css_texto"><div align="center">
	  
<?php

	$ncampo_val='detapre_tipo';	

	echo '<select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" >

    <option value="" >--Tipo--</option>';

    $objformulario->fill_cmb('dns_categoriadns','categ_id,categ_nombre',$rs_lprecuentas->fields[$ncampo_val],'',$DB_gogess);

   echo '</select>';	

?></div></td>
	  
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $usuariod; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  
	  <?php
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';
	  ?>
      <td class="css_texto"><div align="center"><div id="cmb_detapre_precioventa<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></div></td>
	  
	  <td class="css_texto"><div align="center"><div id="cmb_total<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></div></td>

      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	
	
	<?php
	}
	
	
	
	
	   $valor_total=$valor_total+($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
    <td height="21" bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	 <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen1"><?php echo $valor_total; ?></div></b></div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>  

<br><br />


INSUMOS
<?php
$valor_total=0;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Tipo </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Bodega </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Usuario </div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	 $valor_total=0;
 $lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=2 order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $clie_id=$rs_lprecuentas->fields["clie_id"];

	  $busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
	  $rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
	  $conve_id=$rs_bcliente->fields["conve_id"];
	  

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



$usuariod='';
$busca_us="select * from app_usuario where usua_id='".$rs_lprecuentas->fields["usua_id"]."'";
$rs_us = $DB_gogess->executec($busca_us,array());
$usuariod=$rs_us->fields["usua_nombre"]." ".$rs_us->fields["usua_apellido"];
 
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
   if($rs_lprecuentas->fields["centro_nombre"])
   {
   
  
?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $usuariod; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	}
	else
	{
	
	 $comulla_simple="'";	
	 $tabla_valordata="";
	 $campo_valor="";	
	 $tabla_valordata="'dns_detalleprecuenta'";
	 $campo_valor="'detapre_id'";
	 $ide_producto='detapre_id';
	?>
	
	<tr>
      <td height="21" class="css_texto"><div align="center">
	  
<?php

	$ncampo_val='detapre_tipo';	

	echo '<select class="form-control" style="width:120px" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'"  onChange="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" >

    <option value="" >--Tipo--</option>';

    $objformulario->fill_cmb('dns_categoriadns','categ_id,categ_nombre',$rs_lprecuentas->fields[$ncampo_val],'',$DB_gogess);

   echo '</select>';	

?></div></td>
	  
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $usuariod; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  
	  <?php
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.','.$rs_lprecuentas->fields["detapre_tipo"].')" />';	
echo '</td>';
	  ?>
      <td class="css_texto"><div align="center"><div id="cmb_detapre_precioventa<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo $rs_lprecuentas->fields["detapre_precioventa"]; ?></div></div></td>
	  
	  <td class="css_texto"><div align="center"><div id="cmb_total<?php echo $rs_lprecuentas->fields[$ide_producto];?>" ><?php echo ($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></div></td>

      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	
	
	<?php
	}
	
	
	
	
	   $valor_total=$valor_total+($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
    <td height="21" bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen2"><?php echo $valor_total; ?></div></b></div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
</table>  

<br>

<script type="text/javascript">
<!--

function asignar_precuenta()
{
   
   if($('#txt_detalle').val()=='')
   {
     alert("Campo DESCRIPCION es obligatorio...");
	 return false;
   
   }
   
   
   $("#asigna_precuenta").load("templateformsweb/maestro_standar_ventas/asigna_p.php",{
    precu_id:$('#precu_idvalor').val(),
	doccab_id:$('#doccab_id').val(),
	txt_detalle:$('#txt_detalle').val(),
	detallado:$('input:checkbox[name=detallado_lista]:checked').val()
  },function(result){  
      
	  ocultar_mostrar3('gridmhdetallefactura_id');
	  grid_extras_10271($('#doccab_id').val(),0,0);
	  
  });  
  $("#asigna_precuenta").html("Espere un momento...");  

}

//-->
</script> 


<?php
}
?>
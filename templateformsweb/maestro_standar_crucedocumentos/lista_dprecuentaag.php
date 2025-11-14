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
$doccab_pgacont=$_POST["doccab_pgacont"];

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

<?php
if($doccab_pgacont==1)
{
   echo '<br><br><center>EL PAGO SE REALIZO CON TARJETA DE CREDITO, SE AUMENTARA AL VALOR EL 10%, EL VALOR AUMENTADO SE REFLEJARA EN LA FACTURA</center>';

}
?>

MEDICAMENTOS
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">No</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	 $valor_total=0;
	 $cuenta_lista=0;
 $lista_precuentas="select detapre_codigop,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,detapre_precio,detapre_precioventa from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=1 group by detapre_codigop,detapre_detalle,detapre_precio,detapre_precioventa order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  

    $cuenta_lista++;
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
?>
    <tr>
      <td class="css_texto"><div align="center"><?php echo $cuenta_lista; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
    </tr>
	<?php
	
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen"><?php echo $valor_total; ?></div></b></div></td>
</tr>
</table>  

<br /><br />

INSUMOS
<?php
$valor_total=0;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">No</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	 $valor_total=0;
	  $cuenta_lista=0;
 $lista_precuentas="select detapre_codigop,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,detapre_precio,detapre_precioventa from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=2  group by detapre_codigop,detapre_detalle,detapre_precio,detapre_precioventa order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
 
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
 $cuenta_lista++;
   
?>
    <tr>
	  <td class="css_texto"><div align="center"><?php echo $cuenta_lista; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
    </tr>
	<?php
	
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen"><?php echo $valor_total; ?></div></b></div></td>
</tr>
</table>  

<br><br />

TARIFARIO
<?php
$valor_total=0;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	 $valor_total=0;
 $lista_precuentas="select detapre_codigop,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,detapre_precio,detapre_precioventa from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=3  group by detapre_codigop,detapre_detalle,detapre_precio,detapre_precioventa order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
 
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
?>
    <tr>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
    </tr>
	<?php
	
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen"><?php echo $valor_total; ?></div></b></div></td>
</tr>
</table> 


<br /><br />

MCGRAW HILL
<?php
$valor_total=0;
$cuenta_lista=0;
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
       <td bgcolor="#A6CED7" class="css_titulo"><div align="center">No</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio de compra</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Precio</div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Total</div></td>
    </tr>
	<?php
	 $valor_total=0;
 $lista_precuentas="select detapre_codigop,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,detapre_precio,detapre_precioventa from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo=4 group by detapre_codigop,detapre_detalle,detapre_precio,detapre_precioventa order by detapre_codigop asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
 $cuenta_lista++;
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
?>
    <tr>
       <td class="css_texto"><div align="center"><?php echo $cuenta_lista; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precio"],2); ?></div></td>
      <td class="css_texto"><div align="center"><?php echo round($rs_lprecuentas->fields["detapre_precioventa"],2); ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2); ?></div></td>
    </tr>
	<?php
	
	   $valor_total=$valor_total+round(($rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"]),2);
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }

$valor_total=round($valor_total, 2);
?>
<tr>
	 <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	 <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen"><?php echo $valor_total; ?></div></b></div></td>
</tr>
</table> 
<br /><br />


<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><center>Precio Costo <br />Insumos y Medicamentos</center></td>
	<td>Detallado</td>
    <td>Asignar a Factura </td>
  </tr>
  <tr>
   <td>
   <div align="center">
   <input name="precio_costo" type="checkbox" id="precio_costo" value="1">
   </div>
   </td>
    <td><div align="center"><input name="txt_detalle" type="hidden" id="txt_detalle" value="" size="50">
    <input name="precu_idvalor" type="hidden" id="precu_idvalor" value="<?php echo $precu_id; ?>">
      <input name="detallado_lista" type="checkbox" id="detallado_lista" value="1">
    </div></td>
    <td><div align="center">
      <input type="button" name="Submit" value="Asignar" onClick="asignar_precuenta()" >
    </div></td>
  </tr>
</table>
<br>

<script type="text/javascript">
<!--

function asignar_precuenta()
{
   
   
   $("#asigna_precuenta").load("templateformsweb/maestro_standar_ventas/asigna_p.php",{
    precu_id:$('#precu_idvalor').val(),
	doccab_id:$('#doccab_id').val(),
	txt_detalle:$('#txt_detalle').val(),
	detallado:$('input:checkbox[name=detallado_lista]:checked').val(),
	alcosto:$('input:checkbox[name=precio_costo]:checked').val(),
	doccab_pgacont:'<?php echo $doccab_pgacont ?>'
  },function(result){  
      
	  //ocultar_mostrar3('gridmhdetallefactura_id');
	  grid_extras_9771($('#doccab_id').val(),0,0);	  
	  grid_extras_10271($('#doccab_id').val(),0,0);
	  
  });  
  $("#asigna_precuenta").html("Espere un momento...");  

}

//-->
</script> 


<?php
}
?>
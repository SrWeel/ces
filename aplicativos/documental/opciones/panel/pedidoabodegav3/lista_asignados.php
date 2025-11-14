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
  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Solicita de  </div></td>    
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">AREA  </div></td>      
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Detalle</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Cantidad</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Usuario</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	$valor_total=0;
 $lista_precuentas="select *,dns_preddetalleprecuentav.usua_id as usario_enf from dns_preddetalleprecuentav left join dns_centrosalud_ext on dns_preddetalleprecuentav.centrob_id=dns_centrosalud_ext.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) order by detapre_id asc";
	
	//$lista_precuentas="select * from dns_preddetalleprecuentav left join dns_centrosalud on dns_preddetalleprecuentav.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and dns_preddetalleprecuentav.centrob_id in (".$centro_id.",1,9999,8888)";
	
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  
	  //busca si ya entrego
		
		$busca_entregado="select sum(detapre_cantidad) as cantidad_val from dns_detalleprecuenta where detapreoper_id='".$rs_lprecuentas->fields["detapre_id"]."' and precu_id='".$rs_lprecuentas->fields["precu_id"]."'";
		$rs_okentreg = $DB_gogess->executec($busca_entregado,array());		
		$cantidad_val=$rs_okentreg->fields["cantidad_val"];
		
	  //busca si ya entrego	
	  

  $estado_prec='';
   if($rs_lprecuentas->fields["detapre_tipo"]==1)
   {
     $estado_prec='MEDICAMENTOS';
   
   }
   
   if($rs_lprecuentas->fields["detapre_tipo"]==2)
   {
     $estado_prec='INSUMOS';
   
   }
   
   
   $comulla_simple="'";	
   $tabla_valordata="";
   $campo_valor="";	
   $tabla_valordata="'dns_preddetalleprecuentav'";
   $campo_valor="'detapre_id'";
   $ide_producto='detapre_id';
   
   $usario_enf=$rs_lprecuentas->fields["usario_enf"];
   $n_usuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$usario_enf,$DB_gogess);
   
   $area_id=$rs_lprecuentas->fields["area_id"];
   
   $busca_area="select * from lpin_area where area_id='".$area_id."'";
   $rs_barea= $DB_gogess->executec($busca_area,array());
   $narea_v='';
   $narea_v=$rs_barea->fields["area_nombre"];
   
   
	?>
    <tr>
       <td height="21" class="css_texto"><div align="center">
	   <?php
	   if(!($cantidad_val>0))
	   {
	   ?>
         <input type="button" name="Submit" value="&lt;&lt;--" onClick="borrar_asigx('<?php echo $rs_lprecuentas->fields["detapre_id"]; ?>')">
	  <?php
	    }
	   ?>	 
       </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"].' '.$rs_lprecuentas->fields["detapre_observacion"]; ?></div></td>
	  
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $narea_v; ?></div></td>
      
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  
	  
//$ncampo_val='detapre_observacion';
//echo '<input name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_camposzz('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';
						
	  
	  ?>	  
	  </div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center">
	<?php 
 if(!($cantidad_val>0))
	   {	 
$ncampo_val='detapre_cantidad';
echo '<input name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_camposzz('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.')" />';

}
else
{
echo $rs_lprecuentas->fields["detapre_cantidad"];
}
?>

</div></td>

<!--
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  
	  
      <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precio"]; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo ($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td> -->
	  
	  
	   <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $n_usuario; ?></div></td>
	  <td class="css_texto" style="font-size:10px" ><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
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
    <td bgcolor="#CCCCCC" class="css_texto"><div align="center"><b>&nbsp;</b></div></td>
</tr>
</table>
<div id="campo_valorxx"></div>

<script type="text/javascript">
<!--
function guardar_camposzz(tabla,campo,id,valor,campoidtabla)
{

$("#campo_valorxx").load("aplicativos/documental/opciones/panel/pedidoabodegav3/guarda_campop.php",{

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
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=54444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
//Llamando objetos
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

} 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$precu_id=$_POST["pVar1"];

?>

<style type="text/css">
<!--
.css_titulo {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
font-weight: bold}

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;

}

-->
</style>
<?php
$lista_precuentasc="select * from dns_detalleprecuenta where precu_id='".$precu_id."' limit 1"; 
$okvalorc=$DB_gogess->executec($lista_precuentasc); 

$busca_clientec="select * from app_cliente where clie_id='".$okvalorc->fields["clie_id"]."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	  
$conve_idc=$rs_bclientec->fields["conve_id"];
 
$n_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$conve_idc."'";
$rs_conve = $DB_gogess->executec($n_convenio,array());	

//$lista_totales="select sum(detapre_precioventa*detapre_cantidad) as total_g from dns_detalleprecuenta where precu_id='".$precu_id."'"; 
//$okv_totales=$DB_gogess->executec($lista_totales); 
	  
?>  
  <center>CONVENIO O SEGURO: <?php echo $rs_conve->fields["conve_nombre"]; ?></center>
  <br /> 

  <table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Tipo </div></td>
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Bodega </div></td>
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
 $lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."' order by detapre_fecharegistro asc";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $clie_id=$rs_lprecuentas->fields["clie_id"];
	  //conve_id==7
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


 
 //$pvp_enformula=0;
 //$pvp_enformula=$objFormulascontable->formulas_pvp($conve_id,$rs_lprecuentas->fields["detapre_precio"],$DB_gogess);
   
   if($rs_lprecuentas->fields["centro_nombre"])
   {
   
  
?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
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
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["centro_nombre"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  
	  <?php
echo '<td  nowrap="nowrap" >';
$ncampo_val='detapre_precio';	
echo '<input class="form-control" name="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" type="text" id="cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].'" value="'.$rs_lprecuentas->fields[$ncampo_val].'" size="20" onblur="guardar_campos('.$tabla_valordata.','.$comulla_simple.$ncampo_val.$comulla_simple.','.$rs_lprecuentas->fields[$ide_producto].',$('.$comulla_simple.'#cmb_'.$ncampo_val.$rs_lprecuentas->fields[$ide_producto].$comulla_simple.').val(),'.$comulla_simple.$ide_producto.$comulla_simple.','.$comulla_simple.$rs_lprecuentas->fields["detapre_cantidad"].$comulla_simple.','.$comulla_simple.$clie_id.$comulla_simple.','.$comulla_simple.$precu_id.$comulla_simple.')" />';	
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

?>

<tr>
    <td height="21" bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
    <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	<td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	  <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><div id="totales_gen"><?php echo $valor_total; ?></div></b></div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
	  
  </table>


<div id="procesando_detalle"></div>

<script type="text/javascript">
<!--


function buscar_proforma()
{


   $("#buscar_proforma").load("aplicativos/documental/opciones/panel/precuentagenerada/asignar_proforma.php",{
      asigna_proforma:$('#asigna_proforma').val()

  },function(result){  

     
  });  
  $("#buscar_proforma").html("Espere un momento");  


}


function procesar_factura()
{


   $("#procesando_detalle").load("aplicativos/documental/opciones/panel/precuenta/facturar.php",{
      precu_id:'<?php echo $precu_id; ?>'

  },function(result){  

     
  });  
  $("#procesando_detalle").html("Espere un momento");  


}


function ver_pdf(idfactura,opcion)
{
    
	    
	if(opcion=='01')
	{
			 window.location.href='pdfrecibos/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion=='04')
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='05')
	{
			 window.location.href='pdfdebito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion=='06')
	{
			 window.location.href='pdfguia/pdf.php?xml=' + idfactura;
	}
	 if(opcion=='07')
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}


//  End -->
</script>

<SCRIPT LANGUAGE=javascript>
<!--

function guardar_campos(tabla,campo,id,valor,campoidtabla,cantidad,clie_id,precu_id)
{

$("#campo_valor").load("aplicativos/documental/opciones/panel/precuenta/guarda_campo.php",{

tabla:tabla,
campo:campo,
id:id,
valor:valor,
campoidtabla:campoidtabla,
cantidad:cantidad,
clie_id:clie_id,
precu_id:precu_id

 },function(result){       

  });  

$("#campo_valor").html("Espere un momento...");



}


//-->
</SCRIPT>

<div id="campo_valor"></div>



<?php
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>



  
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=144000;
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
  <p>&nbsp;</p>
  
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>Asigne Proforma </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input name="asigna_proforma" type="text" id="asigna_proforma" class="form-control" /></td>
      <td><input type="button" name="Submit" value="Buscar" onclick="buscar_proforma()" /></td>
    </tr>
  </table>
  <br />
  
  <div id="buscar_proforma"></div>
  
  <br /><br />
  
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
	  <td bgcolor="#A6CED7" class="css_titulo"><div align="center">C&oacute;digo Seguro</div></td>
      <td bgcolor="#A6CED7" class="css_titulo"><div align="center">Fecha Registro </div></td>
    </tr>
	<?php
	 $valor_total=0;
	$lista_precuentas="select * from dns_detalleprecuenta left join api_bodega on dns_detalleprecuenta.bodega_id=api_bodega.bode_id  where precu_id='".$precu_id."'";
	$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $clie_id=$rs_lprecuentas->fields["clie_id"];
	  //conve_id==7
	  $conve_id=$rs_lprecuentas->fields["conve_id"];

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


$pvp_valor=0;
if($conve_id==7)
{
    $pvp_valor=$rs_lprecuentas->fields["detapre_precio"]*1.1;
}
else
{
	if($rs_lprecuentas->fields["detapre_precio"]<20)
	{	
	  $pvp_valor=$rs_lprecuentas->fields["detapre_precio"]*1.5;
	}
	else
	{
	  $pvp_valor=$rs_lprecuentas->fields["detapre_precio"]*1.4;	
	}
}
   
?>
    <tr>
      <td height="21" class="css_texto"><div align="center"><?php echo $estado_prec; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["nombre"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_codigop"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_detalle"];  ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_cantidad"]; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_precio"]; ?></div></td>
      <td class="css_texto"><div align="center"><?php echo $pvp_valor; ?></div></td>
	  <td class="css_texto"><div align="center"><?php echo ($pvp_valor*$rs_lprecuentas->fields["detapre_cantidad"]); ?></div></td>
	  <td class="css_texto"><div align="center">
	    <input type="text" name="textfield" />
	  </div></td>
      <td class="css_texto"><div align="center"><?php echo $rs_lprecuentas->fields["detapre_fecharegistro"]; ?></div></td>
    </tr>
	<?php
	   $valor_total=$valor_total+($rs_lprecuentas->fields["detapre_precio"]*$rs_lprecuentas->fields["detapre_cantidad"]);
	
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
      <td bgcolor="#A6CED7" class="css_texto"><div align="center"><b><?php echo $valor_total; ?></b></div></td>
	   <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
      <td bgcolor="#A6CED7" class="css_texto"><div align="center">&nbsp;</div></td>
</tr>
	  
  </table>

<input type="button" name="Button" value="PROCESAR" onclick="procesar_factura()" />

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


   $("#procesando_detalle").load("aplicativos/documental/opciones/panel/precuentaajuste/facturar.php",{
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



<?php
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>



  
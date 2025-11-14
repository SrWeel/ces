<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
include('codebarra/Barcode.php');

$objformulario= new  ValidacionesFormulario();
$compra_id=$_POST["compra_id"];

$lista_data="select * from comprobante_retencion_cab where compra_id='".$compra_id."'";

?>
<table border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td><strong></strong></td>
	<td><strong>XML</strong></td>
    <td><strong>PDF</strong></td>
    <td><strong>N. RETENCION </strong></td>
    <td><strong>N. FACTURA </strong></td>
    <td><strong>CLIENTE</strong></td>
    <td><strong>FECHA</strong></td>
    <td><strong>ESTADO</strong></td>
	<td></td>
  </tr>
  <?php
  $rs_lx = $DB_gogess->executec($lista_data,array());
			 if($rs_lx)
			 {
				while (!$rs_lx->EOF) { 
		
		$compretcab_id=$rs_lx->fields["compretcab_id"];	
	
	$bg_anulado='';	
	if($rs_lx->fields["compretcab_anulado"]==1)
	{
	  $bg_anulado=' bgcolor="#FDD7E4" ';
	}
?>
<tr <?php echo $bg_anulado; ?> >
   
	<td>
	<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td onclick="abrir_standar('templateformsweb/maestro_standar_compras/xmlpdf/datos_anular.php','Anular','divBody_anular','divDialog_anular',400,290,'<?php echo $compretcab_id; ?>',0,0,0,0,0,0)" style="cursor:pointer"><center><img src="images/anular.png"></center></td></tr></tbody></table>
	
	</td>
	<td>
	<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_urldocumento('archivosxml/carga/verxmlfac.php?','tipo=07&xml=<?php echo $compretcab_id; ?>')" style=cursor:pointer ><center><img src="images/pdf_img.png"  /></center></td></tr></table>
	
	</td>
    <td>
	
	<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="archivo_pdf('<?php echo $compretcab_id; ?>','07')" style=cursor:pointer ><center><img src="images/pdf_icono.png"  /></center></td></tr></table>
	
	</td>
    <td><?php echo $rs_lx->fields["compretcab_nretencion"]; ?></td>
    <td><?php echo $rs_lx->fields["compretcab_nfactura"]; ?></td>
    <td><?php echo $rs_lx->fields["compretcab_nombrerazon_cliente"]; ?></td>
    <td><?php echo $rs_lx->fields["compretcab_fechaemision_cliente"]; ?></td>
    <td><?php 
	
	if($rs_lx->fields["compretcab_anulado"]==1)
	{
	  echo "ANULADO";
	}
	echo $rs_lx->fields["compretcab_estadosri"];
	
	 ?></td>
	<td><div onClick="verpanel_srirent('<?php echo $rs_lx->fields["compretcab_id"]; ?>')" style="cursor:pointer" ><img src="images/sri_panel.png" width="60px" ></div></td>
	
  </tr>

<?php
				
				$rs_lx->MoveNext();
				}
			 }	
  ?>
  
</table>
<div id="divBody_retinsumo" ></div>

<div id="divBody_anular"></div>

<script type="text/javascript">
<!--

function verpanel_srirent(compretcab_id)
{
abrir_standar("templateformsweb/maestro_standar_compras/sri.php","SRI","divBody_retinsumo","divDialog_retinsumo",450,280,compretcab_id,0,0,0,0,0,0);
}

//=====================================

function firma_directaret(compretcab_id)
{
//=============================================
$("#area_retsri").load("sdk/firma_ret.php",{
   compretcab_id:compretcab_id
 },function(result){       	 

  });  
$("#area_retsri").html("Espere un momento...");
//================================================
}


//=====================================

function enviar_sriret(compretcab_id)
{
    
$("#area_retsri").load("sdk/envio_sriret.php",{
     compretcab_id:compretcab_id
 },function(result){
  });  

$("#area_retsri").html("Espere un momento...");

}

//=====================================

function obtener_sriret(compretcab_id)
{

$("#area_retsri").load("sdk/autoriza_sriret.php",{
     compretcab_id:compretcab_id
 },function(result){
  });  

$("#area_retsri").html("Espere un momento...");

}


function ver_urldocumento(link_v,url_envio) {

window.open(link_v+url_envio,"width=600,height=100,scrollbars=NO");

}


function archivo_pdf(idfactura,opcion)
{
   
    if(opcion=='01')
	{
			 window.location.href='pdffacturas/pdf.php?xml=' + idfactura;
	}
	
	if(opcion=='03')
	{
			 window.location.href='pdfliq/pdf.php?xml=' + idfactura;
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

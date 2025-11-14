<?php
//echo $_POST["pVar1"];
//echo $_POST["pVar7"];

include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['ces1313777_sessid_inicio']))
{
$director="../../../../../";
include ("../../../../../cfgclases/clases.php");



}

 $buscaopcion="select tipocmp_codigo from kyradm_automatico where auto_id=".$_POST["pVar7"];
 $resultado_opcion = $DB_gogess->Execute($buscaopcion);
?>
<script type="text/javascript">
<!--
function envia_sri(idp)
{
	
	 $("#procesa_"+idp).load("aplications/usuario/opciones/extras/automatico/envio_sri.php",{
  
    auto_id:'<?php echo $_POST["pVar7"]; ?>',idp_valor:idp,total_lotes:$('#total_lotes').val(),cvlacceso:$('#cvlacceso_'+idp).val(),archivobase:'<?php echo $_POST["pVar1"] ?>',archivov:$('#archivov_'+idp).val(),ndoc:$('#ndoc_'+idp).val(),naut:$('#naut_'+idp).val()
  
  
  
  },function(result){  
  
  eval(result);
  if(result_siguiente!='x')
  {
	  $("#procesa_"+idp).html(result_acceso + " " + result_sriacceso);
	  
	  $("#naut_"+idp).val(result_seactualizo);
	  
	  envia_sri(result_siguiente);
	  
	  
  }
  else
  {
	  $("#procesa_"+idp).html(result_acceso + " " + result_sriacceso);
	  
	  $("#naut_"+idp).val(result_seactualizo);
	  verifica_sritotal();
	  //$("#procesa_"+idp).html($('#cvlacceso_'+idp).val());
	  
  }
  

  });  
  $("#procesa_"+idp).html("Espere un momento...");
	
	
}

function archivo_pdf(idfactura,opcion)
{
   
    if(opcion==4)
	{
			 window.location.href='pdffacturas/pdf.php?xml=' + idfactura;
	}
			 
     if(opcion==5)
	{
			 window.location.href='pdfcredito/pdf.php?xml=' + idfactura;
	}
	
	 if(opcion==3)
	{
			 window.location.href='pdfsretencion/pdf.php?xml=' + idfactura;
	}

}

function verifica_sritotal()
{
	
  $("#div_actualizartodo").load("aplications/usuario/opciones/extras/automatico/actualizardata.php",{parchivo:'<?php echo $_POST["pVar1"] ?>',opcion:'<?php echo $resultado_opcion->fields["tipocmp_codigo"] ?>'},function(result){  

   grid_automatico($('#auto_id').val());
  });  
  $("#div_actualizartodo").html("<img src='images/barra_carga.gif' width='220' height='40' />");
	
}

//  End -->
</script>


<style type="text/css">
<!--
.css_titulot {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.css_titulop {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	
}



-->
</style>
<?php
//-----------------------
//BUSCA SI LOTE YA ESTA AUTORIZADO

$buscaaut="select listcg_estado from factura_listacargados where listcg_archivo='".$_POST["pVar1"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$resultadoaut = $DB_gogess->Execute($buscaaut);
//echo $resultadoaut->fields["listcg_estado"];
//-----------------------
if($resultadoaut->fields["listcg_estado"]!='AUTORIZADO')
{
?>
<input type="button" name="button2" id="button2" value="Obtener autorización" onclick="envia_sri('1')" />
<?php
}
?>
Email:
<input name="email_extra" type="text" id="email_extra" size="50" />
<div id=div_envioemail ></div>
<table width="600" border="0" cellpadding="3" cellspacing="2">
  <tr >
    <td width="56" bgcolor="#DAE3E9" class="css_titulop" >Comp.</td>
    <td width="53" bgcolor="#DAE3E9" class="css_titulop" >Doc</td>
    <td width="60" bgcolor="#DAE3E9" class="css_titulop" >Num.Doc</td>
	 <td width="32" bgcolor="#DAE3E9" class="css_titulop" >&nbsp;</td>
    <td width="82" bgcolor="#DAE3E9" class="css_titulop" >EMAIL</td>
    <td width="267" bgcolor="#DAE3E9" class="css_titulop" >Proceso</td>
  </tr>
 <?php

 
 

 
  
 
 
 $lotev=0;
 $buscalista_lista="select * from factura_detallista where listcgd_archivobase='".$_POST["pVar1"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];

 $resultadolktr = $DB_gogess->Execute($buscalista_lista);	
	if($resultadolktr)
	{
  
      while (!$resultadolktr->EOF) {
		  $lotev++;
		  
		  
		  
 ?> 
  <tr>
    <td bgcolor="#FFFFFF" class="css_titulot" ><div align="center"><span class="Estilo8"><a href="archivosxml/carga/verxml.php?xml=<?php echo $resultadolktr->fields["listcgd_id"] ?>" target="_blank"><?php echo $resultadolktr->fields["listcgd_archivo"] ?></a></span></div></td>
    
    <td bgcolor="#FFFFFF" class="css_titulot" style="cursor:pointer" onclick="abrir_standar('aplications/usuario/opciones/extras/carga/verdocs.php','Documentos','divBody_verdoc','divDialog_verdoc',700,500,'<?php echo $resultadolktr->fields["listcgd_id"] ?>',0,0,0,0,0,0)" ><img src="images/opciones/documentos.png" width="20" height="20" /></td>
    <td bgcolor="#FFFFFF" class="css_titulot" ><?php  echo $resultadolktr->fields["listcgd_numdoc"] ?>
    <input name="cvlacceso_<?php echo $lotev ?>" type="hidden" id="cvlacceso_<?php echo $lotev ?>" value="<?php  echo $resultadolktr->fields["listcgd_claveacceso"] ?>">
    <input name="archivobase_<?php echo $lotev ?>" type="hidden" id="archivobase_<?php echo $lotev ?>" value="<?php echo $_POST["pVar1"] ?>">
    <input name="archivov_<?php echo $lotev ?>" type="hidden" id="archivov_<?php echo $lotev ?>" value="<?php echo $resultadolktr->fields["listcgd_archivo"] ?>">
    
    
    
    </td>
    
    <?php
	
	
	if($resultado_opcion->fields["tipocmp_codigo"]=='07')
	{



$numfactbusca=str_replace(",","",trim($resultadolktr->fields["listcgd_documentos"]));
$buscaarchivoc="select count(*) as tvalor from comprobante_retencion_cab where compretcab_nretencion='".$numfactbusca."' and compretcab_estadosri='AUTORIZADO' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];


$buscaarchivocid="select * from comprobante_retencion_cab where compretcab_nretencion='".$numfactbusca."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$rs_buscafacid = $DB_gogess->Execute($buscaarchivocid);

$buscapdf="archivo_pdf('".$rs_buscafacid->fields["compretcab_id"]."',3)";

 $linkemail= 'onclick=envio_emailcli("'.$rs_buscafacid->fields["compretcab_id"].'") style=cursor:pointer';



	}
	
//TEMAX FACTURA
	if($resultado_opcion->fields["tipocmp_codigo"]=='01')
	{
	
	
	//$numfactbusca=str_replace(",","",trim($resultadolktr->fields["listcgd_documentos"]));
$buscaarchivoc="select count(*) as tvalor from comprobante_fac_cabecera where comcab_clavedeaccesos='".$resultadolktr->fields["listcgd_claveacceso"]."' and comcab_estadosri='AUTORIZADO' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];


$buscaarchivocid="select * from comprobante_fac_cabecera where comcab_clavedeaccesos='".$resultadolktr->fields["listcgd_claveacceso"]."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$rs_buscafacid = $DB_gogess->Execute($buscaarchivocid);

$buscapdf="archivo_pdf('".$rs_buscafacid->fields["comcab_id"]."',4)";

 $linkemail= 'onclick=envio_emailcli("'.$rs_buscafacid->fields["comcab_id"].'") style=cursor:pointer';
 

	}
  //TEMAX FACTURA

 if($resultado_opcion->fields["tipocmp_codigo"]=='04' or $resultado_opcion->fields["tipocmp_codigo"]=='05')
	{
		$numfactbusca=str_replace(",","",trim($resultadolktr->fields["listcgd_documentos"]));
$buscaarchivoc="select count(*) as tvalor from comprobante_credito_cab where comcabcre_ncredito='".$numfactbusca."' and comcabcre_estadosri='AUTORIZADO' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];


$buscaarchivocid="select * from comprobante_credito_cab where comcabcre_ncredito='".$numfactbusca."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$rs_buscafacid = $DB_gogess->Execute($buscaarchivocid);

$buscapdf="archivo_pdf('".$rs_buscafacid->fields["comcabcre_id"]."',5)";

 $linkemail= 'onclick=envio_emailcli("'.$rs_buscafacid->fields["comcabcre_id"].'") style=cursor:pointer';
	
	
	}


	if($resultado_opcion->fields["tipocmp_codigo"]=='06')
	{
		$numfactbusca=str_replace(",","",trim($resultadolktr->fields["listcgd_documentos"]));
$buscaarchivoc="select count(*) as tvalor from comprobante_guia_cabecera where compguiacab_nguia='".$numfactbusca."' and compguiacab_estadosri='AUTORIZADO' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];


$buscaarchivocid="select * from comprobante_credito_cab where compguiacab_nguia='".$numfactbusca."'  and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
$rs_buscafacid = $DB_gogess->Execute($buscaarchivocid);

$buscapdf="archivo_pdf('".$rs_buscafacid->fields["compguiacab_id"]."',5)";

 $linkemail= 'onclick=envio_emailcli("'.$rs_buscafacid->fields["compguiacab_id"].'") style=cursor:pointer';
	
	
	}
	
$rs_buscaidc = $DB_gogess->Execute($buscaarchivoc); 

	
	?>
    
    
   <td bgcolor="#FFFFFF" class="css_titulot" onclick="<?php echo $buscapdf ?>" style="cursor:pointer" ><img src="images/pdf_icono.png"  /></td>
    <td bgcolor="#FFFFFF" class="css_titulot" <?php echo $linkemail ?> >EMAIL</td> 
    <td bgcolor="#FFFFFF" class="css_titulot"><div id="procesa_<?php echo $lotev ?>" ><?php  echo 'Autorizados:'.$rs_buscaidc->fields["tvalor"]." ".$resultadolktr->fields["listcgd_motivo"]; ?></div>
    <input name="ndoc_<?php echo $lotev ?>" type="hidden" id="ndoc_<?php echo $lotev ?>" value="<?php echo $resultadolktr->fields["listcgd_numdoc"] ?>">
    <input name="naut_<?php echo $lotev ?>" type="hidden" id="naut_<?php echo $lotev ?>" value="<?php echo $resultadolktr->fields["listcgd_autorizados"] ?>">
    
    </td>
  </tr>
  
 <?php
  
	  
	  $resultadolktr->MoveNext();
	  
	  }
	  
	}
 ?> 
 <tr>
    <td colspan="3" bgcolor="#FFFFFF" class="css_titulot" ><input name="total_lotes" type="hidden" id="total_lotes" value="<?php  echo $lotev ?>"></td>
  </tr>
</table>
<div id=divBody_verdoc ></div>
<DIV ID=div_actualizartodo ></DIV>
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



 $buscaopcion="select tipocmp_codigo from kyradm_automatico where auto_id=".$_POST["auto_id"];
 
 $resultado_opcion = $DB_gogess->Execute($buscaopcion);
 
 if($resultado_opcion->fields["tipocmp_codigo"]=='01')
 {
 
  $buscalista_lista="select * from comprobante_fac_cabecera where comcab_estadosri='".$_POST["cd_aut"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa']." order by comcab_nfactura desc";
  
  $ndocumento="comcab_nfactura";
  $estadosri="comcab_estadosri";
  $idtabla="comcab_id";
  $motivodev="comcab_motivodev";
  $tipodoc="comcab_tipocomprobante";
  $idpublicado="comcab_publicar";
  
  $estadoemail="comcab_enviomail";
  
  $fechaemail="comcab_enviomailfecha";
  
  $nombrecli="comcab_nombrerazon_cliente";
$email_dir="comcab_email_cliente";
$claveacceso="comcab_clavedeaccesos";
 }
 
 
  if($resultado_opcion->fields["tipocmp_codigo"]=='04' or $resultado_opcion->fields["tipocmp_codigo"]=='05')
 {
 
  $buscalista_lista="select * from comprobante_credito_cab where comcabcre_tipocomprobante='".$resultado_opcion->fields["tipocmp_codigo"]."' and comcabcre_estadosri='".$_POST["cd_aut"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
  
  $ndocumento="comcabcre_ncredito";
  $estadosri="comcabcre_estadosri";
  $idtabla="comcabcre_id";
  $motivodev="comcabcre_motivodev";
  $tipodoc="comcabcre_tipocomprobante";
   $idpublicado="comcabcre_publicar";
   $estadoemail="comcabcre_enviomail";
  $fechaemail="comcabcre_enviomailfecha";
  $nombrecli="comcabcre_nombrerazon_cliente";
  $claveacceso="comcabcre_clavedeaccesos";
  $email_dir="comcabcre_email_cliente";

 }
 
 
 
 if($resultado_opcion->fields["tipocmp_codigo"]=='06')
 {
 
  $buscalista_lista="select * from comprobante_guia_cabecera where  compguiacab_estadosri='".$_POST["cd_aut"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
  
  $ndocumento="compguiacab_nguia";
  $estadosri="compguiacab_estadosri";
  $idtabla="compguiacab_id";
  $motivodev="compguiacab_motivodev";
  $tipodoc="compguiacab_tipocomprobante";
  $idpublicado="compguiacab_publicar";
  $estadoemail="compguiacab_enviomail";
  $fechaemail="compguiacab_enviomailfecha";
  $nombrecli="compguiacab_nombrerazon_cliente";
  $claveacceso="compguiacab_clavedeaccesos";
 }
 
 
  if($resultado_opcion->fields["tipocmp_codigo"]=='07')
 {
 
  $buscalista_lista="select * from comprobante_retencion_cab where  compretcab_estadosri='".$_POST["cd_aut"]."' and emp_id=".$_SESSION['ces1313777_sessid_idempresa'];
  
  $ndocumento="compretcab_nretencion";
  $estadosri="compretcab_estadosri";
  $idtabla="compretcab_id";
  $motivodev="compretcab_motivodev";
  $tipodoc="compretcab_tipocomprobante";
   $idpublicado="compretcab_publicar";
   $estadoemail="compretcab_enviomail";
   $fechaemail="compretcab_enviomailfecha";
   $nombrecli="compretcab_nombrerazon_cliente";
   $claveacceso="compretcab_clavedeaccesos";
 }
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
   
    if(opcion=='01')
	{
			 window.location.href='pdffacturas/pdf.php?xml=' + idfactura;
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

function verifica_sritotal()
{
	
  $("#div_actualizartodo").load("aplications/usuario/opciones/extras/automatico/actualizardata.php",{parchivo:'<?php echo $_POST["pVar1"] ?>',opcion:'<?php echo $resultado_opcion->fields["tipocmp_codigo"] ?>'},function(result){  

   grid_automatico($('#auto_id').val());
  });  
  $("#div_actualizartodo").html("<img src='images/barra_carga.gif' width='220' height='40' />");
	
}

function vaciar_factura(idfac,auto_idval)
{
   $("#div_vaciar").load("aplications/usuario/opciones/extras/automatico/vaciar_factura.php",{idfactura:idfac,auto_id:auto_idval},function(result){  
     
	 lista_sri();
  });  
  $("#div_vaciar").html("<img src='images/barra_carga.gif' width='220' height='40' />");
}




$(document).ready(function() {
    $('#example').DataTable( {
	"oLanguage": {
      "sSearch": " <br>Buscar:"
    },
	  aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
        "scrollX": true
    } );
} );








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
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 990px;
        margin: 0 auto;
    }


-->
</style>

<div id=div_vaciar ></div>
<table id="example" class="display" cellspacing="0" width="100%" >
<thead>
  <tr >
  <th width="68" bgcolor="#DAE3E9" class="css_titulop" ></th>

    <th width="68" bgcolor="#DAE3E9" class="css_titulop" >Num.Doc</th>
	<th width="61" bgcolor="#DAE3E9" class="css_titulop" >ESTADO</th>
	<?php
	if($_SESSION['usua_beliminarx']=='1')
	{
	?>
<th width="301" bgcolor="#DAE3E9" class="css_titulop" >Eliminar</th>
<?php
}
?>
	 <th width="61" bgcolor="#DAE3E9" class="css_titulop" >XML</th>
	  <th width="32" bgcolor="#DAE3E9" class="css_titulop">PDF</th>
	   <?php
	if($_SESSION['usua_bemailx']=='1')
	{
	?>
    <th width="96" bgcolor="#DAE3E9" class="css_titulop" >EMAIL</th>
	<?php
}
?>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >ESTADO</th>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >FECHA EMAIL</th>
	
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >EMAIL</th>
	 
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >CLIENTE</th>
	<th width="96" bgcolor="#DAE3E9" class="css_titulop" >PUBLICADO</th>
    <th width="301" bgcolor="#DAE3E9" class="css_titulop" >Proceso</th>
    
  </tr>
</thead>
<tfoot>
<tr >
  <th width="68" bgcolor="#DAE3E9" class="css_titulop" ></th>
    <th width="68" bgcolor="#DAE3E9" class="css_titulop" >Num.Doc</th>
	<th width="61" bgcolor="#DAE3E9" class="css_titulop" >ESTADO</th>
	<?php
	if($_SESSION['usua_beliminarx']=='1')
	{
	?>
<th width="301" bgcolor="#DAE3E9" class="css_titulop" >Eliminar</th>
<?php
}
?>
	 <th width="61" bgcolor="#DAE3E9" class="css_titulop" >XML</th>
	  <th width="32" bgcolor="#DAE3E9" class="css_titulop">PDF</th>
	   <?php
	if($_SESSION['usua_bemailx']=='1')
	{
	?>
    <th width="96" bgcolor="#DAE3E9" class="css_titulop" >EMAIL</th>
	<?php
}
?>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >ESTADO</th>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >FECHA EMAIL</th>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >EMAIL</th>
	 <th width="96" bgcolor="#DAE3E9" class="css_titulop" >CLIENTE</th>
	<th width="96" bgcolor="#DAE3E9" class="css_titulop" >PUBLICADO</th>
    <th width="301" bgcolor="#DAE3E9" class="css_titulop" >Proceso</th>

    
  </tr>
</tfoot>
 <tbody>
 <?php

 //onclick="envia_sri('1')"
 $lotev=0;


 $resultadolktr = $DB_gogess->Execute($buscalista_lista);	
	if($resultadolktr)
	{
  
      while (!$resultadolktr->EOF) {
		  $lotev++;
		  $cuenta++;
		  
		  
 ?> 
  <tr>
  <td bgcolor="#FFFFFF" class="css_titulot" ><?php echo $cuenta; ?></td>
   <td bgcolor="#FFFFFF" class="css_titulot" ><div align="center"><?php  echo $resultadolktr->fields[$ndocumento] ?></div></td>
    
   
    
  
    
    <?php
	$autorizadoval=0;
	if($resultadolktr->fields[$estadosri]=='AUTORIZADO')
	{
	  $autorizadoval=1;
	}
	
 	
	$tipodocbu=$resultadolktr->fields[$tipodoc];


$buscapdf="archivo_pdf('".$resultadolktr->fields[$idtabla]."','".$tipodocbu."')";
$linkemail= "onclick=envio_emailcli('".$resultadolktr->fields[$idtabla]."','".$tipodocbu."') style=cursor:pointer";
$boton_sri="onclick=ver_sri1('aplications/usuario/opciones/extras/automatico/sri.php','SRI','divBody_sri1','divDialog_sri1',700,800,'".$resultadolktr->fields[$claveacceso]."',0,0,0,0,0,0)";
	?>
	
	<td bgcolor="#FFFFFF" class="css_titulot" <?php echo $boton_sri ?>  ><?php echo $resultadolktr->fields[$estadosri] ?></td>
	
	<?php
	if($_SESSION['usua_beliminarx']=='1')
	{
	?>
	<td bgcolor="#FFFFFF" class="css_titulot" onclick="vaciar_factura('<?php echo $resultadolktr->fields[$idtabla] ?>','<?php echo $_POST["auto_id"] ?>')" style="cursor:pointer" >Eliminar</td>
		<?php
}
?>
	
    <td bgcolor="#FFFFFF" class="css_titulot" ><div align="center"><span class="Estilo8"><a href="archivosxml/carga/verxmlfac.php?tipo=<?php echo $tipodocbu ?>&xml=<?php echo $resultadolktr->fields[$idtabla] ?>" target="_blank"><img src="images/pdf_img.png"  /></a></span></div></td>
    
   <td bgcolor="#FFFFFF" class="css_titulot" onclick="<?php echo $buscapdf ?>" style="cursor:pointer" ><img src="images/pdf_icono.png"  /></td>
   
    <?php
	if($_SESSION['usua_bemailx']=='1')
	{
	?>
    <td bgcolor="#FFFFFF" class="css_titulot" <?php echo $linkemail ?> ><img src="images/email_img.png"  /></td> 
		<?php
}
?>
	
	<td bgcolor="#FFFFFF" class="css_titulot" ><?php echo $resultadolktr->fields[$estadoemail] ?></td>
	
	<td bgcolor="#FFFFFF" class="css_titulot" ><?php echo $resultadolktr->fields[$fechaemail] ?></td>
<td bgcolor="#FFFFFF" class="css_titulot" ><?php echo $resultadolktr->fields[$email_dir] ?></td>

	<td bgcolor="#FFFFFF" class="css_titulot" ><?php echo $resultadolktr->fields[$nombrecli] ?></td>
	
	<td bgcolor="#FFFFFF" class="css_titulot"  >
	<?php
	if($resultadolktr->fields[$idpublicado]=='1')
	{
	echo 'SI';
	}
	
	?>
	</td> 
    <td bgcolor="#FFFFFF" class="css_titulot"><div id="procesa_<?php echo $lotev ?>" ><?php  echo 'Autorizados:'.$autorizadoval." ".$resultadolktr->fields[$motivodev]; ?></div>
    <input name="ndoc_<?php echo $lotev ?>" type="hidden" id="ndoc_<?php echo $lotev ?>" value="<?php echo $resultadolktr->fields["listcgd_numdoc"] ?>">
    <input name="naut_<?php echo $lotev ?>" type="hidden" id="naut_<?php echo $lotev ?>" value="<?php echo $resultadolktr->fields["listcgd_autorizados"] ?>">    </td>
    
  </tr>
  
 <?php
  
	  
	  $resultadolktr->MoveNext();
	  
	  }
	  
	}
 ?> 
 

 </tbody>
</table>
<input name="total_lotes" type="hidden" id="total_lotes" value="<?php  echo $lotev ?>">
<div id=divBody_verdoc ></div>
<DIV ID=div_actualizartodo ></DIV>


<?php
}
else
{
	echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000">La sessi&oacute;n a caducado precione F5 para continuar...</div>';
	}	
?>

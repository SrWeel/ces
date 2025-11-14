<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='xml')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}

 $director="../";
 include("../cfgclases/clases.php");

?>
<link type="text/css" href="../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../js/ui.mask.js"></script>
<script language="javascript" type="text/javascript" src="../js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/additional-methods.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>
<script type="text/javascript" src="../js/jquery.printPage.js"></script>

<script type="text/javascript" src="../js/jquery.formatCurrency.js"></script>
<script src="../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="../js/jquery.fixheadertable.js"></script>
<style type="text/css">
<!--
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<SCRIPT LANGUAGE=javascript>
<!--

function vaciar_factura(idfac,auto_idval)
{
    if (confirm("Esta seguro que desea eliminar el registro?"))
	 { 
   $("#div_vaciar").load("../aplications/usuario/opciones/extras/automatico/vaciar_facturad.php",{idfactura:idfac,auto_id:auto_idval},function(result){  
     
	   location.reload();
  });  
  $("#div_vaciar").html("<img src='../images/barra_carga.gif' width='220' height='40' />");
  }
}

//-->
</SCRIPT>
<div id="div_vaciar" ></div>
<table width="990" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#D6E0EB" ><span class="Estilo5">No Retenci&oacute;n </span></td>
    <td bgcolor="#D6E0EB"><span class="Estilo5">Cliente</span></td>
	<td bgcolor="#D6E0EB"><span class="Estilo5">Estado SRI</span></td>
	<td bgcolor="#D6E0EB"><span class="Estilo5">Autorizaci&oacute;n</span></td>
	<td bgcolor="#D6E0EB"><span class="Estilo5">Borrar</span></td>
    <td bgcolor="#D6E0EB"><span class="Estilo5">pdf</span></td>
  </tr>
  <?php
  
   if(@$_POST["n_fac"])
   {
   
    $datos_fac="select * from comprobante_retencion_cab where compretcab_nretencion like '%".$_POST["n_fac"]."%' order by compretcab_nretencion asc";
   }	
   else
   {
    $datos_fac="select * from comprobante_retencion_cab order by compretcab_nretencion desc";
   
   }
   
						   $rs_fac = $DB_gogess->Execute($datos_fac);
						   if($rs_fac)
						   {
								while (!$rs_fac->EOF) {
  
  ?>
  <tr>
    <td bgcolor="#E3EDF2" nowrap="nowrap" ><?php echo $rs_fac->fields["compretcab_nretencion"]; ?></td>
    <td bgcolor="#E3EDF2"><?php echo utf8_encode($rs_fac->fields["compretcab_nombrerazon_cliente"]); ?></td>
	<td bgcolor="#E3EDF2"><?php echo $rs_fac->fields["compretcab_estadosri"]; ?></td>
	<td bgcolor="#E3EDF2"><?php echo $rs_fac->fields["compretcab_nautorizacion"]; ?></td>
	<?php
	if($rs_fac->fields["compretcab_estadosri"]!='AUTORIZADO')
	{
	?>
	 <td bgcolor="#E3EDF2" onclick="vaciar_factura('<?php echo $rs_fac->fields["compretcab_id"]; ?>',2)" style="cursor:pointer"  >Borrar</td>
	 <?php
	 }
	 else
	 {
	 ?>
	  <td bgcolor="#E3EDF2"   ></td>
	 <?php
	 }
	 ?>
    <td bgcolor="#E3EDF2"><a href="pdfsn.php?xml=<?php echo $rs_fac->fields["compretcab_id"]; ?>" target="_blank">PDF</a></td>
  </tr>
  <?php                            
                                 $rs_fac->MoveNext(); 
                                   }
							}	   
  
  ?>
  
</table>
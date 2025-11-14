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
<style type="text/css">
<!--
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#D6E0EB"><span class="Estilo5">No Retenci&oacute;n </span></td>
    <td bgcolor="#D6E0EB"><span class="Estilo5">Cliente</span></td>
	<td bgcolor="#D6E0EB"><span class="Estilo5">Estado SRI</span></td>
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
    <td bgcolor="#E3EDF2"><?php echo $rs_fac->fields["compretcab_nretencion"]; ?></td>
    <td bgcolor="#E3EDF2"><?php echo $rs_fac->fields["compretcab_nombrerazon_cliente"]; ?></td>
	<td bgcolor="#E3EDF2"><?php echo $rs_fac->fields["compretcab_estadosri"]; ?></td>
    <td bgcolor="#E3EDF2"><a href="pdfsn.php?xml=<?php echo $rs_fac->fields["compretcab_id"]; ?>" target="_blank">PDF</a></td>
  </tr>
  <?php                            
                                 $rs_fac->MoveNext(); 
                                   }
							}	   
  
  ?>
  
</table>
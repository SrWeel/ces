<style type="text/css">
<!--
.style5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.style8 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>

<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$valor_busca=$_POST["cedula_valor"];
$cuadro_valor=array();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$anio_ac=date("Y");

$lista_cert="select * from dns_certificadogenerado where clie_ci='".$valor_busca."' and year(certifg_fecharegistro)='".$anio_ac."' order by certifg_id desc";
$rs_listacert = $DB_gogess->executec($lista_cert,array());
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="style5">ID</span></td>
	<td><span class="style5">CEDULA PACIENTE </span></td>
    <td><span class="style5">TIPO CERTIFICADO </span></td>
	<td><span class="style5">FECHA REGISTRO </span></td>
    <td><span class="style5">DESCARGAR</span></td>
  </tr>
<?php
  if($rs_listacert)
	{
			while (!$rs_listacert->EOF) {
			
			
			
			$tipo_cert="select 	certif_titulo from dns_certificados where certif_id='".$rs_listacert->fields["certif_id"]."'";
            $rs_tipoacert = $DB_gogess->executec($tipo_cert,array());
			
?>  
  <tr>
    <td><span class="style8"><?php echo $rs_listacert->fields["certifg_id"]; ?></span></td>
	<td><span class="style8"><?php echo $rs_listacert->fields["clie_ci"]; ?></span></td>
    <td><span class="style8"><?php echo utf8_encode($rs_tipoacert->fields["certif_titulo"]); ?></span></td>
	<td><span class="style8"><?php echo $rs_listacert->fields["certifg_fecharegistro"] ?></span></td>
    <td onClick="imp_cert_anterior('<?php echo $rs_listacert->fields["certifg_id"]; ?>')" style="cursor:pointer"><span class="style8">IMPRIMIR</span></td>
  </tr>
<?php
              $rs_listacert->MoveNext();
			}	
	}

?>  
</table>
<?php

}

?>


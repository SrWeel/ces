<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

include("../lib.php");

$asigna_proforma=$_POST["asigna_proforma"];

$vera_datospagom="select * from beko_recibocabecera where doccab_ndocumento='".$asigna_proforma."'";
$rs_sihaydatapagom = $DB_gogess->executec($vera_datospagom,array());

$datos_desppagom='<table width="500" border="1" cellpadding="3" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><strong>Tipo ID:</strong></td>
    <td bgcolor="#FFFFFF" class="css_txtpost" >-tipoident_codigo-</td>
  </tr> 
  
  <tr>
    <td bgcolor="#FFFFFF"><strong>Ruc Cliente:</strong></td>
    <td bgcolor="#FFFFFF" class="css_txtpost" >-doccab_rucci_cliente-</td>
  </tr> 
  <tr>
    <td bgcolor="#FFFFFF"><strong>Nombre y Apellido:</strong></td>
    <td bgcolor="#FFFFFF" class="css_txtpost" >-doccab_nombrerazon_cliente- -doccab_apellidorazon_cliente-</td>
  </tr> 
  
  <tr>
    <td bgcolor="#FFFFFF"><strong>No Proforma:</strong></td>
    <td bgcolor="#FFFFFF" class="css_txtpost" >-doccab_ndocumento-</td>
  </tr> 
  
   <tr>
    <td bgcolor="#FFFFFF"><strong>Email:</strong></td>
    <td bgcolor="#FFFFFF" class="css_txtpost" >-doccab_email_cliente-</td>
  </tr> 

     
</table>
<br>




';

$doccab_id=$rs_sihaydatapagom->fields["doccab_id"];
$comilla="'";

echo '<div id="div_pdf" class="col-sm-1">
	<div onclick="ver_pdf('.$comilla.$doccab_id.$comilla.','.$comilla."01".$comilla.')" style="cursor:pointer"><img src="images/pdf.png"></div>
  </div>';


echo despliega_data('beko_recibocabecera',$rs_sihaydatapagom,$datos_desppagom,$objformulario,$DB_gogess);


}
?>
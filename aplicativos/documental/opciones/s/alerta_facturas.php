<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
 //$_POST["ptabla"];
 //$_POST["pcampo"];
// $_POST["pvalor"];
$anioac=0;
$anioac=$_POST["anioactual"];

?>
<table width="318" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="257">FACTURAS AUTORIZADAS:</td>
    <td width="45"><?php
	$autorizadas="select count(*) as totalaut from beko_documentocabecera where tipocmp_codigo='01' and doccab_anulado=0 and doccab_estadosri='AUTORIZADO' and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?></td>
  </tr>
  <tr>
    <td>FACTURAS ANULADAS:</td>
    <td><?php
	$autoanul="select count(*) as totalaut from beko_documentocabecera where  tipocmp_codigo='01' and doccab_anulado=1 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autanul= $DB_gogess->executec($autoanul,array());
	echo $rs_autanul->fields["totalaut"];
	?></td>
  </tr>
  <tr>
    <td>FACTURAS PENDIENTES DE AUTORIZACION:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
   <tr>
    <td>FACTURAS RECIBIDAS EN EL SRI:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri ='RECIBIDA' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
   <tr>
    <td>FACTURAS DEVUELTAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='DEVUELTA' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
  <tr>
    <td>FACTURAS NO AUTORIZADAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='NO AUTORIZADO' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
  <tr>
    <td>NOTAS DE CREDITOS AUTORIZADAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='AUTORIZADO' and tipocmp_codigo='04' and  doccab_anulado=0 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  <tr>
    <td>NOTAS DE CREDITOS ANULADAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  tipocmp_codigo='04' and  doccab_anulado=1 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
   <tr>
    <td>NOTAS DE CREDITO PENDIENTES DE AUTORIZACION:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
  <tr>
    <td>NOTAS DE CREDITO  RECIBIDAS EN EL SRI:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='RECIBIDA' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
  <tr>
    <td>NOTAS DE CREDITO DEVUELTAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='DEVUELTA' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
   <tr>
    <td>NOTAS DE CREDITO NO AUTORIZADAS:</td>
    <td><?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='NO AUTORIZADO' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?></td>
  </tr>
  
  
</table>

<?php
}
?>

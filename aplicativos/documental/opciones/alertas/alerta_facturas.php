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
<div style="font-size:9px" >
<table width="300" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td  style="font-size:9px" ><strong>FACTURAS AUTORIZADAS:</strong></td>
    <td  style="font-size:9px" ><strong>
      <?php
	$autorizadas="select count(*) as totalaut from beko_documentocabecera where tipocmp_codigo='01' and doccab_anulado=0 and doccab_estadosri='AUTORIZADO' and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autort= $DB_gogess->executec($autorizadas,array());
	echo $rs_autort->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  <tr>
    <td style="font-size:9px" ><strong>FACTURAS ANULADAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoanul="select count(*) as totalaut from beko_documentocabecera where  tipocmp_codigo='01' and doccab_anulado=1 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autanul= $DB_gogess->executec($autoanul,array());
	echo $rs_autanul->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  <tr bgcolor="#F9FDD9">
    <td style="font-size:9px" ><strong>FACTURAS PENDIENTES DE AUTORIZACION:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr bgcolor="#F9FDD9">
    <td style="font-size:9px" ><strong>FACTURAS RECIBIDAS EN EL SRI:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri ='RECIBIDA' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr bgcolor="#FBDDDD">
    <td style="font-size:9px" ><strong>FACTURAS DEVUELTAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='DEVUELTA' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr bgcolor="#FFA8A8">
    <td style="font-size:9px" ><strong>FACTURAS NO AUTORIZADAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='NO AUTORIZADO' and tipocmp_codigo='01' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr>
    <td style="font-size:9px" ><strong>NOTAS DE CREDITOS AUTORIZADAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='AUTORIZADO' and tipocmp_codigo='04' and  doccab_anulado=0 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  <tr>
    <td style="font-size:9px" ><strong>NOTAS DE CREDITOS ANULADAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  tipocmp_codigo='04' and  doccab_anulado=1 and year(doccab_fechaemision_cliente)='".$anioac."'";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
   <tr bgcolor="#F9FDD9">
    <td style="font-size:9px" ><strong>NOTAS DE CREDITO PENDIENTES DE AUTORIZACION:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr bgcolor="#F9FDD9">
    <td style="font-size:9px" ><strong>NOTAS DE CREDITO  RECIBIDAS EN EL SRI:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='RECIBIDA' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
  <tr bgcolor="#FBDDDD">
    <td style="font-size:9px" ><strong>NOTAS DE CREDITO DEVUELTAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='DEVUELTA' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
  
   <tr bgcolor="#FFA8A8">
    <td style="font-size:9px" ><strong>NOTAS DE CREDITO NO AUTORIZADAS:</strong></td>
    <td style="font-size:9px" ><strong>
      <?php
	$autoapend="select count(*) as totalaut from beko_documentocabecera where  doccab_estadosri='NO AUTORIZADO' and tipocmp_codigo='04' and  doccab_anulado=0";
	$rs_autapend= $DB_gogess->executec($autoapend,array());
	echo $rs_autapend->fields["totalaut"];
	?>
    </strong></td>
  </tr>
</table>
</div>
<?php
}
?>

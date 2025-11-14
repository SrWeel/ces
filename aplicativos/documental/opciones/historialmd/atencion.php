<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
//include("libreport.php");
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;


$busca_seguro="select * from app_usuario left join cesdb_arextension.dns_convenios conved on app_usuario.conve_id=conved.conve_id where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_seg = $DB_gogess->executec($busca_seguro,array());

$conve_id=$rs_seg->fields["conve_id"];
?>
<style type="text/css">
<!--
.css_listaespe {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">HISTORIA MEDICA </span></td>
    <td bgcolor="#DDEAEE" class="css_listaespe">NOMBRE</td>
    <td bgcolor="#DDEAEE" class="css_listaespe">FECHA</td>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">DOCUMENTOS</span></td>
  </tr>
<?php

//if($conve_id>0)
//{
//$busca_atencionactual="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id where conve_id='".$conve_id."' and clie_rucci='".$_POST["clie_rucci"]."'";
//}
//else
//{
$busca_atencionactual="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id where clie_rucci='".$_POST["clie_rucci"]."' or clie_apellido like '%".$_POST["clie_rucci"]."%' or clie_nombre like '%".$_POST["clie_rucci"]."%'";
//}

$rs_tabeval = $DB_gogess->executec($busca_atencionactual,array());

if($rs_tabeval)
{
	  while (!$rs_tabeval->EOF) {	
	  

$linkimprimir="onClick=lista_historial('".$rs_tabeval->fields["atenc_id"]."','".$rs_tabeval->fields["clie_rucci"]."')";
?>  
  <tr>
    <td><?php  echo utf8_encode($rs_tabeval->fields["clie_rucci"]); ?></td>
    <td><?php  echo utf8_encode($rs_tabeval->fields["clie_nombre"]." ".$rs_tabeval->fields["clie_apellido"]); ?></td>
    <td><?php  echo utf8_encode($rs_tabeval->fields["atenc_fecharegistro"]); ?></td>
    <td <?php echo $linkimprimir; ?> style="cursor:pointer" ><img src="images/lupaatencion.png" ></td>
  </tr>
<?php
 $rs_tabeval->MoveNext();	   
     }
}
?>  
</table>

<script type="text/javascript">
<!--
function imprimir_datos(tab_id,clie_id,atenc_id,eteneva_id,mnupan_id)
{

   myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata='+tab_id+'&pVar2='+clie_id+'&pVar4='+atenc_id+'&pVar5='+eteneva_id+'&pVar3='+mnupan_id,'ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();



}
//  End -->
</script>

<?php
}
else
{

echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center" >Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 

}

?>
<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
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


$busca_atencionactual="select * from app_cliente inner join dns_atencion on app_cliente.clie_id=dns_atencion.clie_id where clie_rucci='".$_POST["clie_rucci"]."' and atenc_id='".$_POST["atenc_id"]."'";
$rs_ATENCIOn = $DB_gogess->executec($busca_atencionactual,array());

?>
<style type="text/css">
<!--
.css_listaespe {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">ESPECIALIDAD</span></td>
    <td bgcolor="#DDEAEE"><span class="css_listaespe">DOCUMENTO</span></td>
  </tr>
<?php

$lista_tabeval="select * from gogess_sistable where tab_sysmedico=1";
$rs_tabeval = $DB_gogess->executec($lista_tabeval,array());
if($rs_tabeval)
{
	  while (!$rs_tabeval->EOF) {	
	  
	  //$busca_menuid="select * from gogess_menupanel where tab_id=".$rs_tabeval->fields["tab_id"];
	  
	  $busca_menuid="select * from gogess_menupanel where  tab_id=".$rs_tabeval->fields["tab_id"]." and mnupan_id in (SELECT per_codobj FROM cesdb_arextension.app_usuarioshistorial WHERE per_activo=1 and usua_id=".@$_SESSION['ces1313777_sessid_inicio'].") order by mnupan_orden asc ";
	  
	  $rs_menuid = $DB_gogess->executec($busca_menuid,array());
	  
	  $listaid_array=array();
	  $listaid_fecha=array();
	  $contador_id=0;
	  
	  $busca_cantidadid="select ".$rs_tabeval->fields["tab_campoprimario"]." as idvalor,".$rs_tabeval->fields["tab_fecharegistro"]." as fechareg from ".$rs_tabeval->fields["tab_name"]." where atenc_id='".$rs_ATENCIOn->fields["atenc_id"]."' order by ".$rs_tabeval->fields["tab_campoprimario"]." desc";
	  $rs_bcantidad = $DB_gogess->executec($busca_cantidadid,array());
	  if($rs_bcantidad)
      {
		  while (!$rs_bcantidad->EOF) {	
		  
		  $listaid_array[$contador_id]=$rs_bcantidad->fields["idvalor"];
		  $listaid_fecha[$contador_id]=$rs_bcantidad->fields["fechareg"];
		  $contador_id++;
		  
		  $rs_bcantidad->MoveNext();
		  }
	  }
	  
	  //print_r($listaid_array);
	  
	  //obtiene id
	 	   $lista_id="select ".$rs_tabeval->fields["tab_campoprimario"]." as idvalor from ".$rs_tabeval->fields["tab_name"]." where atenc_id='".$rs_ATENCIOn->fields["atenc_id"]."'";
		   $rs_idvalr = $DB_gogess->executec($lista_id,array());
		   if($rs_idvalr->fields["idvalor"])
			 { 
      $o=0;
	  $eteneva_id=0;
	  
	  $links_data='';
	  $links_data='<table border="0" cellpadding="0" cellspacing="0"><tr>';
	  
	  for($ic=0;$ic<count($listaid_array);$ic++)
	  {
	     if($rs_menuid->fields["mnupan_id"]>0)
		 {
		 
		  $linkimprimir="onClick=imprimir_datos('".$rs_tabeval->fields["tab_id"]."','".$rs_ATENCIOn->fields["clie_id"]."','".$rs_ATENCIOn->fields["atenc_id"]."','".$eteneva_id."','".$rs_menuid->fields["mnupan_id"]."','".$listaid_array[$ic]."');";
		 
          $links_data.='<td '.$linkimprimir.'  style="cursor:pointer"><center><img src="images/pdfdoc.png" ><br>'.$listaid_array[$ic].'<br>'.$listaid_fecha[$ic].'</center></td>';
		 }
		 else
		 {
		  $linkimprimir="onClick=sin_acceso();";
		  $links_data.='<td '.$linkimprimir.'  style="cursor:pointer"><center><img src="images/pdfdocno.png" ><br>'.$listaid_array[$ic].'<br>'.$listaid_fecha[$ic].'</center></td>';
		 }
	  
	  }
	  
	  $links_data.='</tr></table>';
	  
	  
	  }	
else
	{ 
       $o=0;
	   $eteneva_id=0;
$linkimprimir="onClick=imprimir_datos('".$rs_tabeval->fields["tab_id"]."','".$rs_ATENCIOn->fields["clie_id"]."','".$rs_ATENCIOn->fields["atenc_id"]."','".$eteneva_id."','".$rs_menuid->fields["mnupan_id"]."','0');";
       $links_data='';
	   $links_data='<table border="0" cellpadding="0" cellspacing="0"><tr>';
	   $links_data.='<td>&nbsp;</td>';
       $links_data.='</tr></table>';


	}
//echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span> IMPRIMIR </button>';

?>  
  <tr>
    <td><?php  echo utf8_encode($rs_tabeval->fields["tab_title"]); ?></td>
    <td <?php //echo $linkimprimir; ?> style="cursor:pointer" >
	</td>
	<td>
	<?php echo $links_data; ?>
	</td>
	
  </tr>
<?php
 $rs_tabeval->MoveNext();	   
     }
}
?>  
</table>

<script type="text/javascript">
<!--
function sin_acceso()
{
   alert("No tiene acceso a este documento, llame al administrador para solicitar el acceso...");

}

function imprimir_datos(tab_id,clie_id,atenc_id,eteneva_id,mnupan_id,id)
{

   myWindow3=window.open('aplicativos/documental/datos_substandarformunico_print.php?iddata='+tab_id+'&pVar2='+clie_id+'&pVar4='+atenc_id+'&pVar5='+eteneva_id+'&pVar3='+mnupan_id+'&pVar9='+id,'ventana_reporteunico','width=850,height=700,scrollbars=YES');

   myWindow3.focus();



}
//  End -->
</script>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$fechahoy=date("Y-m-d");
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename="."bancopreguntas_".$fechahoy.".xls");
 
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
require_once($director."libreria/dompdf/dompdf_config.inc.php");

$objperfil=new objetosistema_perfil();
if($_SESSION['ces1313777_sessid_inicio'])
{
$saca_datosus="select * from media_usuario inner join media_pais on media_usuario.pais_id=media_pais.pais_id where usua_id=?";
$ok_resultado=$DB_gogess->executec($saca_datosus,array($_SESSION['ces1313777_sessid_inicio']));


?><?php
$variable_imp='
<style type="text/css">
<!--
body,td,th {
	font-size: 11px;
}
.Estilo1 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo6 {
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
}
.Estilo9 {
	font-size: 11px;
	
}
.borde_tabla{
	font-size: 11px;
	color: #000000;
	text-decoration: none;
	border: 1px solid #000000;
}
.titulo_nombre
{
	font-size: 12px;
	color: #000000;
}
.Estilo11 { font-size: 12px; color: #000000; font-weight: bold; }
-->
</style>

<page style="font-size: 11px" footer="page" >';
?>
<?php
$variable_imp.='<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="181"><img src="http://10.1.13.103/Iberoamericana/images/logocumbre.png" width="181" height="166"></td>
    <td width="300"><div align="center"><span class="Estilo1">Herramienta de autoevaluaci&oacute;n de la transparencia, rendici&oacute;n de cuentas e integridad judicial Iberoamericana</span><br>
    </div></td>
  </tr>
</table>

<table width="300" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr bgcolor="#4270BB">
    <td align="center"><span class="Estilo6">VARIABLE (&Aacute;REA)</span></td>
    <td class="Estilo6"><div align="center">REGLA</div></td>
    <td class="Estilo6"><div align="center">INDICADOR</div></td>
  </tr>';
 ?>
 <?php
 //$lista_vr="select * from media_formulario inner join media_categoriaform on media_formulario.categf_id=media_categoriaform.categf_id";
 $lista_vr="select * from media_categoriaform";
 $rs_lvr = $DB_gogess->executec($lista_vr,array());
 if($rs_lvr)
	{
		while (!$rs_lvr->EOF) {

 $variable_imp.='<tr bgcolor="#4270BB">
    <td colspan="3"><div  class="Estilo6">'.$rs_lvr->fields["categf_nombre"].'</div></td>
  </tr>';

  $lista_formulario="select * from media_formulario where categf_id=?";
  $rs_listaform= $DB_gogess->executec($lista_formulario,array($rs_lvr->fields["categf_id"]));
  if($rs_listaform)
	{
	  while (!$rs_listaform->EOF) {
	  //lista preguntas
	  $cuenta_preg="select distinct regl_id from media_preguntas where form_id=?";
	  $rs_cantiprg= $DB_gogess->executec($cuenta_preg,array($rs_listaform->fields["form_id"]));
	  
	  $cant_span=$rs_cantiprg->RecordCount();
	  
	  //lista preguntas
  
       //lista preguntas
	   $idc=1;
	   $lista_dtpreg="select distinct media_preguntas.regl_id,regl_nombre from media_preguntas inner join media_reglas on media_preguntas.regl_id=media_reglas.regl_id where form_id=? order by pregf_id asc";
	   $rs_listapreg= $DB_gogess->executec($lista_dtpreg,array($rs_listaform->fields["form_id"]));
	   if($rs_listapreg)
	   {
	       while (!$rs_listapreg->EOF) {
		   
		   if($idc==1)
		   {
		     //$cant_span=$cant_span+1;
			 $quita_punto='';
			 $quita_punto=explode(".",$rs_listaform->fields["form_nombre"]);
			 $num_regpunt=count($quita_punto);
			 
			 $valor_rowspan='<td rowspan="'.$cant_span.'"  class=borde_tabla bgcolor="#77A0D2" ><div align="center" class="Estilo6">'.strtoupper($quita_punto[$num_regpunt-1]).'</div></td>';
		   }
		   $idc++;
		   
	  
  $variable_imp.='<tr class="Estilo9">'.$valor_rowspan;
  // echo $valor_rowspan; 
  $valor_rowspan='';
 
    $variable_imp.='<td class=borde_tabla ><div>'.$rs_listapreg->fields["regl_nombre"].'</div></td>';
     
	  
	  $variable_imp.='<td class=borde_tabla width="300"><div>';
	  
	  $variable_imp.='';
	  $lista_preguntasd="select * from media_preguntas where form_id=? and regl_id=?";
	  $rs_lista_preg= $DB_gogess->executec($lista_preguntasd,array($rs_listaform->fields["form_id"],$rs_listapreg->fields["regl_id"]));
	  
	  $nfilas=$rs_lista_preg->RecordCount();
	  $tag_hr='';
	  if($nfilas>1)
	  {
	    $tag_hr="<hr>";
	  }
	  
	   if($rs_lista_preg)
	   {
	   $cantidad_t=0;
	   while (!$rs_lista_preg->EOF) {
	       $cantidad_t++;
	       $variable_imp.=''.$rs_lista_preg->fields["pregf_nombre"];
		   
		   if(!($cantidad_t==$nfilas))
		   {
		   
		    $variable_imp.=$tag_hr;
		   }
		
		   
	   
	       $rs_lista_preg->MoveNext();
	   }
	   
	   }
	  $variable_imp.='';
	  
	 $variable_imp.='</div></td></tr>';
  

	        $rs_listapreg->MoveNext();
	      }
		     
		  
	   }
	   //lista preguntas
	   
 
  
         $rs_listaform->MoveNext();
      }
   }
 
               $rs_lvr->MoveNext();
                }
  
   }
  
  
  
  $variable_imp.='<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';


$variable_imp.='</page>';

echo utf8_encode($variable_imp);

/*$dompdf = new DOMPDF();
$dompdf->load_html($variable_imp, 'UTF-8');
$dompdf->render();
$dompdf->stream("resultados.pdf");
*/
}
?>

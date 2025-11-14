<?php
$tiempossss=44600000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{

$codigo_varios='';
$codigo_cuentas='';
$cuadrobm_id=$_POST["cuadrobm_id"];
$busca_codigop="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
$rs_datacodigop = $DB_gogess->executec($busca_codigop,array());

$codigo_producto=$rs_datacodigop->fields["cuadrobm_codigoatc"];

$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";
$sql6="";
$sql7="";

if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" 	doccab_fechaemision_cliente>='".$fecha_i."' and doccab_fechaemision_cliente<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" doccab_fechaemision_cliente>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" doccab_fechaemision_cliente<='".$fecha_f."' and ";  
    }
  }

}  

if($codigo_producto)
{
   $sql4=" 	docdet_codprincipal='".trim($codigo_producto)."' or ";
}  

if($codigo_varios)
{
   $sql5=" docdet_codprincipal='".trim($codigo_varios)."' or ";
}  

if($codigo_cuentas)
{
   $sql6=" docdet_codprincipal='".trim($codigo_cuentas)."' or ";
}  
      
///arma or
$sql_code="";
$concatena_sqlsub="";
$concatena_sqlsub=substr($sql4.$sql5.$sql6,0,-3);
if($concatena_sqlsub)
{
$sql_code=" (".$concatena_sqlsub.") and ";
}	  
	  
if($nombre_p)
{
  
     $sql7=" (docdet_descripcion like '%".$nombre_p."%' or  docdet_codprincipal like '%".$nombre_p."%') and ";

}     


	  

$concatena_sql=$sql1.$sql2.$sql3.$sql_code.$sql7;
$concatena_sql=substr($concatena_sql,0,-4);

$cuenta_fac=0;
$documento.='<center>
Desde: '.$fecha_i.' Hasta: '.$fecha_f.'<br>
<br>';

///programacion reporte

$documento.='
EN FACTURAS
<table border="1" cellpadding="0" cellspacing="0" width="100%" >
  <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">No. FACTURA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">FECHA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">DESCRIPCI&Oacute;N</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO</div></td>      
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE PRODUCTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CANTIDAD</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">TOTAL $</div></td>	 	  
	  ';

$documento.='</tr>';
  
if($concatena_sql)
{  

$lista_doc="select 	beko_documentocabecera.doccab_id,doccab_fechaemision_cliente,docdet_codprincipal,docdet_descripcion,sum(docdet_cantidad) as cantidad,round(sum(docdet_total),2) as total,doccab_ndocumento,doccab_adicional from beko_documentocabecera inner join beko_documentodetalle_factur on beko_documentocabecera.doccab_id=beko_documentodetalle_factur.doccab_id  where doccab_anulado=0 and tipocmp_codigo='01' and ".$concatena_sql." group by beko_documentocabecera.doccab_id,doccab_ndocumento,docdet_codprincipal,docdet_descripcion order by doccab_fechaemision_cliente DESC";

}

//echo $lista_doc;

$contador=0;
$suma_total_g=0;

$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $boton_data='';
	 $contador++;
	 
	 $texto_wrap='';
	 $texto_wrap=wordwrap($rs_data->fields["docdet_descripcion"], 40, "<br />\n",true);	
	 
	 $texto_wrapt='';
	 $texto_wrapt=wordwrap($rs_data->fields["doccab_adicional"], 40, "<br />\n",true);	
	 
	 $boton_bu=" ver_formularioenpantalla('aplicativos/documental/datos_ventas.php','Editar','divBody_ext','".$rs_data->fields["doccab_id"]."','183',0,0,0,0,0); ";
	 
	 
	 $documento.='<tr>';	 
	 $documento.='<td  nowrap="nowrap">'.$contador.'</td>';
	 $documento.='<td  nowrap="nowrap" onclick='.$boton_bu.'  style="cursor:pointer;text-decoration: underline;" bgcolor="#E4F1FA" >'.$rs_data->fields["doccab_ndocumento"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["doccab_fechaemision_cliente"].'</td>';	 
	 $documento.='<td  nowrap="nowrap">'.$texto_wrapt.'</td>';	 
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["docdet_codprincipal"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrap.'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["cantidad"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["total"].'</td>';	 

	 
	 $documento.='</tr>';
	 
	 $suma_total_g=$suma_total_g+$rs_data->fields["total"];


	     $rs_data->MoveNext();	  
	  }
  }	   

$documento.='<tr>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
	<td>'.$suma_total_g.'</td>
';
$documento.='</tr>
</table>';



$documento.='
EN NOTAS DE CREDITO
<table border="1" cellpadding="0" cellspacing="0" width="100%">
  <tr>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center"> </div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">No. FACTURA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">FECHA</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">DESCRIPCI&Oacute;N</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CODIGO</div></td>      
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">NOMBRE PRODUCTO</div></td>
      <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">CANTIDAD</div></td>
	  <td bgcolor="#CCCCCC" class="css_titulo"><div align="center">TOTAL $</div></td>	 	  
	  ';

$documento.='</tr>';
  
if($concatena_sql)
{  

$lista_doc="select 	beko_documentocabecera.doccab_id,doccab_fechaemision_cliente,docdet_codprincipal,docdet_descripcion,sum(docdet_cantidad) as cantidad,round(sum(docdet_total),2) as total,doccab_ndocumento,doccab_adicional from beko_documentocabecera inner join beko_documentodetalle_factur on beko_documentocabecera.doccab_id=beko_documentodetalle_factur.doccab_id  where doccab_anulado=0 and tipocmp_codigo='04' and ".$concatena_sql." group by  beko_documentocabecera.doccab_id,doccab_ndocumento,docdet_codprincipal,docdet_descripcion order by doccab_fechaemision_cliente DESC";

}

//echo $lista_doc;

$contador=0;
$suma_total_g=0;

$rs_data = $DB_gogess->executec($lista_doc,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	 
	 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $boton_data='';
	 $contador++;
	 
	 $texto_wrap='';
	 $texto_wrap=wordwrap($rs_data->fields["docdet_descripcion"], 40, "<br />\n",true);	
	 
	 $texto_wrapt='';
	 $texto_wrapt=wordwrap($rs_data->fields["doccab_adicional"], 40, "<br />\n",true);	
	 
	 $boton_bu=" ver_formularioenpantalla('aplicativos/documental/datos_ventas.php','Editar','divBody_ext','".$rs_data->fields["doccab_id"]."','183',0,0,0,0,0); ";
	 
	 
	 
	 $documento.='<tr>';	 
	 $documento.='<td  nowrap="nowrap">'.$contador.'</td>';
	 $documento.='<td  nowrap="nowrap" onclick='.$boton_bu.'  style="cursor:pointer;text-decoration: underline;" bgcolor="#E4F1FA" >'.$rs_data->fields["doccab_ndocumento"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["doccab_fechaemision_cliente"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrapt.'</td>';	
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["docdet_codprincipal"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$texto_wrap.'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["cantidad"].'</td>';
	 $documento.='<td  nowrap="nowrap">'.$rs_data->fields["total"].'</td>';	 

	 
	 $documento.='</tr>';
	 
	 $suma_total_g=$suma_total_g+$rs_data->fields["total"];


	     $rs_data->MoveNext();	  
	  }
  }	   

$documento.='<tr>
    <td></td>
	<td></td>
    <td></td>
    <td></td>
	<td>'.$suma_total_g.'</td>
';
$documento.='</tr>
</table>';

echo $documento;

}
?>
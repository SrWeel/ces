<?php

header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");



//lpin_productocompra
//lpin_cuentacompra
//dns_activosfijos

$compra_enlace=$_POST["campo_enlace"];

$bloque_registro=0;
$busca_comprax="select * from dns_compras where compra_enlace='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());

$busca_xmlexistentex="select compretcab_estadosri from comprobante_retencion_cab where compretcab_anulado!='1' and compra_id='".$rs_cmpx->fields["compra_id"]."'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex,array());
$xml_sri=$rs_xmlexternox->fields["compretcab_estadosri"];

if($xml_sri=='AUTORIZADO' or $xml_sri=='RECIBIDA')
{
$bloque_registro=1;
}

//compra_fecha

$lista_comp="select * from dns_compras where compra_enlace='".$compra_enlace."'";
$rs_comp = $DB_gogess->executec($lista_comp,array());

$compra_id=$rs_comp->fields["compra_id"];


//IVA
$lista_valor=array();
$lista_valorrenta=array();


$lista_detalles="select sum(prcomp_subtotal) as total,porcei_id  from lpin_productocompra where compra_enlace='".$compra_enlace."' and porcei_id>0 and prcomp_taricodigo=2 group by prcomp_taricodigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
	  
	     $lista_valor[$rs_data->fields["porcei_id"]]["valor"]=$lista_valor[$rs_data->fields["porcei_id"]]["valor"]+$valor_iva;		 
		 $lista_valor[$rs_data->fields["porcei_id"]]["codigo"]=$rs_data->fields["porcei_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


$lista_detalles="select sum(cuecomp_subtotal) as total,porceci_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' and porceci_id>0 and taric_id=1 group by porceci_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porceci_id"]]["valor"]=$lista_valor[$rs_data->fields["porceci_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porceci_id"]]["codigo"]=$rs_data->fields["porceci_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcefi_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' and porcefi_id>0 and tarif_id=1 group by porcefi_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	  
		 
		 $valor_iva=0;
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 
	     $lista_valor[$rs_data->fields["porcefi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcefi_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porcefi_id"]]["codigo"]=$rs_data->fields["porcefi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 


//IVA


//RENTA
$lista_valorrenta=array();

$lista_detalles="select sum(prcomp_subtotal) as total,porcer_id  from lpin_productocompra where compra_enlace='".$compra_enlace."' and porcer_id>0 group by porcer_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valorrenta[$rs_data->fields["porcer_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcer_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcer_id"]]["codigo"]=$rs_data->fields["porcer_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


 $lista_detalles="select sum(cuecomp_subtotal) as total,porcecr_id  from lpin_cuentacompra where compra_enlace='".$compra_enlace."' and porcecr_id>0 group by porcecr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 
	     $lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcecr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcecr_id"]]["codigo"]=$rs_data->fields["porcecr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(acfi_subtotal) as total,porcefr_id  from dns_activosfijos where compra_enlace='".$compra_enlace."' and porcefr_id>0 group by porcefr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
	     $lista_valorrenta[$rs_data->fields["porcefr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcefr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcefr_id"]]["codigo"]=$rs_data->fields["porcefr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
//print_r($lista_valorrenta);

//RENTA

//listar valores renta
//factur_porcentajes
//porce_id,porce_codigo
$genra_listado=array();
$contador=0;

$lista_renta="select * from factur_porcentajes";
$rs_renta = $DB_gogess->executec($lista_renta,array());
if($rs_renta)
 {
	  while (!$rs_renta->EOF) {	
	   
       
	    // $lista_valorrenta[]
		if(count($lista_valor[$rs_renta->fields["porce_id"]])>0)
		{
		$contador++;
		$genra_listado[$contador]["retencion"]=$rs_renta->fields["porce_nombre"];
		$genra_listado[$contador]["tipo"]=$rs_renta->fields["id_impuesto"];
		$genra_listado[$contador]["codigo"]=$rs_renta->fields["porce_codigo"];
		$genra_listado[$contador]["base"]=$lista_valor[$rs_renta->fields["porce_id"]]["valor"];
		$genra_listado[$contador]["porcentaje"]=$rs_renta->fields["porce_valor"];
		$calculov=0;
		$calculov=($lista_valor[$rs_renta->fields["porce_id"]]["valor"]*$rs_renta->fields["porce_valor"])/100;
		$genra_listado[$contador]["valor"]=round($calculov,2);		
		}
		
		
		if(count($lista_valorrenta[$rs_renta->fields["porce_id"]])>0)
		{
		$contador++;
		$genra_listado[$contador]["retencion"]=$rs_renta->fields["porce_nombre"];
		$genra_listado[$contador]["tipo"]=$rs_renta->fields["id_impuesto"];
		$genra_listado[$contador]["codigo"]=$rs_renta->fields["porce_codigo"];
		$genra_listado[$contador]["base"]=$lista_valorrenta[$rs_renta->fields["porce_id"]]["valor"];
		$genra_listado[$contador]["porcentaje"]=$rs_renta->fields["porce_valor"];
		$calculov=0;
		$calculov=($lista_valorrenta[$rs_renta->fields["porce_id"]]["valor"]*$rs_renta->fields["porce_valor"])/100;
		$genra_listado[$contador]["valor"]=round($calculov,2);		
		}
	  
	    $rs_renta->MoveNext();
	  }
  }	


//listar valores iva
//factur_porcentajes
//porce_id,porce_codigo

//print_r($genra_listado);


$codigos_creados='';
for($i=1;$i<=count($genra_listado);$i++)
{
   $codigos_creados.="'".$genra_listado[$i]["codigo"]."',";
}





$busca_retg="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compra_id='".$compra_id."' and compretcab_anulado=0";
$rsvdata_acdata = $DB_gogess->executec($busca_retg,array());

if($rsvdata_acdata->fields["compretcab_id"]!='')
{

echo "Existe una retenci&oacute;n creada para este documento los datos no se actualizar&aacute;n en la retenci&oacute;n, si ya fue autorizada debe anularla y crear una nueva retenci&oacute;n, caso contrario debe dar clic en actualizar retenci&oacute;n";

	if($rsvdata_acdata->fields["compretcab_estadosri"]=='AUTORIZADO')
	{
	    echo "Tiene una retenci&oacute;n autorizada no se actualizar&aacute;n los datos de la retenci&oacute;n";  
	
	}
	else
	{
	
	   $vacia_data="delete from comprobante_retencion_detalle  where compra_enlace='".$compra_enlace."' and porcentaje_id not in (".$codigos_creados."'-')";
       $rsvdata = $DB_gogess->executec($vacia_data,array());
	   
	   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	   
	   
for($i=1;$i<=count($genra_listado);$i++)
{

$compra_fecha=explode("-",$rs_comp->fields["compra_fecha"]);


$compretcab_id=0;
$compretdet_ejerfiscal=$compra_fecha[1]."/".$compra_fecha[0];
$compretdet_baseimponible=$genra_listado[$i]["base"];
$impur_id=$genra_listado[$i]["tipo"];
$porcentaje_id=$genra_listado[$i]["codigo"];
$compretdet_porcentaje=$genra_listado[$i]["porcentaje"];
$compretdet_valorretenido=$genra_listado[$i]["valor"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$compretdet_archivo='';
$compretdet_accesolote='';
$compretdet_adicional1='';
$compretdet_nombreret=$genra_listado[$i]["retencion"];


//busca existe
$busca_exsite="select * from comprobante_retencion_detalle where compra_enlace='".$compra_enlace."' and porcentaje_id ='".$porcentaje_id."'";
$inserta_retencion = $DB_gogess->executec($busca_exsite,array());
//busca existe

if($inserta_retencion->fields["compretdet_id"]>0)
{

$actualiza_data="update comprobante_retencion_detalle set compretdet_ejerfiscal='".$compretdet_ejerfiscal."',compretdet_baseimponible='".$compretdet_baseimponible."',impur_id='".$impur_id."',porcentaje_id='".$porcentaje_id."',compretdet_porcentaje='".$compretdet_porcentaje."',compretdet_valorretenido='".$compretdet_valorretenido."',usua_id='".$usua_id."',compretdet_nombreret='".$compretdet_nombreret."' where compretdet_id='".$inserta_retencion->fields["compretdet_id"]."'";

$inserta_actualiza = $DB_gogess->executec($actualiza_data,array());


}
else
{
$insreta_retenc="INSERT INTO comprobante_retencion_detalle ( compretcab_id, compretdet_ejerfiscal, compretdet_baseimponible, impur_id, porcentaje_id, compretdet_porcentaje, compretdet_valorretenido, usua_id, compretdet_archivo, compretdet_accesolote, compretdet_adicional1, compretdet_nombreret, compra_enlace) VALUES ('".$compretcab_id."','".$compretdet_ejerfiscal."','".$compretdet_baseimponible."','".$impur_id."','".$porcentaje_id."','".$compretdet_porcentaje."','".$compretdet_valorretenido."','".$usua_id."','".$compretdet_archivo."','".$compretdet_accesolote."','".$compretdet_adicional1."','".$compretdet_nombreret."','".$compra_enlace."');";

$inserta_data = $DB_gogess->executec($insreta_retenc,array());
}



}
	   
	   
	
	   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	   
	}

}
else
{




$vacia_data="delete from comprobante_retencion_detalle  where compra_enlace='".$compra_enlace."' and porcentaje_id not in (".$codigos_creados."'-')";
       $rsvdata = $DB_gogess->executec($vacia_data,array());
	   
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	   
	   
for($i=1;$i<=count($genra_listado);$i++)
{

$compra_fecha=explode("-",$rs_comp->fields["compra_fecha"]);


$compretcab_id=0;
$compretdet_ejerfiscal=$compra_fecha[1]."/".$compra_fecha[0];
$compretdet_baseimponible=$genra_listado[$i]["base"];
$impur_id=$genra_listado[$i]["tipo"];
$porcentaje_id=$genra_listado[$i]["codigo"];
$compretdet_porcentaje=$genra_listado[$i]["porcentaje"];
$compretdet_valorretenido=$genra_listado[$i]["valor"];
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$compretdet_archivo='';
$compretdet_accesolote='';
$compretdet_adicional1='';
$compretdet_nombreret=$genra_listado[$i]["retencion"];


//busca existe
$busca_exsite="select * from comprobante_retencion_detalle where compra_enlace='".$compra_enlace."' and porcentaje_id ='".$porcentaje_id."'";
$inserta_retencion = $DB_gogess->executec($busca_exsite,array());
//busca existe

if($inserta_retencion->fields["compretdet_id"]>0)
{

$actualiza_data="update comprobante_retencion_detalle set compretdet_ejerfiscal='".$compretdet_ejerfiscal."',compretdet_baseimponible='".$compretdet_baseimponible."',impur_id='".$impur_id."',porcentaje_id='".$porcentaje_id."',compretdet_porcentaje='".$compretdet_porcentaje."',compretdet_valorretenido='".$compretdet_valorretenido."',usua_id='".$usua_id."',compretdet_nombreret='".$compretdet_nombreret."' where compretdet_id='".$inserta_retencion->fields["compretdet_id"]."'";

$inserta_actualiza = $DB_gogess->executec($actualiza_data,array());


}
else
{
$insreta_retenc="INSERT INTO comprobante_retencion_detalle ( compretcab_id, compretdet_ejerfiscal, compretdet_baseimponible, impur_id, porcentaje_id, compretdet_porcentaje, compretdet_valorretenido, usua_id, compretdet_archivo, compretdet_accesolote, compretdet_adicional1, compretdet_nombreret, compra_enlace) VALUES ('".$compretcab_id."','".$compretdet_ejerfiscal."','".$compretdet_baseimponible."','".$impur_id."','".$porcentaje_id."','".$compretdet_porcentaje."','".$compretdet_valorretenido."','".$usua_id."','".$compretdet_archivo."','".$compretdet_accesolote."','".$compretdet_adicional1."','".$compretdet_nombreret."','".$compra_enlace."');";

$inserta_data = $DB_gogess->executec($insreta_retenc,array());
}



}
	   
	   
	
	   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


}


?>
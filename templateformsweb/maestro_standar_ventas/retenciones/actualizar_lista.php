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

$compra_enlace=$_POST["campo_enlace"];

$bloque_registro=0;
$busca_comprax="select * from beko_documentocabecera where doccab_id='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());

$doccab_id=$_POST["campo_enlace"];
//IVA
$lista_valor=array();
$lista_valorrenta=array();


$lista_detalles="select sum(docdet_total) as total,porcevi_id,tari_codigo  from beko_documentodetalle where doccab_id='".$compra_enlace."' and porcevi_id>0 and tari_codigo in (2,4) group by tari_codigo";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 //$valor_iva=($rs_data->fields["total"]*12)/100;
		 
		 if($rs_data->fields["tari_codigo"]==2)
	     {
		 $valor_iva=($rs_data->fields["total"]*12)/100;
	     }
	     
	     if($rs_data->fields["tari_codigo"]==4)
	     {
		 $valor_iva=($rs_data->fields["total"]*15)/100;
	     }
	  
	     $lista_valor[$rs_data->fields["porcevi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcevi_id"]]["valor"]+$valor_iva;		 
		 $lista_valor[$rs_data->fields["porcevi_id"]]["codigo"]=$rs_data->fields["porcevi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


$lista_detalles="select sum(cueven_subtotal) as total,porceci_idv,taric_idv  from lpin_cuentaventa where doccab_id='".$compra_enlace."' and porceci_idv>0 and taric_idv in (1,5) group by porceci_idv";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 $valor_iva=0;
		 //$valor_iva=($rs_data->fields["total"]*12)/100;
		 
		 if($rs_data->fields["taric_idv"]==1)
		 {
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 }
		 
		 if($rs_data->fields["taric_idv"]==5)
		 {
		 $valor_iva=($rs_data->fields["total"]*15)/100;
		 }
		 
	     $lista_valor[$rs_data->fields["porceci_idv"]]["valor"]=$lista_valor[$rs_data->fields["porceci_idv"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porceci_idv"]]["codigo"]=$rs_data->fields["porceci_idv"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(mhdetfac_total) as total,porcevhi_id,tarimh_codigo  from beko_mhdetallefactura where doccab_id='".$compra_enlace."' and porcevhi_id>0 and tarimh_codigo in (2,4)  group by porcevhi_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	  
		 
		 $valor_iva=0;
		 //$valor_iva=($rs_data->fields["total"]*12)/100;
		 
		 if($rs_data->fields["tarimh_codigo"]==2)
		 {
		 $valor_iva=($rs_data->fields["total"]*12)/100;
		 }
		 
		 if($rs_data->fields["tarimh_codigo"]==4)
		 {
		 $valor_iva=($rs_data->fields["total"]*15)/100;
		 }
		 
	     $lista_valor[$rs_data->fields["porcevhi_id"]]["valor"]=$lista_valor[$rs_data->fields["porcevhi_id"]]["valor"]+$valor_iva;
		 $lista_valor[$rs_data->fields["porcevhi_id"]]["codigo"]=$rs_data->fields["porcevhi_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 


//IVA


//RENTA
$lista_valorrenta=array();

$lista_detalles="select sum(docdet_total) as total,porcevr_id  from beko_documentodetalle where doccab_id='".$compra_enlace."' and porcevr_id>0 group by porcevr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $lista_valorrenta[$rs_data->fields["porcevr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcevr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcevr_id"]]["codigo"]=$rs_data->fields["porcevr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  


$lista_detalles="select sum(cueven_subtotal) as total,porcecr_idv  from lpin_cuentaventa where doccab_id='".$compra_enlace."' and porcecr_idv>0 group by porcecr_idv";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
		 
	     $lista_valorrenta[$rs_data->fields["porcecr_idv"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcecr_idv"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcecr_idv"]]["codigo"]=$rs_data->fields["porcecr_idv"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 
 
$lista_detalles="select sum(mhdetfac_total) as total,porcevhr_id  from beko_mhdetallefactura where doccab_id='".$compra_enlace."' and porcevhr_id>0 group by porcevhr_id";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	    
	     $lista_valorrenta[$rs_data->fields["porcevhr_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcevhr_id"]]["valor"]+$rs_data->fields["total"];
		 $lista_valorrenta[$rs_data->fields["porcevhr_id"]]["codigo"]=$rs_data->fields["porcevhr_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	
 

//print_r($lista_valor); 
//print_r($lista_valorrenta);


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

//print_r($genra_listado);


//busca retencion generada
//busca para borrar
$codigos_creados='';
for($i=1;$i<=count($genra_listado);$i++)
{
   $codigos_creados.="'".$genra_listado[$i]["codigo"]."',";
}

$vacia_data="delete from ventas_retencion_detalle  where doccab_id='".$compra_enlace."' and porcentaje_id not in (".$codigos_creados."'-')";
$rsvdata = $DB_gogess->executec($vacia_data,array());

//busca para borrar




for($i=1;$i<=count($genra_listado);$i++)
{

$compra_fecha=explode("-",$rs_cmpx->fields["doccab_fechaemision_cliente"]);


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

$busca_exsite="select * from ventas_retencion_detalle where doccab_id='".$compra_enlace."' and porcentaje_id ='".$porcentaje_id."'";
$inserta_retencion = $DB_gogess->executec($busca_exsite,array());
//busca existe

if($inserta_retencion->fields["compretdet_id"]>0)
{

$actualiza_data="update ventas_retencion_detalle set compretdet_ejerfiscal='".$compretdet_ejerfiscal."',compretdet_baseimponible='".$compretdet_baseimponible."',impur_id='".$impur_id."',porcentaje_id='".$porcentaje_id."',compretdet_porcentaje='".$compretdet_porcentaje."',compretdet_valorretenido='".$compretdet_valorretenido."',usua_id='".$usua_id."',compretdet_nombreret='".$compretdet_nombreret."' where compretdet_id='".$inserta_retencion->fields["compretdet_id"]."'";

$inserta_actualiza = $DB_gogess->executec($actualiza_data,array());


}
else
{

$insreta_retenc="INSERT INTO ventas_retencion_detalle ( doccab_id, compretdet_ejerfiscal, compretdet_baseimponible, impur_id, porcentaje_id, compretdet_porcentaje, compretdet_valorretenido, usua_id, compretdet_archivo, compretdet_accesolote, compretdet_adicional1, compretdet_nombreret, compra_enlace) VALUES ('".$doccab_id."','".$compretdet_ejerfiscal."','".$compretdet_baseimponible."','".$impur_id."','".$porcentaje_id."','".$compretdet_porcentaje."','".$compretdet_valorretenido."','".$usua_id."','".$compretdet_archivo."','".$compretdet_accesolote."','".$compretdet_adicional1."','".$compretdet_nombreret."','".$compra_enlace."');";

$inserta_data = $DB_gogess->executec($insreta_retenc,array());

}



}


//RENTA

?>
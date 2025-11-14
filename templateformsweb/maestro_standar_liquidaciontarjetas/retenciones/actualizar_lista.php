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
$busca_comprax="select * from lpin_lqtarjetacredito where tpliq_enlace='".$_POST["campo_enlace"]."'";
$rs_cmpx = $DB_gogess->executec($busca_comprax,array());

$doccab_id=$_POST["campo_enlace"];
//IVA
$lista_valor=array();
$lista_valorrenta=array();


$lista_detalles="select lqtran_iva,lqtran_baseretiva,(lqtran_iva/lqtran_baseretiva) as viva,porcecil_id  from lpin_lqtransacciones where tpliq_enlace='".$compra_enlace."' and lqtran_baseretiva>0";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 //$valor_iva=($rs_data->fields["total"]*12)/100;
		 $lqtran_iva=0;
		 $lqtran_iva=$rs_data->fields["lqtran_iva"];
	  
	     $lista_valor[$rs_data->fields["porcecil_id"]]["valor"]=$lista_valor[$rs_data->fields["porcevi_id"]]["valor"]+$lqtran_iva;		 
		 $lista_valor[$rs_data->fields["porcecil_id"]]["codigo"]=$rs_data->fields["porcecil_id"];
	  
	    $rs_data->MoveNext();
	  }
  }	  

 

//IVA


//RENTA
$lista_valorrenta=array();

$lista_detalles="select lqtran_iva,lqtran_baseretir,(lqtran_iva/lqtran_baseretiva) as viva,porcecrl_id  from lpin_lqtransacciones where tpliq_enlace='".$compra_enlace."' and lqtran_baseretir>0";
$rs_data = $DB_gogess->executec($lista_detalles,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	
	  
	     $valor_iva=0;
		 //$valor_iva=($rs_data->fields["total"]*12)/100;
		 $lqtran_iva=0;
		 $lqtran_iva=$rs_data->fields["lqtran_baseretir"];
	  
	     $lista_valorrenta[$rs_data->fields["porcecrl_id"]]["valor"]=$lista_valorrenta[$rs_data->fields["porcecrl_id"]]["valor"]+$lqtran_iva;		 
		 $lista_valorrenta[$rs_data->fields["porcecrl_id"]]["codigo"]=$rs_data->fields["porcecrl_id"];
	  
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

$vacia_data="delete from tarjeta_retencion_detalle  where tpliq_enlace='".$compra_enlace."' and porcentaje_id not in (".$codigos_creados."'-')";
$rsvdata = $DB_gogess->executec($vacia_data,array());

//busca para borrar




for($i=1;$i<=count($genra_listado);$i++)
{

$compra_fecha=explode("-",$rs_cmpx->fields["tpliq_fechaemision"]);


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

$busca_exsite="select * from tarjeta_retencion_detalle where tpliq_enlace='".$compra_enlace."' and porcentaje_id ='".$porcentaje_id."'";
$inserta_retencion = $DB_gogess->executec($busca_exsite,array());
//busca existe

if($inserta_retencion->fields["compretdet_id"]>0)
{

$actualiza_data="update tarjeta_retencion_detalle set compretdet_ejerfiscal='".$compretdet_ejerfiscal."',compretdet_baseimponible='".$compretdet_baseimponible."',impur_id='".$impur_id."',porcentaje_id='".$porcentaje_id."',compretdet_porcentaje='".$compretdet_porcentaje."',compretdet_valorretenido='".$compretdet_valorretenido."',usua_id='".$usua_id."',compretdet_nombreret='".$compretdet_nombreret."' where compretdet_id='".$inserta_retencion->fields["compretdet_id"]."'";

$inserta_actualiza = $DB_gogess->executec($actualiza_data,array());


}
else
{

$insreta_retenc="INSERT INTO tarjeta_retencion_detalle (  compretdet_ejerfiscal, compretdet_baseimponible, impur_id, porcentaje_id, compretdet_porcentaje, compretdet_valorretenido, usua_id, compretdet_archivo, compretdet_accesolote, compretdet_adicional1, compretdet_nombreret, 	tpliq_enlace) VALUES ('".$compretdet_ejerfiscal."','".$compretdet_baseimponible."','".$impur_id."','".$porcentaje_id."','".$compretdet_porcentaje."','".$compretdet_valorretenido."','".$usua_id."','".$compretdet_archivo."','".$compretdet_accesolote."','".$compretdet_adicional1."','".$compretdet_nombreret."','".$compra_enlace."');";

$inserta_data = $DB_gogess->executec($insreta_retenc,array());

}



}


//RENTA

?>
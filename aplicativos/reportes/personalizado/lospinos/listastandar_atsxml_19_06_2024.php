<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.cookie_lifetime",36000);
ini_set("session.gc_maxlifetime",36000);
session_start();
if($_SESSION['ces1313777_sessid_inicio'])
{

//2 excel
//3 pdf

function ver_ciudadpaciente($ci,$DB_gogess)
{

$lista_hijos="select distinct centro_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($ci)."'";
$rs_datahijos = $DB_gogess->executec($lista_hijos,array());

$centro_id=@$rs_datahijos->fields["centro_id"];
if(!(@$rs_datahijos->fields["centro_id"]))
{
   $centro_id=1;
}

return $centro_id;

}

$previsual=0;
if(@$_POST["previsual"])
{
$previsual=@$_POST["previsual"];
$fecha_i=@$_POST["fecha_inicio"];
$fecha_f=@$_POST["fecha_fin"];
$centro_id=@$_POST["centro_id"];
$clie_institucionval=@$_POST["clie_institucionval"];
$ireport=@$_POST["ireport"];
$cliente_ruc=@$_POST["cliente_ruc"];
}
else
{
$previsual=@$_GET["previsual"];
$fecha_i=@$_GET["fecha_inicio"];
$fecha_f=@$_GET["fecha_fin"];
$centro_id=@$_GET["centro_id"];
$clie_institucionval=@$_GET["clie_institucionval"];
$ireport=@$_GET["ireport"];
$cliente_ruc=@$_GET["cliente_ruc"];
}

if($previsual==2)
{
header('Content-type: application/vnd.ms-excel');
$fechahoy=date("Y-m-d");
header("Content-Disposition: attachment; filename="."repxls_".$fechahoy.".xls");
}

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
require_once('tcpdf_include.php');

$objformulario= new  ValidacionesFormulario(); 

$bandera_t1=0;
$actual = strtotime(date("Y-m-d"));
$mesmenos = date("Y-m-d", strtotime("-2 month", $actual));

$errors='';


$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";

if($centro_id)
  {
  // $sql2=" app_cliente.centro_id=".$centro_id." and ";
  }


if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" doccab_fechaemision_cliente>='".$fecha_i."' and doccab_fechaemision_cliente<='".$fecha_f."' and ";
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

if($clie_institucionval)
  {
   $sql4=" clie_institucion like '%".$clie_institucionval."%' and ";
  }  

if($cliente_ruc)
{
$sql5=" doccab_rucci_cliente = '".trim($cliente_ruc)."' and ";
}  
      

$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;
$concatena_sql=substr($concatena_sql,0,-4);


$nciudad='';
$nciudad=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_nombre"," where centro_id =",$centro_id,$DB_gogess);



//area datos
$documento='';
$cabecera='';
$cabecera=$objformulario->replace_cmb("app_empresa","emp_id,emp_cabecerareportes"," where emp_id=",1,$DB_gogess);

$css="<style type='text/css'>
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>";

$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->executec($reporte_pg,array());

$rept_nombre=$rs_reportepg->fields["rept_nombre"];
$documento=$css."<div align='center' >".$rept_nombre."</div><p align='center'>".$rs_reportepg->fields["rept_observacion"]."</p>".utf8_decode($cabecera)."<br><center><b>".$nciudad."</b></center>";


//echo $lista_servicios;
//$xmldata=53;

$cuenta_fac=0;
$documento.='<center>
Desde: '.$fecha_i.' Hasta: '.$fecha_f.'<br>
<br>';

///programacion reporte

$fecha_incio=$fecha_i;
$fecha_fin=$fecha_f;

$saca_aniio=array();
$saca_aniio=explode("-",$fecha_incio);

$contenido='';


$contenido.="<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\" ?>\n";
$contenido.="<iva>\n";
$contenido.="<TipoIDInformante>R</TipoIDInformante>\n";
$contenido.="<IdInformante>1792935261001</IdInformante>\n";
$contenido.="<razonSocial>CL&Iacute,NICA DE ESPECIALIDADES DEL SUR GUERRA GUZMAN PINOSMED CIALTDA</razonSocial>\n";
$contenido.="<Anio>".$saca_aniio[0]."</Anio>\n";
$contenido.="<Mes>".$saca_aniio[1]."</Mes>\n";
$contenido.="<numEstabRuc>001</numEstabRuc>\n";
$contenido.="<totalVentas>0.00</totalVentas>\n";
$contenido.="<codigoOperativo>IVA</codigoOperativo>\n";
$contenido.="<compras>\n";


//$lista_compra="select * from dns_compras where compra_fecha>='".$fecha_incio."' and compra_fecha<='".$fecha_fin."'";

$lista_compra="SELECT compra_id,compra_fecha,provee_ruc,provee_cedula,provee_nombre,compra_descripcion,compra_nfactura,compra_autorizacion,tipdoc_codigo,'' as asiento,compra_subtotaliva,compra_subtotalceroiva,0 as noobjeto,(compra_subtotaliva+compra_subtotalceroiva) as subtotal,compra_iva,0 as ivagasto,0 as ice,compra_total,compra_parainv,compra_enlace,proveevar_id,dns_compras.tipdoc_id,compra_codmodif,compra_nummodif,compra_autmodi,subtgen_id FROM dns_compras inner join app_proveedor on proveevar_id=provee_id inner join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_fecha>='".$fecha_incio."' and compra_fecha<='".$fecha_fin."' and compra_anulado=0 ";

 

$rs_data = $DB_gogess->executec($lista_compra,array());
 if($rs_data)
 {
	  while (!$rs_data->EOF) {	

$provee_ruc='';
$provee_ruc='';
$provee_cedula='';

@$valRetBien10='';
@$valRetServ20='';
@$valorRetBienes='';
@$valRetServ50='';
@$valorRetServicios='';
@$valRetServ100='';
@$totbasesImpReemb='';

$codSustento='01';
if($rs_data->fields["compra_parainv"]==1)
{
   $codSustento='06';
}	  
//busca si es gatos

$busca_detallecuenta="select * from lpin_cuentacompra where compra_enlace='".$rs_data->fields["compra_enlace"]."'";
$rs_detcuenta = $DB_gogess->executec($busca_detallecuenta,array());

$planc_codigoc='';
$planc_codigoc=$rs_detcuenta->fields["planc_codigoc"];

$busca_lacuentasies="select * from lpin_plancuentas where planc_codigoc='".$planc_codigoc."'";
$rs_becuenta = $DB_gogess->executec($busca_lacuentasies,array());

$planc_codigo='';
$planc_codigo=$rs_becuenta->fields["planc_codigo"];

if($planc_codigo==5)
{
   $codSustento='02';
}
//busca si es gasto	  

if($rs_data->fields["tipdoc_codigo"]=='02')
{
  $codSustento='02';
}

//busca activo fijo
$busca_activofijo="select count(*) as tfijo from dns_activosfijos where compra_enlace='".$rs_data->fields["compra_enlace"]."'";
$rs_bactivofijo = $DB_gogess->executec($busca_activofijo,array());

if($rs_bactivofijo->fields["tfijo"]>0)
{
  $codSustento='03';
}
//busca activo fijo

//nota de venta

//nota de venta
$tipdoc_id=$rs_data->fields["tipdoc_id"];

//busca porveedor id
//$tpIdProv
$busca_codprov="select * from app_proveedor where provee_id='".$rs_data->fields["proveevar_id"]."'";
$rs_codprove = $DB_gogess->executec($busca_codprov,array());

$tipoident_codigocl=$rs_codprove->fields["tipoident_codigocl"];

switch ($tipdoc_id) {
    case 1:
        {
		  $tipoident_codigocl='04';
          $provee_ruc=$rs_codprove->fields["provee_ruc"];
		  $provee_cedula=$rs_codprove->fields["provee_cedula"];
		}
        break;
	case 2:
        {
		  $tipoident_codigocl='04';
          $provee_ruc=$rs_codprove->fields["provee_ruc"];
		  $provee_cedula=$rs_codprove->fields["provee_cedula"];
		}
        break;
    case 3:
        {
		  if($tipoident_codigocl=='06')
		  {
		    $provee_cedula=$rs_codprove->fields["provee_cedula"];
		    $provee_ruc=$rs_codprove->fields["provee_ruc"];
		  
		  }
		  else
		  {
		  $tipoident_codigocl='05';
          $provee_cedula=$rs_codprove->fields["provee_cedula"];
		  $provee_ruc=$rs_codprove->fields["provee_ruc"];
		  }
		  
		}
        break;
    default:
      {
	    $tipoident_codigocl=$rs_codprove->fields["tipoident_codigocl"];
        $provee_ruc=$rs_codprove->fields["provee_ruc"];
        $provee_cedula=$rs_codprove->fields["provee_cedula"];

	  }
}



$provee_nombre=$rs_codprove->fields["provee_nombre"];
$tipop_id=$rs_codprove->fields["tipop_id"];


$idProv='';
//ruc
if($tipoident_codigocl=='04')
{
$tpIdProv='01';
$idProv=$provee_ruc;
}
//cedula
if($tipoident_codigocl=='05')
{
$tpIdProv='02';
$idProv=$provee_cedula;
}

if($tipoident_codigocl=='06')
{
$tpIdProv='03';
$idProv=$provee_cedula;
}
//echo $busca_codprov."-->".$idProv."<br>";
//busca proveedor id



$busca_comp="select * from dns_tipodocumentogeneral where tipdoc_id='".$tipdoc_id."'";
$rs_tcomp = $DB_gogess->executec($busca_comp,array());



$tipoComprobante=$rs_tcomp->fields["tipdoc_codigo"];

$separafecha=array();
$separafecha=explode("-",$rs_data->fields["compra_fecha"]);

$nfecha='';
$nfecha=$separafecha[2]."/".$separafecha[1]."/".$separafecha[0];

$fechaRegistro=$nfecha;
$fechaEmision=$nfecha;

$documento_sep=array();
$documento_sep=explode("-",$rs_data->fields["compra_nfactura"]);

$establecimiento=$documento_sep[0];
$puntoEmision=$documento_sep[1];
$secuencial=$documento_sep[2];

$compra_autorizacion=$rs_data->fields["compra_autorizacion"];
$autorizacion=$compra_autorizacion;


$baseNoGraIva='0.00';
$baseImponible=number_format($rs_data->fields["compra_subtotalceroiva"], 2, '.', '');
$baseImpGrav=number_format($rs_data->fields["compra_subtotaliva"], 2, '.', '');
$baseImpExe='0.00';
$montoIce='0.00';
$montoIva=number_format($rs_data->fields["compra_iva"], 2, '.', '');

//============================================================================

 $array_iva=array();
	 $ivarete=0;
	 $nretencion='';
	 $fechanretencion='';
	 $compretcab_clavedeaccesos='';
	 $busca_retencion="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=2 and compra_id='".$rs_data->fields["compra_id"]."' and compretcab_nousuada=0 and  (compretcab_fechaemision_cliente>='".$fecha_incio."' and compretcab_fechaemision_cliente<='".$fecha_fin."') ";
	//echo $busca_retencion."<br>";
	 $rs_listaretencion = $DB_gogess->executec($busca_retencion,array());
	  if($rs_listaretencion)
      {
			  while (!$rs_listaretencion->EOF) {
			  
			  @$array_iva[$rs_listaretencion->fields["porcentaje_id"]]=$array_iva[$rs_listaretencion->fields["porcentaje_id"]]+$rs_listaretencion->fields["compretdet_valorretenido"];
			  $ivarete=$ivarete+$rs_listaretencion->fields["compretdet_valorretenido"];
			  
			  $nretencion=$rs_listaretencion->fields["compretcab_nretencion"];
			  $fechanretencion=$rs_listaretencion->fields["compretcab_fechaemision_cliente"];
			  $compretcab_clavedeaccesos=$rs_listaretencion->fields["compretcab_clavedeaccesos"];
			  
			  $rs_listaretencion->MoveNext();	
			  }
	   }
//print_r($array_iva);   
//retencion 

@$valRetBien10=number_format(@$array_iva[9], 2, '.', '');
@$valRetServ20=number_format(@$array_iva[10], 2, '.', '');
@$valorRetBienes=number_format(@$array_iva[1], 2, '.', '');
@$valRetServ50=number_format(@$array_iva[11], 2, '.', '');
@$valorRetServicios=number_format(@$array_iva[2], 2, '.', '');
@$valRetServ100=number_format(@$array_iva[3], 2, '.', '');
@$totbasesImpReemb='0.00';

//============================================================================


if($rs_data->fields["subtgen_id"]>0)
{
$busca_codcodSustento="select * from dns_subtipogeneral where subtgen_id=subtgen_id='".$rs_data->fields["subtgen_id"]."'";
$rs_codSustento = $DB_gogess->executec($busca_codcodSustento,array());
$codSustento=$rs_codSustento->fields["subtgen_codigo"];
}

	  
$contenido.="<detalleCompras>\n";
$contenido.="<codSustento>".$codSustento."</codSustento>\n";
$contenido.="<tpIdProv>".$tpIdProv."</tpIdProv>\n";
$contenido.="<idProv>".$idProv."</idProv>\n";
$contenido.="<tipoComprobante>".$tipoComprobante."</tipoComprobante>\n";

if($tipoComprobante=='03')
{

$tipoProv='';
if($tipop_id==1)
{
  $tipoProv='01';
}
if($tipop_id==2)
{
  $tipoProv='02';
}

$contenido.="<tipoProv>".$tipoProv."</tipoProv>\n";
$contenido.="<denoProv>".$provee_nombre."</denoProv>\n";
}


$contenido.="<parteRel>NO</parteRel>\n";
$contenido.="<fechaRegistro>".$fechaRegistro."</fechaRegistro>\n";
$contenido.="<establecimiento>".$establecimiento."</establecimiento>\n";
$contenido.="<puntoEmision>".$puntoEmision."</puntoEmision>\n";
$contenido.="<secuencial>".$secuencial."</secuencial>\n";
$contenido.="<fechaEmision>".$fechaEmision."</fechaEmision>\n";
$contenido.="<autorizacion>".$autorizacion."</autorizacion>\n";
$contenido.="<baseNoGraIva>".$baseNoGraIva."</baseNoGraIva>\n";
$contenido.="<baseImponible>".$baseImponible."</baseImponible>\n";
$contenido.="<baseImpGrav>".$baseImpGrav."</baseImpGrav>\n";
$contenido.="<baseImpExe>".$baseImpExe."</baseImpExe>\n";
$contenido.="<montoIce>".$montoIce."</montoIce>\n";
$contenido.="<montoIva>".$montoIva."</montoIva>\n";
$contenido.="<valRetBien10>".$valRetBien10."</valRetBien10>\n";
$contenido.="<valRetServ20>".$valRetServ20."</valRetServ20>\n";
$contenido.="<valorRetBienes>".$valorRetBienes."</valorRetBienes>\n";
$contenido.="<valRetServ50>".$valRetServ50."</valRetServ50>\n";
$contenido.="<valorRetServicios>".$valorRetServicios."</valorRetServicios>\n";
$contenido.="<valRetServ100>".$valRetServ100."</valRetServ100>\n";
$contenido.="<totbasesImpReemb>".$totbasesImpReemb."</totbasesImpReemb>\n";
$contenido.="<pagoExterior>\n";
$contenido.="<pagoLocExt>01</pagoLocExt>\n";
$contenido.="<paisEfecPago>NA</paisEfecPago>\n";
$contenido.="<aplicConvDobTrib>NA</aplicConvDobTrib>\n";
$contenido.="<pagExtSujRetNorLeg>NA</pagExtSujRetNorLeg>\n";
$contenido.="</pagoExterior>\n";

$sumandovalor=0;
$sumandovalor=$baseImpGrav+$baseImponible+$montoIva;
if($sumandovalor>1000)
{

$contenido.="<formasDePago>\n";
$contenido.="<formaPago>20</formaPago>\n";
$contenido.="</formasDePago>\n";

}
//$lista_renta

 $array_renta=array();
 $ivaretett=0;


$busca_retencion1x="select count(*) as total from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."' and  (compretcab_fechaemision_cliente>='".$fecha_incio."' and compretcab_fechaemision_cliente<='".$fecha_fin."')  ";
$rs_listaretencion1x = $DB_gogess->executec($busca_retencion1x,array());
//echo $rs_listaretencion1x->fields["total"]."<br>";
if($rs_listaretencion1x->fields["total"]>0)
{
$contenido.="<air>\n";
}

$nretencion1='';
$fechanretencion1='';

$bandera_uno=0;

$compretcab_clavedeaccesos='';

$busca_retencion1="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id where compretcab_anulado=0 and compretcab_nfactura='".str_replace("-","",$rs_data->fields["compra_nfactura"])."' and impur_id=1 and compra_id='".$rs_data->fields["compra_id"]."' and compretcab_nousuada=0 and  (compretcab_fechaemision_cliente>='".$fecha_incio."' and compretcab_fechaemision_cliente<='".$fecha_fin."') ";

	 $rs_listaretencion1 = $DB_gogess->executec($busca_retencion1,array());
	  if($rs_listaretencion1)
      {
			  while (!$rs_listaretencion1->EOF) {
			  
			   //@$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]=$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["valor"]+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   //@$array_renta[$rs_listaretencion1->fields["compretdet_porcentaje"]]["codigo"]=$rs_listaretencion1->fields["porcentaje_id"];		
			   //$ivaretett=$ivaretett+$rs_listaretencion1->fields["compretdet_valorretenido"];
			   
			    $nretencion1=$rs_listaretencion1->fields["compretcab_nretencion"];
			    $fechanretencion1=$rs_listaretencion1->fields["compretcab_fechaemision_cliente"];
				
				$compretcab_clavedeaccesos=$rs_listaretencion1->fields["compretcab_clavedeaccesos"];
			   
			    $contenido.="<detalleAir>\n";
				$contenido.="<codRetAir>".$rs_listaretencion1->fields["porcentaje_id"]."</codRetAir>\n";
				$contenido.="<baseImpAir>".number_format($rs_listaretencion1->fields["compretdet_baseimponible"], 2, '.', '')."</baseImpAir>\n";
				$contenido.="<porcentajeAir>".number_format($rs_listaretencion1->fields["compretdet_porcentaje"], 2, '.', '')."</porcentajeAir>\n";
				$contenido.="<valRetAir>".number_format($rs_listaretencion1->fields["compretdet_valorretenido"], 2, '.', '')."</valRetAir>\n";
				$contenido.="</detalleAir>\n";
			   
			    $bandera_uno=1;
			   
			  
			  $rs_listaretencion1->MoveNext();	
			  }
	   }

if($rs_listaretencion1x->fields["total"]>0)
{
$contenido.="</air>\n";
}

if($bandera_uno==1)
{
$separan_ret1=array();
$separan_ret1=explode("-",$nretencion1);

$separafecharet1=array();
$separafecharet1=explode("-",$fechanretencion1);

$nfecharet1='';
$nfecharet1=$separafecharet1[2]."/".$separafecharet1[1]."/".$separafecharet1[0];


$contenido.="<estabRetencion1>".$separan_ret1[0]."</estabRetencion1>\n";
$contenido.="<ptoEmiRetencion1>".$separan_ret1[1]."</ptoEmiRetencion1>\n";
$contenido.="<secRetencion1>".$separan_ret1[2]."</secRetencion1>\n";
$contenido.="<autRetencion1>".$compretcab_clavedeaccesos."</autRetencion1>\n";
$contenido.="<fechaEmiRet1>".$nfecharet1."</fechaEmiRet1>\n";
}
else
{

$contenido.="<estabRetencion1>999</estabRetencion1>\n";
$contenido.="<ptoEmiRetencion1>999</ptoEmiRetencion1>\n";
$contenido.="<secRetencion1>999999999</secRetencion1>\n";
$contenido.="<autRetencion1>9999999999</autRetencion1>\n";
$contenido.="<fechaEmiRet1>".$fechaEmision."</fechaEmiRet1>\n";
}

if($tipoComprobante=='04')
{

//sacar nota de credito



$separa_datacredtio=array();
$separa_datacredtio=explode("-",$rs_data->fields["compra_nummodif"]);


//sacar nota de credito

$contenido.="<docModificado>".$rs_data->fields["compra_codmodif"]."</docModificado>\n";
$contenido.="<estabModificado>".$separa_datacredtio[0]."</estabModificado>\n";
$contenido.="<ptoEmiModificado>".$separa_datacredtio[1]."</ptoEmiModificado>\n";
$contenido.="<secModificado>".$separa_datacredtio[2]."</secModificado>\n";
$contenido.="<autModificado>".$rs_data->fields["compra_autmodi"]."</autModificado>\n";

}

if($tipoComprobante=='05')
{

//sacar nota de debito



//sacar nota de debito

$contenido.="<docModificado></docModificado>\n";
$contenido.="<estabModificado></estabModificado>\n";
$contenido.="<ptoEmiModificado></ptoEmiModificado>\n";
$contenido.="<secModificado></secModificado>\n";
$contenido.="<autModificado></autModificado>\n";

}


$contenido.="</detalleCompras>\n";

                  $rs_data->MoveNext();	
			  }
	   }

$contenido.="</compras>\n";

$contenido.="<ventas>\n";


$lista_docx="SELECT DISTINCT doccab_rucci_cliente,tipoident_codigo FROM beko_documentocabecera where doccab_fechaemision_cliente>='".$fecha_incio."' and doccab_fechaemision_cliente<='".$fecha_fin."'  and doccab_anulado=0 and doccab_nousar=0";

$rs_datax = $DB_gogess->executec($lista_docx,array());
 if($rs_datax)
 {
	  while (!$rs_datax->EOF) {	
	 
	 
$lista_sacanombre="SELECT doccab_nombrerazon_cliente FROM beko_documentocabecera where doccab_rucci_cliente='".$rs_datax->fields["doccab_rucci_cliente"]."' order by doccab_fechaemision_cliente desc limit 1";
$rs_sacanombre = $DB_gogess->executec($lista_sacanombre,array());
	 
	 
$tpIdCliente='';
$tipoident_codigo=$rs_datax->fields["tipoident_codigo"];

if($rs_datax->fields["doccab_rucci_cliente"]=='1724458521' or $rs_datax->fields["doccab_rucci_cliente"]=='1724794544' or $rs_datax->fields["doccab_rucci_cliente"]=='1724448314' or  $rs_datax->fields["doccab_rucci_cliente"]=='0801741294')
{
  $tipoident_codigo='06';
} 

if($tipoident_codigo=='04')
{
//ruc
$tpIdCliente='04';
}

if($tipoident_codigo=='05')
{
//cedula
$tpIdCliente='05';
}

if($tipoident_codigo=='06')
{
//passaporte
$tpIdCliente='06';
}

if($tipoident_codigo=='08')
{
//passaporte
$tpIdCliente='06';
}

if($tipoident_codigo=='07')
{
//consumidor final
$tpIdCliente='07';
}

if($tipoident_codigo=='09')
{
//placa
$tpIdCliente='19';
}

$idCliente=$rs_datax->fields["doccab_rucci_cliente"];

$denoCli=$rs_sacanombre->fields["doccab_nombrerazon_cliente"];

$busca_facturado="select * from beko_documentocabecera where doccab_rucci_cliente='".$idCliente."' and doccab_fechaemision_cliente>='".$fecha_incio."' and doccab_fechaemision_cliente<='".$fecha_fin."' and doccab_anulado=0";

$c_cuenta=0;
$baseNoGraIva=0;
$baseImponible=0;
$baseImpGrav=0;
$montoIva=0;
$valorRetIva=0;
$valorRetRenta=0;

$rs_lfactura = $DB_gogess->executec($busca_facturado,array());
if($rs_lfactura)
      {
			  while (!$rs_lfactura->EOF) {
			  
			  $c_cuenta++;
			  $baseImponible=$baseImponible+$rs_lfactura->fields["doccab_subtotalsiniva"];
			  $baseImpGrav=$baseImpGrav+$rs_lfactura->fields["doccab_subtotaliva"];			  
			  $montoIva=$montoIva+$rs_lfactura->fields["doccab_iva"];
			  
			  
$lista_renta="select * from ventas_retencion_detalle  where doccab_id='".$rs_lfactura->fields["doccab_id"]."'";
$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	  $ntipo='';
	  if($rs_listadata->fields["impur_id"]==1)
	  {
	    $ntipo='Imp. a la Renta';		
		$valorRetRenta=$valorRetRenta+$rs_listadata->fields["compretdet_valorretenido"];
	  }
	  
	  if($rs_listadata->fields["impur_id"]==2)
	  {
	    $ntipo='IVA';		
		$valorRetIva=$valorRetIva+$rs_listadata->fields["compretdet_valorretenido"];
	  }
	  
	  
	  
	    $rs_listadata->MoveNext();	
	  }
}	  
			  
			  
			  
			  
			  			  
			  $rs_lfactura->MoveNext();	
			  }
	  }		  

$baseImponible=number_format(@$baseImponible, 2, '.', '');
$baseImpGrav=number_format(@$baseImpGrav, 2, '.', '');

$valorRetRenta=number_format(@$valorRetRenta, 2, '.', '');
$valorRetIva=number_format(@$valorRetIva, 2, '.', '');
	 
if(!($tpIdCliente))	 
{

$errors.='Error:.'.$idCliente.'<br>'; 

}
	 
$contenido.="<detalleVentas>\n";
$contenido.="<tpIdCliente>".$tpIdCliente."</tpIdCliente>\n";
$contenido.="<idCliente>".$idCliente."</idCliente>\n";
if($idCliente!='9999999999999')
{
$contenido.="<parteRelVtas>NO</parteRelVtas>\n";
}

if($tpIdCliente=='06')
{

$busca_codprovt="select * from app_proveedor where 	provee_ruc='".$idCliente."' or provee_cedula='".$idCliente."'";
$rs_codprovet = $DB_gogess->executec($busca_codprovt,array());

if($rs_codprovet->fields["tipop_id"]==1)
{
  $tipoCliente='01';
}
if($rs_codprovet->fields["tipop_id"]==2)
{
  $tipoCliente='02';
}

$denoCli=str_replace(array(utf8_encode('ñ'),utf8_encode('Ñ')),array('n', 'N'),$denoCli);

$contenido.="<tipoCliente>".$tipoCliente."</tipoCliente>\n";
$contenido.="<denoCli>".$denoCli."</denoCli>\n";
}



$contenido.="<tipoComprobante>18</tipoComprobante>\n";
$contenido.="<tipoEmision>E</tipoEmision>\n";
$contenido.="<numeroComprobantes>".$c_cuenta."</numeroComprobantes>\n";
$contenido.="<baseNoGraIva>0.00</baseNoGraIva>\n";
$contenido.="<baseImponible>".$baseImponible."</baseImponible>\n";
$contenido.="<baseImpGrav>".$baseImpGrav."</baseImpGrav>\n";
$contenido.="<montoIva>".number_format($montoIva, 2, '.', '')."</montoIva>\n";
$contenido.="<montoIce>0.00</montoIce>\n";
$contenido.="<valorRetIva>".$valorRetIva."</valorRetIva>\n";
$contenido.="<valorRetRenta>".$valorRetRenta."</valorRetRenta>\n";
$contenido.="<formasDePago>\n";
$contenido.="<formaPago>20</formaPago>\n";
$contenido.="</formasDePago>\n";
$contenido.="</detalleVentas>\n";

           $rs_datax->MoveNext();	  
	  }
  }	   



$contenido.="</ventas>\n";

$contenido.="<ventasEstablecimiento>\n";
$contenido.="<ventaEst>\n";
$contenido.="<codEstab>001</codEstab>\n";
$contenido.="<ventasEstab>0.00</ventasEstab>\n";
$contenido.="<ivaComp>0.00</ivaComp>\n";
$contenido.="</ventaEst>\n";
$contenido.="</ventasEstablecimiento>\n";


$contenido.="<anulados>\n";

$busca_retencionesanuladas="select * from comprobante_retencion_cab where compretcab_estadosri='AUTORIZADO' and compretcab_nousuada=0 and compretcab_anulado=1 and compretcab_fechaemision_cliente>='".$fecha_incio."' and compretcab_fechaemision_cliente<='".$fecha_fin."' and compretcab_nousuada=0 and  (compretcab_fechaemision_cliente>='".$fecha_incio."' and compretcab_fechaemision_cliente<='".$fecha_fin."') ";
$rs_lisanuladasret = $DB_gogess->executec($busca_retencionesanuladas,array());
if($rs_lisanuladasret)
 {
	  while (!$rs_lisanuladasret->EOF) {	
	  
$compretcab_nretencion=array();	  
$compretcab_nretencion=explode("-",$rs_lisanuladasret->fields["compretcab_nretencion"]);
$compretcab_nautorizacion=$rs_lisanuladasret->fields["compretcab_nautorizacion"];
	  
$contenido.="<detalleAnulados>\n";
$contenido.="<tipoComprobante>07</tipoComprobante>\n";
$contenido.="<establecimiento>".$compretcab_nretencion[0]."</establecimiento>\n";
$contenido.="<puntoEmision>".$compretcab_nretencion[1]."</puntoEmision>\n";
$contenido.="<secuencialInicio>".$compretcab_nretencion[2]."</secuencialInicio>\n";
$contenido.="<secuencialFin>".$compretcab_nretencion[2]."</secuencialFin>\n";
$contenido.="<autorizacion>".$compretcab_nautorizacion."</autorizacion>\n";
$contenido.="</detalleAnulados>\n";
           
		   $rs_lisanuladasret->MoveNext();
       }
}

$busca_facanuladas="select * from beko_documentocabecera where 	doccab_anulado=1 and doccab_fechaemision_cliente>='".$fecha_incio."' and doccab_fechaemision_cliente<='".$fecha_fin."'";
$rs_lisanuladasfac = $DB_gogess->executec($busca_facanuladas,array());
if($rs_lisanuladasfac)
 {
	  while (!$rs_lisanuladasfac->EOF) {	
	  
$doccab_ndocumento=array();	  
$doccab_ndocumento=explode("-",$rs_lisanuladasfac->fields["doccab_ndocumento"]);
$doccab_nautorizacion=$rs_lisanuladasfac->fields["doccab_nautorizacion"];
	  
$contenido.="<detalleAnulados>\n";
$contenido.="<tipoComprobante>18</tipoComprobante>\n";
$contenido.="<establecimiento>".$doccab_ndocumento[0]."</establecimiento>\n";
$contenido.="<puntoEmision>".$doccab_ndocumento[1]."</puntoEmision>\n";
$contenido.="<secuencialInicio>".$doccab_ndocumento[2]."</secuencialInicio>\n";
$contenido.="<secuencialFin>".$doccab_ndocumento[2]."</secuencialFin>\n";
$contenido.="<autorizacion>".$doccab_nautorizacion."</autorizacion>\n";
$contenido.="</detalleAnulados>\n";
           
		   $rs_lisanuladasfac->MoveNext();
       }
}
$contenido.="</anulados>\n";
$contenido.="</iva>\n";
///echo $contenido;
$documento=$contenido;
///programacion reporte
$nombre_archivo="atsxml".date("Y-m-d").uniqid().".xml";

$file = fopen("../xml/".$nombre_archivo, "a+");
fwrite($file,$documento.PHP_EOL);
fclose($file);

//echo getcwd();


echo '<div align="center"><a href="xml/'.$nombre_archivo.'"  download="'.$nombre_archivo.'" >DESCARGAR XML 
</a></div>';


 
 }

echo $errors;
?>
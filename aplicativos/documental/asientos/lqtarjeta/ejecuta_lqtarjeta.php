<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$ldtc_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$valor_id=$ldtc_id;


$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));

$n_tipo='LIQUIDACION TARJETA';
$tipo_code=12;
$TEXTO="LIQUIDACION TARJETA";

//principal
$cuenta_lista=0;
$busca_principal="select * from lpin_lqtarjetacredito where ldtc_id='".$ldtc_id."'";
$rs_bprincipal = $DB_gogess->executec($busca_principal);

$tpliq_fechaemision=$rs_bprincipal->fields["tpliq_fechaemision"];
$crb_fecha=$tpliq_fechaemision;

$movantic_id=$rs_bprincipal->fields["movantic_id"];
$tmv_id=$movantic_id;

$tpliq_cuentabanco=$rs_bprincipal->fields["tpliq_cuentabanco"];
$tpliq_comisionxliquidar=$rs_bprincipal->fields["tpliq_comisionxliquidar"];

$busca_printotal="select sum(lqtran_apagar+lqtran_comision) as total,lpin_lqtarjetacredito.tpliq_enlace from lpin_lqtarjetacredito inner join lpin_lqtransacciones on lpin_lqtarjetacredito.tpliq_enlace=lpin_lqtransacciones.tpliq_enlace where ldtc_id='".$ldtc_id."' group by lpin_lqtarjetacredito.tpliq_enlace";
$rs_bprintotal = $DB_gogess->executec($busca_printotal);

$sub_total=$rs_bprintotal->fields["total"];
$tpliq_enlace=$rs_bprincipal->fields["tpliq_enlace"];


//retencion

$lista_retenciones="select sum(compretdet_valorretenido) as compretdet_valorretenido,porce_cuenta,factur_porcentajes.porce_codigo from tarjeta_retencion_detalle inner join factur_porcentajes on tarjeta_retencion_detalle.porcentaje_id=factur_porcentajes.porce_codigo where tpliq_enlace='".$tpliq_enlace."' group by porce_cuenta";
$rs_retenciones = $DB_gogess->executec($lista_retenciones);

	if($rs_retenciones)
	{
	   while (!$rs_retenciones->EOF) 
			{

$tipomv_array='DEBE';
			
$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array;
$array_haber[$cuenta_lista]["CUENTA"]=$rs_retenciones->fields["porce_cuenta"];
$array_haber[$cuenta_lista]["VALOR"]=$rs_retenciones->fields["compretdet_valorretenido"];
$cuenta_lista++;
			
			$rs_retenciones->MoveNext();
	}		
}


//retencion


//banco

$lista_retenciones="select sum(lqtran_apagar) as lqtran_apagar,lpin_lqtarjetacredito.tpliq_enlace from lpin_lqtarjetacredito inner join lpin_lqtransacciones on lpin_lqtarjetacredito.tpliq_enlace=lpin_lqtransacciones.tpliq_enlace where ldtc_id='".$ldtc_id."' group by lpin_lqtarjetacredito.tpliq_enlace";

$rs_retenciones = $DB_gogess->executec($lista_retenciones);
	if($rs_retenciones)
	{
	   while (!$rs_retenciones->EOF) 
			{

$tipomv_array='DEBE';
			
$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array;
$array_haber[$cuenta_lista]["CUENTA"]=$tpliq_cuentabanco;
$array_haber[$cuenta_lista]["VALOR"]=$rs_retenciones->fields["lqtran_apagar"];
$cuenta_lista++;
			
			$rs_retenciones->MoveNext();
	}		
}
//banco



//comision

$lista_retenciones="select sum(lqtran_comision) as lqtran_comision,lpin_lqtarjetacredito.tpliq_enlace from lpin_lqtarjetacredito inner join lpin_lqtransacciones on lpin_lqtarjetacredito.tpliq_enlace=lpin_lqtransacciones.tpliq_enlace where ldtc_id='".$ldtc_id."' group by lpin_lqtarjetacredito.tpliq_enlace";

$rs_retenciones = $DB_gogess->executec($lista_retenciones);
	if($rs_retenciones)
	{
	   while (!$rs_retenciones->EOF) 
			{

$tipomv_array='DEBE';
			
$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array;
$array_haber[$cuenta_lista]["CUENTA"]=$tpliq_comisionxliquidar;
$array_haber[$cuenta_lista]["VALOR"]=$rs_retenciones->fields["lqtran_comision"];
$cuenta_lista++;
			
			$rs_retenciones->MoveNext();
	}		
}


//comision


$lista_retencionesx="select sum(compretdet_valorretenido) as compretdet_valorretenido from tarjeta_retencion_detalle inner join factur_porcentajes on tarjeta_retencion_detalle.porcentaje_id=factur_porcentajes.porce_codigo where tpliq_enlace='".$tpliq_enlace."'";
$rs_retencionesx = $DB_gogess->executec($lista_retencionesx);


//principal
$tipomv_array_d='HABER';
$lista_retenciones="select sum(lqtran_comision+lqtran_apagar+lqtran_iva) as total,lqtran_cuenta,lpin_lqtarjetacredito.tpliq_enlace from lpin_lqtarjetacredito inner join lpin_lqtransacciones on lpin_lqtarjetacredito.tpliq_enlace=lpin_lqtransacciones.tpliq_enlace where ldtc_id='".$ldtc_id."' group by lpin_lqtarjetacredito.tpliq_enlace";

$rs_enlace = $DB_gogess->executec($lista_retenciones);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array_d;
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["lqtran_cuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_enlace->fields["total"]+$rs_retencionesx->fields["compretdet_valorretenido"];
			$cuenta_lista++;
			
			$rs_enlace->MoveNext();
			
			}
    }
	
	
	
			
print_r($array_haber);	

//crea asiento
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//
	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_principalx="select * from lpin_lqtarjetacredito where ldtc_id='".$ldtc_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["tpliq_ndocumento"]);

$busca_proveed="select * from app_proveedor where provee_id='".$rs_bprincipalx->fields["proveemovban_id"]."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_provnom->fields["provee_nombre"];
//$crb_fecha=$rs_bprincipalx->fields["anti_fechaemision"];

$doccab_anulado=0;

if($tmv_id==1)
{
  $n_tipo='INGRESO';
  
  $TEXTO="VENTAS";
}

if($tmv_id==2)
{
  $n_tipo='EGRESO';
  
  $TEXTO="COMPRAS";
}

$concepto='';
$concepto=$n_tipo.' ANTICIPO '.$TEXTO.' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++
//preguntar se anula la factura se anula pago
$actualiza_data="update lpin_comprobantecontable set tipoa_id='".$tipo_code."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$crb_fecha."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
$rs_actualizdada = $DB_gogess->executec($actualiza_data);

//actualiza comprobante


//===========================================================================

$comcont_enlace=$rs_bcabecera->fields["comcont_enlace"];

$borra_dt="delete from lpin_detallecomprobantecontable where comcont_enlace='".$comcont_enlace."'";
$rs_oktd = $DB_gogess->executec($borra_dt);

for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($array_haber[$i]["TIPO"]=='DEBE')
			{
			$detcc_debe=$array_haber[$i]["VALOR"];
			}
			
			if($array_haber[$i]["TIPO"]=='HABER')
			{
			$detcc_haber=$array_haber[$i]["VALOR"];
			}
	
	        $detcc_cuentacontable='';
	        $detcc_cuentacontable=$array_haber[$i]["CUENTA"];
			
		   //BUSCA CUENTA
		   
		   $busca_dtacuenta="select * from lpin_plancuentas where planc_codigoc='".$detcc_cuentacontable."'";
		   $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);
		   
		   $detcc_descricpion=$rs_bcuenta->fields["planc_nombre"];
		   $detcc_referencia=$rs_bcuenta->fields["planc_nombre"];
		   
		   $comcont_enlace=$rs_bcabecera->fields["comcont_enlace"];
		   
		   //BUSCA CUENTA
		 		 
		 $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura
$busca_principalx="select * from lpin_lqtarjetacredito where ldtc_id='".$ldtc_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["movban_comprobante"]);

$busca_proveed="select * from app_proveedor where provee_id='".$rs_bprincipalx->fields["proveemovban_id"]."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_provnom->fields["provee_nombre"];
$crb_fecha=$rs_bprincipalx->fields["anti_fechaemision"];
$doccab_anulado=0;


$n_tipo='LIQUIDACION TARJETA';
$tipo_code=12;
$TEXTO="LIQUIDACION TARJETA";




$concepto='';
$concepto=$n_tipo.' ANTICIPO PROVEEDOR '.$TEXTO.' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado) VALUES
( '".$tipo_code."', '".$crb_fecha."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."');";

$rs_insertcab = $DB_gogess->executec($inserta_cab);
$id_gen=$DB_gogess->funciones_nuevoID(0);


if($rs_insertcab)
{
//-----------------------------------------

		 for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($array_haber[$i]["TIPO"]=='DEBE')
			{
			$detcc_debe=$array_haber[$i]["VALOR"];
			}
			
			if($array_haber[$i]["TIPO"]=='HABER')
			{
			$detcc_haber=$array_haber[$i]["VALOR"];
			}
	
	        $detcc_cuentacontable='';
	        $detcc_cuentacontable=$array_haber[$i]["CUENTA"];
			
		   //BUSCA CUENTA
		   
		   $busca_dtacuenta="select * from lpin_plancuentas where planc_codigoc='".$detcc_cuentacontable."'";
		   $rs_bcuenta = $DB_gogess->executec($busca_dtacuenta);
		   
		   //echo $busca_dtacuenta."<br>";
		   
		   $detcc_descricpion=$rs_bcuenta->fields["planc_nombre"];
		   $detcc_referencia=$rs_bcuenta->fields["planc_nombre"];
		   
		   //BUSCA CUENTA
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===========================================================================
}





//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//crea asiento	
				
	
	


}

?>
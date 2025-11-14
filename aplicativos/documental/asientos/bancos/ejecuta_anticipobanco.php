<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$anti_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$valor_id=$anti_id;


$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));

//principal
$cuenta_lista=0;
$busca_principal="select * from app_anticipos where anti_id='".$anti_id."'";
$rs_bprincipal = $DB_gogess->executec($busca_principal);

$movantic_id=$rs_bprincipal->fields["movantic_id"];
$tmv_id=$movantic_id;

$busca_printotal="select sum(movanti_monto) as total from app_anticipos inner join lpin_movanticipos on app_anticipos.anti_enlace=lpin_movanticipos.anti_enlace where anti_id='".$anti_id."'";
$rs_bprintotal = $DB_gogess->executec($busca_printotal);
$total=$rs_bprintotal->fields["total"];


$anti_enlace=$rs_bprincipal->fields["anti_enlace"];

$tipomv_array='';
if($tmv_id==1)
{
 $tipomv_array='DEBE';
 $tipomv_array_d='HABER';
 $tipo_code=7;
}

if($tmv_id==2)
{
 $tipomv_array='HABER';
 $tipomv_array_d='DEBE';
 $tipo_code=8;
}

$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array;
$array_haber[$cuenta_lista]["CUENTA"]=$rs_bprincipal->fields["anti_ctabancaria"];
$array_haber[$cuenta_lista]["VALOR"]=$total;
$cuenta_lista++;


//principal
			
$obtiene_enlace="select * from lpin_movanticipos where anti_enlace='".$anti_enlace."'";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]=$tipomv_array_d;
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["plancant_id"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_enlace->fields["movanti_monto"];
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

$busca_principalx="select * from app_anticipos where anti_id='".$anti_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["movban_comprobante"]);

$busca_proveed="select * from app_proveedor where provee_id='".$rs_bprincipalx->fields["proveemovban_id"]."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_provnom->fields["provee_nombre"];
$crb_fecha=$rs_bprincipalx->fields["anti_fechaemision"];
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
$busca_principalx="select * from app_anticipos where anti_id='".$anti_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["movban_comprobante"]);

$busca_proveed="select * from app_proveedor where provee_id='".$rs_bprincipalx->fields["proveemovban_id"]."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_provnom->fields["provee_nombre"];
$crb_fecha=$rs_bprincipalx->fields["anti_fechaemision"];
$doccab_anulado=0;

if($tmv_id==1)
{
  $n_tipo='INGRESO';
  $tipo_code=7;
  $TEXTO="VENTAS";
}

if($tmv_id==2)
{
  $n_tipo='EGRESO';
  $tipo_code=8;
  $TEXTO="COMPRAS";
}

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
			
			
			
///asientos por factura
			

	


}

?>
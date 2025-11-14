<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$acfi_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$nombre_mes=array();

$nombre_mes["01"]="ENERO";
$nombre_mes["02"]="FEBRERO";
$nombre_mes["03"]="MARZO";
$nombre_mes["04"]="ABRIL";
$nombre_mes["05"]="MAYO";
$nombre_mes["06"]="JUNIO";
$nombre_mes["07"]="JULIO";
$nombre_mes["08"]="AGOSTO";
$nombre_mes["09"]="SEPTIEMBRE";
$nombre_mes["10"]="OCTUBRE";
$nombre_mes["11"]="NOVIEMBRE";
$nombre_mes["12"]="DICIEMBRE";


$valor_id=$acfi_id;
$comcont_mes='05';



$number_mes=0;
$number_mes = cal_days_in_month(CAL_GREGORIAN,$comcont_mes,date("Y")); // 31
//echo "There were {$number} days in August 2003";


$fecha_claculomes=date("Y")."-".$comcont_mes."-".$number_mes;


$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];

$cuenta_errormed=0;
$cuenta_errorinsu=0;


$comcont_enlace=strtoupper(uniqid().date("YmdHis"));


$busca_datos="select * from dns_activosfijos where acfi_id='".$valor_id."'";
$rs_bdatis = $DB_gogess->executec($busca_datos);

$total=$rs_bdatis->fields["doccab_total"];
$tiacf_id=$rs_bdatis->fields["tiacf_id"];
$acfi_codigo=$rs_bdatis->fields["acfi_codigo"];
$acfi_valorcompra=$rs_bdatis->fields["acfi_valorcompra"];
$acfi_fechainiciodepre=$rs_bdatis->fields["acfi_fechainiciodepre"];
$pordep_id=$rs_bdatis->fields["pordep_id"];

$categaf_id=$rs_bdatis->fields["categaf_id"];



$busca_porce="select * from lpin_categoriaafijo where categaf_id='".$categaf_id."'";
$rs_porce = $DB_gogess->executec($busca_porce);

$categaf_porcentaje=$rs_porce->fields["categaf_porcentaje"];
$categaf_aniosvida=$rs_porce->fields["categaf_aniosvida"];
//cuenta cliente

//valor del mes 

//tiempo en meses desde la fecha inicio hasta el mes del calculo

$fecha_hoymes='2023-'.$comcont_mes."-31";

$fechainicial = new DateTime($acfi_fechainiciodepre);
$fechafinal = new DateTime($fecha_hoymes);


$diferencia = $fechainicial->diff($fechafinal);

//tiempo en meses desde la fecha inicio hasta el mes del calculo


//$1800 / 33% = 594 cada año
//Y cada mes $49,50

//$valor_depre=(($acfi_valorcompra*$categaf_porcentaje)/100)/12;
$saca_porcentaje=($acfi_valorcompra*$categaf_porcentaje)/100;
$valor_depre=(($acfi_valorcompra-$saca_porcentaje)/$categaf_aniosvida)/12;



$total=$valor_depre;
//cuenta cliente debe
$array_haber=array();
$cuenta_lista=0;

$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id."  and tr_id=1 and actr_id=2";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$total;
			$cuenta_lista++;
			
			$rs_enlace->MoveNext();
			}
    }
//cuenta cliente debe

//Haber

	$array_haber[$cuenta_lista]["TIPO"]="HABER";
	$array_haber[$cuenta_lista]["CUENTA"]='1.2.1.11';
	$array_haber[$cuenta_lista]["VALOR"]=$total;
	$cuenta_lista++;
			



//Haber

print_r($array_haber);
//echo $lista_cuentas;

$num_detasiento=0;
$num_detasiento=count($array_haber);

if($num_detasiento==0)
{

$busca_cabeceraasiento="delete from lpin_comprobantecontable where comcont_mes='".$comcont_mes."' and comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='11'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

}


if($num_detasiento>0)
{
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	
	
echo $busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_mes='".$comcont_mes."' and comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='11'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_datos="select * from dns_activosfijos where acfi_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_datos);

$tiacf_id=$rs_dattos->fields["tiacf_id"];
$acfi_codigo=$rs_dattos->fields["acfi_codigo"];
$acfi_valorcompra=$rs_dattos->fields["acfi_valorcompra"];
$acfi_fechainiciodepre=$rs_dattos->fields["acfi_fechainiciodepre"];
$pordep_id=$rs_dattos->fields["pordep_id"];
$acfi_nombre=$rs_dattos->fields["acfi_nombre"];
$doccab_anulado=0;

$concepto='';
$concepto='DEPRECIACION ACTIVO FIJO. MES: '.$nombre_mes[$comcont_mes].' CODIGO:'.$acfi_codigo.' '.$acfi_nombre.' ';
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++

$actualiza_data="update lpin_comprobantecontable set comcont_anulado='".$doccab_anulado."',comcont_fecha='".$fecha_claculomes."',comcont_concepto='".$concepto."',comcont_numeroc='".$acfi_codigo."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
			
			$detcc_tipo=$array_haber[$i]["TIPO"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura

$busca_datos="select * from dns_activosfijos where acfi_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_datos);

$tiacf_id=$rs_dattos->fields["tiacf_id"];
$acfi_codigo=$rs_dattos->fields["acfi_codigo"];
$acfi_valorcompra=$rs_dattos->fields["acfi_valorcompra"];
$acfi_fechainiciodepre=$rs_dattos->fields["acfi_fechainiciodepre"];
$pordep_id=$rs_dattos->fields["pordep_id"];
$acfi_nombre=$rs_dattos->fields["acfi_nombre"];
$doccab_anulado=0;

$concepto='';
//$concepto='DEPRECIACION ACTIVO FIJO. '.$acfi_codigo.' '.$acfi_nombre.' ';
$concepto='DEPRECIACION ACTIVO FIJO. MES: '.$nombre_mes[$comcont_mes].' CODIGO:'.$acfi_codigo.' '.$acfi_nombre.' ';
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

echo $inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_mes) VALUES
( '11', '".$fecha_claculomes."', '".$concepto."', '".$acfi_codigo."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','".$comcont_mes."');";

$rs_insertcab = $DB_gogess->executec($inserta_cab);
$id_gen=$DB_gogess->funciones_nuevoID(0);


if($rs_insertcab)
{
//-----------------------------------------

		 for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			$detcc_tipo=$array_haber[$i]["TIPO"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===========================================================================
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}

//inventarios+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++




//inventarios+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	



}

?>
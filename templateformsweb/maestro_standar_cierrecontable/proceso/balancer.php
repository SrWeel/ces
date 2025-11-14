<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$fecha_i=@$_POST["fecha_inicio"];
$fecha_f=@$_POST["fecha_fin"];
$cierre_id=$_POST["cierre_id"];

$sacaanio=array();
$sacaanio=explode("-",$fecha_f);

$comcont_balance='ER';

$fecha = new DateTime($fecha_f); // Fecha inicial
$fecha->modify('+1 day'); // Sumar un día

$fecha_aciento=$fecha->format('Y-m-d');

$sql1="";
$sql2="";
$sql3="";
$sql4="";
$sql5="";
$suma_valores=0;

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));

$documento='';

function busca_conarbol($cuenta,$DB_gogess)
{
    $busca_detalles="select count(*) as total from lpin_plancuentas_vista where  planc_codigocp like '".$cuenta.".%'";
	$rs_stotales = $DB_gogess->executec($busca_detalles,array());
    return $rs_stotales->fields["total"]-1;
}

if($fecha_i!='' and $fecha_f!='')
{
   $sql3=" comcont_fecha>='".$fecha_i."' and comcont_fecha<='".$fecha_f."' and ";
}  
else
{
  
  if($fecha_i!='' and $fecha_f=='')
  {  
    $sql3=" comcont_fecha>='".$fecha_i."' and ";
  }
  else
  {
    if($fecha_i=='' and $fecha_f!='')
	{
	   $sql3=" comcont_fecha<='".$fecha_f."' and ";  
    }
  }

}  


$concatena_sql=$sql1.$sql2.$sql3.$sql4.$sql5;
$concatena_sql=substr($concatena_sql,0,-4);

//generando valores para crear cuentas

$listadiario="select * from lpin_plancuentas where planc_codigo in (4,5) order by planc_orden asc";

//echo $lista_doc;
$suma_cuentas=array();
$total_haber=0;
$detcc_debe=0;
$cuenta_lista=0;

$array_haber=array();

$rs_listadiario = $DB_gogess->executec($listadiario,array());
$ib=0;
 if($rs_listadiario)
 {
     while (!$rs_listadiario->EOF) {	
	 // and tipoa_id=6
	 

	 $sumatotales="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '".$rs_listadiario->fields["planc_codigoc"].".%' and comcont_anulado=0";
	 echo $sumatotales."<br>";
	 $rs_stotales = $DB_gogess->executec($sumatotales,array());
	 $total_data=0;
	 $total_data=$rs_stotales->fields["totales"];
	 
	 if($total_data!=0)
			{	 
	 
	 $cantidadd_valor=0;
	 $cantidadd_valor=busca_conarbol($rs_listadiario->fields["planc_codigoc"],$DB_gogess);
	 
	 $negritai='';
	 $negritaf='';
	 
	 if($cantidadd_valor>0)
	 {
	   $negritai='<b>';
	   $negritaf='</b>';	 
	 }	 
	 
	 $signo='1';
	 $stilo_data='';
	 if($rs_listadiario->fields["planc_codigo"]==1)
	 {		 
		 if($total_data<0)
		 {
		   $stilo_data=' style="color:#FF0000" ';
		   $signo='-1';
		 }
	 }
	 
	  if($rs_listadiario->fields["planc_codigo"]==2 or $rs_listadiario->fields["planc_codigo"]==3)
	 {		 
		 if($total_data>0)
		 {
		   $stilo_data=' style="color:#FF0000" ';
		   $signo='-1';
		 }
	 }
	 
	 
	 $valor_data=0;		
     $valor_data=abs($total_data)*$signo;	 			

	 if($negritai=='')
	 {
	 
	 if($rs_listadiario->fields["planc_codigo"]==4)
	 {
	 $array_haber[$cuenta_lista]["TIPO"]="DEBE";
     $array_haber[$cuenta_lista]["CUENTA"]=$rs_listadiario->fields["planc_codigoc"];
     $array_haber[$cuenta_lista]["VALOR"]=round($valor_data, 2);
	 }

	 if($rs_listadiario->fields["planc_codigo"]==5)
	 {
	 $array_haber[$cuenta_lista]["TIPO"]="HABER";
     $array_haber[$cuenta_lista]["CUENTA"]=$rs_listadiario->fields["planc_codigoc"];
     $array_haber[$cuenta_lista]["VALOR"]=round($valor_data, 2);
	 }



	 $cuenta_lista++;
	  
	}
	 
    
	 
	 }
	 
	$suma_valores=$suma_valores+number_format($total_data, 2, '.', '');

	$rs_listadiario->MoveNext();	
		} 
 
 }  


$suma_ingresos="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '4.%' and comcont_anulado=0";
$rs_ingresos = $DB_gogess->executec($suma_ingresos,array());

$suma_g="select round(sum(detcc_debe - detcc_haber),2) as totales from lpin_detallecomprobantecontable_vista where ".$concatena_sql." and detcc_cuentacontablep like '5.%' and comcont_anulado=0";
$rs_g = $DB_gogess->executec($suma_g,array());

$resultado_eje=abs($rs_ingresos->fields["totales"])-abs($rs_g->fields["totales"]);

$array_haber[$cuenta_lista]["TIPO"]="HABER";
$array_haber[$cuenta_lista]["CUENTA"]="3.1.7.1";
$array_haber[$cuenta_lista]["VALOR"]=round($resultado_eje, 2);

@print_r($array_haber);

@$activo_valor=$suma_cuentas["1"];
@$pasivos_valor=$suma_cuentas["2"];
@$patrimonio_valor=$suma_cuentas["3"];

$p_p=$pasivos_valor+$patrimonio_valor;

//generando vbalores para crear cuentas

//crea asiento
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

$tabla_asiento="dns_cierrecontable";
$valor_id=$cierre_id;
$tipo_code='9';

$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='".$tipo_code."' and comcont_balance='".$comcont_balance."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante
//++++++++++++++++++++++++++
//concepto factura

$busca_principalx="select * from dns_cierrecontable where cierre_id='".$cierre_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["cierre_anio"]);

$doccab_nombrerazon_cliente='';
$crb_fecha=$fecha_aciento;
$doccab_anulado=0;


$concepto='';
$concepto=' CIERRE CONTABLE '.$comcont_balance.' '.$sacaanio[0].' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++
//preguntar se anula la factura se anula pago
$actualiza_data="update lpin_comprobantecontable set comcont_anulado='".$doccab_anulado."',comcont_fecha='".$crb_fecha."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
		 		 
		 $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_cierre) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."','1') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura
$busca_principalx="select * from dns_cierrecontable where cierre_id='".$cierre_id."'";
$rs_bprincipalx = $DB_gogess->executec($busca_principalx);
$doccab_ndocumento=str_replace("'","",$rs_bprincipalx->fields["cierre_anio"]);

$doccab_nombrerazon_cliente='';
$crb_fecha=$fecha_aciento;
$doccab_anulado=0;

$concepto='';
$concepto=' CIERRE CONTABLE '.$comcont_balance.' '.$sacaanio[0].' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_balance) VALUES
( '".$tipo_code."', '".$crb_fecha."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','".$comcont_balance."');";

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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_cierre) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$crb_fecha."','".$comcont_enlace."','1') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===========================================================================
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//crea asiento	




?>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();



if($_SESSION['ces1313777_sessid_inicio'])
{

$crudoc_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$valor_id=$crudoc_id;


$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];



//principal
$busca_principal="select * from lpin_crucedocumentos where crudoc_id='".$crudoc_id."'";
$rs_bprincipal = $DB_gogess->executec($busca_principal);
//$doccab_id=$rs_bprincipal->fields["doccab_id"];
//principal






//borra los que ya no existen
$busca_listabrrado="select cruant_id from lpin_crucedocumentos inner join cesdb_arextension.lpin_cruceanticipos on lpin_crucedocumentos.crudoc_enlace=cesdb_arextension.lpin_cruceanticipos.crudoc_enlace where crudoc_id='".$crudoc_id."'";

$asiento_elimina="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='7' and cruant_id not in (".$busca_listabrrado.")";
//$rs_aeli = $DB_gogess->executec($asiento_elimina);
//borra los que ya no existen

$busca_cobros="select * from lpin_crucedocumentos inner join cesdb_arextension.lpin_cruceanticipos on lpin_crucedocumentos.crudoc_enlace=cesdb_arextension.lpin_cruceanticipos.crudoc_enlace inner join lpin_ttransac on lpin_crucedocumentos.crudoc_tipotransaccion=lpin_ttransac.ttra_id inner join app_anticipos on app_anticipos.anti_id=lpin_cruceanticipos.cruant_anticipo where crudoc_id='".$crudoc_id."'";

$rs_bcobros = $DB_gogess->executec($busca_cobros);

	if($rs_bcobros)
	{
	   while (!$rs_bcobros->EOF) 
			{
			
			
//busca cuenta anticipo

$busca_canti="select * from app_anticipos inner join lpin_movanticipos on app_anticipos.anti_enlace=lpin_movanticipos.anti_enlace where anti_id='".$rs_bcobros->fields["cruant_anticipo"]."'";
$rs_canti = $DB_gogess->executec($busca_canti);

$plancant_id=$rs_canti->fields["plancant_id"];


//busca cuenta anticipo
			

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));			
///asientos por factura
$cuenta_lista=0;	
$array_haber=array();		
$total=$rs_bcobros->fields["cruant_valorpago"];	
$cruant_id=$rs_bcobros->fields["cruant_id"];
$compracp_id=$rs_bcobros->fields["crudoc_ndocumentoventa"];

//detalle asiento
$array_haber[$cuenta_lista]["TIPO"]="HABER";
$array_haber[$cuenta_lista]["CUENTA"]=$plancant_id;
$array_haber[$cuenta_lista]["VALOR"]=$total;
$cuenta_lista++;
//detalle asiento	

$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=183 and tr_id=1 and actr_id=1";
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
	
	
	
			
print_r($array_haber);		


for($ival=0;$ival<count($array_haber);$ival++)
{

//===============================================================
if($array_haber[$ival]["TIPO"]=='DEBE')
{
$suma_total1=$suma_total1+$array_haber[$ival]["VALOR"];
}

if($array_haber[$ival]["TIPO"]=='HABER')
{
$suma_total2=$suma_total2+$array_haber[$ival]["VALOR"];
}

//===============================================================


}

if(trim($suma_total1)==trim($suma_total2))
{

  echo 'Estado suma OK<br>';
  echo '<b>Total Debe: </b>'.$suma_total1.'<br>';
  echo '<b>Total Haber: </b>'.$suma_total2.'<br><br>';

}
else
{

   echo '<div style="color:#FF0000">Estado suma error:<br>';
   echo '<b>Total Debe: </b>'.$suma_total1.'<br>';
   echo '<b>Total Haber: </b>'.$suma_total2.'<br><br></div>';  

}


$num_detasiento=0;
$num_detasiento=count($array_haber);	
	
//crea asiento
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if($num_detasiento==0)
{

 $busca_cabeceraasiento="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='7' and comcont_tablas='beko_documentocabecera' and comcont_idtablas='".$rs_bcobros->fields["crudoc_ndocumentoventa"]."' and cruant_id='".$rs_bcobros->fields["cruant_id"]."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

}


if($num_detasiento>0)
{
//si hay asiento

	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='7' and comcont_tablas='beko_documentocabecera' and comcont_idtablas='".$rs_bcobros->fields["crudoc_ndocumentoventa"]."' and cruant_id='".$rs_bcobros->fields["cruant_id"]."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_dattoscobro="select * from lpin_crucedocumentos inner join lpin_ttransac on lpin_crucedocumentos.ttra_id=lpin_ttransac.ttra_id where crudoc_id='".$valor_id."'";
$rs_dattoscobro = $DB_gogess->executec($busca_dattoscobro);

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$rs_bcobros->fields["crudoc_ndocumentoventa"]."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$proveeve_id=$rs_dattos->fields["proveeve_id"];

$busca_proveed="select * from app_proveedor where provee_id='".$proveeve_id."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];

$doccab_apellidorazon_cliente='';
$doccab_total=$total;
//$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];
$doccab_anulado=$rs_dattos->fields["doccab_anulado"];
$cruant_fechaemision=$rs_bcobros->fields["cruant_fechaemision"];

$concepto='';
$concepto='ING. COBRO. CRUCE ANTICIPO'.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++
//preguntar se anula la factura se anula pago
$actualiza_data="update lpin_comprobantecontable set comcont_idtablas='".$rs_bcobros->fields["crudoc_ndocumentoventa"]."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$cruant_fechaemision."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
		 		 
		  $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".date("Y-m-d H:i:s")."','".$comcont_enlace."','".$detcc_tipo."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura
$busca_dattoscobro="select * from lpin_crucedocumentos inner join lpin_ttransac on lpin_crucedocumentos.ttra_id=lpin_ttransac.ttra_id where crudoc_id='".$valor_id."'";
$rs_dattoscobro = $DB_gogess->executec($busca_dattoscobro);

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$rs_bcobros->fields["crudoc_ndocumentoventa"]."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$proveeve_id=$rs_dattos->fields["proveeve_id"];

$busca_proveed="select * from app_proveedor where provee_id='".$proveeve_id."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];

$doccab_apellidorazon_cliente='';
$doccab_total=$total;
//$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];
$doccab_anulado=$rs_dattos->fields["doccab_anulado"];
$cruant_fechaemision=$rs_bcobros->fields["cruant_fechaemision"];
$concepto='';
$concepto='ING. COBRO. CRUCE ANTICIPO'.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_tablas,comcont_idtablas,cruant_id) VALUES
( '7', '".$cruant_fechaemision."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','beko_documentocabecera','".$rs_bcobros->fields["crudoc_ndocumentoventa"]."','".$cruant_id."');";

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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".date("Y-m-d H:i:s")."','".$comcont_enlace."','".$detcc_tipo."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===========================================================================
}



//si hay asiento
}


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//crea asiento	
			
			
			
///asientos por factura
			
			
			  $rs_bcobros->MoveNext();
			}
			
	}		
	
	
	
	
	


}

?>
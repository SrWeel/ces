<?php
$valor_id=$crb_idbu;

$nombre_campoid='crb_id';
$tabla_asiento='lpin_cobropago';
$mnupan_id='183';




//principal
$busca_principal="select * from lpin_cobropago where crb_id='".$crb_idbu."'";
$rs_bprincipal = $DB_gogess->executec($busca_principal);
$doccab_id=$rs_bprincipal->fields["doccab_id"];
//principal

//borra los que ya no existen
$busca_listabrrado="select crpadet_id from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where crb_id='".$crb_idbu."'";
$asiento_elimina="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='7' and crpadet_id not in (".$busca_listabrrado.")";
//$rs_aeli = $DB_gogess->executec($asiento_elimina);
//borra los que ya no existen


$busca_cobros="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace inner join lpin_ttransac on lpin_cobropago.ttra_id=lpin_ttransac.ttra_id where crb_id='".$crb_idbu."'";
$rs_bcobros = $DB_gogess->executec($busca_cobros);

	if($rs_bcobros)
	{
	   while (!$rs_bcobros->EOF) 
			{

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));			
///asientos por factura
$cuenta_lista=0;	
$array_haber=array();		
$total=$rs_bcobros->fields["crpadet_valorapagar"];	

$crpadet_id=$rs_bcobros->fields["crpadet_id"];

$doccabcp_id=$rs_bcobros->fields["doccabcp_id"];


$frocob_id=$rs_bcobros->fields["frocob_id"];	
$cuentb_id=$rs_bcobros->fields["cuentb_id"];

if($frocob_id==3)
{


$busca_principalcc="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_id."'";
$rs_bprincipalcc = $DB_gogess->executec($busca_principalcc);

$cuenta_selecciona=$rs_bprincipalcc->fields["cuentb_cuentacontable"];
}
else
{

$cuenta_selecciona=$rs_bcobros->fields["crb_cuenta"];

}

//detalle asiento
$array_haber[$cuenta_lista]["TIPO"]="DEBE";
$array_haber[$cuenta_lista]["CUENTA"]=$cuenta_selecciona;
$array_haber[$cuenta_lista]["VALOR"]=$total;
$cuenta_lista++;
//detalle asiento	

			
$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id." and ttra_id=2 and tr_id=1 and actr_id=1";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$total;
			$cuenta_lista++;
			
			$rs_enlace->MoveNext();
			
			}
    }
	
	
	
			
	print_r($array_haber);		
	
	
//crea asiento
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='7' and comcont_tablas='beko_documentocabecera' and comcont_idtablas='".$rs_bcobros->fields["doccabcp_id"]."' and crpadet_id='".$rs_bcobros->fields["crpadet_id"]."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_dattoscobro="select * from lpin_cobropago inner join lpin_ttransac on lpin_cobropago.ttra_id=lpin_ttransac.ttra_id where crb_id='".$valor_id."'";
$rs_dattoscobro = $DB_gogess->executec($busca_dattoscobro);

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$rs_bcobros->fields["doccabcp_id"]."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["doccab_apellidorazon_cliente"];
$doccab_total=$total;
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];
$doccab_anulado=$rs_dattos->fields["doccab_anulado"];
$crb_fecha=$rs_bcobros->fields["crb_fecha"];

$concepto='';
$concepto='ING. VENTA. '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++
//preguntar se anula la factura se anula pago
$actualiza_data="update lpin_comprobantecontable set comcont_idtablas='".$rs_bcobros->fields["doccabcp_id"]."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$crb_fecha."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
$busca_dattoscobro="select * from lpin_cobropago inner join lpin_ttransac on lpin_cobropago.ttra_id=lpin_ttransac.ttra_id where crb_id='".$valor_id."'";
$rs_dattoscobro = $DB_gogess->executec($busca_dattoscobro);

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$rs_bcobros->fields["doccabcp_id"]."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);


$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["doccab_apellidorazon_cliente"];
$doccab_total=$total;
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];
$doccab_anulado=$rs_dattos->fields["doccab_anulado"];

$crb_fecha=$rs_bcobros->fields["crb_fecha"];

$concepto='';
$concepto='ING. VENTA. '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,comcont_tablas,comcont_idtablas,crpadet_id) VALUES
( '7', '".$crb_fecha."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','beko_documentocabecera','".$rs_bcobros->fields["doccabcp_id"]."','".$crpadet_id."');";

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





//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//crea asiento	
			
			
			
///asientos por factura
			
			
			  $rs_bcobros->MoveNext();
			}
			
	}		
?>	
	
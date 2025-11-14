<?php

function genera_asientodescargo($precu_id,$detapre_id,$DB_gogess)
{
//===================================================================descargo
$valor_id=$precu_id;
$nombre_campoid='precu_id';
$tabla_asiento='dns_precuenta';
$mnupan_id='0';

$cuenta_errormed=0;
$cuenta_errorinsu=0;


$comcont_enlace=strtoupper(uniqid().date("YmdHis"));
$perioc_id=0;
$busca_formulax1="select * from lpin_periodocontable where perioc_activo=1";
$rs_formulax1 = $DB_gogess->executec($busca_formulax1); 
$perioc_plasticos=$rs_formulax1->fields["perioc_plasticos"];
$perioc_convenioispol=$rs_formulax1->fields["perioc_convenioispol"];
$perioc_nenora100=$rs_formulax1->fields["perioc_nenora100"];
$perioc_mayorigual100=$rs_formulax1->fields["perioc_mayorigual100"];
$array_haber=array();
$cuenta_lista=0;
$total_precicosto=0;



///lista descargos en la precuenta
$lista_productosx="select * from dns_precuenta inner join dns_detalleprecuenta on dns_precuenta.precu_id=dns_detalleprecuenta.precu_id inner join dns_cuadrobasicomedicamentos on dns_detalleprecuenta.detapre_codigop=dns_cuadrobasicomedicamentos.cuadrobm_codigoatc where dns_precuenta.precu_id='".$valor_id."' and detapre_id='".$detapre_id."'  and dns_detalleprecuenta.centrob_id not in (55,9999,8888) ";
$rs_prdx = $DB_gogess->executec($lista_productosx);

	if($rs_prdx)
	{
	   while (!$rs_prdx->EOF) 
			{


$comcont_enlace=strtoupper(uniqid().date("YmdHis"));
//=========================================================================================================
$detapre_id=$rs_prdx->fields["detapre_id"];

$array_haber=array();
$cuenta_lista=0;



$total_precicosto=0;

$lista_cuentas='';
$lista_productos="select * from dns_precuenta inner join dns_detalleprecuenta on dns_precuenta.precu_id=dns_detalleprecuenta.precu_id inner join dns_cuadrobasicomedicamentos on dns_detalleprecuenta.detapre_codigop=dns_cuadrobasicomedicamentos.cuadrobm_codigoatc where dns_precuenta.precu_id='".$valor_id."' and detapre_id='".$rs_prdx->fields["detapre_id"]."'";
$rs_prd = $DB_gogess->executec($lista_productos);

	if($rs_prd)
	{
	   while (!$rs_prd->EOF) 
			{
			
			$precio_costo=round(($rs_prd->fields["detapre_precio"]*$rs_prd->fields["detapre_cantidad"]),2);			
			$categ_id=$rs_prd->fields["categ_id"];
			
			$busca_cuenta="select * from dns_categoriadns where categ_id='".$categ_id."'";
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);	
			
				
			$array_haber[$cuenta_lista]["detapre_id"]=$rs_prd->fields["detapre_id"];
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["categ_cuentacosto"];
			$array_haber[$cuenta_lista]["VALOR"]=round(($precio_costo),2);
			$cuenta_lista++;
			$array_haber[$cuenta_lista]["detapre_id"]=$rs_prd->fields["detapre_id"];
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["categ_cuentacontable"];
			$array_haber[$cuenta_lista]["VALOR"]=round(($precio_costo),2);			
			$cuenta_lista++;
			
			
			$rs_prd->MoveNext();
			}
	}		



//print_r($array_haber);

$num_detasiento=0;
$num_detasiento=count($array_haber);

//echo "<br><br>";

if($num_detasiento==0)
{

$busca_cabeceraasiento="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='4' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

}

if($num_detasiento>0)
{

//========================datos para comporbante===================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where precu_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);
$doccab_ndocumento=str_pad($rs_dattos->fields["precu_id"], 10, "0", STR_PAD_LEFT);
$doccab_nombrerazon_cliente=$rs_dattos->fields["clie_nombre"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["clie_apellido"];
$clie_rucci=$rs_dattos->fields["clie_rucci"];

//fecha
$busca_fecha="select * from dns_detalleprecuenta where 	detapre_id='".$detapre_id."'";
$rs_fechadesc = $DB_gogess->executec($busca_fecha);
//fecha
$fecha_asiento=$rs_fechadesc->fields["detapre_fecharegistro"];
$detapre_codigop=$rs_fechadesc->fields["detapre_codigop"];
$detapre_detalle=$rs_fechadesc->fields["detapre_detalle"];

$doccab_fechaemision_cliente=$fecha_asiento;
$doccab_anulado=0;

$concepto='';
$concepto='INVENTARIO . PRECUENTA:'.$doccab_ndocumento.' CI: '.$clie_rucci.' - '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente.' '.$detapre_codigop.' '.$detapre_detalle;

//concepto factura
//++++++++++++++++++++++++++


//========================datos para comporbante===================================
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='4' and comcont_tablas='dns_detalleprecuenta' and comcont_idtablas='".$detapre_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

$actualiza_data="update lpin_comprobantecontable set detapre_id='".$detapre_id."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$doccab_fechaemision_cliente."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
$rs_actualizdada = $DB_gogess->executec($actualiza_data);



//===========================================================================
$comcont_enlace=$rs_bcabecera->fields["comcont_enlace"];

$borra_dt="delete from lpin_detallecomprobantecontable where comcont_enlace='".$comcont_enlace."'";
$rs_oktd = $DB_gogess->executec($borra_dt);

for($i=0;$i<count($array_haber);$i++)
		 {
		    
			$detcc_debe=0;
			$detcc_haber=0;
			
			$detcc_tipo=$array_haber[$i]["TIPO"];
			$detapre_id=$array_haber[$i]["detapre_id"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo,detapre_id) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."','".$detapre_id."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
//===========================================================================





//actualiza comprobante



}
else
{

//inserta comprobante


//=================================================================================
$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,detapre_id,comcont_tablas,comcont_idtablas) VALUES
( '4', '".$doccab_fechaemision_cliente."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','".$detapre_id."','dns_detalleprecuenta','".$detapre_id."');";

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
			$detapre_id=$array_haber[$i]["detapre_id"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo,detapre_id) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."','".$detapre_id."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
				
		
//-----------------------------------------			
}

//===============================================================================



//inserta comprobante


}







}



			
			  
//=========================================================================================================			  
			
			  $rs_prdx->MoveNext();
			}
	}		
///lista descargos en la precuenta











//===================================================================descargo
}

?>
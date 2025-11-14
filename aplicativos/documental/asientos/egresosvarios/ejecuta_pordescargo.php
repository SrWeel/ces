<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$egrec_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$valor_id=$egrec_id;

$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];

$cuenta_errormed=0;
$cuenta_errorinsu=0;



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
$lista_productosx="select *,dns_temporaldespacho.tempdsp_id as tempdsp_idlista from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$valor_id."'";
$rs_prdx = $DB_gogess->executec($lista_productosx);

	if($rs_prdx)
	{
	   while (!$rs_prdx->EOF) 
			{


$comcont_enlace=strtoupper(uniqid().date("YmdHis"));
//=========================================================================================================
$tempdsp_id=$rs_prdx->fields["tempdsp_idlista"];

$array_haber=array();
$cuenta_lista=0;



$total_precicosto=0;

$lista_cuentas='';
$lista_productos="select *,dns_temporaldespacho.tempdsp_id as tempdsp_idlista from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id inner join dns_principalmovimientoinventario on dns_temporaldespacho.moviin_id=dns_principalmovimientoinventario.moviin_id where dns_temporaldespacho.egrec_id='".$valor_id."' and dns_temporaldespacho.tempdsp_id='".$rs_prdx->fields["tempdsp_idlista"]."'";


$rs_prd = $DB_gogess->executec($lista_productos);

	if($rs_prd)
	{
	   while (!$rs_prd->EOF) 
			{
			
			$precio_costo=round(($rs_prd->fields["moviin_preciocompra"]*$rs_prd->fields["cantidad_val"]),2);			
			$categ_id=$rs_prd->fields["categ_id"];
			
			$busca_cuenta="select * from dns_categoriadns where categ_id='".$categ_id."'";
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);	
			
				
			$array_haber[$cuenta_lista]["tempdsp_id"]=$rs_prd->fields["tempdsp_idlista"];
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["categ_cuentacosto"];
			$array_haber[$cuenta_lista]["VALOR"]=round(($precio_costo),2);
			$cuenta_lista++;
			$array_haber[$cuenta_lista]["tempdsp_id"]=$rs_prd->fields["tempdsp_idlista"];
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

$busca_cabeceraasiento="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='4' and comcont_tablas='dns_temporaldespacho' and comcont_idtablas='".$tempdsp_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

}

if($num_detasiento>0)
{

//========================datos para comporbante===================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from dns_egresocentros  where egrec_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);
$doccab_ndocumento=str_pad($rs_dattos->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
$doccab_nombrerazon_cliente=$rs_dattos->fields["egrec_responsableentrega"];
$egrec_personalrecibe=$rs_dattos->fields["egrec_personalrecibe"];
$doccab_apellidorazon_cliente='';
$clie_rucci=$rs_dattos->fields["egrec_cedula"];

//fecha
$busca_fecha="select * from dns_temporaldespacho inner join dns_cuadrobasicomedicamentos on dns_temporaldespacho.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where tempdsp_id='".$tempdsp_id."'";
$rs_fechadesc = $DB_gogess->executec($busca_fecha);
//fecha
$fecha_asiento=$rs_fechadesc->fields["tempdsp_fecharegistro"];
$detapre_codigop=$rs_fechadesc->fields["cuadrobm_codigoatc"];
$detapre_detalle=$rs_fechadesc->fields["cuadrobm_principioactivo"];

$doccab_fechaemision_cliente=$fecha_asiento;
$doccab_anulado=0;

$concepto='';
$concepto='INVENTARIO . EGRESOS VARIOS:'.$doccab_ndocumento.' CI: '.$clie_rucci.' - '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente.' '.$detapre_codigop.' '.$detapre_detalle.' PRESONAL RECIBE: '.$egrec_personalrecibe;

//concepto factura
//++++++++++++++++++++++++++


//========================datos para comporbante===================================
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='4' and comcont_tablas='dns_temporaldespacho' and comcont_idtablas='".$tempdsp_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

$actualiza_data="update lpin_comprobantecontable set tempdsp_id='".$tempdsp_id."',comcont_anulado='".$doccab_anulado."',comcont_fecha='".$doccab_fechaemision_cliente."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
			$tempdsp_id=$array_haber[$i]["tempdsp_id"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo,tempdsp_id) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."','".$tempdsp_id."') ";
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

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,comcont_anulado,tempdsp_id,comcont_tablas,comcont_idtablas) VALUES
( '4', '".$doccab_fechaemision_cliente."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$doccab_anulado."','".$tempdsp_id."','dns_temporaldespacho','".$tempdsp_id."');";

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
			$tempdsp_id=$array_haber[$i]["tempdsp_id"];
			
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo,tempdsp_id) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."','".$detcc_tipo."','".$tempdsp_id."') ";
			 
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





}
?>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$compra_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$valor_id=$compra_id;
$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];

$comcont_enlace=strtoupper(uniqid().date("YmdHis"));
$busca_datos="select * from dns_compras where compra_id='".$valor_id."'";
$rs_bdatis = $DB_gogess->executec($busca_datos);

$total=$rs_bdatis->fields["compra_total"];

$compra_nfactura=$rs_bdatis->fields["compra_nfactura"];
$proveevar_id=$rs_bdatis->fields["proveevar_id"];
$compra_total=$rs_bdatis->fields["compra_total"];
$compra_fecha=$rs_bdatis->fields["compra_fecha"];
$compra_enlace=$rs_bdatis->fields["compra_enlace"];

$compra_anulado=$rs_bdatis->fields["compra_anulado"];

$array_haber=array();
$cuenta_lista=0;
//retencion en ventas

$lista_rentac="select sum(compretdet_valorretenido) as totalretencion from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id  where compra_id='".$compra_id."'";
$rs_listadatac = $DB_gogess->executec($lista_rentac,array());


//busca si va al gasto

$lista_rentacgasto="select compretdet_gasto,compretcab_anulado from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id  where compra_id='".$compra_id."'";
$rs_listadatacgasto = $DB_gogess->executec($lista_rentacgasto,array());

$esgasto=$rs_listadatacgasto->fields["compretdet_gasto"];
echo $compretcab_anulado=$rs_listadatacgasto->fields["compretcab_anulado"];

echo "Gasto:".$esgasto;
//busca si va al gasto

if ($rs_listadatac->fields["totalretencion"]>0)
{

$lista_renta="select * from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id  where compra_id='".$compra_id."'";

$rs_listadata = $DB_gogess->executec($lista_renta,array());
if($rs_listadata)
 {
	  while (!$rs_listadata->EOF) {	
	  
	  $cuenta='';
	  $ntipo='';  
	  
	  $porcentaje_id=$rs_listadata->fields["porcentaje_id"];	  
	  $busca_cuental="select * from factur_porcentajes where porce_codigo='".$porcentaje_id."'";
	  $rs_lcuenta = $DB_gogess->executec($busca_cuental,array());
	  
	  $cuenta=$rs_lcuenta->fields["porce_cuentacompra"];  
	  
	  //$busca_cuenta="select * from factur_impuestorenta where id_impuesto='".$rs_listadata->fields["impur_id"]."'";
	  //$rs_cuenta = $DB_gogess->executec($busca_cuenta,array());	  
	  //$cuenta=$rs_cuenta->fields["impur_cuenta"];   
	  if($esgasto==1)
	  {
	  $array_haber[$cuenta_lista]["TIPO"]="DEBE";
	  //
	    $obtiene_enlaceg="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id."  and actr_id=11";
        $rs_enlaceg = $DB_gogess->executec($obtiene_enlaceg);
		$cuenta=$rs_enlaceg->fields["enlacuenta_numerocuenta"];
	  //
	  }
	  else
	  {
	  $array_haber[$cuenta_lista]["TIPO"]="HABER";
	  }
	  
	  $array_haber[$cuenta_lista]["CUENTA"]=$cuenta;
	  $array_haber[$cuenta_lista]["VALOR"]=$rs_listadata->fields["compretdet_valorretenido"];

	  $cuenta_lista++;
	  

         $rs_listadata->MoveNext();
	  }
  }	

}
//retencion en ventas

//cuenta cliente
$lista_rentac="select sum(compretdet_valorretenido) as totalretencion from comprobante_retencion_cab inner join comprobante_retencion_detalle on comprobante_retencion_cab.compretcab_id=comprobante_retencion_detalle.compretcab_id  where compra_id='".$compra_id."'";
$rs_listadatac = $DB_gogess->executec($lista_rentac,array());

if ($rs_listadatac->fields["totalretencion"]>0)
{
//valor retenciones


$total=$rs_listadatac->fields["totalretencion"];
//cuenta cliente debe


$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id."  and tr_id=2 and actr_id=8";

$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
		   if($esgasto==1)
	       {
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
		   }
		   else
		   {
		    $array_haber[$cuenta_lista]["TIPO"]="DEBE";
		   }	
			
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$total;
			$cuenta_lista++;
			
			$rs_enlace->MoveNext();
			}
    }
//cuenta cliente debe






//valor retenciones
}


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

if($num_detasiento==0)
{

$busca_cabeceraasiento="delete from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='5'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

}

if ($rs_listadatac->fields["totalretencion"]>0)
{
//si hay retencion
print_r($array_haber);
//echo $lista_cuentas;

	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='5'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from dns_compras inner join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where compra_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["compra_nfactura"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["provee_nombre"];
$doccab_apellidorazon_cliente='';
$doccab_total='';
$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];


$lista_valorretencion="select * from comprobante_retencion_cab where compra_id='".$compra_id."' and compretcab_anulado!='1'";
$rs_valorretencion = $DB_gogess->executec($lista_valorretencion);

$doccab_retnumdoc=$rs_valorretencion->fields["compretcab_nretencion"];
$doccab_retfechaemision=$rs_valorretencion->fields["compretcab_fechaemision_cliente"];


$concepto='';
$concepto='RETENCION COMPRA. '.$doccab_retnumdoc.' FECHA:'.$doccab_retfechaemision.' COMPRA:'.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++

 $actualiza_data="update lpin_comprobantecontable set comcont_anulado='".$compretcab_anulado."',proveeasiento_id='".$proveevar_id."',comcont_fecha='".$doccab_retfechaemision."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_retnumdoc."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_retfechaemision."','".$comcont_enlace."','".$detcc_tipo."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from dns_compras inner join app_proveedor on dns_compras.proveevar_id=app_proveedor.provee_id where compra_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["compra_nfactura"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["provee_nombre"];
$doccab_apellidorazon_cliente='';
$doccab_total='';
$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];

$lista_valorretencion="select * from comprobante_retencion_cab where compra_id='".$compra_id."' and compretcab_anulado!='1'";
$rs_valorretencion = $DB_gogess->executec($lista_valorretencion);

$doccab_retnumdoc=$rs_valorretencion->fields["compretcab_nretencion"];
$doccab_retfechaemision=$rs_valorretencion->fields["compretcab_fechaemision_cliente"];


$concepto='';
$concepto='RETENCION COMPRA. '.$doccab_retnumdoc.' FECHA:'.$doccab_retfechaemision.' COMPRA:'.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs,proveeasiento_id,comcont_anulado) VALUES
( 5, '".$doccab_retfechaemision."', '".$concepto."', '".$doccab_retnumdoc."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO','".$proveevar_id."','".$compretcab_anulado."');";

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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace,detcc_tipo) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_retfechaemision."','".$comcont_enlace."','".$detcc_tipo."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 			
			
			
				
		
//-----------------------------------------			
}



//===========================================================================
}

//si hay retencion
}



}

?>
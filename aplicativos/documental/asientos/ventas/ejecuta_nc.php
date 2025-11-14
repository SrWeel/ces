<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{

$doccab_id=$_POST["valor_id"];

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$valor_id=$doccab_id;


$nombre_campoid=$_POST["nombre_campoid"];
$tabla_asiento=$_POST["tabla"];
$mnupan_id=$_POST["mnupan_id"];



$comcont_enlace=strtoupper(uniqid().date("YmdHis"));


$busca_datos="select * from beko_documentocabecera where doccab_id='".$valor_id."'";
$rs_bdatis = $DB_gogess->executec($busca_datos);

$total=$rs_bdatis->fields["doccab_total"];
$doccab_ndocumento=$rs_bdatis->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_bdatis->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_bdatis->fields["doccab_apellidorazon_cliente"];
$doccab_total=$rs_bdatis->fields["doccab_total"];
$doccab_fechaemision_cliente=$rs_bdatis->fields["doccab_fechaemision_cliente"];

//cuenta cliente

//cuenta cliente debe
$array_haber=array();
$cuenta_lista=0;

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
//cuenta cliente debe

//Haber

//IVA
$doccab_iva=$rs_bdatis->fields["doccab_iva"];

if($doccab_iva>0)
{

$obtiene_enlace2="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id." and tr_id=2 and actr_id=5";
$rs_enlace2 = $DB_gogess->executec($obtiene_enlace2);

if($rs_enlace2)
	{
	   while (!$rs_enlace2->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace2->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$doccab_iva;
			$cuenta_lista++;
			
			$rs_enlace2->MoveNext();
			}
    }	

}

//IVA

//totales por cuenta en producto
$lista_cuentas='';
$lista_productos="select * from beko_documentodetalle where doccab_id='".$valor_id."'";
$rs_prd = $DB_gogess->executec($lista_productos);

	if($rs_prd)
	{
	   while (!$rs_prd->EOF) 
			{
			
			$busca_cuenta="select catgp_cuentacontable from efacsistema_producto inner join efacfactura_categproducto on efacsistema_producto.catgp_id=efacfactura_categproducto.catgp_id where prod_codigo='".$rs_prd->fields["docdet_codprincipal"]."'";
			
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);		
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["catgp_cuentacontable"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_prd->fields["docdet_total"];
			
			$lista_cuentas.=$rs_cuentabu->fields["catgp_cuentacontable"].",";
			$cuenta_lista++;
			$rs_prd->MoveNext();
			}
	}		
//totales por cuenta en producto

//mac grawhill

$lista_cuentas='';
$lista_productos="select * from beko_mhdetallefactura where doccab_id='".$valor_id."'";
$rs_prd = $DB_gogess->executec($lista_productos);

	if($rs_prd)
	{
	   while (!$rs_prd->EOF) 
			{
			
			
			
			$busca_cuenta="select distinct categ_cuentacontable,categ_cuentacontableventas from dns_cuadrobasicomedicamentos inner join dns_categoriadns on dns_cuadrobasicomedicamentos.categ_id=dns_categoriadns.categ_id where cuadrobm_codigoatc='".$rs_prd->fields["mhdetfac_codprincipal"]."'";
			 
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);
			
			
			if(!($rs_cuentabu->fields["categ_cuentacontableventas"]))
			{
			  $buscac="select categmc_cuenta as categ_cuentacontableventas from dns_hill left join lpin_categoriamchil on dns_hill.categmc_id=lpin_categoriamchil.categmc_id where hill_codigo='".$rs_prd->fields["mhdetfac_codprincipal"]."'";
			  $rs_cuentabu = $DB_gogess->executec($buscac);			
			}
			
			
			if(!($rs_cuentabu->fields["categ_cuentacontableventas"]))
			{
			  $busca_cuentaval="select detapre_tipo from dns_detalleprecuenta where detapre_codigop='".$rs_prd->fields["mhdetfac_codprincipal"]."' limit 1";
			  $rs_cuentaexterna = $DB_gogess->executec($busca_cuentaval);
			  
			  $busca_cuenta="select * from dns_categoriadns where categ_id='".$rs_cuentaexterna->fields["detapre_tipo"]."'";
			  $rs_cuentabu = $DB_gogess->executec($busca_cuenta);
			
			}
			
			if(!(trim($rs_cuentabu->fields["categ_cuentacontableventas"])))
			{
			   if($rs_prd->fields["tarimh_codigo"]==2)
			   {
			       $busca_cuenta="select * from dns_categoriadns where categ_id='2'";
			       $rs_cuentabu = $DB_gogess->executec($busca_cuenta);			   
			   }
			   
			   if($rs_prd->fields["tarimh_codigo"]==0)
			   {
			       $busca_cuenta="select * from dns_categoriadns where categ_id='1'";
			       $rs_cuentabu = $DB_gogess->executec($busca_cuenta);			   
			   }
			   if($rs_prd->fields["tarimh_codigo"]==6)
			   {
			       $busca_cuenta="select * from dns_categoriadns where categ_id='1'";
			       $rs_cuentabu = $DB_gogess->executec($busca_cuenta);			   
			   }
			}
			
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["categ_cuentacontableventas"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_prd->fields["mhdetfac_total"];
			
			$lista_cuentas.=$rs_cuentabu->fields["categ_cuentacontable"].",";
			
			$cuenta_lista++;
			$rs_prd->MoveNext();
			}
	}


//cuentas

$lista_cuentas="select * from lpin_cuentaventa where doccab_id='".$valor_id."'";
$rs_prdcuentas = $DB_gogess->executec($lista_cuentas);

	if($rs_prdcuentas)
	{
	   while (!$rs_prdcuentas->EOF) 
			{
						
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_prdcuentas->fields["planv_codigoc"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_prdcuentas->fields["cueven_subtotal"];
			
			$lista_cuentas.=$rs_prdcuentas->fields["planc_codigoc"].",";
			$cuenta_lista++;
			
			
			$rs_prdcuentas->MoveNext();
			}
	}	


//cuentas

//Haber

print_r($array_haber);
//echo $lista_cuentas;

	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."' and tipoa_id='2'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{

//actualiza comprobante

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["doccab_apellidorazon_cliente"];
$doccab_total=$rs_dattos->fields["doccab_total"];
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];
$doccab_ndocuafecta=$rs_dattos->fields["doccab_ndocuafecta"];



$concepto='';
$concepto='NOTA DE CREDITO. '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente.' Documento modif.: '.$doccab_ndocuafecta;
//$concepto=$concepto;
//concepto factura
//++++++++++++++++++++++++++

$actualiza_data="update lpin_comprobantecontable set comcont_fecha='".$doccab_fechaemision_cliente."',comcont_concepto='".$concepto."',comcont_numeroc='".$doccab_ndocumento."' where comcont_id='".$rs_bcabecera->fields["comcont_id"]."'";
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".round($detcc_debe,2)."','".round($detcc_haber,2)."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$valor_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["doccab_apellidorazon_cliente"];
$doccab_total=$rs_dattos->fields["doccab_total"];
$doccab_fechaemision_cliente=$rs_dattos->fields["doccab_fechaemision_cliente"];

$doccab_ndocuafecta=$rs_dattos->fields["doccab_ndocuafecta"];

$concepto='';
$concepto='NOTA DE CREDITO. '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente.' Documento modif.: '.$doccab_ndocuafecta;
//$concepto=utf8_encode($concepto);
//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tipoa_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla,comcont_obs) VALUES
( '2', '".$doccab_fechaemision_cliente."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."','AUTOMATICO');";

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


//inventarios+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++





//inventarios+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	



}

?>
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

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
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


$busca_sicobro="select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where compracp_id='".$compra_id."'";
$rs_sicobro = $DB_gogess->executec($busca_sicobro);


if($rs_sicobro->fields["crb_id"]>0)
{
//contado//  


//contado//  
}
else
{
//credito// 

$array_haber=array();
$cuenta_lista=0;

//IVA
$compra_iva=$rs_bdatis->fields["compra_iva"];

if($compra_iva>0)
{


$obtiene_enlace2="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id." and tr_id=1 and actr_id=8";
$rs_enlace2 = $DB_gogess->executec($obtiene_enlace2);

if($rs_enlace2)
	{
	   while (!$rs_enlace2->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace2->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$compra_iva;
			$cuenta_lista++;
			
			$rs_enlace2->MoveNext();
			}
    }
	

}

//IVA


//totales por cuenta en producto


$lista_cuentas='';
$lista_productos="select * from lpin_productocompra where compra_enlace='".$compra_enlace."'";
$rs_prd = $DB_gogess->executec($lista_productos);

	if($rs_prd)
	{
	   while (!$rs_prd->EOF) 
			{
			
			$busca_cuenta="select * from dns_cuadrobasicomedicamentos inner join dns_categoriadns on dns_cuadrobasicomedicamentos.categ_id=dns_categoriadns.categ_id where cuadrobm_id='".$rs_prd->fields["cuadrobm_id"]."'";
			
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);
			
			
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_cuentabu->fields["categ_cuentacontable"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_prd->fields["prcomp_subtotal"];
			
			$lista_cuentas.=$rs_cuentabu->fields["categ_cuentacontable"].",";
			$cuenta_lista++;
			
			
			$rs_prd->MoveNext();
			}
	}		



//totales por cuenta en producto

//totales cuentas

$lista_cuentas="select * from lpin_cuentacompra where compra_enlace='".$compra_enlace."'";
$rs_prdcuentas = $DB_gogess->executec($lista_cuentas);

	if($rs_prdcuentas)
	{
	   while (!$rs_prdcuentas->EOF) 
			{
						
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_prdcuentas->fields["planc_codigoc"];
			$array_haber[$cuenta_lista]["VALOR"]=$rs_prdcuentas->fields["cuecomp_subtotal"];
			
			$lista_cuentas.=$rs_prdcuentas->fields["planc_codigoc"].",";
			$cuenta_lista++;
			
			
			$rs_prdcuentas->MoveNext();
			}
	}	

//totales cuentas

//totales activos fijos



$lista_fijos="select * from dns_activosfijos where compra_enlace='".$compra_enlace."'";
$rs_prdfijos = $DB_gogess->executec($lista_fijos);

	if($rs_prdfijos)
	{
	   while (!$rs_prdfijos->EOF) 
			{
						
			//$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			//$array_haber[$cuenta_lista]["CUENTA"]=$rs_prdfijos->fields["planc_codigoc"];
			//$array_haber[$cuenta_lista]["VALOR"]=$rs_prdfijos->fields["cuecomp_subtotal"];
			
			//$lista_cuentas.=$rs_prdfijos->fields["planc_codigoc"].",";
			//$cuenta_lista++;
			
			
			$rs_prdcuentas->MoveNext();
			}
	}	
	

//totales activos fijos


$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=".$mnupan_id." and tr_id=2 and actr_id=8";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
			$array_haber[$cuenta_lista]["CUENTA"]=$rs_enlace->fields["enlacuenta_numerocuenta"];
			$array_haber[$cuenta_lista]["VALOR"]=$compra_total;
			$cuenta_lista++;
			
			$rs_enlace->MoveNext();
			}
    }
	

print_r($array_haber);


	
$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$tabla_asiento."' and comcont_idtabla='".$valor_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);


if($rs_bcabecera->fields["comcont_id"]>0)
{
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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".$detcc_debe."','".$detcc_haber."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 
		 


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from dns_compras inner join dns_tipodocumentogeneral on dns_compras.tipdoc_id=dns_tipodocumentogeneral.tipdoc_id where compra_enlace='".$compra_enlace."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["compra_nfactura"];
$proveevar_id=$rs_dattos->fields["proveevar_id"];

$busca_proveed="select * from app_proveedor where provee_id='".$proveevar_id."'";
$rs_provnom = $DB_gogess->executec($busca_proveed);

$doccab_nombrerazon_cliente=$rs_provnom->fields["provee_nombre"];
$doccab_apellidorazon_cliente='';
$doccab_total=$rs_dattos->fields["compra_total"];
$doccab_fechaemision_cliente=$rs_dattos->fields["compra_fecha"];

$tipdoc_nombre=$rs_dattos->fields["tipdoc_nombre"];

$concepto='';
$concepto='COMPRAS '.$tipdoc_nombre.' '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente;

//concepto factura
//++++++++++++++++++++++++++


$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tcomp_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla) VALUES
( 9, '".$doccab_fechaemision_cliente."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '".$comcont_enlace."', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$tabla_asiento."', '".$valor_id."');";

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
		 		 
		     $lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, usua_id, detcc_fecharegistro,comcont_enlace) VALUES (NULL, '".$detcc_cuentacontable."', '".$detcc_descricpion."', '".$detcc_referencia."', '','".$detcc_debe."','".$detcc_haber."','".$_SESSION['ces1313777_sessid_inicio']."', '".$doccab_fechaemision_cliente."','".$comcont_enlace."') ";
			 
			 //echo $lista_data."<br>";
			 
			$rs_ok = $DB_gogess->executec($lista_data);
		 
		   
		 }
		 			
			
			
				
		
//-----------------------------------------			
}



//===========================================================================
}








//credito// 
}





}
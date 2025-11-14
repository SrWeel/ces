<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("lib_as.php");

$objformulario= new  ValidacionesFormulario();



if($_SESSION['ces1313777_sessid_inicio'])
{

$tomfis_id=$_POST["tomfis_id"];
$tabla_asiento='lpin_tomafisica';

//crea asiento contable

$datos_fisico="select * from lpin_tomafisica where tomfis_id='".$_POST["tomfis_id"]."'";
$rs_fisico = $DB_gogess->executec($datos_fisico,array());
$centro_id=$rs_fisico->fields["centro_id"];
$tomfis_descripcion=$rs_fisico->fields["tomfis_descripcion"];
$tomfis_procesado=$rs_fisico->fields["tomfis_procesado"];

$nombre_centro="select * from cmb_destinocentro_vista where centro_id='".$centro_id."'";
$rs_ncentro = $DB_gogess->executec($nombre_centro,array());


$doccab_ndocumento=$rs_fisico->fields["tomfis_id"];
$doccab_nombrerazon_cliente=$rs_ncentro->fields["centro_nombre"];
$doccab_apellidorazon_cliente='';
$doccab_fechaemision_cliente=$rs_fisico->fields["tomfis_fecha"];
$tomfis_descripcion=$rs_fisico->fields["tomfis_descripcion"];

//saca cuentas

$tomfis_asientoingreso_med=$rs_fisico->fields["tomfis_asientoingreso"];
$tomfis_asientoegreso_med=$rs_fisico->fields["tomfis_asientoegreso"];

$tomfis_asientoingresoinsumo=$rs_fisico->fields["tomfis_asientoingresoinsumo"];
$tomfis_asientoegresoinsumo=$rs_fisico->fields["tomfis_asientoegresoinsumo"];

//casa cuentas


$concepto='';
$concepto='INVENTARIO . '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$tomfis_descripcion;

///---------------------------------data---------------------------------------

$datos_produ="select * from lpin_tomafisica inner join lpin_ajusteproducto on lpin_tomafisica.tomfis_enlace=lpin_ajusteproducto.tomfis_enlace where tomfis_id='".$tomfis_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());

if($rs_produ)
 {
	  while (!$rs_produ->EOF) {	
	  
	     ///////////////////////////lista de productos////////////////////////////////////////////////////////////
		 	$comcont_tablas='lpin_ajusteproducto';
			$ajuspr_id=$rs_produ->fields["ajuspr_id"];			
			$comcont_idtablas=$ajuspr_id;
			
			$comcont_enlace=strtoupper(uniqid().date("YmdHis"));
			
			$busca_cuenta="select distinct * from dns_cuadrobasicomedicamentos inner join dns_categoriadns on dns_cuadrobasicomedicamentos.categ_id=dns_categoriadns.categ_id where cuadrobm_id='".$rs_produ->fields["cuadrobm_id"]."'";			 
			$rs_cuentabu = $DB_gogess->executec($busca_cuenta);
			
			$cuenta_ingreso=$rs_cuentabu->fields["categ_cuentacontable"];
			$cuenta_sale=$rs_cuentabu->fields["categ_cuentacosto"];
			
			$categ_cuentacontableventas=$rs_cuentabu->fields["categ_cuentacosto"];
			
			$n_medi=$rs_cuentabu->fields["cuadrobm_principioactivo"];
			$code_medi=$rs_cuentabu->fields["cuadrobm_codigoatc"];
			
			$ajuspr_diferencia=$rs_produ->fields["ajuspr_diferencia"];
			
			$concepto_medi=' '.$code_medi.' '.$n_medi.' Cantidad: '.abs($ajuspr_diferencia);
			
			
			
			$busca_costo="select * from dns_preciostiempo where cuadrobm_id='".$rs_produ->fields["cuadrobm_id"]."'";
			$rs_bcosto = $DB_gogess->executec($busca_costo);
			
			$precio_compra=$rs_bcosto->fields["precio_compra"];
			
$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where mnupan_id=195 and actr_id=2";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);
$enlacuenta_numerocuenta=$rs_enlace->fields["enlacuenta_numerocuenta"];

			$array_haber=array();
            $cuenta_lista=0;
			$total_val=0;
			$total_val=$precio_compra*abs($ajuspr_diferencia);
			
			if($ajuspr_diferencia>0)
			{
			///sacar de bodega
			
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$cuenta_sale;
			$array_haber[$cuenta_lista]["VALOR"]=$total_val;
			$cuenta_lista++;
			
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
			$array_haber[$cuenta_lista]["CUENTA"]=$cuenta_ingreso;
			$array_haber[$cuenta_lista]["VALOR"]=$total_val;
			$cuenta_lista++;
			
			$num_detasiento=0;
            $num_detasiento=count($array_haber);
			
		   genera_acientovalor($num_detasiento,$tabla_asiento,$tomfis_id,$comcont_tablas,$comcont_idtablas,$doccab_fechaemision_cliente,$concepto.$concepto_medi,$doccab_ndocumento,$comcont_enlace,$array_haber,$DB_gogess);
			
			
			///sacar de bodega
			}
			
			if($ajuspr_diferencia<0)
			{
			///ingreso a bodega
			
			
			$array_haber[$cuenta_lista]["TIPO"]="DEBE";
			$array_haber[$cuenta_lista]["CUENTA"]=$cuenta_ingreso;
			$array_haber[$cuenta_lista]["VALOR"]=$total_val;
			$cuenta_lista++;
			
			$array_haber[$cuenta_lista]["TIPO"]="HABER";
			$array_haber[$cuenta_lista]["CUENTA"]=$categ_cuentacontableventas;
			$array_haber[$cuenta_lista]["VALOR"]=$total_val;
			$cuenta_lista++;
			
			$num_detasiento=0;
            $num_detasiento=count($array_haber);
			
			genera_acientovalor($num_detasiento,$tabla_asiento,$tomfis_id,$comcont_tablas,$comcont_idtablas,$doccab_fechaemision_cliente,$concepto.$concepto_medi,$doccab_ndocumento,$comcont_enlace,$array_haber,$DB_gogess);
			
			///ingreso a bodega
			}
		 
		 
		 
		 
		 
	     ///////////////////////////lista de productos///////////////////////////////////////////////////////////
	  
	    $rs_produ->MoveNext();
	  }
 }


//----------------------------------data---------------------------------------

$num_detasiento=0;










}

?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
$tiempossss="4445000";
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$table='beko_documentocabecera';
$campo_id=$_POST["campo_id"];

$busca_cabeceraasiento="select * from lpin_comprobantecontable where comcont_tabla='".$table."' and comcont_idtabla='".$campo_id."'";
$rs_bcabecera = $DB_gogess->executec($busca_cabeceraasiento);

if($rs_bcabecera->fields["comcont_id"]>0)
{
//===========================================================================

//-----------------------------------------
$id_gen=$rs_bcabecera->fields["comcont_id"];

$borra_dt="delete from lpin_detallecomprobantecontable where comcont_id='".$id_gen."'";
$rs_oktd = $DB_gogess->executec($borra_dt);

$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where moduls_id=4";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($rs_enlace->fields["tr_id"]==1)
			{
			$detcc_debe=$doccab_total;
			}
			else
			{
			$detcc_haber=$doccab_total;
			}
					
			$lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, comcont_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, sisu_id, detcc_fecharegistro) VALUES (NULL,'".$id_gen."', '".$rs_enlace->fields["enlacuenta_numerocuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."','".$detcc_debe."','".$detcc_haber."','".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."') ";
			
			$rs_ok = $DB_gogess->executec($lista_data);
			
				
				
				$rs_enlace->MoveNext();
			}
	}
//-----------------------------------------	


//===========================================================================
}
else
{
//===========================================================================

//++++++++++++++++++++++++++
//concepto factura

$busca_dattos="select * from beko_documentocabecera where doccab_id='".$campo_id."'";
$rs_dattos = $DB_gogess->executec($busca_dattos);

$doccab_ndocumento=$rs_dattos->fields["doccab_ndocumento"];
$doccab_nombrerazon_cliente=$rs_dattos->fields["doccab_nombrerazon_cliente"];
$doccab_apellidorazon_cliente=$rs_dattos->fields["doccab_apellidorazon_cliente"];
$doccab_total=$rs_dattos->fields["doccab_total"];

$concepto='';
$concepto='FACTURA VENTA '.$doccab_ndocumento.' '.$doccab_nombrerazon_cliente.' '.$doccab_apellidorazon_cliente;

//concepto factura
//++++++++++++++++++++++++++

$fecha_hoy='';
$fecha_hoy=date("Y-m-d H:i:s");

$inserta_cab="INSERT INTO lpin_comprobantecontable ( tcomp_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, sisu_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla) VALUES
( 9, '".date("Y-m-d")."', '".$concepto."', '".$doccab_ndocumento."', 'APROBADO', 0, '', '".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."','".$_SESSION['ces1313777_centro_id']."', '".$table."', '".$campo_id."');";

$rs_insertcab = $DB_gogess->executec($inserta_cab);
$id_gen=$DB_gogess->funciones_nuevoID(0);


if($id_gen>0)
{
//-----------------------------------------
$obtiene_enlace="select * from lpin_enlace inner join lpin_cuentasenlace on lpin_enlace.enla_id=lpin_cuentasenlace.enla_id where moduls_id=4";
$rs_enlace = $DB_gogess->executec($obtiene_enlace);

	if($rs_enlace)
	{
	   while (!$rs_enlace->EOF) 
			{
			
			$detcc_debe=0;
			$detcc_haber=0;
			
			if($rs_enlace->fields["tr_id"]==1)
			{
			$detcc_debe=$doccab_total;
			}
			else
			{
			$detcc_haber=$doccab_total;
			}
					
			$lista_data="INSERT INTO lpin_detallecomprobantecontable (detcc_id, comcont_id, detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, sisu_id, detcc_fecharegistro) VALUES (NULL,'".$id_gen."', '".$rs_enlace->fields["enlacuenta_numerocuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."', '".$rs_enlace->fields["enlacuenta_nombrecuenta"]."','".$detcc_debe."','".$detcc_haber."','".$_SESSION['ces1313777_sessid_inicio']."', '".$fecha_hoy."') ";
			$rs_ok = $DB_gogess->executec($lista_data);
			
				
				
				$rs_enlace->MoveNext();
			}
	}
//-----------------------------------------			
}


//===========================================================================
}


		


}
?>
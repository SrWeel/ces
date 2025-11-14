<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$egrec_id=$_POST["egrec_id"];

$busca_egreso="select *,dns_temporaldespacho.tempdsp_id as idtempdsp_id,dns_temporaldespacho.tipom_id as tipom_idd,dns_temporaldespacho.tipomov_id as tipomov_idd from dns_egresocentros inner join dns_temporaldespacho on dns_egresocentros.egrec_id=dns_temporaldespacho.egrec_id inner join dns_principalmovimientoinventario on dns_principalmovimientoinventario.moviin_id=dns_temporaldespacho.moviin_id where dns_egresocentros.egrec_id='".$egrec_id."'";

$rs_egrpro = $DB_gogess->executec($busca_egreso);
                   if($rs_egrpro)
				   {
						while (!$rs_egrpro->EOF) {
	
	$cuadrobm_id=$rs_egrpro->fields["cuadrobm_id"];
	$centro_id=$rs_egrpro->fields["centro_id"];
	$tipom_id=$rs_egrpro->fields["tipom_idd"];
	$tipomov_id=$rs_egrpro->fields["tipomov_idd"];
	$moviin_nlote=$rs_egrpro->fields["moviin_nlote"];
	$moviin_fechadecaducidad=$rs_egrpro->fields["moviin_fechadecaducidad"];
	$moviin_comprobantedeingreso=0;
	$moviin_fechaingreso=NULL;
	$centroenvia_id=$rs_egrpro->fields["centro_id"];
	$centrorecibe_id=$rs_egrpro->fields["centrod_id"];
	$centrorecibe_observacion='';
	$centrorecibe_cantidad=$rs_egrpro->fields["cantidad_val"];
	$centrorecibe_documento='';
	$centrorecibe_bodegamatriz=0;
	$usua_id=$_SESSION['ces1313777_sessid_inicio'];
	$moviin_fechaenvio=$rs_egrpro->fields["egrec_fecha"];
	$moviin_nombrerecibe=$rs_egrpro->fields["egrec_personalrecibe"];
	$moviin_cedularecibe=$rs_egrpro->fields["egrec_cedularecibe"];
	$moviin_gradorecibe='';
	$moviin_fecharegistro=date("Y-m-d H:i:s");
	$unid_id=$rs_egrpro->fields["unid_id"];
	$uniddesg_id=$rs_egrpro->fields["uniddesg_id"];
	$moviin_cantidadunidadconsumo=$rs_egrpro->fields["moviin_cantidadunidadconsumo"];
	$moviin_totalenunidadconsumo=$rs_egrpro->fields["cantidad_val"];
	$moviin_fechadeelaboracion=$rs_egrpro->fields["moviin_fechadeelaboracion"];
	$moviin_nombreproveedor=$rs_egrpro->fields["moviin_nombreproveedor"];
	$moviin_nombrefabricante=$rs_egrpro->fields["moviin_nombrefabricante"];
	$moviin_preciocompra=$rs_egrpro->fields["moviin_preciocompra"];
	$moviin_total=$rs_egrpro->fields["cantidad_val"]*$rs_egrpro->fields["moviin_preciocompra"];
	$moviin_rsanitario=$rs_egrpro->fields["moviin_rsanitario"];
	$compra_id=$rs_egrpro->fields["compra_id"];
	$moviin_autorizado=0;
	$moviin_fechaautorizado=NULL;
	$moviin_aprobo=0;
	$moviintemp_id=0;
	$tempdsp_id=$rs_egrpro->fields["idtempdsp_id"];
	
	 $per_activo=0;
     $per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);					
						
$inserta_moviegreso="INSERT INTO dns_principalmovimientoinventario (cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_nlote, moviin_fechadecaducidad, moviin_comprobantedeingreso, moviin_fechaingreso, centroenvia_id, centrorecibe_id, centrorecibe_observacion, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fechaenvio, moviin_nombrerecibe, moviin_cedularecibe, moviin_gradorecibe, moviin_fecharegistro, unid_id, uniddesg_id, moviin_cantidadunidadconsumo, moviin_totalenunidadconsumo, moviin_fechadeelaboracion, moviin_nombreproveedor, moviin_nombrefabricante, moviin_preciocompra, moviin_total, moviin_rsanitario, compra_id, moviin_autorizado, moviin_fechaautorizado, moviin_aprobo, moviintemp_id,tempdsp_id,perioac_id) VALUES
('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$moviin_nlote."','".$moviin_fechadecaducidad."','".$moviin_comprobantedeingreso."','".$moviin_fechaingreso."','".$centroenvia_id."','".$centrorecibe_id."','".$centrorecibe_observacion."','".$centrorecibe_cantidad."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fechaenvio."','".$moviin_nombrerecibe."','".$moviin_cedularecibe."','".$moviin_gradorecibe."','".$moviin_fecharegistro."','".$unid_id."','".$uniddesg_id."','".$moviin_cantidadunidadconsumo."','".$moviin_totalenunidadconsumo."','".$moviin_fechadeelaboracion."','".$moviin_nombreproveedor."','".$moviin_nombrefabricante."','".$moviin_preciocompra."','".$moviin_total."','".$moviin_rsanitario."','".$compra_id."','".$moviin_autorizado."','".$moviin_fechaautorizado."','".$moviin_aprobo."','".$moviintemp_id."','".$tempdsp_id."','".$per_activo."');";

//echo $inserta_moviegreso."<br>";

$rs_okv='';
$rs_okv = $DB_gogess->executec($inserta_moviegreso);

if($rs_okv)
{
  //actualiza egreso

   $act_data="update dns_egresocentros set usuapr_id='".$_SESSION['ces1313777_sessid_inicio']."',egrec_procesado='1',egrec_fechaprocesa='".date("Y-m-d H:i:s")."' where egrec_id='".$egrec_id."'";
   $rs_proceso = $DB_gogess->executec($act_data);

  //actualiza egreso
}

						
						
						  $rs_egrpro->MoveNext();
						}
					}	



}

?>
Proceso realizado con exito...
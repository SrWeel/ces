<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$compra_id=$_POST["compra_id"];
$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$procesado_data="update dns_compras set compra_procesado='1',compra_fechaprocesado='".date("Y-m-d H:i:s")."',compra_usprocesa='".$_SESSION['ces1313777_sessid_inicio']."' where compra_id='".$compra_id."';";
$rs_pd = $DB_gogess->executec($procesado_data);


$trasfiere_data="INSERT INTO dns_principalmovimientoinventario (cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviintemp_id,perioac_id,moviin_preciocontable) select cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviin_id,perioac_id,moviin_preciocontable from dns_temporalovimientoinventario where compra_id='".$compra_id."';";


$rs_listaprocesa = $DB_gogess->executec($trasfiere_data);


}


?>
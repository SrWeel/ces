<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=5444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$precu_id=$_POST["precu_id"];
$doccab_id=$_POST["doccab_id"];
$txt_detalle=$_POST["txt_detalle"];
$detallado=$_POST["detallado"];

//busca asignacion
$doccab_idx='';
$busca_asig="select * from beko_documentocabecera inner join beko_mhdetallefactura on beko_documentocabecera.doccab_id=beko_mhdetallefactura.doccab_id where precu_id='".$precu_id."'";
$okv_asiga=$DB_gogess->executec($busca_asig); 

$doccab_idx=$okv_asiga->fields["doccab_id"];
$doccab_ndocumento=$okv_asiga->fields["doccab_ndocumento"];

//busca asignacion
if($doccab_idx)
{
?>
<script type="text/javascript">
<!--

alert("Precuenta no puede ser asignada...ya fue usada en otra factura...<?php echo $doccab_ndocumento; ?>");

//-->
</script> 
<?php
}
else
{

if($detallado=='1')
{


 $valor_total=0;
 $lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud on dns_detalleprecuenta.centrob_id=dns_centrosalud.centro_id  where precu_id='".$precu_id."'";
 $rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());

 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	  $clie_id=$rs_lprecuentas->fields["clie_id"];
	  $busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
	  $rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
	  $conve_id=$rs_bcliente->fields["conve_id"]; 
	  $estado_prec='';
	   if($rs_lprecuentas->fields["detapre_tipo"]==1)
	   {
		 $estado_prec='MEDICAMENTOS';
	   
	   }
		if($rs_lprecuentas->fields["detapre_tipo"]==2)
	   {
		 $estado_prec='INSUMOS';
	   
	   }
	   
		if($rs_lprecuentas->fields["detapre_tipo"]==3)
	   {
		 $estado_prec='TARIFARIO';
	   
	   }
   
     if($rs_lprecuentas->fields["centro_nombre"])
     {  
   
$detapre_id=$rs_lprecuentas->fields["detapre_id"];	
$mhdetfac_codprincipal=$rs_lprecuentas->fields["detapre_codigop"];
$mhdetfac_descripcion=$rs_lprecuentas->fields["detapre_detalle"];
$mhdetfac_cantidad=$rs_lprecuentas->fields["detapre_cantidad"];
$mhdetfac_preciou=$rs_lprecuentas->fields["detapre_precioventa"];
$mhdetfac_preciou=number_format($mhdetfac_preciou, 2, '.', '');
$impumh_codigo=2;
$tarimh_codigo=0;
$mhdetfac_porcentaje=0;
$mhdetfac_valorimpuesto=0;
$mhdetfac_total=$rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"];
$mhdetfac_total=number_format($mhdetfac_total, 2, '.', '');
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$usuaat_id=0;
$mhdetfac_detallea='';
$prof_id=0;
$mhdetfac_fecharegistro=date("Y-m-d H:i:s");
$mhdetfac_porcentajemh=0;

$inserta_producto="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_descripcion,mhdetfac_cantidad,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_porcentaje,mhdetfac_valorimpuesto,mhdetfac_total,usua_id,usuaat_id,mhdetfac_detallea,prof_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_descripcion."','".$mhdetfac_cantidad."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_porcentaje."','".$mhdetfac_valorimpuesto."','".$mhdetfac_total."','".$usua_id."','".$usuaat_id."','".$mhdetfac_detallea."','".$prof_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

		
		
	}
	else
	{

	
$detapre_id=$rs_lprecuentas->fields["detapre_id"];	
$mhdetfac_codprincipal=$rs_lprecuentas->fields["detapre_codigop"];
$mhdetfac_descripcion=$rs_lprecuentas->fields["detapre_detalle"];
$mhdetfac_cantidad=$rs_lprecuentas->fields["detapre_cantidad"];
$mhdetfac_preciou=$rs_lprecuentas->fields["detapre_precioventa"];
$mhdetfac_preciou=number_format($mhdetfac_preciou, 2, '.', '');
$impumh_codigo=2;
$tarimh_codigo=0;
$mhdetfac_porcentaje=0;
$mhdetfac_valorimpuesto=0;
$mhdetfac_total=$rs_lprecuentas->fields["detapre_precioventa"]*$rs_lprecuentas->fields["detapre_cantidad"];
$mhdetfac_total=number_format($mhdetfac_total, 2, '.', '');
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$usuaat_id=0;
$mhdetfac_detallea='';
$prof_id=0;
$mhdetfac_fecharegistro=date("Y-m-d H:i:s");
$mhdetfac_porcentajemh=0;

$inserta_producto="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_descripcion,mhdetfac_cantidad,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_porcentaje,mhdetfac_valorimpuesto,mhdetfac_total,usua_id,usuaat_id,mhdetfac_detallea,prof_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_descripcion."','".$mhdetfac_cantidad."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_porcentaje."','".$mhdetfac_valorimpuesto."','".$mhdetfac_total."','".$usua_id."','".$usuaat_id."','".$mhdetfac_detallea."','".$prof_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());
	
	
	
	
	}
	
	
	$rs_lprecuentas->MoveNext();	   

	  }
  }  


}
else
{
$lista_totales="select sum(detapre_precioventa*detapre_cantidad) as total_g from dns_detalleprecuenta where precu_id='".$precu_id."'"; 
$okv_totales=$DB_gogess->executec($lista_totales); 
$mhdetfac_codprincipal='INMED'.$precu_id;
$mhdetfac_descripcion=$txt_detalle;
$mhdetfac_cantidad=1;
$mhdetfac_preciou=$okv_totales->fields["total_g"];

$mhdetfac_preciou=number_format($mhdetfac_preciou, 2, '.', '');

$impumh_codigo=2;
$tarimh_codigo=0;
$mhdetfac_porcentaje=0;
$mhdetfac_valorimpuesto=0;
$mhdetfac_total=number_format($okv_totales->fields["total_g"], 2, '.', '');
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$usuaat_id=0;
$mhdetfac_detallea='';
$prof_id=0;
$mhdetfac_fecharegistro=date("Y-m-d H:i:s");
$mhdetfac_porcentajemh=0;

$inserta_producto="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_descripcion,mhdetfac_cantidad,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_porcentaje,mhdetfac_valorimpuesto,mhdetfac_total,usua_id,usuaat_id,mhdetfac_detallea,prof_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_descripcion."','".$mhdetfac_cantidad."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_porcentaje."','".$mhdetfac_valorimpuesto."','".$mhdetfac_total."','".$usua_id."','".$usuaat_id."','".$mhdetfac_detallea."','".$prof_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";

//echo $inserta_producto;
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());

}



}




}
?>
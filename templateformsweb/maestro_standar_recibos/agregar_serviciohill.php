<?php
$tiempossss=54014000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";

$hill_id=$_POST["hill_id"];
$valor_porcentaje=$_POST["valor_porcentaje"];
$enlace=$_POST["enlace"];
$conve_id=$_POST["conve_id"];
$cant_valor=$_POST["cant_valor"];
if($conve_id=='')
{
 $conve_id=6;
}


if($_SESSION['ces1313777_sessid_inicio'])
{


//llega tipo y convenio
$busca_producto="select * from dns_hill where hill_id='".$hill_id."'";
$rs_producto = $DB_gogess->executec($busca_producto,array());
//busca precio
$cantidad_nueva=$cant_valor;

$precio_valor=0;	

$detalle_obs='';
$valor_precio=0;

if($rs_producto->fields["hill_codigo"]=='AYUDANTE' or $rs_producto->fields["hill_codigo"]=='ANESTESIOLOGO')
{

          $precio_valor=0;	
		  $busca_detalles="select sum(docdet_total) as total from beko_recibodetalle where doccab_id='".$enlace."' and docdet_detallea='MAC'";
		  $rs_detalles = $DB_gogess->executec($busca_detalles,array());
		  
		  if($valor_porcentaje>0)
		  {
		    $precio_valor=($rs_detalles->fields["total"]*$valor_porcentaje)/100;
		  }
		  $valor_precio=$precio_valor;
		  $detalle_obs=$rs_producto->fields["hill_codigo"];

}
else
{
		//busca si hay convenio y calcula el precio		
		$busca_cnv="select * from cesdb_arextension.dns_gridconvenioshill where hill_enlace='".$rs_producto->fields["hill_enlace"]."' and gconvehil_convenio='".$conve_id."'";
		$rs_cnv = $DB_gogess->executec($busca_cnv,array());
		$precio_valor=$rs_producto->fields["hill_medicos"]*$rs_cnv->fields["gconvehil_precio"];
		if($valor_porcentaje>0)
		{
		  $precio_valor=($precio_valor*$valor_porcentaje)/100;
		} 
		$valor_precio=$precio_valor;
		
		$detalle_obs='MAC';

}


$busca_dataproducto="select '".$enlace."' as doccab_id,hill_codigo as prod_codigo,hill_descripcion as prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as prod_precio,hill_impucodigo as impu_codigo,hill_taricodigo as tari_codigo,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from dns_hill inner join beko_tarifa on hill_taricodigo=beko_tarifa.tari_codigo where  hill_id=".$hill_id;
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());

$n_porcentaje='';
if($valor_porcentaje>0)
{
$n_porcentaje=" ".$valor_porcentaje."%";
}


$inserta_producto="insert into beko_recibodetalle (doccab_id,docdet_codprincipal,docdet_descripcion,docdet_cantidad,docdet_preciou,impu_codigo,tari_codigo,docdet_porcentaje,docdet_valorimpuesto,docdet_total,usua_id,usuaat_id,docdet_detallea,prof_id) values ('".$rs_dataproducto->fields["doccab_id"]."','".$rs_dataproducto->fields["prod_codigo"]."','".$rs_dataproducto->fields["prod_nombre"].$n_porcentaje."','".$rs_dataproducto->fields["docdet_cantidad"]."','".$rs_dataproducto->fields["prod_precio"]."','".$rs_dataproducto->fields["impu_codigo"]."','".$rs_dataproducto->fields["tari_codigo"]."','".$rs_dataproducto->fields["tari_valor"]."','".$rs_dataproducto->fields["docdet_valorimpuesto"]."','".$rs_dataproducto->fields["docdet_total"]."','".$rs_dataproducto->fields["usua_id"]."','0','".$detalle_obs."','0')";
$rs_insdetalle = $DB_gogess->executec($inserta_producto,array());




}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>
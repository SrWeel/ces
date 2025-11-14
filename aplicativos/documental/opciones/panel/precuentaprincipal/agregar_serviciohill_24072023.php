<?php
$tiempossss=54014000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["prod_id"]."<br>";
//echo $_POST["enlace"]."<br>";

$hill_id=$_POST["hill_id"];
$valor_porcentaje=$_POST["valor_porcentaje"];
$enlace=$_POST["enlace"];
$conve_id=$_POST["conve_id"];
$cant_valor=$_POST["cant_valor"];


$lista_bprecuentac="select * from dns_precuenta where precu_id='".$enlace."'";
$rs_bprecuentac = $DB_gogess->executec($lista_bprecuentac,array());
$clie_id=$rs_bprecuentac->fields["clie_id"];

$busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
$conve_id=$rs_bcliente->fields["conve_id"];


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
		  $busca_detalles="select sum(detapre_precioventa) as total from dns_detalleprecuentaprincipal where precu_id='".$enlace."' and detapre_tipohg='MAC'";
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


$busca_dataproducto="select '".$enlace."' as precu_id,hill_codigo as prod_codigo,hill_descripcion as prod_nombre,'".$cantidad_nueva."' as docdet_cantidad,(".$valor_precio.") as prod_precio,hill_impucodigo as impu_codigo,hill_taricodigo as tari_codigo,(((".$cantidad_nueva."*(".$valor_precio."))*tari_valor)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id from dns_hill inner join beko_tarifa on hill_taricodigo=beko_tarifa.tari_codigo where  hill_id=".$hill_id;
$rs_dataproducto = $DB_gogess->executec($busca_dataproducto,array());

$n_porcentaje='';
if($valor_porcentaje>0)
{
$n_porcentaje=" ".$valor_porcentaje."%";
}

//4 HG

///HG

$n_porcentaje='';
if($valor_porcentaje>0)
{
$n_porcentaje=" ".$valor_porcentaje."%";
}

$detapre_tipo=4;
$mnupan_id=0;
$detapre_codigop=$rs_dataproducto->fields["prod_codigo"];
$detapre_detalle=$rs_dataproducto->fields["prod_nombre"].$n_porcentaje;
$detapre_cantidad=$cant_valor;
$detapre_precio=$rs_dataproducto->fields["prod_precio"];
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$bode_id=0;
$detapre_origen='DESCARGO HG';
$detapre_precioventa=$rs_dataproducto->fields["prod_precio"];
$precu_id=$enlace;
$detapre_tipohg=$detalle_obs;

$inserta_datadis="INSERT INTO dns_detalleprecuentaprincipal (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,bodega_id,detapre_origen,detapre_precioventa,detapre_tipohg,conve_id) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$bode_id."','".$detapre_origen."','".$detapre_precioventa."','".$detapre_tipohg."','".$conve_id."');";
$rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());



}
else
{
echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';

}
?>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$clie_id=$_POST["clie_id"];
$mnupan_id=$_POST["mnupan_id"];
$atenc_id=$_POST["atenc_id"];
$centro_id=$_POST["centro_id"];
$anam_id=$_POST["anam_id"];

$lista_datosmenu="select * from gogess_menupanel where mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));

$lista_tabla="select * from gogess_sistable,gogess_styletable where gogess_sistable.st_id=gogess_styletable.st_id and tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
$table=$rs_tabla->fields["tab_name"];
$tab_id=$rs_datosmenu->fields["tab_id"];

//1 servicios
//2 productos

$lista_bprecuenta="select * from dns_precuenta where clie_id='".$clie_id."' and precu_activo=1";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta->fields["precu_id"]>0)
{


//Consultas
$bus_asignaciocobro="select * from dns_detalleprecuenta where precu_id='".$rs_bprecuenta->fields["precu_id"]."' and clie_id='".$clie_id."' and mnupan_id='".$mnupan_id."' and centro_id='".$centro_id."' and atenc_id='".$atenc_id."' and detapre_codigoform='".$anam_id."'";
$rs_bascobro = $DB_gogess->executec($bus_asignaciocobro,array());

if(!($rs_bascobro->fields["detapre_id"]))
{

$busca_formap="select * from gogess_menupanel where mnupan_id='".$mnupan_id."'";
$rs_formap = $DB_gogess->executec($busca_formap,array());


if($rs_formap->fields["tomad_id"]==1)
{
//DATA LOCAL


}

if($rs_formap->fields["tomad_id"]==2)
{
//API
$valor_precio='pvp1';
$cantidad_nueva=1;
$tabla_r="select '".$_POST["enlace"]."' as doccab_id,id as prod_codigo,nombre as prod_nombre,'1' as docdet_cantidad,pvp1 as prod_precio,2 as impu_codigo,CASE 
    WHEN porcentaje_iva = '12' THEN '2'
    WHEN porcentaje_iva = '0' THEN '0'
	WHEN porcentaje_iva = '13' THEN '2'
	WHEN porcentaje_iva = '14' THEN '2'
    ELSE '0'
END as  tari_codigo, porcentaje_iva as tari_valor,(((1*(".$valor_precio."))*porcentaje_iva)/100) as docdet_valorimpuesto,(".$cantidad_nueva."*(".$valor_precio.")) as docdet_total,".$_SESSION['ces1313777_sessid_inicio']." as usua_id,'' as prod_enlace from api_productos where id='".$rs_formap->fields["mnupan_codigoproducto"]."'";

$rs_productotoma = $DB_gogess->executec($tabla_r,array());


}

$precu_id=$rs_bprecuenta->fields["precu_id"];
$detapre_tipo='1';
$detapre_codigop=$rs_productotoma->fields["prod_codigo"];
$detapre_detalle=$rs_productotoma->fields["prod_nombre"];
$detapre_cantidad=1;
$detapre_precio=$rs_productotoma->fields["prod_precio"];
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$detapre_codigoform=$anam_id;


$inserta_data="INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."');";

//$rs_insdata = $DB_gogess->executec($inserta_data,array());
}
//Consultas


//dispositivos

$busca_campodispositivos="select * from gogess_sisfield where tab_name='".$table."' and ttbl_id='4'";
$rs_bucampo = $DB_gogess->executec($busca_campodispositivos,array());
$campo_primario=$rs_tabla->fields["tab_campoprimario"];
$datos_enlace="select * from ".$table." where ".$campo_primario."='".$anam_id."'";
$rs_denlace = $DB_gogess->executec($datos_enlace,array());

//echo $rs_bucampo->fields["fie_tablasubgrid"]."<br>";
//echo $rs_bucampo->fields["fie_campoenlacesub"]."<br>";
//echo $rs_denlace->fields[$rs_bucampo->fields["fie_campoenlacesub"]]."<br>";
$lista_dispo="select * from ".$rs_bucampo->fields["fie_tablasubgrid"]." where ".$rs_bucampo->fields["fie_campoenlacesub"]."='".$rs_denlace->fields[$rs_bucampo->fields["fie_campoenlacesub"]]."'";

$rs_ld = $DB_gogess->executec($lista_dispo,array());
if($rs_ld)
 {
	while (!$rs_ld->EOF) { 
	      
		  
		  
		  $bus_dispositivo="select * from dns_detalleprecuenta where precu_id='".$rs_bprecuenta->fields["precu_id"]."' and clie_id='".$clie_id."' and mnupan_id='".$mnupan_id."' and centro_id='".$centro_id."' and atenc_id='".$atenc_id."' and detapre_codigoform='".$anam_id."' and detapre_codigop='".$rs_ld->fields["plantrai_codigo"]."' and detapre_idgrid='".$rs_bucampo->fields["fie_id"]."'";		  
		  $rs_dispositivo = $DB_gogess->executec($bus_dispositivo,array());
		  
		  if(!($rs_dispositivo->fields["detapre_id"]))
          {
		        $precu_id=$rs_bprecuenta->fields["precu_id"];
				$detapre_tipo='1';
				$detapre_codigop=$rs_ld->fields["plantrai_codigo"];
				$detapre_detalle=$rs_ld->fields["plantrai_nombredispositivo"];
				$detapre_cantidad=1;
				$detapre_precio=$rs_productotoma->fields["plantrai_precio"];
				$detapre_fecharegistro=date("Y-m-d H:i:s");
				$usua_id=$_SESSION['ces1313777_sessid_inicio'];
				$detapre_codigoform=$anam_id;
				$detapre_idgrid=$rs_bucampo->fields["fie_id"];
				
				$inserta_datadis="INSERT INTO dns_detalleprecuenta (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,bodega_id) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$rs_ld->fields["plantrai_bodega"]."');";
                $rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());
			 
		  
		  }
		  
          
	     
	
	     $rs_ld->MoveNext();	   

	  }
  }  

//dispositivos


}
else
{
?>
<script type="text/javascript">
<!--
alert("!!!Alerta precuenta no activa para el Paciente...");
//  End -->
</script>
<?php
}


}
?>
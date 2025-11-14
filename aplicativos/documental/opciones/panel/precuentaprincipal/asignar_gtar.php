<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$precu_id=$_POST["precu_id"];
$clie_id=$_POST["clie_id"];
$atenc_id=$_POST["atenc_id"];
$prod_id=$_POST["prod_id"];
$cantidad=$_POST["cantidad"];

$busca_medi="select * from efacsistema_producto where prod_id='".$prod_id."'";
$rs_medi = $DB_gogess->executec($busca_medi,array());

if($rs_medi->fields["prod_codigos"]!='')
{
   $busca_asignados="select sum(detapre_precioventa*detapre_cantidad) total from dns_detalleprecuentaprincipal where precu_id='".$precu_id."' and detapre_tipo=3 and detapre_codigop in (".$rs_medi->fields["prod_codigos"].")";
   $rs_listacl = $DB_gogess->executec($busca_asignados,array());
   
   $precio_n=round($rs_listacl->fields["total"],2);
   $valor=($precio_n*$rs_medi->fields["prod_porcentaje"])/100;
    $valor=round($valor,2);

}

///precio tarifario
$busca_clientec="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bclientec = $DB_gogess->executec($busca_clientec,array());	  
$conve_idc=$rs_bclientec->fields["conve_id"]; 
$n_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$conve_idc."'";
$rs_conve = $DB_gogess->executec($n_convenio,array());
$conve_id=$rs_conve->fields["conve_id"];
///precio tarifario


//1= MEDICAMENTOS

    $precio=0;
	$prod_preciocosto=0;
	if($conve_id=='' or $conve_id=='6')
    {
      
	  $precio=$rs_medi->fields["prod_precio"];
      $impuesto=$rs_medi->fields["impu_codigo"];
      $tari_codigo=$rs_medi->fields["tari_codigo"];
      $prod_preciocosto=$rs_medi->fields["prod_preciocosto"];

    }
	else
	{
	    $datos_produ="select * from efacsistema_producto left join cesdb_arextension.dns_gridconvenios on efacsistema_producto.prod_enlace=cesdb_arextension.dns_gridconvenios.prod_enlace where prod_codigo='".$rs_medi->fields["prod_codigo"]."' and gconve_convenio='".$conve_id."'";
$rs_produ = $DB_gogess->executec($datos_produ,array());
		
		$impuesto=$rs_medi->fields["impu_codigo"];
		$tari_codigo=$rs_medi->fields["tari_codigo"];
		$precio=$rs_produ->fields["gconve_precio"];
		$prod_preciocosto=$rs_produ->fields["prod_preciocosto"];	
		
		if(!($precio))
		{
		   $precio=$rs_medi->fields["prod_precio"];
           $impuesto=$rs_medi->fields["impu_codigo"];
           $tari_codigo=$rs_medi->fields["tari_codigo"];
           $prod_preciocosto=$rs_medi->fields["prod_preciocosto"];		
		}
	
	}


if($rs_medi->fields["prod_codigos"]!='')
{
           $precio=$valor;
           $impuesto=$rs_medi->fields["impu_codigo"];
           $tari_codigo=$rs_medi->fields["tari_codigo"];
           $prod_preciocosto=$valor;	

}
//2= INSUMOS

$detapre_tipo=3;
$mnupan_id=0;
$detapre_codigop=$rs_medi->fields["prod_codigo"];
$detapre_detalle=$rs_medi->fields["prod_nombre"];
$detapre_cantidad=$cantidad;
$detapre_precio=$precio;
$detapre_fecharegistro=date("Y-m-d H:i:s");
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$centro_id=$_SESSION['ces1313777_centro_id'];
$detapre_codigoform=0;
$detapre_idgrid=0;
$table='';
$bode_id=0;
$detapre_origen='DESCARGO APP';
$detapre_precioventa=$precio;

echo $inserta_datadis="INSERT INTO dns_detalleprecuentaprincipal (precu_id, clie_id, mnupan_id, detapre_tipo, detapre_codigop, detapre_detalle, detapre_cantidad, detapre_precio, detapre_fecharegistro, usua_id, centro_id, atenc_id, detapre_codigoform,detapre_idgrid,detapre_table,bodega_id,detapre_origen,detapre_precioventa) VALUES ('".$precu_id."','".$clie_id."','".$mnupan_id."','".$detapre_tipo."','".$detapre_codigop."','".$detapre_detalle."','".$detapre_cantidad."','".$detapre_precio."','".$detapre_fecharegistro."','".$usua_id."','".$centro_id."','".$atenc_id."','".$detapre_codigoform."','".$detapre_idgrid."','".$table."','".$bode_id."','".$detapre_origen."','".$detapre_precioventa."');";
$rs_insdatadis = $DB_gogess->executec($inserta_datadis,array());

?>


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

//datos del cliente

$lista_precuentasc="select * from dns_detalleprecuenta where precu_id='".$precu_id."' limit 1"; 
$okvalorc=$DB_gogess->executec($lista_precuentasc); 

$clie_id=$okvalorc->fields["clie_id"];
$busca_cliente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_bcliente = $DB_gogess->executec($busca_cliente,array());	  
$conve_id=$rs_bcliente->fields["conve_id"]; 

//datos del cliente

//busca asignacion

function saca_detallado($tipo,$precu_id,$doccab_id,$DB_gogess)
{
	  
	
	 $lista_data="select detapre_codigop,detapre_detalle,sum(detapre_cantidad) as detapre_cantidad,detapre_precio,detapre_precioventa,centrob_id from dns_detalleprecuenta where precu_id='".$precu_id."' and detapre_tipo='".$tipo."'  group by detapre_codigop,detapre_detalle,detapre_precio,detapre_precioventa order by detapre_codigop asc";
	
    $okv_data=$DB_gogess->executec($lista_data);   
    if($okv_data)
     {
		  while (!$okv_data->EOF) {		
		  
		     
		   $busca_existe="select * from beko_mhdetallefactura where mhdetfac_codprincipal='".$okv_data->fields["detapre_codigop"]."' and precu_id='".$precu_id."'";
		   $okv_bexiste=$DB_gogess->executec($busca_existe);
		  // if(!($okv_bexiste->fields["mhdetfac_id"]))
		  // {	
		  	//existe
			
			switch ($tipo) {
				case '1':
					{
					//medicamentos
					
						switch ($okv_data->fields["centrob_id"]) {
							case '55':
								{								
								
								 $busca_productop="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$okv_data->fields["detapre_codigop"]."'";
								 $okv_bp=$DB_gogess->executec($busca_productop);								
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=$okv_bp->fields["impu_codigo"];
								 $tarimh_codigo=$okv_bp->fields["tari_codigo"];
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								$inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
							   
								  							
								}
								break;
							case '9999':
								{
														
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=2;
								 $tarimh_codigo=0;
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;
								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								
								}
								break;
							case '8888':
								{
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=2;
								 $tarimh_codigo=0;
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								
								
								}
								break;
							default:
								   {
								   
								 $busca_productop="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$okv_data->fields["detapre_codigop"]."'";
								 $okv_bp=$DB_gogess->executec($busca_productop);								
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=$okv_bp->fields["impu_codigo"];
								 $tarimh_codigo=$okv_bp->fields["tari_codigo"];
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								   
								   
								   }	
						}
					
					//medicamentos
					}
					break;
				case '2':
					{
					//insumos
					
					switch ($okv_data->fields["centrob_id"]) {
							case '55':
								{								
								
								 $busca_productop="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$okv_data->fields["detapre_codigop"]."'";
								 $okv_bp=$DB_gogess->executec($busca_productop);								
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=$okv_bp->fields["impu_codigo"];
								 $tarimh_codigo=$okv_bp->fields["tari_codigo"];
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								$inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
							   
								  							
								}
								break;
							case '9999':
								{
														
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=2;
								 $tarimh_codigo=2;
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;
								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								
								}
								break;
							case '8888':
								{
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=2;
								 $tarimh_codigo=2;
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								
								
								}
								break;
							default:
								   {
								   
								 $busca_productop="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$okv_data->fields["detapre_codigop"]."'";
								 $okv_bp=$DB_gogess->executec($busca_productop);								
								
								 $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea='';
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=$okv_bp->fields["impu_codigo"];
								 $tarimh_codigo=$okv_bp->fields["tari_codigo"];
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
								   
								   
								   }	
						}
					
					
					//insumos
					}
					break;
				case '3':
					{
					//tarifario
					
					            $busca_productop="select * from efacsistema_producto where prod_codigo='".$okv_data->fields["detapre_codigop"]."'";
								$okv_bp=$DB_gogess->executec($busca_productop);								
								
								$docdet_codprincipal=$okv_data->fields["detapre_codigop"];
								$docdet_cantidad=$okv_data->fields["detapre_cantidad"];
								$docdet_descripcion=$okv_data->fields["detapre_detalle"];
								$docdet_preciou=$okv_data->fields["detapre_precioventa"];
								$impu_codigo=$okv_bp->fields["impu_codigo"];
								$tari_codigo=$okv_bp->fields["tari_codigo"];
								$docdet_total=round($docdet_preciou*$docdet_cantidad,2);
								$usua_id=$_SESSION['ces1313777_sessid_inicio'];
								$docdet_fecharegistro=date("Y-m-d H:i:s");
								
															
								
								$inserta_data="INSERT INTO beko_documentodetalle (doccab_id,docdet_codprincipal,docdet_cantidad,docdet_descripcion,docdet_preciou,impu_codigo,tari_codigo,docdet_total,usua_id,docdet_fecharegistro,precu_id) VALUES ('".$doccab_id."','".$docdet_codprincipal."','".$docdet_cantidad."','".$docdet_descripcion."','".$docdet_preciou."','".$impu_codigo."','".$tari_codigo."','".$docdet_total."','".$usua_id."','".$docdet_fecharegistro."','".$precu_id."');";
                               $okv_insert=$DB_gogess->executec($inserta_data);	
							   
					
					}
					break;
				case '4':
					{
					//mh
					              $busca_productop="select * from dns_hill where hill_codigo='".$okv_data->fields["detapre_codigop"]."'";
								  $okv_bp=$DB_gogess->executec($busca_productop);	
								
						         $mhdetfac_codprincipal=$okv_data->fields["detapre_codigop"];
								 $mhdetfac_cantidad=$okv_data->fields["detapre_cantidad"];
								 $mhdetfac_descripcion=$okv_data->fields["detapre_detalle"];
								 $mhdetfac_detallea=$okv_data->fields["detapre_tipohg"];
								 $mhdetfac_preciou=$okv_data->fields["detapre_precioventa"];
								 $impumh_codigo=$okv_bp->fields["hill_impucodigo"];
								 $tarimh_codigo=$okv_bp->fields["hill_taricodigo"];
								 $mhdetfac_total=round($mhdetfac_cantidad*$mhdetfac_preciou,2);
								 $usua_id=$_SESSION['ces1313777_sessid_inicio'];
								 $mhdetfac_fecharegistro=date("Y-m-d H:i:s");
								 $mhdetfac_porcentajemh=0;								 
	
								 
								 $inserta_data="insert into beko_mhdetallefactura (doccab_id,mhdetfac_codprincipal,mhdetfac_cantidad,mhdetfac_descripcion,mhdetfac_detallea,mhdetfac_preciou,impumh_codigo,tarimh_codigo,mhdetfac_total,usua_id,mhdetfac_fecharegistro,mhdetfac_porcentajemh,precu_id) values ('".$doccab_id."','".$mhdetfac_codprincipal."','".$mhdetfac_cantidad."','".$mhdetfac_descripcion."','".$mhdetfac_detallea."','".$mhdetfac_preciou."','".$impumh_codigo."','".$tarimh_codigo."','".$mhdetfac_total."','".$usua_id."','".$mhdetfac_fecharegistro."','".$mhdetfac_porcentajemh."','".$precu_id."')";
								 $okv_insd=$DB_gogess->executec($inserta_data);  
					   
					
					}
					break;	
				default:
				   {
				   
				   }
			}
			
			//existe
		  //}
		    $okv_data->MoveNext();
		  }	  
	  }
   

}

//busca asignacion

if($detallado=='1')
{
//detallado
  $tipo=1;
  saca_detallado($tipo,$precu_id,$doccab_id,$DB_gogess);
  $tipo=2;
  saca_detallado($tipo,$precu_id,$doccab_id,$DB_gogess);
  $tipo=3;
  saca_detallado($tipo,$precu_id,$doccab_id,$DB_gogess);
  $tipo=4;
  saca_detallado($tipo,$precu_id,$doccab_id,$DB_gogess);

}
else
{
//resumido


}



}
?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=444000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include("../../cfg/apicfg.php");
if($_SESSION['ces1313777_sessid_inicio'])
{
$sql1="";
$sql2="";
$sql3="";


$limpia_db="TRUNCATE api_productobodega";
$rs_stock = $DB_gogess->executec($limpia_db,array());

$campos_cmp="cantidad,bodega_id,bodega_nombre";

$lista_stock="select * from api_productos";
$rs_stock = $DB_gogess->executec($lista_stock,array());
	 if ($rs_stock)
	   {
		  while (!$rs_stock->EOF) {
		     
			 //============================================================================= 
			    
			 
			    $ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/producto/".$rs_stock->fields["id"]."/stock/");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: ' . 
								$contentType,
								$header1));
				$response =curl_exec($ch);
				
				$arreglo_data=array();
				$arreglo_data=json_decode($response, true);
				
				$array_cmp=array();
				$array_cmp=explode(",",$campos_cmp);				
				
				for($i=0;$i<count($arreglo_data);$i++)
				{				
						for($z=0;$z<count($array_cmp);$z++)
						{  
						   $nombrecampo=$array_cmp[$z];
						   if($nombrecampo=='fecha_creacion')
						   {
						   
						   $saca_fechad=explode("/",$arreglo_data[$i][$array_cmp[$z]]);   
						   $$nombrecampo=$saca_fechad[2]."-".$saca_fechad[1]."-".$saca_fechad[0];
						   
						   }
						   else
						   {
						   $$nombrecampo=$arreglo_data[$i][$array_cmp[$z]];
						   }
						}
						
						
						$producto_id=$rs_stock->fields["id"];
						$busca_daa="select * from api_productobodega where producto_id='".$producto_id."' and bodega_id='".$bodega_id."'";
						$okin_daa=$DB_gogess->executec($busca_daa,array());	
						
						if($okin_daa->fields["probod_id"]>0)
						{
						
						
						}
						else
						{						
						
						$inserta_data="INSERT INTO api_productobodega (producto_id,cantidad,bodega_id,bodega_nombre) VALUES ('".$producto_id."','".$cantidad."','".$bodega_id."','".$bodega_nombre."')";
						$okins=$DB_gogess->executec($inserta_data,array());						
						}
									
				}			
				
		  
		     //=============================================================================
			 
			$rs_stock->MoveNext();	
		  }
		}  




//print_r($arreglo_data);


echo "Actualizacion Terminada";
}

?>
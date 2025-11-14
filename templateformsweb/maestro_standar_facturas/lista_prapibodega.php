<?php
ini_set('display_errors',0);
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

$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/producto/".$id."/");
curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/bodega/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//curl_setopt($ch, CURLOPT_POST, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-type: ' . 
                $contentType,
                $header1));
$response =curl_exec($ch);

$arreglo_data=array();
$arreglo_data=json_decode($response, true);

//print_r($arreglo_data);
$campos_cmp="id,codigo,nombre,compra,produccion,venta";

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

$busca_data="select * from api_bodega where id='".$id."'";
$ok_budata=$DB_gogess->executec($busca_data,array());

if($ok_budata->fields["bode_id"]>0)
{


}
else
{
$inserta_data="INSERT INTO api_bodega (id,codigo,nombre,compra,produccion,venta) VALUES ('".$id."','".$codigo."','".$nombre."','".$compra."','".$produccion."','".$venta."');";
$okins=$DB_gogess->executec($inserta_data,array());
}




}


echo "Actualizacion Terminada";
}

?>
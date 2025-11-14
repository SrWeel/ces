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
curl_setopt($ch, CURLOPT_URL, "https://api.contifico.com/sistema/api/v1/producto/");
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

print_r($arreglo_data);




}


?>
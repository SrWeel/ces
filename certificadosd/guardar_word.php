<?php
include('qr/vendor/autoload.php');//Llamare el autoload de la clase que genera el QR
use Endroid\QrCode\QrCode;
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$valor_busca=$_POST["ireport"];
$cuadro_valor=array();
$director='../';
include_once("../cfg/clases.php");
include_once("../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();


$certif_id=@$_POST["ireport"];
$especi_id=@$_POST["especi_id"];
$clie_ci=$_POST["c1"];
$med_ci=$_POST["c2"];
$certifg_texto=$_POST["texto"];
$usua_id=@$_SESSION['ces1313777_sessid_inicio'];
$certifg_fecharegistro=date("Y-m-d");
$nd_otorgado=@$_POST["nd_otorgado"];

$table=@$_POST["table"];
$valor_id=@$_POST["valor_id"];
$centro_id=$_SESSION['ces1313777_centro_id'];
$certifg_especialidad=$_POST["certifg_especialidad"];
$usua_formaciondelprofesional=$_POST["usua_formaciondelprofesional"];

$valoralet=mt_rand(1,5000);
$aletorioid='';
$aletorioid='CERT'.$certif_id.$clie_ci.$med_ci.$valor_id.$_SESSION['ces1313777_sessid_inicio'].date("Ymdhis").$valoralet;


$codigo_dataqr=date("Y-m-d H:i:s").$table.'_'.$valor_id.' '.$clie_ci.' CERTIFICADO '.$_SESSION['ces1313777_sessid_inicio'].' TIPOCERT:'.$certif_id.' MED:'.$med_ci.' ID:'.$aletorioid;
$qrCode = new QrCode($codigo_dataqr);//Creo una nueva instancia de la clase
$qrCode->setSize("100");//Establece el tamaño del qr
//header('Content-Type: '.$qrCode->getContentType());
$image= $qrCode->writeString();//Salida en formato de texto 
$mombre_grafico='QR_'.date("YmdHis").$_SESSION['ces1313777_sessid_inicio'].'_'.$valor_id.$certif_id.'.jpg';
$qrCode->writeFile('temporal/'.$mombre_grafico);
$imageData = base64_encode($image);//Codifico la imagen usando base64_encode 

$certifg_texto=$certifg_texto.'<div align="center"><br><img src="temporal/'.$mombre_grafico.'" height="120" width="120" ><br>'.$aletorioid.'</div>';


$inserta_reg="insert into dns_certificadogenerado (certif_id,especi_id,clie_ci,med_ci,certifg_texto,usua_id,certifg_fecharegistro,nd_otorgado,emp_id,centro_id,certifg_especialidad,certifg_code) values ('".$certif_id."','".$especi_id."','".$clie_ci."','".$med_ci."','".$certifg_texto."','".$usua_id."','".$certifg_fecharegistro."','".$nd_otorgado."','1','".$centro_id."','".$usua_formaciondelprofesional."','".$aletorioid."');";

$file = fopen("cert".date("Y-m-d").".txt", "w");
fwrite($file, $inserta_reg . PHP_EOL);
fclose($file);

$rs_cert = $DB_gogess->executec($inserta_reg,array());
$id_regval=$DB_gogess->funciones_nuevoID(0);


}
?>
<input name="id_gen" type="hidden" id="id_gen" value="<?php echo $id_regval; ?>">
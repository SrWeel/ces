<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$director="../../../";
include("../../../cfg/clases.php");

$clie_rucci=$_POST["clie_rucci"];
$busca_datoscampos="select * from app_cliente where clie_rucci='".$clie_rucci."'";
$resul_campos = $DB_gogess->executec($busca_datoscampos,array());

//inserta padre

$clie_enlace=$resul_campos->fields["clie_enlace"];
$tipoident_codigo=$resul_campos->fields["repr_tipdoc"];
$repres_ci=$resul_campos->fields["repr_ci"];
$repres_nombre=utf8_encode($resul_campos->fields["repr_nombre"]);
$repres_profesion=utf8_encode($resul_campos->fields["repr_profesion"]);
$repres_ocupacion=utf8_encode($resul_campos->fields["repr_ocupacion"]);
$repres_telefono=$resul_campos->fields["repr_telftrabajo"];
$repres_celular=$resul_campos->fields["repr_celular"];
$repres_parentesco=$resul_campos->fields["repr_parentesco"];
$repres_observacion='';
$repres_nhijos=$resul_campos->fields["repr_nhijos"];
$tipol_id=$resul_campos->fields["repr_llamar"];
$repres_fecharegistro=date("Y-m-d H:i:s");
$usua_id=74;

if($repres_ci)
{
$insert_data="insert into dns_representante (clie_enlace,tipoident_codigo,repres_ci,repres_nombre,repres_profesion,repres_ocupacion,repres_telefono,repres_celular,repres_parentesco,repres_observacion,repres_nhijos,tipol_id,repres_fecharegistro,usua_id) values ('".$clie_enlace."','".$tipoident_codigo."','".$repres_ci."','".$repres_nombre."','".$repres_profesion."','".$repres_ocupacion."','".$repres_telefono."','".$repres_celular."','".$repres_parentesco."','".$repres_observacion."','".$repres_nhijos."','".$tipol_id."','".$repres_fecharegistro."','".$usua_id."')";
$resul_iins = $DB_gogess->executec($insert_data,array());
}
//inserta madre

$clie_enlace='';
$tipoident_codigo='';
$repres_ci='';
$repres_nombre='';
$repres_profesion='';
$repres_ocupacion='';
$repres_telefono='';
$repres_celular='';
$repres_parentesco='';
$repres_observacion='';
$repres_nhijos='';
$tipol_id='';
$repres_fecharegistro=date("Y-m-d H:i:s");
$usua_id=74;

$clie_enlace=$resul_campos->fields["clie_enlace"];
$tipoident_codigo=$resul_campos->fields["repr1_tipdoc"];
$repres_ci=$resul_campos->fields["repr1_ci"];
$repres_nombre=utf8_encode($resul_campos->fields["repr1_nombre"]);
$repres_profesion=utf8_encode($resul_campos->fields["repr1_profesion"]);
$repres_ocupacion=utf8_encode($resul_campos->fields["repr1_ocupacion"]);
$repres_telefono=$resul_campos->fields["repr1_telftrabajo"];
$repres_celular=$resul_campos->fields["repr1_celular"];
$repres_parentesco=$resul_campos->fields["repr1_parentesco"];
$repres_observacion='';
$repres_nhijos=$resul_campos->fields["repr1_nhijos"];
$tipol_id=$resul_campos->fields["repr1_llamar"];
$repres_fecharegistro=date("Y-m-d H:i:s");
$usua_id=74;

if($repres_ci)
{
$insert_data="insert into dns_representante (clie_enlace,tipoident_codigo,repres_ci,repres_nombre,repres_profesion,repres_ocupacion,repres_telefono,repres_celular,repres_parentesco,repres_observacion,repres_nhijos,tipol_id,repres_fecharegistro,usua_id) values ('".$clie_enlace."','".$tipoident_codigo."','".$repres_ci."','".$repres_nombre."','".$repres_profesion."','".$repres_ocupacion."','".$repres_telefono."','".$repres_celular."','".$repres_parentesco."','".$repres_observacion."','".$repres_nhijos."','".$tipol_id."','".$repres_fecharegistro."','".$usua_id."')";
$resul_iins = $DB_gogess->executec($insert_data,array());
}


//datos factura


$clie_enlace='';
$tipoident_codigo='';
$repres_ci='';
$repres_nombre='';
$repres_profesion='';
$repres_ocupacion='';
$repres_telefono='';
$repres_celular='';
$repres_parentesco='';
$repres_observacion='';
$repres_nhijos='';
$tipol_id='';
$repres_fecharegistro=date("Y-m-d H:i:s");
$usua_id=74;

$clie_enlace=$resul_campos->fields["clie_enlace"];
$tipoident_codigo=$resul_campos->fields["repr2_tipdoc"];
$repres_ci=$resul_campos->fields["repr2_ci"];
$repres_nombre=utf8_encode($resul_campos->fields["repr2_nombre"]);
$repres_profesion='';
$repres_ocupacion='';
$repres_telefono=$resul_campos->fields["repr2_telftrabajo"];
$repres_celular=$resul_campos->fields["repr2_celular"];
$repres_parentesco=4;
$repres_observacion=utf8_encode($resul_campos->fields["repr2_direccion"]);
$repres_nhijos=0;
$tipol_id=1;
$repres_fecharegistro=date("Y-m-d H:i:s");
$usua_id=74;

if($repres_ci)
{
$insert_data="insert into dns_representante (clie_enlace,tipoident_codigo,repres_ci,repres_nombre,repres_profesion,repres_ocupacion,repres_telefono,repres_celular,repres_parentesco,repres_observacion,repres_nhijos,tipol_id,repres_fecharegistro,usua_id) values ('".$clie_enlace."','".$tipoident_codigo."','".$repres_ci."','".$repres_nombre."','".$repres_profesion."','".$repres_ocupacion."','".$repres_telefono."','".$repres_celular."','".$repres_parentesco."','".$repres_observacion."','".$repres_nhijos."','".$tipol_id."','".$repres_fecharegistro."','".$usua_id."')";
$resul_iins = $DB_gogess->executec($insert_data,array());
}




?>
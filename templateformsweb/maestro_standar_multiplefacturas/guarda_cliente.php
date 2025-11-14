<?php
$tiempossss=4440000000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
/*doccab_rucci_cliente:$('#doccab_rucci_cliente').val(),
tipoident_codigo:$('#tipoident_codigo').val(),
doccab_nombrerazon_cliente:$('#doccab_nombrerazon_cliente').val(),
doccab_direccion_cliente:$('#doccab_direccion_cliente').val(),
doccab_telefono_cliente:$('#doccab_telefono_cliente').val(),
doccab_email_cliente:$('#doccab_email_cliente').val(),
emp_id:$('#emp_id').val()*/



if($_SESSION['ces1313777_sessid_inicio'])
{


$busca_cliente="select client_ciruc,client_id from efacfactura_cliente where client_ciruc='".trim($_POST["doccab_rucci_cliente"])."'";
$rs_cliente = $DB_gogess->executec($busca_cliente,array());

if($rs_cliente->fields["client_id"])
{

$actualiza_cliente="update efacfactura_cliente set sisu_id='".$_SESSION['ces1313777_sessid_inicio']."',emp_id='".trim($_POST["emp_id"])."',tipoident_codigocl='".trim($_POST["tipoident_codigo"])."',client_nombre='".trim($_POST["doccab_nombrerazon_cliente"])."',client_apellido='".trim($_POST["doccab_apellidorazon_cliente"])."',client_direccion='".trim($_POST["doccab_direccion_cliente"])."',client_telefono='".$_POST["doccab_telefono_cliente"]."',client_mail='".$_POST["doccab_email_cliente"]."' where client_id=".$rs_cliente->fields["client_id"];

$rs_okupdate = $DB_gogess->executec($actualiza_cliente,array());


}
else
{


$inserta_cliente="insert into efacfactura_cliente (emp_id,client_ciruc,client_nombre,client_direccion,client_telefono,client_mail,tipoident_codigocl,client_fechareg,sisu_id,client_apellido) values (".$_POST["emp_id"].",'".$_POST["doccab_rucci_cliente"]."','".$_POST["doccab_nombrerazon_cliente"]."','".$_POST["doccab_direccion_cliente"]."','".$_POST["doccab_telefono_cliente"]."','".$_POST["doccab_email_cliente"]."','".trim($_POST["tipoident_codigo"])."','".date("Y-m-d")."','".$_SESSION['ces1313777_sessid_inicio']."','".trim($_POST["doccab_apellidorazon_cliente"])."')";
$rs_okguardado = $DB_gogess->executec($inserta_cliente,array());


}


}

?>
<?php

$tiempossss=14000;

ini_set("session.cookie_lifetime",$tiempossss);

ini_set("session.gc_maxlifetime",$tiempossss);

session_start();



$director='../../';

include("../../cfg/clases.php");

include("../../cfg/declaracion.php");



//echo $_POST["cant_val"]."<br>";

//echo $_POST["produ_id"]."<br>";

//echo $_POST["enlace"]."<br>";

if($_SESSION['ces1313777_sessid_inicio'])

{





$busca_cliente="select clie_rucci,clie_id from app_cliente where clie_rucci='".trim($_POST["doccab_rucci_cliente"])."'";

$rs_cliente = $DB_gogess->executec($busca_cliente,array());



if($rs_cliente->fields["clie_rucci"])

{



 $actualiza_cliente="update app_cliente set clie_nombre='".trim($_POST["doccab_nombrerazon_cliente"])."',clie_direccion='".trim($_POST["doccab_direccion_cliente"])."',clie_telefono='".$_POST["doccab_telefono_cliente"]."',clie_email='".$_POST["doccab_email_cliente"]."' where clie_id=".$rs_cliente->fields["clie_id"];

$rs_okupdate = $DB_gogess->executec($actualiza_cliente,array());





}

else

{





$inserta_cliente="insert into app_cliente (emp_id,clie_rucci,clie_nombre,clie_direccion,clie_telefono,clie_email) values (".$_POST["emp_id"].",'".$_POST["doccab_rucci_cliente"]."','".$_POST["doccab_nombrerazon_cliente"]."','".$_POST["doccab_direccion_cliente"]."','".$_POST["doccab_telefono_cliente"]."','".$_POST["doccab_email_cliente"]."')";

$rs_okguardado = $DB_gogess->executec($inserta_cliente,array());





}





}



?>
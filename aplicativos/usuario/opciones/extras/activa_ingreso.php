<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
ini_set("session.gc_maxlifetime","14400");
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{

$director="../../../../";
include ("../../../../cfgclases/clases.php");



 $encuentraid="select * from ca_movimiento_cabecera where mc_aleatorio='".$_POST["mc_aleatorio"]."'";
 $rs_enc = $DB_gogess->Execute($encuentraid);
  if($rs_enc)
  {
     $idval=$rs_enc->fields["mc_id"];
  }


}

 echo " var result_id = '".$idval."'; ";
?>
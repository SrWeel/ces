<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include("campos/campos.php");
$objperfil=new objetosistema_perfil();


/*echo $_POST["usua_idp"]."<br>";
echo $_POST["form_idp"]."<br>";
echo $_POST["pregf_idp"]."<br>";
echo $_POST["resp_idp"]."<br>";

echo $_POST["result_textoindivudualp"]."<br>";
echo $_POST["result_textogeneralp"]."<br>";*/
//echo $_POST["result_estadop"]."<br>";

$fecha_hoy=date("Y-m-d");
//echo $actualiza_campo="update media_resultados set result_textogeneral='".$_POST["result_textogeneralp"]."' where  usua_id=".$_POST["usua_idp"]." and form_id=".$_POST["form_idp"]." and pregf_id=".$_POST["pregf_idp"];

  
  $actualiza_campo="update media_resultados set result_fecha='".$fecha_hoy."',result_textogeneral='".$_POST["result_textogeneralp"]."' where  usua_id=? and form_id=? and pregf_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
	$ok_actualiza=$DB_gogess->executec($actualiza_campo,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"]));
	


?>
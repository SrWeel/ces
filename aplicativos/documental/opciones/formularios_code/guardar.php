<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_periodoactual'])
{
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

$respondio_data="update media_resultados set result_respondio=1 where usua_id=? and form_id=? and pregf_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
$rs_respondiodata=$DB_gogess->executec($respondio_data,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"]));


if($_POST["tipocamposp"]=='radio')
{
  $elimina_data="update media_resultados set result_fecha='".$fecha_hoy."',result_textogeneral='',result_estado='' where usua_id=? and form_id=? and pregf_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
  $rs_eliminadata=$DB_gogess->executec($elimina_data,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"]));
  
  
  $busca_resultado="select * from media_resultados where usua_id=? and form_id=? and pregf_id=? and resp_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
  $rs_resultado = $DB_gogess->executec($busca_resultado,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"],$_POST["resp_idp"]));
  if($rs_resultado->fields["result_id"])
  {
    $actualiza_campo="update media_resultados set result_fecha='".$fecha_hoy."',result_textoindivudual='".$_POST["result_textoindivudualp"]."',result_textogeneral='".$_POST["result_textogeneralp"]."',result_estado='".$_POST["result_estadop"]."' where result_id=".$rs_resultado->fields["result_id"];
	$ok_actualiza=$DB_gogess->executec($actualiza_campo,array());
	
	
     
  }
 
  
}

if($_POST["tipocamposp"]=='checkbox')
{
//  $elimina_data="update media_resultados set result_textogeneral='',result_estado='' where usua_id=? and form_id=? and pregf_id=?";
 // $rs_eliminadata=$DB_gogess->executec($elimina_data,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"]));
  
  
  $busca_resultado="select * from media_resultados where usua_id=? and form_id=? and pregf_id=? and resp_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
  $rs_resultado = $DB_gogess->executec($busca_resultado,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"],$_POST["resp_idp"]));
  if($rs_resultado->fields["result_id"])
  {
    $actualiza_campo="update media_resultados set result_fecha='".$fecha_hoy."',result_textoindivudual='".$_POST["result_textoindivudualp"]."',result_textogeneral='".$_POST["result_textogeneralp"]."',result_estado='".$_POST["result_estadop"]."' where result_id=".$rs_resultado->fields["result_id"];
	$ok_actualiza=$DB_gogess->executec($actualiza_campo,array());
	
	
     
  }
 
  
}

if($_POST["tipocamposp"]=='text')
{
//  $elimina_data="update media_resultados set result_textogeneral='',result_estado='' where usua_id=? and form_id=? and pregf_id=?";
 // $rs_eliminadata=$DB_gogess->executec($elimina_data,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"]));
  
  
  $busca_resultado="select * from media_resultados where usua_id=? and form_id=? and pregf_id=? and resp_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
  $rs_resultado = $DB_gogess->executec($busca_resultado,array($_POST["usua_idp"],$_POST["form_idp"],$_POST["pregf_idp"],$_POST["resp_idp"]));
  if($rs_resultado->fields["result_id"])
  {
    $actualiza_campo="update media_resultados set result_fecha='".$fecha_hoy."',result_textoindivudual='".$_POST["result_textoindivudualp"]."',result_textogeneral='".$_POST["result_textogeneralp"]."',result_estado='".$_POST["result_estadop"]."' where result_id=".$rs_resultado->fields["result_id"];
	$ok_actualiza=$DB_gogess->executec($actualiza_campo,array());
	
	
     
  }
 
  
}


}
else
{
 echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesión a caducado presione F5 para continuar...</div>';

}
?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include("campos/campos.php");
$objperfil=new objetosistema_perfil();

$barra_gr='';
$respondio_data="select distinct pregf_id,result_archivo from media_resultados where usua_id=? and form_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."' and pregf_id=".$_POST["pregf_id"];
$rs_respondiodata=$DB_gogess->executec($respondio_data,array($_SESSION['ces1313777_sessid_inicio'],$_POST["form_idp"],1));

//echo $_POST["pregf_id"]."<br>";
//echo $_POST["form_idp"]."<br>";
if($rs_respondiodata->fields["result_archivo"])
{
echo '<a href="gr/uploads/'.$rs_respondiodata->fields["result_archivo"].'" target="_blank"><img src="images/verarchivo.png" ></a>';
}


}
else
{
 echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesión a caducado presione F5 para continuar...</div>';

}
?>
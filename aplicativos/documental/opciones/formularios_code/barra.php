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
$respondio_data="select distinct pregf_id,result_respondio from media_resultados where usua_id=? and form_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."' and result_respondio=?";
$rs_respondiodata=$DB_gogess->executec($respondio_data,array($_SESSION['ces1313777_sessid_inicio'],$_POST["form_idp"],1));
$cant_responde=$rs_respondiodata->RecordCount();


$npreguntas_data="select distinct pregf_id,result_respondio from media_resultados where usua_id=? and form_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
$rs_npreguntadata=$DB_gogess->executec($npreguntas_data,array($_SESSION['ces1313777_sessid_inicio'],$_POST["form_idp"]));
$cant_preguntas=$rs_npreguntadata->RecordCount();



if($cant_preguntas>1)
{
  $mitad_preg=$cant_preguntas/2;
}

//echo $cant_preguntas."--".$mitad_preg."--".$cant_responde;

if($cant_responde>=0 and $cant_responde<@$mitad_preg)
{
$barra_gr='<img src="images/barra_rojo.png" width="10" height="5">';
}

if($cant_responde>=@$mitad_preg and $cant_responde<$cant_preguntas)
{
$barra_gr='<img src="images/barra_rojo.png" width="40" height="5">';
}

if($cant_responde>0)
{
if($cant_responde==$cant_preguntas)
{
$barra_gr='<img src="images/barra_verde.png" width="60" height="5">';
}
}
else
{
$barra_gr='<img src="images/barra_rojo.png" width="5" height="5">';
}

echo $barra_gr;


}
else
{
 echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesión a caducado presione F5 para continuar...</div>';

}
?>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


$busca_lista="select * from dns_representante where repres_id=".$_POST["repres_idx"];
$rs_obtiene = $DB_gogess->executec($busca_lista,array());

echo '<input name="repres_idxval" type="hidden" id="repres_idxval" value="'.$rs_obtiene->fields["repres_id"].'" />';
echo '<input name="tipoident_codigoxval" type="hidden" id="tipoident_codigoxval" value="'.$rs_obtiene->fields["tipoident_codigo"].'" />';
echo '<input name="repres_cixval" type="hidden" id="repres_cixval" value="'.$rs_obtiene->fields["repres_ci"].'" />';
echo '<input name="repres_nombrexval" type="hidden" id="repres_nombrexval" value="'.$rs_obtiene->fields["repres_nombre"].'" />';
echo '<input name="repres_telefonoxval" type="hidden" id="repres_telefonoxval" value="'.$rs_obtiene->fields["repres_telefono"].'" />';
echo '<input name="repres_parentescoxval" type="hidden" id="repres_parentescoxval" value="'.$rs_obtiene->fields["repres_parentesco"].'" />';
echo '<input name="repres_observacionxval" type="hidden" id="repres_observacionxval" value="'.$rs_obtiene->fields["repres_observacion"].'" />';


}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}


?>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

if(@$_SESSION['ces1313777_jobt_id']==13)
{
?>
<select class="form-control" name="usua_idvaltx" id="usua_idvaltx"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
<option value="" >--Seleccion Terapista--</option>
<?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido',' ',' where especi_id='.$_POST["especi_idtx"].' order by usua_apellido asc',$DB_gogess);
?>
</select>
<?php
}
else
{
?>
<select class="form-control" name="usua_idvaltx" id="usua_idvaltx"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
<option value="" >--Seleccion Terapista--</option>
<?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido',' ',' where especi_id='.$_POST["especi_idtx"].' and centro_id='.$_POST["centro_id"].' order by usua_apellido asc',$DB_gogess);
?>
</select>

<?php
}
?>
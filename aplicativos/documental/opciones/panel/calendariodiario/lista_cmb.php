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

$num=$_POST["num"];
$prof_idvalx=$_POST["prof_idvalx"];

$buespe='';
$buespe="select distinct us.usua_id from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where prof.prof_id='".$prof_idvalx."' and prof.prof_id not in (38,777,888,911116,77)";

?>
<select class="form-control" name="usua_idvalx<?php echo $num; ?>" id="usua_idvalx<?php echo $num; ?>" style="width:150px" onchange="valida_dataagenda('<?php echo $num; ?>')">
        <option value="">--Profesional--</option>
        <?php
         $objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_id in ('.$buespe.') and usua_agenda=1 order by usua_nombre asc',$DB_gogess);
        ?>
</select>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


$busca_lista="select * from  faesa_evoluciondetalle where evoludet_id=".$_POST["evoludet_idx"];
$rs_obtiene = $DB_gogess->executec($busca_lista,array());

echo '<input name="evoludet_idxval" type="hidden" id="evoludet_idxval" value="'.$rs_obtiene->fields["evoludet_id"].'" />';
echo '<input name="evoludet_fechaxval" type="hidden" id="evoludet_fechaxval" value="'.$rs_obtiene->fields["evoludet_fecha"].'" />';
echo '<input name="evoludet_horaxval" type="hidden" id="evoludet_horaxval" value="'.$rs_obtiene->fields["evoludet_hora"].'" />';
echo '<input name="evoludet_notasxval" type="hidden" id="evoludet_notasxval" value="'.$rs_obtiene->fields["evoludet_notas"].'" />';
echo '<input name="evoludet_farmaindicaxval" type="hidden" id="evoludet_farmaindicaxval" value="'.$rs_obtiene->fields["evoludet_farmaindica"].'" />';
echo '<input name="evoludet_farmaotrosxval" type="hidden" id="evoludet_farmaotrosxval" value="'.$rs_obtiene->fields["evoludet_farmaotros"].'" />';

}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}


?>
<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo 'n
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession'.$_POST["fie_id"].'","divDialog_acsession'.$_POST["fie_id"].'",400,400,"",0,0,0,0,0,0);
//  End -->
</script>n

<div id="divBody_acsession'.$_POST["fie_id"].'"></div>
';

}
?>
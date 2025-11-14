<?php
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if(@$_SESSION['ces1313777_sessid_inicio'])
{
   //echo $_POST["atenc_id"]."<br>";
   //echo $_POST["estaatenc_id"];
   $estadoval='';
   switch (trim($_POST["estaatenc_id"])) {
    case '1':
        $estadoval='SUBSECUENTE';		
        break;
    case '2':
        $estadoval='ALTA';
        break;
    case '3':
        $estadoval='DESERCION';
        break;
	case '4':
        $estadoval='PRIMERA VEZ';
        break;	
   }
   
   
   $actuali_data="update dns_atencion set atenc_estadopsicologia='".$estadoval."',atenc_fechaatpsicologia='".date("Y-m-d H:i:s")."' where atenc_id='".$_POST["atenc_id"]."';";
   $rs_actudata = $DB_gogess->executec($actuali_data,array());


}

?>
<?php
if(!(@$_SESSION['ces1313777_sessid_inicio']))
{

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession_estado","divDialog_acsession_estado",400,400,"",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession_estado"></div>
';

}
?>
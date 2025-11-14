<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if($_SESSION['ces1313777_sessid_inicio'])
{

$planc_codigoc=$_POST["planc_codigoc"];

$saca_menos1=array();
$saca_menos1=explode(".",$planc_codigoc);

$cuenta_num=count($saca_menos1);

$menosuno=$cuenta_num-1;

$cuenta_anterior='';
for($i=0;$i<$menosuno;$i++)
{
  $cuenta_anterior=$cuenta_anterior.$saca_menos1[$i].'.';
}

$cuenta_anterior=substr($cuenta_anterior,0,-1);
echo "Cuenta anterior:".$cuenta_anterior;
$busca_sitieneasientos="select count(*) as totalasientos from lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace where detcc_cuentacontable='".$cuenta_anterior."'";
$rs_tienevalores = $DB_gogess->executec($busca_sitieneasientos);

if($rs_tienevalores->fields["totalasientos"]>0)
{
?>
<script type="text/javascript">
<!--
alert("La cuenta principal tiene ya valores no se puede dividir en sub cuentas...");
$('#boton_guardarformdatapc').hide();
$('#boton_guardarformdata2pc').hide();

//  End -->
</script>
<?php
}
else
{
?>

<script type="text/javascript">
<!--

$('#boton_guardarformdatapc').show();
$('#boton_guardarformdata2pc').show();

//  End -->
</script>

<?php
}


}

?>

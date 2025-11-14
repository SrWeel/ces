<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$cedula_paciente=$_POST["cedula_paciente"];

$obtine_dataex="select * from app_proveedor where provee_cedula='".$cedula_paciente."' or provee_ruc='".$cedula_paciente."'";
$rs_obtdataex = $DB_gogess->executec($obtine_dataex,array());
$provee_id=$rs_obtdataex->fields["provee_id"];

if($provee_id>0)
{
?>
<script type="text/javascript">
<!--

alert("Registro ya existe en proveedor por favor buscar en el icono de la lupa");
ver_newform();

//  End -->
</script>
<?php
}
else
{

$obtine_data="select * from app_cliente where clie_rucci='".$cedula_paciente."'";
$rs_obtdata = $DB_gogess->executec($obtine_data,array());

$tipoci_id=$rs_obtdata->fields["tipoci_id"];
if($tipoci_id==1)
{
$tipoident_codigocl='05';
}
if($tipoci_id==2)
{
$tipoident_codigocl='06';
}
if($tipoci_id==3)
{
$tipoident_codigocl='08';
}

$tipop_id=1;
$provee_cedula=$rs_obtdata->fields["clie_rucci"];
$provee_nombre=$rs_obtdata->fields["clie_nombre"]." ".$rs_obtdata->fields["clie_apellido"];
$provee_direccion=$rs_obtdata->fields["clie_direccion"];
$provee_nombrecomercial='';
$provee_telefono=$rs_obtdata->fields["clie_celular"];
$provee_email=$rs_obtdata->fields["clie_email"];

?>
<script type="text/javascript">
<!--

$('#tipoident_codigocl').val('<?php echo $tipoident_codigocl; ?>');
$('#tipop_id').val('<?php echo $tipop_id; ?>');
$('#provee_cedula').val('<?php echo $provee_cedula; ?>');
$('#provee_nombre').val('<?php echo $provee_nombre; ?>');
$('#provee_direccion').val('<?php echo $provee_direccion; ?>');
$('#provee_nombrecomercial').val('<?php echo $provee_nombrecomercial; ?>');
$('#provee_telefono').val('<?php echo $provee_telefono; ?>');
$('#provee_email').val('<?php echo $provee_email; ?>');

//  End -->
</script>

<?php
}
?>


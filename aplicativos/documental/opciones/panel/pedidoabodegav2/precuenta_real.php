<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$ci_paciente=$_POST["ci_paciente"];
$partop_id=$_POST["partop_id"];
$centro_id=$_POST["centro_id"];

//busca parte operatorio

$buscappop="select * from lpin_parteoperatorio where partop_id='".$partop_id."'";
$rs_buscpop = $DB_gogess->executec($buscappop);

$partop_plasticos=0;
$partop_plasticosprecuenta=0;
$partop_plasticos=$rs_buscpop->fields["partop_plasticos"];
$convepr_idop=$rs_buscpop->fields["convepr_id"];
//busca parte operatorio




$busca_asigancion="select * from dns_precuenta where partopx_id='".$partop_id."'";
$rs_pasignacion = $DB_gogess->executec($busca_asigancion);

if($rs_pasignacion->fields["precu_id"]>0)
{

echo "ASIGNADO A PRECUENTA NUMERO: ".$rs_pasignacion->fields["precu_id"]."<br>";

$busca_datax="select * from app_cliente where clie_id='".$rs_pasignacion->fields["clie_id"]."'";
$rs_udatax = $DB_gogess->executec($busca_datax,array());

echo "PACIENTE: ".$rs_udatax->fields["clie_nombre"]." ".$rs_udatax->fields["clie_apellido"];


}
else
{


$lista_usv="select * from app_usuario where usua_id='".$_SESSION['ces1313777_sessid_inicio']."'";
$rs_usv= $DB_gogess->executec($lista_usv,array());
$centrousuario_id=$rs_usv->fields['centro_id'];
$usua_enlace=$rs_usv->fields["usua_enlace"];
$usua_permitirreposicion=$rs_usv->fields["usua_permitirreposicion"];
$usua_permitirotrbredp=$rs_usv->fields["usua_permitirotrbredp"];
$precu_id=0;
?>
<br>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#E9F1F5"><div align="center">CI</div></td>
	<td bgcolor="#E9F1F5"><div align="center">PACIENTE</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CONVENIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">CATEGORIA</div></td>
	<td bgcolor="#ABC9D8"><div align="center"><strong>ESPECIALIDAD</strong></div></td>
    <td bgcolor="#E9F1F5"><div align="center">OBSERVACION</div></td>
    <td bgcolor="#E9F1F5"><div align="center">FECHA INICIO</div></td>
	<td bgcolor="#E9F1F5"><div align="center">FECHA FIN</div></td>
  </tr>
<?php
$lista_bprecuenta="select * from dns_precuenta inner join app_cliente on dns_precuenta.clie_id=app_cliente.clie_id where clie_rucci='".$ci_paciente."' and precu_activo=1 order by precu_id desc limit 1";
$rs_bprecuenta = $DB_gogess->executec($lista_bprecuenta,array());

if($rs_bprecuenta)
 {
	while (!$rs_bprecuenta->EOF) { 
	
	
	$clie_id=$rs_bprecuenta->fields["clie_id"];
	$precu_id=$rs_bprecuenta->fields["precu_id"];
	$atenc_enlace=$rs_bprecuenta->fields["atenc_enlace"];
	
	$lista_aten="select * from dns_atencion where atenc_enlace='".$atenc_enlace."'";
	$rs_aten = $DB_gogess->executec($lista_aten,array());
	
	$atenc_id=$rs_aten->fields["atenc_id"];
	
	$convepr_id=$rs_bprecuenta->fields["convepr_id"];
	$lista_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}
	
//echo $red_publica;	
	
	$busca_categoria="select categesp_id,categesp_nombre from dns_categoriaespecialidad where categesp_id='".$rs_bprecuenta->fields["categesp_id"]."'";
	$rs_categoria = $DB_gogess->executec($busca_categoria);	
	
	$busca_especialidad="select especi_id,especi_nombre from dns_especialidad where especi_paraprecuenta=1 and especi_id='".$rs_bprecuenta->fields["especipr_id"]."'";
	$rs_especialidad = $DB_gogess->executec($busca_especialidad);
	$partop_plasticosprecuenta=0;
	if($rs_bprecuenta->fields["especipr_id"]=='27')	
	{	  
	  $partop_plasticosprecuenta=1;
	}
	
	?>

  <tr>
    <td><div align="center"><?php echo $rs_bprecuenta->fields["clie_rucci"]; ?></div></td>
	<td><div align="center"><?php echo $rs_bprecuenta->fields["clie_nombre"].' '.$rs_bprecuenta->fields["clie_apellido"]; ?></div></td>
	<td><div align="center"><?php echo $rs_conve->fields["conve_nombre"].' RED PUBLICA: <b>'.$red_publica.'</b>'; ?></div></td>
	
	<td><div align="center"><?php echo $rs_categoria->fields["categesp_nombre"]; ?></div></td>
	<td bgcolor="#CEE6F0"><div align="center"><strong><?php echo $rs_especialidad->fields["especi_nombre"]; ?></strong></div></td>
	
    <td><div align="center"><?php echo $rs_bprecuenta->fields["precu_observacion"]; ?></div></td>
    <td><div align="center"><?php echo $rs_bprecuenta->fields["precu_fechainicio"]; ?></div></td>
	 <td><div align="center"><?php echo $rs_bprecuenta->fields["precu_fechafinal"]; ?></div></td>
  </tr>

	 
	 <?php	
	
	   $rs_bprecuenta->MoveNext();	
	}	
} 
//$usua_permitirotrbredp=1;	
?>
</table>
<br><br>

<?php
//busca si es redpublica en po

    $lista_conveniox="select * from cesdb_arextension.dns_convenios where conve_id='".$convepr_idop."'";
	$rs_convex= $DB_gogess->executec($lista_conveniox,array());
	$rs_convex->fields["conve_redpublica"];
	
	$code_redpx=0;
	$code_redpx=$rs_convex->fields["conve_redpublica"];

//busca si es redpublica en po
$red_publica_op='NO';
if($code_redpx==1)
{
$red_publica_op='SI';

}

$bloqueo=0;
if($red_publica_op!==$red_publica)
{

echo "<div style='color:#FF0000'>ALERTA!!!! La precuenta y el parte operatorio no son iguales en el tipo de seguro....</div>";
$bloqueo=1;

}


//verifica plasticos
if($partop_plasticos!=$partop_plasticosprecuenta)
{

echo "<div style='color:#FF0000'>ALERTA!!!! La precuenta y el parte operatorio no son iguales en la categor&iacute;a para plasticos....</div>";
$bloqueo=1;

}
?>

<div id="ejecuta_datax">
<?php
if($bloqueo==0)
{
$red_publica='NO';
if($red_publica=='NO')
{
?>
<input type="button" name="Submit" value="PROCESAR DASCARGO" onclick="procesa_data_pboega('<?php echo $centro_id; ?>','<?php echo $partop_id; ?>','<?php echo $precu_id; ?>','<?php echo $clie_id; ?>')" />
<?php
}
else
{
?>

<input type="button" name="Submit" value="PROCESAR DASCARGO RED PUBLICA" onclick="procesa_data_redpu('<?php echo $centro_id; ?>','<?php echo $partop_id; ?>','<?php echo $precu_id; ?>','<?php echo $clie_id; ?>')" />

<?php
}


}
?>
</div>

<?php
}
?>


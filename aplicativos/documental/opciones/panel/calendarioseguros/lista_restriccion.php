<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//echo $_POST["fecha_inicioval"];

//echo ;
$clie_id=$_POST["clie_id"];
$usua_idvalx=$_POST["usua_idvalx"];
$fecha_inicioval=$_POST["fecha_inicioval"];
$hora=$_POST["hora"];
$ord=$_POST["ord"];

//echo $clie_id."<br>";
//echo $usua_idvalx."<br>";
//echo $fecha_inicioval."<br>";
//echo $hora."<br>";

$restriccio1=1;
$restriccio2=1;

$lista_data='';
//verifica que el paciente no este en otracita a esa hora
$busca_existepaciente="select * from faesa_terapiasregistro where terap_cancelado=0 and clie_id='".$clie_id."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscapaciente = $DB_gogess->executec($busca_existepaciente,array());
if($rs_okbuscapaciente)
{
	while (!$rs_okbuscapaciente->EOF)
	{	
	  
	  $datos_cliente="select * from app_cliente where clie_id='".$rs_okbuscapaciente->fields["clie_id"]."'";
      $rs_cliente = $DB_gogess->executec($datos_cliente,array());
	  
	  $datos_US="select * from app_usuario where usua_id='".$rs_okbuscapaciente->fields["usua_id"]."'";
      $rs_US = $DB_gogess->executec($datos_US,array());
	  
	  $datos_quirofano="select * from lospinos_quirofanos where quiro_id='".$rs_okbuscapaciente->fields["quiro_id"]."'";
      $rs_quirofano = $DB_gogess->executec($datos_quirofano,array());
			
			
//echo $rs_quirofano->fields["quiro_nombre"]."|".$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"]."|".$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"]."|".$rs_okbuscapaciente->fields["terap_fecha"]."|".$rs_okbuscapaciente->fields["terap_hora"]."|".$rs_okbuscapaciente->fields["terap_motivo"]."<br>";
	  
 $lista_data.='<tr>
    <td>'.$rs_quirofano->fields["quiro_nombre"].'</td>
    <td>'.$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"].'</td>
    <td>'.$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_fecha"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_hora"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_motivo"].'</td>
  </tr>';
	
	  $rs_okbuscapaciente->MoveNext();
	}
}
//verifica que el paciente no este en otracita a esa hora



//busca si el doctor ya esta a esa hora en otra cita
$busca_existemedico="select * from faesa_terapiasregistro where terap_cancelado=0 and usua_id='".$usua_idvalx."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscamedico = $DB_gogess->executec($busca_existemedico,array());

if($rs_okbuscamedico)
{
	while (!$rs_okbuscamedico->EOF)
	{	
	  
	  $datos_US="select * from app_usuario where usua_id='".$rs_okbuscapaciente->fields["usua_id"]."'";
      $rs_US = $DB_gogess->executec($datos_US,array());
	  
	  $datos_cliente="select * from app_cliente where clie_id='".$rs_okbuscapaciente->fields["clie_id"]."'";
      $rs_cliente = $DB_gogess->executec($datos_cliente,array());
	  
	  $datos_quirofano="select * from lospinos_quirofanos where quiro_id='".$rs_okbuscapaciente->fields["quiro_id"]."'";
      $rs_quirofano = $DB_gogess->executec($datos_quirofano,array());
			
//echo $rs_quirofano->fields["quiro_nombre"]."|".$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"]."|".$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"]."|".$rs_okbuscapaciente->fields["terap_fecha"]."|".$rs_okbuscapaciente->fields["terap_hora"]."|".$rs_okbuscapaciente->fields["terap_motivo"]."<br>";
	  
 $lista_data.='<tr>
    <td>'.$rs_quirofano->fields["quiro_nombre"].'</td>
    <td>'.$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"].'</td>
    <td>'.$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_fecha"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_hora"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_motivo"].'</td>
  </tr>';
	
	  $rs_okbuscamedico->MoveNext();
	}
}
//busca si el doctor ya esta a esa hora en otra cita


if($quiro_id>0)
{


//busca si el quirofano ya esta a esa hora en otra cita
$busca_existemedico="select * from faesa_terapiasregistro where terap_cancelado=0 and quiro_id='".$quiro_id."' and terap_fecha='".$fecha_inicioval."' and terap_hora='".$hora."'";
$rs_okbuscamedico = $DB_gogess->executec($busca_existemedico,array());

if($rs_okbuscamedico)
{
	while (!$rs_okbuscamedico->EOF)
	{	
	  
	  $datos_US="select * from app_usuario where usua_id='".$rs_okbuscapaciente->fields["usua_id"]."'";
      $rs_US = $DB_gogess->executec($datos_US,array());
	  
	  $datos_cliente="select * from app_cliente where clie_id='".$rs_okbuscapaciente->fields["clie_id"]."'";
      $rs_cliente = $DB_gogess->executec($datos_cliente,array());
	  
	  $datos_quirofano="select * from lospinos_quirofanos where quiro_id='".$rs_okbuscapaciente->fields["quiro_id"]."'";
      $rs_quirofano = $DB_gogess->executec($datos_quirofano,array());
			
			
//echo $rs_quirofano->fields["quiro_nombre"]."|".$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"]."|".$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"]."|".$rs_okbuscapaciente->fields["terap_fecha"]."|".$rs_okbuscapaciente->fields["terap_hora"]."|".$rs_okbuscapaciente->fields["terap_motivo"]."<br>";
	  
$lista_data.='<tr>
    <td>'.$rs_quirofano->fields["quiro_nombre"].'</td>
    <td>'.$rs_cliente->fields["clie_nombre"]." ".$rs_cliente->fields["clie_apellido"].'</td>
    <td>'.$rs_US->fields["usua_nombre"]." ".$rs_US->fields["usua_apellido"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_fecha"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_hora"].'</td>
    <td>'.$rs_okbuscapaciente->fields["terap_motivo"].'</td>
  </tr>';
	
	  $rs_okbuscamedico->MoveNext();
	}
}
//busca si el quirofano ya esta a esa hora en otra cita




}





}
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#EFD0C2"><div align="center">Quirofano</div></td>
    <td bgcolor="#EFD0C2"><div align="center">Paciente</div></td>
    <td bgcolor="#EFD0C2"><div align="center">Medico</div></td>
    <td bgcolor="#EFD0C2"><div align="center">Fecha</div></td>
    <td bgcolor="#EFD0C2"><div align="center">Hora</div></td>
    <td bgcolor="#EFD0C2"><div align="center">Motivo</div></td>
  </tr>
  <?php
    echo $lista_data;
  ?>
</table>
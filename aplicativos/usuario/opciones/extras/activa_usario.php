<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director="../../../../";
include ("../../../../cfgclases/clases.php");



//echo "guarda serviciosss";
if($_SESSION['ces1313777_sessid_inicio'])
{

//echo '<br><br>';
//echo $_POST["check_admempresa"];	
	
	
	//habilita/desahabilita usuario

	if($_POST["check_habilitar"]==1)
	{	
	  $check_habilitar=1;
	}
	else
	{
	  $check_habilitar='';
	}
	
	$fechaactual=date("Y-m-d H:i:s");
	
$actualiza_usuario="update factur_usuarios set usr_usuarioactiva=".$_SESSION['ces1313777_sessid_inicio'].",usr_fecha_habilitacion='".$fechaactual."', usr_activo='".$check_habilitar."' where usr_cedula=".$_POST["usr_cedulax"];
	
	
	//$_SESSION['ces1313777_sessid_inicio']
	
	$ok3=$DB_gogess->Execute($actualiza_usuario);
	
		
}
?>
&nbsp;
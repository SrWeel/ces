<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_POST["usua_idx"])
{

if($_SESSION['ces1313777_sessid_inicio'])
{

//---------------------------------------------------

//echo $_POST["pVar1"];

//Llamando objetos

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");


// echo $_POST["mnupan_idx"]."<br>";
 //echo $_POST["activox"]."<br>";
 //echo $_POST["makerx"]."<br>";
 //echo $_POST["checkerx"]."<br>";
// echo $_POST["usua_cirucx"]."<br>";

 if($_POST["activox"]=='true')
 {
    $activox_val=1;

 }
 else
 {
    $activox_val=0;
 }


$banderaexiste=0;
$listalinkstr="select * from cesdb_arextension.app_usuarioshistorial where usua_id='".$_POST["usua_idx"]."' and per_codobj=".$_POST["mnupan_idx"];

	

	$resultadolktr = $DB_gogess->executec($listalinkstr,array());	

	if($resultadolktr)

	{  

      while (!$resultadolktr->EOF) {

	  

	  $banderaexiste=1;

	  

	  $resultadolktr->MoveNext();

	  }

	 } 



if($banderaexiste)
{

   $actualiza="update cesdb_arextension.app_usuarioshistorial set per_activo='".$activox_val."' where usua_id='".$_POST["usua_idx"]."' and per_codobj=".$_POST["mnupan_idx"];
   $okval = $DB_gogess->executec($actualiza,array());

}
else
{

   $actualiza="insert into cesdb_arextension.app_usuarioshistorial (usua_id,per_codobj,per_activo) values ('".$_POST["usua_idx"]."','".$_POST["mnupan_idx"]."','".$activox_val."')";
   $okval = $DB_gogess->executec($actualiza,array());


}

//---------------------------------------------------

}

else

{

echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';

}

}

else

{

echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000">Para asignar el perfil debe seleccionar o crear un usuario...</div>';

}

?>
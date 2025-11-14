<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set("session.gc_maxlifetime","4560000");
session_start();
//Llamando objetos

/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='mp')
	{
	///
	     $nombrevarget='';
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			//$$tags[$i]=$valores[$i];
			$nombrevarget=$tags[$i];
			$$nombrevarget=$valores[$i];
		}
		else
		{
			//$$tags[$i]=0;
			$nombrevarget=$tags[$i];
			$$nombrevarget=0;
	    }
	///
	}
///
}

$decodevalor ='';
if(@$mp)
{   
   @$decodevalor = base64_decode($mp);
}


$splitvar=explode("&",@$decodevalor);
$nombreget='';

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
 // echo $splitvar[$ivari]."<br>";
  $sacadatav=explode("=",$splitvar[$ivari]);
  
  //if (preg_match('/^[a-z\d_=]{1,10}$/i',$sacadatav[1])) {
  
  //@$$sacadatav[0]=$sacadatav[1];
  
  $nombreget=$sacadatav[0];
  @$$nombreget=$sacadatav[1];
  
  //}

}


///Bloque links grandes
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombre_var='';
for($i=0;$i<$numero2;$i++){ 
//$$tags2[$i]=$valores2[$i]; 
  $nombre_var=$tags2[$i];
  $$nombre_var=$valores2[$i];
}

if(!(@$table))
{
$table=@$valorlocal;
}


include_once("cfgclases/clases.php");

 if(@$_SESSION['sessidadm1777_pichincha'])
{
  
   $sessid=$objencripta->decrypt(trim($_SESSION['sessidadm1777_pichincha']));
   
}

  if (@$close==1)
  {
  
      $_SESSION['novpichincha1777_ususer']="";
	  $_SESSION['novpichincha1777_pwd']="";
	  $_SESSION['novpichincha1777_name']="";	
	    $_SESSION['oficinausu1777']="";	
		 $_SESSION['iduser1777']="";	
		 $_SESSION['sessidadm1777_pichincha']="";
  }
  
  if(@$_SESSION['sessidadm1777_pichincha'])
  {
$objacceso_session->select_session(trim($_SESSION['sessidadm1777_pichincha']),$DB_gogess);
$objacceso_session->select_perfil($objacceso_session->sess_perid,$DB_gogess);


}

if ($objacceso_session->sess_user and $_SESSION['novpichincha1777_ususer'])
{

    $permisotabla=strchr($objacceso_session->sess_tabla,strval("rx".$table));
  if ($permisotabla)
  {
    $table='';	
  }
  $objformulario->geamv =@$geamv;
  
  if (!($objformulario->geamv))
  {
    
	 $sessid=$objencripta->encrypt(trim($sessid));
	 
	 include_once($objtemplate->path_template."index.php"); 
	 
  }	 
  else
  {
     $sessid=$objencripta->encrypt(trim($sessid));
	 $objtemplate->path_template="pantalla_maestra/base/";
	 
     include_once($objtemplate->path_template."index.php"); 
  }
}
else
{
//------------------------------------------------
if (@$ocacceso==1)
{

   $objacceso_system->acept_session($sisusu,$pwdusu,$DB_gogess); 
   $sessid=$objacceso_session->create_session($objacceso_system->user,$objacceso_system->pass,$objacceso_system->name,$objacceso_system->perid,$DB_gogess);
   
   if ($objacceso_system->user)
   {
      $_SESSION['novpichincha1777_ususer']=$objacceso_system->user;
	  $_SESSION['novpichincha1777_pwd']=$objacceso_system->pass;
	  $_SESSION['novpichincha1777_name']=$objacceso_system->name;	  
	  $_SESSION['oficinausu1777']=$objacceso_system->oficina;	
	  $_SESSION['iduser1777']=$objacceso_system->iduser;	
	  $_SESSION['sessidadm1777_pichincha']=$sessid;
	  
	  $sessid=$objencripta->encrypt(trim($sessid));
	  include_once("acces.php");
	 
   }
   else
   {
     $mensajeacc="Acceso negado...";
      include_once("modules/login/acceso.php");   
   }   
}
else
{
    include_once("modules/login/acceso.php");
}
//-----------------------------------------------
}
?>
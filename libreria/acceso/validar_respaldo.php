<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
echo "prueba";
if(@$_POST["usuario_valor"])
{
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//Conexion a la base de datos

$hoyfecha=date("Y-m-d H:i:s");

$hoyfechac=date("Y-m-d");


$obj_session_apl= new session_apl();
$obj_session_apl->seleccion_acc_apl($_POST["accesousuario"],$DB_gogess);

// echo $_POST["ruc_valor"]."<br>";
//echo $_POST["usuario_valor"]."<br>";
//echo $_POST["clave_valor"]."<br>"; 

$buscausuario="select * from ".$obj_session_apl->ntabla_usuario." where ".$obj_session_apl->campo_usuario."=? and ".$obj_session_apl->campo_clave."=? and usua_estado=1";
//echo $buscausuario;
$rs_busuario = $DB_gogess->executec($buscausuario,array(@$_POST["usuario_valor"],md5(@$_POST["clave_valor"])));

	 if($rs_busuario)

	 {

	  while (!$rs_busuario->EOF) {

	  

	  $idenlace=$rs_busuario->fields[$obj_session_apl->campo_campoenlace];	

	  //$nombreusuario=$rs_busuario->fields["usua_usuario"];
      $nombrecompleto=$rs_busuario->fields["usua_nombre"];
	  $nombreusuario=$nombrecompleto;

	 $cedulausuario=$rs_busuario->fields["usua_ciruc"];
     $emp_id=$rs_busuario->fields["emp_id"];

     $jobt_id=$rs_busuario->fields["jobt_id"];



	  $rs_busuario->MoveNext();

	  }

	}  

	

	 if(@$idenlace)
	 {

	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold" >Acceso permitido...</div>';


	 //Selecciona Periodo

	   $_SESSION['ces1313777_sessid_inicio']=$idenlace;
       $_SESSION['ces1313777_sessid_tabla']=$obj_session_apl->tabla_usuario;
       $_SESSION['ces1313777_sessid_nombreusuario']=$nombreusuario;
       $_SESSION['ces1313777_sessid_nombrecompleto']=$nombrecompleto;
	   $_SESSION['ces1313777_sessid_cedula']=$cedulausuario;
       $_SESSION['ces1313777_sessid_emp_id']=$emp_id;
	   
	   $_SESSION['ces1313777_jobt_id']=$jobt_id;


      // $busca_empresa="select * from app_empresa where emp_id=?";
	  // $rs_busempresa = $DB_gogess->executec($busca_empresa,array($emp_id));


	   $_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");
       $_SESSION['ces1313777_tipodespl']=0;
	   
	  // $_SESSION['ces1313777_temp_id']=$rs_busempresa->fields["temp_id"];
	   //$_SESSION['tipo_ing']=$_POST["tipo_ing"];
	   


   
      $fechahoy=date("Y-m-d H:i:s");
      $horahoy=date("H:i:s");

//ultimo acceso
	  $actualiza="update ".$obj_session_apl->ntabla_usuario." set usua_fecha_uingreso=?,usua_hora_uingreso=? where usua_id=?";

	  $rs_ok = $DB_gogess->executec($actualiza,array($fechahoy,$horahoy,$_SESSION['ces1313777_sessid_inicio']));   
//ultimo acceso
	     
// Guarda ingreso al sistema
	$insertahistorial="insert into app_historicoing (hiing_fecha,hiing_cedula,hiing_ip) values ('".$fechahoy."','".$_SESSION['ces1313777_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";
    $ac_oking = $DB_gogess->executec($insertahistorial,array());
// Guarda ingreso al sistema   

	   

	   

	   echo '<script type="text/javascript">

		   <!--
		   
		   
		   $("#acceso_usuario1").html("<div style=color:#000000; >Acceso permitido...</div>");
		   
			location.reload(); 
			//window.open("index.php","_blank");
			

		   //  End -->

       </script>

	   ';

	   

	 }

	 else

	 {


	   
	     echo '<script type="text/javascript">

		   <!--

			$("#acceso_usuario1").html("<div style=color:#FF0000; >Acceso negado...Usuario o clave incorrecta...</div>");
			

		   //  End -->

       </script>

	   ';

	 

	 }

	 



	} 

?>
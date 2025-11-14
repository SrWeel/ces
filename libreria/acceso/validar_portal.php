<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

session_start();

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

 

 $buscausuario="select * from ".$obj_session_apl->ntabla_usuario." where ".$obj_session_apl->campo_usuario."='?' and ".$obj_session_apl->campo_clave."=? and ".$obj_session_apl->campo_extra1."='?'";

  

//echo $buscausuario;





	$rs_busuario = $DB_gogess->executec($buscausuario,array($_POST["usuario_valor"],md5($_POST["clave_valor"]),$_POST["ruc_valor"]));

	 if($rs_busuario)

	 {

	  while (!$rs_busuario->EOF) {

	  

	  $idenlace=$rs_busuario->fields[$obj_session_apl->campo_campoenlace];	

	

	  $nombreusuario=$rs_busuario->fields["usua_usuario"];

	  

	  $nombrecompleto=$rs_busuario->fields["usua_nombre"];

	  $cedulausuario=$rs_busuario->fields["usua_ciruc"];

	  

	  $emp_id=$rs_busuario->fields["emp_id"];

	  

	 

	  

	  

	  $rs_busuario->MoveNext();

	  }

	}  

	

	 if(@$idenlace)

	 {

	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold" >Acceso permitido...</div>';

	 //echo $idenlace;

	   $_SESSION['ces1313777_sessid_inicio']=$idenlace;

	   $_SESSION['ces1313777_sessid_tabla']=$obj_session_apl->tabla_usuario;

	   $_SESSION['ces1313777_sessid_nombreusuario']=$nombreusuario;

	   $_SESSION['ces1313777_sessid_nombrecompleto']=$nombrecompleto;

	   $_SESSION['ces1313777_sessid_cedula']=$cedulausuario;

	   $_SESSION['ces1313777_sessid_emp_id']=$emp_id;

	   

	   

	   

	 

	   $_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");

	 

	   $_SESSION['ces1313777_tipodespl']=0;

	 

	   

	   

	   

	  $fechahoy=date("Y-m-d");

		  $horahoy=date("H:i:s");

	   //ultimo acceso

	   

	   //ultimo acceso

	   

	   

	   

	  $actualiza="update ".$obj_session_apl->ntabla_usuario." set usua_fecha_uingreso=?,usua_hora_uingreso=? where usua_id=?";

	  $rs_ok = $DB_gogess->executec($actualiza,array($fechahoy,$horahoy,$_SESSION['ces1313777_sessid_inicio']));   

	   

		  

	  // $insertahistorial="insert into factura_historicoing (hiing_fecha,hiing_hora,hiing_cedula,hiing_ip) values ('".$fechahoy."','".$horahoy."','".$_SESSION['ces1313777_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";

	  // $ac_oking = $DB_gogess->Execute($insertahistorial);

	   

	   

	   

	   echo '<script type="text/javascript">

		   <!--

			// location.reload(); 
			//  jQuery("#acceso_usuario").attr("href", "../gogess_php/index.php");
			  window.location.href = "../gogess_php/index.php";
			//window.open("index.php","_blank");
			

		   //  End -->

       </script>

	   ';

	   

	 }

	 else

	 {

	   echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FF0000" >Acceso negado...Usuario o clave incorrecta...</div>';

	 

	 }

	 



	 

?>
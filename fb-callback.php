<?php
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$cuadro_valor=array();
$director='';
include("cfg/clases.php");
include("cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

require_once 'autoload.php';
use Facebook\FacebookRequest;

$fb = new Facebook\Facebook([
  'app_id' => '175428196259619', // Replace {app-id} with your app id
  'app_secret' => '8f3fc09d6c9506d307682bf147fc58eb',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);


if($tokenMetadata)
{
  $fb->setDefaultAccessToken($accessToken);
  
  try 
          {
            $response = $fb->get('/me?fields=name,email,id');
            $userNode = $response->getGraphUser();
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
		  
		    $email  = $userNode->getProperty('email');
            $nombre = $userNode->getName();
		    $id = $userNode->getId();
		 
		 $busca_u="select * from app_usuario where usua_email='".$email."'";
		 $rs_buscau = $DB_gogess->executec($busca_u,array());
		 
		 if($rs_buscau->fields["usua_id"])
		 {
		 
		 if(!($rs_buscau->fields["usua_idfacebook"]))
		 {
		   $actualiza_fb="update app_usuario set usua_idfacebook='".$id."',usua_tiporeg='FACEBOOK' where usua_id=".$rs_buscau->fields["usua_id"];
		   $rs_fbk = $DB_gogess->executec($actualiza_fb,array());
		  }
		 

		$idenlace=$rs_buscau->fields["usua_id"];	
        $nombreusuario=$rs_buscau->fields["usua_usuario"];
        $nombrecompleto=$rs_buscau->fields["usua_nombre"];
	    $cedulausuario=$rs_buscau->fields["usua_ciruc"];
        $emp_id=$rs_buscau->fields["emp_id"];
		
		//genera sesion
		
	$_SESSION['ces1313777_sessid_inicio']=$idenlace;
       $_SESSION['ces1313777_sessid_tabla']=$obj_session_apl->tabla_usuario;
       $_SESSION['ces1313777_sessid_nombreusuario']=$nombreusuario;
       $_SESSION['ces1313777_sessid_nombrecompleto']=$nombrecompleto;
	   $_SESSION['ces1313777_sessid_cedula']=$cedulausuario;
       $_SESSION['ces1313777_sessid_emp_id']=$emp_id;
       $busca_empresa="select * from app_empresa where emp_id=?";
	   $rs_busempresa = $DB_gogess->executec($busca_empresa,array($emp_id));
$_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");
       $_SESSION['ces1313777_tipodespl']=0;
	   
	   $_SESSION['ces1313777_temp_id']=$rs_busempresa->fields["temp_id"];
	   $_SESSION['tipo_ing']=$_POST["tipo_ing"];
	   $_SESSION['idfb']=$id;
	  $fechahoy=date("Y-m-d H:i:s");
      $horahoy=date("H:i:s");

		//ultimo acceso
	  $actualizaz="update app_usuario set usua_fecha_uingreso=?,usua_hora_uingreso=? where usua_id=?";
      $rs_okz = $DB_gogess->executec($actualizaz,array($fechahoy,$horahoy,$_SESSION['ces1313777_sessid_inicio']));   
      //ultimo acceso
	  
	 // Guarda ingreso al sistema
	$insertahistorialt="insert into app_historicoing (hiing_fecha,hiing_cedula,hiing_ip) values ('".$fechahoy."','".$_SESSION['ces1313777_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";
    $ac_okingt = $DB_gogess->executec($insertahistorialt,array());
    // Guarda ingreso al sistema   
		//genera sesion
		
		  echo '<script type="text/javascript">

		   <!--

			//location.reload(); 
			window.open("index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==995","_top");
			

		   //  End -->

       </script>

	   ';
		
		   
		   
		 }
		 else
		 {
		 
		  $inserta_usuario="INSERT INTO `app_usuario` ( `emp_id`, `usua_esusuario`,   `usua_nombre`,   `usua_periodo`, `usua_usuario`, `usua_clave`, `usua_email`, `usua_code`, `usua_apruebapolitica`,`usua_tiporeg`, `usua_idfacebook`,`usua_estado`) VALUES
( 1, 1,   '".$nombre."',  2016, '".$email."', '".md5($id)."', '".$email."',   '".$id."', 1,  'FACEBOOK', '".$id."',1)";
$rs_INSERTA = $DB_gogess->executec($inserta_usuario,array());
if($rs_INSERTA)
{
  
//-----------------------------------------------------

 $busca_u="select * from app_usuario where usua_email='".$email."'";
		 $rs_buscau = $DB_gogess->executec($busca_u,array());
		 
		 if($rs_buscau->fields["usua_id"])
		 {
		 
		 if(!($rs_buscau->fields["usua_idfacebook"]))
		 {
		   $actualiza_fb="update app_usuario set usua_idfacebook='".$id."',usua_tiporeg='FACEBOOK' where usua_id=".$rs_buscau->fields["usua_id"];
		   $rs_fbk = $DB_gogess->executec($actualiza_fb,array());
		  }
		 

		$idenlace=$rs_buscau->fields["usua_id"];	
        $nombreusuario=$rs_buscau->fields["usua_usuario"];
        $nombrecompleto=$rs_buscau->fields["usua_nombre"];
	    $cedulausuario=$rs_buscau->fields["usua_ciruc"];
        $emp_id=$rs_buscau->fields["emp_id"];
		
		//genera sesion
		
	$_SESSION['ces1313777_sessid_inicio']=$idenlace;
       $_SESSION['ces1313777_sessid_tabla']=$obj_session_apl->tabla_usuario;
       $_SESSION['ces1313777_sessid_nombreusuario']=$nombreusuario;
       $_SESSION['ces1313777_sessid_nombrecompleto']=$nombrecompleto;
	   $_SESSION['ces1313777_sessid_cedula']=$cedulausuario;
       $_SESSION['ces1313777_sessid_emp_id']=$emp_id;
       $busca_empresa="select * from app_empresa where emp_id=?";
	   $rs_busempresa = $DB_gogess->executec($busca_empresa,array($emp_id));
$_SESSION['fecha_uingreso']=date("Y-m-d H:i:s");
       $_SESSION['ces1313777_tipodespl']=0;
	   
	   $_SESSION['ces1313777_temp_id']=$rs_busempresa->fields["temp_id"];
	   $_SESSION['tipo_ing']=$_POST["tipo_ing"];
	  $fechahoy=date("Y-m-d H:i:s");
      $horahoy=date("H:i:s");
     $_SESSION['idfb']=$id;
		//ultimo acceso
	  $actualizaz="update app_usuario set usua_fecha_uingreso=?,usua_hora_uingreso=? where usua_id=?";
      $rs_okz = $DB_gogess->executec($actualizaz,array($fechahoy,$horahoy,$_SESSION['ces1313777_sessid_inicio']));   
      //ultimo acceso
	  
	 // Guarda ingreso al sistema
	$insertahistorialt="insert into app_historicoing (hiing_fecha,hiing_cedula,hiing_ip) values ('".$fechahoy."','".$_SESSION['ces1313777_sessid_cedula']."','".$_SERVER['REMOTE_ADDR']."')";
    $ac_okingt = $DB_gogess->executec($insertahistorialt,array());
    // Guarda ingreso al sistema   
		//genera sesion

  echo '<script type="text/javascript">

		   <!--

			//location.reload(); 
			window.open("index.php?snp=WVhCc1BURTNKbk5sWTJNOU55WjBhWEJ2UFRFPQ==995","_top");
			

		   //  End -->

       </script>

	   ';



}
//-----------------------------------------------------		  
		}
		
		
		  
		 }
		// print_r($userNode);
			//echo   $nombre = $userNode->getPassword();
 
 
}

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('175428196259619'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

 // echo '<h3>Long-lived</h3>';
  //var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');

?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_periodoactual'])
{
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
$objperfil=new objetosistema_perfil();
?>
<!doctype html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
<!--
.Estilo1 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #FF0000;
}
.Estilo2 {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	color: #006600;
}
-->
</style>
</head>
<body>
	<?php
	$upload_dir = "uploads";
	$result["status"] = "200";
	$result["message"]= "Error!";
	
	@$extencion=explode(".",$_FILES['file']['name']);
	$num_cant=count($extencion);
	@$narchivo=date("YmdHis")."-".$_POST["form_id"]."-".$_POST["pregf_id"].".".$extencion[$num_cant-1];
	
	if($extencion[$num_cant-1]!='php' and $extencion[$num_cant-1]!='html' and $extencion[$num_cant-1]!='js' and $extencion[$num_cant-1]!='java')
	{

	if(isset($_FILES['file'])){

		echo "<div class='Estilo2'>Cargando Archivo...</div> <br />";
	  
		if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
			  $filename = $_FILES['file']['name'];
			  move_uploaded_file($_FILES['file']['tmp_name'],
			  $upload_dir.'/'.$narchivo);
			  $result["status"] = "100";
			  $result["message"]="Archivo fue cargado exitosamente!";
			  $css_valor='Estilo2';
			  
			  $guardar_path="update media_resultados set result_archivo='".$narchivo."' where usua_id=? and form_id=? and pregf_id=? and result_periodo='".$_SESSION['ces1313777_sessid_periodoactual']."'";
              $rs_ok=$DB_gogess->executec($guardar_path,array($_SESSION['ces1313777_sessid_inicio'],$_POST["form_id"],$_POST["pregf_id"]));
			  
			  
		} elseif ($_FILES['file']['error'] == UPLOAD_ERR_INI_SIZE) {
			  $result["status"] = "200";
			  $result["message"]= "Archivo supera el tama&ntilde;o permitido!";
			  $css_valor='Estilo1';
		} else {
			  $result["status"] = "500";
			  $result["message"]= "Error al subir el archivo!";
			  $css_valor='Estilo1';
		}
	}
	
	}
	else
	{
	  $result["message"]="Archivo no permitido";
	  $css_valor='Estilo1';
	}
	?>
	<div class='<?php echo @$css_valor ?>' > <?php echo htmlspecialchars($result["message"]); ?></div>
	
</body>
</html>
<?php
}
else
{
 echo '<div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi�n a caducado presione F5 para continuar...</div>';

}
?>
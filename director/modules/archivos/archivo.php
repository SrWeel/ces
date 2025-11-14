<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
$director="../../";
include("../../cfgclases/clases.php");

/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombre_camp='';
for($i=0;$i<$numero;$i++){
$nombre_camp=$tags[$i];
$$nombre_camp=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombre_c2='';
for($i=0;$i<$numero2;$i++){ 
$nombre_c2=$tags2[$i];
$$nombre_c2=$valores2[$i]; 
}
//echo $kam_id;
$tabla=trim($objformulario->replace_cmb("gogess_sisfield","fie_name,tab_name","where fie_name like",$campogeneral,$DB_gogess));

$despl_gr=trim($objformulario->replace_cmb("gogess_sisfield","fie_name,fie_desplegarimagencrg","where fie_name like",$campogeneral,$DB_gogess));
$activa_funcion='';
if($despl_gr==1)
{
$activa_funcion="window.opener.funcion_ver_img();";	
}


$campogeneral
?>

<style type="text/css">
<!--
.Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.Estilo4 {font-size: 11px}
.Estilo5 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; }
.Estilo8 {font-size: 11px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }

 #f1_upload_process{  
 z-index:100;  
 position:absolute;  
 visibility:hidden;  
 text-align:center;  
 width:408px;  
 margin:0px;  
 padding:0px;  
 background-color:#fff;  
 border:1px solid #ccc;  
 }  
   
 form{  
 text-align:center;  
 width:390px;  
 margin:0px;  
 padding:5px;  
 background-color:#fff;  
 border:1px solid #ccc;  
} 
.msg {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #003366;
}


.emsg {
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #990000;
}
-->
</style>
<script language="javascript">

 function startUpload(){  
   document.getElementById('f1_upload_process').style.visibility = 'visible';  
   return true;  
 }  
 
  function stopUpload(success,narchivo,fechains){  
    var result = '';  
   if (success == 1){  
    document.getElementById('result').innerHTML = '<span class="msg">El archivo se cargo con exito!<\/span><br/><br/>';  
	window.opener.document.form_<?php echo $tabla ?>.<?php echo $campogeneral ?>.value=narchivo;
	<?php echo $activa_funcion ?>
    }  
    else {  
    document.getElementById('result').innerHTML ='<span class="emsg">Error al subir los archivos!<\/span><br/><br/>';  
   }  
  document.getElementById('f1_upload_process').style.visibility = 'hidden';  
  return true;  
 }  
 
</script>

<center>
				  <table width="408"  border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><p id="f1_upload_process" align="center">Loading...<br/><img src="<?php echo @$ap_path ?>progreso.gif" /></p> <p id="result"></p> </td>
                    </tr>
                  </table>				  
				  
				<form action="<?php echo $ap_path ?>upload.php" method="post" enctype="multipart/form-data" target="upload_target"  onsubmit="startUpload();">
				  
<input name="myfile" type="file" class="Estilo3" />  
<input name="kam_id" type="hidden" id="kam_id" value="<?php echo $kam_id ?>">
<input name="opcp" type="hidden" id="opcp" value="7">
                <input name="apl" type="hidden" id="apl" value="13">
                <input name="subopcp" type="hidden" id="subopcp" value="1">
				<input name="sessid" type="hidden" id="sessid" value="<?php echo $sessid; ?>">	
				<input name="envi" type="hidden" id="envi" value="1">
				<input name="campogeneral" type="hidden" id="campogeneral" value="<?php echo $campogeneral; ?>">
<input name="submitBtn" type="submit" class="Estilo3" value="Upload" />  

</form>   
<br><table width="408"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="462"><iframe id="upload_target" name="upload_target" src="" style="width:408;height:50;border:1px solid #000;" width="408"></iframe></td>
  </tr>
</table>

				 
			</center>
<!doctype html>
<html lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<?php

//$us_id=$_POST["pVar1"];
//$form_id=$_POST["pVar2"];
//$pregf_id=$_POST["pVar3"];

//echo $us_id."--".$form_id." -- ".$pregf_id;

?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #003366;
	font-size: 11px;
}
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<script>
 function submitForm(upload_input_field){
	upload_input_field.form.submit();
	upload_input_field.disabled = true;
	return true;
}
	

</script>
</head>
<body>
  
  <div align="center"><span class="Estilo1">SELECCIONE EL ARCHIVO </span></div><br><br>
  
  <form action="gr/uploadFile.php" target="uploadIframe" method="post" enctype="multipart/form-data" class="Estilo4" >
	<div class="fieldRow">
		<label><span class="Estilo3">Seleccione el archivo: </span></label>
			<input name="file" type="file" class="Estilo4" id="file" onChange="submitForm(this)" />
			<input name="form_id" type="hidden" id="form_id" value="<?php echo $_POST["pVar2"] ?>">
            <input name="pregf_id" type="hidden" id="pregf_id" value="<?php echo $_POST["pVar3"] ?>">
</div>
  </form>
	<iframe style="border:0;" id="uploadIframe" name="uploadIframe"></iframe>
	<div class="Estilo4" id="successMessage"></div>
	
</body>
</html>	
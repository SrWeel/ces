<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Acceso Permitido</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

 <link href="css_gogess/css/general.css" rel="stylesheet">
</head>

<body>
<p>&nbsp;</p>
<br><br>
<div align="center"><label class="formButton">Acceso permitido...</label></div>
<form action="" method="post" name="ingreso" id="ingreso">
  <input name="sessid" type="hidden" id="sessid" value="<?php echo $sessid ?>">
</form>

<script type="text/javascript">
function submitform()
{
    window.document.ingreso.submit();
}
submitform();
</script>

</body>
</html>

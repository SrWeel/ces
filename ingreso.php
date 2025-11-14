<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<body>

<p>Iniciar sesi&oacute;n con Facebook:</p>
<fb:login-button perms="email,user_birthday"></fb:login-button>
<script type="text/javascript" src="templates/page/js/jquery-1.10.2.js"></script>
<script>
$.ajax({
  url: '//connect.facebook.net/es_ES/sdk.js',
  dataType: 'script',
  cache: true,
  success: function() {
    alert('Facebook listo');
  }
});

FB.init({
  appId: '175428196259619',
  xfbml: true
});
</script>
</body>
</html>

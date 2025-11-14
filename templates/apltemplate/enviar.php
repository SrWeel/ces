<?php
include ("../../aqualisv3/cfgclases/config.php");
include ("../../aqualisv3/libreria/dbcc.php");
include ("../../libreria/contenido.php");
//Conexion a la base de datos
  $objBd = new  conecc(); 
//Objeto contenido
  $objcontenido = new  contenidop();  
//Conexion ejecutada 
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objcontenido->select_articulo($ar);
?>
<html>
<head>
<title>Email</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT language=JavaScript>
<!--
function imprimir() {
  if (window.print)
    window.print()
  else
    alert("Disculpe, su navegador no soporta esta opción, seleccione en el menu de su navegador la opción para imprimir...");
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</SCRIPT>
<meta name="keywords" content="imprimir, contenido, biblia, Jesus, Vida, Dios"><meta name="description" content="Reflexiones para el Alma un portal de Vida...">
<link rel="stylesheet" href="formato.css" type="text/css">
<link href="styles/formato.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
  <tr> 
    <td bgcolor="#A4BDD2" class="titulohome">www.conservatorionacional.com.ec</td>
  </tr>
  <tr> 
    <td class="titulohome"> <form name="form1" method="post" action="gracias.php" onSubmit="MM_validateForm('tunombre','','R','tuemail','','RisEmail','amigo','','R','amigomail','','RisEmail');return document.MM_returnValue">
        <p class="txthisto">Si usted desea enviar a mas de un amigo, debe digitar 
          las direcciones separadas de una (coma) <br>
          ej. tuamigo@labibliadice.org,tuamigo2@labibliadice.org</p>
        <table width="30" border="0" cellspacing="1" cellpadding="1" align="center" bgcolor="#495567">
          <tr> 
            <td> <table width="335" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF">
                <tr> 
                  <td width="172" class="cmbing">Tu nombre:</td>
                  <td width="143"> <input type="text" name="tunombre" class="texto"> 
                  </td>
                </tr>
                <tr> 
                  <td width="172" class="cmbing">Tu e-mail:</td>
                  <td width="143"> <input type="text" name="tuemail" class="texto"> 
                  </td>
                </tr>
                <tr> 
                  <td width="172" class="cmbing">El nombre de tu amigo:</td>
                  <td width="143"> <input type="text" name="amigo" class="texto"> 
                  </td>
                </tr>
                <tr> 
                  <td width="172" class="cmbing">El e-mail de tu o tus amigos 
                    :</td>
                  <td width="143"> <input type="text" name="amigomail" class="texto"> 
                  </td>
                </tr>
              </table></td>
          </tr>
        </table>
        <?php
	    printf ("<input type='hidden' name='ar' value='%s'>",$ar);
	  ?>
        <p align="center"> 
          <input type="image" border="0" name="imageField3" src="images/aceptar.gif" width="91" height="18">
        </p>
    </form></td>
  </tr>
  <tr> 
    <td bgcolor="#A4BDD2" class="titulohome"><span class="linkart"><a href="http://www.conservatorionacional.com.ec" class="tituloimp">Copiar      &copy; www.conservatorionacional.com.ec</a></span><a href="http://www.labibliadice.org" class="tituloimp"><br>
    </a></td>
  </tr>
</table>
</body>
</html>

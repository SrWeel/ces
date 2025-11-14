<?php
include ("../../aqualis/cfgclases/config.php");
include ("../../aqualis/libreria/dbcc.php");
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
<!--

function imprimir() {
  if (window.print)
    window.print()
  else
    alert("Disculpe, su navegador no soporta esta opción, seleccione en el menu de su navegador la opción para imprimir...");
}

// -->

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
<link rel="stylesheet" href="formato.css" type="text/css">

<table border="0" cellspacing="0" cellpadding="5" width="100%" align="center">
  <tr> 
    <td class="txthisto"> <p class="titarti"><span class="titulohome">Su e-mail a sido enviado a: 
        </span>
      <?php	 
	  			printf("%s",$amigomail);	   
				?>
      </p>
      <?php
		   $detalle = "****************************************************\n";		  
		   $detalle = "$detalle REFLEXIONES PARA EL ALMA\n";
  		   $detalle = "$detalle****************************************************\n";		  
		   $detalle ="$detalle \nHola\n";
		   $detalle ="$detalle$tunombre te ha enviado un articulo para que lo leas y compartas, esta muy interesante.\n";
		   $detalle = "$detalle****************************************************\n";		  		  
           $detalle = "$detalle\nEsperamos que te guste.\nDa un clik aqui para ver el articulo : ";			
		   $detalle = "$detalle http://labibliadice.gospelcom.net/labibliadice/aqualisplus/templates/lbdv2/imp.php?ar=$ar\n";		 
		   $detalle = "$detalle\nSi deseas mas información visita nuestra pagina web en http://www.reflexionesparaelalma.org\n\n"; 		  
		   $detalle = "$detalle Quito - ECUADOR.\nlabiblia@uio.telconet.net\n";		 		     
   //Enviando e-amil
    mail("$amigomail", "$tunombre te envia este Articulo", $detalle, "From: $tuemail\nReply-To: $tuemail\nX-Mailer: PHP");	  
?>
      <table border="0" cellspacing="0" cellpadding="1" bgcolor="#000000" align="center" width="100%">
        <tr> 
          <td> <table border="0" cellspacing="0" cellpadding="5">
              <tr> 
                <td bgcolor="#B5DAE6"> <div align="center"></div></td>
              </tr>
              <tr> 
                <td bgcolor="#FFFFFF" class="txthisto"><span class="textohome">NADIE...                  </span>                  <p class="textohome"> Nadie alcanza la meta con un solo intento, ni perfecciona 
                    la vida con una sola rectificaci&oacute;n, ni alcanza altura 
                    con un solo vuelo. Nadie camina la vida sin haber pisado en 
                    falso muchas veces. Nadie recoge cosecha sin probar muchos 
                    sabores, enterrar muchas semillas y abonar mucha tierra.<br>
                    <br>
                    Nadie mira la vida sin acobardarse en muchas ocasiones, ni 
                    se mete en el barco sin temerle a la tempestad, ni llega a 
                    puerto sin remar muchas veces.</p>
                  <p class="textohome"> Nadie siente el amor sin probar sus l&aacute;grimas, ni 
                    recoge rosas sin sentir sus espinas.</p>
                  <p class="textohome">Nadie hace obras sin martillar sobre su edificio, ni cultiva 
                    amistad sin renunciar a s&iacute; mismo.</p>
                  <p class="textohome"> Nadie llega a la otra orilla sin haber ido haciendo puentes 
                    para pasar. Nadie deja el alma lustrosa sin el pulimento diario 
                    de la vida.Nadie puede juzgar sin conocer primero su propia 
                    debilidad. Nadie consigue su ideal sin haber pensado muchas 
                    veces que persegu&iacute;a un imposible.</p>
                  <p class="textohome"> Si sacas todo lo que tienes y conf&iacute;as en DIOS, &iexcl;esfu&eacute;rzate! 
                    porque... &iexcl;&iexcl;&iexcl; Vas a llegar !!!.</p>
                  <p></p>
                <p class="textohome">An&oacute;nimo</p></td>
              </tr>
            </table></td>
        </tr>
      </table>
      <p class='titulo' align="center"><span class="titarti">...Id por todo el 
        mundo y predicad el evangelio a toda criatura...</span></p>
      <p class='titulo' align="center"><span class="titarti">San Marcos 16: 15</span></p></td>
  </tr>
  <tr> 
    <td bgcolor="#B5DAE6"><a href="http://www.conservatorionacional.com.ec" class="linkpregunta">Copia &copy; www.conservatorionacional.com.ec<br>
www.conservatorionacional.com.ec</a><a href="http://www.labibliadice.org" class="titulohisto"><br>
    </a></td>
  </tr>
</table>
</body>
</html>

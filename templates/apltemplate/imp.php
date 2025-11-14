<?php
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$$tags2[$i]=$valores2[$i]; 
}

?>
<?php
include ("../../aqualisv3/cfgclases/config.php");
include ("../../aqualisv3/libreria/dbcc.php");
include ("../../libreria/contenido.php");
include ("../../libreria/datosportal.php");
//Conexion a la base de datos
  $objBd = new  conecc(); 
//Objeto contenido
  $objcontenido = new  contenidop();  
//Conexion ejecutada 
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objcontenido->select_articulo($ar);
  $objportal= new portal();  
  
   $objportal->datos_portal($system);
?>
<html>
<head>
<title>Formato de Impresi&oacute;n</title>
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
//-->
</SCRIPT><meta name="keywords" content="imprimir, contenido, biblia, Jesus, Vida, Dios"><meta name="description" content="Reflexiones para el Alma un portal de Vida...">
<link href="styles/formato.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr> 
    <td class="titulohome"><?php  echo $objportal->sys_titulo ?></td>
  </tr>
  <tr> 
    <td class="txthisto"> <a href="javascript:imprimir()"><img src="images/printer_o.gif" alt="Imprimir Documento" border="0"></a> 
      <hr size="1" noshade>
      <table border="0" cellpadding="0" cellspacing="0" width="450">
        <!-- fwtable fwsrc="titulosimp.png" fwbase="titulosimp.jpg" fwstyle="Dreamweaver" fwdocid = "429772338" fwnested="0" -->
        <tr>
          <td><img src="images/spacer.gif" width="26" height="1" border="0" alt=""></td>
          <td><img src="images/spacer.gif" width="418" height="1" border="0" alt=""></td>
          <td><img src="images/spacer.gif" width="6" height="1" border="0" alt=""></td>
          <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
        </tr>
        <tr>
          <td rowspan="2"><img name="titulosimp_r1_c1" src="images/titulosimp_r1_c1.jpg" width="26" height="25" border="0" alt=""></td>
          <td background="images/titulosimp_r1_c2.jpg"><span class=tituloar><?php echo $objcontenido->titulo ?></span></td>
          <td rowspan="2"><img name="titulosimp_r1_c3" src="images/titulosimp_r1_c3.jpg" width="6" height="25" border="0" alt=""></td>
          <td><img src="images/spacer.gif" width="1" height="21" border="0" alt=""></td>
        </tr>
        <tr>
          <td><img name="titulosimp_r2_c2" src="images/titulosimp_r2_c2.jpg" width="418" height="4" border="0" alt=""></td>
          <td><img src="images/spacer.gif" width="1" height="4" border="0" alt=""></td>
        </tr>
      </table>
      <table border="0" cellpadding="5" cellspacing="0">
        <tr>
          <td><span class="textohome">
            <?php
     if ($objcontenido->con_contenido)
                        {
                             echo $objcontenido->con_contenido;
							
                         }
                       else     
{
       if (!($ar))
              {
                 $ar=1;
              }
	   if ($pagina > 1 )
			 {
			    $articulo = "../../reflexiones/articulos/pag$ar-$pagina.htm";
			    include ("$articulo");
			 }
			 else
			 {
			    $articulo = "../../reflexiones/articulos/pag$ar.htm";
			    include ("$articulo");
			 }
}
		?>
          </span></td>
        </tr>
      </table>
	  <hr size="1" noshade>    </td>
  </tr>
  <tr> 
    <td bgcolor="#B4DADE"><a href="http://www.asiconstruimos.com" class="linkpregunta"><?php  echo $objportal->sys_titulo ?></a></td>
  </tr>
</table>
</body>
</html>

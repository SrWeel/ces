d">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
if ($table)
{
 include("script/edicion.sc");
}
?>
<SCRIPT LANGUAGE=javascript>
<!--
function cargarcombo(combo,dato){
	var mycombo =eval(combo)
	var i
	for(i=0;i<mycombo.length;i++){
		if(mycombo.options[i].value==dato){
			mycombo.selectedIndex=i;
		}
	}
}
//-->
</SCRIPT>
<?php
//Funciones de guardado  
include("libreria/func_g.php");
//Platillas
printf("<link href='%sstyles/formato.css' rel='stylesheet' type='text/css'>",$objtemplate->path_template);
?>

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="19%"><?php include($objtemplate->path_template."panels.php"); ?></td>
    <td width="81%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		<?php
$ancho="80%";
include($objtemplate->path_template."admcab1.htm");
?>
		</td>
      </tr>
      <tr>
        <td>
		<div class=cuadro align="center">
<?php
 //Llamar clase formulario  
 if ($table)
 {
    //$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid);
    $objtableform->select_templateform($table);
    include ($objtableform->path_templateform."formulario.php");    
 }
else
 {
   printf("<div align='center'><br><table border=0><tr><td><img src='logotipo/logoadm.png'></td><td></td></table><br><br><br></div>");
 }
?>
<?php
   if ($opcion=="buscar")
   { 
     printf("\n<SCRIPT LANGUAGE=javascript>\n");
     printf("<!--\n despl();\n//-->\n</SCRIPT>\n");
   }	
?>
<?php
if ($table)
{
echo "</form>";
}
?>
<?php
if ($table=='solicitud')
{
include("modules/ver_datos.php");
}
?>
<?php
if ($table)
{
include("modules/list.php");
}
?>
</div>
		
		</td>
      </tr>
    </table></td>
  </tr>
</table>
<?php
include($objtemplate->path_template."pie.htm");
?>
</body>
</html>
le></td>
  </tr>
</table>
<?php
include($objtemplate->path_template."pie.htm");
?>
</body>
</html>

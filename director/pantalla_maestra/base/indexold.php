<html>
<head>
<title>Aqualis V 1.0</title>
<meta http-equiv="Content-Type" content="text/html;">
<?php
$ancho="80%";
include($objtemplate->path_template."admcab1.htm");
?>
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
<?php
include($objtemplate->path_template."pie.htm");
?>

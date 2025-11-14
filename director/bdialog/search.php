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
//Llamando objetos
 include("../libreria/dbcc.php");
 include("../libreria/formulario.php");
 include("../cfgclases/config.php");
//Conexion a la base de datos
  $objBd = new  conecc();
  $objformulario = new  formulario();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $link = $objBd->enlace;  
?>
<html>
<head>
<META name=VI60_defaultClientScript content=VBScript>
<title>Search...</title>

			<?php
  $selecTabla="select * from `".$table."`";
  $resultado = mysql_query($selecTabla);
  $ncampos = mysql_num_fields($resultado);
  $n_registros  = mysql_num_rows($resultado);  
   $i=0;
  		   while ($i < $ncampos) 
     	   {	
		     $nombre_campo  = mysql_field_name($resultado, $i); 
			 $objformulario->form_format_field($table,$nombre_campo);			 
			 
			 if ($objformulario->fie_activesearch==1)
		     { 
             	if ($objformulario->fie_value=="replace")   
				{			   							   
						$tok=strtok($objformulario->fie_datadb,",");
					    $tok1 = strtok (",");
						$aprcom='+"$$"+';
						$envioc=$envioc.$aprcom.$tok1.".checked".$aprcom.$tok1."val.value";
			    }
				else
				{
				        $aprcom='+"$$"+';
						$envioc=$envioc.$aprcom.$nombre_campo.".checked".$aprcom.$nombre_campo."val.value";
				}
				
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
		   
		 // echo $envioc;
  ?>	



<script language=javascript>
	window.returnValue="";
	function cmdAceptar(){	   
		
			window.returnValue="$$" + <?php echo $envioc?>;			
			window.close();
			
	}
	function cmdCancelar(){
			window.close();
	}
	
</script>

<SCRIPT ID=clientEventHandlersVBS LANGUAGE=vbscript>
<!--

Sub txtdato_onkeypress
if window.event.keycode=13 then
	cmdAceptar()
end if

End Sub

Sub txtdato_onchange
'txtdato.value=""
End Sub

-->
</SCRIPT>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
	color: #000033;
}
body {
	background-color: #ccdafd;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #000066; }
.Estilo8 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style></head>
<body topmargin="0" leftmargin="0">
 <table  border="0" align="center">
   <tr>
     <td><table width="329" border="0" align="center" cellpadding="2" bordercolor="#111111" id="AutoNumber1" style="BORDER-COLLAPSE: collapse">
       <tr>
         <td height="22" bgcolor="#ccdafd"><div align="center"><strong><span class="Estilo7">&iquest;Ingrese el campo que desea buscar?</span></strong></div></td>
       </tr>
       <tr>
         <td bgcolor="#FFFFFF"></td>
       </tr>
       <tr>
         <td height="28" bordercolor="#EFEBDE" bgcolor="#FFFFFF"><table width="100%" bgcolor="#ccdafd">
             <tr>
               <td colspan="3">&nbsp;</td>
              </tr>
             <tr>
               <td width="71%"><span class="Estilo4">Buscar por: </span></td>
               <td>&nbsp;</td>
               <td>
                 
            </td>
             </tr>
             
			 
			<?php
  $selecTabla="select * from `".$table."`";
  $resultado = mysql_query($selecTabla);
  $ncampos = mysql_num_fields($resultado);
  $n_registros  = mysql_num_rows($resultado);  
   $i=0;
  		   while ($i < $ncampos) 
     	   {	
		     $nombre_campo  = mysql_field_name($resultado, $i); 
			 $objformulario->form_format_field($table,$nombre_campo);			 
			 
			 if ($objformulario->fie_activesearch==1)
		     { 
			 
			 	if ($objformulario->fie_value=="replace")   
				{  	   
			   		
					$tok=strtok($objformulario->fie_datadb,",");
					$tok1 = strtok (",");
										
					printf ("<tr><td><span class='Estilo8'>%s</span></td>",$objformulario->fie_title);
               		printf ("<td><span class='Estilo8'><input name='%s' type='checkbox'  value='%s'></span></td>",$tok1,$tok1); 
printf ("<td><span class='Estilo8'></span></td>",$i);			   
			   		printf ("<td><input name='%sval' type='text' class='Estilo8' value='Texto de busqueda'></td></tr>",$tok1);
				}
				else
				{
			   		printf ("<tr><td><span class='Estilo8'>%s</span></td>",$objformulario->fie_title);
               		printf ("<td><span class='Estilo8'><input name='%s' type='checkbox'  value='%s'></span></td>",$nombre_campo,$nombre_campo); 
printf ("<td><span class='Estilo8'></span></td>",$i);			   
			   		printf ("<td><input name='%sval' type='text' class='Estilo8' value='Texto de busqueda'></td></tr>",$nombre_campo);				
				}
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
  ?>	
 
			 
			 
			 
			 
			 
         </table></td>
       </tr>
       <tr>
         <td height="28" bgcolor="#ccdafd">
           <div align="center">
             <input type="button" value="Aceptar" onClick="javascript:cmdAceptar()" name="cmdAceptar" class="boton">
             <input type="button" value="Cancelar" onClick="javascript:cmdCancelar()" name="cmdCancelar" class="boton">
         </div></td>
       </tr>
     </table></td>
   </tr>
 </table>
</body>

</html>

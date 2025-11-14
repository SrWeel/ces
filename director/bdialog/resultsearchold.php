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
<HEAD>
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<SCRIPT LANGUAGE=javascript>
<!--
function buscar(dat){
	window.returnValue=dat		
	window.close()
}
//-->
</SCRIPT>
<SCRIPT language=JavaScript>
<!--
function imprimir() {
  if (window.print)
    window.print()
  else
    alert("Disculpe, su navegador no soporta esta opción, seleccione en el menu de su navegador la opción para imprimir...");
}
//-->
</SCRIPT>
<meta http-equiv="refresh" content="10">
<style type="text/css">
<!--
.Estilo1 {
	color: #000066;
	font-weight: bold;
}
-->
</style>
</HEAD>
<BODY leftMargin=0 topMargin=0 >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#D5E9F0"> 
    <td width="17%" height="19" bgcolor="#FFFFFF"><form name="form1" method="post" action="">
     <input class="boton" type=button button name=print value="Imprimir" onClick="javascript:window.print()">
    </form></td>
    <td width="83%" bgcolor="#FFFFFF"><div align="center"><span class="Estilo1"> SISTEMA FINANCIERO <em>&quot;CECORP</em> &quot; </span></div></td>
  </tr>
</table>
<table  cellSpacing=0 cellPadding=0 border=0 style="FONT-SIZE: 10px; FONT-FAMILY: verdana" width="100%">
  <TR bgcolor="#B0CAD9"> 
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
		       printf("<TD><font color=white><b>%s</b></font></TD>",$objformulario->fie_title);
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
  ?>	
  </TR>
  <tr> 
    <td> </td>
    <td></td>
    <td> </td>
  </tr>
  <?php
 
  $i=0;

$es=ctype_digit ($ape);

  while ($i < $ncampos) 
     {
   		$objformulario->fie_activesearch=0;
		$nombre_campo  = mysql_field_name($resultado, $i); 		
		$objformulario->form_format_field($table,$nombre_campo);		
		if ($objformulario->fie_activesearch==1)
		{		   
           $fieldscreen=$fieldscreen.",".mysql_field_name($resultado, $i);		
		   $type=mysql_field_type($resultado, $i);  
			
           if ($es==true)
              {
	//	   
		   		switch ($type) 
									{
										 case "int":
									      {   
											 $operator=" = ".$ape;   
											 $fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       }
      									 break;
 									    case "real":
									      {   
											$operator=" = ".$ape;   
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       }
      									 break;
			
                                     }						 
      	//	   
                  
                  
                   
              }
           else
             {
              
	//	   
		   		switch ($type) 
									{
									     case "datetime":
									      {   
											$operator=" like '".$ape."'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       }
										   break;
										  case "date":
									      {   
											$operator=" like '".$ape."'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       } 
										   break; 
										 case "string":
									      {   
											$operator=" like '%".$ape."%'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       }
										   break;
										 case "blob":
									      {   
											$operator=" like '%".$ape."%'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
									       }
										   break;
                                     }								 
									 
      	//	                      


             }

		 	
		}		
		$i++; 
	}
	
	
	
	$sql="select ".substr ("$fieldscreen",1)." from `".$table. "` where ".substr ("$fieldsh",4);
	
	//echo $sql;
	$consulta = mysql_query($sql);
    if ($consulta)
    {
	    while($resultado = mysql_fetch_array($consulta)) 
		{ 
	       printf ("<tr onclick=buscar('%s') onmouseout=this.style.backgroundColor='white' onmouseover=this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'>",$resultado[0]);
		   $i=0;
  		   while ($i < $ncampos) 
     	   {	 
		     printf("<TD>%s</td>",$resultado[$i]);
			 $i++;
		   }
		   printf("</tr>");
	     }    
	 }  
  ?>
</table>
</BODY>
</HTML>

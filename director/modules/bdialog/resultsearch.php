<?php
//Llamando objetos
 include("../../libreria/dbcc.php");
 include("../../libreria/formulario.php");
 include("../../cfgclases/config.php");
//Conexion a la base de datos
  $objBd = new  conecc();
  $objformulario = new  formulario();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $link = $objBd->$this->enlace;  
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
</HEAD>
<BODY leftMargin=0 topMargin=0 >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#D5E9F0"> 
    <td width="17%" height="19"><form name="form1" method="post" action="">
     <input class="boton" type=button button name=print value="Imprimir" onClick="javascript:window.print()">
    </form></td>
    <td width="83%">AQUALIS 


 Solutions PHP Designed</td>
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

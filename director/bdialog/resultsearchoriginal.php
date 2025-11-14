<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
?> 
<?php

$ia=0;
$ib=0;

$tok=strtok($ape,",");
/*if ($tok=="true" or $tok=="false" or $tok=="NaNtrue" or $tok=="NaNfalse")
  {
   $activocm[$ia]= $tok;
   $ia++;
  }
  else
  {
   $valorcm[$ib]= $tok;
   $ib++;
  }
  */
while ($tok !== false)
{
  if ($tok=="true" or $tok=="false" or $tok=="NaNtrue" or $tok=="NaNfalse")
  {
   $activocm[$ia]= str_replace("NaN","",$tok);
   $ia++;
  }
  else
  {
   $valorcm[$ib]= $tok;
   $ib++;
  }
  $tok = strtok (",");
  
  
}
//print_r ($valorcm);

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

<style type="text/css">
<!--
.Estilo1 {
	color: #000066;
	font-weight: bold;
}
.Estilo6 {
	color: #990000;
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
-->
</style>
</HEAD>
<BODY leftMargin=0 topMargin=0 >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#FFFFFF"> 
    <td width="17%" height="19"><form name="form1" method="post" action="">
     <input class="boton" type=button button name=print value="Imprimir" onClick="javascript:window.print()">
    </form></td>
    <td width="83%"><div align="center"><span class="Estilo1"> OMEGA 2000 </span></div></td>
  </tr>
</table>
<?php
  $selecTabla="select * from `".$table."`";
  $textrasd=$table;
  $resultado = mysql_query($selecTabla);
  $ncampos = mysql_num_fields($resultado);
  
  $n_registros  = mysql_num_rows($resultado);  
    $i=0;

$es=ctype_digit ($ape);
$jv=0;
$banrep=0;
  		   while ($i < $ncampos) 
     	   {	
		     $nombre_campo  = mysql_field_name($resultado, $i); 
			 $objformulario->form_format_field($table,$nombre_campo);	 
			
			 if ($objformulario->fie_activesearch==1)
		     {
			   if ($objformulario->fie_value=="replace")   
				{  
				   $banrep=1;
				   $tok=strtok($objformulario->fie_datadb,",");
				   $tok1 = strtok (",");		
				   //*****************************************************************
				   $type=mysql_field_type($resultado, $i);  
				   switch ($type) 
									{
										 case "int":
									      { 
											 if ($activocm[$jv]=="true")
											 {
											 $operator=" like '%".$valorcm[$jv]."%'";    
											 $fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;											 
											 }
									       }
      									 break;
 									    case "real":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";    
											$fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;
											}
									       }
      									 break;			

									     case "datetime":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;
											}
									       }
										   break;
										  case "date":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;
											}
									       } 
										   break; 
										 case "string":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;
											}
									       }
										   break;
										 case "blob":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$objformulario->fie_tabledb.".".$tok1.$operator;
											}
									       }
										   break;
                                     }				     
        
		 	
		                
				   
				   //******************************************************************
				   
				    
		           $camposconsulta=$camposconsulta.",".$objformulario->fie_tabledb.".".$tok1;
			       $cactivos++;
				   
				   $tbunica= strstr($textrasd,$objformulario->fie_tabledb);
				   //echo $tbunica."<br>";
				   
				   if (!($tbunica))
				   {
				     $textrasd=$textrasd.",".$objformulario->fie_tabledb;				   
				   }
				   $campoenlace=$campoenlace." and ".$objformulario->fie_tabledb.".".$tok."=".$table.".".$objformulario->fie_name;
				 }
				 else
				 {
		            $type=mysql_field_type($resultado, $i);  
	  		        switch ($type) 
									{
										 case "int":
									      { 
											 if ($activocm[$jv]=="true")
											 {
											 $operator=" = ".$valorcm[$jv];   
											 $fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;											 
											 }
									       }
      									 break;
 									    case "real":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" = ".$valorcm[$jv];   
											$fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;
											}
									       }
      									 break;			

									     case "datetime":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '".$valorcm[$jv]."'";  
											$fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
										  case "date":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '".$valorcm[$jv]."'";  
											$fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;
											}
									       } 
										   break; 
										 case "string":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
										 case "blob":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".$table.".".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
                                     }				   
				   $camposconsulta=$camposconsulta.",".$table.".".$objformulario->fie_name;
			       $cactivos++;	 				 
				 }  
				   $jv++;
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
	 
	  	   
	   if ($banrep)
	    {
	      $sql = "select ".substr ("$camposconsulta",1)." from ".$textrasd." where (".substr ("$campoenlace",4).") and (".substr ("$fieldsh",4).")";
		}
		else
		{
		   $sql = "select ".substr ("$camposconsulta",1)." from ".$textrasd." where (".substr ("$campoenlace",4).") and (".substr ("$fieldsh",4).")";

		}
?>

  </TR>

  <?php
 
  $i=0;

$es=ctype_digit ($ape);
$jv=0;

  while ($i < $ncampos) 
     {
   		$objformulario->fie_activesearch=0;
		$nombre_campo  = mysql_field_name($resultado, $i); 				
		$objformulario->form_format_field($table,$nombre_campo);	
		//seleccionar todas las tablas extras	
		
		if ($objformulario->fie_activesearch==1)
		{		
		
		      
           $fieldscreen=$fieldscreen.",".mysql_field_name($resultado, $i);		
		   $type=mysql_field_type($resultado, $i);  
	  		switch ($type) 
									{
										 case "int":
									      { 
											 if ($activocm[$jv]=="true")
											 {
											 $operator=" = ".$valorcm[$jv];   
											 $fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;											 
											 }
									       }
      									 break;
 									    case "real":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" = ".$valorcm[$jv];   
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
											}
									       }
      									 break;			

									     case "datetime":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '".$valorcm[$jv]."'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
										  case "date":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '".$valorcm[$jv]."'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
											}
									       } 
										   break; 
										 case "string":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
										 case "blob":
									      {   
											if ($activocm[$jv]=="true")
											 {
											$operator=" like '%".$valorcm[$jv]."%'";  
											$fieldsh=$fieldsh." or ".mysql_field_name($resultado, $i).$operator;
											}
									       }
										   break;
                                     }								 
									 
      
          $jv++;
		 	
		}		
		$i++; 
	}
	
	//Verifica extraccion de datos con tablas relacionadas
	//$sql="select ".substr ("$fieldscreen",1)." from `".$table. "` where ".substr ("$fieldsh",4);

	$consulta = mysql_query($sql);	
	$ncamposl = mysql_num_fields($consulta);
	$nregitros= mysql_num_rows($consulta);

    if ($nregitros)
    {
	
echo "<table width='100%' border=0 align='center' cellPadding=0  cellSpacing=2 style='FONT-SIZE: 10px; FONT-FAMILY: verdana'>
  <TR bgcolor='#B0CAD9'> ";
 
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
			   $cactivos++;
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }

	   while($resultado = mysql_fetch_array($consulta)) 
		{ 
	       printf ("<tr onclick=buscar('%s') onmouseout=this.style.backgroundColor='white' onmouseover=this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'>",$resultado[0]);
		   $i=0;
  		   while ($i < $ncamposl) 
     	   {	 
		     
			 			 
			 $nombre_campo  = mysql_field_name($consulta, $i); 
			 $objformulario->form_format_field($table,$nombre_campo);			 
			 if ($objformulario->fie_activesearch==1)
		     { 
			   if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$resultado[$i];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus);
				    printf("<TD>%s</td>",$rmp);				   
				  }			 
			   else
			      {
			         printf("<TD>%s</td>",$resultado[$i]);		 
			      }
              }
              else
              {
                    printf("<TD></td>");
              }
			 
			 
			 //printf("<TD>%s</td>",$resultado[$i]);
			 //echo $nombre_campo;
			 $i++;
		   }
		   printf("</tr>");
	     }  
	echo "</table>";	   
	 }  
	 else	 
	 {
	 
	echo " <table width='100%'  border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td bgcolor='#D1ECF3'><div align='center' class='Estilo1 Estilo6'>
      <p>&nbsp;</p>
      <p>No existen registros que coincidan con su busqueda...Intente nuevamente. </p>
      <p>&nbsp;</p>
    </div></td>
  </tr>
</table>";
	 
	 
	 }
  ?>
  <textarea name="textarea" cols="60" rows="6"><?php  echo $sql; ?></textarea>
</BODY>
</HTML>

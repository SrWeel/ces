<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
ini_set('max_execution_time', 30000);
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
?> 
<?php
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombrevarget1='';
for($i=0;$i<$numero;$i++){
$nombrevarget1=$tags[$i];
$$nombrevarget1=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
$nombrevarget='';
for($i=0;$i<$numero2;$i++){ 
//$$tags2[$i]=$valores2[$i]; 

$nombrevarget=$tags2[$i];
$$nombrevarget=$valores2[$i];

}

if(@$valorlocal)
{
@$table=$valorlocal;
}
$oprb_tbl='';
$oprb_tbl=trim(strstr($table,'_'));

if(!($oprb_tbl))
  {
    $table=base64_decode($table);
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Resultado de la Busqueda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT language=JavaScript>
<!--
function buscar(ret1){
    window.opener.document.form_<?php echo str_replace(".","_",$table); ?>.action='index.php?geamv=<?php echo $geamv ?>&valorlocal=<?php echo base64_encode($table) ?>&sessid=<?php echo $sessid ?>';
	window.opener.document.form_<?php echo str_replace(".","_",$table); ?>.csearch.value=ret1;            
	window.opener.document.form_<?php echo str_replace(".","_",$table); ?>.opcion_<?php echo str_replace(".","_",$table); ?>.value='buscar';
	window.opener.document.form_<?php echo str_replace(".","_",$table); ?>.submit();		
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.Estilo1 {
	color: #000066;
	font-weight: bold;
}
-->
</style>

<style type="text/css">
<!--
.Estilo4 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 11px;
	color: #000033;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 11px; color: #000066; }
.Estilo8 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>

<script language="Javascript">
function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}
</script> 

</head>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/caja1_r1_c1.gif" alt="" name="caja1_r1_c1" width="20" height="18" border="0" id="caja1_r1_c1" /></td>
    <td background="images/caja1_r1_c2.gif"><img src="images/caja1_r1_c2.gif" alt="" name="caja1_r1_c2" width="439" height="18" border="0" id="caja1_r1_c2" /></td>
    <td><img src="images/caja1_r1_c3.gif" alt="" name="caja1_r1_c3" width="20" height="18" border="0" id="caja1_r1_c3" /></td>
  </tr>
  <tr>
    <td background="images/caja1_r2_c1.gif"><img src="images/caja1_r2_c1.gif" alt="" name="caja1_r2_c1" width="20" height="222" border="0" id="caja1_r2_c1" /></td>
    <td valign="top" bgcolor="#FFFFFF">

<a href="javascript:imprSelec('seleccion')" class="Estilo8" >Imprime la ficha</a>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	<?php
	$director="../";
//Conexion a la base de datos

include("../cfgclases/clases.php");
	
	

  
  ?>	
  
<script language=javascript>
<!--	
     function cmdAceptar(){			
	       			
			document.fab.action='resultsearch.php?campo=<?php echo $campo ?>&listab=<?php echo $listab ?>&valorlocal=<?php echo base64_encode($table) ?>';								
		    document.fab.submit();			
			
	}
	function cmdCancelar(){	        
			window.close();
	}
-->
</script>
  
    <form name="fab" method="post" action="">
   
  <table  border="0" align="center">
   <tr>
     <td><table width="400" border="0" align="center" cellpadding="2" bordercolor="#111111" id="AutoNumber1" style="BORDER-COLLAPSE: collapse">
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
               <td width="60%"><span class="Estilo4">Buscar por: </span></td>
               
               <td>                 
            </td>
             </tr>            
			 
			<?php
  $selecTabla2="select * from ".$table." limit 1";  
  $resultado2 = $DB_gogess->Execute($selecTabla2);
  $resultadoTb=$resultado2;
  $resultado=$resultado2;
  $ncampos2 = $resultado2->FieldCount();
  $n_registros2 = $resultado2->RecordCount();

  
   
   $i=0;
  		   while ($i < $ncampos2) 
     	   {	
		     
			 $fld=$resultado2->FetchField($i);
	         $nombre_campo=strtolower($fld->name);
			 $typecampo = $resultado2->MetaType($fld->type);
			  
			 //$nombre_campo  = mysql_field_name($resultado2, $i); 
			 //$typecampo  = mysql_field_type($resultado2, $i);
			 
			 $objformulario->form_format_field($table,$nombre_campo,$DB_gogess);			 
			 
			 if ($objformulario->fie_activesearch==1)
		     { 
			 	if ($objformulario->fie_value=="replace")   
				{
					$tok=strtok($objformulario->fie_datadb,",");
					$tok1 = strtok (",");										
					printf ("<tr><td><span class='Estilo8'>%s</span></td>",$objformulario->fie_title);
               		printf ("<td><span class='Estilo8'></span></td>",$tok1); 
printf ("<td><span class='Estilo8'></span></td>",$i);			   
			   		printf ("<td><input name='%sval' type='text' class='Estilo8' value=''></td></tr>",trim($tok1));
				}
				else
				{
			   		if ($typecampo=="date")
					{
					printf ("<tr><td><span class='Estilo8'>%s</span></td>",$objformulario->fie_title);
               		printf ("<td><span class='Estilo8'></span></td>",$nombre_campo); 
printf ("<td><span class='Estilo8'>Desde:</span></td>",$i);			   
			   		printf ("<td><span class='Estilo8'></span><input name='%sval' type='text' class='Estilo8' value=''></td></tr>",trim($nombre_campo));
					////////////////////////////
					printf ("<tr><td><span class='Estilo8'></span></td>");
               		printf ("<td><span class='Estilo8'></span></td>",$nombre_campo); 
printf ("<td><span class='Estilo8'>Hasta:</span></td>",$i);			   
			   		printf ("<td><span class='Estilo8'></span><input name='%svalff' type='text' class='Estilo8' value=''></td></tr>",trim($nombre_campo));
					
					
					}
					else
					{
					 printf ("<tr><td><span class='Estilo8'>%s</span></td>",$objformulario->fie_title);
               		printf ("<td><span class='Estilo8'></span></td>",$nombre_campo); 
printf ("<td><span class='Estilo8'></span></td>",$i);			   
			   		printf ("<td><input name='%sval' type='text' class='Estilo8' value=''></td></tr>",trim($nombre_campo));
					}				
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
             <input name="geamv" type="hidden" id="geamv" value="<?php echo $geamv ?>">
             <input name="vlt" type="hidden" id="vlt" value="1">
             <input type="button" value="Aceptar" onClick="cmdAceptar();" name="Aceptar">
             <input type="button" value="Cancelar" onClick="cmdCancelar();" name="Cancelar">
         </div></td>
       </tr>
     </table></td>
   </tr>
 </table> </form> 	</td>
    <td valign="top">
	<DIV ID="seleccion">
	<?php echo @$objparametros->timp; ?>
	<?php
	if (@$vlt==1)
	{
	?>
	<?php
	//echo "hola:".$_POST[pro_nombreval];
//if (isset($_POST['Aceptar']))
//{	
	//Sacando campos
  //$selecTb="select  * from ".$table." limit 1";
  //$resultadoTb = $DB_gogess->Execute($selecTb);
  $ncamposTb = $resultadoTb->FieldCount();
  $n_registrosTb = $resultadoTb->RecordCount();
  
  //$resultadoTb = mysql_query($selecTb);
  //$ncamposTb = mysql_num_fields($resultadoTb);
  //$n_registrosTb  = mysql_num_rows($resultadoTb);  
  
  
  
   $i=0;
   $jk=0;
    $typecampoval  ="";
  		   while ($i < $ncamposTb) 
     	   {	
		     //$nombre_campo  = mysql_field_name($resultado2, $i); 
			 //$typecampoval  = trim(mysql_field_type($resultado2, $i));
			 
			  $fld=$resultado2->FetchField($i);
	         $nombre_campo=strtolower($fld->name);
			 $typecampoval = $resultado2->MetaType($fld->type);
			 
			 $objformulario->form_format_field($table,$nombre_campo,$DB_gogess);			 			 
             
			 if ($objformulario->fie_activesearch==1)
		     { 			 
			 	if ($objformulario->fie_value=="replace")   
				{  	   
			   		
					$tok=strtok($objformulario->fie_datadb,",");					
					$tok1 = strtok (",");
					$tok=trim($tok);	
					$tok1=trim($tok1);
				
					if ($_POST[$tok1."val"])
					{
					  $activocm[$jk]="true";					 
					  if ($typecampoval=="D")
					  {
						
						  $valorcm[$jk]=$_POST[$tok1."val"];					  
						 // echo $jk."-".$tok1."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
						  $valorcm[$jk]=$_POST[$tok1."valff"];					  
						 // echo $jk."-".$tok1."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
					  }
					  else
					  {
					     $valorcm[$jk]=$_POST[$tok1."val"];					  
						 // echo $jk."-".$tok1."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
					  }
					}
					else
					{
					  $activocm[$jk]="false";					  
					  //echo $jk."-".$tok1."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
					  $jk++;
					}
					
				}
				else
				{
				    
			   		if ($_POST[$nombre_campo."val"])
					{
					  $activocm[$jk]="true";
					  if ($typecampoval=="D")
					  {
						  $valorcm[$jk]=$_POST[$nombre_campo."val"];						  			  
						  //echo $jk."-".$nombre_campo."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
						  $valorcm[$jk]=$_POST[$nombre_campo."valff"];						  			  
						  //echo $jk."-".$nombre_campo."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
					  }
					  else
					  {
					      $valorcm[$jk]=$_POST[$nombre_campo."val"];						  			  
						  //echo $jk."-".$nombre_campo."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
						  $jk++;
					  }	  
					}
					else
					{
					  $activocm[$jk]="false";					  
					 //echo $jk."-".$nombre_campo."-".$activocm[$jk]."-".$valorcm[$jk]."<br>";
					  $jk++;
					}
					
				}
				
				
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
		   

   
	//}
  ?>	
	
	
	
	<?php
/*
$ia=0;
$ib=0;
echo $ape;
$tok2=strtok($ape,",");
while ($tok2 !== false)
{
  if ($tok2=="true" or $tok2=="false" or $tok2=="NaNtrue" or $tok2=="NaNfalse")
  {
   $activocm[$ia]= str_replace("NaN","",$tok2);
   $ia++;
  }
  else
  {
   $valorcm[$ib]= $tok2;
   $ib++;
  }
  $tok2 = strtok (",");
  
  
}
*/
?>
      <?php 
	  
 $j=0;
 $i=0;
  //$selecTabla="select  * from ".$table." limit 1"; 
  
  //$resultado = $DB_gogess->Execute($selecTabla);
  
 // $resultado = mysql_query($selecTabla);
  $ncampos = $resultado->FieldCount();
  
  //$ncampos = mysql_num_fields($resultado); 
   while ($i < $ncampos) 
     	   {	
		    // $nombre_campo  = mysql_field_name($resultado, $i);	
			 
			 $fld=$resultado->FetchField($i);
	         $nombre_campo=strtolower($fld->name);
			 //$typecampoval = $resultado->MetaType($fld->type);
			 		 
			 $objformulario->form_format_field($table,$nombre_campo,$DB_gogess);	          
			 if ($objformulario->fie_activesearch==1)
		     {
			  
			   $fieldscreen=$fieldscreen.",".$table.".".$nombre_campo;		
			   $tok3 = strtok($objformulario->fie_datadb,",");
			   $tok13 = strtok (",");
			   $tok3=trim($tok3);
			   $tok13=trim($tok13);
		       //echo  $activocm[$j]."-".$valorcm[$j]."-".$table.".".$nombre_campo ." Tabla Enlace:".$objformulario->fie_tabledb." Campo = ".$tok1."<br>";
			  // echo $objformulario->fie_tabledb."-".$activocm[$j]."<br>";
			  //CAMPOS ENLACE
			  if ($activocm[$j]=="true")
			   {
			    
			  	if ($objformulario->fie_value=="replace")
			  	{
			   	$camposenl= $camposenl." and ".$objformulario->fie_tabledb.".".$tok3."=".$table.".".$nombre_campo;
			  	}

			  }
			  //TABLAS ENLACE
			   if ($activocm[$j]=="true")
			   {
			     if (!($table == $objformulario->fie_tabledb))
				 {
			       $tablasint=$tablasint.",".$objformulario->fie_tabledb; 
				 }
			   }	
			  //DATOS CONSULTA 
			  
			   if ($activocm[$j]=="true")
			   {			
			      
				if ($objformulario->fie_value=="replace")
			  	{
				 //Tipo de operador y comodines			
        		   $objformulario->tipo_campo($objformulario->fie_tabledb,$tok13,$DB_gogess);					
			     //Fin tipo de operador y comodines
			   	  $datoscon=$datoscon." and ".$objformulario->fie_tabledb.".".$tok13.$objformulario->tipooperador.$objformulario->izqa.$valorcm[$j].$objformulario->dera;
			  	}
				else
				{
				 //Tipo de operador y comodines			
        		   $objformulario->tipo_campo($table,$nombre_campo,$DB_gogess);					
			     //Fin tipo de operador y comodines				
				  if ($objformulario->tipocampo=="date")
				  {
				    $datoscon=$datoscon." and ".$table.".".$nombre_campo.">=".$objformulario->izqa.$valorcm[$j].$objformulario->dera;
					$j=$j+1;
					$datoscon=$datoscon." and ".$table.".".$nombre_campo."<=".$objformulario->izqa.$valorcm[$j].$objformulario->dera;
				  }
				  else
				  {
				    $datoscon=$datoscon." and ".$table.".".$nombre_campo.$objformulario->tipooperador.$objformulario->izqa.$valorcm[$j].$objformulario->dera;
				  }
				  
				}
				
			   }
			   $objformulario->fie_activesearch=0;
			   $j++;
			   
		     }
			 $i++;
		   }  
	
		
	$objformulario->tipo_campo($table,$campo,$DB_gogess);		
	if ($objformulario->tipooperador=="like")
	{
	  $obp='str';
	}
	else
	{
	  $obp='';
	}
	
	if ($camposenl)
	{
	
	  	if ($datoscon)
		{
		  if ($campo)
			{
			 if ($listab)
			 {
			  if ($obp=='str')
			  {		   
	           $consultaf= "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4) . $datoscon ." and ".$table.".".$campo." like '".$listab."'";
			   }
			   else
			   {
                $consultaf= "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4) . $datoscon ." and ".$table.".".$campo." = ".$listab;			   			   
			   }
			 } 
			 else
			 {
  	           $consultaf= "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4) . $datoscon;
			 }
		}
		else
		{
          $consultaf= "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4) . $datoscon;		
		}	 
			   
		}
		else
		{
		 if ($campo)
			{
			 if ($listab)
			 {
			  if ($obp=='str')
			  {			
   		        $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4)." and ".$table.".".$campo." like '".$listab."'";
			  }
			  else
			  {
			     $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4)." and ".$table.".".$campo." = ".$listab;
			  }
			 }
			 else
			 {
			   $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4);
			 }
			}
			else
			{
			$consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4);
			}  
			
		
		}		
	}
	else
	{
	
	 if ($datoscon)
		{
		 
			if ($campo)
			{
			 if ($listab)
			 {
			  if ($obp=='str')
			  {
			    $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". substr ("$datoscon",4)." and ".$table.".".$campo." like '".$listab."'";
			  }
			  else
			  {
			   $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". substr ("$datoscon",4)." and ".$table.".".$campo." = ".$listab;
			  }
 		     }
			  else
			  {
			    $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". substr ("$datoscon",4);
			  
			  }
			}	
			else
			{			 
			  $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". substr ("$datoscon",4);
			}	
		}
		else
		{
		   if ($campo)
		   {
		    if ($listab)
			{
		      if ($obp=='str')
			  {
		        $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ".$table.".".$campo." like '".$listab."'";
			  }
			  else
			  {
			    $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ".$table.".".$campo." = ".$listab;
			  }	
			 }
			 else
			 {
			   $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint;
			 }
			  
		   }
		   else
		   {
			 $consultaf = "select " .substr ("$fieldscreen",1)." from " . $table.$tablasint;
		   }
		}  
		  
	}
//"select " .substr ("$fieldscreen",1)." from " . $table.$tablasint . " where ". 	substr ("$camposenl",4) . substr ("$datoscon",4);
//<textarea name="" cols="60" rows="7">echo $consultaf </textarea>
?>
      <?php

    //$consulta = mysql_query($consultaf);	
	//echo $consultaf;
	$consulta= $DB_gogess->Execute($consultaf." limit 1");
	if($consulta)
	{
	$ncamposl = $consulta->FieldCount();
	$nregitros= $consulta->RecordCount();
	}
	//$ncamposl = mysql_num_fields($consulta);
	//$nregitros= mysql_num_rows($consulta);
	
 if ($nregitros)
    {
	
echo "<table width='100%' border=0 align='center' cellPadding=0  cellSpacing=2 style='FONT-SIZE: 10px; FONT-FAMILY: verdana'>
  <TR bgcolor='#B0CAD9'> ";
  
   $i=0;
  		   while ($i < $ncampos) 
     	   {	
		    // $nombre_campo  = mysql_field_name($resultado, $i); 
			 
			 $fld=$consulta->FetchField($i);
			 $nombre_campo=strtolower($fld->name);
			 $consulta->MetaType($fld->type);
		 
		 
			 $objformulario->form_format_field($table,$nombre_campo,$DB_gogess);	 
			
			 if ($objformulario->fie_activesearch==1)
		     { 
		       printf("<TD><font color=blanck><b>%s</b></font></TD>",$objformulario->fie_title);
			   $cactivos++;
			 }
			 $objformulario->fie_activesearch=0;
			 $i++;
		   }
echo "</tr>";
$z=0;	
if($table=='consu_productos')
{
 $consulta= $DB_gogess->Execute($consultaf." order by produc_id desc limit 2000");
 }
 else
 {
 
  $consulta= $DB_gogess->Execute($consultaf);
 }
 while (!$consulta->EOF) { 
   
		  $z++;
		   $fld=$consulta->FetchField(0);
		   $nombre_campo=strtolower($fld->name);
	       printf ("<tr onclick=buscar('%s') onmouseout=this.style.backgroundColor='white' onmouseover=this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'>",$consulta->fields[$nombre_campo]);
		   $i=0;
  		   while ($i < $ncamposl) 
     	   {			 			 
			 //$nombre_campo  = mysql_field_name($consulta, $i); 
			 
			 $fld=$consulta->FetchField($i);
			 $nombre_campo=strtolower($fld->name);
			 $consulta->MetaType($fld->type);
			 
			 $objformulario->form_format_field($table,$nombre_campo,$DB_gogess);			 
			 if ($objformulario->fie_activesearch==1)
		     { 
			   if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$consulta->fields[$nombre_campo];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				    printf("<TD>%s</td>",$rmp);				   
				  }			 
			   else
			      {
			         printf("<TD>%s</td>",$consulta->fields[$nombre_campo]);		 
			      }
              }
              else
              {
                    //printf("<TD></td>");
              }
			 $i++;
			 
			 
		   }
		   printf("</tr>");
		   $consulta->MoveNext();
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
  <?php
  }
  ?>
  <table width="200" border="0" cellpadding="0" cellspacing="2">
    <tr>
      <td width="114" bgcolor="#E8F3F4"><span class="style2">Total Registros:</span></td>
      <td width="80" bgcolor="#E8F3F4"><span class="style2"><?php echo @$z ?></span></td>
    </tr>
  </table>
  <?php echo $objparametros->pimp; ?>
  </DIV>
  </td>
  </tr>
</table> 

 </td>
    <td background="images/caja1_r2_c3.gif"><img src="images/caja1_r2_c3.gif" alt="" name="caja1_r2_c3" width="20" height="222" border="0" id="caja1_r2_c3" /></td>
  </tr>
  <tr>
    <td><img src="images/caja1_r3_c1.gif" alt="" name="caja1_r3_c1" width="20" height="18" border="0" id="caja1_r3_c1" /></td>
    <td background="images/caja1_r3_c2.gif"><img src="images/caja1_r3_c2.gif" alt="" name="caja1_r3_c2" width="439" height="18" border="0" id="caja1_r3_c2" /></td>
    <td><img src="images/caja1_r3_c3.gif" alt="" name="caja1_r3_c3" width="20" height="18" border="0" id="caja1_r3_c3" /></td>
  </tr>
</table>

</body>
</html>

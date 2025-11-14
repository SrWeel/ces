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
include("formulario.php");
include("dbcc.php");
include("../cfgclases/config.php");
include("detallefactura.php"); 
include("template.php");

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
  
  $objgridtabla=new estilofactura();
  
  $objtemplate = new  template();
  $objtemplate->select_template();
  
  printf("<link href='../%sstyles/formato.css' rel='stylesheet' type='text/css'>",$objtemplate->path_template);
 ?> 
 
<?php
if (!($id_inicio))
{
$id_inicio=0;
}

$objgridtabla->tabla=$table;
$objgridtabla->desplegar=$ndesplegar;
$objgridtabla->id_inicio=$id_inicio;
$objgridtabla->forden=$forden;
$objgridtabla->campoorden=$campoorden;

$objgridtabla->campo=$campo;
$objgridtabla->obp=$obp;
$objgridtabla->listab=$listab;

$objgridtabla->gridtabla();

$paginaactual=($objgridtabla->id_inicio/$objgridtabla->desplegar)+1;

if ($forden==1)
{
$ascendente=2;
}
else
{
$ascendente=1;
}
echo "<div class=txtlista>N.Registros: ".$objgridtabla->totalreg."</div>" ;

?>
<SCRIPT LANGUAGE=javascript>
<!--
function searchoflist(ret1) 
{ 	
	window.document.fa.action='index.php?geamv=<?php echo $geamv ?>&id_inicio=<?php echo $id_inicio;?>&campoorden=<?php echo $objgridtabla->campoorden ?>&forden=<?php echo $objgridtabla->forden ?>'
	window.document.fa.csearch.value=ret1   
	window.document.fa.opcion.value='buscar'
	window.document.fa.submit()		
}	
//-->
</SCRIPT>

<TABLE  cellpadding="0" cellspacing="0" >
<TR>
<TD>

<TABLE width="100%" cellpadding="1" cellspacing="1" class="titulotablaaq">

 <tr bgcolor="#CCCCCC">
   <td nowrap></td>
   <?php
   $nd=0; 
   foreach($objgridtabla->arrcamposn as $camponom): ?>
    <td  nowrap><a href="<?php echo 'index.php?table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$id_iniciosig.'&campoorden='.$objgridtabla->arrcampos[$nd]."&forden=".$ascendente."&campo=".$campo."&obp=".$obp."&listab=".$listab; ?>" target="_top" class="linklista"><?php echo $camponom ?></a></td>
    
    <?php 
	$nd++;
	endforeach; ?>
  </tr>  

   <?php 
   if(count($objgridtabla->filas)>0)
   {
   foreach($objgridtabla->filas as $datoslista): ?>
    <tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor='#ffffff' onmouseover=this.style.cursor='hand';this.style.backgroundColor='#d4d0c8' >	 
	 
	 <?php 
	 $reclista=1;
	 foreach($objgridtabla->arrcampos as $camposdata): 
	 if($reclista==1)
	 {	  	 
	 echo '<td nowrap><input type="image" name="imageField" src="'.$objtemplate->path_template.'images/b_edit.png" onclick=searchoflist("'.$datoslista[$camposdata].'") ></td>  
     <td  nowrap class=txtlista>'.$datoslista[$camposdata].'</td>'; 
	  }
	  else
	  {
	    $objformulario->form_format_field($table,$camposdata);
		
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];				   
				    $rmp= $objformulario->textorraro($objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus));
				   		   
				  }			 
			   else
			      {
			        $rmp= $objformulario->textorraro($datoslista[$camposdata]);			 
			      }		
		
		echo '<td  nowrap nowrap class=txtlista>...'.$rmp.'</td>'; 	  
	  }
	  $reclista++;
	  ?>
    <?php endforeach; ?>	
     </tr>
    <?php 
	
	endforeach; 
	}?>
</TABLE>

</TD>
</TR>
<tr><td bgcolor="#FFFFFF"> 
<?php
echo "<div class=txtlista>PAGINAS: </div>";
$iniciopag=0;
for($ipag=1;$ipag<=$objgridtabla->total_paginas;$ipag++)
{
	if($paginaactual==$ipag)
	{
	 echo '<span class="actualpg">'.$ipag.'</span> - ';
	}
	else
	{
	 echo '<a href="index.php?listab='.$listab.'&obp='.$obp.'&campo='.$campo.'&table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$iniciopag.'&campoorden='.$objgridtabla->campoorden.'&forden='.$objgridtabla->forden.'" target="_top" class=txtlista>'.$ipag.'</a> - ';
	}
 $iniciopag=$iniciopag+$objgridtabla->desplegar;
}
$id_iniciosig=$id_inicio+$objgridtabla->desplegar;
if($id_iniciosig<$objgridtabla->totalreg)
{
echo '<a href="index.php?listab='.$listab.'&obp='.$obp.'&campo='.$campo.'&table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$id_iniciosig.'&campoorden='.$objgridtabla->campoorden.'&forden='.$objgridtabla->forden.'" target="_top" class=txtlista>->></a>';
}
?>
</td>
</tr>
</TABLE>

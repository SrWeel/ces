<?php
if (!($id_inicio))
{
$id_inicio=0;
}

$objgridtabla->tabla=$table;
$objgridtabla->desplegar=$objtableform->tab_nlista;
$objgridtabla->id_inicio=$id_inicio;
$objgridtabla->forden=$forden;
$objgridtabla->campoorden=$campoorden;

$objgridtabla->campo=$campo;
$objgridtabla->obp=$obp;
$objgridtabla->listab=$listab;

$objgridtabla->gridtabla($DB_gogess);

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
	
	<?php
	$linkbusca="geamv=".$geamv."&id_inicio=".$id_inicio."&campoorden=".$objgridtabla->campoorden."&forden=".$objgridtabla->forden."&campo=".$campo."&obp=num&seccapl=".$seccapl."&apl=".$apl."&secc=7";
	
	$linkencriptado=$objcontenido->variables_segura($linkbusca);
	
	?>
	window.document.fa.action='index.php?snp=<?php echo $linkencriptado; ?>'
	
	window.document.fa.csearch.value=ret1   
	window.document.fa.opcion.value='buscar'
	window.document.fa.submit()		
}	
//-->
</SCRIPT>
<style type="text/css">
<!--
.TableScroll_apl {
        z-index:99;
		width:480px;
        height:150px;	
        overflow: auto;
      }	
-->
</style>


<TABLE  cellpadding="0" cellspacing="0" >
<TR>
<TD>
<div class=TableScroll_apl>
<TABLE width="100%" cellpadding="1" cellspacing="1" class="titulotablaaq">

 <tr bgcolor="#CCCCCC">
   <td nowrap></td>
   <?php 
   $nd=0; 
   foreach($objgridtabla->arrcamposn as $camponom): ?>
    <td  nowrap><a href="<?php echo 'index.php?geamv='.$geamv.'&table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$id_iniciosig.'&campoorden='.$objgridtabla->arrcampos[$nd]."&forden=".$ascendente."&campo=".$campo."&obp=".$obp."&listab=".$listab; ?>&seccapl=<?php echo $seccapl; ?>&apl=<?php echo $apl; ?>&secc=7&system=<?php echo $system; ?>" target="_top" class="linklista"><?php echo $camponom ?></a></td>
    
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
	    $objformulario->form_format_field($table,$camposdata,$DB_gogess);
		
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[$camposdata];			 
			      }		
		
		echo '<td  nowrap nowrap class=txtlista>'.$rmp.'</td>'; 	  
	  }
	  $reclista++;
	  ?>
    <?php endforeach; ?>	
     </tr>
    <?php 
	
	endforeach; 
	}?>
</TABLE>
</div></TD>
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
	 echo '<a href="index.php?geamv='.$geamv.'&listab='.$listab.'&obp='.$obp.'&campo='.$campo.'&table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$iniciopag.'&campoorden='.$objgridtabla->campoorden.'&forden='.$objgridtabla->forden.'&seccapl='.$seccapl.'&apl='.$apl.'&secc=7&system='.$system.'" target="_top" class=txtlista>'.$ipag.'</a> - ';
	}
 $iniciopag=$iniciopag+$objgridtabla->desplegar;
}
$id_iniciosig=$id_inicio+$objgridtabla->desplegar;
if($id_iniciosig<$objgridtabla->totalreg)
{
echo '<a href="index.php?geamv='.$geamv.'&listab='.$listab.'&obp='.$obp.'&campo='.$campo.'&table='.$objgridtabla->tabla.'&sessid='.$sessid.'&id_inicio='.$id_iniciosig.'&campoorden='.$objgridtabla->campoorden.'&forden='.$objgridtabla->forden.'&seccapl='.$seccapl.'&apl='.$apl.'&secc=7&system='.$system.'" target="_top" class=txtlista>->></a>';
}
?>
</td>
</tr>
</TABLE>
<?php
//Llamando objetos
$director="../../";

include("../../cfgclases/clases.php");
//Conexion a la base de datos

$listagrid="select * from gogess_subgrid where subgri_activo=1 and subgri_id=".$_POST["psubgri_id"];
	
	$resultgrid = $DB_gogess->Execute($listagrid);	
	if($resultgrid)
	{	
	   while (!$resultgrid->EOF) 
	   {
	     $table=$resultgrid->fields["subgri_nameenlace"];
		 $campoenc=$resultgrid->fields["subgri_campoenlace"];
		 $tipoenlace=$resultgrid->fields["subgri_tipoenlace"];
		 
		 $subgri_campoidts=$resultgrid->fields["subgri_campoidts"];
		 
		 
		 
		 //echo $resultgrid->fields["subgri_tipoenlace"]."<br>";
		 
		  $resultgrid->MoveNext();
	   }
	 }  
	   
//TABLA PARA GENERAR GRID

//$objformulario->pathgrid="../../";
//$objformulario->sendvar[$campoenc."x"]=$_POST["plistab"];
//$objformulario->cambion="mante_id";
//$objformulario->generar_formulario($submit,$table,$atributos,$ancho,$varsend,$sessid,1,$DB_gogess);


$objformulario->tabla=$table;
$objformulario->listab=$_POST["plistab"];
$objformulario->obp=$tipoenlace;
$objformulario->campoorden=$subgri_campoidts;
$objformulario->forden=2;
$objformulario->desplegar=20000;

if(!($objformulario->id_inicio))
{
$objformulario->id_inicio=0;
}

$objformulario->campo=$campoenc;

$sqltabla="select  * from ".$objformulario->tabla;	
			
			$rs_grt = $DB_gogess->Execute($sqltabla);
			 if ($rs_grt)
			   {
			       $ncampos = $rs_grt->FieldCount();	   
				   
				   $i=0;
				   while ($i < $ncampos) 
     	   			{
					  	$fld=$rs_grt->FetchField($i);
	                    $nombre_campo=strtolower($fld->name);
						
				 		$objformulario->form_format_field($objformulario->tabla,$nombre_campo,$DB_gogess);	
						if ($objformulario->fie_activogrid)
						{
							$objformulario->arrcampos[]=$nombre_campo;							
							$titulocampo=str_replace(":","",$objformulario->fie_title);
							$objformulario->arrcamposn[]=$titulocampo;									
						}
						
						$i++;
					}	
			   }


if($objformulario->listab)
		   {
             /////////////////////////////////////	
					 if ($objformulario->obp=='num')
						{
						   $obpd='=';
						}
					     else
						{
						   $obpd='like ';
						}
						
					 if ($objformulario->obp=='=')
						   {
						     $comillas=" ";
						   }
						   else
						   {
						     $comillas="'";
						   }
					  if ($objformulario->campoorden)
					  {
						if($objformulario->forden==1)
						{
						// $datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." asc limit ".$objformulario->id_inicio.",".$objformulario->desplegar;
						 
						 
						 $datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." asc ";	
						 $datoscompleto="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." asc ";	
						}
						else
						{
						 //$datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." desc limit ".$objformulario->id_inicio.",".$objformulario->desplegar;
						 
						 $datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." desc ";	 	
						 $datoscompleto="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." order by ".$objformulario->campoorden." desc ";	
						} 		  
					  }
					  else
					  {
					   //$datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." limit ".$objformulario->id_inicio.",".$objformulario->desplegar;	
					   $datos="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas." ";		
					   $datoscompleto="select * from ".$objformulario->tabla." where ".$objformulario->campo." ".$obpd.$comillas.$objformulario->listab.$comillas;		
					  }
					/////////////////////////////////////	

}

//echo $datoscompleto;

 $resultdatos = $DB_gogess->SelectLimit($datos,$objformulario->desplegar,$objformulario->id_inicio);
 $resultdatoscompleto = $DB_gogess->Execute($datoscompleto);
				
				$n_registros = $resultdatoscompleto->RecordCount();
								  
				   $objformulario->totalreg=$n_registros;
				   $objformulario->total_paginas = ceil($n_registros / $objformulario->desplegar); 
			   
			   if ($resultdatos)
			   {
				 while((!$resultdatos->EOF) and ($k<$objformulario->desplegar)) 
					{
				 		//print_r($resultdatos->fields);
						$objformulario->filas[]=$resultdatos->fields;
						
						
				 		$k++;
						$resultdatos->MoveNext();
						//echo $k."<br>";
				    }					
					//print_r($objformulario->filas);
			   }
			   //Fin sql de consulta
			   
?>

<div class=TableScroll_grid>
<TABLE width="100%" cellpadding="1" cellspacing="1" class="titulotablaaq">

 <tr bgcolor="#CCCCCC">
   <td nowrap style="border: 1px solid #000000;"  ></td><td nowrap style="border: 1px solid #000000;"  ></td>
   <?php
   $nd=0; 
   foreach($objformulario->arrcamposn as $camponom): ?>
    <td  nowrap class="linklista" style="border: 1px solid #000000;"  ><?php echo $camponom ?></td>
    
    <?php 
	$nd++;
	endforeach; ?>
  </tr>  

   <?php  
   if(count($objformulario->filas)>0)
   {
   foreach($objformulario->filas as $datoslista): ?>
    <tr bgcolor="#ffffff"  onmouseout=this.style.backgroundColor='#ffffff' onmouseover=this.style.backgroundColor='#d4d0c8' >	 
	 
	 <?php 
	 $reclista=1;
	 foreach($objformulario->arrcampos as $camposdata): 
	 
	 $objformulario->form_format_field($table,$camposdata,$DB_gogess);
	 if($reclista==1)
	 {	  
	 
	 ////////////////////////////////////////////////////////////
	 
	 if ($objformulario->fie_value=="replace")
			     {
				    $valorbus=$datoslista[maymin($camposdata)];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				 }
				 else
				 {
				 
				   $rmp= $datoslista[maymin($camposdata)];	
				 }
	 
	 ///////////////////////////////////////////////////////////
	 
	 $function_borrar='agregar_dato_'.$_POST["psubgri_id"].'(2,'.$datoslista[maymin($subgri_campoidts)].')';
	 	 
	 echo '<td nowrap  onclick="'.$function_borrar.'" style="border: 1px solid #999999;cursor:pointer;" ><img src="images/remove.png" width="20" height="20" /></td>  
	 
	 <td  nowrap class=txtlista style="border: 1px solid #999999;" >
	 ';
	 
		echo ' <table border="0" cellpadding="0" cellspacing="3">
  <tr>';	 
	 $funcioneslista="select * from gogess_gridfunciones where gri_activo=1 and subgri_id=".$_POST["psubgri_id"];
	 	$resultgridf = $DB_gogess->Execute($funcioneslista);	
	if($resultgridf)
	{	
	   while (!$resultgridf->EOF) 
	   {
	   	 
       $linkfucion=str_replace("-id-",$datoslista[maymin($subgri_campoidts)],$resultgridf->fields["gri_funcion"]);
	   $linkfucion=str_replace("chr39","'",$linkfucion);
	   
       echo '<td '.$linkfucion.' style="cursor:pointer"><img src="'.$objformulario->em_patharchivo.$resultgridf->fields["gri_icono"].'"  /></td>';

	   $resultgridf->MoveNext();
	   }
	   
	 }  
 echo ' </tr>
</table>';
	   	 
	 echo '</td>
	 
	 
     <td  nowrap class=txtlista style="border: 1px solid #999999;" >'.$rmp.'</td>'; 
	 
	 
	 
	 
	  }
	  else
	  {
	    
		
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[maymin($camposdata)];				   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[maymin($camposdata)];			 
			      }		
		
		echo '<td  nowrap nowrap class=txtlista style="border: 1px solid #999999;" >'.$rmp.'</td>'; 	  
	  }
	  $reclista++;
	  ?>
    <?php endforeach; ?>	
     </tr>
    <?php 
	
	endforeach; 
	}?>
</TABLE>
</div>
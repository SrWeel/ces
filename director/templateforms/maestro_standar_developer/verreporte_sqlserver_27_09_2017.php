<?php  
include("libreporte_sqlserver.php");
$objgridtablareporte=new listadoreportegrid();	
$ival=0;
$lista_op=array();

$datestart=date("Y-m-d");

$nuevafecha = strtotime ( '-3 month' , strtotime ( $datestart ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
$dateend=$nuevafecha;




$sqlconcatena='';
$pathcampos='campos';
$list_data="select * from sth_vddetalle where vardev_id=".$ireport;
$resultlistat = $DB_gogess->Execute($list_data);
$isegmento=0;
if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {				  
					 
					  $listacamposl[$ival]=$resultlistat->fields["vardevdet_tabla"].".".$resultlistat->fields["vardevdet_campo"];
					
					  
					  
					  if(trim($resultlistat->fields["vardevdet_tabla"]))
					  {
					     $concatenacampos.=$resultlistat->fields["vardevdet_tabla"].".".$resultlistat->fields["vardevdet_campo"].",";
					  }
					  
					  if(trim($resultlistat->fields["vardevdet_tabla"])=='')
					  {
					      
						  
						  $campo_operaciones=$resultlistat->fields["vardevdet_operation"];
						  $lista_campos_ing="select * from sth_vddetalle inner join gogess_sisfield on tab_name=vardevdet_tabla and fie_name=vardevdet_campo where vardev_id=".$ireport;
						  $result_cmp = $DB_gogess->Execute($lista_campos_ing);
						  
						  if($result_cmp)
						  { 
						  
							  while (!$result_cmp->EOF) {	
							  
								  if($result_cmp->fields["vardevdet_tabla"])
								  {
									   $nombre_field=str_replace(":","",$result_cmp->fields["fie_title"]);
									   
									   $campo_operaciones=str_replace($nombre_field,$result_cmp->fields["fie_name"], $campo_operaciones);
									   
									
									  
									 
								  }
							  
							  $result_cmp->MoveNext();
							  }
							  
						  }
						 
						 $lista_op[$isegmento]["ncampo"]=$resultlistat->fields["vardevdet_campo"];
						 $lista_op[$isegmento]["valor"]="(".trim($campo_operaciones).")";
						  $isegmento++;
						 //echo $campo_operaciones."<br>";
						  
				          //echo $resultlistat->fields["vardevdet_campo"];
						
						  
					     // $concatenacampos.=" (".$campo_operaciones.") as ".$resultlistat->fields["vardevdet_campo"]." ".",";  
						  
					  }
					  
					  
					  
					  $ival++;
					  $resultlistat->MoveNext();
					  }
					 } 
	
	
	
	//print_r($lista_op);
	$calculados='';
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		$calculados.=  $lista_op[$iar]["valor"]." as ".$lista_op[$iar]["ncampo"].",";
		
	}
	
	
	
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		
		$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
		
	}
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		
		$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
		
	}
	
	
	

	
	$concatenacampos.=$calculados;
	
	//$text = preg_replace("/\balgo(s)?\b/i", "otra cosa", "esto es algo bonito de algodon");  
	
//echo  $concatenacampos;					 
$reporte_data="select * from rose_variabledeveloper where vardev_id=".$_GET["ireport"];
$resultdata = $DB_gogess->Execute($reporte_data);	
$nreporte=$resultdata->fields["vardev_nombre"];		

$group_by=$resultdata->fields["vardev_group"];	
$restrictions=$resultdata->fields["vardev_restrictions"];

//solotablas
$ival=0;
$list_datax="select distinct vardevdet_tabla from sth_vddetalle where vardev_id=".$_GET["ireport"];

$resultlistatx = $DB_gogess->Execute($list_datax);

if($resultlistatx)
					{  
					  while (!$resultlistatx->EOF) {				  
					 
					 if($resultlistatx->fields["vardevdet_tabla"])
					 {
					  $listatablasx[$ival]=$resultlistatx->fields["vardevdet_tabla"];
					  $ival++;
					 }
					  
					  $resultlistatx->MoveNext();
					  }
					 } 
					 
	//print_r($listatablasx);
	
	$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like",$listatablasx[$i],$DB_gogess);
				
				$campoprimario[$i]["tipo"]= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_tipocampoprimariio"," where tab_name like",$listatablasx[$i],$DB_gogess);
				
				
				
		}
		
		//print_r($campoprimario);
		
		for($z=0;$z<count($listatablasx)-1;$z++)
		{
			
			 // echo $listatablasx[$z];

			 
			  $enlacestabla[$z]=" left join ".$listatablasx[$z+1]." on ".$listatablasx[$z].".".$campoprimario[$z]["primario"]."=".$listatablasx[$z+1].".".$campoprimario[$z]["primario"];
			  
			  
		}
		
		//forma consulta
		$consultaunion=$listatablasx[0];
		for ($sq=0;$sq<count($enlacestabla);$sq++)
		{
			$consultaunion.=$enlacestabla[$sq];
		}
		
		
			
	}
	
	
	
	//obtiene left join
	$listatablasdata="select * from sth_vdenlaces where vardev_id=".$_GET["ireport"];
	
    $resultdatal = $DB_gogess->Execute($listatablasdata);

     if($resultdatal)
					{  
					  while (!$resultdatal->EOF) {				  
					 
					  $resultdatal->fields["vardevenlc_tabla"];
					  $resultdatal->fields["vardevenlc_campoa"];
					  $resultdatal->fields["vardevenlc_campob"];
					  
					  if($resultdatal->fields["vardevenlc_campoa"])
					  {
						  $gruposvla.=" left join ".$resultdatal->fields["vardevenlc_tabla"]." on ".$resultdatal->fields["vardevenlc_campoa"]."=".$resultdatal->fields["vardevenlc_campob"];
					  }
					  else
					  {
						  $gruposvla.=" ".$resultdatal->fields["vardevenlc_tabla"]." ";
						  
					  }
					 
					  
					  $resultdatal->MoveNext();
					  }
					 } 
	
	//obtine left join
	$consultaunion=$gruposvla;
	
?>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="2">
	  <div align="center" class="csstitulo"><?php echo $nreporte ?>
      </div></td>
  </tr>
  <tr>
	
    <td width="82%" valign="top">&nbsp;
	<?php
	//genera join
    
    $concatenacampos=substr($concatenacampos,0,-1);
	if(count($listatablasx)>1)
	{
		//for($i=0;$i<count($listatablasx);$i++)
			//{
	   
			 // $objformulario->form_format_tabla($listatablasx[$i],$DB_gogess);
			 // $separa_data=explode(",",$objformulario->tab_campoprimario);
			 // $separa_tipo=explode(",",$objformulario->tab_tipocampoprimariio);		   

		   //}
		    $sqldata="select TOP 200 ".$concatenacampos." from ".$consultaunion;
	 }
	 else
	 {
	     $sqldata="select TOP 200 ".$concatenacampos." from ".$listatablasx[0];
	 
	 }  
	 
	
  if($restrictions)
  {
   $sqldata= $sqldata." where ".$restrictions;
  }
  
  if($group_by)
  {
	$sqldata=str_replace('|',',',$sqldata)." group by ".$group_by;
	  
  }
  else
  {
	$sqldata=str_replace('|',',',$sqldata);
	//echo $sqldata=$sqldata." limit 2";
  }
	
	
 $sqldata=str_replace("-datestart-",$dateend,$sqldata);
 $sqldata=str_replace("-dateend-",$datestart,$sqldata);
 //echo $sqldata;
	
	$objgridtablareporte->gridtabla($concatenacampos,$sqldata,$sqldata,$link_sqlserver,$DB_gogess);
	
	
	echo "<span class=csslista>N.Registros: ".$objgridtablareporte->totalreg."</span>" ;
	
	?>
	
<table width="100%" cellpadding="3" cellspacing="3" >
      <tr bgcolor="#CCCCCC">
        <?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): ?>
        <td  nowrap="nowrap" bgcolor="#D9EBF2" class="linklista"><?php echo utf8_decode($camponom) ?></td>
        <?php 
	$nd++;
	endforeach; ?>
      </tr>
      <?php 
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?>
      <tr bgcolor="#ffffff"  onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'" >
        <?php 
	 $reclista=1;
	 $kj=0;
	
	 foreach($objgridtablareporte->arrcampos as $camposdata): 
	    
		$campotabla=array();	
		$campotabla=explode(".",$listacamposl[$kj]);
		
		
		if(trim($campotabla[0]))
		{
		
		
	    $objformulario->form_format_field(trim($campotabla[0]),trim($camposdata),$DB_gogess);		
		if(@$_POST["ex1"])
		{
			if(!(trim($objformulario->field_type)=='int'))
			{
			  $comillaexcel="'";
			}
			else
			{
			$comillaexcel="";
			}
		}	
		
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[trim($camposdata)];	
								   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
					
				   		   
				  }			 
			   else
			      {
					 
			        $rmp= @$datoslista[trim($camposdata)];
								 
			      }		
				  
				  
				  
		
		}
		else
		{
			//echo $campotabla[1];
			
			$rmp= @$datoslista[trim($camposdata)];
		}
		
		echo '<td  nowrap class=csslista>'.utf8_decode(@$comillaexcel.$rmp).'</td>'; 	  
	  $kj++;
	  $reclista++;
	  ?>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; 
	}
	?>
    </table>
	
	
	</td>
  </tr>
</table>

<?php

/*SACAR TABLA*/
$saca_tabla="select * from sth_vddetalle where vardevdet_id='".$_POST["pVar1"]."'";
$result_sacatabla = $DB_gogess->Execute($saca_tabla);

/* GENERA SQL PARA GRAFICO */
$ival=0;
$concatenacampos='';
$lista_op=array();

$datestart=date("Y-m-d");
$nuevafecha = strtotime ( '-3 month' , strtotime ( $datestart ) ) ;
$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
$dateend=$nuevafecha;

$gruposvla='';
$sqlconcatena='';
$list_data="select * from sth_vddetalle where vardev_id=".$result_sacatabla->fields["vardev_id"];
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
						  $lista_campos_ing="select * from sth_vddetalle inner join gogess_sisfield on tab_name=vardevdet_tabla and fie_name=vardevdet_campo where vardev_id=".$result_sacatabla->fields["vardev_id"];
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
	
	
$reporte_data="select * from rose_variabledeveloper where vardev_id=".$result_sacatabla->fields["vardev_id"];
$resultdata = $DB_gogess->Execute($reporte_data);	
$nreporte=$resultdata->fields["vardev_nombre"];	

$group_by=$resultdata->fields["vardev_group"];	
$restrictions=$resultdata->fields["vardev_restrictions"];	

//solotablas
$ival=0;
$list_datax="select distinct vardevdet_tabla from sth_vddetalle where vardev_id=".$result_sacatabla->fields["vardev_id"];

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
	$listatablasdata="select * from sth_vdenlaces where vardev_id=".$result_sacatabla->fields["vardev_id"];
	
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
	
$concatenacampos=substr($concatenacampos,0,-1);
	if(count($listatablasx)>1)
	{
		     $sqldata="select top 100 ".$concatenacampos." from ".$consultaunion." ".@$_POST["pVar4"]."";
	 }
	 else
	 {
	     $sqldata="select top 100 ".$concatenacampos." from ".$listatablasx[0]." ".@$_POST["pVar4"]."";
	 
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
// echo $sqldata;
/* GENERA SQL PARA GRAFICO */

$saca_ncampo1="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$_POST["pVar1"]."'";
$result_ncampo1 = $DB_gogess->Execute($saca_ncampo1);

$saca_ncampo2="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$_POST["pVar2"]."'";
$result_ncampo2 = $DB_gogess->Execute($saca_ncampo2);


if($_POST["pVar5"])
{
  $list_campos=explode(",",$_POST["pVar5"]);
  $ig=0;
  for($g_v=0;$g_v<count($list_campos);$g_v++)
  {
	  if(trim($list_campos[$g_v])!='')
	  {
		 $saca_ncampo_grupo="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$list_campos[$g_v]."'";
         $result_ncampo_grupo = $DB_gogess->Execute($saca_ncampo_grupo);
		 $nombre_campo_grupo[$ig]=trim($result_ncampo_grupo->fields["vardevdet_campo"]);	 
		 $ig++;
	  }
	  
  }
  
	
}

$rs_ggrafico=mssql_query($sqldata,$link_sqlserver);


//$rs_ggrafico = $DB_gogess->Execute($sqldata);
$X=0;
$Y=0;
$campo_unoy=array();
if($rs_ggrafico)
{ 
  if($saca_ncampo_grupo)
  {
	  //-----------------
    while ($fields=mssql_fetch_array($rs_ggrafico))
    {
		 
		 $campo_unox[$X]='"'.trim($fields[trim($result_ncampo1->fields["vardevdet_campo"])]).'"';
	     $X++;
		 
		 $concatena_valorgr='';
		 for($filtro_grupo=0;$filtro_grupo<count($nombre_campo_grupo);$filtro_grupo++)
		 {
			$concatena_valorgr=$concatena_valorgr." ".str_replace('"','',trim($fields[trim($nombre_campo_grupo[$filtro_grupo])]));
		//	$grupos_valor[$X]=$grupos_valor[$X]." ".str_replace('"','',trim($fields[trim($nombre_campo_grupo[$filtro_grupo])]));
			 
		 }
		 $grupos_valor[$X]=$concatena_valorgr;
		 //$grupos_valor[$X]=str_replace('"','',trim($fields[trim($result_ncampo_grupo->fields["vardevdet_campo"])]));
		// $campo_unoy[$Y][trim($fields[trim($result_ncampo1->fields["vardevdet_campo"])])][$fields[trim($result_ncampo_grupo->fields["vardevdet_campo"])]]=trim($fields[trim($result_ncampo2->fields["vardevdet_campo"])]);
	     //$Y++;
		
	
	}
	
	$campo_unox=array_values(array_unique($campo_unox));
	$grupos_valor=array_values(array_unique($grupos_valor));
	//print_r($grupos_valor);
	
	for($iv=0;$iv<count($grupos_valor);$iv++)
		{
		
		    $rs_ggrafico=mssql_query($sqldata,$link_sqlserver); 
			while ($fields=mssql_fetch_array($rs_ggrafico))
              {
				  $grupo_data='';
				  $compara_data='';
				  
				  $grupo_data=trim($grupos_valor[$iv]);
				  
				  $concatena_valorgr='';
				  $compara_data='';
				  for($filtro_grupo=0;$filtro_grupo<count($nombre_campo_grupo);$filtro_grupo++)
				  {
				    $concatena_valorgr=$concatena_valorgr." ".$fields[$nombre_campo_grupo[$filtro_grupo]];
				  }
				  $compara_data=$concatena_valorgr;
				  
				  
				 if(trim($grupo_data)==trim(str_replace('"','',$compara_data)))
				  {
					  //echo "compara:".$grupo_data." --- ".str_replace('"','',$compara_data)."<br>";
					   $campo_unoy[trim($grupo_data)][trim($fields[trim($result_ncampo1->fields["vardevdet_campo"])])]=$fields[trim($result_ncampo2->fields["vardevdet_campo"])];
				  }
				  
			  }
			
		}
	
	
	
	
	  //------------------
  }
  else
  {
	  //-------------------
	  
	  while ($fields=mssql_fetch_array($rs_ggrafico))
    {
		 $campo_unox[$X]='"'.trim($fields[trim($result_ncampo1->fields["vardevdet_campo"])]).'"';
	     $X++;
		 
		 $campo_unoy[$Y]=trim($fields[trim($result_ncampo2->fields["vardevdet_campo"])]);
	     $Y++;
		
	
	}
	    $campo_unox=array_values(array_unique($campo_unox));
	  
	  //--------------------
  }
	  
}



//print_r($campo_unox);
//print_r($campo_unoy);

?>


<div id="container" style="width:99%;">
        <canvas id="myChart"></canvas>
</div>
<script>

var randomColorFactor = function() {
            //return Math.round(Math.random() * 255);
			
			 return Math.random() + 0.3;
        };
        var randomColor = function() {
            //return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',.7)';
			return 'rgba(0,128,0,' + randomColorFactor() + ')';
        };

<?php
if($saca_ncampo_grupo)
  {
?>
//datos 
var barChartData = {
            labels: [<?php echo implode(",",$campo_unox); ?>],
		
			datasets: [
			<?php
			for($datasets=0;$datasets<count($grupos_valor);$datasets++)
			{
				$campo_b='';
				$campo_b=str_replace('"','',$grupos_valor[$datasets]);
			?>
			{
				label: '<?php echo trim($campo_b); ?>',
				backgroundColor: randomColor(),
				data: [<?php echo implode(",",$campo_unoy[trim($campo_b)]); ?>],
				borderWidth: 1
			},
			<?php
			}
			?>
			
			]

        };

//datos
<?php
  }
  else
  {
?>
//datos 
var barChartData = {
            labels: [<?php echo implode(",",$campo_unox); ?>],
		
			datasets: [{
				label: '<?php echo $result_ncampo2->fields["vardevdet_campo"]; ?>',
				backgroundColor: randomColor(),
				data: [<?php echo implode(",",$campo_unoy); ?>],
				borderWidth: 1
			}]

        };



//datos
<?php
  }
?>


var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: '<?php echo $_POST["pVar3"]; ?>',
    data: barChartData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
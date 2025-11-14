<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit',-1);
$graph_formula=$_POST["pVar6"];
$y_campo_id=$_POST["pVar2"];
$x_group_id=$_POST["pVar5"];
$saca_ncampo_grupo='';
$nombre_campo_grupo=array();
$suma_valores='';
$fecha_extrena=@$_POST["pVar7"];
$separa_fecha=explode("|",$fecha_extrena);

$fecha_ini=$separa_fecha[0];
$fecha_fin=$separa_fecha[1];
$ndecimales=$separa_fecha[2];

$scale_min=0;
$sacale_max=0;
if(@$separa_fecha[3])
{
$scale_min=$separa_fecha[3];
}
if(@$separa_fecha[4])
{
$sacale_max=$separa_fecha[4];
}
//Genera sql
$obj_graph=new datos_graph($_POST["pVar1"],$DB_gogess,$objformulario,$graph_formula,$y_campo_id,$x_group_id,$fecha_ini,$fecha_fin,$ndecimales);
$sqldata=$obj_graph->generar_sql();
//Genera sql

//general
$campo_x=$obj_graph->obtener_campos_x();
$resultado_y=$obj_graph->obtener_campos_y();
$formula_eny=$resultado_y["formula_y"];
//general

if($x_group_id)
{

	 //con grupo
	 $grupo=$x_group_id;
	 $resultado_grupos=$obj_graph->obtener_data_mysql_grupos($sqldata,$campo_x,$resultado_y["campos_y"]["valor"],$link_mysqlserver,$grupo);
	 $totales_p=array();
     $campo_unox_p=array();
     $campo_unoy_p=array();
     $campo_grupo=array();
	 $campo_unox_p=$resultado_grupos["campo_unox"];
     $campo_unoy_p=$resultado_grupos["campo_unoy"];
     $campo_grupo_lista=$resultado_grupos["campo_grupo"];
	 $totales_p=$obj_graph->obtiene_totales_porgrupo($campo_unox_p,$campo_unoy_p,$resultado_y,$grupo,$campo_grupo_lista);
     $resultado_opg=array();
     $resultado_opg=$obj_graph->opera_entre_variables_grupo($campo_unox_p,$resultado_y,$totales_p,$formula_eny,$campo_grupo_lista);
	 $resultado_op=array();
	 $resultado_op=$resultado_opg;
}
else
{

	//sin grupo
	$resultado_x_y=array();
	$resultado_grupos=array();
    $resultado_x_y=$obj_graph->obtener_data_mysqlserver($sqldata,$campo_x,$resultado_y["campos_y"]["valor"],$link_mysqlserver);
	$resultado_grupos=$resultado_x_y;
	$campo_unox=array();
    $campo_unoy=array();
	$campo_unox_p=array();
    $campo_unox=$resultado_x_y["campo_unox"];
	$campo_unox_p=$campo_unox;
    $campo_unoy=$resultado_x_y["campo_unoy"];
	$totales=array();
    $totales=$obj_graph->obtiene_totales($campo_unox,$campo_unoy,$resultado_y);
    $resultado_op=array();
    $resultado_op=$obj_graph->opera_entre_variables($campo_unox,$resultado_y,$totales,$formula_eny);
	
}


if(!($x_group_id))
{
//
$titulo=explode(",","Temporal,");
$titulo_uno="Temporal";
$temporal_titulox="Region";
$para_table=array();
//print_r($campo_unox_p);
for($itbl=0;$itbl<count($campo_unox_p);$itbl++)
{
	
	$reorre_data=trim(str_replace('"','',$campo_unox_p[$itbl]));
	$resultado_op[$reorre_data];
	@$para_table[$titulo_uno][$reorre_data]=$resultado_op[$reorre_data];
	
}
//print_r($para_table);
//print_r($resultado_op);

?>
<table id="tabla_lot1" class="display responsive no-wrap" cellspacing="0" width="100%">
 <thead>
       <tr>
        <th><?php echo $temporal_titulox; ?></th>
        <?php
		for($ititulos=0;$ititulos<count($titulo);$ititulos++)
		{
			if($titulo[$ititulos])
			{
			echo '<th>'.$titulo[$ititulos].'</th>';
			}
			
		}
		?>
        
       </tr>
 </thead>   
 <tfoot>
             <th><?php echo $temporal_titulox; ?></th>
			<?php
            for($ititulos=0;$ititulos<count($titulo);$ititulos++)
            {
                if($titulo[$ititulos])
                {
                echo '<th>'.$titulo[$ititulos].'</th>';
                }
                
            }
            ?>
        
  </tfoot>
 <tbody>
    <?php
     for($itbl=0;$itbl<count($campo_unox_p);$itbl++)
		{
			$reorre_data=str_replace('"','',$campo_unox_p[$itbl]);
			echo '<tr>';
			echo '<td>'.$reorre_data.'</td>';
			for($ititulos=0;$ititulos<count($titulo);$ititulos++)
				{
					if($titulo[$ititulos])
					{
					$lista_data='';
					@$lista_data='<td>'.@$para_table[$titulo[$ititulos]][$reorre_data].'</td>';
					echo $lista_data;
					}
					
				}
			
			echo '</tr>';
		}
    ?>
</tbody>
</table>

<?php
}
else
{
	
$titulo=explode(",","Temporal,");
$titulo_uno="Temporal";
$temporal_titulox="Region";
$para_table=array();
//print_r($campo_unox_p);
//print_r($campo_grupo_lista);
for($itbl=0;$itbl<count($campo_unox_p);$itbl++)
{
	
	$reorre_data=trim(str_replace('"','',$campo_unox_p[$itbl]));
	$resultado_op[$reorre_data];
	
	for($il=0;$il<count($campo_grupo_lista);$il++)
    {
	@$para_table[$titulo_uno][$reorre_data][$campo_grupo_lista[$il]]=$resultado_op[$reorre_data][$campo_grupo_lista[$il]];
	}
	
}
	
//print_r(@$para_table);	

?>
<table id="tabla_lot1" class="display" cellspacing="0" width="100%">
 <thead>
       <tr>
        <th rowspan="2" bgcolor="#FFFFFF"  ><?php echo $temporal_titulox; ?></th>
        <?php
		$total_c=0;
		$total_c=count($campo_grupo_lista);
		for($ititulos=0;$ititulos<count($titulo);$ititulos++)
		{
			if($titulo[$ititulos])
			{
			echo '<th colspan="'.$total_c.'" >'.$titulo[$ititulos].'</th>';
			}
			
		}
		?>     
       </tr>      
       <tr>     
        <?php
		$lista_data='';
        for($il=0;$il<count($campo_grupo_lista);$il++)
    					{
							if(@$campo_grupo_lista[$il])
							{
                        @$lista_data.='<th>'.@$campo_grupo_lista[$il].'</th>';
							}
                        }
			echo $lista_data;			
			?>			
       </tr>
 </thead>   
  <tfoot><tr>
       <th  bgcolor="#FFFFFF"  ><?php echo $temporal_titulox; ?></th>
        <?php
		$lista_data='';
        for($il=0;$il<count($campo_grupo_lista);$il++)
    					{
							if(@$campo_grupo_lista[$il])
							{
                        @$lista_data.='<th>'.@$campo_grupo_lista[$il].'</th>';
							}
                        }
			echo $lista_data;			
			?>			
       </tr>
  
   </tfoot>
 
 <tbody>
    <?php
     for($itbl=0;$itbl<count($campo_unox_p);$itbl++)
		{
			$reorre_data=str_replace('"','',$campo_unox_p[$itbl]);
			echo '<tr>';
			echo '<td>'.$reorre_data.'</td>';
			for($ititulos=0;$ititulos<count($titulo);$ititulos++)
				{
					if($titulo[$ititulos])
					{
					$lista_data='';
					for($il=0;$il<count($campo_grupo_lista);$il++)
    					{
							//if(@$para_table[$titulo[$ititulos]][$reorre_data][$campo_grupo_lista[$il]])
							//{
					@$lista_data.='<td>'.@$para_table[$titulo[$ititulos]][$reorre_data][$campo_grupo_lista[$il]].'</td>';
					
					   @$suma_valores[$campo_grupo_lista[$il]]=$suma_valores[$campo_grupo_lista[$il]]+@$para_table[$titulo[$ititulos]][$reorre_data][$campo_grupo_lista[$il]];
							
						}
					echo $lista_data;
						}
					
				}
			
			echo '</tr>';
		}
		
		//print_r($suma_valores);
    ?>
</tbody>
</table>

<?php

//print_r($para_table);
	
}
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
if($x_group_id)
  {
  
    $lista_colores=array();
	$cantidad_color=0;
	$cantidad_color=count($campo_grupo_lista);
	$lista_colores=$obj_graph->genera_color($DB_gogess,$cantidad_color);
?>
//datos 
var barChartData = {
            labels: [<?php echo implode(",",$campo_unox_p); ?>],		
			datasets: [
			<?php
			for($gli=0;$gli<count($campo_grupo_lista);$gli++)
				{
	         $concatena_valores='';
				//toma datos para grafico agrupado	
			
			for($datasets=0;$datasets<count($campo_unox_p);$datasets++)
			{
				$campo_xv='';
				$campo_xv=str_replace('"','',$campo_unox_p[$datasets]);
				
				if($resultado_opg[$campo_xv][$campo_grupo_lista[$gli]]==10000000)
				{
					$resultado_opg[$campo_xv][$campo_grupo_lista[$gli]]=0;
				}
				$concatena_valores.=$resultado_opg[$campo_xv][$campo_grupo_lista[$gli]].",";
				
				
			}		
			
				
				$concatena_valores=substr($concatena_valores,0,-1)
				//toma datos para grafico agrupado
				
			?>
			{
				label: '<?php echo trim($campo_grupo_lista[$gli]); ?>',
				backgroundColor: '<?php echo $lista_colores[$gli]; ?>',
				data: [<?php echo $concatena_valores; ?>],
				borderWidth: 1,
				fill:false,
				borderColor:'<?php echo $lista_colores[$gli]; ?>'
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
				label: 'Operacion',
				backgroundColor: randomColor(),
				data: [<?php echo implode(",",$resultado_op); ?>],
				borderWidth: 1
			}]

        };



//datos
<?php
  }
  
  $tag1='';
  $tipo_grp='';
  $tipo_grpmap='';
  
  $despliega_max='';
	if($sacale_max>0)
	{
	   $despliega_max='max: '.$sacale_max.',';
	
	}
  
  if($_POST["pVar3"]=='bar2')
  {
      $tipo_grp='bar';
	  $tipo_grpmap='bar';
	  $tag1=' xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true
                        }]';
	  					
  }
  else
  {
     $tipo_grp=$_POST["pVar3"];
	 $tipo_grpmap=$_POST["pVar3"];
	 $tag1=' xAxes: [{
                            stacked: false,
							ticks: {
								stepSize: 1,
								min: 0,								
								autoSkip: false
							}
                        }],
               yAxes: [{
							ticks: {
								beginAtZero:true,
								'.$despliega_max.'
								min: '.$scale_min.'
							}
                        }]';
  
  }
  
 // echo $tipo_grp;
  if($tipo_grp=='map')
  {
    $tipo_grp='bar';
  }
?>


var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: '<?php echo $tipo_grp; ?>',
    data: barChartData,
    options: {
        scales: {
             <?php echo $tag1; ?>
        }
    }
});


 $('#tabla_lot1').DataTable({
        scrollY:        300,
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true,
		searching: false,
		bFilter: false,
    });
</script>
<?php
if($suma_valores)
{
asort($suma_valores);
}
$valor_percentil=array();

$color_inicial=$obj_graph->fromRGB(0,255,0);
$color_medio=$obj_graph->fromRGB(255,255,0);
$color_final=$obj_graph->fromRGB(255,0,0);

$num_lists=(count($suma_valores)-1);

for($ip=0;$ip<count($suma_valores);$ip++)
{
    $valor_percentil[$ip]=number_format((100*((($ip+1)-0.5)/count($suma_valores))), 2, '.', '');

}

for($ip=0;$ip<count($suma_valores);$ip++)
{

   $m=0;
   $valor_rgb=0;
   if($valor_percentil[$ip]<50)
   {
      $m=number_format( ((255-0)/(50-$valor_percentil[0])),2, '.', '');
	  if($ip==0)
	  {
	  $color_interpreta[$ip]=$color_inicial;
      }
	  else
	  {
	  
	  $valor_rgb=number_format(($m*($valor_percentil[$ip]-$valor_percentil[0])),0, '.', '');
	  
	   $color_interpreta[$ip]= $obj_graph->fromRGB($valor_rgb,255,0);
	  
	  //$color_interpreta[$ip]='rgb('.$valor_rgb.', 255, 0)';
	  }
   }
   else
   {
     if(($valor_percentil[$num_lists]-50))
	 {
     $m=number_format( ((0-255)/($valor_percentil[$num_lists]-50)),2, '.', '');
	 }
	 
	 if($valor_percentil[$ip]==50)
	 {
	    $color_interpreta[$ip]=$color_medio;
	 }
	 else	 
	 {
	     if($ip==(count($suma_valores)-1))
		 {
		 $color_interpreta[$ip]=$color_final;
		 }
		 else
		 {
		 
		 $valor_rgb=number_format( (($m*($valor_percentil[$ip]-50))+255),0, '.', '');
		 
		 $color_interpreta[$ip]=$obj_graph->fromRGB(255,$valor_rgb,0);
		 //$color_interpreta[$ip]='rgb(255, '.$valor_rgb.', 0)';
		 
		 }
	 }
	
   
   }
   
   
}


//print_r($suma_valores);
$color_zone=array();
$iseg=0;
if($suma_valores)
{
foreach($suma_valores as $key => $value)
{
  $mykey = $key;
  $color_zone[$mykey]=$color_interpreta[$iseg];
  $iseg++;
  
}
}

//print_r($color_zone);

if($tipo_grpmap=='map')
{
  echo $obj_graph->generar_map($suma_valores,$color_zone,$DB_gogess);
}
?>
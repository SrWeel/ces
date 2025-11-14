<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('memory_limit',-1);
$graph_formula=$_POST["pVar6"];
$y_campo_id=$_POST["pVar2"];
echo $x_group_id=$_POST["pVar5"];
$saca_ncampo_grupo='';
$nombre_campo_grupo=array();

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
	//echo "holasss";
	 //con grupo
	 $grupo=$x_group_id;
	 $resultado_grupos=$obj_graph->obtener_data_sqlserver_grupos($sqldata,$campo_x,$resultado_y["campos_y"]["valor"],$link_sqlserver,$grupo);
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
    $resultado_x_y=$obj_graph->obtener_data_sqlserver($sqldata,$campo_x,$resultado_y["campos_y"]["valor"],$link_sqlserver);
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
				else
				{
				//echo '<th></th>';
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
<table id="tabla_lot1" class="display responsive no-wrap" cellspacing="0" width="100%">
 <thead>
       <tr>
        <th rowspan="2" ><?php echo $temporal_titulox; ?></th>
        <?php
		$total_c=0;
		$total_c=count($campo_grupo_lista);
		for($ititulos=0;$ititulos<count($titulo);$ititulos++)
		{
			if($titulo[$ititulos])
			{
			echo '<th colspan="'.$total_c.'" >'.$titulo[$ititulos].'</th>';
			}
			else
			{
			
			//echo '<th colspan="'.$total_c.'" ></th>';
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
       <th ><?php echo $temporal_titulox; ?></th>
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
							
						}
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
  
$despliega_max='';
if($sacale_max>0)
{
   $despliega_max='max: '.$sacale_max.',';

}
  
  if($_POST["pVar3"]=='bar2')
  {
      $tipo_grp='bar';
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
?>

var ctx = document.getElementById("myChart").getContext('2d');
				
				var myChart = new Chart(ctx, {
					type: '<?php echo $tipo_grp; ?>',
					data: barChartData,
					options: {
						scales: {
							<?php echo $tag1; ?>
						},
						 title: {
							display: true,
							text: 'Temporal'
						}							
					}
				});



	 $('#tabla_lot1').DataTable({
	
	 dom: 'Bfrtip',
	    responsive: true,
		buttons: [
            {
                extend: 'pdfHtml5',
                customize: function ( doc ) {
                   
                }
            }
        ]
	
	});


</script>
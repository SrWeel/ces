<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../";
include("../../cfgclases/clases.php");
/*SACAR TABLA*/
$saca_tabla="select * from sth_vddetalle where vardevdet_id='".$_POST["pVar1"]."'";
$result_sacatabla = $DB_gogess->Execute($saca_tabla);


/* GENERA SQL PARA GRAFICO */

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
	
	
$reporte_data="select * from rose_variabledeveloper where vardev_id=".$resultlistat->fields["vardev_id"];
$resultdata = $DB_gogess->Execute($reporte_data);	
$nreporte=$resultdata->fields["rept_nombre"];		

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
		     $sqldata="select ".$concatenacampos." from ".$consultaunion." ".@$_POST["pVar4"]." limit 10";
	 }
	 else
	 {
	     $sqldata="select ".$concatenacampos." from ".$listatablasx[0]." ".@$_POST["pVar4"]." limit 10";
	 
	 }  

if($sqlconcatena)
  {
   $sqldata= $sqldata." where ".$sqlconcatena;
  }
  
  
 
/* GENERA SQL PARA GRAFICO */

$saca_ncampo1="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$_POST["pVar1"]."'";
$result_ncampo1 = $DB_gogess->Execute($saca_ncampo1);

$saca_ncampo2="select vardevdet_campo from sth_vddetalle where vardevdet_id='".$_POST["pVar2"]."'";
$result_ncampo2 = $DB_gogess->Execute($saca_ncampo2);



$rs_ggrafico = $DB_gogess->Execute($sqldata);
$X=0;
$Y=0;
if($rs_ggrafico)
{

	while (!$rs_ggrafico->EOF) {	
	
	   
		 $campo_unox[$X]='"'.$rs_ggrafico->fields[$result_ncampo1->fields["vardevdet_campo"]].'"';
	     $X++;
		 
		 $campo_unoy[$Y]=$rs_ggrafico->fields[$result_ncampo2->fields["vardevdet_campo"]];
	     $Y++;
		
	$rs_ggrafico->MoveNext();
	}
}


//print_r($campo_uno);

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


var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: '<?php echo $_POST["pVar3"]; ?>',
    data: {
        labels: [<?php echo implode(",",$campo_unox); ?>],
		
        datasets: [{
            label: '<?php echo $result_ncampo2->fields["vardevdet_campo"]; ?>',
			backgroundColor: randomColor(),
            data: [<?php echo implode(",",$campo_unoy); ?>],
            borderWidth: 1
        }]
    },
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
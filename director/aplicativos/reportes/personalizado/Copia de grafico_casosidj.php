<?php
include("../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../../";
include("../../../cfgclases/clases.php");
require_once '../phplot/phplot.php';

$datos_val=explode("|",base64_decode($_GET["gb"]));


$ingresadom='';
$porcentaje='';
	  $listac_idm="select count(*) as total,tipoing_id,mate_id from media_causasdet inner join media_causascab on media_causasdet.caucab_id=media_causascab.caucab_id where 	year(caudet_fechaingreso)='".trim($datos_val[0])."' and tipoing_id=2 group by tipoing_id,mate_id";
		$rs_rpcalm = $DB_gogess->Execute($listac_idm);
		 if($rs_rpcalm)
		 {
			while (!$rs_rpcalm->EOF) {	
			
			$ingresadom[$rs_rpcalm->fields["mate_id"]][$rs_rpcalm->fields["tipoing_id"]]=$rs_rpcalm->fields["total"];
			$ingresadom[$rs_rpcalm->fields["mate_id"]]["total"]=$ingresadom[$rs_rpcalm->fields["mate_id"]]["total"]+$rs_rpcalm->fields["total"];
			
			$totalvg=$totalvg+ $rs_rpcalm->fields["total"];
			
			$rs_rpcalm->MoveNext();	
			}

		}


$datos_g=array();
$porcentaje_vg=0;
$iv=0;
  $lista_mat="select * from media_materia where mate_activo=1";
  $rs_lmateria = $DB_gogess->Execute($lista_mat);
		 if($rs_lmateria)
		 {
			while (!$rs_lmateria->EOF) {	
			
			
    $porcentaje[$rs_lmateria->fields["mate_id"]]["porcentaje"]=($ingresadom[$rs_lmateria->fields["mate_id"]]["total"]*100)/$totalvg;
	
	$porcentaje_vg=($ingresadom[$rs_lmateria->fields["mate_id"]]["total"]*100)/$totalvg;
	
	
	
	$datos_g[$iv]=array($rs_lmateria->fields["mate_nombre"],number_format($porcentaje_vg, 2, '.', ''));
			$iv++;
			 $rs_lmateria->MoveNext();
			}
		}	



	# Define the data array: Label, the 3 data sets.
# Year,  Features, Bugs, Happy Users:
$data = $datos_g;

//print_r($datos_g);
//print_r($data);


$plot = new PHPlot(650,500);
$plot->SetImageBorderType('plain');

$plot->SetPlotType('pie');
$plot->SetDataType('text-data-single');
$plot->SetDataValues($data);

# Set enough different colors;
$plot->SetDataColors(array('red', 'green', 'blue', 'yellow', 'cyan',
                        'magenta', 'brown', 'lavender', 'pink',
                        'gray', 'orange'));

# Main plot title:
$plot->SetTitle("Derivación Judicial");

# Build a legend from our data array.
# Each call to SetLegend makes one line as "label: value".
foreach ($data as $row)
  $plot->SetLegend(implode(': ', $row));
# Place the legend in the upper left corner:
$plot->SetLegendPixels(3, 24);


$plot->DrawGraph();
	
	}
	?>
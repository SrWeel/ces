<?php
require_once '../phplot/phplot.php';

$datos_val=explode("|",base64_decode($_GET["gb"]));
	# Define the data array: Label, the 3 data sets.
# Year,  Features, Bugs, Happy Users:
$data = array(
  array('No. Casos 
  ingresados 
  por 
  solicitud 
  directa',  $datos_val[1]),
  array('No. de casos 
  ingresados 
  por 
  derivación 
  judicial',  $datos_val[2]),
  array('No. Casos ingresados 
  por 
  remisión de 
  tránsito',  $datos_val[3]),
  array('Total',  $datos_val[4]),
);

$plot = new PHPlot(420,240);
$plot->SetImageBorderType('plain');

//$plot->SetDefaultTTFont('arial.ttf',18);
//$plot->SetFontTTF('x_title', 'arial.ttf', 14);

$plot->SetPlotType('bars');
$plot->SetDataType('text-data');
$plot->SetDataValues($data);

# Let's use a new color for these bars:
//$plot->SetDataColors('magenta');

# Force bottom to Y=0 and set reasonable tick interval:
$plot->SetPlotAreaWorld(NULL, 0);
//$plot->SetYTickIncrement(100);
# Format the Y tick labels as numerics to get thousands separators:
$plot->SetYLabelType('data');
$plot->SetPrecisionY(0);

$plot->SetYDataLabelPos('plotin');
$plot->SetYTickLabelPos('none');
$plot->SetYTickPos('none');
# Main plot title:
$plot->SetTitle($datos_val[0]);
# Y Axis title:
//$plot->SetYTitle('Thousands of Subscribers');

# Turn off X tick labels and ticks because they don't apply here:
$plot->SetXTickLabelPos('none');
$plot->SetXTickPos('none');

$plot->DrawGraph();
	
	?>
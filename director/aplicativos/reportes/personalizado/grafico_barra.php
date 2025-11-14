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

$dats_tomados=base64_decode($_GET["li"]);

$dats_tomados=base64_decode("Mi0xLTB8My0wLTB8MTItMC0wfDE0LTEtMXwxNy0wLTB8MjItMC0wfDI0LTEtMXw=");

$lista_uno=explode("|",$dats_tomados);



$data = array();
$legend = array();

//------------------------------------------------------------
$lista_valor=array();
for($i=0;$i<count($lista_uno);$i++)
{
  
  
  $lista_valor=explode("-",$lista_uno[$i]);
  
  $lista_mat="select * from media_materia where mate_id=".$lista_valor[0];
  $rs_lmateria = $DB_gogess->Execute($lista_mat);
  if($lista_valor[1])
  {
  $datos_g[]=array($rs_lmateria->fields["mate_nombre"],number_format($lista_valor[1], 2, '.', ''),number_format($lista_valor[2], 2, '.', ''));
  
   //$datos_g[]=array('',number_format($lista_valor[1], 2, '.', ''),number_format($lista_valor[2], 2, '.', ''));
	$legend[] =$rs_lmateria->fields["mate_nombre"];
  
  }
  
}

//------------------------------------------------------------


	# Define the data array: Label, the 3 data sets.
# Year,  Features, Bugs, Happy Users:
$data = $datos_g;

//print_r($datos_g);
//print_r($data);






$p = new PHPlot(850,500);
$p->SetImageBorderType('plain');
$p->SetPlotAreaPixels(440, 20,795, 495);
$p->SetLegendPixels(5, 40);
$p->SetLegend(array('% audiencias instaladas/solicitudes recibidas', '% audiencias acuerdos logrados/audiencias instaladas'));
$p->SetTitle("");
$p->SetDataType('text-data-yx');

#  No ticks along Y axis, just bar labels:
$p->SetYTickPos('none');
#  No ticks along X axis:
$p->SetXTickPos('none');
#  No X axis labels. The data values labels are sufficient.
$p->SetXTickLabelPos('none');
$p->SetXDataLabelPos('plotin');
#  No grid lines are needed:
$p->SetDrawXGrid(FALSE);

$p->SetDataValues($data);
$p->SetPlotType('bars');

# Color background so we can see what's what:
//$p->SetDrawPlotAreaBackground(True);
//$p->SetPlotBgColor('gray');

$p->DrawGraph();


	}
	?>
<?php
include("../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

$ireport=$_GET["ireport"];
// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='mp')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}


if(@$mp)
{   
   @$decodevalor = base64_decode($mp);
}
$splitvar=explode("&",@$decodevalor);

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
 // echo $splitvar[$ivari]."<br>";
  $sacadatav=explode("=",$splitvar[$ivari]);
  
  //if (preg_match('/^[a-z\d_=]{1,10}$/i',$sacadatav[1])) {
  
  @$$sacadatav[0]=$sacadatav[1];
  
  //}

}


///Bloque links grandes
/***VARIABLES POR POST ***/
if(isset($_SESSION['sessidadm1777_pichincha']))
{
$director="../../../";
include("../../../cfgclases/clases.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PANEL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link type="text/css" href="../../../css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" />

<script type="text/javascript" src="../../../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../../../js/jquery-ui-1.10.4.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/jquery.corner.js"></script>
<script language="javascript" type="text/javascript" src="../../../js/ui.mask.js"></script>
<script type="text/javascript" src="../../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../../js/jquery.fixheadertable.js"></script>
<script src="../../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>

  <link class="include" rel="stylesheet" type="text/css" href="../js/jquery.jqplot.min.css" />
    <link rel="stylesheet" type="text/css" href="../js/examples.min.css" />
    <link type="text/css" rel="stylesheet" href="../js/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="../js/syntaxhighlighter/styles/shThemejqPlot.min.css" />

<!-- Don't touch this! -->


    <script class="include" type="text/javascript" src="../js/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="../js/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="../js/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="../js/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
<!-- Additional plugins go here -->


<script type="text/javascript" src="../js/plugins/jqplot.logAxisRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.canvasTextRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.canvasAxisLabelRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.canvasAxisTickRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.dateAxisRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="../js/plugins/jqplot.barRenderer.js"></script>

</head>
<?php
$reporte_pg="select * from sth_report where rept_id=".$ireport;
$rs_reportepg = $DB_gogess->Execute($reporte_pg);
 
?>

<SCRIPT LANGUAGE=javascript>
<!--
function ejecuta_busqueda()
{

 $("#ver_panel").load("<?php echo trim($rs_reportepg->fields["rept_archivopersonalizado"]); ?>",{
    anio_valor:$('#anio_valor').val()
  },function(result){  

  });  
  $("#ver_panel").html("Espere un momento...");  

}
//-->
</SCRIPT>
<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><select name="anio_valor" id="anio_valor">
        <option value="0" selected>--seleccionar--</option>
		<?php
							
							 $anio_actual=date("Y");
							 $anio_desde=2015;
							 $cantidad_li=$anio_actual-$anio_desde;
							 
							 for($iv=1;$iv<=$cantidad_li+1;$iv++)
							 {
							    
								echo '<option value="'.$anio_desde.'">'.$anio_desde.'</option>';
								$anio_desde=$anio_desde+1;
							 }
							
		?>
    </select>
    <input type="button" name="Submit" value="Ver" onClick="ejecuta_busqueda()"></td>
  </tr>
</table>
<br>
<div id="ver_panel" align="center" ></div>
</body>
</html>
<?php
}
?>

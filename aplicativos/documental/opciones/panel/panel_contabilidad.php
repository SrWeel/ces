<?php
ini_set('display_errors',0);
ini_set('memory_limit',-1);
error_reporting(E_ALL);
@$tiempossss=55544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include("lib_contable.php");

$obj_contable=new contable_funciones();

?>
<style>

		#calendar {

			font-family:Arial;

			font-size:12px;

		}

		#calendar caption {

			text-align:left;

			padding:5px 10px;

			background-color:#003366;

			color:#fff;

			font-weight:bold;

		}

		#calendar th {

			background-color:#006699;

			color:#fff;

			width:40px;

			border:thin solid #000000;

		}

		#calendar td {

			text-align: right;

            padding: 2px 5px;

            background-color: #eee;

            border: thin solid #1f1f2a;

		}

		#calendar .hoy {

			background-color:red;

		}

.Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

</style>
<?php
$lista_mdulos[1]["nombre"]='Asientos';
$lista_mdulos[1]["tipo"]='1';
$lista_mdulos[1]["archivo"]='';
$lista_mdulos[1]["namemodulo"]='asientos';
$lista_mdulos[1]["mnupan_id"]='177';
$lista_mdulos[1]["camposbuscadore"]='comcont_fecha_x|fecha,comcont_concepto_x|text,comcont_numeroc_x|text,comcont_estado_x|text';

$lista_mdulos[2]["nombre"]='Centro de Costos';
$lista_mdulos[2]["tipo"]='1';
$lista_mdulos[2]["archivo"]='';
$lista_mdulos[2]["namemodulo"]='centrocostos';
$lista_mdulos[2]["mnupan_id"]='178';
$lista_mdulos[2]["camposbuscadore"]='';

$lista_mdulos[3]["nombre"]='Plan de Cuentas';
$lista_mdulos[3]["tipo"]='1';
$lista_mdulos[3]["archivo"]='';
$lista_mdulos[3]["namemodulo"]='plancuentas';
$lista_mdulos[3]["mnupan_id"]='156';
$lista_mdulos[3]["camposbuscadore"]='planc_codigoc_x|text,planc_nombre_x|text';

$lista_mdulos[4]["nombre"]='Periodo Contable';
$lista_mdulos[4]["tipo"]='1';
$lista_mdulos[4]["archivo"]='';
$lista_mdulos[4]["namemodulo"]='periodocontable';
$lista_mdulos[4]["mnupan_id"]='154';
$lista_mdulos[4]["camposbuscadore"]='';

$obj_contable->DB_gogess=$DB_gogess;

?>
<div id="tabs">
  <ul>
   <?php
   for($i=1;$i<=count($lista_mdulos);$i++)
   {
     echo '<li><a href="#tabs-'.$i.'">'.$lista_mdulos[$i]["nombre"].'</a></li>';      
   }
   ?>    
  </ul>
  
  <?php
   for($i=1;$i<=count($lista_mdulos);$i++)
   {
    
		if($lista_mdulos[$i]["tipo"]==1)
		{
			echo '<div id="tabs-'.$i.'" style="font-size:11px">
			<p>';
		    echo $obj_contable->despliegue_form($lista_mdulos[$i]["namemodulo"],$lista_mdulos[$i]["mnupan_id"]);	      
			echo '</p>
			 </div>';   
		}
	
   }
  ?>
</div>

<script type="text/javascript">
<!--

$(function() {
$("#tabs").tabs();
});
  

<?php
for($i=1;$i<=count($lista_mdulos);$i++)
   {
      $obj_contable->camposbusqueda=$lista_mdulos[$i]["camposbuscadore"];
	  echo $obj_contable->despliegue_scripts($lista_mdulos[$i]["mnupan_id"],$lista_mdulos[$i]["namemodulo"]);	
   }

?>

//  End -->
</script>

<div id="grid_borrar"></div>
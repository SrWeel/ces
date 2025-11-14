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
$lista_mdulos[1]["nombre"]='Impuestos Renta';
$lista_mdulos[1]["tipo"]='1';
$lista_mdulos[1]["archivo"]='';
$lista_mdulos[1]["namemodulo"]='impuestost';
$lista_mdulos[1]["mnupan_id"]='159';
$lista_mdulos[1]["camposbuscadore"]='porce_codigo_x|text,porce_nombre_x|text,porce_valor_x|text,porce_cuenta_x|text,porce_cuentacompra_x|text';

$lista_mdulos[2]["nombre"]='Impuestos SRI';
$lista_mdulos[2]["tipo"]='1';
$lista_mdulos[2]["archivo"]='';
$lista_mdulos[2]["namemodulo"]='impuestossri';
$lista_mdulos[2]["mnupan_id"]='166';
$lista_mdulos[2]["camposbuscadore"]='';

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
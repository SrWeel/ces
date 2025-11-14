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
$lista_mdulos[1]["nombre"]='Movimientos Bancos';
$lista_mdulos[1]["tipo"]='1';
$lista_mdulos[1]["archivo"]='';
$lista_mdulos[1]["namemodulo"]='movimientosbancos';
$lista_mdulos[1]["mnupan_id"]='186';
$lista_mdulos[1]["camposbuscadore"]='provee_nombre_x|text,movban_fechaemision_x|fecha,tmv_nombre_x|text,detmov_nombre_x|text,movban_descripcion_x|text';

$lista_mdulos[2]["nombre"]='Anticipos';
$lista_mdulos[2]["tipo"]='1';
$lista_mdulos[2]["archivo"]='';
$lista_mdulos[2]["namemodulo"]='anticiposbancos';
$lista_mdulos[2]["mnupan_id"]='187';
$lista_mdulos[2]["camposbuscadore"]='';

$lista_mdulos[3]["nombre"]='Reposici&oacute;n Caja Chica';
$lista_mdulos[3]["tipo"]='1';
$lista_mdulos[3]["archivo"]='';
$lista_mdulos[3]["namemodulo"]='cajachicabancos';
$lista_mdulos[3]["mnupan_id"]='188';
$lista_mdulos[2]["camposbuscadore"]='';

$lista_mdulos[4]["nombre"]='Conciliacion Bancos';
$lista_mdulos[4]["tipo"]='1';
$lista_mdulos[4]["archivo"]='';
$lista_mdulos[4]["namemodulo"]='conciliacionbancos';
$lista_mdulos[4]["mnupan_id"]='189';
$lista_mdulos[2]["camposbuscadore"]='';

$lista_mdulos[5]["nombre"]='Cheques Protestados';
$lista_mdulos[5]["tipo"]='1';
$lista_mdulos[5]["archivo"]='';
$lista_mdulos[5]["namemodulo"]='chequesprotestados';
$lista_mdulos[5]["mnupan_id"]='190';
$lista_mdulos[2]["camposbuscadore"]='';

//$lista_mdulos[6]["nombre"]='Conciliacion Tarjetas';
//$lista_mdulos[6]["tipo"]='1';
//$lista_mdulos[6]["archivo"]='';
//$lista_mdulos[6]["namemodulo"]='conciliaciontarjetas';
//$lista_mdulos[6]["mnupan_id"]='226';
//$lista_mdulos[6]["camposbuscadore"]='';

$lista_mdulos[6]["nombre"]='Lotes';
$lista_mdulos[6]["tipo"]='1';
$lista_mdulos[6]["archivo"]='';
$lista_mdulos[6]["namemodulo"]='lote';
$lista_mdulos[6]["mnupan_id"]='228';
$lista_mdulos[6]["camposbuscadore"]='';

$lista_mdulos[7]["nombre"]='Liquidaci&oacute;n de Tarjeta de Cr&eacute;dito ';
$lista_mdulos[7]["tipo"]='1';
$lista_mdulos[7]["archivo"]='';
$lista_mdulos[7]["namemodulo"]='liquidaciontarjetas';
$lista_mdulos[7]["mnupan_id"]='227';
$lista_mdulos[7]["camposbuscadore"]='';

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
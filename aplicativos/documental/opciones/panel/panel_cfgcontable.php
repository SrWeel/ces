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

$lista_mdulos[1]["nombre"]='Categor&iacute;a Tarifario';
$lista_mdulos[1]["tipo"]='1';
$lista_mdulos[1]["archivo"]='';
$lista_mdulos[1]["namemodulo"]='categoriat';
$lista_mdulos[1]["mnupan_id"]='157';

//$lista_mdulos[2]["nombre"]='M&oacute;dulos Sistemas';
//$lista_mdulos[2]["tipo"]='1';
//$lista_mdulos[2]["archivo"]='';
//$lista_mdulos[2]["namemodulo"]='standarpestania';
//$lista_mdulos[2]["mnupan_id"]='160';

$lista_mdulos[2]["nombre"]='Tipo Comprobante';
$lista_mdulos[2]["tipo"]='1';
$lista_mdulos[2]["archivo"]='';
$lista_mdulos[2]["namemodulo"]='tipocomprobante';
$lista_mdulos[2]["mnupan_id"]='161';

$lista_mdulos[3]["nombre"]='Entidades Financieras';
$lista_mdulos[3]["tipo"]='1';
$lista_mdulos[3]["archivo"]='';
$lista_mdulos[3]["namemodulo"]='entidafinaciera';
$lista_mdulos[3]["mnupan_id"]='162';

$lista_mdulos[4]["nombre"]='Cuentas Bancarias';
$lista_mdulos[4]["tipo"]='1';
$lista_mdulos[4]["archivo"]='';
$lista_mdulos[4]["namemodulo"]='cuentasbancarias';
$lista_mdulos[4]["mnupan_id"]='163'; 	 	
		
$lista_mdulos[5]["nombre"]='Tipo Comrpobante SRI';
$lista_mdulos[5]["tipo"]='1';
$lista_mdulos[5]["archivo"]='';
$lista_mdulos[5]["namemodulo"]='tipocomprobantesri';
$lista_mdulos[5]["mnupan_id"]='164';

$lista_mdulos[6]["nombre"]='Cajas chica';
$lista_mdulos[6]["tipo"]='1';
$lista_mdulos[6]["archivo"]='';
$lista_mdulos[6]["namemodulo"]='cajachica';
$lista_mdulos[6]["mnupan_id"]='165';	

//$lista_mdulos[8]["nombre"]='Cuentas Enlace';
//$lista_mdulos[8]["tipo"]='1';
//$lista_mdulos[8]["archivo"]='';
//$lista_mdulos[8]["namemodulo"]='cuentaenlace';
//$lista_mdulos[8]["mnupan_id"]='167';

$lista_mdulos[7]["nombre"]='Categor&iacute;a Productos';
$lista_mdulos[7]["tipo"]='1';
$lista_mdulos[7]["archivo"]='';
$lista_mdulos[7]["namemodulo"]='categoriadns';
$lista_mdulos[7]["mnupan_id"]='181';

$lista_mdulos[8]["nombre"]='Categor&iacute;a MGH';
$lista_mdulos[8]["tipo"]='1';
$lista_mdulos[8]["archivo"]='';
$lista_mdulos[8]["namemodulo"]='categoriamgh';
$lista_mdulos[8]["mnupan_id"]='198';

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
      echo $obj_contable->despliegue_scripts($lista_mdulos[$i]["mnupan_id"],$lista_mdulos[$i]["namemodulo"]);	
   }

?>

//  End -->
</script>
<?php
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

$lista_mdulos[2]["nombre"]='Anticipos';
$lista_mdulos[2]["tipo"]='1';
$lista_mdulos[2]["archivo"]='';
$lista_mdulos[2]["namemodulo"]='anticiposbancos';
$lista_mdulos[2]["mnupan_id"]='187';
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
<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);


$director="../../../../";
include ("../../../../cfgclases/clases.php");

$matr_id=$_POST["pVar1"];
//echo $matr_id;

$datos_matricula="select * from kyr_matricula where matr_id=".$matr_id;
$lista_matricula = $DB_gogess->Execute($datos_matricula);


?>

<script language="javascript">
<!--
function listar_notas()
{
  
  $("#lista_notas").load("aplications/usuario/opciones/extras/lista_notas.php",{perclif_id:$('#perclif_id').val(),matr_id:'<?php echo $matr_id ?>'},function(result){  
     
	 
  });  
  
  $("#lista_notas").html("<img src='images/barra_carga.gif' width='220' height='40' />");


}


//-->
</script>
<p>SELECCIONE 

  <select name="perclif_id" id="perclif_id" onClick="listar_notas()">
    <option value="0">--seleccionar--</option>
    <?php
	$lista_qu="select * from kyr_periodocalificacion where peri_id=".$lista_matricula->fields["peri_id"];
	$lista_quimes = $DB_gogess->Execute($lista_qu);
	if($lista_quimes)
	  {
        while (!$lista_quimes->EOF) {
			
			echo '<option value="'.$lista_quimes->fields["perclif_id"].'">'.$lista_quimes->fields["perclif_nombre"].'</option>';
			
			$lista_quimes->MoveNext();
		}
	  }
	?>
  </select>
</p>
<div id=lista_notas ></div>
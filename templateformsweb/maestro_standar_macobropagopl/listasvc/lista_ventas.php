<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$crb_id=$_POST["pVar2"];

$busca_cpd="select * from lpin_masivocobropago where crb_id='".$crb_id."'";
$rs_cpd = $DB_gogess->executec($busca_cpd,array());

$crb_procesado=$rs_cpd->fields["crb_procesado"];

if($crb_procesado==0)
{
?>
<div align="center">
  <input name="busca_venta" type="text" id="busca_venta" />
  <input type="button" name="Submit" value="LISTAR" onClick="lista_ventas()" />
  </div>
  <br><br>

<div id="lista_ventasec"></div>  

<?php
}
else
{

echo '<b><br><br>Registro ya fue procesado...</b>';

}
?>

<script type="text/javascript">
<!--

function lista_ventas()
{
	if($('#busca_venta').val()=='')
	{
	  alert("Porfavor ingrese el dato a buscar");
	  return false;
	}

	  $("#lista_ventasec").load("templateformsweb/maestro_standar_macobropagopl/listasvc/ventas.php",{
        crb_id:'<?php echo $crb_id; ?>',
		busca_venta:$('#busca_venta').val()
	  },function(result){  
	
	
	  });  
	
	  $("#lista_ventasec").html("Espere un momento..."); 

}

//  End -->
</script>


<?php
}
?>

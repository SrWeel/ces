<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$subindice_formulario='div_formulariodet';

$compra_id=$_POST["pVar2"];
$insu_valorx=$_POST["pVar7"];

$busca_categorias=$objformulario->replace_cmb("dns_compras","compra_id,categ_id"," where compra_id=",$compra_id,$DB_gogess);
$insu_valorx=$busca_categorias;

$busca_cierre=$objformulario->replace_cmb("dns_compras","compra_id,compra_procesado"," where compra_id=",$compra_id,$DB_gogess);


?>

<script type="text/javascript">

<!--

function desplegar_formulario(id_ver)
{



$("#<?php echo $subindice_formulario; ?>").load("movimiento_compras/grid_movimiento_nuevo.php",{

    pVar1:id_ver,
	pVar7:'<?php echo $insu_valorx; ?>',
	centro_id:'<?php echo $_POST["pVar6"]; ?>',
	compra_id:'<?php echo $compra_id; ?>'

  },function(result){  



  });  

  $("#<?php echo $subindice_formulario; ?>").html("Espere un momento...");  



}



function desplegar_grid_su()
{

   $("#div_grid").load("movimiento_compras/grid_movimiento.php",{

    insu_valorx:'<?php echo $insu_valorx; ?>',
	centro_id:'<?php echo $_POST["pVar6"]; ?>',
	compra_id:'<?php echo $compra_id; ?>'

  },function(result){  



  });  

  $("#div_grid").html("Espere un momento...");  



}


   


//  End -->

</script>

<style type="text/css">
<!--
table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}
-->
</style>


<div id="grid_borrar"></div>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="#EFF4F5"><div id="div_formulariodet" ></div></td></tr>
    <tr><td valign="top"><div id="div_grid" ></div></td>
  </tr>
</table>



<script type="text/javascript">
<!--

<?php
if($busca_cierre==0)
{
?>
desplegar_formulario(0);
<?php
}
?>

desplegar_grid_su();



//  End -->

</script>
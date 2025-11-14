<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=44450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$egrec_id=$_POST["pVar2"];
?>

<!-- Select2 -->
<link type="text/css" href="public/vendor/select2/select2.min.css" rel="stylesheet">
<link type="text/css" href="public/css/select2.css" rel="stylesheet">

<style type="text/css">
<!--
.btn {
    display: inline-block;
    padding: 6px 6px;
    margin-bottom: 0;
    font-size: 11px;
    font-weight: 400;
	}
	
.form-control {
    display: block;
    width: 100%;
    height: 27px;
    padding: 6px 6px;
    font-size: 12px;
}	
-->
</style>	

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#B8D2E7"><div align="center">MEDICAMENTOS / DISPOSITIVOS </div></td>
  </tr>
  <tr>
    <td>
	  <div align="center">
	    <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="right">Seleccione Medicamento o Dispositivo </div></td>
            <td>
		<div class="form-group">	
		 <select name="cuadrobm_id" id="cuadrobm_id" class="form-control" >
	      <option value="">--seleccionar--</option>
	      <?php
	    $objformulario->fill_cmb("cmb_dns_cuadrobasicomedicamentos","cuadrobm_id,nombre_med",@$cuadrobm_id," order by categ_id asc",$DB_gogess);
	  ?>
         </select>
		 </div>
		 </td>
            <td><input type="button" name="Button" value="Buscar" onClick="busca_producto()" ></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <tr>
    <td><div id="lista_pd">&nbsp;</div></td>
  </tr>
  <tr>
    <td>
	

	  
   </td>
  </tr>
  <tr>
    <td><div id="lista_agregados">&nbsp;</div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="l_agregados">&nbsp;</div></td>
  </tr>
</table>
<div id="procesos_cmp"></div>

<script type="text/javascript">
<!--
function busca_producto()
{
 

   $("#lista_pd").load("egresocentros/lista_productos.php",{
    cuadrobm_id:$('#cuadrobm_id').val(),
	pVar6:'<?php echo $_POST["pVar6"]; ?>'
  },function(result){ 
 
  });  

  $("#lista_pd").html("Espere un momento...");
  


}


function busca_disponibilidad()
{
   var variable_mov;  
   variable_mov=$('input:radio[name=radio_lote]:checked').val()
  
  if($('#cantidad_val').val()=='0')
   {
     alert('Debe ingresar un valor mayor a 0');
	 return false;   
   }
   
   if(variable_mov==undefined)
   {
     alert('Seleccione el Lote a despachar');
	 return false;   
   }
  
  $("#procesos_cmp").load("egresocentros/busca_disponibilidad.php",{
    cuadrobm_id:$('#cuadrobm_id').val(),
	cantidad_val:$('#cantidad_val').val(),
	egrec_id:'<?php echo $egrec_id; ?>',
	moviin_id:$('input:radio[name=radio_lote]:checked').val()
  },function(result){
  
      lista_agregadosproducto();
	 
  });  

  $("#procesos_cmp").html("Espere un momento...");
}

function enviar_atemporal()
{
   var cantidad_p;
   var stocac;
   cantidad_p=parseFloat($('#cantidad_val').val());
   stocac=parseFloat($('#st_actual').val());
   
   if(cantidad_p>stocac)
   {
     alert('No se puede agregar una cantidad mayor al stock actual');
	 return false;   
   }
   
   if($('#cantidad_val').val()=='0')
   {
     alert('Deebe ingresar un valor mayor a 0');
	 return false;   
   }
   
   $("#lista_agregados").load("egresocentros/despacho_temporal.php",{
    cuadrobm_id:$('#cuadrobm_id').val(),
	cantidad_val:$('#cantidad_val').val(),
	egrec_id:'<?php echo $egrec_id; ?>'
  },function(result){
  
  lista_agregadosproducto() 
 
  });  

  $("#lista_agregados").html("Espere un momento...");
  


}


function lista_agregadosproducto()
{
 

   $("#l_agregados").load("egresocentros/lista_despachot.php",{
    egrec_id:'<?php echo $egrec_id; ?>'
  },function(result){ 
 
  });  

  $("#l_agregados").html("Espere un momento...");
  


}
lista_agregadosproducto()

//  End -->
</script>



<!-- Select2 -->
<script src="public/vendor/select2/select2.min.js"></script>
<script src="public/js/select2.js"></script>

<?php
}
?>


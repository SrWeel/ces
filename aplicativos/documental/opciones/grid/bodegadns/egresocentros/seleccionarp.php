<?php
ini_set('display_errors',0);
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

$busca_ecentro="select * from dns_egresocentros where egrec_id='".$egrec_id."'";
$rs_ecentro= $DB_gogess->executec($busca_ecentro);

 
$busca_ncentro="select * from dns_centrosalud where centro_id='".$rs_ecentro->fields["centrod_id"]."'";
$rs_ncentro= $DB_gogess->executec($busca_ncentro);

$centro_redpublica=$rs_ncentro->fields["centro_redpublica"];

$tipo_est='';
if($centro_redpublica==1)
{
  $tipo_est='<span style="color:#3366CC" >RED PUBLICA</span>';
}
?>

<!-- Select2 -->
<link type="text/css" href="public/vendor/select2/select2.min.css" rel="stylesheet">
<link type="text/css" href="public/css/select2.css" rel="stylesheet" >

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
<?php
$compra_nsec='';
$compra_nsec=str_pad($rs_ecentro->fields["egrec_id"], 10, "0", STR_PAD_LEFT);
?>

<center><?php echo "<b>No. Egreso:".$compra_nsec." - ".$rs_ncentro->fields["centro_nombre"]." TIPO: ".$tipo_est."</b>"; ?></center>



<div align="center">
  <input name="fecha_desct" type="text" id="fecha_desct" value="" />
  <input type="button" name="Submit" value="DESCARGADO EN EL DIA" onclick="buscar_listadosc()" />
</div>

<script type="text/javascript">
<!--
function buscar_listadosc() {
window.open('egresocentros/descargado_dia.php?fecha_desct='+$('#fecha_desct').val()+'&centrod_id=<?php echo $rs_ecentro->fields["centrod_id"]; ?>','ventana1l','width=750,height=500,scrollbars=YES');

}
//  End -->
</script>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#B8D2E7"><div align="center">MEDICAMENTOS / DISPOSITIVOS </div></td>
  </tr>
  <tr>
    <td>
	  <div align="center">
	    <table width="90%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><div align="right">Seleccione Medicamento o Dispositivo </div></td>
            <td>
		<div class="form-group">	
		 <select name="cuadrobm_id" id="cuadrobm_id" class="form-control" style="width:400px" >
	      <option value="">--seleccionar--</option>
	      <?php
		  if($centro_redpublica==1)
		  {
		  $busca_yaconredppublica="select cuadrobm_id from dns_redppreciostiempo";
		  $objformulario->fill_cmb("cmb_dns_cuadrobasicomedicamentos","cuadrobm_id,cuadrobm_codigoatc,nombre_med",@$cuadrobm_id," where cuadrobm_id in (select cuadrobm_id from dns_redppreciostiempo) order by nombre_med asc",$DB_gogess);
		  }
		  else
		  {		  
	      $objformulario->fill_cmb("cmb_dns_cuadrobasicomedicamentos","cuadrobm_id,cuadrobm_codigoatc,nombre_med",@$cuadrobm_id," order by nombre_med asc",$DB_gogess);
		  }
	  ?>
         </select>
		 </div>
		 </td>
		 <td>
		 <table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_producto_select()' style='cursor:pointer'><img src='images/searchbu.png' width='20' height='18'></td></tr> </tbody></table>
		 </td>
		 
		 <td>&nbsp;</td>
		 
            <td><input type="button" name="Button" value="Buscar" onClick="busca_producto()" ></td>
			<td>&nbsp;</td>
			
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

<div id="divBody_productox"></div>



<script type="text/javascript">
<!--

function buscar_producto_select()
{
   
abrir_standar("egresocentros/buscar_producto_select.php","Buscar","divBody_productox","divDialog_productox",750,450,0,0,0,0,0,0,0);
	 
}

function busca_contexto_select()
  {
	  $("#lista_bucx").load("egresocentros/lista_bu.php",{
        bu_txtproducto:$('#bu_txtproducto').val(),
		centro_redpublica:'<?php echo $centro_redpublica; ?>'

	  },function(result){  
	
	
	  });  
	
	  $("#lista_bucx").html("Espere un momento...");  
  
  }	


function selecciona_p(valor)
{
  $('#cuadrobm_id').val(valor);
  funcion_cerrar_pop('divDialog_productox');
  busca_producto();
} 
  

function busca_producto()
{
 

   $("#lista_pd").load("egresocentros/lista_productos.php",{
    cuadrobm_id:$('#cuadrobm_id').val(),
	pVar6:'<?php echo $_POST["pVar6"]; ?>',
	egrec_id:'<?php echo $egrec_id; ?>',
	centro_redpublica:'<?php echo $centro_redpublica; ?>'
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
   
   $('#btn_ejecuu').hide();
  
  $("#procesos_cmp").load("egresocentros/busca_disponibilidad.php",{
    cuadrobm_id:$('#cuadrobm_id').val(),
	cantidad_val:$('#cantidad_val').val(),
	egrec_id:'<?php echo $egrec_id; ?>',
	moviin_id:$('input:radio[name=radio_lote]:checked').val()
  },function(result){
  
      lista_agregadosproducto();
	   $('#btn_ejecuu').show();
	 
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
lista_agregadosproducto();

$( "#cuadrobm_id" ).change(function() {
  busca_producto();
});

 $("#fecha_desct").datepicker({dateFormat: 'yy-mm-dd'});

//  End -->
</script>



<!-- Select2 -->
<script src="public/vendor/select2/select2.min.js"></script>
<script src="public/js/select2.js"></script>

<?php
}
?>


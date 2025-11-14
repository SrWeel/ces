<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

//echo $_POST["pVar1"];

?>
<script type="text/javascript">
<!--

function ver_terapista_agt()
{

  $("#lista_terapistaagt").load("aplicativos/documental/opciones/panel/agendar/lista_terapistaagt.php",{
      especi_idagt:$('#especi_idagt').val(),
	  centro_id:'<?php echo $_POST["pVar4"]; ?>'
  },function(result){  



  });  

  $("#lista_terapistaagt").html("Espere un momento...");  

}

function ver_horasd()
{
  
  if($('#especi_idagt').val()=='')
  {
     alert("Ingrese el area...");
     return false;
  
  }
  
  if($('#usua_idagt').val()=='')
  {
     alert("Seleccione el terapeuta...");
     return false;
  
  }
  
  $("#lista_horasd").load("aplicativos/documental/opciones/panel/agendar/lista_horasd.php",{
      fecha_x:'<?php echo $_POST["pVar1"]; ?>',
	  atenc_hc:'<?php echo $_POST["pVar2"]; ?>',
	  especi_idagt:$('#especi_idagt').val(),
	  usua_idagt:$('#usua_idagt').val(),
	  clie_id:'<?php echo $_POST["pVar3"]; ?>',
	  centro_id:'<?php echo $_POST["pVar4"]; ?>'
  },function(result){  



  });  

  $("#lista_horasd").html("Espere un momento...");  

}

function guadar_hora()
{
     
	 if($('input:radio[name=val_hora]:checked').val()==undefined)
	 {
	     alert("Seleccione la hora...");
         return false;
	 
	 }
	
	
   $("#g_horasd").load("aplicativos/documental/opciones/panel/agendar/g_hora.php",{
      fecha_x:'<?php echo $_POST["pVar1"]; ?>',
	  atenc_hc:'<?php echo $_POST["pVar2"]; ?>',
	  especi_idagt:$('#especi_idagt').val(),
	  usua_idagt:$('#usua_idagt').val(),
	  val_hora:$('input:radio[name=val_hora]:checked').val(),
	  clie_id:'<?php echo $_POST["pVar3"]; ?>',
	  centro_id:'<?php echo $_POST["pVar4"]; ?>',
	  usuar_id:'<?php echo $_POST["pVar5"]; ?>'
  },function(result){  

     ver_calendario_general();
     ver_horasd();
  });  

  $("#g_horasd").html("Espere un momento...");  
	



}

//  End -->
</script>


<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>
		  <select class="form-control" name="especi_idagt" id="especi_idagt" onchange="ver_terapista_agt()" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px"  >
<option value="" >--Seleccion Area--</option>
<?php
$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','',' where especi_id not in(5,6) order by especi_nombre asc',$DB_gogess);
?>
</select></td>
          <td><div id="lista_terapistaagt">
		  <select class="form-control" name="usua_idagt" id="usua_idagt"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
<option value="" >--Seleccion Terapista--</option>

</select>
		  
		  </div></td>
          <td><input type="button" name="Submit" value="Aceptar" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" onClick="ver_horasd()" ></td>
        </tr>
       
</table>
<br>
<div id="lista_horasd"></div>
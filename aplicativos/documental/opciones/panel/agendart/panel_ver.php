<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$clie_id=$_POST["pVar1"];
$atenc_hc=$_POST["pVar2"];
$centro_id=$_POST["pVar3"];

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
?>
<script type="text/javascript">
<!--

function ver_calendario_general()
{

    $("#ver_calendario").load("aplicativos/documental/opciones/panel/agendar/cal_ver.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val(),
	areag:$('#areag').val(),
	atenc_hc:'<?php echo $atenc_hc; ?>',
	clie_id:'<?php echo $clie_id; ?>',
	centro_id:'<?php echo $centro_id; ?>',
	usua_idvaltx:$('#usua_idvaltx').val()
  },function(result){  
  

  });  

  $("#ver_calendario").html("Espere un momento...");  

}

//  End -->
</script>
<?php
//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);
$anio_inicial=2018;
$mes_actual=0;
$mes_actual=date("n");
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3">A&ntilde;o:</span></td>
    <td><span class="Estilo3">
      <select name="anio_idg" id="anio_idg" class="form-control" >
        <option value="0" >-seleccionar-</option>
        <?php
	  $anio_actual=date("Y");
	  $numanio=$anio_actual-$anio_inicial;
	  if($numanio==0)
	  {
	       
		  echo '<option value="'.$anio_actual.'" selected="selected" >'.$anio_actual.'</option>';
	  
	  }
	  else
	  {
	      for($i=0;$i<=$numanio;$i++)
		  {
		        if($anio_actual==$anio_actual+$i)
				{
				echo '<option value="'.$anio_actual+$i.'" selected="selected" >'.$anio_actual+$i.'</option>';
				}
				else
				{
				echo '<option value="'.$anio_actual+$i.'">'.$anio_actual+$i.'</option>';
				
				}
			  
		  }
	  
	  }
	  
	  ?>
        </select>
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3">Mes</span></td>
    <td><span class="Estilo3">
      <select name="mes_idg" id="mes_idg" class="form-control" >
	     <option value="0">-seleccionar-</option>
		 <?php
		 for($i=1;$i<=count($meses);$i++)
		  {
		      if($mes_actual==$i)
			  {
			  echo '<option value="'.$i.'" selected="selected" >'.$meses[$i].'</option>';
			  }
			  else
			  {
			  echo '<option value="'.$i.'">'.$meses[$i].'</option>';
			  
			  }
		  }
		 ?>
      </select>
    </span> </td>
	
	<td>&nbsp;</td>
    <td><span class="Estilo3">Area</span></td>
    <td><span class="Estilo3" >
      <select name="areag" id="areag" class="form-control" onchange="ver_terapistacal()" >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','',' where especi_id not in(5,6) order by especi_nombre asc',$DB_gogess);
			?>
      </select>
    </span> </td>
	
    <td>&nbsp;</td>
    <td><div id="lista_terapistacal">
<select class="form-control" name="usua_idvaltx" id="usua_idvaltx"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ></select>
</div></td>
    <td>&nbsp;</td>
    <td>
      <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td onclick="ver_calendario_general()" style=" cursor:pointer"><img src="images/calendario.png" width="50" height="50" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>

<br>
<div id="ver_calendario" ></div>
<br>

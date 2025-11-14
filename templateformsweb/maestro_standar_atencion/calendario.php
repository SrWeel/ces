<?php
$anio_inicial=2018;
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
<script>
function ver_calendario()
{

	

    $("#div_calendario").load("templateformsweb/maestro_standar_atencion/calendario/cal.php",{
    anio_id:$('#anio_id').val(),
	mes_id:$('#mes_id').val()

  },function(result){  

      

  });  

  $("#div_calendario").html("Espere un momento...");  



}

function selecciona_dia(anio,mes,dia)
{
    var fecha_seleccionada;
	//$('#horat_fechax').val(anio+'-'+mes+'-'+dia);
	fecha_seleccionada=anio+'-'+mes+'-'+dia;
	abrir_standar('templateformsweb/maestro_standar_atencion/calendario/horas.php','HORAS','divBody_horas','divDialog_horas',400,400,fecha_seleccionada,0,0,0,0,0,0);

}
</script>
<?php
//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3">A&ntilde;o:</span></td>
    <td><span class="Estilo3">
      <select name="anio_id" id="anio_id">
        <option value="0">-seleccionar-</option>
        <?php
	  $anio_actual=date("Y");
	  $numanio=$anio_actual-$anio_inicial;
	  if($numanio==0)
	  {
	       echo '<option value="'.$anio_actual.'">'.$anio_actual.'</option>';
	  
	  }
	  else
	  {
	      for($i=0;$i<=$numanio;$i++)
		  {
		      echo '<option value="'.$anio_actual+$i.'">'.$anio_actual+$i.'</option>';
			  
		  }
	  
	  }
	  
	  ?>
        </select>
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3">Mes</span></td>
    <td><span class="Estilo3">
      <select name="mes_id" id="mes_id">
	     <option value="0">-seleccionar-</option>
		 <?php
		 for($i=1;$i<=count($meses);$i++)
		  {
		      echo '<option value="'.$i.'">'.$meses[$i].'</option>';
			  
		  }
		 ?>
      </select>
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Ver" onClick="ver_calendario()"></span></td>
  </tr>
</table>
</div>
<p>&nbsp;</p>
<div id="div_calendario"></div>
<div id="divBody_horas"></div>

<script>
ver_calendario();
</script>
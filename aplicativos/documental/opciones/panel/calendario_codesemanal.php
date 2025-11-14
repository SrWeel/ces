<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

 $dia_actualh=date("d");
 $mes_actualh=date("m");
 $anio_actualh=date("Y");


?>
<style>
		#calendar {
			font-family:Arial;
			font-size:10px;
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

.TableScroll_grid {
        z-index:99;
		width:170px;
        height:110px;	
        overflow: auto;
      }
	  
</style>
<script>

function ver_calendario_generalimp()
{
 
  window.open('aplicativos/documental/opciones/panel/calendariosemanal/cal_print.php?anio_idg='+$('#anio_idg').val()+'&mes_idg='+$('#mes_idg').val()+'&semana_idg='+$('#semana_idg').val()+'&areag='+$('#areag').val()+'&usua_idvaltx='+$('#usua_idvaltx').val()+'&semananumero='+$('#semana_idg option:selected').html(),'_blank');


}

function ver_calendario_general()
{

    if($('#anio_idg').val()=='')
	{
	  alert("Por favor seleccione el a\u00f1o");
	  return false;
	
	}

   if($('#mes_idg').val()=='')
	{
	  alert("Por favor seleccione el mes");
	  return false;
	
	}

   if($('#semana_idg').val()=='')
	{
	  alert("Por favor seleccione la semana");
	  return false;
	
	}
	
   if($('#areag').val()=='')
	{
	  alert("Por favor seleccione el area");
	  return false;
	
	}	

   if($('#usua_idvaltx').val()=='')
	{
	  alert("Por favor seleccione el terapista");
	  return false;
	
	}	
	

    $("#cal_general").load("aplicativos/documental/opciones/panel/calendariosemanal/cal.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val(),
	semana_idg:$('#semana_idg').val(),
	areag:$('#areag').val(),
	usua_idvaltx:$('#usua_idvaltx').val()
  },function(result){  
  

  });  

  $("#cal_general").html("Espere un momento...");  

}

function selecciona_dia_general(anio,mes,dia)
{
    
	//$('#horat_fechax').val(anio+'-'+mes+'-'+dia);
	
}
function lista_semana()
{

 $("#lista_semana").load("aplicativos/documental/opciones/panel/calendariosemanal/listasemana.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val()
  },function(result){  
  

  });  

  $("#lista_semana").html("Espere un momento...");  

}

function ver_terapistacal()
{

  $("#lista_terapistacal").load("aplicativos/documental/opciones/panel/agendar/lista_terapista.php",{
      especi_idtx:$('#areag').val(),
	  centro_id:'<?php echo $_SESSION['ces1313777_centro_id'];  ?>'
  },function(result){  



  });  

  $("#lista_terapistacal").html("Espere un momento...");  

}


//ver_calendario_general()
</script>

<p>&nbsp;</p>
 <?php
//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);
$anio_inicial=2018;
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3"><b>A&ntilde;o: </b></span></td>
    <td><span class="Estilo3">
      <select name="anio_idg" id="anio_idg" class="form-control"  >
        <option value="">-seleccionar-</option>
        <?php
	  $anio_actual=date("Y");
	  $numanio=$anio_actual-$anio_inicial;
	  if($numanio==0)
	  {
	       if($anio_actualh==$anio_actual)
		   {
		    echo '<option value="'.$anio_actual.'" selected="selected" >'.$anio_actual.'</option>';
		   }
		   else
		   {
		    echo '<option value="'.$anio_actual.'">'.$anio_actual.'</option>';
	       }
	  }
	  else
	  {
	      for($i=0;$i<=$numanio;$i++)
		  {
		      
			  if($anio_actualh==$anio_actual+$i)
		      {
			  echo '<option value="'.$anio_actual+$i.'"  selected="selected"  >'.$anio_actual+$i.'</option>';
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
    <td><span class="Estilo3"><b>Mes: </b></span></td>
    <td><span class="Estilo3">
      <select name="mes_idg" id="mes_idg" class="form-control" onchange="lista_semana()"  >
	     <option value="">-seleccionar-</option>
		 <?php
		 for($i=1;$i<=count($meses);$i++)
		  {
		      if($mes_actualh==$i)
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
	<td><span class="Estilo3"><b>Semana: </b></span></td>
	<td><span class="Estilo3">
	<div id="lista_semana" >
	 <select name="semana_idg" id="semana_idg" class="form-control"  >
	 </select>
	 </div>
	</span></td>
	
	<td>&nbsp;</td>
    <td><span class="Estilo3"><b>Area: </b></span></td>
    <td><span class="Estilo3">
      <select name="areag" id="areag" class="form-control" onchange="ver_terapistacal()"  >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','','  where especi_id not in(5,6)  order by especi_nombre asc',$DB_gogess);
			?>
      </select>
    </span> </td>
	<td>&nbsp;</td>
	<td><span class="Estilo3"><b>Terapista: </b></span></td>
	 <td><span class="Estilo3">
	 <div id="lista_terapistacal">
	 <select class="form-control" name="usua_idvaltx" id="usua_idvaltx"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
	 
	 </select>
	 </div>
	 </span></td>
	
	
    <td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Ver" onClick="ver_calendario_general()" class="form-control"  ></span></td>
	
	<td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Imprimir" onClick="ver_calendario_generalimp()" class="form-control"  ></span></td>
	
  </tr>
</table>
</div>
<div id="cal_general" ></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<script>
lista_semana();
</script>
<?php
}
else
{

 echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; ">Tu sesi&oacute;n ha expirado, ingrese su usuario y clave y vuelva a seleccionar la opci&oacute;n</div>';
//enviar
//$varable_enviafunc=base64_encode("desplegar_grid_atencion();");
$varable_enviafunc='';
//enviar
echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,"'.$varable_enviafunc.'",0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';

 
}	

?>
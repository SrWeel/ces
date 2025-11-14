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
function ver_calendario_general()
{

    $("#cal_general").load("aplicativos/documental/opciones/panel/calendario/cal.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val(),
	areag:$('#areag').val()
  },function(result){  
  

  });  

  $("#cal_general").html("Espere un momento...");  

}

function selecciona_dia_general(anio,mes,dia)
{
    
	//$('#horat_fechax').val(anio+'-'+mes+'-'+dia);
	
}
ver_calendario_general()
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
    <td><span class="Estilo3">A&ntilde;o:</span></td>
    <td><span class="Estilo3">
      <select name="anio_idg" id="anio_idg">
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
      <select name="mes_idg" id="mes_idg">
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
    <td><span class="Estilo3">Area</span></td>
    <td><span class="Estilo3">
      <select name="areag" id="areag">
	     <option value="0">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','',' order by especi_nombre asc',$DB_gogess);
			?>
      </select>
    </span> </td>
	
    <td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Ver" onClick="ver_calendario_general()"></span></td>
  </tr>
</table>
ddd</div>
<div id="cal_general" ></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center">Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
}	

?>
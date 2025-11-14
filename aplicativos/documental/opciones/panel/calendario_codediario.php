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
	  
.TableScroll_tabla {
        z-index:99;
		width:100%;
        height:850px;	
        overflow: auto;
      }	  
	  
</style>
<script>

function ver_calendario_generalimp()
{
 
  window.open('aplicativos/documental/opciones/panel/calendariodiario/cal_print.php?fecha_valor='+$('#fecha_valor').val(),'_blank');


}

function ver_calendario_generalimptarde()
{
 
  window.open('aplicativos/documental/opciones/panel/calendariodiario/caltarde_print.php?fecha_valor='+$('#fecha_valor').val(),'_blank');


}

function ver_calendario_general()
{

   if($('#fecha_valor').val()=='')
	{
	  alert("Por favor ingrese la fecha");
	  return false;
	
	}

    $("#cal_general").load("aplicativos/documental/opciones/panel/calendariodiario/cal.php",{
    fecha_valor:$('#fecha_valor').val()
  },function(result){  
  

  });  

  $("#cal_general").html("Espere un momento...");  

}


function ver_calendario_generaltarde()
{

   if($('#fecha_valor').val()=='')
	{
	  alert("Por favor ingrese la fecha");
	  return false;
	
	}

    $("#cal_general").load("aplicativos/documental/opciones/panel/calendariodiario/caltarde.php",{
    fecha_valor:$('#fecha_valor').val()
  },function(result){  
  

  });  

  $("#cal_general").html("Espere un momento...");  

}


//ver_calendario_general()
</script>

<p>&nbsp;</p>
 <?php
//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);
$anio_actual='';
$anio_inicial=2018;
 $anio_actual=date("Y");
 $numanio=$anio_actual-$anio_inicial;
 $suma_n=$anio_inicial;
 
 $fecha_hoy=date("Y-m-d");
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="Estilo3"><b>Fecha: </b></span></td>
    <td><span class="Estilo3">      
      <input name="fecha_valor" type="text" id="fecha_valor" value="<?php echo $fecha_hoy; ?>" class="form-control"  />
    </span></td>

   <td>&nbsp;</td>
    <td><span class="Estilo3"><input type="button" name="Submit" value="Ver Horario" onClick="ver_calendario_generaltarde()" class="form-control"  ></span></td>
	
	<td>&nbsp;</td>
  <!--  <td><span class="Estilo3"><input type="button" name="Submit" value="Imprimir Horario" onClick="ver_calendario_generalimptarde()" class="form-control"  ></span></td> -->
  </tr>
</table>
<br />
</div>
<div id="cal_general" class="TableScroll_tabla" ></div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<script>

<?php
if(@$_POST["pVar7"]==1)
{
  echo 'ver_calendario_generaltarde();';
  
}

if(@$_POST["pVar7"]==2)
{
  echo 'ver_calendario_general();';

}

?>

//lista_semana();
$( "#fecha_valor" ).datepicker({dateFormat: 'yy-mm-dd'});
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
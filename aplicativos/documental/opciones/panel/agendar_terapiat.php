<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44450000;
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
$obj_util=new util_funciones();

//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);

$dia_idgarray[0]='01';
$dia_idgarray[1]='02';
$dia_idgarray[2]='03';
$dia_idgarray[3]='04';
$dia_idgarray[4]='05';
$dia_idgarray[5]='06';
$dia_idgarray[6]='07';
$dia_idgarray[7]='08';
$dia_idgarray[8]='09';
$dia_idgarray[9]='10';
$dia_idgarray[10]='11';
$dia_idgarray[11]='12';
$dia_idgarray[12]='13';
$dia_idgarray[13]='14';
$dia_idgarray[14]='15';
$dia_idgarray[15]='16';
$dia_idgarray[16]='17';
$dia_idgarray[17]='18';
$dia_idgarray[18]='19';
$dia_idgarray[19]='20';
$dia_idgarray[20]='21';
$dia_idgarray[21]='22';
$dia_idgarray[22]='23';
$dia_idgarray[23]='24';
$dia_idgarray[24]='25';
$dia_idgarray[25]='26';
$dia_idgarray[26]='27';
$dia_idgarray[27]='28';
$dia_idgarray[28]='29';
$dia_idgarray[29]='30';
$dia_idgarray[30]='31';

$dia_actual='';
$dia_actual=date("d");

$mes_actual=0;
$mes_actual=date("n");

$anio_actual='';
$anio_inicial=2018;
$anio_actual=date("Y");
$numanio=$anio_actual-$anio_inicial;
$suma_n=$anio_inicial;
$anio_actualh=date("Y");

$arreglo_horas=array();
$arreglo_horas=$obj_util->genera_arrayhora($hora_ini,$rango_hora,$hora_fin);
?>

<div align="center">
<br /><br />
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3">     
      <input name="anio_idg" type="hidden" id="anio_idg" value="<?php echo $anio_actualh; ?>" />
    </span> </td>
    <td>&nbsp;</td>
    <td><span class="Estilo3"></span></td>
    <td><span class="Estilo3">
	   <input name="mes_idg" type="hidden" id="mes_idg" value="<?php echo $mes_actual; ?>" />
    </span> </td>
	
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td></td>
	<td>
	<input name="dia_idgval" type="hidden" id="dia_idgval" value="<?php echo $dia_actual; ?>" />
	</td>
	<td>&nbsp;</td>
    <td></td>
    <td>
	<input name="clie_idval" type="hidden" id="clie_idval" value="" />
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td>
	<input name="usua_idfiltro" type="hidden" id="usua_idfiltro" value="" />
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <!-- <td onclick="generar_semanal()" ><span style=" cursor:pointer"><img src="images/procesar.png" width="50" height="50" /></span></td> -->
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div id="g_semanal" style="width:150px"></div></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Agendar</td>
    <td>&nbsp;</td>
    <td onclick="ver_diacal('t')" style=" cursor:pointer" ><img src="images/calendario.png" width="50" height="50" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
<div id="divBody_agenda" ></div>
<div id="ver_calendario"></div>
<script type="text/javascript">
<!--

function generar_semanal()
{
  $("#g_semanal").load("aplicativos/documental/opciones/panel/agendart/g_semanal.php",{

  },function(result){  
    ver_calendario();
  });  

  $("#g_semanal").html("Espere un momento..."); 

}

function ver_calendario()
{

  $("#ver_calendario").load("aplicativos/documental/opciones/panel/agendart/cal.php",{
      anio_idg:$('#anio_idg').val(),
	  mes_idg:$('#mes_idg').val(),
	  clie_idval:$('#clie_idval').val(),
	  dia_idgval:$('#dia_idgval').val(),
	  usua_idfiltro:$('#usua_idfiltro').val()
  },function(result){  

  });  

  $("#ver_calendario").html("Espere un momento..."); 

}

function btn_agendar()
{
abrir_standar('aplicativos/documental/opciones/panel/agendart/pantalla_agenda.php','AGENDAMIENTO','divBody_agenda','divDialog_agenda',900,600,0,0,0,0,0,0,0);
}

function ver_diacal(horario)
{


      window.open('aplicativos/documental/opciones/panel/calendariodiario/panel_agendar.php?horario='+horario+'&fecha_valor='+$('#anio_idg').val()+'-'+$('#mes_idg').val()+'-'+$('#dia_idgval').val(),'_blank');

}


//  End -->
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
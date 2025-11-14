<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44540000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{
$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$obj_util=new util_funciones();

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

//echo $_POST["pVar1"];
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
//print_r($meses);

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

<style type="text/css">
<!--
.css_txt5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_general {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

.TableScrolltr {
        z-index:99;
		width:100%;
        height:140px;	
        overflow: auto;
      }
-->
</style>
<div class="css_general" >
<center>
<input name="busca_paciente" type="hidden" id="busca_paciente" value="" />
<!-- <input type="button" name="Submit" value="Buscar" onclick="busca_paciente()" />  -->

<div id="listap"></div>

<table width="700" border="1" align="center">
  <tr>
    <td colspan="2" bgcolor="#D7E6F4" class="css_txt5"><div align="center">No. Reuniones </div></td>
  </tr>
  <tr>
    <td colspan="2" class="css_txt5"><div align="center">
      <input name="fecha_hoyval" type="hidden" id="fecha_hoyval" value="<?php echo date("Y-m-d"); ?>" />
      <input name="n_terapiasval" type="text" id="n_terapiasval" size="5" value="1" />
    </div>
        <div id="lista_user"> </div></td>
  </tr>
  <tr>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Profesional</div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Fecha Inicia/Fecha reuni&oacute;n: </div>
        <div align="center"></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="usua_idvalx" id="usua_idvalx" style="width:200px">
        <option value="">--Seleccion Terapista--</option>
        <?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' order by usua_nombre asc',$DB_gogess);
?>
      </select>
    </div></td>
    <td><div align="center">
      <input name="fecha_inicioval" type="text" id="fecha_inicioval" autocomplete="off"  >
      <input name="hora_val" type="hidden" id="hora_val" value="" />
      <input name="n_autorizacionval" type="hidden" id="n_autorizacionval" />
    </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"><br />
      <b>Motivo:</b>
      <input name="terap_motivoval" type="text" id="terap_motivoval" size="50" /><br><br>
    </div>
    <table width="90%" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">L</div></td>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">M</div></td>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">Mi</div></td>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">J</div></td>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">V</div></td>
        <td bgcolor="#D8E4ED" class="css_txt5"><div align="center">S</div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input name="checkbox_lunes" type="checkbox" id="checkbox_lunes" value="checkbox" />
        </div></td>
        <td bgcolor="#EBEBEB"><div align="center">
          <input name="checkbox_martes" type="checkbox" id="checkbox_martes" value="checkbox" />
        </div></td>
        <td><div align="center">
          <input name="checkbox_miercoles" type="checkbox" id="checkbox_miercoles" value="checkbox" />
        </div></td>
        <td bgcolor="#DDE3EA"><div align="center">
          <input name="checkbox_jueves" type="checkbox" id="checkbox_jueves" value="checkbox" />
        </div></td>
        <td><div align="center">
          <input name="checkbox_viernes" type="checkbox" id="checkbox_viernes" value="checkbox" />
        </div></td>
        <td bgcolor="#E8F1F7"><div align="center">
          <input name="checkbox_sabado" type="checkbox" id="checkbox_sabado" value="checkbox" />
        </div></td>
      </tr>
      <tr>
        <td><div align="center">
          <select name="hora_lunes" id="hora_lunes" style="font-size:10px" >
            <option value="">-hora-</option>
            <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
          </select>
        </div></td>
        <td bgcolor="#EBEBEB"><select name="hora_martes" id="hora_martes" style="font-size:10px" >
          <option value="">-hora-</option>
          <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
        </select></td>
        <td><select name="hora_miercoles" id="hora_miercoles" style="font-size:10px" >
          <option value="">-hora-</option>
          <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
        </select></td>
        <td bgcolor="#DDE3EA"><select name="hora_jueves" id="hora_jueves" style="font-size:10px" >
          <option value="">-hora-</option>
          <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
        </select></td>
        <td><select name="hora_viernes" id="hora_viernes" style="font-size:10px" >
          <option value="">-hora-</option>
          <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
        </select></td>
        <td bgcolor="#E8F1F7"><select name="hora_sabado" id="hora_sabado" style="font-size:10px">
          <option value="">-hora-</option>
          <?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		}
		?>
        </select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><div align="center">
            <input type="button" name="Submit2" value="Generar" onclick="generar_registros()" />
          </div></td>
          <td>&nbsp;</td>
          <td><div align="center">
          <!-- <input type="button" name="Submit2" value="Orden " onclick="abrir_orden()" />  -->
          </div></td>
        </tr>
      </table>
      <!--  <input type="button" name="Submit" value="Generar" onClick="ver_id()">   -->
    </div></td>
  </tr>
</table>
</center>

</div>
<div id="genera_registros"></div>
<script type="text/javascript">
<!--

 $("#fecha_inicioval").datepicker({dateFormat: 'yy-mm-dd'});
 
 
function generar_registros()
{

   var opcion_seleccion;

   opcion_seleccion=0;

   var hoy=new Date($('#fecha_hoyval').val());
   var seleccionado=new Date($('#fecha_inicioval').val());

  if($('#n_terapiasval').val()=='')
  {
    alert("Ingrese la la cantidad de reuniones...");
    return false;
  }
  
  if($('#terap_motivoval').val()=='')
  {
    alert("Ingrese el motivo de la reunion...");
    return false;
  }
  
  
  
  if($('#usua_idvalx').val()=='')
  {
    alert("Ingrese el terapista...");
    return false;
  
  }  

  if($('#checkbox_lunes').prop('checked')==true || $('#checkbox_martes').prop('checked')==true || $('#checkbox_miercoles').prop('checked')==true || $('#checkbox_jueves').prop('checked')==true || $('#checkbox_viernes').prop('checked')==true  || $('#checkbox_sabado').prop('checked')==true )
	 {

		opcion_seleccion=1;

	 }



   if($('#checkbox_lunes').prop('checked')==true)
   {

	  if($('#hora_lunes').val()=='')
	  {
	    alert("Seleccione la Hora Lunes");
	    return false;
	  }
   
   }

   if($('#checkbox_martes').prop('checked')==true)
   {
      if($('#hora_martes').val()=='')
	  {
	    alert("Seleccione la Hora Martes");
	    return false;
	  }
   
   }

   if($('#checkbox_miercoles').prop('checked')==true)
   {
      if($('#hora_miercoles').val()=='')
	  {
	    alert("Seleccione la Hora Miercoles");
	    return false;
	  }
   
   }
   
   if($('#checkbox_jueves').prop('checked')==true)
   {
      if($('#hora_jueves').val()=='')
	  {
	    alert("Seleccione la Hora Jueves");
	    return false;
	  }
   
   }
   
   if($('#checkbox_viernes').prop('checked')==true)
   {
      if($('#hora_viernes').val()=='')
	  {
	    alert("Seleccione la Hora Viernes");
	    return false;
	  }
   
   }
   
   if($('#checkbox_sabado').prop('checked')==true)
   {
      if($('#hora_sabado').val()=='')
	  {
	    alert("Seleccione la Hora Sabado");
	    return false;
	  }
   
   }


	if(opcion_seleccion==0)
	{

	   alert("Favor Ingresar al menos un dia para la terapia");
	  return false;

	} 

  

  if($('#fecha_inicioval').val()=='')
  {

  alert("Ingrese la fecha de inicio...");
  return false;

  }  

  if($('#hora_val').val()=='')
  {
  //alert("Ingrese la fecha de inicio...");
  //return false;
  }

  
  

  $("#genera_registros").load("genera_registrosotros.php",{

     atenc_hc:'',
	 clie_id:'',
	 n_terapiasval:$('#n_terapiasval').val(),
	 checkbox_lunes:$('#checkbox_lunes').prop('checked'),
	 checkbox_martes:$('#checkbox_martes').prop('checked'),
	 checkbox_miercoles:$('#checkbox_miercoles').prop('checked'),
	 checkbox_jueves:$('#checkbox_jueves').prop('checked'),
	 checkbox_viernes:$('#checkbox_viernes').prop('checked'),
	 checkbox_sabado:$('#checkbox_sabado').prop('checked'),
	 hora_lunes:$('#hora_lunes').val(),
	 hora_martes:$('#hora_martes').val(),
	 hora_miercoles:$('#hora_miercoles').val(),
	 hora_jueves:$('#hora_jueves').val(),
	 hora_viernes:$('#hora_viernes').val(),
	 hora_sabado:$('#hora_sabado').val(),
	 fecha_inicioval:$('#fecha_inicioval').val(),
	 hora_val:$('#hora_val').val(),
	 n_autorizacionval:$('#n_autorizacionval').val(),
	 usua_idvalx:$('#usua_idvalx').val(),
	 terap_motivoval:$('#terap_motivoval').val(),
	 centro_id:'<?php echo $_SESSION['ces1313777_centro_id'];  ?>',
	 usuar_id:'<?php echo$_SESSION['ces1313777_sessid_inicio'];  ?>'

	 

  },function(result){  

      $('#n_terapiasval').val('');
      $('#fecha_inicioval').val('');
	  $('#hora_val').val(0);
	  $('#especig_idx').val('');
	  $('#usua_idvalx').val('');	  
	 
	  ver_diario();

  });  

  $("#genera_registros").html("Espere un momento...");  

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


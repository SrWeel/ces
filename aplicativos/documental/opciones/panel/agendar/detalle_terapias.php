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

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
//$objformulario->sisfield_arr=$gogess_sisfield;
//$objformulario->sistable_arr=$gogess_sistable;


$busca_cantidadt="select psic_nterapias,pedago_nterapias,lenguaj_nterapias,terfisic_nterapias from dns_atencion 
left join faesa_psicologia on dns_atencion.atenc_id=faesa_psicologia.atenc_id 
left join faesa_pedagogia on dns_atencion.atenc_id=faesa_pedagogia.atenc_id
left join faesa_lenguaje on dns_atencion.atenc_id=faesa_lenguaje.atenc_id
left join faesa_terapiafisica on dns_atencion.atenc_id=faesa_terapiafisica.atenc_id
where atenc_hc='".$_POST["atenc_hc"]."' limit 1";

$rs_cantidadt = $DB_gogess->executec($busca_cantidadt,array());



$total_terapiassug=$rs_cantidadt->fields["psic_nterapias"]+$rs_cantidadt->fields["pedago_nterapias"]+$rs_cantidadt->fields["lenguaj_nterapias"]+$rs_cantidadt->fields["terfisic_nterapias"];


$psicologia=$rs_cantidadt->fields["psic_nterapias"]*1;
$pedagogia=$rs_cantidadt->fields["pedago_nterapias"]*1;
$lenguaje=$rs_cantidadt->fields["lenguaj_nterapias"]*1;
$fisica=$rs_cantidadt->fields["terfisic_nterapias"]*1;

?>

<style type="text/css">
<!--

.Estilo5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }

.TableScroll_lista {
        z-index:99;
		width:100%;
        height:150px;	
        overflow: auto;
      }

-->
</style>



<script type="text/javascript">
<!--
function borrar_registro(tabla,campo,valor)
{


	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 


	 $("#grid_borrar").load("aplicativos/documental/opciones/panel/agendar/borrar.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

     

	   ver_detalleterapias();

  });  

  $("#grid_borrar").html("Espere un momento...");  

  

  

  }



}



function generar_registros()

{

   var opcion_seleccion;

   opcion_seleccion=0;

   var hoy=new Date($('#fecha_hoyval').val());
   var seleccionado=new Date($('#fecha_inicioval').val());
   
   //if(!(seleccionado>=hoy))
   //{
	// alert("Por favor la fecha inicial debe ser mayor o igual a la fecha actual...");
	 //return false;
   //}
  

  if($('#n_terapiasval').val()=='')
  {

  alert("Ingrese la la cantidad de terapias...");
  return false;

  }
  
  if($('#n_terapiasval').val()=='')
  {
    alert("Ingrese el area...");

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



  alert("Ingrese la fecha de inicio...");

  return false;



  }

  
   

  

  $("#genera_registros").load("aplicativos/documental/opciones/panel/agendar/genera_registros.php",{

     atenc_hc:'<?php echo $_POST["atenc_hc"]; ?>',
	 clie_id:'<?php echo $_POST["clie_id"]; ?>',
	 n_terapiasval:$('#n_terapiasval').val(),
	 checkbox_lunes:$('#checkbox_lunes').prop('checked'),
	 checkbox_martes:$('#checkbox_martes').prop('checked'),
	 checkbox_miercoles:$('#checkbox_miercoles').prop('checked'),
	 checkbox_jueves:$('#checkbox_jueves').prop('checked'),
	 checkbox_viernes:$('#checkbox_viernes').prop('checked'),
	 checkbox_sabado:$('#checkbox_sabado').prop('checked'),
	 fecha_inicioval:$('#fecha_inicioval').val(),
	 hora_val:$('#hora_val').val(),
	 n_autorizacionval:$('#n_autorizacionval').val(),
	 especi_idx:$('#especig_idx').val(),
	 usua_idvalx:$('#usua_idvalx').val(),
	 centro_id:'<?php echo $_POST["centro_id"];  ?>',
	 usuar_id:'<?php echo$_SESSION['ces1313777_sessid_inicio'];  ?>'

	 

  },function(result){  

      $('#n_terapiasval').val('');
      $('#fecha_inicioval').val('');
	  $('#hora_val').val(0);
	  $('#especig_idx').val('');
	  
	 
	  ver_calendario_general();

  });  

  $("#genera_registros").html("Espere un momento...");  

   

    

   



}


function ver_user()
{

  $("#lista_user").load("aplicativos/documental/opciones/panel/agendar/lista_user.php",{
      especi_idx:$('#especig_idx').val(),
	  centro_id:'<?php echo $_POST["centro_id"];  ?>'
  },function(result){  



  });  

  $("#lista_user").html("Espere un momento...");  

}


function ver_calendario()
{

  $("#ver_calendario").load("aplicativos/documental/opciones/panel/agendar/cal.php",{
     
  },function(result){  

  });  

  $("#ver_calendario").html("Espere un momento..."); 

}

function ver_calendario_general()
{

    $("#ver_calendario").load("aplicativos/documental/opciones/panel/agendar/cal.php",{
    anio_idg:$('#anio_idg').val(),
	mes_idg:$('#mes_idg').val(),
	areag:$('#areag').val(),
	atenc_hc:'<?php echo $_POST["atenc_hc"]; ?>',
	clie_id:'<?php echo $_POST["clie_id"]; ?>',
	centro_id:'<?php echo $_POST["centro_id"]; ?>',
	usua_idvaltx:$('#usua_idvaltx').val()
  },function(result){  
  

  });  

  $("#ver_calendario").html("Espere un momento...");  

}


//borra terapia en calendario
function borrar_terapia(tabla,campo,valor)
{

 if (confirm("Esta seguro que desea borrar terapia?"))
	 { 


	 $("#grid_borrart").load("aplicativos/documental/opciones/panel/agendar/borrart.php",{

     ptabla:tabla,

	 pcampo:campo,

	 pvalor:valor

  },function(result){  

     
    ver_calendario_general();
	 //  ver_detalleterapias();

  });  

  $("#grid_borrart").html("Espere un momento...");  



  }



}


function ver_terapistacal()
{

  $("#lista_terapistacal").load("aplicativos/documental/opciones/panel/agendar/lista_terapista.php",{
      especi_idtx:$('#areag').val(),
	  centro_id:'<?php echo $_POST["centro_id"];  ?>'
  },function(result){  



  });  

  $("#lista_terapistacal").html("Espere un momento...");  

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
    <td>
	
	<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="149" bgcolor="#E0E6ED"><span class="Estilo5">SUGERIDAS</span></td>
    <td width="150" bgcolor="#E0E6ED" class="Estilo5" ><strong class="css_cantidadterapia"><?php echo $total_terapiassug; ?></strong></td>
  </tr>

</table>	</td>
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


<table width="900" border="1" align="center">

  <tr>

    <td class="Estilo5"><div align="center">No. Terapias </div></td>
	
	<td class="Estilo5"><div align="center">Area </div></td>
	<td class="Estilo5"><div align="center">Terapista </div></td>

    <td class="Estilo5"><div align="center">D&iacute;as</div></td>

    <td class="Estilo5"><div align="center">Fecha Inicia: </div></td>

    <td class="Estilo5"><div align="center">Hora:</div></td>

    <td class="Estilo5"><div align="center">No.Autorizaci&oacute;n</div></td>

    <td class="Estilo5"><div align="center"></div></td>

    <td class="Estilo5">&nbsp;</td>
  </tr>

  <tr>

    <td><div align="center">

      <input name="fecha_hoyval" type="hidden" id="fecha_hoyval" value="<?php echo date("Y-m-d"); ?>" />
      <input name="n_terapiasval" type="text" id="n_terapiasval" size="5">

    </div></td>
	
	<td>
	<select class="form-control" name="especig_idx" id="especig_idx" onchange="ver_user()"  >
                <option value="" >--Seleccion Area--</option>
<?php
$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','',' where especi_id not in(5,6) order by especi_nombre asc',$DB_gogess);
?>
      </select>	</td>
	
	<td>
	<div id="lista_user">	</div>	</td>

    <td><table width="100" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>

        <td class="Estilo5"><div align="center">L</div></td>

        <td bgcolor="#EBEBEB" class="Estilo5"><div align="center">M</div></td>

        <td class="Estilo5"><div align="center">Mi</div></td>

        <td bgcolor="#DDE3EA" class="Estilo5"><div align="center">J</div></td>

        <td class="Estilo5"><div align="center">V</div></td>

		<td class="Estilo5"><div align="center">S</div></td>
      </tr>

      <tr>

        <td><div align="center">

          <input name="checkbox_lunes" type="checkbox" id="checkbox_lunes" value="checkbox">

        </div></td>

        <td bgcolor="#EBEBEB"><div align="center">

          <input name="checkbox_martes" type="checkbox" id="checkbox_martes" value="checkbox">

        </div></td>

        <td><div align="center">

          <input name="checkbox_miercoles" type="checkbox" id="checkbox_miercoles" value="checkbox">

        </div></td>

        <td bgcolor="#DDE3EA"><div align="center">

          <input name="checkbox_jueves" type="checkbox" id="checkbox_jueves" value="checkbox">

        </div></td>

        <td><div align="center">

          <input name="checkbox_viernes" type="checkbox" id="checkbox_viernes" value="checkbox">

        </div></td>

		<td><div align="center">

          <input name="checkbox_sabado" type="checkbox" id="checkbox_sabado" value="checkbox">

        </div></td>
      </tr>

    </table></td>

    <td><div align="center">

      <input name="fecha_inicioval" type="text" id="fecha_inicioval">

    </div></td>


    <td><div align="center">

      <select name="hora_val" id="hora_val">

        <option value="0">-hora-</option>

        <option value="08:30">08:30</option>
		<option value="09:00">09:00</option>
        <option value="09:30">09:30</option>
        <option value="10:00">10:00</option>

		<option value="10:30">10:30</option>

        <option value="11:00">11:00</option>

        <option value="11:30">11:30</option>

        <option value="12:00">12:00</option>

        <option value="12:30">12:30</option>

        <option value="13:00">13:00</option>

        <option value="13:30">13:30</option>

        <option value="14:00">14:00</option>

        <option value="14:30">14:30</option>

        <option value="15:00">15:00</option>

        <option value="15:30">15:30</option>

        <option value="16:00">16:00</option>

        <option value="16:30">16:30</option>

        <option value="17:00">17:00</option>

        <option value="17:30">17:30</option>

        <option value="18:00">18:00</option>

        <option value="18:30">18:30</option>

        <option value="19:00">19:00</option>

        <option value="19:30">19:30</option>

        <option value="20:00">20:00</option>
        </select>

    </div></td>

    <td><div align="center">

      <input name="n_autorizacionval" type="text" id="n_autorizacionval">

    </div></td>

    <td><div align="center">

      <input type="button" name="Submit" value="Generar" onClick="generar_registros()">  

    </div></td>
    <td><input type="button" name="Submit2" value="Orden " onclick="abrir_orden()" /></td>
  </tr>
</table>

<div id="genera_registros"></div>


<div class="TableScroll_lista">
<div id="lista_terapias" ></div>
</div>


<div id="grid_borrar"></div>

<script type="text/javascript">
<!--

 $("#fecha_inicioval").datepicker({dateFormat: 'yy-mm-dd'});

ver_gridterapias();
//ver_calendario_general();

function abrir_orden()
{
   abrir_standar("aplicativos/documental/opciones/panel/agendar/ordenlista.php","Orden","divBody_ortden_div","divDialog_ortden_div",400,400,'<?php echo $_POST["clie_id"]; ?>',0,0,0,0,0,0);

}

 //  End -->

</script>
<div id="divBody_ortden_div" ></div>
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
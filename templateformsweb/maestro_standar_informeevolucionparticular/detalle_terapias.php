<?php

header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
$tiempossss=140000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");


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





	 $("#grid_borrar").load("templateformsweb/maestro_standar_atencion/borrar.php",{

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

   

  if($('#n_terapiasval').val()=='')

  {



  alert("Ingrese la la cantidad de terapias...");

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

   

  

  $("#genera_registros").load("templateformsweb/maestro_standar_atencion/genera_registros.php",{

     atenc_hc:'<?php echo $_POST["atenc_hc"]; ?>',
	 clie_id:'<?php echo $_POST["clie_id"]; ?>',

	 n_terapiasval:$('#n_terapiasval').val(),

	 checkbox_lunes:$('#checkbox_lunes').prop('checked'),

	 checkbox_martes:$('#checkbox_martes').prop('checked'),

	 checkbox_miercoles:$('#checkbox_miercoles').prop('checked'),

	 checkbox_jueves:$('#checkbox_jueves').prop('checked'),

	 checkbox_viernes:$('#checkbox_viernes').prop('checked'),

	 checkbox_sabado:$('#checkbox_viernes').prop('checked'),

	 fecha_inicioval:$('#fecha_inicioval').val(),

	 hora_val:$('#hora_val').val(),
	 n_autorizacionval:$('#n_autorizacionval').val()

	 

  },function(result){  

     

	  ver_gridterapias();

  });  

  $("#genera_registros").html("Espere un momento...");  

   

    

   



}


function ver_user()
{

  $("#lista_user").load("templateformsweb/maestro_standar_atencion/lista_user.php",{
      especi_idx:$('#especi_idx').val()
  },function(result){  



  });  

  $("#lista_user").html("Espere un momento...");  

}
//  End -->

</script>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="299" bgcolor="#E0E6ED"><span class="Estilo5">SUGERIDAS</span></td>

    <td width="301" bgcolor="#E0E6ED"><span class="Estilo5">FACTURADAS</span></td>

  </tr>

  <tr>

    <td valign="top" bgcolor="#EBEBEB">
	
<!-- <span class="css_cantidadterapia">PSICOLOGIA:<?php echo $psicologia; ?></span><br>
<span class="css_cantidadterapia">PEDAGOGIA:<?php echo $pedagogia; ?></span><br>
<span class="css_cantidadterapia">LENGUAJE:<?php echo $lenguaje; ?></span><br>
<span class="css_cantidadterapia">TERAPIA FISICA:<?php echo $fisica; ?></span><br> -->
<strong class="css_cantidadterapia">TOTAL SUGERIDAS:<?php echo $total_terapiassug; ?></strong></td>

    <td valign="top" bgcolor="#E0E0DE">&nbsp;</td>

  </tr>

</table>

<table width="800" border="1" align="center">

  <tr>

    <td class="Estilo5"><div align="center">No. Terapias </div></td>
	
	<td class="Estilo5"><div align="center">Area </div></td>
	<td class="Estilo5"><div align="center">Terapista </div></td>

    <td class="Estilo5"><div align="center">D&iacute;as</div></td>

    <td class="Estilo5"><div align="center">Fecha Inicia: </div></td>

    <td class="Estilo5"><div align="center">Hora:</div></td>

    <td class="Estilo5"><div align="center">No.Autorizaci&oacute;n</div></td>

    <td class="Estilo5"><div align="center"></div></td>

  </tr>

  <tr>

    <td><div align="center">

      <input name="n_terapiasval" type="text" id="n_terapiasval" size="5">

    </div></td>
	
	<td>
	<select class="form-control" name="especi_idx" id="especi_idx" onchange="ver_user()"  >
                <option value="" >--Seleccion Producto--</option>
<?php
$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre','',' order by especi_nombre asc',$DB_gogess);
?>
            </select>
	</td>
	
	<td>
	<div id="lista_user">
	</div>
	</td>

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

        <option value="8:00">8:00</option>

        <option value="8:30">8:30</option>

        <option value="9:00">9:00</option>

        <option value="9:30">9:30</option>

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

  </tr>

</table>

<p>&nbsp;</p>

<div id="genera_registros"></div>


<div class="TableScroll_lista">
<div id="lista_terapias" ></div>
</div>





<div id="grid_borrar"></div>

<script type="text/javascript">

<!--

 $("#fecha_inicioval").datepicker({dateFormat: 'yy-mm-dd'});

ver_gridterapias();

 //  End -->

</script>
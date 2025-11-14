<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
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

$buscat="select * from faesa_terapiasregistro where terap_id=".$_POST["pVar1"];
$rs_buscat = $DB_gogess->executec($buscat,array());
?>
<style type="text/css">
<!--
.css_cambiot {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_titulocambio {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<div align="center">
  <p>Cambio de fecha hora</p>
  <p>&nbsp;  </p>
</div>
<table border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td class="css_titulocambio">Area:</td>
    <td>  <select name="especi_idcambio" id="especi_idcambio" class="form-control" onchange="ver_terapistacalcambio()" >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('dns_especialidad','especi_id,especi_nombre',$rs_buscat->fields["especi_id"],' where especi_id not in(5,6) order by especi_nombre asc',$DB_gogess);
			?>
      </select></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Terapeuta</span>:</td>
    <td><div id="lista_terapistacalcambio">
<select class="form-control" name="usua_idvalcambio" id="usua_idvalcambio"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
<option value="" >--Seleccion Terapista--</option>
<?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido',$rs_buscat->fields["usua_id"],' where especi_id='.$rs_buscat->fields["especi_id"].' and centro_id='.$_SESSION['ces1313777_centro_id'].'  order by usua_apellido asc',$DB_gogess);
?>
</select>

</div></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Fecha: </span></td>
    <td><input name="terap_fechaxcambio" type="text" class="css_cambiot" id="terap_fechaxcambio" value="<?php echo $rs_buscat->fields["terap_fecha"]; ?>" /></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Hora:</span></td>
    <td><span class="css_cambiot">
	
      <select name="hora_tiempoxcambio" class="css_cambiot" id="hora_tiempoxcambio">
	  <option value="">-hora-</option>
        <?php
$objformulario->fill_cmb('app_horas','hora_tiempo,hora_nombre',$rs_buscat->fields["terap_hora"],'order by hora_orden asc',$DB_gogess);
?>
        </select>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="css_titulocambio">PARA RECUPERACIONES </div></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Recuperaci&oacute;n</span></td>
    <td><span class="css_cambiot"><select name="terap_recuperacion" id="terap_recuperacion" class="css_cambiot" >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('gogess_sino','value,etiqueta',$rs_buscat->fields["terap_recuperacion"],'',$DB_gogess);
			?>
      </select></span></td>
  </tr>
  <tr>
    <td valign="top"><span class="css_titulocambio">Observaciones</span></td>
    <td><span class="css_cambiot"><textarea name="terap_observacion" rows="3" id="terap_observacion"><?php echo $rs_buscat->fields["terap_observacion"]; ?></textarea></span></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="button" name="Submit" value="Actualizar" onclick="guarda_cmabiohorario('<?php echo $_POST["pVar1"]; ?>')" />
    </div>      <div align="center"></div></td>
  </tr>
</table>
<div id="guarda_t" ></div>
<script type="text/javascript">
<!--
$( "#terap_fechaxcambio" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>


<script type="text/javascript">
<!--
function guarda_cmabiohorario(terap_id)
{
 
 
   $("#guarda_t").load("aplicativos/documental/opciones/panel/agendar/guarda_cambio.php",{
      terap_id:terap_id,
	  terap_fechax:$('#terap_fechaxcambio').val(),
	  hora_tiempox:$('#hora_tiempoxcambio').val(),
	  especi_idcambio:$('#especi_idcambio').val(),
	  usua_idvalcambio:$('#usua_idvalcambio').val(),
	  terap_recuperacion:$('#terap_recuperacion').val(),
	  terap_observacion:$('#terap_observacion').val()
	  
  },function(result){  



  });  

  $("#guarda_t").html("Espere un momento...");  
  
   
}

function ver_terapistacalcambio()
{

  $("#lista_terapistacalcambio").load("aplicativos/documental/opciones/panel/agendar/lista_terapistacambio.php",{
      especi_idtx:$('#especi_idcambio').val()
  },function(result){  



  });  

  $("#lista_terapistacalcambio").html("Espere un momento...");  

}
//  End -->
</script>

<?php
}
?>
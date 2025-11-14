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

$obj_util=new util_funciones();

include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();

$buscat="select * from faesa_terapiasregistro  where terap_id=".$_POST["pVar1"];
$rs_buscat = $DB_gogess->executec($buscat,array());


$buscat2="select * from faesa_terapiasregistro inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where terap_id=".$_POST["pVar1"];
$rs_buscat2 = $DB_gogess->executec($buscat2,array());

$nombre_dato=array();
$nombre_dato=explode(" ",$rs_buscat2->fields["clie_nombre"]);							
$apellido_dato=array();
$apellido_dato=explode(" ",$rs_buscat2->fields["clie_apellido"]);
$paciente_data=ucwords(strtolower(utf8_encode($rs_buscat2->fields["clie_nombre"]." ".$apellido_dato[0])));

$terap_motivo='';
$terap_motivo=$rs_buscat->fields["terap_motivo"];


$arreglo_horas=array();
$arreglo_horas=$obj_util->genera_arrayhora($hora_ini,$rango_hora,$hora_fin);
?>
<style type="text/css">
<!--
.css_cambiot {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.css_titulocambio {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<div align="center">
  <p>Cambio de fecha hora</p>
  <p><b><?php echo $paciente_data; ?></b> </p>
</div>
<table border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td class="css_titulocambio">Area:</td>
    <td>  <select name="especi_idcambio" id="especi_idcambio" class="form-control" onchange="ver_terapistacalcambio()" >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre',$rs_buscat->fields["prof_id"],' where prof_id=35 order by prof_nombre asc',$DB_gogess);
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
	<?php //echo $rs_buscat->fields["terap_hora"]; ?>
      <select name="hora_tiempoxcambio" class="css_cambiot" id="hora_tiempoxcambio">
	  <option value="">-hora-</option>
        <?php
//$objformulario->fill_cmb('app_horas','hora_tiempo,hora_nombre',$rs_buscat->fields["terap_hora"],'order by hora_orden asc',$DB_gogess);
?>
<?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  if($rs_buscat->fields["terap_hora"]==$arreglo_horas[$i].":00")
		  {
		  echo '<option value="'.$arreglo_horas[$i].'" selected="selected" >'.$arreglo_horas[$i].'</option>';		
		  }
		  else
		  {
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		  }
		}
		?>
        </select>
    </span></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Hora Final:</span></td>
    <td><span class="css_cambiot"><select name="hora_finaltiempoxcambio" class="css_cambiot" id="hora_finaltiempoxcambio">
	  <option value="">-hora-</option>
        <?php
//$objformulario->fill_cmb('app_horas','hora_tiempo,hora_nombre',$rs_buscat->fields["terap_hora"],'order by hora_orden asc',$DB_gogess);
?>
<?php
		for($i=0;$i<count($arreglo_horas);$i++)
		{
		  if($rs_buscat->fields["terap_horaf"]==$arreglo_horas[$i].":00")
		  {
		  echo '<option value="'.$arreglo_horas[$i].'" selected="selected" >'.$arreglo_horas[$i].'</option>';		
		  }
		  else
		  {
		  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';		
		  }
		}
		?>
        </select></span></td>
  </tr>
  <tr>
    <td><span class="css_titulocambio">Motivo:</span></td>
    <td><input name="terap_motivo" type="text" id="terap_motivo" value="<?php echo $terap_motivo; ?>" class="css_cambiot" /></td>
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
  
   $("#guarda_t").load("guarda_cambio.php",{
      terap_id:terap_id,
	  terap_fechax:$('#terap_fechaxcambio').val(),
	  hora_tiempox:$('#hora_tiempoxcambio').val(),
	  hora_tiempofinalx:$('#hora_finaltiempoxcambio').val(),	  
	  especi_idcambio:$('#especi_idcambio').val(),
	  usua_idvalcambio:$('#usua_idvalcambio').val(),
	  terap_recuperacion:$('#terap_recuperacion').val(),
	  terap_motivo:$('#terap_motivo').val(),
	  terap_observacion:$('#terap_observacion').val()
	  
  },function(result){  

   ver_diario();

  });  

  $("#guarda_t").html("Espere un momento...");  
  
   
}

function ver_terapistacalcambio()
{

  $("#lista_terapistacalcambio").load("lista_terapistacambio.php",{
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
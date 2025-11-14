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

$filtro_espe=' where prof_id in (select prof.prof_id from app_usuario us inner join dns_gridfuncionprofesional espe on us.usua_enlace=espe.usua_enlace inner join cesdb_arextension.dns_profesion prof on espe.prof_id=prof.prof_id where prof.prof_id not in (38,777,888,911116,77))  order by prof_nombre asc ';

$variable_data="$('#-campo-').val()";
$acceso_h='<span onclick="ver_horariosprofesional('.$variable_data.')" style="cursor:pointer" ><img src="calc.png" width="22" height="21" /></span>';

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
        height:100px;
        overflow: auto;
      }

-->
</style>
<div class="css_general" >
<center>
<input name="busca_paciente" type="text" id="busca_paciente" value="" />
<input type="button" name="Submit" value="Buscar Paciente" onclick="busca_paciente()" />
<div class="TableScrolltr">
<div id="listap"></div>
</div>
<table width="700" border="1" align="center">
  <tr>
    <td colspan="10" bgcolor="#D7E6F4" class="css_txt5"><div align="center">Agendamiento </div></td>
  </tr>
  <tr>
    <td colspan="10" class="css_txt5"><div align="center">
      <input name="fecha_hoyval" type="hidden" id="fecha_hoyval" value="<?php echo date("Y-m-d"); ?>" />
      <input name="n_terapiasval" type="hidden" id="n_terapiasval" size="5" value="1" />
    </div>
        <div id="lista_user"> </div></td>
  </tr>

  <tr>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Especialidad</div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Profesional</div></td>
	<td bgcolor="#D7E6F4" class="css_txt5"><div align="center"></div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Fecha: </div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Hora</div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Quirofano</div></td>
    <td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Motivo</div></td> 
	<!--<td bgcolor="#D7E6F4" class="css_txt5"><div align="center">Cod. Medicompanies</div></td>
	<td bgcolor="#D7E6F4" class="css_txt5"><div align="center">COPAGO</div></td>
	<td bgcolor="#D7E6F4" class="css_txt5"><div align="center">OBSERVACIONES</div></td> -->
    <td bgcolor="#D7E6F4" class="css_txt5">&nbsp;</td>
  </tr>

  <tr>
     <td><div align="center">
       <select class="form-control" name="prof_idvalx1" id="prof_idvalx1" style="width:110px" onchange="cmb_listadata('1')">
         <option value="">--Especialidad--</option>
         <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
       </select>
     </div></td>

    <td nowrap="nowrap"><div align="center">
	<div id="cmb_profesional1">
      <select class="form-control" name="usua_idvalx1" id="usua_idvalx1" style="width:150px" onchange="valida_dataagenda('1')">
        <option value="">--Profesional--</option>
        <?php
         $objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1 order by usua_nombre asc',$DB_gogess);
        ?>
      </select>
	 </div>
    </div></td>
	
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx1",$acceso_h); ?></div></td>

    <td><div align="center">

      <input name="fecha_inicioval1" type="text" id="fecha_inicioval1" autocomplete="off"  onchange="valida_dataagenda('1')" style="width:100px" >
      <input name="hora_val" type="hidden" id="hora_val" value="" />
      <input name="n_autorizacionval" type="hidden" id="n_autorizacionval" />

    </div></td>
    <td>	
	   <div align="center">
          <select name="hora_1" id="hora_1" style="font-size:10px" onchange="valida_dataagenda('1')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
        </div>	</td>
    <td>
	  <div align="center">
	    <select class="form-control" name="quiro_id_l" id="quiro_id_l" style="width:100px" onchange="valida_dataagenda('1')">
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	      </div></td>
    <td><input name="motivo_1" type="text" id="motivo_1" value="" /></td>
	<!--  <td><input name="medicompanies_1" type="text" id="medicompanies_1" value="" /></td> 
	<td><input name="copago_1" type="text" id="copago_1" value="" /></td>
	<td><input name="observacion_1" type="text" id="observacion_1" value="" /></td> -->
    <td><div id="valida_1">&nbsp;
      <input name="valida_terapia1" type="hidden" id="valida_terapia1" value="0" />
    </div></td>
  </tr>

  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx2" id="prof_idvalx2" style="width:110px"  onchange="cmb_listadata('2')" >
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional2">
      <select class="form-control" name="usua_idvalx2" id="usua_idvalx2" style="width:150px" onchange="valida_dataagenda('2')" >
        <option value="">--Profesional--</option>
        <?php
$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1  order by usua_nombre asc',$DB_gogess);
?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx2",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval2" type="text" id="fecha_inicioval2" autocomplete="off"  onchange="valida_dataagenda('2')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_2" id="hora_2" style="font-size:10px" onchange="valida_dataagenda('2')">
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
       </div></td>
    <td><div align="center">
	    <select class="form-control" name="quiro_id_2" id="quiro_id_2" style="width:100px" onchange="valida_dataagenda('2')" >
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	    
	      </div></td>
     <td><input name="motivo_2" type="text" id="motivo_2" value="" /></td> 
	<!--<td><input name="medicompanies_2" type="text" id="medicompanies_2" value="" /></td> 
	<td><input name="copago_2" type="text" id="copago_2" value="" /></td>
	<td><input name="observacion_2" type="text" id="observacion_2" value="" /></td> -->
    <td><div id="valida_2"><input name="valida_terapia2" type="hidden" id="valida_terapia2" value="0" /></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx3" id="prof_idvalx3" style="width:110px"  onchange="cmb_listadata('3')" >
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional3">
      <select class="form-control" name="usua_idvalx3" id="usua_idvalx3" style="width:150px" onchange="valida_dataagenda('3')" >
        <option value="">--Profesional--</option>
        <?php

$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1  order by usua_nombre asc',$DB_gogess);

?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx3",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval3" type="text" id="fecha_inicioval3" autocomplete="off"  onchange="valida_dataagenda('3')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_3" id="hora_3" style="font-size:10px" onchange="valida_dataagenda('3')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
        </div></td>
    <td><div align="center">
	    <select class="form-control" name="quiro_id_3" id="quiro_id_3" style="width:100px" onchange="valida_dataagenda('3')" >
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	    
	      </div></td>
   <td><input name="motivo_3" type="text" id="motivo_3" value="" /></td> 
	 <!-- <td><input name="medicompanies_3" type="text" id="medicompanies_3" value="" /></td>
	<td><input name="copago_3" type="text" id="copago_3" value="" /></td>
	<td><input name="observacion_3" type="text" id="observacion_3" value="" /></td> -->
    <td><div id="valida_3"><input name="valida_terapia3" type="hidden" id="valida_terapia3" value="0" /></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx4" id="prof_idvalx4" style="width:110px"  onchange="cmb_listadata('4')" >
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional4">
      <select class="form-control" name="usua_idvalx4" id="usua_idvalx4" style="width:150px" onchange="valida_dataagenda('4')" >
        <option value="">--Profesional--</option>
        <?php

$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1  order by usua_nombre asc',$DB_gogess);

?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx4",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval4" type="text" id="fecha_inicioval4" autocomplete="off"  onchange="valida_dataagenda('4')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_4" id="hora_4" style="font-size:10px" onchange="valida_dataagenda('4')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
       </div></td>
    <td><div align="center">
      <select class="form-control" name="quiro_id_4" id="quiro_id_4" style="width:100px" onchange="valida_dataagenda('4')" >
        <option value="">--Quirofano--</option> 
        <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
      </select>
    </div></td>
    <td><input name="motivo_4" type="text" id="motivo_4" value="" /></td> 
	 <!--  <td><input name="medicompanies_4" type="text" id="medicompanies_4" value="" /></td>
	<td><input name="copago_4" type="text" id="copago_4" value="" /></td>
	<td><input name="observacion_4" type="text" id="observacion_4" value="" /></td>  -->
    <td><div id="valida_4"><input name="valida_terapia4" type="hidden" id="valida_terapia4" value="0" /></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx5" id="prof_idvalx5" style="width:110px"  onchange="cmb_listadata('5')" >
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional5">
      <select class="form-control" name="usua_idvalx5" id="usua_idvalx5" style="width:150px" onchange="valida_dataagenda('5')" >
        <option value="">--Profesional--</option>
        <?php

$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1  order by usua_nombre asc',$DB_gogess);

?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx5",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval5" type="text" id="fecha_inicioval5" autocomplete="off"  onchange="valida_dataagenda('5')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_5" id="hora_5" style="font-size:10px" onchange="valida_dataagenda('5')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
       </div></td>
    <td><div align="center">
	    <select class="form-control" name="quiro_id_5" id="quiro_id_5" style="width:100px" onchange="valida_dataagenda('5')" >
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	    
	      </div></td>
    <td><input name="motivo_5" type="text" id="motivo_5" value="" /></td>
	<!-- <td><input name="medicompanies_5" type="text" id="medicompanies_5" value="" /></td>
	<td><input name="copago_5" type="text" id="copago_5" value="" /></td>
	<td><input name="observacion_5" type="text" id="observacion_5" value="" /></td>  -->
    <td><div id="valida_5"><input name="valida_terapia5" type="hidden" id="valida_terapia5" value="0" /></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx6" id="prof_idvalx6" style="width:110px"  onchange="cmb_listadata('6')">
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional6">
      <select class="form-control" name="usua_idvalx6" id="usua_idvalx6" style="width:150px" onchange="valida_dataagenda('6')" >
        <option value="">--Profesional--</option>
        <?php

$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1  order by usua_nombre asc',$DB_gogess);

?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx6",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval6" type="text" id="fecha_inicioval6" autocomplete="off"  onchange="valida_dataagenda('6')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_6" id="hora_6" style="font-size:10px" onchange="valida_dataagenda('6')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
       </div></td>
    <td><div align="center">
	    <select class="form-control" name="quiro_id_6" id="quiro_id_6" style="width:100px" onchange="valida_dataagenda('6')" >
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	    
	      </div></td>
    <td><input name="motivo_6" type="text" id="motivo_6" value="" /></td> 
<!--	<td><input name="medicompanies_6" type="text" id="medicompanies_6" value="" /></td>
	<td><input name="copago_6" type="text" id="copago_6" value="" /></td>
	<td><input name="observacion_6" type="text" id="observacion_6" value="" /></td>  -->
    <td><div id="valida_6"><input name="valida_terapia6" type="hidden" id="valida_terapia6" value="0" /></div></td>
  </tr>
  <tr>
    <td><div align="center">
      <select class="form-control" name="prof_idvalx7" id="prof_idvalx7" style="width:110px"  onchange="cmb_listadata('7')">
        <option value="">--Especialidad--</option>
        <?php
         $objformulario->fill_cmb('cesdb_arextension.dns_profesion','prof_id,prof_nombre','',$filtro_espe,$DB_gogess);
        ?>
      </select>
    </div></td>
    <td><div align="center"><div id="cmb_profesional7">
      <select class="form-control" name="usua_idvalx7" id="usua_idvalx7" style="width:150px" onchange="valida_dataagenda('7')" >
        <option value="">--Profesional--</option>
        <?php

$objformulario->fill_cmb('app_usuario','usua_id,usua_nombre,usua_apellido','',' where usua_agenda=1 order by usua_nombre asc',$DB_gogess);

?>
      </select></div>
    </div></td>
	 <td nowrap="nowrap"><div align="center"><?php echo str_replace("-campo-","usua_idvalx7",$acceso_h); ?></div></td>
    <td><div align="center">
      <input name="fecha_inicioval7" type="text" id="fecha_inicioval7" autocomplete="off"  onchange="valida_dataagenda('7')" style="width:100px" >
    </div></td>
    <td><div align="center">
          <select name="hora_7" id="hora_7" style="font-size:10px" onchange="valida_dataagenda('7')" >
            <option value="">-hora-</option>
            <?php
			for($i=0;$i<count($arreglo_horas);$i++)
			{
			  echo '<option value="'.$arreglo_horas[$i].'">'.$arreglo_horas[$i].'</option>';
			}
			?>
          </select>
        </div></td>
    <td><div align="center">
	    <select class="form-control" name="quiro_id_7" id="quiro_id_7" style="width:100px" onchange="valida_dataagenda('7')" >
	      <option value="">--Quirofano--</option> 
	      <?php
$objformulario->fill_cmb('lospinos_quirofanos','quiro_id,quiro_nombre','',' order by quiro_id asc',$DB_gogess);
?>
	      </select>
	    
	      </div></td>
    <td><input name="motivo_7" type="text" id="motivo_7" value="" /></td> 
	 <!-- <td><input name="medicompanies_7" type="text" id="medicompanies_7" value="" /></td>
	<td><input name="copago_7" type="text" id="copago_7" value="" /></td>
	<td><input name="observacion_7" type="text" id="observacion_7" value="" /></td> -->
    <td><div id="valida_7"><input name="valida_terapia7" type="hidden" id="valida_terapia7" value="0" /></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>

    <td colspan="10"><div align="center"><br />
        <input name="terap_nfacturaval" type="hidden" id="terap_nfacturaval" size="50" onchange="busca_existefactura()" />
	   <div id="b_factura"></div>
	   <br>
      <input name="terap_motivoval" type="hidden" id="terap_motivoval" size="50" /><br><br>

    </div>    </td>
  </tr>

  <tr>

    <td colspan="10"><div align="center">

      <table width="100%" border="0" cellpadding="0" cellspacing="0">

        <tr>

          <td><div id="btn_gen" align="center">

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
<br />
<div id="valida_detalle" style="color:#FF0000"></div>

</center>



</div>

<div id="genera_registros"></div>
<div id="divBody_hprofesional"></div>

<script type="text/javascript">
<!--

function cmb_listadata(num)
{

$("#cmb_profesional"+num).load("lista_cmb.php",{
      num:num,
	  prof_idvalx:$("#prof_idvalx"+num).val()
 },function(result){ 

  }); 

$("#cmb_profesional"+num).html("Espere un momento...");

}



function ver_horariosprofesional(idprofesional)
{

abrir_standar('pantalla_hprofesional.php','HORARIO','divBody_hprofesional','divDialog_hprofesional',800,500,idprofesional,0,0,0,0,0,0);

}

function ver_detallesrestriccion(ord)
{

   var str;
   str=$('input:radio[name=radio_hc]:checked').val();   

   if(str!=undefined)
   {
   var arr=str.split('|');
   }
   else
   {
    alert("Seleccione el Paciente");
	$('#usua_idvalx'+ord).val('');
	$('#fecha_inicioval'+ord).val('');
	$('#hora_'+ord).val('');
	return false;
   }

$("#valida_detalle").load("lista_restriccion.php",{
  clie_id:arr[1],
  usua_idvalx:$('#usua_idvalx'+ord).val(),
  fecha_inicioval:$('#fecha_inicioval'+ord).val(),
  hora:$('#hora_'+ord).val(),
  ord:ord
  
 },function(result){ 

  }); 

$("#valida_detalle").html("...");


}

function busca_existefactura()
{

$("#b_factura").load("busca_factura.php",{
  terap_nfacturaval:$('#terap_nfacturaval').val()
 },function(result){ 

  }); 

$("#b_factura").html("Espere un momento...");

}




 $("#fecha_inicioval").datepicker({dateFormat: 'yy-mm-dd'});

 

function generar_registros()
{

   var opcion_seleccion;
   opcion_seleccion=0;
   var hoy=new Date($('#fecha_hoyval').val());
   var seleccionado=new Date($('#fecha_inicioval').val());

  if($('#n_terapiasval').val()=='')
  {
    alert("Ingrese la la cantidad de terapias...");
    return false;
  }


if($('#usua_idvalx1').val()!='' || $('#usua_idvalx2').val()!='' || $('#usua_idvalx3').val()!='' || $('#usua_idvalx4').val()!='' || $('#usua_idvalx5').val()!=''  || $('#usua_idvalx6').val()!='' || $('#usua_idvalx7').val()!='' )
	 {
		opcion_seleccion=1;
	 }



   if($('#usua_idvalx1').val()!='')
   {
	  if($('#fecha_inicioval1').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	  
	  if($('#hora_1').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx2').val()!='')
   {
	  if($('#fecha_inicioval2').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_2').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx3').val()!='')
   {
	  if($('#fecha_inicioval3').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_3').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx4').val()!='')
   {
	  if($('#fecha_inicioval4').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_4').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx5').val()!='')
   {
	  if($('#fecha_inicioval5').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_5').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx6').val()!='')
   {
	  if($('#fecha_inicioval6').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_6').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }
   
   if($('#usua_idvalx7').val()!='')
   {
	  if($('#fecha_inicioval7').val()=='')
	  {
	     alert("Seleccione la Fecha");
		 return false;
	  }	
	  if($('#hora_7').val()=='')
	  {
	    alert("Seleccione la Hora");
	    return false;
	  }
   }


	if(opcion_seleccion==0)
	{
	   alert("Favor Ingresar al menos un profesional");
	   return false;
	} 


   var str;
   str=$('input:radio[name=radio_hc]:checked').val();   

   if(str!=undefined)
   {
   var arr=str.split('|');
   }
   else
   {
    alert("Seleccione el Paciente");
	return false;
   }

   

   if($('input:radio[name=radio_hc]:checked').val()==undefined)
   {
    alert("Seleccione el paciente...");
    return false;
   }

  
   if($('#valida_terapia1').val()!='0' || $('#valida_terapia2').val()!='0' || $('#valida_terapia3').val()!='0' || $('#valida_terapia4').val()!='0' || $('#valida_terapia5').val()!='0'  || $('#valida_terapia6').val()!='0' || $('#valida_terapia7').val()!='0' )
	 {
		alert("Verifique las fechas y horas...");
        return false;
	 }



  $("#genera_registros").load("genera_registrosvarios.php",{
     atenc_hc:arr[0],
	 clie_id:arr[1],
	 n_terapiasval:$('#n_terapiasval').val(),
	 
	 prof_idvalx1:$('#prof_idvalx1').val(),
	 prof_idvalx2:$('#prof_idvalx2').val(),
	 prof_idvalx3:$('#prof_idvalx3').val(),
	 prof_idvalx4:$('#prof_idvalx4').val(),
	 prof_idvalx5:$('#prof_idvalx5').val(),
	 prof_idvalx6:$('#prof_idvalx6').val(),
	 prof_idvalx7:$('#prof_idvalx7').val(),
	 
	 usua_idvalx1:$('#usua_idvalx1').val(),
	 usua_idvalx2:$('#usua_idvalx2').val(),
	 usua_idvalx3:$('#usua_idvalx3').val(),
	 usua_idvalx4:$('#usua_idvalx4').val(),
	 usua_idvalx5:$('#usua_idvalx5').val(),
	 usua_idvalx6:$('#usua_idvalx6').val(),
	 usua_idvalx7:$('#usua_idvalx7').val(),
	 fecha_inicioval1:$('#fecha_inicioval1').val(),
	 fecha_inicioval2:$('#fecha_inicioval2').val(),
	 fecha_inicioval3:$('#fecha_inicioval3').val(),
	 fecha_inicioval4:$('#fecha_inicioval4').val(),
	 fecha_inicioval5:$('#fecha_inicioval5').val(),
	 fecha_inicioval6:$('#fecha_inicioval6').val(),
	 fecha_inicioval7:$('#fecha_inicioval7').val(),
	 hora_1:$('#hora_1').val(),
	 hora_2:$('#hora_2').val(),
	 hora_3:$('#hora_3').val(),
	 hora_4:$('#hora_4').val(),
	 hora_5:$('#hora_5').val(),
	 hora_6:$('#hora_6').val(),
	 hora_7:$('#hora_7').val(),
	 motivo_1:$('#motivo_1').val(),
	 motivo_2:$('#motivo_2').val(),
	 motivo_3:$('#motivo_3').val(),
	 motivo_4:$('#motivo_4').val(),
	 motivo_5:$('#motivo_5').val(),
	 motivo_6:$('#motivo_6').val(),
	 motivo_7:$('#motivo_7').val(),
	 quiro_id_l:$('#quiro_id_l').val(),
	 quiro_id_2:$('#quiro_id_2').val(),
	 quiro_id_3:$('#quiro_id_3').val(),
	 quiro_id_4:$('#quiro_id_4').val(),
	 quiro_id_5:$('#quiro_id_5').val(),
	 quiro_id_6:$('#quiro_id_6').val(),
	 quiro_id_7:$('#quiro_id_7').val(),	
	 
	 
	/* medicompanies_1:$('#medicompanies_1').val(),
	 medicompanies_2:$('#medicompanies_2').val(),
	 medicompanies_3:$('#medicompanies_3').val(),
	 medicompanies_4:$('#medicompanies_4').val(),
	 medicompanies_5:$('#medicompanies_5').val(),
	 medicompanies_6:$('#medicompanies_6').val(),
	 medicompanies_7:$('#medicompanies_7').val(),

	 copago_1:$('#copago_1').val(),
	 copago_2:$('#copago_2').val(),
	 copago_3:$('#copago_3').val(),
	 copago_4:$('#copago_4').val(),
	 copago_5:$('#copago_5').val(),
	 copago_6:$('#copago_6').val(),
	 copago_7:$('#copago_7').val(),
	 
	 observacion_1:$('#observacion_1').val(),
	 observacion_2:$('#observacion_2').val(),
	 observacion_3:$('#observacion_3').val(),
	 observacion_4:$('#observacion_4').val(),
	 observacion_5:$('#observacion_5').val(),
	 observacion_6:$('#observacion_6').val(),
	 observacion_7:$('#observacion_7').val(), */
	  
	 n_autorizacionval:$('#n_autorizacionval').val(),
	// terap_motivoval:$('#terap_motivoval').val(),
	 terap_nfacturaval:$('#terap_nfacturaval').val(),
	 centro_id:'<?php echo $_SESSION['ces1313777_centro_id'];  ?>',
	 usuar_id:'<?php echo$_SESSION['ces1313777_sessid_inicio'];  ?>'

  },function(result){ 
  
      $('#prof_idvalx1').val('');
	  $('#prof_idvalx3').val('');
	  $('#prof_idvalx4').val('');
	  $('#prof_idvalx5').val('');
	  $('#prof_idvalx6').val('');
	  $('#prof_idvalx7').val('');  
	  

      $('#usua_idvalx1').val('');
	  $('#usua_idvalx2').val('');
	  $('#usua_idvalx3').val('');
	  $('#usua_idvalx4').val('');
	  $('#usua_idvalx5').val('');
	  $('#usua_idvalx6').val('');
	  $('#usua_idvalx7').val('');
	  
	  $('#fecha_inicioval1').val('');
	  $('#fecha_inicioval2').val('');
	  $('#fecha_inicioval3').val('');
	  $('#fecha_inicioval4').val('');
	  $('#fecha_inicioval5').val('');
	  $('#fecha_inicioval6').val('');
	  $('#fecha_inicioval7').val('');
	  
	  $('#hora_1').val('');
	  $('#hora_2').val('');
	  $('#hora_3').val('');
	  $('#hora_4').val('');
	  $('#hora_5').val('');
	  $('#hora_6').val('');
	  $('#hora_7').val('');
	  
	  $('#motivo_1').val('');
	  $('#motivo_2').val('');
	  $('#motivo_3').val('');
	  $('#motivo_4').val('');
	  $('#motivo_5').val('');
	  $('#motivo_6').val('');
	  $('#motivo_7').val('');
	  
	  $('#quiro_id_l').val('');
	  $('#quiro_id_2').val('');
	  $('#quiro_id_3').val('');
	  $('#quiro_id_4').val('');
	  $('#quiro_id_5').val('');
	  $('#quiro_id_6').val('');
	  $('#quiro_id_7').val('');
	  
	/*  $('#medicompanies_1').val('');
	  $('#medicompanies_2').val('');
	  $('#medicompanies_3').val('');
	  $('#medicompanies_4').val('');
	  $('#medicompanies_5').val('');
	  $('#medicompanies_6').val('');
	  $('#medicompanies_7').val('');
	  
	  $('#copago_1').val('');
	  $('#copago_2').val('');
	  $('#copago_3').val('');
	  $('#copago_4').val('');
	  $('#copago_5').val('');
	  $('#copago_6').val('');
	  $('#copago_7').val('');
	  
	  $('#observacion_1').val('');
	  $('#observacion_2').val('');
	  $('#observacion_3').val('');
	  $('#observacion_4').val('');
	  $('#observacion_5').val('');
	  $('#observacion_6').val('');
	  $('#observacion_7').val(''); */
	  
	  
	  
	  busca_paciente();	 

	  ver_diario();
  });  

  $("#genera_registros").html("Espere un momento...");  

}



$("#fecha_inicioval1").datepicker({dateFormat: 'yy-mm-dd'});
$("#fecha_inicioval2").datepicker({dateFormat: 'yy-mm-dd'}); 
$("#fecha_inicioval3").datepicker({dateFormat: 'yy-mm-dd'});
$("#fecha_inicioval4").datepicker({dateFormat: 'yy-mm-dd'});
$("#fecha_inicioval5").datepicker({dateFormat: 'yy-mm-dd'});
$("#fecha_inicioval6").datepicker({dateFormat: 'yy-mm-dd'});
$("#fecha_inicioval7").datepicker({dateFormat: 'yy-mm-dd'});


function valida_dataagenda(ord)
{

   var str;
   str=$('input:radio[name=radio_hc]:checked').val();   

   if(str!=undefined)
   {
   var arr=str.split('|');
   }
   else
   {
    alert("Seleccione el Paciente");
	$('#usua_idvalx'+ord).val('');
	$('#fecha_inicioval'+ord).val('');
	$('#hora_'+ord).val('');
//	$('#quiro_id_'+ord).val('');
	return false;
   }

$("#valida_"+ord).load("busca_terapia.php",{
  clie_id:arr[1],
  usua_idvalx:$('#usua_idvalx'+ord).val(),
  fecha_inicioval:$('#fecha_inicioval'+ord).val(),
  hora:$('#hora_'+ord).val(),
 // quiro_id:$('#quiro_id_'+ord).val(),
  ord:ord
  
 },function(result){ 

  }); 

$("#valida_"+ord).html("...");


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




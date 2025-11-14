<?php
ini_set("session.cookie_lifetime", 36000);
ini_set("session.gc_maxlifetime", 36000);
session_start();
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET); // obtiene los nombres de las varibles
$valores = array_values($_GET); // obtiene los valores de las varibles


$director = "../../../director/";
include("../../../director/cfgclases/clases.php");


$ireport = $_POST["ireport"];

?>
<SCRIPT LANGUAGE=javascript>
	<!--
	function ejecuta_reporte() {

		if ($('#fecha_inicio').val() == '' && $('#fecha_fin').val() == '') {
			//alert("seleccione el rango de fecha");
			//return false;
		}

         if($('#usua_id').val()=='')
		{
		  alert("seleccione MEDICO USUARIO");
		  return false;
		}


		$("#ver_reporte").load("lospinos/listastandar_medicopacienteatencion.php", {
			centro_id: $('#centro_id').val(),
			clie_institucionval: $('#clie_institucionval').val(),
			fecha_inicio: $('#fecha_inicio').val(),
			fecha_fin: $('#fecha_fin').val(),
			previsual: '1',
			ireport: '<?php echo $ireport; ?>',
			clie_id: $('#clie_id').val(),
			precu_activo: $('#precu_activo').val(),
			convepr_id: $('#convepr_id').val(),
			categesp_id: $('#categesp_id').val(),
			especipr_id: $('#especipr_id').val(),
			precu_facturar: $('#precu_facturar').val(),
			usua_id:$('#usua_id').val()

		}, function(result) {

		});
		$("#ver_reporte").html("Espere un momento...");

	}

	function a_excel() {
		var fecha_inicio = $('#fecha_inicio').val();
		var fecha_fin = $('#fecha_fin').val();
		var tipopac_id = $('#tipopac_id').val();

		//window.open('lista_faltaronexel.php?fecha_inicio=' + fecha_inicio +'&fecha_fin='+fecha_fin+'&tipopac_id='+tipopac_id,'ventana1','width=750,height=500,scrollbars=YES');

	}
	//
	-->
</SCRIPT>
<style type="text/css">
	<!--
	.style1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-weight: bold;
		font-size: 11px;
	}
	-->
</style>
<?php

$reporte_pg = "select * from sth_report where rept_id=" . $ireport;
$rs_reportepg = $DB_gogess->Execute($reporte_pg);

$rept_nombre = $rs_reportepg->fields["rept_nombre"];

?>

<div align="center" class="style1"><?php echo $rept_nombre; ?></div>
<p align="center">
	<?php
	echo $rs_reportepg->fields["rept_observacion"];
	?></p>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
	<tr>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td colspan="2" bgcolor="#E6F1F2" class="style1"><div align="center">FECHA ATENCION </div></td>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td bgcolor="#E6F1F2" class="style1"></td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	  <td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
  </tr>
	<tr>

		<td bgcolor="#E6F1F2" class="style1"></td>
		<td bgcolor="#E6F1F2" class="style1">Fecha Inicio  </td>
		<td bgcolor="#E6F1F2" class="style1">Fecha fin  </td>
		<td bgcolor="#E6F1F2" class="style1"> </td>
		<td bgcolor="#E6F1F2" class="style1">MEDICO USUARIO</td>
		<td bgcolor="#E6F1F2" class="style1">TIPO COBRO </td>
		<td bgcolor="#E6F1F2" class="style1">CONVENIO/SEGURO</td>
		<td bgcolor="#E6F1F2" class="style1"></td>
		<td bgcolor="#E6F1F2" class="style1"></td>
		<td bgcolor="#E6F1F2" class="style1"></td>
		<td bgcolor="#E6F1F2" class="style1"></td>
		<td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
		<td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
		<td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
		<td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
		<td bgcolor="#E6F1F2" class="style1">&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input name="centro_id" type="hidden" id="centro_id" value="" />		</td>
		<td><input name="fecha_inicio" type="text" id="fecha_inicio"></td>
		<td><input name="fecha_fin" type="text" id="fecha_fin"></td>
		<td><input name="clie_institucionval" type="hidden" id="clie_institucionval" value="" /></td>
		<td>
			<select name="usua_id" id="usua_id" class="js-basic-single1 form-control" >
				<option value="">--seleccionar--</option>
				<?php
				$objformulario->fill_cmb("app_usuario_vistacmb", "usua_id,usua_nombre,usua_apellido", @$usua_id, " order by usua_nombre asc", $DB_gogess);
				?>
			</select>		</td>
		<td>
			
				
			<select name="clie_id" id="clie_id" class="js-basic-single2 form-control" >
				<option value="">--seleccionar--</option>
				<?php
				$objformulario->fill_cmb("cesdb_arextension.dns_tipoproceso", "tippo_id,tippo_nombre", @$clie_id, " order by tippo_nombre asc", $DB_gogess);
				?>
			</select>		</td>
		<td>
				
		<select name="precu_activo" id="precu_activo" class="js-basic-single3 form-control" >
				<option value="">--seleccionar--</option>
				<?php
				$objformulario->fill_cmb("cesdb_arextension.dns_convenios", "conve_id,conve_nombre", @$precu_activo, " order by conve_nombre asc", $DB_gogess);
				?>
			</select>		</td>

		<td>
         <input name="precu_facturar" type="hidden" id="precu_facturar" value="" />		</td>

		<td>
			<input name="categesp_id" type="hidden" id="categesp_id" value="" />
			<input name="convepr_id" type="hidden" id="convepr_id" value="" />		</td>
		<td>
			<div id="vista_especialida">
				<input name="especipr_id" type="hidden" id="especipr_id" value="" />
			</div>		</td>
		<td onclick="ejecuta_reporte()" style="cursor:pointer"><img src="prev.png" width="147" height="43" /></td>
		<td>&nbsp;</td>
		<td onclick="ver_excel()" style="cursor:pointer"><img src="excel.png" width="147" height="43" border="0" /></td>
		<td>&nbsp;</td>
		<td onclick="ver_pdf()" style="cursor:pointer"><img src="pdf.png" width="147" height="43" /></td>
	</tr>
</table>
<br><br>
<div id="ver_reporte"></div>


<p>&nbsp;</p>

<script type="text/javascript">
	<!--
	$("#fecha_inicio").datepicker({
		dateFormat: 'yy-mm-dd'
	});
	$("#fecha_fin").datepicker({
		dateFormat: 'yy-mm-dd'
	});


	$("#categesp_id").on("change", function() {
		afecta_listaespe_34();
	});

	function afecta_listaespe_34() {

		$("#vista_especialida").load("lospinos/lista_dataespe.php", {
			categesp_id: $('#categesp_id').val()
		}, function(result) {


		});

		$("#vista_especialida").html("...");

	}



	function ver_excel() {
		if ($('#fecha_inicio').val() == '' && $('#fecha_fin').val() == '') {
			//alert("seleccione el rango de fecha");
			//return false;
		}

        if($('#usua_id').val()=='')
		{
		  alert("seleccione MEDICO USUARIO");
		  return false;
		}

		location.href = "lospinos/listastandar_medicopacienteatencion.php?usua_id=" + $('#usua_id').val() + "&precu_facturar=" + $('#precu_facturar').val() + "&precu_activo=" + $('#precu_activo').val() + "&convepr_id=" + $('#convepr_id').val() + "&categesp_id=" + $('#categesp_id').val() + "&especipr_id=" + $('#especipr_id').val() + "&clie_id=" + $('#clie_id').val() + "&centro_id=" + $('#centro_id').val() + "&fecha_inicio=" + $('#fecha_inicio').val() + "&fecha_fin=" + $('#fecha_fin').val() + "&previsual=2&clie_institucionval=" + $('#clie_institucionval').val() + "&ireport=<?php echo $ireport; ?>";

	}



	function ver_pdf() {

		if ($('#fecha_inicio').val() == '' && $('#fecha_fin').val() == '') {
			//alert("seleccione el rango de fecha");
			//return false;
		}

 if($('#usua_id').val()=='')
		{
		  alert("seleccione MEDICO USUARIO");
		  return false;
		}


		window.open("lospinos/listastandar_medicopacienteatencion.php?usua_id=" + $('#usua_id').val() + "&precu_facturar=" + $('#precu_facturar').val() + "&precu_activo=" + $('#precu_activo').val() + "&convepr_id=" + $('#convepr_id').val() + "&categesp_id=" + $('#categesp_id').val() + "&especipr_id=" + $('#especipr_id').val() + "&clie_id=" + $('#clie_id').val() + "&centro_id=" + $('#centro_id').val() + "&fecha_inicio=" + $('#fecha_inicio').val() + "&fecha_fin=" + $('#fecha_fin').val() + "&previsual=3&clie_institucionval=" + $('#clie_institucionval').val() + "&ireport=<?php echo $ireport; ?>", '_blank');

	}


$('.js-basic-single1').select2();

$('.js-basic-single2').select2();

$('.js-basic-single3').select2();




	//  End 
	-->
</script>
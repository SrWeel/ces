<script language="javascript">
	<!--
	//
	-->

</script>
<?php

$ver_boton = 1;
//---ENLACE
$valoralet = mt_rand(1, 50000);
$aletorioid = $_SESSION['ces1313777_sessid_cedula'] . date("Ymdhis") . $valoralet;
//----		

$enlace_general = $rs_datosmenu->fields["mnupan_campoenlace"] . "x";
$objformulario->sendvar["fechax"] = date("Y-m-d H:i:s");
$objformulario->sendvar[$enlace_general] = @$_SESSION['ces1313777_sessid_emp_id'];
$objformulario->sendvar["horax"] = date("h:i:s");
$objformulario->sendvar["usuar_idx"] = @$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"] = 0;
$objformulario->sendvar["usua_idx"] = $_POST["pVar2"];
$objformulario->sendvar["codex"] = $aletorioid;
$objformulario->sendvar["centro_idx"] = $_SESSION['ces1313777_centro_id'];
$objformulario->sendvar["hcx"] = $rs_dcliente->fields["usua_ciruc"];
$objformulario->sendvar["atenc_fechaingresox"] = date("Y-m-d");

//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];
$valoralet = mt_rand(1, 500);
$aletorioid = '01' . @$_SESSION['ces1313777_sessid_cedula'] . $_SESSION['ces1313777_sessid_inicio'] . date("Ymdhis") . $valoralet;
$objformulario->sendvar["asigextr_enlacex"] = $aletorioid;

//echo getcwd();
echo $botonenvio;
?>


<div class="form-group">
	<div class="col-md-7">
		<?php
		$objformulario->generar_formulario(@$submit, $table, 1, $DB_gogess);
		?>
	</div>
	<div class="col-md-4">
		<button type="button" class="mb-sm btn btn-success" onclick="listado_facturas();">CARGA FACTURAS Y VALORES</button>

		<br />
		<br />
		<div id="div_listfact"></div>
	</div>

</div>
<?php
echo $botonenvio;
?>
<div class="form-group">
	<div class="col-md-8">
		<?php
		if ($csearch) {
			$objformulario->generar_formulario(@$submit, $table, 2, $DB_gogess);
		}
		?>
	</div>
</div>
<div class="form-group">
	<div class="col-md-8">
		<?php
		if ($csearch) {
			$objformulario->generar_formulario(@$submit, $table, 3, $DB_gogess);
		}
		?>
	</div>
</div>
<?php
if ($csearch) {
	$valoropcion = 'actualizar';
} else {
	$valoropcion = 'guardar';
}
echo "<input name='csearch' type='hidden' value=''>
<input name='idab' type='hidden' value=''>
<input name='opcion_" . $table . "' type='hidden' value='" . $valoropcion . "' id='opcion_" . $table . "' >
<input name='table' type='hidden' value='" . $table . "'>";
?>

<div id=div_<?php echo $table ?>> </div>
<div id="divBody_informes"></div>
<div id="divBody_buscadorgeneral"></div>

<script>
	$("#asigextr_fechasolicitud").datepicker({
		dateFormat: 'yy-mm-dd'
	});
	$("#asigextr_fechaaprobacion").datepicker({
		dateFormat: 'yy-mm-dd'
	});
</script>

<script type="text/javascript">
	<!--
	function listado_facturas() {

		if ($('#asigextr_id').val() == '') {
			alert("Para agregar facturas debe guardar el registro");
			return false;
		}

		if ($('#asigextr_fechaaprobacion').val() == '') {
			alert("Porfavor ingrese la fecha aprobacion para poder sacar las facturas del mes");
			return false;
		}

		$("#div_listfact").load("templateformsweb/maestro_standar_vextras/facturas/lista.php", {
			usua_id: $('#usua_id').val(),
			asigextr_fechaaprobacion: $('#asigextr_fechaaprobacion').val(),
			asigextr_id: $('#asigextr_id').val()

		}, function(result) {



		});
		$("#div_listfact").html("Espere un momento...");

	}




	function buscar_dataform(id) {

		abrir_standar('templateformsweb/maestro_standar_rubros/buscadorform/busca_data.php', 'Buscador', 'divBody_buscadorgeneral', 'divDialog_buscadorgeneral', 550, 500, id, 0, 0, 0, 0, 0, 0);

	}

	function envia_valor() {

		$('#asigextr_valor').val($('#gpago').val());


	}

	if ($('#asigextr_fechaaprobacion').val() != '') {
		listado_facturas();
	}


	//  End 
	-->
</script>
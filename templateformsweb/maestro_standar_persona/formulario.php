<?php



$enlace_general = $rs_datosmenu->fields["mnupan_campoenlace"] . "x";

$objformulario->sendvar["fechax"] = date("Y-m-d H:i:s");

$objformulario->sendvar[$enlace_general] = @$_SESSION['ces1313777_sessid_emp_id'];

$objformulario->sendvar["horax"] = date("H:i:s");

$objformulario->sendvar["usua_idx"] = @$_SESSION['ces1313777_sessid_inicio'];

$objformulario->sendvar["usr_tpingx"] = 0;
$objformulario->sendvar["centro_idx"] = $_SESSION['ces1313777_centro_id'];
//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];


$codig_unicovalor = '';
$unico_number = '';
$unico_number = strtoupper(uniqid());
$codig_unicovalor = date("Y-m-d") . $_SESSION['ces1313777_sessid_inicio'] . $unico_number;

$objformulario->sendvar["cuentb_enlacex"] = $codig_unicovalor;


$objformulario->generar_formulario(@$submit, $table, 1, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 2, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 3, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 4, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 5, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 6, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 7, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 8, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 9, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 10, $DB_gogess);



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
<br />
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<div align="center">
				<input type="button" class="mb-sm btn btn-primary" style="background-color:#000066" name="Submit" value="VER ESTADO DE CUENTA COMPRAS VENTAS" onclick="despliega_link('templateformsweb/maestro_standar_persona/lista_estadocuenta.php')" />
			</div>
		</td>
		<td>&nbsp;</td>
		<td><input type="button" class="mb-sm btn btn-primary" style="background-color:#000066" name="Submit2" value="COMPRAS EXCEL" onclick="despliega_link('templateformsweb/maestro_standar_persona/lista_estadocuentacompras.php')" /></td>
		<td>&nbsp;</td>
		<td><input type="button" class="mb-sm btn btn-primary" style="background-color:#000066" name="Submit22" value="VENTAS EXCEL" onclick="despliega_link('templateformsweb/maestro_standar_persona/lista_estadocuentaventas.php')" /></td>
		<td>&nbsp;</td>

		<td><input type="button" class="mb-sm btn btn-primary" style="background-color:#000066" name="Submit2" value="COMPRAS VER" onclick="despliega_link('templateformsweb/maestro_standar_persona/lista_estadocuentacomprasver.php')" /></td>
		<td>&nbsp;</td>
		<td><input type="button" class="mb-sm btn btn-primary" style="background-color:#000066" name="Submit22" value="VENTAS VER" onclick="despliega_link('templateformsweb/maestro_standar_persona/lista_estadocuentaventasver.php')" /></td>
		<td>&nbsp;</td>
	</tr>
</table>
<br />

<div id=div_<?php echo $table ?>> </div>
<div id="divBody_buscadorgeneral"></div>

<script type="text/javascript">
	<!--
	function buscar_dataform(id) {

		abrir_standar('templateformsweb/maestro_standar_persona/buscadorform/busca_data.php', 'Buscador', 'divBody_buscadorgeneral', 'divDialog_buscadorgeneral', 550, 500, id, 0, 0, 0, 0, 0, 0);

	}

	function crear_dataform(id, valor) {

		abrir_standar('templateformsweb/maestro_standar_persona/crearform/formulario.php', 'New', 'divBody_buscadorgeneral', 'divDialog_buscadorgeneral', 550, 500, id, valor, 0, 0, 0, 0, 0);

	}



	//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

	<?php
	echo $rs_tabla->fields["tab_codigo"];
	?>


	//  End 
	-->
</script>
<?php
echo $objformulario->generar_formulario_cfechas($table, $DB_gogess);

?>



<?php
if ($table == 'lpin_plancuentas') {
	//===================================

	if ($csearch) {

		$busca_usado = "select count(*) as total from lpin_detallecomprobantecontable_vista where detcc_cuentacontable='" . $objformulario->contenid["planc_codigoc"] . "'";
		$rs_busado = $DB_gogess->executec($busca_usado);

		echo "Usado en: " . $rs_busado->fields["total"];

		if ($rs_busado->fields["total"] > 0) {
?>

			<script type="text/javascript">
				<!--
				$('#boton_guardarformdata').hide();
				$('#boton_guardarformdata2').hide();

				//  End 
				-->
			</script>


<?php
		}
	}


	//==================================
}

?>

<script type="text/javascript">
	<!--
	$("#planc_codigoc").on("change", function() {

		ver_sitienevalor();

	});

	function ver_sitienevalor() {

		$("#valida_cuenta").load("templateformsweb/maestro_standar_persona/valida_cuenta.php", {
			planc_codigoc: $('#planc_codigoc').val()
		}, function(result) {


		});
		$("#valida_cuenta").html("Espere un momento...");

	}
	//  End 
	-->
</script>

<div id="valida_cuenta"></div>

<SCRIPT LANGUAGE=javascript>
	<!--
	function despliega_link(url) {
		window.document.form_app_proveedor.action = url;
		window.document.form_app_proveedor.target = '_blank';
		window.document.form_app_proveedor.submit();
		window.document.form_app_proveedor.target = '_top';
	}
	$('#tipop_id').addClass('form-control');
	$('#provee_ruc').addClass('form-control');
	$('#provee_cedula').addClass('form-control');
	$('#provee_nombre').addClass('form-control');
	$('#provee_direccion').addClass('form-control');
	$('#provee_nombrecomercial').addClass('form-control');
	$('#provee_representante').addClass('form-control');
	$('#provee_telefono').addClass('form-control');
	$('#provee_email').addClass('form-control');
	$('#provee_cespecial').addClass('form-control');

	//
	-->
</SCRIPT>

<script type="text/javascript">
	<!--
	$('#provee_cuentag').select2();
	$('#provee_acfijo').select2();
	//  End 
	-->
</script>
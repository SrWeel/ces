<?php

if ($lq_data == 1) {

	echo '<div class="alert alert-info"><b><span style="color:#CC3300">!!! AVISO, USTED ESTA CREANDO UNA LIQUIDACION DE COMPRAS ELECTRONICA</span> </b></div>';
}

$enlace_general = $rs_datosmenu->fields["mnupan_campoenlace"] . "x";
$objformulario->sendvar["fechax"] = date("Y-m-d H:i:s");
$objformulario->sendvar[$enlace_general] = @$_SESSION['ces1313777_sessid_emp_id'];
$objformulario->sendvar["horax"] = date("H:i:s");
$objformulario->sendvar["usua_idx"] = @$_SESSION['ces1313777_sessid_inicio'];
$objformulario->sendvar["usr_tpingx"] = 0;
$objformulario->sendvar["centro_idx"] = $_SESSION['ces1313777_centro_id'];
$objformulario->sendvar["emp_idx"] = $_SESSION['ces1313777_sessid_emp_id'];

$objformulario->sendvar["solofechax"] = date("Y-m-d");

$objformulario->sendvar["tipom_idx"] = 1;
$objformulario->sendvar["tipomov_idx"] = 17;

$codig_unicovalor = '';
$unico_number = '';
$unico_number = strtoupper(uniqid());
$codig_unicovalor = date("Y-m-d") . $_SESSION['ces1313777_sessid_inicio'] . $unico_number;

$objformulario->sendvar["compra_numeroprocesox"] = $codig_unicovalor;
$objformulario->sendvar["compra_enlacex"] = $codig_unicovalor;


if ($lq_data == 1 or $objformulario->contenid["tipdoc_id"] == '19') {

	$objformulario->sendvar["tipdoc_idx"] = 19;
	$objformulario->sendvar["compra_nfacturax"] = '999-999-999999999';
	$objformulario->sendvar["compra_fechax"] = date("Y-m-d");
}

//$objformulario->sendvar["usr_usuarioactivax"]=$_SESSION['ces1313777_sessid_inicio'];

?>
<?php
$compra_procesado = 0;
if ($csearch) {
	$busca_ccerradap = "select * from dns_compras where compra_id='" . $csearch . "'";
	$rs_ccerrado = $DB_gogess->executec($busca_ccerradap, array());

	$compra_procesado = $rs_ccerrado->fields["compra_procesado"];
	$compra_estadosri = $rs_ccerrado->fields["compra_estadosri"];
}

//busca cobro pago
$busca_cp = "select count(*) as totalcobro from  lpin_comprobantecontable inner join lpin_detallecomprobantecontable on lpin_comprobantecontable.comcont_enlace=lpin_detallecomprobantecontable.comcont_enlace   where comcont_tablas='dns_compras' and  comcont_idtablas='" . $objformulario->contenid["compra_id"] . "' and comcont_tabla in ('lpin_cobropago','lpin_crucedocumentos')";
$xml_cp = $DB_gogess->executec($busca_cp, array());

$hay_cobropago = '';
$hay_cobropago = $xml_cp->fields["totalcobro"];

//echo $hay_cobropago;

//busca cobro pago


//echo $compra_procesado;
if ($compra_procesado == 1) {
	echo "<span style='color:#990000' ><center><b>COMPRA YA PROCESADA EN BODEGA NO PUEDE SER MODFICADO</b></center></span>";

	$objformulario->bloqueo_valor = 1;
}


if ($compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
	echo "<span style='color:#990000' ><center><b>LIQUIDACION DE COMPRA ESTA AUTORIZADA o RECIBIDA</b></center></span>";

	$objformulario->bloqueo_valor = 1;
}

$busca_xmlexistentex = "select compretcab_estadosri from comprobante_retencion_cab where compretcab_anulado!='1' and compra_id='" . $objformulario->contenid["compra_id"] . "'";
$rs_xmlexternox = $DB_gogess->executec($busca_xmlexistentex, array());
$xml_sri = $rs_xmlexternox->fields["compretcab_estadosri"];

if ($hay_cobropago > 0) {
	$objformulario->bloqueo_valor = 1;
}

if ($xml_sri == 'AUTORIZADO' or $xml_sri == 'RECIBIDA' or $hay_cobropago > 0 or $compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
?><fieldset disabled>
	<?php
}
	?>
	<hr />
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 2, $DB_gogess);
	?>
	<center>
		<input type="button" name="Submit" value="CARGAR XML" onclick="leer_xml()" class="btn btn-default">&nbsp;&nbsp;&nbsp;<input type="button" name="Submit" value="VER DETALLES XML" onclick="verdetalles_xml()" class="btn btn-default">
	</center>
	<div id="procesa_xml"></div>

	<hr />
	<?php
	$objformulario->generar_formulario(@$submit, $table, 1, $DB_gogess);
	?>
	<div id="validaruc_data" style="color:#FF0000; font-weight:bold"></div>

	<hr />
	<?php
	if ($csearch) {
		if ($objformulario->contenid["tipdoc_id"] == 1) {
			$busca_nc = "select * from dns_compras where tipdoc_id in (9,10) and proveevar_id='" . $objformulario->contenid["proveevar_id"] . "' and compra_nummodif='" . $objformulario->contenid["compra_nfactura"] . "' and compra_autmodi='" . $objformulario->contenid["compra_autorizacion"] . "' and compra_anulado=0";

			$rs_ncx = $DB_gogess->executec($busca_nc, array());

			if ($rs_ncx) {
				while (!$rs_ncx->EOF) {

					echo "<b>NOTA: ESTA FACTURA TIENE UNA NOTA DE CREDITO</b><br>";
					echo "<b>NOTA DE CREDITO No: </b>" . $rs_ncx->fields["compra_nfactura"] . "<br>";
					echo "<b>VALOR: </b>" . $rs_ncx->fields["compra_total"] . "<br>";

					$rs_ncx->MoveNext();
				}
			}
		}
	}

	?>
	<div id="nc_credito">
		<center><b>SE LLENARA SI ES NOTA DE CREDITO</b></center>
		<?php
		$objformulario->generar_formulario(@$submit, $table, 16, $DB_gogess);
		?>
		<input type="button" name="Submit" value="CARGAR DATOS NC" onclick="leer_xmlnc()" class="btn btn-default">
	</div>
	<hr />
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 3, $DB_gogess);
	?>

	<hr />
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 4, $DB_gogess);
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 5, $DB_gogess);
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 6, $DB_gogess);
	?>
	<?php
	if ($xml_sri == 'AUTORIZADO' or $xml_sri == 'RECIBIDA' or $hay_cobropago > 0 or $compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
	?>
	</fieldset>
<?php
	}
?>


	<div class="row">

	<div id="div_panelprecuenta" class="col-sm-1">
		<div id="precuentapanel_btn">
			<div onClick="crear_dataformcobropagoc($('#compra_id').val(),'2')" style="cursor:pointer"><img src="images/cobropago.png" width="60px"></div>
		</div>
	</div>

	<div id="div_panelcruze" class="col-sm-1">
		<div id="crucepanel_btn">
			<div onClick="crear_dataformcruce($('#compra_id').val(),'2')" style="cursor:pointer"><img src="images/cruce.png" width="60px"></div>
		</div>
	</div>


	<div id="div_pdf" class="col-sm-1">
		<div onClick="ver_pdf($('#compra_id').val(),$('#tipdoc_id').val())" style="cursor:pointer"><img src="images/pdf.png" width="60px"></div>
		<div id="procesa_pdfxml"></div>
	</div>

	<div id="div_xml" class="col-sm-1">
		<div onClick="ver_xml($('#compra_id').val(),$('#tipdoc_id').val())" style="cursor:pointer"><img src="images/xml.png" width="60px"></div>
	</div>

	<div id="div_panelsri" class="col-sm-1">
		<div id="sripanel_btn">
			<div onClick="verpanel_sri1()" style="cursor:pointer"><img src="images/sri_panel.png" width="60px"></div>
		</div>
	</div>



	<div id="div_panelascontable" class="col-sm-1">
		<div id="ascontable_btn">
			<div onClick="ver_asientoccompra($('#doccab_id').val())" style="cursor:pointer"><img src="images/ascontable.png" width="60px">
			</div>
		</div>
	</div>


</div>

<br /><br /><br />

<input type="button" name="btn_productos_id" id="btn_productos_id" value="PRODUCTOS" onclick="ocultar_mostrar3('productos_id')" />
<input type="button" name="btn_cuentas_id" id="btn_cuentas_id" value="CUENTAS" onclick="ocultar_mostrar3('cuentas_id')" />
<input type="button" name="btn_fpago_id" id="btn_fpago_id" value="FORMA DE PAGO" onclick="ocultar_mostrar3('fpago_id')" />
<input type="button" name="btn_afijo_id" id="btn_afijo_id" value="ACTIVOS FIJOS" onclick="ocultar_mostrar3('afijo_id')" />
<input type="button" name="btn_retenciones_id" id="btn_retenciones_id" value="RETENCIONES" onclick="ocultar_mostrar3('retenciones_id')" />

<div id="productos_id">
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 7, $DB_gogess);
	?>
</div>
<div id="cuentas_id">
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 8, $DB_gogess);
	?>
</div>

<div id="fpago_id">
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 9, $DB_gogess);
	?>
</div>

<div id="afijo_id">
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 10, $DB_gogess);
	?>
</div>

<div id="retenciones_id">
	<?php
	$objformulario->generar_formulario_bootstrap(@$submit, $table, 14, $DB_gogess);
	?>

</div>


<?php
if ($xml_sri == 'AUTORIZADO' or $xml_sri == 'RECIBIDA' or $hay_cobropago > 0 or $compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
?>
	<fieldset disabled>
	<?php
}

echo "<center><div id='despliega_desglo'>";

if ($objformulario->contenid["compra_enlace"] != '') {
	$compra_enlacexy = $objformulario->contenid["compra_enlace"];
} else {
	$compra_enlacexy = $codig_unicovalor;
}

$lista_valorxy = array();

$lista_detallesxy = "select sum(prcomp_subtotal) as total,prcomp_taricodigo  from lpin_productocompra where compra_enlace='" . $compra_enlacexy . "' group by prcomp_taricodigo";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy, array());
if ($rs_dataxy) {
	while (!$rs_dataxy->EOF) {

		@$lista_valorxy[$rs_dataxy->fields["prcomp_taricodigo"]] = $lista_valorxy[$rs_dataxy->fields["prcomp_taricodigo"]] + $rs_dataxy->fields["total"];

		$rs_dataxy->MoveNext();
	}
}


$lista_detallesxy = "select sum(cuecomp_subtotal) as total,taric_id  from lpin_cuentacompra where compra_enlace='" . $compra_enlacexy . "' group by taric_id";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy, array());
if ($rs_dataxy) {
	while (!$rs_dataxy->EOF) {

		$sacatari = "select * from beko_tarifa where tari_id='" . $rs_dataxy->fields["taric_id"] . "'";
		$rs_sacatar = $DB_gogess->executec($sacatari, array());
		$tari_codigo = $rs_sacatar->fields["tari_codigo"];

		@$lista_valorxy[$tari_codigo] = $lista_valorxy[$tari_codigo] + $rs_dataxy->fields["total"];

		$rs_dataxy->MoveNext();
	}
}


$lista_detallesxy = "select sum(acfi_subtotal) as total,tarif_id  from dns_activosfijos where compra_enlace='" . $compra_enlacexy . "' group by tarif_id";
$rs_dataxy = $DB_gogess->executec($lista_detallesxy, array());
if ($rs_dataxy) {
	while (!$rs_dataxy->EOF) {

		$sacatari = "select * from beko_tarifa where tari_id='" . $rs_dataxy->fields["tarif_id"] . "'";
		$rs_sacatar = $DB_gogess->executec($sacatari, array());
		$tari_codigo = $rs_sacatar->fields["tari_codigo"];

		@$lista_valorxy[$tari_codigo] = $lista_valorxy[$tari_codigo] + $rs_dataxy->fields["total"];

		$rs_dataxy->MoveNext();
	}
}

//print_r($lista_valorxy);
$concatena_desglo = ' ';

$lista_bitar = "select tari_codigo,tari_nombre from beko_tarifa";
$rs_databitar = $DB_gogess->executec($lista_bitar, array());
if ($rs_databitar) {
	while (!$rs_databitar->EOF) {

		if (@$lista_valorxy[$rs_databitar->fields["tari_codigo"]] > 0) {
			// $concatena_desglo.= '<div class="form-group"><div class="col-xs-3" align="right">Subtotal '.$rs_databitar->fields["tari_nombre"].': </div><div class="col-xs-7" style="text-align:left" >'.$lista_valorxy[$rs_databitar->fields["tari_codigo"]].'</div><div class="col-xs-1"></div><div class="col-xs-1"></div></div> </div>';

			$concatena_desglo .= ' <br>';
			$concatena_desglo .= ' Subtotal ' . $rs_databitar->fields["tari_nombre"] . ': ';
			$concatena_desglo .= ' ' . $lista_valorxy[$rs_databitar->fields["tari_codigo"]] . '<br>';
			$concatena_desglo .= ' ';
			$concatena_desglo .= ' <br>';
		}

		$rs_databitar->MoveNext();
	}
}

$concatena_desglo .= ' ';

echo $concatena_desglo;

echo "</div></center>";

$objformulario->generar_formulario_bootstrap(@$submit, $table, 11, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 12, $DB_gogess);
$objformulario->generar_formulario_bootstrap(@$submit, $table, 13, $DB_gogess);

if ($xml_sri == 'AUTORIZADO' or $xml_sri == 'RECIBIDA' or $hay_cobropago > 0 or $compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
	?>
	</fieldset>
<?php
}
?>


<?php
$objformulario->generar_formulario_bootstrap(@$submit, $table, 15, $DB_gogess);
?>
<center>
	<input type="button" name="Submit2" value="GUARDAR DESCRIPCION" onclick="guardardesc_xml()" />
	<div id="procesa_gu"></div>
</center>
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

<input type="button" name="Submit2" value="GENERAR ASIENTO" onclick="genera_asientocompra()" />

<div id="divBody_proveedor"></div>

<div id="divBody_listadetalles"></div>

<script type="text/javascript">
	<!--
	function ver_asientoccompra() {
		if ($('#compra_id').val() != '') {
			myWindow3 = window.open('pdfasientos/pdfasientocompra.php?xml=' + $('#compra_id').val(), 'ventana_asientocontablecompra', 'width=850,height=700,scrollbars=YES');
			myWindow3.focus();
		} else {
			alert("Por favor guarde el resgistro para ver el asiento contable");
		}
	}



	//$( "#usua_fechaingrero" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#horae_desde" ).datepicker({dateFormat: 'yy-mm-dd'});
	//$( "#horae_hasta" ).datepicker({dateFormat: 'yy-mm-dd'});

	<?php
	echo $rs_tabla->fields["tab_codigo"];
	?>


	function guardardesc_xml() {

		$("#procesa_gu").load("templateformsweb/maestro_standar_compras/guarda_desc.php", {
			compra_id: $('#compra_id').val(),
			compra_descripcion: $('#compra_descripcion').val(),
			compra_parainv: $('#compra_parainv').val()
		}, function(result) {


		});

		$("#procesa_gu").html("Espere un momento...");

	}



	function leer_xml() {
		if ($('#compra_xml').val() == '') {
			alert("Subir xml al sistema para procesar");
			return false;
		}

		$("#procesa_xml").load("templateformsweb/maestro_standar_compras/procesa_xml.php", {
			compra_xml: $('#compra_xml').val(),
			compra_enlace: $('#compra_enlace').val()
		}, function(result) {

        grid_extras_9823($('#compra_enlace').val(),0,0);

		});

		$("#procesa_xml").html("Espere un momento...");

	}

	function leer_xmlnc() {
		if ($('#compra_xml').val() == '') {
			alert("Subir xml al sistema para procesar");
			return false;
		}

		$("#procesa_xml").load("templateformsweb/maestro_standar_compras/procesanc_xml.php", {
			compra_xml: $('#compra_xml').val()
		}, function(result) {


		});

		$("#procesa_xml").html("Espere un momento...");

	}



	//$('#proveevar_id_despliegue').html("<table cellspacing='2' border='0'><tbody><tr><td onclick='buscar_proveedor_actualizar()' style='cursor:pointer'><img src='images/moreedit.png' width='20' height='18'></td></tr> </tbody></table>");


	function buscar_proveedor_actualizar() {

		abrir_standar("templateformsweb/maestro_standar_compras/proveedor_d/grid_nuevo_proveedor.php", "Proveedor", "divBody_proveedor", "divDialog_proveedor", 750, 450, 0, $('#proveevar_id').val(), 0, 0, 0, 0, 0);

	}

	function verdetalles_xml() {

		abrir_standar("templateformsweb/maestro_standar_compras/detallesxml/panel_lista.php", "Proveedor", "divBody_listadetalles", "divDialog_listadetalles", 850, 450, 0, $('#compra_claveacceso').val(), 0, 0, 0, 0, 0);


	}

	function actualiza_despuesg() {
		actualiza_cmb1();
		//$('#proveevar_id').val($('#provee_id').val());
	}


	function actualiza_cmb1() {

		$("#cmb_proveevar_id").load("templateformsweb/maestro_standar_compras/proveedor_d/cmb_proveedor.php", {

		}, function(result) {
			//alert($('#provee_id').val());
			$('#proveevar_id').val($('#provee_id').val());

		});

		$("#cmb_proveevar_id").html("...");

	}

	function ocultar_mostrar3(muestra) {

		$('#productos_id').hide();
		cambio_inactivo('productos_id', 0);
		$('#cuentas_id').hide();
		cambio_inactivo('cuentas_id', 0);
		$('#fpago_id').hide();
		cambio_inactivo('fpago_id', 0);
		$('#afijo_id').hide();
		cambio_inactivo('afijo_id', 0);
		$('#retenciones_id').hide();
		cambio_inactivo('retenciones_id', 0);

		$('#' + muestra).show();
		cambio_inactivo(muestra, 1);

	}

	ocultar_mostrar3('productos_id');

	function cambio_inactivo(divdata, opcion) {
		if (opcion == 0) {
			$('#btn_' + divdata).css('background-color', '#C5E0EB');
			$('#btn_' + divdata).css('color', '#000000');
			$('#btn_' + divdata).css('border', '#000000');
			$('#btn_' + divdata).css('border', 'solid');
			$('#btn_' + divdata).css('border-width', 'thin');
		} else {
			$('#btn_' + divdata).css('background-color', '#000033');
			$('#btn_' + divdata).css('color', '#FFFFFF');
			$('#btn_' + divdata).css('border', '#000000');
			$('#btn_' + divdata).css('border', 'solid');
			$('#btn_' + divdata).css('border-width', 'thin');
		}
	}


	function buscar_dataform(id) {

		abrir_standar('templateformsweb/maestro_standar_compras/buscadorform/busca_data.php', 'Buscador', 'divBody_buscadorgeneral', 'divDialog_buscadorgeneral', 550, 500, id, 0, 0, 0, 0, 0, 0);

	}

	function crear_dataform(id, valor) {

		abrir_standar('templateformsweb/maestro_standar_compras/crearform/formulario.php', 'New', 'divBody_buscadorgeneral', 'divDialog_buscadorgeneral', 550, 500, id, valor, 0, 0, 0, 0, 0);

	}




	$("#compra_anulado").click(function() {
		actualiza_anulado();
	});

	function actualiza_anulado() {
		if ($('#compra_id').val() == '') {
			alert("Para anular una compra debe estar guardado el registro...");
			$('#compra_anulado').prop('checked', false);
			return false;
		}

		$("#anula_data").load("templateformsweb/maestro_standar_compras/anula.php", {
			compra_id: $('#compra_id').val(),
			anulado: $('input:checkbox[name=compra_anulado]:checked').val()
		}, function(result) {
			//alert($('#provee_id').val());


		});

		$("#anula_data").html("...");

	}



	function verdetallesret_xml() {

		if ($('#compra_id').val() == '') {
			alert("Para generar la retencion el documento se debe guardar");
			return false;
		}

		abrir_standar("templateformsweb/maestro_standar_compras/detallesxml/panelret_lista.php", "GENERAR_RETENCION", "divBody_listadetalles", "divDialog_listadetalles", 850, 450, 0, $('#compra_id').val(), 0, 0, 0, 0, 0);


	}



	function crear_dataformcruce(doccab_id, tipo) {
		//1 cobro
		//2 pago
		if ($('#compra_id').val() == '') {
			alert("Guarde el registro para registrar el pago");
			return false;
		}

		abrir_standar('templateformsweb/maestro_standar_compras/crearformcruce/formulario.php', 'New', 'divBody_cobropago', 'divDialog_cobropago', 900, 700, doccab_id, tipo, 0, 0, 0, 0, 0);

	}


	function crear_dataformcobropagoc(doccab_id, tipo) {
		//1 cobro
		//2 pago
		if ($('#compra_id').val() == '') {
			alert("Guarde el registro para registrar el pago");
			return false;
		}

		abrir_standar('templateformsweb/maestro_standar_compras/crearformobropago/formulario.php', 'New', 'divBody_cobropago', 'divDialog_cobropago', 900, 700, doccab_id, tipo, 0, 0, 0, 0, 0);

	}

	<?php
	if ($objformulario->bloqueo_valor == 1 or $xml_sri == 'AUTORIZADO' or $xml_sri == 'RECIBIDA' or $hay_cobropago > 0 or $compra_estadosri == 'AUTORIZADO' or $compra_estadosri == 'RECIBIDA') {
	?>
		$('#boton_guardarformdata2').hide();
	<?php
	}
	?>


	function kotoba() {

		var alerta_msg;
		alerta_msg = '';
		if ($("#compra_autorizacion").val().length > 49) {
			alerta_msg = "<span style='color:#FF0000'>Error</span>";
		}

		$("#compra_autorizacion_despliegue").html("<b>" + $("#compra_autorizacion").val().length + " NUM " + alerta_msg + "</b>"); //Detectamos los Caracteres del Input

	}


	$("#compra_autorizacion").on("keyup", function() {
		kotoba();
	});

	kotoba();



	function verifica_guardado() {
		//alert($('#compra_enlace').val());  
		if ($('#compra_enlace').val() == '') {
			alert("Porfavor su red esta con problemas de enlace, no salga de esta pantalla e informe al administrador");
			return false;
		}

		$("#verifica_guardado").load("templateformsweb/maestro_standar_compras/verifica_guadado.php", {
			compra_enlace: $('#compra_enlace').val()

		}, function(result) {
			//alert($('#provee_id').val());

			setTimeout(function() {
				$('#verifica_guardado').fadeIn();
			}, 1);

			setTimeout(function() {
				$('#verifica_guardado').fadeOut();
			}, 14000);


		});

		$("#verifica_guardado").html("...");

	}




	function si_cncreidto() {
		if ($("#tipdoc_id").val() == '9' || $("#tipdoc_id").val() == '8') {
			$('#nc_credito').show();
		} else {
			$('#nc_credito').hide();
		}

	}


	$("#tipdoc_id").change(function() {
		si_cncreidto();
		busca_siesruc()
	});

	si_cncreidto();


	function busca_siesruc() {

		if ($('#proveevar_id').val() == '') {
			alert("Porfavor seleccione PERSONA");
			return false;
		}

		$("#validaruc_data").load("templateformsweb/maestro_standar_compras/busca_siesruc.php", {
			proveevar_id: $('#proveevar_id').val(),
			tipdoc_id: $('#tipdoc_id').val()
		}, function(result) {



		});
		$("#validaruc_data").html("...");


	}

	busca_siesruc();

	function guardar_camposgridpc(tabla, campo, id, valor, campoidtabla) {

		$("#campog_valorproceso1").load("templateformsweb/maestro_standar_compras/guarda_camposgrid.php", {

			tabla: tabla,
			campo: campo,
			id: id,
			valor: valor,
			campoidtabla: campoidtabla

		}, function(result) {

			genera_asientocompra();
		});

		$("#campog_valorproceso1").html("Espere un momento...");

	}




	function generar_clave_acceso() {

		$("#g_claveacceso").load("templateformsweb/maestro_standar_compras/gclavedeacceso.php", {

			doccab_id: $('#compra_id').val()

		}, function(result) {

			$('#compra_claveacceso').val($('#gclaveacceso').val());
			$('#compra_autorizacion').val($('#gclaveacceso').val());
			$('#despliegue_compra_autorizacion').html($('#gclaveacceso').val());
			$('#despliegue_compra_claveacceso').html($('#gclaveacceso').val());

			$('#compra_nfactura').html($('#nsecuenv2').val());
			$('#compra_nfactura').val($('#nsecuenv2').val());

			$('#despliegue_compra_nfactura').html($('#nsecuenv2').val());
			genera_xml();

		});
		$("#g_claveacceso").html("Espere un momento...");
	}


	function genera_xml() {

		$("#genera_xml").load("templateformsweb/maestro_standar_compras/generar_xml.php", {

			enlace: $('#compra_id').val()

		}, function(result) {

			//activa_desactiva();
			//$('#genera_xmlfirmado').html("");
			//$('#guarda_firma').html("");
			//activa_proceso();

		});



		$("#genera_xml").html("Espere un momento...");


	}


	function activa_boton() {

		$('#div_pdf').show();
		$('#div_xml').show();
		$('#div_panelsri').show();

	}

	function oculta_boton() {
		$('#div_pdf').hide();
		$('#div_xml').hide();
		$('#div_panelsri').hide();

	}






	function ver_pdf(idfactura, opcion) {
		$('#procesa_pdfxml').html("Procesando...");
		<?php
		if ($compra_estadosri != 'AUTORIZADO' and $compra_estadosri != 'RECIBIDA') {
		?>
			grid_extras_9652($('#compra_enlace').val(), 0, 0);
			grid_extras_9654($('#compra_enlace').val(), 0, 0);
			grid_extras_9901($('#compra_enlace').val(), 0, 0);

			$('#procesa_pdfxml').html("Procesando...");
		<?php
		}
		?>


		if (opcion == '19') {
			setTimeout(
				function() {
					window.location.href = 'pdflq/pdf.php?xml=' + idfactura;
					$('#procesa_pdfxml').html("");
				}, 6000);

		}


	}




	function ver_xml(idfactura, opcion) {

		if (opcion == '19') {
			window.location.href = 'xmllq/ver.php?xml=' + idfactura;
		}

	}


	function verpanel_sri1() {

		abrir_standar("templateformsweb/maestro_standar_compras/srilq.php", "SRI", "divBody_insumolq", "divDialog_insumolq", 450, 280, $('#compra_id').val(), 0, 0, 0, 0, 0, 0);


	}


	function firma_directalq(idfactura) {

		if ($('#compra_nfactura').val() != '999-999-999999999') {

			//=============================================
			$("#area_srilq").load("sdk/firma_directalq.php", {
				compra_id: $('#compra_id').val()
			}, function(result) {

			});
			$("#area_srilq").html("Espere un momento...");
			//================================================

		} else {
			alert('Porfavor guarde la factura para poder firmarla');
		}

	}

	//=====================================

	function enviar_srilq(compra_id) {


		$("#area_srilq").load("sdk/envio_srifaclq.php", {
			compra_id: compra_id
		}, function(result) {});

		$("#area_srilq").html("Espere un momento...");


	}

	//=====================================

	function obtener_srilq(compra_id) {

		$("#area_srilq").load("sdk/autoriza_srifaclq.php", {
			compra_id: compra_id
		}, function(result) {});

		$("#area_srilq").html("Espere un momento...");

	}


	function enviar_correolq() {

		$("#area_srilq").load("correo/email_facturalq.php", {

			compra_id: $('#compra_id').val()

		}, function(result) {


		});

		$("#area_srilq").html("Espere un momento...");

	}

	//  End 
	-->
</script>

<div id="genera_xml"></div>
<div id="g_claveacceso"></div>
<div id="divBody_cobropago"></div>
<div id="divBody_insumolq"></div>

<div id="verifica_guardado"></div>

<div id="anula_data"></div>
<div id="campog_valorproceso1"></div>

<script type="text/javascript">
	<!--
	$('#genera_xml').hide();

	oculta_boton();

	if ($('#compra_id').val() > 0) {
		if ($('#tipdoc_id').val() == '19') {
			activa_boton();
		}

	}


	function busca_vencimientodata() {

		$("#venci_iddata").load("templateformsweb/maestro_standar_compras/proveedor_d/busca_ven.php", {
			proveevar_id: $('#proveevar_id').val()

		}, function(result) {


		});

		$("#venci_iddata").html("...");

	}


	$("#proveevar_id").on("change", function() {
		busca_vencimientodata();
	});


	//  End 
	-->
</script>

<div id="venci_iddata"></div>


<?php
echo $objformulario->generar_formulario_nfechas($table, $DB_gogess);
?>
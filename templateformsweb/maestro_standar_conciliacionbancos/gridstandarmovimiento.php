<?php
$campos_dataedit = array();
$campos_dataedit = explode(",", $this->fie_tablasubgridcampos);
$campo_id = $this->fie_tablasubcampoid;

$fie_tblcombogrid = $this->fie_tblcombogrid;
$fie_campoidcombogrid = $this->fie_campoidcombogrid;

$campos_validaciongrid = array();
$campos_validaciongrid = explode(",", $this->fie_camposobligatoriosgrid);

$fie_tituloscamposgrid = array();
$fie_tituloscamposgrid = explode(",", $this->fie_tituloscamposgrid);

$campo_enlace = $this->fie_campoenlacesub;

?>
<div class="panel panel-default">
	<div class="panel-heading">

		<h3 class="panel-title" style="color:#000033">Movimientos</h3>

	</div>
	<div class="panel-body">

		<button type="button" class="mb-sm btn btn-info" onclick="lista_movimientos('0')" style="cursor:pointer"> MOVIMIENTOS BANCARIOS </button>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<button type="button" class="mb-sm btn btn-info" onclick="lista_movimientos('1')" style="cursor:pointer"> CONCILIADOS </button>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<button type="button" class="mb-sm btn btn-info" onclick="lista_movimientos('2')" style="cursor:pointer"> NO CONCILIADOS </button>

		<div id="l_detallemovimiento">

		</div>

		<div id="acv_retencion"></div>

	</div>
</div>

<script language="javascript">
	<!--
	<?php
	$valor_enlace = '';
	if (@$this->contenid[$campo_enlace]) {
		$valor_enlace = @$this->contenid[$campo_enlace];
	} else {
		$valor_enlace = @$this->sendvar[$campo_enlace . "x"];
	}
	?>


	function lista_movimientos(opcion) {

		var path;

		switch (String(opcion)) {
			case '0':
				path = 'lista_movimientos.php';
				break;
			case '1':
				path = 'lista_movimientosconciliados.php';
				break;
			case '2':
				path = 'lista_movimientosconciliadosNo.php';
				break;
			default:
				console.error('Valor de opción inválido:', opcion);
				return;
		}


		$("#l_detallemovimiento").load("templateformsweb/maestro_standar_conciliacionbancos/movimientos/" + path, {
			campo_enlace: '<?php echo $valor_enlace; ?>',
			conc_fechacorte: $('#conc_fechacorte').val(),
			conc_cuenta: $('#conc_cuenta').val(),
			conc_saldobanco: $('#conc_saldobanco').val(),
			conc_id: $('#conc_id').val(),
			opcion: opcion

		}, function(result) {


		});

		$("#l_detallemovimiento").html("...");

	}


	function imprimir_datos(opcion) {

		var path;
		var variables;
		switch (String(opcion)) {
			case '0':
				path = 'lista_movimientos.php';
				break;
			case '1':
				path = 'lista_movimientosconciliados.php';
				break;
			case '2':
				path = 'lista_movimientosconciliadosNo.php';
				break;
			default:
				console.error('Valor de opción inválido:', opcion);
				return;
		}

		variables = 'campo_enlace=<?php echo $valor_enlace; ?>&conc_fechacorte=' + $('#conc_fechacorte').val() + '&conc_cuenta=' + $('#conc_cuenta').val() + '&conc_saldobanco=' + $('#conc_saldobanco').val() + '&conc_id=' + $('#conc_id').val() + '&opcion=' + opcion;

		myWindow3 = window.open('templateformsweb/maestro_standar_conciliacionbancos/movimientos/' + path + '?' + variables, 'ventana_reporteunico', 'width=850,height=700,scrollbars=YES');
		myWindow3.focus();

	}


	function actualiza_retenciones() {

		$("#acv_retencion").load("templateformsweb/maestro_standar_conciliacionbancos/movimientos/actualizar_lista.php", {
			campo_enlace: '<?php echo $valor_enlace; ?>'
		}, function(result) {

			lista_retenciones();

		});

		$("#acv_retencion").html("...");

	}

	if ($('#conc_id').val() != '') {
		lista_movimientos('0');
	}


	$("#dia_conc_fechacorte").on("change", function() {
		lista_movimientos('0');
	});

	$("#mes_conc_fechacorte").on("change", function() {
		lista_movimientos('0');
	});

	$("#anio_conc_fechacorte").on("change", function() {
		lista_movimientos('0');
	});



	$("#conc_cuenta").on("change", function() {
		lista_movimientos('0');
	});

	//
	-->
</script>
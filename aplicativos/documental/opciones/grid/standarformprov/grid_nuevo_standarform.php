<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$tiempossss = 455550000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

$director = '../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

//-----------------------------------------

$fie_id = $_POST["fie_id"];
$valor = $_POST["valor"];

$obtine_data = "select * from gogess_sisfield where fie_id='" . $fie_id . "'";
$rs_obtdata = $DB_gogess->executec($obtine_data, array());

$table = $rs_obtdata->fields["fie_tabledb"];

//-----------------------------------------

$client_idy = 'undefined';
$provee_nombre = '';

$lista_tbldata = array('gogess_sisfield', 'gogess_sistable');
$contenido = file_get_contents(@$director . "jason_files/tablas/" . $table . ".json");
$gogess_sistable = json_decode($contenido, true);

$objformulario = new  ValidacionesFormulario();
$objtableform = new templateform();

$contenido = file_get_contents(@$director . "jason_files/estructura/" . $table . ".json");
$gogess_sisfield = json_decode($contenido, true);

if ($table) {
	$objtableform->select_templateform(@$table, $DB_gogess);
}

$objformulario->sisfield_arr = $gogess_sisfield;
$objformulario->sistable_arr = $gogess_sistable;
$comillasimple = "'";

$total1 = 0;
$total2 = 0;
$total3 = 0;
if ($valor > 0) {
	$busca_asignado = "select count(*) total from beko_documentocabecera where proveeve_id='" . $valor . "'";
	$rs_basiga = $DB_gogess->executec($busca_asignado, array());
	$total1 = $rs_basiga->fields["total"];

	$busca_asignado2 = "select count(*) total from dns_compras where proveevar_id='" . $valor . "'";
	$rs_basiga2 = $DB_gogess->executec($busca_asignado2, array());
	$total2 = $rs_basiga2->fields["total"];
}

//$total1=0;
//$total2=0;
if ($valor == 733 or $valor == 924) {
	$total3 = 2;
}

if ($total1 > 1 or $total2 > 1 or $total3 > 1) {

	$campos_tipo = array(
		'provee_ruc' => 'hidden2',
		'provee_cedula' => 'hidden2',
		'provee_nombre' => 'hidden2',
		'tipoident_codigocl' => 'hidden2',
		'provee_cuentag' => 'hidden3',
		'provee_acfijo' => 'hidden3'
	);
} else {

	$campos_tipo = array(
		'usua_id' => 'hidden3',
		'tare_id' => 'hidden3',
		'caucab_id' => 'hidden3',
		'caucab_nregistro' => 'hidden2',
		'provee_cuentag' => 'hidden3',
		'provee_acfijo' => 'hidden3'
	);
}



//$id_empresa_val=0;		

//busca cliente para editar
$client_idy = $valor;
//busca cliente para editar	


$variableb = 0;
if ($client_idy == 'undefined') {
	$variableb = 0;
} else {
	$variableb = $client_idy;
	$_REQUEST["opcion_" . $table] = "buscar";
	$csearch = $client_idy;
}

$comillasimple = "'";
$botonenvio = '<div align="center">
<table border="0" cellpadding="0" cellspacing="3">
			  <tr>
				<td><input type="image" name="imageField" src="images/aceptar.png" /></td>
			    <td>&nbsp;</td>
			    <td onClick="funcion_cerrar_pop(' . $comillasimple . 'divDialog_proveedor' . $comillasimple . ')"  style="cursor:pointer" ><img src="images/cancelar.png" ></td>
			  </tr>
			</table>
</div>';

$mensajege = '<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#006600;" >Registro guardado con exito...</span>';

//$funciones_cuandoguarda="$('#".$divresultado."').html('".$mensajege."')";

if ($client_idy) {
	$funcionextrag = "actualizadata_cmb('" . $client_idy . "')";
} else {
	$funcionextrag = "actualizadata_cmb(result_insertado)";
}

$template_reemplazo = 'templateformsweb/maestro_standar_formst/';

?>
<?php
//Datos de empresa
$idempresa = 1;
$id_empresa_val = $idempresa;
?>
<style type="text/css">
	<!--
	.borde_css {
		font-size: 11px;
		font-family: Arial, Helvetica, sans-serif;
		border: 1px solid #CCCCCC;
	}

	.TableScroll_buscar {
		z-index: 99;
		width: 380px;
		height: 300px;
		overflow: auto;
	}
	-->
</style>
<div align="center">
	<form id="form_<?php echo $table; ?>" name="form_<?php echo $table; ?>" method="post" action="">
		<table width="500" border="0" cellpadding="4" cellspacing="0">
			<tr>

				<td valign="top"><?php
									include("../../../tablascellform.php");

									?></td>
			</tr>
		</table>

	</form>
</div>

<script language="javascript">
	<!--
	function busca_provvedorrepetido() {

		$("#div_buscapacienter").load("templateformsweb/maestro_standar_ventas/buscadorform/busca_pacienterepetido.php", {

			provee_cedula: $('#provee_cedula').val(),
			provee_ruc: $('#provee_ruc').val()

		}, function(result) {


		});
		$("#div_buscapacienter").html("Espere un momento...");

	}



	function buscar_siexiste_ruc() {

		$("#bud_clienteexiste").load("templateformsweb/maestro_standar_ventas/buscadorform/listado_existeruc.php", {
			b_data: $('#provee_ruc').val(),
			fie_id: '<?php echo $fie_id; ?>'
		}, function(result) {


		});

		$("#bud_clienteexiste").html("Espere un momento...");

	}

	function buscar_siexiste_cedula() {

		$("#bud_clienteexiste").load("templateformsweb/maestro_standar_ventas/buscadorform/listado_existecedula.php", {
			b_data: $('#provee_cedula').val(),
			fie_id: '<?php echo $fie_id; ?>'
		}, function(result) {


		});

		$("#bud_clienteexiste").html("Espere un momento...");

	}



	$("#provee_ruc").change(function() {

		buscar_siexiste_ruc();


	});

	$("#provee_cedula").change(function() {

		buscar_siexiste_cedula();

	});


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
</script>
<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 0);
error_reporting(E_ALL);
$tiempossss = 4444450000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
$director = '../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario = new  ValidacionesFormulario();

///solo detalles
function busca_conarbol($cuenta, $DB_gogess)
{
	$busca_detalles = "select count(*) as total from lpin_plancuentas_vista where  planc_codigocp like '" . $cuenta . ".%'";

	$rs_stotales = $DB_gogess->executec($busca_detalles, array());

	return $rs_stotales->fields["total"] - 1;
}

$obtiene_solodetalles = "";
$listadiariox = "select * from lpin_plancuentas order by planc_orden asc";
$rs_listadiariox = $DB_gogess->executec($listadiariox, array());
if ($rs_listadiariox) {
	while (!$rs_listadiariox->EOF) {

		$cantidadd_valord = 0;
		$cantidadd_valord = busca_conarbol($rs_listadiariox->fields["planc_codigoc"], $DB_gogess);

		if ($cantidadd_valord == 0) {

			$obtiene_solodetalles .= "'" . $rs_listadiariox->fields["planc_codigoc"] . "',";
		}


		$rs_listadiariox->MoveNext();
	}
}

$paralista_sql = '';
$paralista_sql = $obtiene_solodetalles . "'p'";
///solo detalles


if (@$_SESSION['ces1313777_sessid_inicio']) {

	$crb_id = $_POST["pVar2"];

	$busca_cpd = "select * from lpin_masivocobropago where crb_id='" . $crb_id . "'";
	$rs_cpd = $DB_gogess->executec($busca_cpd, array());

	$crb_procesado = $rs_cpd->fields["crb_procesado"];
	$ttra_id = $rs_cpd->fields["ttra_id"];

	if ($crb_procesado == 0) {
?>
		<div align="center">


			<select name="busca_venta" id="busca_venta" style="width:200px" class="js-example-basic-single form-control">
				<option value="">--seleccionar--</option>
				<?php
				$busca_usuarios = "select distinct provee_nombre,provee_nombre from app_proveedor where provee_borradologico=0 order by provee_nombre asc";
				$rs_gogessform = $DB_gogess->executec($busca_usuarios, array());
				if ($rs_gogessform) {
					while (!$rs_gogessform->EOF) {

						$n_facturas = 0;
						//$n_facturas = $rs_gogessform->fields["facturas"];

						//if ($n_facturas > 0) {
						echo '<option value="' . $rs_gogessform->fields["provee_nombre"] . '">' . $rs_gogessform->fields["provee_nombre"] . '</option>';
						//}

						$rs_gogessform->MoveNext();
					}
				}

				?>
			</select>


			<input type="button" name="Submit" value="LISTAR" onClick="lista_ventas()" />
		</div>
		<br><br>

		<?php
		$consulta_valor = " where planc_codigoc in (" . $paralista_sql . ") and planc_nombre like '%anticipo%' and planc_codigoc like '2.%'";
		?>
		<div class="form-group">
			<div class="col-xs-6" align="center">
				<?php
				echo '<center><select name="cuenta" id="cuenta"  class="js-example-basic-single form-control" style="width:290px" >';
				echo '<option value="" >--Seleccionar Cuenta--</option>';
				$objformulario->fill_cmb("lpin_plancuentas", "planc_codigoc,planc_codigoc,planc_nombre", "", $consulta_valor, $DB_gogess);
				echo '</select></center>';
				?>
			</div>

			<div class="col-xs-6" align="center">
				<?php


				echo '<center><select name="detanticm_id" id="detanticm_id"  class="js-example-basic-single form-control" style="width:290px" >';
				echo '<option value="" >--Seleccionar Detalle Tipo Anticipo:--</option>';
				$objformulario->fill_cmb("cesdb_arcombos.cmd_tipodetallemovanticipo", "detantic_id,detantic_nombre", "", " where movantic_id='" . $ttra_id . "'", $DB_gogess);
				echo '</select></center>';
				?>
			</div>

		</div>




		<br><br>
		<div id="lista_ventasec"></div>

	<?php
	} else {

		echo '<b><br><br>Registro ya fue procesado...</b>';
	}
	?>

	<script type="text/javascript">
		<!--
		function lista_ventas() {
			if ($('#busca_venta').val() == '') {
				alert("Porfavor ingrese el dato a buscar");
				return false;
			}

			$("#lista_ventasec").load("templateformsweb/maestro_standar_macobropagopl/listasvccc/ventas.php", {
				crb_id: '<?php echo $crb_id; ?>',
				busca_venta: $('#busca_venta').val()
			}, function(result) {


			});

			$("#lista_ventasec").html("Espere un momento...");

		}

		$('.js-example-basic-single').select2({
			dropdownParent: $('#divDialog_proveedor')
		});



		//  End 
		-->
	</script>


<?php
}
?>
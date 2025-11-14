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

if (@$_SESSION['ces1313777_sessid_inicio']) {

	$crb_id = $_POST["pVar2"];

	$busca_cpd = "select * from lpin_masivocobropago where crb_id='" . $crb_id . "'";
	$rs_cpd = $DB_gogess->executec($busca_cpd, array());

	$crb_procesado = $rs_cpd->fields["crb_procesado"];

	if ($crb_procesado == 0) {
?>
		<div align="center">
			No. Factura:<input name="busca_compra" type="text" id="busca_compra" />

			Proveedor:
			<select name="cliev_id" id="cliev_id" style="width:200px" class="js-examplecp-basic-single7 form-control">
				<option value="">--seleccionar--</option>
				<?php
				$busca_usuarios = "select distinct provee_id,provee_nombre,(select count(1) as facturas from dns_compras where proveevar_id=app_proveedor.provee_id) as facturas from app_proveedor where provee_borradologico=0 order by provee_nombre asc";
				$rs_gogessform = $DB_gogess->executec($busca_usuarios, array());
				if ($rs_gogessform) {
					while (!$rs_gogessform->EOF) {

						$n_facturas = 0;
						$n_facturas = $rs_gogessform->fields["facturas"];

						if ($n_facturas > 0) {
							echo '<option value="' . $rs_gogessform->fields["provee_id"] . '">' . $rs_gogessform->fields["provee_nombre"] . '</option>';
						}

						$rs_gogessform->MoveNext();
					}
				}

				?>
			</select>

			<input type="button" name="Submit" value="LISTAR" onClick="lista_compras()" />



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
		function lista_compras() {

			//if ($('#busca_compra').val() == '' ) {
			//alert("Porfavor ingrese el dato a buscar");
			//return false;
			//}

			$("#lista_ventasec").load("templateformsweb/maestro_standar_macobropagopl/listasvc/compras.php", {
				crb_id: '<?php echo $crb_id; ?>',
				busca_compra: $('#busca_compra').val(),
				cliev_id: $('#cliev_id').val()
			}, function(result) {


			});

			$("#lista_ventasec").html("Espere un momento...");

		}


		$('.js-examplecp-basic-single7').select2({
			dropdownParent: $('#divDialog_proveedor')
		});

		$("#busca_compra").mask({
			mask: "###-###-#########"
		});

		//  End 
		-->
	</script>


<?php
}
?>
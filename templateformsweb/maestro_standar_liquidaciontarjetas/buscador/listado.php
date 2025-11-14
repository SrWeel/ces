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

$gridfield_id = $_POST["gridfield_id"];
$b_data = $_POST["b_data"];

//if($b_data)
//{

$obtine_data = "select * from gogess_gridfield where 	gridfield_id='" . $gridfield_id . "'";
$rs_obtdata = $DB_gogess->executec($obtine_data, array());

$gridfield_tablecmb = $rs_obtdata->fields["gridfield_tablecmb"];
$gridfield_camposcmb = $rs_obtdata->fields["gridfield_camposcmb"];
$gridfield_ordercmb = $rs_obtdata->fields["gridfield_ordercmb"];
$gridfield_nameid = $rs_obtdata->fields["gridfield_nameid"];
$gridfield_campoextrasbuscado = $rs_obtdata->fields["gridfield_campoextrasbuscado"];
$gridfield_filtrobuscador = $rs_obtdata->fields["gridfield_filtrobuscador"];

$lista_campos = array();
$lista_campos = explode(",", $gridfield_camposcmb . "," . $gridfield_campoextrasbuscado);

$listabusqueda = '';
for ($i = 1; $i < count($lista_campos); $i++) {
	if ($lista_campos[$i]) {
		$listabusqueda .= " " . $lista_campos[$i] . " like '%" . $b_data . "%' or ";
	}
}

$listabusqueda = substr($listabusqueda . $sql100, 0, -3);

if ($gridfield_filtrobuscador) {
	$lista_sql = "select * from " . $gridfield_tablecmb . "  where (" . $listabusqueda . ") and " . $gridfield_filtrobuscador;
} else {
	$lista_sql = "select * from " . $gridfield_tablecmb . "  where (" . $listabusqueda . ") ";
}
//echo $lista_sql;
$rs_lcanp = $DB_gogess->executec($lista_sql, array());
?>
<table border="1" align="center">
	<?php
	if ($rs_lcanp) {
		while (!$rs_lcanp->EOF) {
	?>
			<tr>
				<td style="font-size:10px"><input type="button" name="Submit" value="Sel" onClick="seleccionar_regn('<?php echo $rs_lcanp->fields[$lista_campos[0]]; ?>')"></td>
				<?php
				for ($i = 1; $i < count($lista_campos); $i++) {
					if ($lista_campos[$i]) {
						echo '<td style="font-size:10px" >' . utf8_decode($rs_lcanp->fields[$lista_campos[$i]]) . '</td>';
					}
				}
				if ($gridfield_tablecmb == 'lpin_lote') {
					echo '<td style="font-size:10px" > <table border="1" width="150" >
					<tr>
<td>N. Comp.</td>
<td>Documento</td>
					</tr>
					';

					$lote_idfac = $rs_lcanp->fields["lottar_id"];
					$lista_fatasig = "select * from lpin_cobropago inner join lpin_cobropagodetalle on lpin_cobropago.crb_enlace=lpin_cobropagodetalle.crb_enlace where lote_id='" . $lote_idfac . "'";
					$rs_bdatab = $DB_gogess->executec($lista_fatasig, array());
					if ($rs_bdatab) {
						while (!$rs_bdatab->EOF) {

							$doccab_ndocumento = '';
							if ($rs_bdatab->fields["doccab_id"] != '') {
								$saca_saldo = "select saldo,doccab_ndocumento,doccab_total from beko_documentocabecera_vista where doccab_id='" . $rs_bdatab->fields["doccab_id"] . "'";
								$rs_sacsaldo = $DB_gogess->executec($saca_saldo, array());
								$doccab_ndocumento = $rs_sacsaldo->fields["doccab_ndocumento"];
							}

							echo '<tr>';
							echo '<td style="font-size:10px" >';
							echo $rs_bdatab->fields["crb_ncomprobante"];
							echo '</td>';

							echo '<td style="font-size:10px" >';
							echo $doccab_ndocumento;
							echo '</td>';

							echo '</tr>';

							$rs_bdatab->MoveNext();
						}
					}

					echo '</table></td>';
				}

				?>
			</tr>
	<?php
			$rs_lcanp->MoveNext();
		}
	}
	?>
</table>

<script type="text/javascript">
	<!--
	function seleccionar_regn(valor) {

		$('#<?php echo $gridfield_nameid ?>').val(valor);

		<?php
		if ($gridfield_nameid == 'porcecrl_idx' or $gridfield_nameid == 'porcecil_idx') {

			echo '
    calcula_apagar();';
		}
		?>

	}
	//  End 
	-->
</script>

<?php
//}

?>
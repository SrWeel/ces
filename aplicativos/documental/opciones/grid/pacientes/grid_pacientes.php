<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
@$tiempossss = 4544000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();

if ($_SESSION['ces1313777_sessid_inicio']) {

	$director = '../../../../../';
	include("../../../../../cfg/clases.php");
	include("../../../../../cfg/declaracion.php");

	//include(@$director."libreria/estructura/aqualis_master.php");
	$lista_tbldata = array('gogess_sisfield', 'gogess_sistable');

	//saca datos de la tabla

	//busca pacientes
	//echo $_POST["todos"];
	if (trim($_POST["todos"]) == 1) {

		if ($_POST["ci_medico"]) {
			$buscaidusu = "select usua_id from app_usuario where usua_ciruc='" . $_POST["ci_medico"] . "'";
			$rs_bui = $DB_gogess->executec($buscaidusu, array());

			$lista_pacsql = "";
			$lista_pacientesx = "select distinct clie_id from lista_pacientes where usua_id='" . $rs_bui->fields['usua_id'] . "'";
		} else {
			$lista_pacsql = "";
			$lista_pacientesx = "select distinct clie_id from lista_pacientes where usua_id='" . @$_SESSION['ces1313777_sessid_inicio'] . "'";
		}

		//echo $lista_pacientesx;
		$rs_tblplax = $DB_gogess->executec($lista_pacientesx, array());
		if ($rs_tblplax) {
			while (!$rs_tblplax->EOF) {

				$lista_pacsql .= $rs_tblplax->fields["clie_id"] . ",";

				$rs_tblplax->MoveNext();
			}
		}

		//dados turnos hoy
		$fecha_hoyt = date("Y-m-d");
		$busca_hoyt = "select usuaat_id,beko_documentodetalle.prof_id,dns_especialidad.especi_id,clie_id from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id inner join cesdb_arextension.dns_profesion profesion on beko_documentodetalle.prof_id=profesion.prof_id left join dns_especialidad on profesion.especienc_id=dns_especialidad.especi_id inner join app_cliente on beko_documentocabecera.doccab_identificacionpaciente=app_cliente.clie_rucci where DATE_FORMAT(doccab_fechaemision_cliente,'%Y-%m-%d')='" . $fecha_hoyt . "' and usuaat_id='" . @$_SESSION['ces1313777_sessid_inicio'] . "'";

		$busca_hoyt = "select usuaat_id,beko_documentodetalle.prof_id,dns_especialidad.especi_id,clie_id from beko_documentocabecera inner join beko_documentodetalle on beko_documentocabecera.doccab_id=beko_documentodetalle.doccab_id inner join cesdb_arextension.dns_profesion profesion on beko_documentodetalle.prof_id=profesion.prof_id left join dns_especialidad on profesion.especienc_id=dns_especialidad.especi_id inner join app_cliente on beko_documentocabecera.doccab_identificacionpaciente=app_cliente.clie_rucci where usuaat_id='" . @$_SESSION['ces1313777_sessid_inicio'] . "'";

		$rs_hoyt = $DB_gogess->executec($busca_hoyt, array());
		if ($rs_hoyt) {
			while (!$rs_hoyt->EOF) {

				$lista_pacsql .= $rs_hoyt->fields["clie_id"] . ",";

				$rs_hoyt->MoveNext();
			}
		}


		//dados turnos hoy

		$lista_pacsql = substr($lista_pacsql, 0, -1);
	}
	//busca pacientes

	$lista_datosmenu = "select * from gogess_menupanel where 	mnupan_id=?";
	$rs_datosmenu = $DB_gogess->executec($lista_datosmenu, array($_POST["pVar2"]));

	$lista_tabla = "select * from gogess_sistable where tab_id=" . $rs_datosmenu->fields["tab_id"];
	$rs_tabla = $DB_gogess->executec($lista_tabla, array());

	//saca datos de la tabla
	$carpeta = 'pacientes';
	$tabla = $rs_tabla->fields["tab_name"];
	$ntabla = $rs_tabla->fields["tab_title"];
	$tabla_vista = $rs_tabla->fields["tab_name"];

	$subindice = "_pacientes";
	$campos_paragrid = $rs_datosmenu->fields["mnupan_campogrid"];
	$campo_id = $rs_tabla->fields["tab_campoprimario"];

	$sqltotal = "";

	$objformulario = new  ValidacionesFormulario();

	//$objformulario->sisfield_arr=$gogess_sisfield;

	//$objformulario->sistable_arr=$gogess_sistable;

	//$ntabla= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_title"," where tab_name like",$tabla,$DB_gogess);

	$comillasimple = "'";
	$boto_borrar = 0;
	//echo $_SESSION['ces1313777_jobt_id'];

	if ($_SESSION['ces1313777_jobt_id'] == 13) {

		$boto_borrar = 1;
	} else {

		$boto_borrar = 0;
	}





	//Crea tabla para grid



	$objgrid_fk->campos_visualizar = $campos_paragrid;



	$ordenlistado = "order by " . $campo_id . " desc";



	$objgrid_fk->orden = $ordenlistado;



	$objgrid_fk->leer_data($tabla_vista, "", "", "", 90, $sqltotal, $DB_gogess);





	echo '';

	echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;" align="center" >' . $ntabla . '</div><br>';

	echo '<table id="datatable1" class="display responsive cell-border" cellspacing="0" width="100%">

<thead><tr>';

	//echo '<th >Imprimir </th>';

	echo '<th >Editar</th>';

	if ($boto_borrar) {



		echo '<th >Borrar</th>';
	}



	//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';



	for ($i = 0; $i < count($objgrid_fk->arrcampos_titulo); $i++) {



		echo '<th>' . $objgrid_fk->arrcampos_titulo[$i] . '</th>';
	}



	echo '</tr></thead>';

	echo '<tfoot><tr>';

	//echo '<th >Imprimir</th>';

	echo '<th >Editar</th>';



	if ($boto_borrar) {



		echo '<th >Borrar</th>';
	}





	//echo '<td class="borde_grid"  background="libreria/grid/fondo.png" nowrap="nowrap"  >Borrar</td>';



	for ($i = 0; $i < count($objgrid_fk->arrcampos_titulo); $i++) {



		echo '<th>' . $objgrid_fk->arrcampos_titulo[$i] . '</th>';
	}



	echo '</tr></tfoot>';

	echo '</table>';

	echo '</div>';



	$concatena_camp = '';

	$concatena_data = '';

	foreach ($objgrid_fk->arrcampos_nombre as $camposdata):



		if ($campo_id == $camposdata or $camposdata == 'emp_id') {



			$concatena_camp .= '{ "data": "' . $camposdata . '","visible": false },';
		} else {



			$concatena_camp .= '{ "data": "' . $camposdata . '" },';
		}



		$concatena_data .= $camposdata . ",";



	endforeach;







	//filtros





	if ($rs_datosmenu->fields["mnupan_campoenlace"]) {



		if (@$_SESSION['ces1313777_sessid_emp_id']) {



			$sql1 = $rs_datosmenu->fields["mnupan_campoenlace"] . " = " . @$_SESSION['ces1313777_sessid_emp_id'] . " and ";
		}
	}


	$sql2 = '';
	$sql3 = '';
	$sql4 = '';
	$sql5 = '';

	if ($_POST["todos"] == 1) {
		if ($lista_pacsql) {
			$sql2 = " clie_id in (" . $lista_pacsql . ") and ";
		}
	}


	if ($_POST["todos"] == 2) {
		if ($_POST["conve_id"]) {
			$sql4 = " conve_id in (" . $_POST["conve_id"] . ") and ";
		}
	}


	if (trim($_POST["todos"]) == 3) {
		$lista_atendidosp = "";
		$lista_atendidosp = "select distinct clie_id from lista_pacientes where usua_id='" . $_POST['usua_idv'] . "'";

		$sql5 = " clie_id in (" . $lista_atendidosp . ") and ";
	}

	@$sqltotal = $sql1 . $sql2 . $sql3 . $sql4 . $sql5;

	$sqltotal = substr($sqltotal, 0, -4);

	$filtro_data = base64_encode($sqltotal);



	//filtros

?>



	<script type="text/javascript">
		<!--
		$('#datatable1').DataTable({

			"order": [
				[2, "desc"]
			],

			"language": {



				"lengthMenu": "Ver _MENU_ registros por pag.",

				"zeroRecords": "No hay registros - sorry",

				"info": "Pag. _PAGE_ de _PAGES_",

				"infoEmpty": "No records available",

				"infoFiltered": "(filtered from _MAX_ total records)",

				"sSearch": "Buscar:",

				"oPaginate": {

					"sFirst": "Primero",

					"sPrevious": "Anterior",

					"sNext": "Siguiente",

					"sLast": "Ultimo"

				}

			},



			"processing": true,

			"serverSide": true,

			"ajax": {



				"url": "libreria/grid/scripts/post.php",

				"data": function(d) {

					d.tabla = "<?php echo $tabla_vista; ?>";

					d.id = "<?php echo $campo_id; ?>";

					d.lista = "<?php echo $concatena_data; ?>";

					d.filtro = "<?php echo $filtro_data; ?>";

				},

				"type": "POST"

			},

			"columns": [

				{

					"targets": -1,

					"data": null,

					"defaultContent": "<button></button>",

					"mRender": function(data, type, full)

					{



						return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="ver_formularioenpantalla(\'aplicativos/documental/datos_pacientes.php\',\'Editar\',\'divBody_ext\',' + full["<?php echo $campo_id ?>"] + ',\'<?php echo $_POST["pVar2"]; ?>\',0,0,0,0,0)" style=cursor:pointer ><center><img src="images/editar.png"  /></center></td></tr></table>';



					}



				}

				<?php



				if ($boto_borrar) {



				?>



					,



					{



						"targets": -1,



						"data": null,



						"defaultContent": "<button></button>",



						"mRender": function(data, type, full)



						{



							return '<table border="0" cellspacing="0" cellpadding="0" ><tr><td onclick="borrar_registro(\'<?php echo $tabla;  ?>\',\'<?php echo $campo_id; ?>\',' + full["<?php echo $campo_id ?>"] + ')" style=cursor:pointer ><center><img src="images/delete.png"  /></center></td></tr></table>';



						}



					}



				<?php



				}



				?>



				,



				<?php



				echo substr($concatena_camp, 0, -1);



				?>



			]



		});
		-->

	</script>



	<div id="divBody_causasdet"></div>

	<div id="divBody_arbidet"></div>



<?php



} else {



	echo '<div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; color:#FFFFFF ">La sesi&oacute;n a caducado de clic en F5 para continuar...</div>';
}



?>
<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
@$tiempossss = 444500000;
ini_set("session.cookie_lifetime", $tiempossss);
ini_set("session.gc_maxlifetime", $tiempossss);
session_start();
if (@$_SESSION['ces1313777_sessid_inicio']) {
	$compra_id = $_POST["compra_id"];
	$director = '../../../../../../';
	include("../../../../../../cfg/clases.php");
	include("../../../../../../cfg/declaracion.php");
	$objformulario = new  ValidacionesFormulario();

	$per_activo = 0;
	$per_activo = $objformulario->replace_cmb("dns_periodobodega", "perio_activo,perio_anio", " where perio_activo=", 1, $DB_gogess);
	
	$busca_centrov="select * from dns_compras where compra_id='" . $compra_id . "';";
	$rs_enviocentr = $DB_gogess->executec($busca_centrov);
	$centroenvia_id=$rs_enviocentr->fields["centroenvia_id"];
	

	$busca_noverificados = "select count(*) as totalnv from dns_temporalovimientoinventario_vista where compra_id='" . $compra_id . "' and 	moviin_verificado='0'";
	$rs_noverificados = $DB_gogess->executec($busca_noverificados);

	$no_verificados = 0;
	$no_verificados = $rs_noverificados->fields["totalnv"];

	if ($no_verificados > 0) {
?>
		<script type="text/javascript">
			<!--
			alert("Proceso no se puede realizar ya que ahy aun items sin verificar...");

			//  End 
			-->
		</script>
<?php
	} else {
		//==================================================						

		$procesado_data = "update dns_compras set compra_procesado='1',compra_fechaprocesado='" . date("Y-m-d H:i:s") . "',compra_usprocesa='" . $_SESSION['ces1313777_sessid_inicio'] . "' where compra_id='" . $compra_id . "';";
		$rs_pd = $DB_gogess->executec($procesado_data);


//$trasfiere_data = "INSERT INTO dns_principalmovimientoinventario (cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviintemp_id,perioac_id,moviin_redpublica,moviin_laboratorio) select cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviin_id,perioac_id,moviin_redpublica,moviin_laboratorio from dns_temporalovimientoinventario where compra_id='" . $compra_id . "';";

$trasfiere_data = "INSERT INTO dns_movimientoinventario 
      (cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviintempdr_id,perioac_id,moviin_redpublicadr,moviin_laboratoriodr) 
select cuadrobm_id,'".$centroenvia_id."' as centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviin_id,perioac_id,moviin_redpublica,moviin_laboratorio from dns_temporalovimientoinventario where compra_id='" . $compra_id . "';";


		$rs_listaprocesa = $DB_gogess->executec($trasfiere_data);

		//busca precio mayor
		$precio_c = 0;
		$busca_listax = "select * from dns_temporalovimientoinventario inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where compra_id='" . $compra_id . "';";
		$rs_listax = $DB_gogess->executec($busca_listax);
		if ($rs_listax) {
			while (!$rs_listax->EOF) {

				$moviin_redpublica = $rs_listax->fields["moviin_redpublica"];
				$moviin_id = $rs_listax->fields["moviin_id"];
				$preciocomprallega=$rs_listax->fields["moviin_preciocompra"];
				
				if ($moviin_redpublica == 1) {

					////red publica//////////////////////
					$cuadrobm_id = $rs_listax->fields["cuadrobm_id"];
					$precio_c = $objBodega->busca_redp_precioproaccompra($per_activo, $moviin_id, $cuadrobm_id,$preciocomprallega, $DB_gogess);

					//busca precios
					$bu_p = "select * from dns_redppreciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
					$rs_bup = $DB_gogess->executec($bu_p);

					if ($rs_bup->fields["precio_id"] > 0) {

						$convenio = 0;
						$pvp_valor = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_valor = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$convenio = 7;
						$pvp_ispol = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_ispol = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 1;
						$pvp_plasticos = 0;
						$pvp_plasticos = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 2;
						$pvp_otorr = 0;
						$pvp_otorr = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						//precio techo			 
						$busca_preciotecho = "select * from lpin_tarifarioredpublica where cuadrobm_id='" . $cuadrobm_id . "'";
						$rs_buptecho = $DB_gogess->executec($busca_preciotecho);

						$precio_techo = 0;
						$precio_techo = $rs_buptecho->fields["tarrp_valortecho"];
						//precio techo

						$act_data = "update  dns_redppreciostiempo set  precio_otorr='" . $pvp_otorr . "',precio_compra='" . $precio_c . "',precio_pvp='" . $pvp_valor . "',precio_ispol='" . $pvp_ispol . "',precio_plasticos='" . $pvp_plasticos . "',precio_techo='" . $precio_techo . "' where precio_id='" . $rs_bup->fields["precio_id"] . "'";
						$rs_insertap = $DB_gogess->executec($act_data);
					} else {

						$convenio = 0;
						$pvp_valor = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_valor = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$convenio = 7;
						$pvp_ispol = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_ispol = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 1;
						$pvp_plasticos = 0;
						$pvp_plasticos = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);


						$objFormulascontable->plasticos = 2;
						$pvp_otorr = 0;
						$pvp_otorr = $objFormulascontable->formulasredp_pvp($convenio, $precio_c, $DB_gogess);

						$precio_compra = $precio_c;
						$precio_pvp = $pvp_valor;
						$precio_ispol = $pvp_ispol;
						$precio_fechamodi = date("Y-m-d H:i:s");
						$precio_plasticos = $pvp_plasticos;
						$precio_otorr = $pvp_otorr;

						//precio techo			 
						$busca_preciotecho = "select * from lpin_tarifarioredpublica where cuadrobm_id='" . $cuadrobm_id . "'";
						$rs_buptecho = $DB_gogess->executec($busca_preciotecho);

						$precio_techo = 0;
						$precio_techo = $rs_buptecho->fields["tarrp_valortecho"];
						//precio techo

						$act_datai = "insert into dns_redppreciostiempo (cuadrobm_id,precio_compra,precio_pvp,precio_ispol,precio_fechamodi,precio_plasticos,precio_techo,precio_otorr) values ('" . $cuadrobm_id . "','" . $precio_compra . "','" . $precio_pvp . "','" . $precio_ispol . "','" . $precio_fechamodi . "','" . $precio_plasticos . "','" . $precio_techo . "','" . $precio_otorr . "');";
						$rs_insertap = $DB_gogess->executec($act_datai);
					}



					//busca precios


					////red publica//////////////////////

				} else {
					////precio normal//////////////////////

					$cuadrobm_id = $rs_listax->fields["cuadrobm_id"];
					$precio_c = $objBodega->busca_preciopromediocompra($cuadrobm_id,$preciocomprallega, $DB_gogess);

					//echo $cuadrobm_id." -> ".$rs_listax->fields["cuadrobm_principioactivo"]." PC:".$precio_c."<br>";

					//busca precios
					$bu_p = "select * from dns_preciostiempo where cuadrobm_id='" . $cuadrobm_id . "'";
					$rs_bup = $DB_gogess->executec($bu_p);

					if ($rs_bup->fields["precio_id"] > 0) {

						$convenio = 0;
						$pvp_valor = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_valor = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$convenio = 7;
						$pvp_ispol = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_ispol = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 1;
						$pvp_plasticos = 0;
						$pvp_plasticos = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 2;
						$pvp_otorr = 0;
						$pvp_otorr = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$act_data = "update  dns_preciostiempo set  precio_otorr='" . $pvp_otorr . "',precio_compra='" . $precio_c . "',precio_pvp='" . $pvp_valor . "',precio_ispol='" . $pvp_ispol . "',precio_plasticos='" . $pvp_plasticos . "' where precio_id='" . $rs_bup->fields["precio_id"] . "'";
						$rs_insertap = $DB_gogess->executec($act_data);
					} else {

						$convenio = 0;
						$pvp_valor = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_valor = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$convenio = 7;
						$pvp_ispol = 0;
						$objFormulascontable->plasticos = 0;
						$pvp_ispol = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 1;
						$pvp_plasticos = 0;
						$pvp_plasticos = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$objFormulascontable->plasticos = 2;
						$pvp_otorr = 0;
						$pvp_otorr = $objFormulascontable->formulas_pvp($convenio, $precio_c, $DB_gogess);

						$precio_compra = $precio_c;
						$precio_pvp = $pvp_valor;
						$precio_ispol = $pvp_ispol;
						$precio_fechamodi = date("Y-m-d H:i:s");
						$precio_plasticos = $pvp_plasticos;
						$precio_otorr = $pvp_otorr;

						$act_datai = "insert into dns_preciostiempo (cuadrobm_id,precio_compra,precio_pvp,precio_ispol,precio_fechamodi,precio_plasticos,precio_otorr) values ('" . $cuadrobm_id . "','" . $precio_compra . "','" . $precio_pvp . "','" . $precio_ispol . "','" . $precio_fechamodi . "','" . $precio_plasticos . "','" . $precio_otorr . "');";
						$rs_insertap = $DB_gogess->executec($act_datai);
					}
					//busca precios
					////precio normal//////////////////////

				}



				$rs_listax->MoveNext();
			}
		}

		//busca precio mayor
		//==================================================
	}
}

?>
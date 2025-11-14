<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{
$compra_id='2164';

$director='../../../../../../';
include("../../../../../../cfg/clases.php");
include("../../../../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$procesado_data="update dns_compras set compra_procesado='1',compra_fechaprocesado='".date("Y-m-d H:i:s")."',compra_usprocesa='".$_SESSION['ces1313777_sessid_inicio']."' where compra_id='".$compra_id."';";
$rs_pd = $DB_gogess->executec($procesado_data);


$trasfiere_data="INSERT INTO dns_principalmovimientoinventario (cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviintemp_id,perioac_id) select cuadrobm_id,centro_id,tipom_id,tipomov_id,moviin_nlote,moviin_fechadecaducidad,moviin_comprobantedeingreso,moviin_fechaingreso,centroenvia_id,centrorecibe_id,centrorecibe_observacion,centrorecibe_cantidad,centrorecibe_documento,centrorecibe_bodegamatriz,usua_id,moviin_fechaenvio,moviin_nombrerecibe,moviin_cedularecibe,moviin_gradorecibe, moviin_fecharegistro,unid_id,uniddesg_id,moviin_cantidadunidadconsumo,moviin_totalenunidadconsumo,moviin_fechadeelaboracion,moviin_nombreproveedor,moviin_nombrefabricante,moviin_preciocompra,moviin_total, moviin_rsanitario,compra_id,moviin_autorizado,moviin_fechaautorizado,moviin_aprobo,moviin_id,perioac_id from dns_temporalovimientoinventario where moviin_id='3515' and compra_id='".$compra_id."';";


$rs_listaprocesa = $DB_gogess->executec($trasfiere_data);

//busca precio mayor
$precio_c=0;
$busca_listax="select * from dns_temporalovimientoinventario inner join dns_cuadrobasicomedicamentos on dns_temporalovimientoinventario.cuadrobm_id=dns_cuadrobasicomedicamentos.cuadrobm_id where compra_id='".$compra_id."';";
$rs_listax = $DB_gogess->executec($busca_listax);
if($rs_listax)
		{
			while (!$rs_listax->EOF) {
			
			$cuadrobm_id=$rs_listax->fields["cuadrobm_id"];
			$precio_c=$objBodega->busca_preciomayorcompra($cuadrobm_id,$DB_gogess);
			
			//echo $cuadrobm_id." -> ".$rs_listax->fields["cuadrobm_principioactivo"]." PC:".$precio_c."<br>";
			
			//busca precios
			$bu_p="select * from dns_preciostiempo where cuadrobm_id='".$cuadrobm_id."'";
			$rs_bup = $DB_gogess->executec($bu_p);
			
			if($rs_bup->fields["precio_id"]>0)
			{
			 
			 $convenio=0;
			 $pvp_valor=0;
			 $pvp_valor=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $convenio=7;
			 $pvp_ispol=0;
			 $pvp_ispol=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $objFormulascontable->plasticos=1;
		     $pvp_plasticos=0;
			 $pvp_plasticos=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $act_data="update  dns_preciostiempo set  precio_compra='".$precio_c."',precio_pvp='".$pvp_valor."',precio_ispol='".$pvp_ispol."',precio_plasticos='".$pvp_plasticos."' where precio_id='".$rs_bup->fields["precio_id"]."'";
			 $rs_insertap = $DB_gogess->executec($act_data);
			 
			  
			}
			else
			{
			
			 $convenio=0;
			 $pvp_valor=0;
			 $pvp_valor=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $convenio=7;
			 $pvp_ispol=0;
			 $pvp_ispol=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $objFormulascontable->plasticos=1;
		     $pvp_plasticos=0;
			 $pvp_plasticos=$objFormulascontable->formulas_pvp($convenio,$precio_c,$DB_gogess);
			 
			 $precio_compra=$precio_c;
			 $precio_pvp=$pvp_valor;
			 $precio_ispol=$pvp_ispol;
			 $precio_fechamodi=date("Y-m-d H:i:s");
			 $precio_plasticos=$pvp_plasticos;
			 
			 $act_datai="insert into dns_preciostiempo (cuadrobm_id,precio_compra,precio_pvp,precio_ispol,precio_fechamodi,precio_plasticos) values ('".$cuadrobm_id."','".$precio_compra."','".$precio_pvp."','".$precio_ispol."','".$precio_fechamodi."','".$precio_plasticos."');";			
			 $rs_insertap = $DB_gogess->executec($act_datai);
			
			
			}			
			//busca precios
			
			
			
			$rs_listax->MoveNext();
			}
		}	





//busca precio mayor



}


?>
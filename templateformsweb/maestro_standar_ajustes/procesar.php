<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=44400000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();

if($_SESSION['ces1313777_sessid_inicio'])
{

$tomfis_id=$_POST["tomfis_id"];
//crea asiento contable

$datos_fisico="select * from lpin_tomafisica where tomfis_id='".$_POST["tomfis_id"]."'";
$rs_fisico = $DB_gogess->executec($datos_fisico,array());
$centro_id=$rs_fisico->fields["centro_id"];
$tomfis_descripcion=$rs_fisico->fields["tomfis_descripcion"];
$tomfis_procesado=$rs_fisico->fields["tomfis_procesado"];

if($tomfis_procesado==1)
{
  
  echo "<br><center><b>Ya fue procesada...</b></center>";

}
else
{
///++++++++++++++++++++++++++++++++++++++++++++++++

$busca_existeajuste="select * from lpin_comprobantecontable where comcont_tabla='lpin_tomafisica' and comcont_idtabla='".$tomfis_id."'";
$rs_existeajuste = $DB_gogess->executec($busca_existeajuste,array());

if($rs_existeajuste->fields["comcont_id"]>0)
{

$comcont_enlace=$rs_existeajuste->fields["comcont_enlace"];

}
else
{

$prefix = 'ORDER-';
$unique_code = uniqid($prefix);

$tcomp_id=21;
$comcont_fecha=date("Y-m-d");
$comcont_concepto='AJUSTE INVENTARIOS '.$tomfis_descripcion;
$comcont_numeroc=$tomfis_id;
$comcont_estado='APROBADO';
$comcont_diferencia=0;
$comcont_enlace=$unique_code;
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$comcont_fecharegistro=date("Y-m-d H:i:s");
$comcont_tabla='lpin_comprobantecontable';
$comcont_idtabla=$tomfis_id;

$crea_asiento="INSERT INTO lpin_comprobantecontable ( tcomp_id, comcont_fecha, comcont_concepto, comcont_numeroc, comcont_estado, comcont_diferencia, comcont_enlace, usua_id, comcont_fecharegistro, centro_id, comcont_tabla, comcont_idtabla) VALUES
('".$tcomp_id."','".$comcont_fecha."','".$comcont_concepto."','".$comcont_numeroc."','".$comcont_estado."','".$comcont_diferencia."','".$comcont_enlace."','".$usua_id."','".$comcont_fecharegistro."','".$centro_id."','".$comcont_tabla."','".$comcont_idtabla."')";

$rs_asiento = $DB_gogess->executec($crea_asiento,array());


}


//crea asiento contable

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

$periodo_actual=$per_activo;

$datos_produ="select * from lpin_tomafisica inner join lpin_ajusteproducto on lpin_tomafisica.tomfis_enlace=lpin_ajusteproducto.tomfis_enlace where tomfis_id='".$_POST["tomfis_id"]."' and ajuspr_id not in (select ajuspr_id from dns_movimientoinventario where ajuspr_id!=0)";
$rs_produ = $DB_gogess->executec($datos_produ,array());

 if($rs_produ)
 {
	  while (!$rs_produ->EOF) {	
	  
	     $cuadrobm_id=$rs_produ->fields["cuadrobm_id"];
		 $unid_id=$rs_produ->fields["unid_id"];
		 $ajuspr_cantidadsistema=$rs_produ->fields["ajuspr_cantidad"];
		 $ajuspr_creal=$rs_produ->fields["ajuspr_creal"];
		 $ajuspr_diferencia=$rs_produ->fields["ajuspr_diferencia"];
		 $centro_id=$rs_produ->fields["centro_id"];
		 
		 $ajuspr_id=$rs_produ->fields["ajuspr_id"];
		 
		 if($ajuspr_diferencia<0)
		 {
		   //aumentar en inventario de la bodega
//obtiene el ultimo movimiento de compra
$obtiene_preciocompra="select * from dns_preciostiempo where cuadrobm_id='".$cuadrobm_id."'";
$rs_precioc = $DB_gogess->executec($obtiene_preciocompra,array());

$precio_compra=$rs_precioc->fields["precio_compra"];

$cantidad_valor=($ajuspr_diferencia*-1);

$busca_movimientoult="select * from dns_movimientoinventario where cuadrobm_id='' and tipom_id='1' and centro_id='".$centro_id."' order by moviin_id desc limit 1";
$rs_umovi = $DB_gogess->executec($busca_movimientoult,array());
$unid_id=$rs_umovi->fields["unid_id"];
$uniddesg_id=$rs_umovi->fields["unid_id"];
$moviin_rsanitario=$rs_umovi->fields["moviin_rsanitario"];
//obtiene el ultimo movimiento de compra		   
		   
$centro_id=$rs_produ->fields["centro_id"];
$tipom_id=1;
$tipomov_id=20;
$moviin_nlote='AJLOTE'.date("Ymd");
$moviin_fechadecaducidad=date("Y-m-d",strtotime(date("Y-m-d")."+ 1 year"));
$moviin_comprobantedeingreso=0;
$moviin_fechaingreso=date("Y-m-d");
$centroenvia_id=0;
$centrorecibe_id=0;
$centrorecibe_observacion='AJUSTE DE INVENTARIO';
$centrorecibe_cantidad=$cantidad_valor;
$centrorecibe_documento='';
$centrorecibe_bodegamatriz='';
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$moviin_fechaenvio='';
$moviin_nombrerecibe='';
$moviin_cedularecibe='';
$moviin_gradorecibe='';
$moviin_fecharegistro=date("Y-m-d H:i:s");

$moviin_cantidadunidadconsumo=1;
$moviin_totalenunidadconsumo=($ajuspr_diferencia*-1);

$moviin_fechadeelaboracion=date("Y-m-d");
$moviin_nombreproveedor='';
$moviin_nombrefabricante='';
$moviin_presentacioncomercial='';
$moviin_preciocompra=$precio_compra;
$moviin_total=round(($precio_compra*$cantidad_valor),2);

$compra_id=$rs_umovi->fields["compra_id"];;
$moviin_autorizado='';
$moviin_fechaautorizado='';
$moviin_aprobo='';
$tempdsp_id='';
$egrec_id='';
$entregamoviin_id='';
$entregaclie_id='';
$entrega_fecha='';
$plantra_id='';
$perioac_id=$per_activo;
$moviin_tblreceta='';
$plantrai_id='';
$moviin_tbldispositivo='';
$moviincent_id='';
$tempdspcent_id='';
$egrecentrecentro_id='';
$moviin_preciocontable=$precio_compra;
$precu_id='';

		      
$inserta_datas="INSERT INTO dns_movimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_nlote, moviin_fechadecaducidad, moviin_comprobantedeingreso, moviin_fechaingreso, centroenvia_id, centrorecibe_id, centrorecibe_observacion, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fechaenvio, moviin_nombrerecibe, moviin_cedularecibe, moviin_gradorecibe, moviin_fecharegistro, unid_id, uniddesg_id, moviin_cantidadunidadconsumo, moviin_totalenunidadconsumo, moviin_fechadeelaboracion, moviin_nombreproveedor, moviin_nombrefabricante, moviin_presentacioncomercial, moviin_preciocompra, moviin_total, moviin_rsanitario, compra_id, moviin_autorizado, moviin_fechaautorizado, moviin_aprobo, tempdsp_id, egrec_id, entregamoviin_id, entregaclie_id, entrega_fecha, plantra_id, perioac_id, moviin_tblreceta, plantrai_id, moviin_tbldispositivo, moviincent_id, tempdspcent_id, egrecentrecentro_id, moviin_preciocontable, precu_id, ajuspr_id) VALUES
('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$moviin_nlote."','".$moviin_fechadecaducidad."','".$moviin_comprobantedeingreso."','".$moviin_fechaingreso."','".$centroenvia_id."','".$centrorecibe_id."','".$centrorecibe_observacion."','".$centrorecibe_cantidad."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fechaenvio."','".$moviin_nombrerecibe."','".$moviin_cedularecibe."','".$moviin_gradorecibe."','".$moviin_fecharegistro."','".$unid_id."','".$uniddesg_id."','".$moviin_cantidadunidadconsumo."','".$moviin_totalenunidadconsumo."','".$moviin_fechadeelaboracion."','".$moviin_nombreproveedor."','".$moviin_nombrefabricante."','".$moviin_presentacioncomercial."','".$moviin_preciocompra."','".$moviin_total."','".$moviin_rsanitario."','".$compra_id."','".$moviin_autorizado."','".$moviin_fechaautorizado."','".$moviin_aprobo."','".$tempdsp_id."','".$egrec_id."','".$entregamoviin_id."','".$entregaclie_id."','".$entrega_fecha."','".$plantra_id."','".$perioac_id."','".$moviin_tblreceta."','".$plantrai_id."','".$moviin_tbldispositivo."','".$moviincent_id."','".$tempdspcent_id."','".$egrecentrecentro_id."','".$moviin_preciocontable."','".$precu_id."','".$ajuspr_id."');";


$rs_inserta = $DB_gogess->executec($inserta_datas,array());

//lpin_detallecomprobantecontable
//genera asinto contable

//detcc_cuentacontable
//detcc_descricpion
//detcc_referencia
//detcc_entidad
//detcc_debe
//detcc_haber
//centcost_id
//sisu_id
//detcc_fecharegistro



//INSERT INTO lpin_detallecomprobantecontable ( comcont_enlace,detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, centcost_id, sisu_id, detcc_fecharegistro) VALUES (comcont_enlace,detcc_cuentacontable, detcc_descricpion, detcc_referencia, detcc_entidad, detcc_debe, detcc_haber, centcost_id, sisu_id, detcc_fecharegistro),


//genera asiento contable


		 
		   //aumentar en inventario de la bodega
		 }
		 
		 if($ajuspr_diferencia>0)
		 {
		   //quitar en inventario de la bodega
		   
		   
	
		   
 $busca_paraentrega="select * from dns_movimientoinventario where tipom_id=1 and moviin_fecharegistro>='2021-09-01' and cuadrobm_id='".$cuadrobm_id."' and year(moviin_fecharegistro)>='".$per_activo."' and centro_id='".$centro_id."' order by moviin_fechadecaducidad asc";
  $rs_paraentrega = $DB_gogess->executec($busca_paraentrega,array());
  if($rs_paraentrega)
   {
	  while (!$rs_paraentrega->EOF) {	
	  
	   if($ajuspr_diferencia>0)
		 {
	  //=================================================================================
	  
	  $lista_nproducto="select * from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
	  $rs_nproducto = $DB_gogess->executec($lista_nproducto,array());
	  
	    $ncampo_val='cuadrobm_principioactivo';
		$nom1='';					
		if($rs_nproducto->fields["cuadrobm_nombredispositivo"])
		{
		   $nom1=$rs_nproducto->fields["cuadrobm_nombredispositivo"].' ';
		}
		
		$nom2='';					
		if($rs_nproducto->fields["cuadrobm_primerniveldesagregcion"])
		{
		   $nom2=$rs_nproducto->fields["cuadrobm_primerniveldesagregcion"].' ';
		}
		
		$nom3='';					
		if($rs_nproducto->fields["cuadrobm_presentacion"])
		{
		   $nom3=$rs_nproducto->fields["cuadrobm_presentacion"].' ';
		}
		 
		$nom4='';					
		if($rs_nproducto->fields["cuadrobm_concentracion"])
		{
		   $nom4=$rs_nproducto->fields["cuadrobm_concentracion"].' ';
		}
		
		$concatena_nom=$nom1.$nom2.$nom3.$nom4;
		
		
	  //envios pacientes
	  $busca_entregados="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and (entregamoviin_id='".$rs_paraentrega->fields["moviin_id"]."' or  entregamoviin_id='0') and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id=0";
	  $rs_entregados = $DB_gogess->executec($busca_entregados,array());
	  // envios pacientes
	  //echo $busca_entregados."<br>";
	  //trasnferencias
	  
	  $busca_entregadost="select sum(moviin_totalenunidadconsumo) as totalv from dns_movimientoinventario where centro_id='".$centro_id."' and entregamoviin_id='0' and tipom_id=2 and moviin_nlote ='".$rs_paraentrega->fields["moviin_nlote"]."' and cuadrobm_id='".$cuadrobm_id."' and centro_id='".$centro_id."' and perioac_id='".$periodo_actual."' and moviincent_id='".$rs_paraentrega->fields["moviin_id"]."'";
	  $rs_entregadost = $DB_gogess->executec($busca_entregadost,array());
	  
	  // echo $busca_entregadost."<br>";
	  //trasferencias
	  
	  $actual_porlote=0;
	  $actual_porlote=$rs_paraentrega->fields["moviin_totalenunidadconsumo"]-$rs_entregados->fields["totalv"]-$rs_entregadost->fields["totalv"];
	 // $actual_porlote=0;
	 
	 
	  if($actual_porlote>0)
	  {
	     $bandera_listo=0;
		 $disponible_lote=0;
	     $moviin_idvalor=$rs_paraentrega->fields["moviin_id"];
		 $disponible_lote=$actual_porlote;
		 $moviin_nlotevalor=$rs_paraentrega->fields["moviin_nlote"];
		 $moviin_fechadecaducidadvalor=$rs_paraentrega->fields["moviin_fechadecaducidad"];
		 
		 //va quitado poco a poco
		echo $moviin_idvalor."<br>";
		$ajuspr_diferencia=ir_quitandoporlote($moviin_idvalor,$centro_id,$ajuspr_diferencia,$disponible_lote,$ajuspr_id,$objformulario,$DB_gogess);
		  
		 //va quitando poco a poco         
      }
	
	
	  //===============================================================================	
		}
		
       $rs_paraentrega->MoveNext();
      }
  }
		   
		   
		   
		   
		 
		   //quitar en inventario de la bodega
		 }
	  
	     $rs_produ->MoveNext();
	  }
  }	  


///++++++++++++++++++++++++++++++++++++++++++++++++
}

}

function ir_quitandoporlote($moviin_idvalor,$centro_id,$ajuspr_diferencia,$disponible_lote,$ajuspr_id,$objformulario,$DB_gogess)
{

$cantidad_queda=0;
if($ajuspr_diferencia<=$disponible_lote)
	  {
		$cantidad_valor=$ajuspr_diferencia;

	  }
	  else
	  {
	    $cantidad_valor=$disponible_lote;
	  
	  }

$bandera_listo=0;
$moviin_id=$moviin_idvalor;

$busca_movimientodata="select * from dns_movimientoinventario where moviin_id='".$moviin_id."'";
$rs_movidata= $DB_gogess->executec($busca_movimientodata,array());

$cuadrobm_id=$rs_movidata->fields["cuadrobm_id"];
$centro_id=$centro_id;
$tipom_id=2;
$tipomov_id=21;
$moviin_nlote=$rs_movidata->fields["moviin_nlote"];
$moviin_fechadecaducidad=$rs_movidata->fields["moviin_fechadecaducidad"];
$moviin_comprobantedeingreso='0';
$moviin_fechaingreso='';
$centroenvia_id='0';
$centrorecibe_id='0';
$centrorecibe_observacion='';
$centrorecibe_cantidad=0;
$centrorecibe_documento='';
$centrorecibe_bodegamatriz=1;
$usua_id=$_SESSION['ces1313777_sessid_inicio'];
$moviin_fechaenvio='';
$moviin_nombrerecibe='';
$moviin_cedularecibe='';
$moviin_gradorecibe='';

if($fecha_desc)
{
$moviin_fecharegistro=$fecha_desc." ".date("H:i:s");
}
else
{
$moviin_fecharegistro=date("Y-m-d H:i:s");
}

$unid_id=$rs_movidata->fields["unid_id"];
$uniddesg_id=$rs_movidata->fields["uniddesg_id"];
$moviin_cantidadunidadconsumo=1;
$moviin_totalenunidadconsumo=$cantidad_valor;
$moviin_fechadeelaboracion=$rs_movidata->fields["moviin_fechadeelaboracion"];
$moviin_nombreproveedor=$rs_movidata->fields["moviin_nombreproveedor"];
$moviin_nombrefabricante=$rs_movidata->fields["moviin_nombrefabricante"];
$moviin_preciocompra=$rs_movidata->fields["moviin_preciocompra"];
$moviin_total=$rs_movidata->fields["moviin_preciocompra"]*$cantidad_valor;
$moviin_rsanitario=$rs_movidata->fields["moviin_rsanitario"];
$compra_id=$rs_movidata->fields["compra_id"];
$moviin_autorizado='';
$moviin_fechaautorizado='';
$moviin_aprobo='0';
$tempdsp_id='0';
$egrec_id='0';
$entregamoviin_id=$moviin_id;
$entregaclie_id=0;

if($fecha_desc)
{
$entrega_fecha=$fecha_desc." ".date("H:i:s");
}
else
{
$entrega_fecha=date("Y-m-d H:i:s");
}

$per_activo=0;
$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);

///ingresa primero precuenta
$stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_stockactual where centro_id=".$centro_id." and cuadrobm_id='".$cuadrobm_id."'";
$rs_stactua = $DB_gogess->executec($stockactual);
$maximo_permitido=$rs_stactua->fields["stactual"];

if($cantidad_valor<=$maximo_permitido)
{

$inserta_movimiento="INSERT INTO dns_movimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, moviin_nlote, moviin_fechadecaducidad, moviin_comprobantedeingreso, moviin_fechaingreso, centroenvia_id, centrorecibe_id, centrorecibe_observacion, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fechaenvio, moviin_nombrerecibe, moviin_cedularecibe, moviin_gradorecibe, moviin_fecharegistro, unid_id, uniddesg_id, moviin_cantidadunidadconsumo, moviin_totalenunidadconsumo, moviin_fechadeelaboracion, moviin_nombreproveedor, moviin_nombrefabricante, moviin_preciocompra, moviin_total, moviin_rsanitario, compra_id, moviin_autorizado, moviin_fechaautorizado, moviin_aprobo, tempdsp_id, egrec_id, entregamoviin_id, entregaclie_id, entrega_fecha, precu_id,perioac_id,moviin_tblreceta,ajuspr_id) VALUES
('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$moviin_nlote."','".$moviin_fechadecaducidad."','".$moviin_comprobantedeingreso."','".$moviin_fechaingreso."','".$centroenvia_id."','".$centrorecibe_id."','".$centrorecibe_observacion."','".$centrorecibe_cantidad."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fechaenvio."','".$moviin_nombrerecibe."','".$moviin_cedularecibe."','".$moviin_gradorecibe."','".$moviin_fecharegistro."','".$unid_id."','".$uniddesg_id."','".$moviin_cantidadunidadconsumo."','".$moviin_totalenunidadconsumo."','".$moviin_fechadeelaboracion."','".$moviin_nombreproveedor."','".$moviin_nombrefabricante."','".$moviin_preciocompra."','".$moviin_total."','".$moviin_rsanitario."','".$compra_id."','".$moviin_autorizado."','".$moviin_fechaautorizado."','".$moviin_aprobo."','".$tempdsp_id."','".$egrec_id."','".$entregamoviin_id."','".$entregaclie_id."','".$entrega_fecha."','".$precu_id."','".$per_activo."','".$tabla."','".$ajuspr_id."');";

$rs_entrega=$DB_gogess->executec($inserta_movimiento,array());

if($rs_entrega)
{
 $cantidad_queda=$ajuspr_diferencia-$cantidad_valor;

}
echo "va quedando:".$cantidad_queda."<br>";


}

return $cantidad_queda;


}
?>

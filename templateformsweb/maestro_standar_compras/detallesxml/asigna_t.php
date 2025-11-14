<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4444450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");
$objformulario= new  ValidacionesFormulario();

$compra_claveacceso=$_POST["pVar2"];
$compra_numeroproceso=$_POST["compra_numeroproceso"];
$cmb_allid=$_POST["cmb_allid"];


   $contador_lista=0;
   $numera_id=0;
   
   
   
   $lista_data="select * from dns_comprasdetallexml where cdxml_claveacceso='".$compra_claveacceso."' and cdxml_id not in (select cdxml_id from lpin_productocompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from lpin_cuentacompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from dns_activosfijos where compra_enlace='".$compra_numeroproceso."')";
   $rs_data = $DB_gogess->executec($lista_data,array());
   if($rs_data)
   {
	  while (!$rs_data->EOF) {	
	  
	 $comulla_simple="'";	
	 $tabla_valordata="";
	 $campo_valor="";	
	 $tabla_valordata="'dns_comprasdetallexml'";
	 $campo_valor="'cdxml_id'";
	 $ide_producto='cdxml_id';  
	 
	  
	
	$actualiza_data="update dns_comprasdetallexml set lpti_id='".$cmb_allid."' where cdxml_id='".$rs_data->fields["cdxml_id"]."' and lpti_id=0";
    $okvalor=$DB_gogess->executec($actualiza_data); 
	
	
	
	   $rs_data->MoveNext();	 
	  }
  }	  
  
  
  //asiga todos
  
   
   $lista_data="select * from dns_comprasdetallexml where lpti_id>0 and cdxml_claveacceso='".$compra_claveacceso."' and cdxml_id not in (select cdxml_id from lpin_productocompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from lpin_cuentacompra where compra_enlace='".$compra_numeroproceso."' UNION select cdxml_id from dns_activosfijos where compra_enlace='".$compra_numeroproceso."')";
   $rs_data = $DB_gogess->executec($lista_data,array());
   if($rs_data)
   {
	  while (!$rs_data->EOF) {	
	  
	   $lpti_id=$rs_data->fields["lpti_id"];
	
     if($lpti_id==1)
		{
		  //===========asigna_detalle=============//
		    $prcomp_taricodigo='';
		  	$cdxml_id=$rs_data->fields["cdxml_id"];
			$compra_nfactura=$_POST["compra_nfactura"];
			$compra_id=$_POST["compra_id"];
			
			
			$busca_data="select * from dns_comprasdetallexml where cdxml_id='".$cdxml_id."'";
			$rs_bdata = $DB_gogess->executec($busca_data,array());
			$busca_datacompre="select * from dns_compras where compra_id='".$compra_id."'";
			$rs_bdatacompra = $DB_gogess->executec($busca_datacompre,array());
			$compra_enlace=$compra_numeroproceso;
			$cuadrobm_id=0;
			$prcomp_cantidad=$rs_bdata->fields["cdxml_cantidad"];
			$unid_id='1';
			$prcomp_preciounitario=$rs_bdata->fields["cdxml_preciounitario"];
			$porcer_id='';
			$porcei_id='';
			$prcomp_descuento='';
			$prcomp_descuentodolar=$rs_bdata->fields["cdxml_descuento"];
			$prcomp_subtotal=$rs_bdata->fields["cdxml_totalsinimpuestos"];
			$usua_id=$_SESSION['ces1313777_sessid_inicio'];
			$prcomp_fecharegistro=date("Y-m-d H:i:s");
			$prcomp_impucodigo='2';
			
			if($rs_bdata->fields["cdxml_iva"]==0)
			{
			 $prcomp_taricodigo='0';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==2)
			{
			 $prcomp_taricodigo='2';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==4)
			{
			 $prcomp_taricodigo='4';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==5)
			{
			 $prcomp_taricodigo='5';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==6)
			{
			 $prcomp_taricodigo='6';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==7)
			{
			 $prcomp_taricodigo='7';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==8)
			{
			 $prcomp_taricodigo='8';
			}
			
			$prcomp_codigoext=$rs_bdata->fields["cdxml_codigo"];
			$prcomp_descripext=$rs_bdata->fields["cdxml_descripcion"];				
			$inserta_data="INSERT INTO lpin_productocompra ( compra_enlace, cuadrobm_id, prcomp_cantidad, unid_id, prcomp_preciounitario, porcer_id, porcei_id, prcomp_descuento, prcomp_descuentodolar, prcomp_subtotal, usua_id, prcomp_fecharegistro, prcomp_impucodigo, prcomp_taricodigo, prcomp_codigoext, prcomp_descripext, cdxml_id) VALUES
			('".$compra_enlace."','".$cuadrobm_id."','".$prcomp_cantidad."','".$unid_id."','".$prcomp_preciounitario."','".$porcer_id."','".$porcei_id."','".$prcomp_descuento."','".$prcomp_descuentodolar."','".$prcomp_subtotal."','".$usua_id."','".$prcomp_fecharegistro."','".$prcomp_impucodigo."','".$prcomp_taricodigo."','".$prcomp_codigoext."','".$prcomp_descripext."','".$cdxml_id."');";
			
			$rs_bdata = $DB_gogess->executec($inserta_data,array());			
			$id_new=0;
			$id_new=$DB_gogess->funciones_nuevoID(0);
			//echo $inserta_data;					
			$busca_ac="update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='".$cdxml_id."'";
			$rs_bac = $DB_gogess->executec($busca_ac,array());			
			//================================
			//periodo activo no olvidar			
			$per_activo=0;
			$per_activo=$objformulario->replace_cmb("dns_periodobodega","perio_activo,perio_anio"," where perio_activo=",1,$DB_gogess);
				
			$cuadrobm_id=0;
			$centro_id=55;
			$tipom_id=1;
			$tipomov_id=17;
			$centrorecibe_cantidad=$prcomp_cantidad;
			$centrorecibe_documento=$compra_nfactura;
			$centrorecibe_bodegamatriz=1;
			$usua_id=$_SESSION['ces1313777_sessid_inicio'];
			$moviin_fecharegistro=$prcomp_fecharegistro;
			$unid_id='1';
			$moviin_totalenunidadconsumo=$prcomp_cantidad;
			$moviin_presentacioncomercial=$prcomp_descripext;
			$moviin_preciocontable=$prcomp_preciounitario;
			$moviin_total=$prcomp_subtotal;
			$perioac_id=$per_activo;
			$moviin_codigoproveedor='';
			$moviin_codeext=$prcomp_codigoext;
			$moviin_descext=$prcomp_descripext;
			$prcomp_id=$id_new;
			$inserta_tmpcompra="INSERT INTO dns_temporalovimientoinventario ( cuadrobm_id, centro_id, tipom_id, tipomov_id, centrorecibe_cantidad, centrorecibe_documento, centrorecibe_bodegamatriz, usua_id, moviin_fecharegistro, unid_id, moviin_totalenunidadconsumo, moviin_presentacioncomercial, moviin_preciocontable, moviin_total, compra_id, perioac_id, moviin_codigoproveedor,cdxml_id,moviin_codeext,moviin_descext,prcomp_id) VALUES ('".$cuadrobm_id."','".$centro_id."','".$tipom_id."','".$tipomov_id."','".$centrorecibe_cantidad."','".$centrorecibe_documento."','".$centrorecibe_bodegamatriz."','".$usua_id."','".$moviin_fecharegistro."','".$unid_id."','".$moviin_totalenunidadconsumo."','".$moviin_presentacioncomercial."','".$moviin_preciocontable."','".$moviin_total."','".$compra_id."','".$perioac_id."','".$moviin_codigoproveedor."','".$cdxml_id."','".$moviin_codeext."','".$moviin_descext."','".$prcomp_id."');";
			$rs_tmpcompra = $DB_gogess->executec($inserta_tmpcompra,array());

		  
		  //===========asigna_detalle=============//
		
		}
		
	 if($lpti_id==2)
		{
		  
	    //===========asigna_detallecuenta=============//
		$taric_id = '';
		$cdxml_id = $rs_data->fields["cdxml_id"];
		$compra_nfactura=$_POST["compra_nfactura"];
		$compra_id=$_POST["compra_id"];
		
		$busca_datacp = "select * from dns_compras where compra_id='" . $compra_id . "'";
		$rs_bdatacp = $DB_gogess->executec($busca_datacp, array());
		$proveevar_id = $rs_bdatacp->fields["proveevar_id"];
	
		$busca_dataprov = "select * from  app_proveedor where provee_id='" . $rs_bdatacp->fields["proveevar_id"] . "'";
		$rs_bdataprov = $DB_gogess->executec($busca_dataprov, array());
	
		$provee_cuentag = '';
		$provee_cuentag = $rs_bdataprov->fields["provee_cuentag"];
	
		$busca_data = "select * from dns_comprasdetallexml where cdxml_id='" . $cdxml_id . "'";
		$rs_bdata = $DB_gogess->executec($busca_data, array());
	
		$compra_numeroproceso = $_POST["compra_numeroproceso"];
	
		$compra_enlace = $compra_numeroproceso;
		$cuadrobm_id = 0;
		$cuecomp_cantidad = $rs_bdata->fields["cdxml_cantidad"];
		$cuecomp_preciounitario = $rs_bdata->fields["cdxml_preciounitario"];
		$porcecr_id = '';
		$porceci_id = '';
		$cuecomp_descuento = '';
		$cuecomp_descuentodolar = $rs_bdata->fields["cdxml_descuento"];
		$cuecomp_subtotal = $rs_bdata->fields["cdxml_totalsinimpuestos"];
		$usua_id = $_SESSION['ces1313777_sessid_inicio'];
		$cuecomp_fecharegistro = date("Y-m-d H:i:s");
		$prcomp_impucodigo = '2';
		
		
		   if ($rs_bdata->fields["cdxml_iva"] == 0) {
				$taric_id = '2';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 2) {
				$taric_id = '1';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 4) {
				$taric_id = '5';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 6) {
				$taric_id = '3';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 7) {
				$taric_id = '4';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 8) {
				$taric_id = '6';
			}
		
			if ($rs_bdata->fields["cdxml_iva"] == 5) {
				$taric_id = '7';
			}
			
			
			$cuecomp_codigoext = $rs_bdata->fields["cdxml_codigo"];
			$cuecomp_descripext = $rs_bdata->fields["cdxml_descripcion"];
		
			$planc_codigoc = $provee_cuentag;
		
			$inserta_data = "INSERT INTO lpin_cuentacompra ( compra_enlace, cuecomp_cantidad, cuecomp_preciounitario, porcecr_id, porceci_id, cuecomp_descuento, cuecomp_descuentodolar, cuecomp_subtotal, usua_id, cuecomp_fecharegistro, cuecomp_codigoext, cuecomp_descripext, cdxml_id,taric_id,planc_codigoc) VALUES
		('" . $compra_enlace . "','" . $cuecomp_cantidad . "','" . $cuecomp_preciounitario . "','" . $porcecr_id . "','" . $porceci_id . "','" . $cuecomp_descuento . "','" . $cuecomp_descuentodolar . "','" . $cuecomp_subtotal . "','" . $usua_id . "','" . $cuecomp_fecharegistro . "','" . $cuecomp_codigoext . "','" . $cuecomp_descripext . "','" . $cdxml_id . "','" . $taric_id . "','" . $planc_codigoc . "');";
		
			$rs_bdata = $DB_gogess->executec($inserta_data, array());			
		
			$busca_ac = "update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='" . $cdxml_id . "'";
			$rs_bac = $DB_gogess->executec($busca_ac, array());
		  
		//===========asigna_detallecuenta=============//
		  
		  
		}

	if($lpti_id==3)
		{
		   //===========asigna_detalleaf=============//
		    $tarif_id='';
		    $cdxml_id=$rs_data->fields["cdxml_id"];
		    $compra_nfactura=$_POST["compra_nfactura"];
		    $compra_id=$_POST["compra_id"];

			$busca_data="select * from dns_comprasdetallexml where cdxml_id='".$cdxml_id."'";
			$rs_bdata = $DB_gogess->executec($busca_data,array());			
			$compra_numeroproceso=$_POST["compra_numeroproceso"];			
			$compra_enlace=$compra_numeroproceso;
			$cuadrobm_id=0;
			$acfi_valorcompra=$rs_bdata->fields["cdxml_preciounitario"];
			$porcefr_id='';
			$porcefi_id='';
			$cuecomp_descuento='';
			$cuecomp_descuentodolar=$rs_bdata->fields["cdxml_descuento"];
			$acfi_subtotal=$rs_bdata->fields["cdxml_totalsinimpuestos"];
			$usua_id=$_SESSION['ces1313777_sessid_inicio'];
			$acfi_fecharegistro=date("Y-m-d H:i:s");
			$prcomp_impucodigo='2';

		    if($rs_bdata->fields["cdxml_iva"]==0)
			{
			 $tarif_id='2';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==2)
			{
			 $tarif_id='1';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==4)
			{
			 $tarif_id='5';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==6)
			{
			 $tarif_id='3';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==7)
			{
			 $tarif_id='4';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==8)
			{
			 $taric_id='6';
			}
			
			if($rs_bdata->fields["cdxml_iva"]==5)
			{
			 $taric_id='7';
			}
		   
		    $acfi_codigo=$rs_bdata->fields["cdxml_codigo"];
			$acfi_nombre=$rs_bdata->fields["cdxml_descripcion"];
			$acfi_descripcion=$rs_bdata->fields["cdxml_descripcion"];			
			$acfi_enlace=$usua_id.strtoupper(uniqid()).date("YmdHis");
			
			$inserta_data="INSERT INTO dns_activosfijos ( compra_enlace, acfi_valorcompra, porcefr_id, porcefi_id, acfi_subtotal, usua_id, acfi_fecharegistro, acfi_codigo, acfi_nombre, cdxml_id,tarif_id,acfi_enlace,acfi_descripcion) VALUES
			('".$compra_enlace."','".$acfi_valorcompra."','".$porcefr_id."','".$porcefi_id."','".$acfi_subtotal."','".$usua_id."','".$acfi_fecharegistro."','".$acfi_codigo."','".$acfi_nombre."','".$cdxml_id."','".$tarif_id."','".$acfi_enlace."','".$acfi_descripcion."');";
			
			$rs_bdata = $DB_gogess->executec($inserta_data,array());		
			
			$busca_ac="update dns_comprasdetallexml set cdxml_asignado=1 where cdxml_id='".$cdxml_id."'";
			$rs_bac = $DB_gogess->executec($busca_ac,array());
		   
		   //===========asigna_detalleaf=============//
		  
		}
	
	
	
	   $rs_data->MoveNext();	 
	  }
  }	  
  
  
  
   ?>  

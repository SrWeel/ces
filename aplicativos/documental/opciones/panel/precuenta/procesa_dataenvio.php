<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4404000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

include("lib_data.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$centrob_id=$_POST["centrob_id"];
$precu_id=$_POST["precu_id"];
$centro_idb=55;

//echo $centrob_id."<br>";
//echo $precu_id;


//busca_usuario
$bn_us="select * from app_usuario where usua_id='".$_SESSION['datafrank797_sessid_inicio']."'";
$rs_bnus= $DB_gogess->executec($bn_us,array());
$usua_nombre=$rs_bnus->fields["usua_nombre"];
$usua_apellido=$rs_bnus->fields["usua_apellido"];
$usua_ciruc=$rs_bnus->fields["usua_ciruc"];
//busca_usuario

//genera el egreso
$egrec_ncomprobante='';
$egrec_nmemo='MEMO-REPOSICION'.$precu_id;
$emp_id='1';
$centro_id='55';
$centrod_id=$centrob_id;
$egrec_representante='';
$egrec_fecha=date("Y-m-d");
$egrec_responsableentrega=$usua_nombre.' '.$usua_apellido;
$egrec_grado='';
$egrec_cedula=$usua_ciruc;
$egrec_funcion='';
$egrec_personalrecibe='';
$egrec_nombrerecibe='';
$egrec_cedularecibe='';
$usua_id=$_SESSION['datafrank797_sessid_inicio'];
$egrec_fecharegistro=date("Y-m-d H:i:s");
$usuapr_id=0;
$egrec_procesado='';
$egrec_fechaprocesa='';
$egrec_anulado=0;
$egrec_fechaanulado='';
$egrec_usanula='';
$usuareci_id=0;
$egrec_recibido='';
$egrec_fecharecibe='';
$tipom_id=2;
$tipomov_id=5;
$destv_id='';
$egrec_tipo='0';
$egrec_motivo='';
$egrec_otrosdestino='';
$precuped_id=$precu_id;



//genera el egreso
$lista_aenviar=array();

$periodo_actual=$objformulario->replace_cmb("dns_periodobodega","perio_id,perio_anio"," where perio_activo=","1",$DB_gogess);

$lista_bprecuentax="select * from dns_precuenta where precu_id='".$precu_id."'";
$rs_convex= $DB_gogess->executec($lista_bprecuentax,array());

    $convepr_id=$rs_convex->fields["convepr_id"];
	$lista_convenio="select * from cesdb_arextension.dns_convenios where conve_id='".$convepr_id."'";
	$rs_conve= $DB_gogess->executec($lista_convenio,array());
	$rs_conve->fields["conve_redpublica"];
	
	$code_redp=0;
	$code_redp=$rs_conve->fields["conve_redpublica"];
	
	$red_publica='NO';
	if($rs_conve->fields["conve_redpublica"]==1)
	{
	  $red_publica='SI';
	}

 $lista_precuentas="select * from dns_detalleprecuenta left join dns_centrosalud_origen on dns_detalleprecuenta.centrob_id=dns_centrosalud_origen.centro_id  where precu_id='".$precu_id."' and detapre_tipo in (1,2) and centrob_id='".$centrob_id."'";
	
$rs_lprecuentas = $DB_gogess->executec($lista_precuentas,array());
 if($rs_lprecuentas)
 {

	  while (!$rs_lprecuentas->EOF) {  
	  
	    $busca_entregado="select * from dns_temporaldespacho where detpretmp_id='".$rs_lprecuentas->fields["detapre_id"]."'";
		$rs_okentreg = $DB_gogess->executec($busca_entregado,array());		
		$cantidad_val=$rs_okentreg->fields["cantidad_val"];
	     
	  
	     $detapre_cantidad=$rs_lprecuentas->fields["detapre_cantidad"]-$cantidad_val;
		 
		 if($detapre_cantidad>0)
		 {
		 //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 
		 $detpretmp_id=$rs_lprecuentas->fields["detapre_id"];
	  
	     $stockactual="select sum(stock_cantidad*stock_signo) as stactual from dns_principalstockactual where centro_id='55' and cuadrobm_id='".$rs_lprecuentas->fields["cuadrobm_id"]."'";
	     $rs_stactua = $DB_gogess->executec($stockactual);
	     $cuadrobm_id=$rs_lprecuentas->fields["cuadrobm_id"];
		 
	     if($rs_stactua->fields["stactual"]>0)
		 {
		 //================================================================================
		 
		 
		 $b_categ="select categ_id,cuadrobm_codigoatc from dns_cuadrobasicomedicamentos where cuadrobm_id='".$cuadrobm_id."'";
		 $rs_cate = $DB_gogess->executec($b_categ);
		 $insu_val=$rs_cate->fields["categ_id"];
		 $cuadrobm_codigoatc=$rs_cate->fields["cuadrobm_codigoatc"];
		 
		 $array_asignaciondata=array();
		 $array_asignaciondata=busca_paradescargar($periodo_actual,$centrob_id,$cuadrobm_id,$detapre_cantidad,$detpretmp_id,$egrec_id_v,$centro_redpublica,$DB_gogess);
         
		
		 $lista_aenviar[]=$array_asignaciondata;
		 
		 //================================================================================
		 } 
	 
	     //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		 }
	  
	     $rs_lprecuentas->MoveNext();
	  
	  }
  }	  


if(count($lista_aenviar)>0)
{

//print_r($lista_aenviar);

$gen_egre="INSERT INTO dns_egresocentros ( egrec_ncomprobante, egrec_nmemo, emp_id, centro_id, centrod_id, egrec_representante, egrec_fecha, egrec_responsableentrega, egrec_grado, egrec_cedula, egrec_funcion, egrec_personalrecibe, egrec_nombrerecibe, egrec_cedularecibe, usua_id, egrec_fecharegistro, usuapr_id, egrec_procesado, egrec_fechaprocesa, egrec_anulado, egrec_fechaanulado, egrec_usanula, usuareci_id, egrec_recibido, egrec_fecharecibe, tipom_id, tipomov_id, destv_id, egrec_tipo, egrec_motivo, egrec_otrosdestino,precuped_id) VALUES
('".$egrec_ncomprobante."','".$egrec_nmemo."','".$emp_id."','".$centro_id."','".$centrod_id."','".$egrec_representante."','".$egrec_fecha."','".$egrec_responsableentrega."','".$egrec_grado."','".$egrec_cedula."','".$egrec_funcion."','".$egrec_personalrecibe."','".$egrec_nombrerecibe."','".$egrec_cedularecibe."','".$usua_id."','".$egrec_fecharegistro."','".$usuapr_id."','".$egrec_procesado."','".$egrec_fechaprocesa."','".$egrec_anulado."','".$egrec_fechaanulado."','".$egrec_usanula."','".$usuareci_id."','".$egrec_recibido."','".$egrec_fecharecibe."','".$tipom_id."','".$tipomov_id."','".$destv_id."','".$egrec_tipo."','".$egrec_motivo."','".$egrec_otrosdestino."','".$precuped_id."');";

$rs_okegre = $DB_gogess->executec($gen_egre);
$egreg_gen=0;
$egreg_gen=$DB_gogess->funciones_nuevoID(0);


for($i=0;$i<count($lista_aenviar);$i++)
{
    
	for($j=0;$j<count($lista_aenviar[$i]);$j++)
	{
	
	   //echo $lista_aenviar[$i][$j]."<br>";
	   $desglosa_id=array();
	   $desglosa_id=explode("|",$lista_aenviar[$i][$j]);
	   //print_r($desglosa_id);
	   //=======================================================
	  
	   $cuadrobm_id=$desglosa_id[3];
       $cantidad_val=$desglosa_id[1];
       $egrec_id=$egreg_gen;
       $moviin_id=$desglosa_id[0];
	   
	   $detpretmp_id=$desglosa_id[4];
	  
	   $busca_egreso="select * from dns_egresocentros where egrec_id='".$egrec_id."'";
       $rs_egreso = $DB_gogess->executec($busca_egreso);
       $tipom_id=$rs_egreso->fields["tipom_id"];
       $tipomov_id=$rs_egreso->fields["tipomov_id"];
	  
	   $valoralet=mt_rand(1,5);
       //sleep($valoralet);
	  
	   $busca_disponible="select * from dns_principalmovimientoinventario where moviin_id='".$moviin_id."'";
       $rs_bdispo = $DB_gogess->executec($busca_disponible);
       $valor_movimiento=0;
       $valor_movimiento=$rs_bdispo->fields["moviin_totalenunidadconsumo"];

       $lista_ent="select sum(moviin_totalenunidadconsumo) as entregadot from  dns_principalmovimientoinventario where (moviintranscent_id='".$moviin_id."') and centro_id='55' and tipom_id=2 and tomfis_id>0 and 	cuadrobm_id='".$cuadrobm_id."'";
						
       $rs_ent = $DB_gogess->executec($lista_ent);
       $entregadot=0;
       $entregadot=$rs_ent->fields["entregadot"];
	   
	   $busca_asig="select sum(cantidad_val) as totalegreso from dns_temporaldespacho inner join dns_egresocentros on 	dns_temporaldespacho.egrec_id=dns_egresocentros.egrec_id where moviin_id='".$moviin_id."' and egrec_anulado=0";
	   $rs_asig = $DB_gogess->executec($busca_asig);
		
	   $cantidad_asig=0;		
	    if(@$rs_asig->fields["totalegreso"])
		{
		  $cantidad_asig=$rs_asig->fields["totalegreso"];
		}
		else
		{
		  $cantidad_asig=0;
		}
		
		$restante_valor=$valor_movimiento-$cantidad_asig-$entregadot;
		
		if($cantidad_val<=$restante_valor)
		{
		$valor_nuevo=$restante_valor-$cantidad_val;
		
		//inserta==================================================================
		$usua_id=$_SESSION['ces1313777_sessid_inicio'];
		$tempdsp_fecharegistro=date("Y-m-d H:i:s");
		
		if($cantidad_val>0)
		{
		$inserta_despacho="insert into dns_temporaldespacho (egrec_id,cuadrobm_id,cantidad_val,usua_id,tempdsp_fecharegistro,moviin_id,tipom_id,tipomov_id,detpretmp_id) values ('".$egrec_id."','".$cuadrobm_id."','".$cantidad_val."','".$usua_id."','".$tempdsp_fecharegistro."','".$moviin_id."','".$tipom_id."','".$tipomov_id."','".$detpretmp_id."')";
		$rs_despacho = $DB_gogess->executec($inserta_despacho);
		
		//echo $inserta_despacho."<br>";
		}
		//inserta==================================================================
		
		}
	  
	  //=======================================================
	  
	}
	

}



}

?>
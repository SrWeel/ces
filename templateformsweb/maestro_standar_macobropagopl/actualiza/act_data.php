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

$crb_id=$_POST["crb_id"];
$crb_fechaac=$_POST["crb_fechaac"];
$crb_ncomprobanteac=$_POST["crb_ncomprobanteac"];
$crb_descripcionac=$_POST["crb_descripcionac"];
$cuentb_idac=$_POST["cuentb_idac"];
$cuentb_idactual=$_POST["cuentb_idactual"];

$actualizax="update lpin_masivocobropago set crb_fecha='".$crb_fechaac."',crb_ncomprobante='".$crb_ncomprobanteac."',crb_descripcion='".$crb_descripcionac."' where crb_id='".$crb_id."'";
$rs_acx = $DB_gogess->executec($actualizax,array());

$busca_data="select * from lpin_masivocobropago where crb_id='".$crb_id."'";
$rs_obtdatabd = $DB_gogess->executec($busca_data,array());

$crb_fecha=$rs_obtdatabd->fields["crb_fecha"];
$crb_ncomprobante=$rs_obtdatabd->fields["crb_ncomprobante"];
$crb_descripcion=$rs_obtdatabd->fields["crb_descripcion"];
//$cuentb_id=$rs_obtdatabd->fields["cuentb_id"];


$crb_enlace=$rs_obtdatabd->fields["crb_enlace"];
$sqllista_reg="select * from lpin_masivocobropagodetalle where crb_enlace='".$crb_enlace."'";
$lista_reg = $DB_gogess->executec($sqllista_reg,array());

if($lista_reg)
 {
	  while (!$lista_reg->EOF) {
	  
	     
		 if($lista_reg->fields["doccabcp_id"])
			{
			   
			   $busca="select * from lpin_cobropago where  crpadetmasivo_id='".$lista_reg->fields["crpadet_id"]."' and doccab_id='".$lista_reg->fields["doccabcp_id"]."'";
			   $rs_bude = $DB_gogess->executec($busca,array());
			   
			   $buscadeta="select * from lpin_cobropagodetalle where  crb_enlace='".$rs_bude->fields["crb_enlace"]."'";
			   $rs_budedeta = $DB_gogess->executec($buscadeta,array());
			   
			   
			   
			   $buscaasiento="select * from lpin_comprobantecontable where  comcont_tabla='lpin_cobropago' and comcont_idtabla='".$rs_bude->fields["crb_id"]."'";
			   $rs_buasiento = $DB_gogess->executec($buscaasiento,array());
			   
			   //busca cuenta
			   
			    $busca_cuentaxv="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idactual."'";
				$rs_cuentaxv = $DB_gogess->executec($busca_cuentaxv);
				$cuentb_cuentacontablevac=$rs_cuentaxv->fields["cuentb_cuentacontable"];
				
				$busca_cuentanuevac="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idac."'";
				$rs_cuentanuevac = $DB_gogess->executec($busca_cuentanuevac);
				$cuentb_cuentanuevac=$rs_cuentanuevac->fields["cuentb_cuentacontable"];
			   
			   //busca cuenta
			   //comcont_id
			   //comcont_enlace
			   
			    $busca_detallecambio="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_buasiento->fields["comcont_enlace"]."' and detcc_cuentacontable='".$cuentb_cuentacontablevac."'";
			   $rs_cuentcambio = $DB_gogess->executec($busca_detallecambio);
			   if($rs_cuentcambio)
 				{
					  while (!$rs_cuentcambio->EOF) {					  
					  
					     $actualizaac="update lpin_detallecomprobantecontable set detcc_cuentacontable='".$cuentb_cuentanuevac."' where detcc_id='".$rs_cuentcambio->fields["detcc_id"]."'";
						 $rs_actualiac = $DB_gogess->executec($actualizaac);
					  
					     $rs_cuentcambio->MoveNext();
					  }
	  
	  			}
				
				//busca cuenta
			   
			   
			   ///actualiza
			   
			   $actuali1="update lpin_cobropago set crb_fecha='".$crb_fecha."',crb_descripcion='".$crb_descripcion."',crb_ncomprobante='".$crb_ncomprobante."' where crb_id='".$rs_bude->fields["crb_id"]."'";
			   $rs_actu1 = $DB_gogess->executec($actuali1,array());
			   
			   $actualiza2="update lpin_cobropagodetalle set crpadet_fechaemision='".$crb_fecha."' where crb_enlace='".$rs_bude->fields["crb_enlace"]."'";
			   $rs_actu2 = $DB_gogess->executec($actualiza2,array());
			   
			   $actualiz3="update lpin_comprobantecontable set 	comcont_fecha='".$crb_fecha."' where  comcont_tabla='lpin_cobropago' and comcont_idtabla='".$rs_bude->fields["crb_id"]."'";
			   $rs_actu3 = $DB_gogess->executec($actualiz3,array());
			   
			   
			   
			   
$file = fopen("actualizacion".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$actuali1." -- ".$actualiza2." --> ".$actualiz3."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);
			   
			   ///actualiza
			   
			   
			
			}
		
		 if($lista_reg->fields["compracp_id"])
	       {
		        
		        $busca="select * from lpin_cobropago where  crpadetmasivo_id='".$lista_reg->fields["crpadet_id"]."' and compra_id='".$lista_reg->fields["compracp_id"]."'";
			    $rs_bude = $DB_gogess->executec($busca,array());
			   
			    $buscadeta="select * from lpin_cobropagodetalle where  crb_enlace='".$rs_bude->fields["crb_enlace"]."'";
			    $rs_budedeta = $DB_gogess->executec($buscadeta,array());
				
				$buscaasiento="select * from lpin_comprobantecontable where  comcont_tabla='lpin_cobropago' and comcont_idtabla='".$rs_bude->fields["crb_id"]."'";
			    $rs_buasiento = $DB_gogess->executec($buscaasiento,array());
				
				
				
				//busca cuenta
			   
			    $busca_cuentaxv="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idactual."'";
				$rs_cuentaxv = $DB_gogess->executec($busca_cuentaxv);
				$cuentb_cuentacontablevac=$rs_cuentaxv->fields["cuentb_cuentacontable"];
				
				$busca_cuentanuevac="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idac."'";
				$rs_cuentanuevac = $DB_gogess->executec($busca_cuentanuevac);
				$cuentb_cuentanuevac=$rs_cuentanuevac->fields["cuentb_cuentacontable"];
			   
			   //busca cuenta
			   //comcont_id
			   //comcont_enlace
			   
			   $busca_detallecambio="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_buasiento->fields["comcont_enlace"]."' and detcc_cuentacontable='".$cuentb_cuentacontablevac."'";
			   $rs_cuentcambio = $DB_gogess->executec($busca_detallecambio);
			   if($rs_cuentcambio)
 				{
					  while (!$rs_cuentcambio->EOF) {					  
					  
					     $actualizaac="update lpin_detallecomprobantecontable set detcc_cuentacontable='".$cuentb_cuentanuevac."' where detcc_id='".$rs_cuentcambio->fields["detcc_id"]."'";
						 $rs_actualiac = $DB_gogess->executec($actualizaac);
					  
					     $rs_cuentcambio->MoveNext();
					  }
	  
	  			}
			   
				//busca cuenta
				
				
				
				 ///actualiza
			   //cuentb_id='".$cuentb_id."'
			   $actuali1="update lpin_cobropago set crb_fecha='".$crb_fecha."',crb_descripcion='".$crb_descripcion."',crb_ncomprobante='".$crb_ncomprobante."' where crb_id='".$rs_bude->fields["crb_id"]."'";
			   $rs_actu1 = $DB_gogess->executec($actuali1,array());
			   
			   $actualiza2="update lpin_cobropagodetalle set crpadet_fechaemision='".$crb_fecha."' where crb_enlace='".$rs_bude->fields["crb_enlace"]."'";
			   $rs_actu2 = $DB_gogess->executec($actualiza2,array());
			   
			   $actualiz3="update lpin_comprobantecontable set 	comcont_fecha='".$crb_fecha."' where   comcont_tabla='lpin_cobropago' and comcont_idtabla='".$rs_bude->fields["crb_id"]."'";
			   $rs_actu3 = $DB_gogess->executec($actualiz3,array());
			   
			   
$file = fopen("log/actualizacion".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
fwrite($file,$_SESSION['ces1313777_sessid_inicio']."-->".$actuali1." -- ".$actualiza2." --> ".$actualiz3."-->".date("Y-m-d H:i:s"). PHP_EOL);
fclose($file);
			   
			   ///actualiza
			   
		   }
		   
		
		if($lista_reg->fields["crucue_cuenta"]!='')
		{
		//========================================= 
		$anti_idbu=0;
		$busca_listaant="select * from app_anticipos where crpadetmasivo_id='".$lista_reg->fields["crpadet_id"]."'";
		$rs_dataxcant = $DB_gogess->executec($busca_listaant,array());		
		$anti_idbu=$rs_dataxcant->fields["anti_id"];		
		if($anti_idbu>0)
		{		   
		       	$busca_cb="select distinct cuentb_id,entif_nombre,cuentb_cuentacontable from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_id."'";
			    $rs_cb = $DB_gogess->executec($busca_cb, array());			
			    $cuentb_cuentacontable=$rs_cb->fields["cuentb_cuentacontable"];
		
		        $buscaasiento="select * from lpin_comprobantecontable where  comcont_tabla='app_anticipos' and comcont_idtabla='".$anti_idbu."'";
			    $rs_buasiento = $DB_gogess->executec($buscaasiento,array());
				
				
				//busca cuenta
			   
			    //$busca_cuentaxv="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idactual."'";
				//$rs_cuentaxv = $DB_gogess->executec($busca_cuentaxv);
				//$cuentb_cuentacontablevac=$rs_cuentaxv->fields["cuentb_cuentacontable"];
				
				//$busca_cuentanuevac="select * from lpin_cuentasbancarias_vista where cuentb_id='".$cuentb_idac."'";
				//$rs_cuentanuevac = $DB_gogess->executec($busca_cuentanuevac);
				//$cuentb_cuentanuevac=$rs_cuentanuevac->fields["cuentb_cuentacontable"];
			   
			   //busca cuenta
			   //comcont_id
			   //comcont_enlace
			   
			   //$busca_detallecambio="select * from lpin_detallecomprobantecontable where comcont_enlace='".$rs_buasiento->fields["comcont_enlace"]."' and detcc_cuentacontable='".$cuentb_cuentacontablevac."'";
			   //$rs_cuentcambio = $DB_gogess->executec($busca_detallecambio);
			   //if($rs_cuentcambio)
 				//{
					//  while (!$rs_cuentcambio->EOF) {					  
					  
					  //   $actualizaac="update detcc_cuentacontable='".$cuentb_cuentanuevac."' where detcc_id='".$rs_cuentcambio->fields["detcc_id"]."'";
						// $rs_actualiac = $DB_gogess->executec($actualizaac);
					  
					     //$rs_cuentcambio->MoveNext();
					 // }
	  
	  			//}
			   
                //busca cuenta
				
				
				
				//anti_ctabancaria='".$cuentb_cuentacontable."',
				$actualiza2="update app_anticipos set anti_fechaemision='".$crb_fecha."',anti_descripcion='".$crb_descripcion."',anti_comprobante='".$crb_ncomprobante."' where anti_id='".$anti_idbu."'";
			    $rs_actu2 = $DB_gogess->executec($actualiza2,array());
				
				$actualiz3="update lpin_comprobantecontable set comcont_fecha='".$crb_fecha."' where  comcont_tabla='app_anticipos' and comcont_idtabla='".$anti_idbu."'";
			    $rs_actu3 = $DB_gogess->executec($actualiz3,array());
				
				$file = fopen("log/actualizacion".date("Y-m-d")."_".@$_SESSION['ces1313777_centro_id'].".txt", "a+");
				fwrite($file,$_SESSION['ces1313777_sessid_inicio']."--> -- ".$actualiza2." --> ".$actualiz3."-->".date("Y-m-d H:i:s"). PHP_EOL);
				fclose($file);
		    
		
		}	
		//==================
		
		}
		
	    
		 $lista_reg->MoveNext();
	  }
	  
  }	  

?>



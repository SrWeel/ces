<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

$lista_pacsql="";
$lista_pacientesx="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id=2";
$rs_tblplax = $DB_gogess->executec($lista_pacientesx,array());
if($rs_tblplax)
	{
		while (!$rs_tblplax->EOF) {
		
		
		/// campo nivel permif_id
		
		//$lista_pacsql.="select clie_id,usua_id from ".$rs_tblplax->fields["tab_name"]." where usua_id='".@$_SESSION['ces1313777_sessid_inicio']."' union ";
		//$lista_pacsql.="select clie_id,usua_id from ".$rs_tblplax->fields["tab_name"]." union ";
		
		$actualiza_tbl="ALTER TABLE ".$rs_tblplax->fields["fie_tablasubgrid"]." ADD prod_ac VARCHAR(20) NOT NULL AFTER cuabas_fecharegistro;";
		$rs_tblcmb = $DB_gogess->executec($actualiza_tbl,array());
		
		echo "Tabla Principal: ".$rs_tblplax->fields["tab_name"]." Tablas_contarifario:<b>".$rs_tblplax->fields["fie_tablasubgrid"]."</b><br><br>";
		
		$busca_codeportabla="select dns_centrosalud.centro_id,".$rs_tblplax->fields["tab_name"].".centro_id,cuabas_id,prod_codigo,permif_id,prod_precio from ".$rs_tblplax->fields["tab_name"]." inner join ".$rs_tblplax->fields["fie_tablasubgrid"]." on ".$rs_tblplax->fields["tab_name"].".".$rs_tblplax->fields["fie_campoenlacesub"]."=".$rs_tblplax->fields["fie_tablasubgrid"].".".$rs_tblplax->fields["fie_campoenlacesub"]." inner join dns_centrosalud on dns_centrosalud.centro_id=".$rs_tblplax->fields["tab_name"].".centro_id";
		echo $busca_codeportabla."<br><br>";
		
		$rs_codetable = $DB_gogess->executec($busca_codeportabla,array());
		if($rs_codetable)
	    {
			while (!$rs_codetable->EOF) {
			
			    $busca_codigoreal="select * from efacsistema_producto where prod_codigo='".$rs_codetable->fields["prod_codigo"]."' and prod_nivel='".$rs_codetable->fields["permif_id"]."';";
				$rs_bcodereal = $DB_gogess->executec($busca_codigoreal,array());
				
				//ver precio actual y precio real
				$varabilecomp='';
				if($rs_codetable->fields["prod_precio"]==$rs_bcodereal->fields["prod_precio"])
				{
				  $varabilecomp='';
				}
				else
				{
				  $varabilecomp='Alerta !!!';
				  echo "Centro:".$rs_codetable->fields["centro_id"]." Id: ".$rs_codetable->fields["cuabas_id"]." CodeProd:".$rs_codetable->fields["prod_codigo"]." Nivel: ".$rs_codetable->fields["permif_id"]." Precio:".$rs_codetable->fields["prod_precio"]." Precio Real: ".$rs_bcodereal->fields["prod_precio"]." ".$varabilecomp."<br>";
				  
				  $actualiza_dataval="update ".$rs_tblplax->fields["fie_tablasubgrid"]." set prod_precio='".$rs_bcodereal->fields["prod_precio"]."' where cuabas_id='".$rs_codetable->fields["cuabas_id"]."';";
				  $rs_acdatval = $DB_gogess->executec($actualiza_dataval,array());
				  echo $actualiza_dataval."<br><br>";
				}
				
				
				//echo $busca_codigoreal."<br>";
				
			
			$rs_codetable->MoveNext();
			}
		}
		
		
		echo "<hr>";
		
		//$actualiza_data="update ".$rs_tblplax->fields["fie_tablasubgrid"]." set prod_precio=(select ) ";
		/*$rs_buscal= $DB_gogess->executec($busca_codeportabla,array());
		if($rs_buscal)
	    {
			while (!$rs_buscal->EOF) {
			
			 //echo $rs_buscal->fields["prod_codigo"]
			// $rs_buscal->fields["prod_precio"]
			 
			 //$lista_tablas="select * from efacsistema_producto order by prod_codigo asc";
			
			  $rs_buscal->MoveNext();
			}
		}*/
		
		$rs_tblplax->MoveNext();
		}
	}	

?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");


$lista_tablas="select distinct stock_tabla from dns_stockactual where stock_tabla!=''";
$rs_tablas = $DB_gogess->executec($lista_tablas,array());
if($rs_tablas)
	{
		while (!$rs_tablas->EOF) {
		
		
		echo $rs_tablas->fields["stock_tabla"]."<br>";
		
		$busca_id="select fie_tablasubcampoid,tab_name,fie_campoenlacesub from gogess_sisfield where fie_tablasubgrid='".trim($rs_tablas->fields["stock_tabla"])."'";
		$rs_buid = $DB_gogess->executec($busca_id,array());
		
		if($rs_buid->fields["fie_tablasubcampoid"]=='plantra_id')
		{
		  //------------------------------------------------------------------------------------------------------
		  $busca_lossincentro="select * from ".$rs_tablas->fields["stock_tabla"]." where centrod_id=0 and plantra_fechadespacho!='0000-00-00 00:00:00' order by plantra_id asc limit  3000";
		  echo $busca_lossincentro."<br>";
		  $rs_buscacentroc= $DB_gogess->executec($busca_lossincentro,array());
		  if($rs_buscacentroc)
	      {
		     while (!$rs_buscacentroc->EOF) {
		       
			         
					  $busca_enstock="select * from dns_stockactual where stock_tabla='".$rs_tablas->fields["stock_tabla"]."' and stock_idtbla='".$rs_buscacentroc->fields["plantra_id"]."'";
					  $rs_centrod=$DB_gogess->executec($busca_enstock,array());
					  
					//  echo $busca_enstock."<br>";
					  echo "Centro despacho:".$rs_centrod->fields["centro_id"]."<br>";
					  
					  //centro emite receta
					  
					  echo $rs_buid->fields["tab_name"]."<br>";
					  echo $rs_buid->fields["fie_campoenlacesub"]."<br>";
					  $busca_centroemite="select * from ".$rs_buid->fields["tab_name"]." where ".$rs_buid->fields["fie_campoenlacesub"]."='".$rs_buscacentroc->fields[$rs_buid->fields["fie_campoenlacesub"]]."'";
					  $rs_buscacentroemite= $DB_gogess->executec($busca_centroemite,array());
					  echo "Centro emite:".$rs_buscacentroemite->fields["centro_id"]."<br>";
					  echo $busca_centroemite."<br>";
					  
					  if(trim($rs_buscacentroemite->fields["centro_id"]*1)!=($rs_centrod->fields["centro_id"]*1))
					  {
					  echo "Alerta!!!!!<br>";
					  }
					  
					  if($rs_centrod->fields["centro_id"]>0)
					  {
					    $actauliza_despacho="update ".$rs_tablas->fields["stock_tabla"]." set centrod_id='".$rs_centrod->fields["centro_id"]."' where plantra_id='".$rs_buscacentroc->fields["plantra_id"]."'";
						 $rs_depok= $DB_gogess->executec($actauliza_despacho,array());
						echo "<br><br>".$actauliza_despacho."<br>";
					  
					  }
					  
					  echo "<br><hr>";
					  
					  //obtienes centro despacho
					  
		  
		           $rs_buscacentroc->MoveNext();
				}
		  }	
		  		  
		  //------------------------------------------------------------------------------------------------------
		  
		}
		else
		{
		  //------------------------------------------------------------------------------------------------------
		  $busca_lossincentro="select * from ".$rs_tablas->fields["stock_tabla"]." where centrod_id=0 and plantrai_fechadespacho!='0000-00-00 00:00:00' order by plantrai_id asc limit  3000";
		  echo $busca_lossincentro."<br>";
		  $rs_buscacentroc= $DB_gogess->executec($busca_lossincentro,array());
		  if($rs_buscacentroc)
	      {
		     while (!$rs_buscacentroc->EOF) {
		       
			         
					  $busca_enstock="select * from dns_stockactual where stock_tabla='".$rs_tablas->fields["stock_tabla"]."' and stock_idtbla='".$rs_buscacentroc->fields["plantrai_id"]."'";
					  $rs_centrod=$DB_gogess->executec($busca_enstock,array());
					  
					  echo $busca_enstock."<br>";
					  echo "Centro despacho:".$rs_centrod->fields["centro_id"]."<br>";
					  
					  //centro emite receta
					  
					  echo $rs_buid->fields["tab_name"]."<br>";
					  echo $rs_buid->fields["fie_campoenlacesub"]."<br>";
					  $busca_centroemite="select * from ".$rs_buid->fields["tab_name"]." where ".$rs_buid->fields["fie_campoenlacesub"]."='".$rs_buscacentroc->fields[$rs_buid->fields["fie_campoenlacesub"]]."'";
					  $rs_buscacentroemite= $DB_gogess->executec($busca_centroemite,array());
					  echo "Centro emite:".$rs_buscacentroemite->fields["centro_id"]."<br>";
					  echo $busca_centroemite."<br>";
					  
					  if(trim($rs_buscacentroemite->fields["centro_id"]*1)!=($rs_centrod->fields["centro_id"]*1))
					  {
					  echo "Alerta!!!!!<br>";
					  }
					  
					  if($rs_centrod->fields["centro_id"]>0)
					  {
					    $actauliza_despacho="update ".$rs_tablas->fields["stock_tabla"]." set centrod_id='".$rs_centrod->fields["centro_id"]."' where plantrai_id='".$rs_buscacentroc->fields["plantrai_id"]."'"; 
						$rs_okatualiza= $DB_gogess->executec($actauliza_despacho,array());
						echo "<br><br>".$actauliza_despacho."<br>";
					  
					  }
					  
					  echo "<br><hr>";
					  
					  //obtienes centro despacho
					  
		  
		           $rs_buscacentroc->MoveNext();
				}
		  }	
		  		  
		  //------------------------------------------------------------------------------------------------------
		
		}
		
		
		
		
		
		
		$rs_tablas->MoveNext();
		}
	}	


/*
$lista_medicamentosinv="select * from dns_stockactual where stock_tabla!='' limit 200";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
if($rs_meicam)
	{
		while (!$rs_meicam->EOF) {
		
		echo "Id Stock:".$rs_meicam->fields["stock_id"]."<br>";
		echo "Tabla:".$rs_meicam->fields["stock_tabla"]." Id:".$rs_meicam->fields["stock_idtbla"]."<br>";
		
		echo "Id producto de tabla stock:".$rs_meicam->fields["cuadrobm_id"]."<br>";
		echo "Cantidad de tabla stock:".$rs_meicam->fields["stock_cantidad"]."<br>";
		
		$busca_id="select fie_tablasubcampoid from gogess_sisfield where fie_tablasubgrid='".trim($rs_meicam->fields["stock_tabla"])."'";
		$rs_buid = $DB_gogess->executec($busca_id,array());
			
		$busca_receta="select * from ".$rs_meicam->fields["stock_tabla"]." where ".$rs_buid->fields["fie_tablasubcampoid"]."='".$rs_meicam->fields["stock_idtbla"]."'";
		$rs_breceta = $DB_gogess->executec($busca_receta,array());
		
		if($rs_buid->fields["fie_tablasubcampoid"]=='plantra_id')
		{
		echo $rs_breceta->fields["plantra_codigo"]."<br>";
		$busca_prodidp="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$rs_breceta->fields["plantra_codigo"]."'";
		$rs_prodidp = $DB_gogess->executec($busca_prodidp,array());
		echo "Codigo poducto cuadro basico:".$rs_prodidp->fields["cuadrobm_id"]."<br>";
		echo "Cantidad en tabla ".$rs_meicam->fields["stock_tabla"].":".$rs_breceta->fields["plantra_cantidad"]."<br>";
		}
		else
		{
		echo $rs_breceta->fields["plantrai_codigo"]."<br>";
		$busca_prodidp="select cuadrobm_id from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$rs_breceta->fields["plantrai_codigo"]."'";
		$rs_prodidp = $DB_gogess->executec($busca_prodidp,array());
		echo "Codigo poducto cuadro basico:".$rs_prodidp->fields["cuadrobm_id"]."<br>";
		echo "Cantidad en tabla ".$rs_meicam->fields["stock_tabla"].":".$rs_breceta->fields["plantrai_cantidad"]."<br>";
		}
		
		
		echo "<br>Centro despacha en tabla ".$rs_meicam->fields["stock_tabla"]." :".$rs_breceta->fields["centrod_id"]."<br>";
		echo "Centro despacha en tabla dns_stockactual :".$rs_meicam->fields["centro_id"]."<br>";
		
		if($rs_breceta->fields["centrod_id"]==0)
		{
		    $actualiza="update ".$rs_meicam->fields["stock_tabla"]." set centrod_id='".$rs_meicam->fields["centro_id"]."' where ".$rs_buid->fields["fie_tablasubcampoid"]."='".$rs_breceta->fields[$rs_buid->fields["fie_tablasubcampoid"]]."'";
			echo $actualiza;
		
		}
		
		//echo $busca_receta."<br><hr><br>";
		echo "<br><hr><br>";
		
		
		
		$rs_meicam->MoveNext();
		}
	}	
*/

?>
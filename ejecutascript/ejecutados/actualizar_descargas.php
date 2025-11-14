<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

$lista_medicamentosinv="select count(*) as total from dns_cuadrobasicomedicamentos where categ_id=1";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total"]."<br>";

$lista_medicamentosinv="select count(*) as total2 from dns_cuadrobasicomedicamentos where categ_id=1 and cuadrobm_preciomedicamento>0";
$rs_meicam = $DB_gogess->executec($lista_medicamentosinv,array());
echo "Total:".$rs_meicam->fields["total2"]."<br>";






$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(3) and gogess_sistable.tab_name not in ('dns_imagenologiainfo')";
$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		echo $rs_tblpla->fields["fie_tablasubgrid"]."<br>";
		
		$rs_tblpla->MoveNext();
		}
	}	

$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(3) and gogess_sistable.tab_name not in ('dns_imagenologiainfo')";
$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		echo $rs_tblpla->fields["fie_tablasubgrid"]."<br>";
		
		$buscar_preioreal="select * from ".$rs_tblpla->fields["fie_tablasubgrid"]." inner join ".$rs_tblpla->fields["tab_name"]." on ".$rs_tblpla->fields["fie_tablasubgrid"].".".$rs_tblpla->fields["fie_campoenlacesub"]."=".$rs_tblpla->fields["tab_name"].".".$rs_tblpla->fields["fie_campoenlacesub"]."";
		//echo $buscar_preioreal."<br>";
		$rs_tcodigo = $DB_gogess->executec($buscar_preioreal,array());
		
		//echo $rs_tcodigo->fields["plantra_codigo"]."<br>";
		if($rs_tcodigo)
	    {
		while (!$rs_tcodigo->EOF) {
		
		//------------------------------------------------------------		
		if($rs_tcodigo->fields["plantra_codigo"]!='')
		{
		
		$busca_precio="select * from dns_cuadrobasicomedicamentos where cuadrobm_codigoatc='".$rs_tcodigo->fields["plantra_codigo"]."'";
		$rs_precio = $DB_gogess->executec($busca_precio,array());
		
		echo $busca_precio."<br>";
		
				//
		$actualiza_descarga="update ".$rs_tblpla->fields["fie_tablasubgrid"]." set plantra_preciocompra='".$rs_precio->fields["cuadrobm_preciomedicamento"]."',plantra_porcentajerestapreciotecho='6.5',plantra_porcentajeadm='10',plantra_porcentajeiva='0',plantra_valorplanilla='".$rs_precio->fields["cuadrobm_valorplanilla"]."',plantra_preciotechosinporcentaje='".$rs_precio->fields["cuadrobm_preciotechomenosporcentaje"]."' where plantra_id='".$rs_tcodigo->fields["plantra_id"]."'";
		
		$rs_actdesc = $DB_gogess->executec($actualiza_descarga,array());
		
		echo $actualiza_descarga."<br><hr><br>";
		
		}
		//-------------------------------------------------------------
		
		    $rs_tcodigo->MoveNext();
		  }
	    }
		
		//plantra_preciocompra=cuadrobm_preciomedicamento
		//plantra_porcentajerestapreciotecho=6.5
			//plantra_porcentajeadm=10
			//plantra_porcentajeiva=0
			//plantra_valorplanilla=cuadrobm_valorplanilla
			
		
		
		//echo $buscar_preioreal."<br>";
		
		$rs_tblpla->MoveNext();
		}
	}

/*
$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(4) and gogess_sistable.tab_name not in ('dns_imagenologiainfo')";
$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		//echo $rs_tblpla->fields["fie_tablasubgrid"]."<br>";
		
		$rs_tblpla->MoveNext();
		}
	}
	
$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(2) and gogess_sistable.tab_name not in ('dns_imagenologiainfo') and fie_tablasubgrid not in ('dns_cuadrobasico','dns_cuadrobasicocexterno','dns_cuadrobasicolab','dns_cuadrobasicoodontologia')";
$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		//echo $rs_tblpla->fields["fie_tablasubgrid"]."<br>";
		
		$rs_tblpla->MoveNext();
		}
	}	
	*/
?>
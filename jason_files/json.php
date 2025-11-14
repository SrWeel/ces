<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");

function utf8_converter($array)
{
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
        }
    });
 
    return $array;
}


$busca_siestructura="select tab_name from gogess_sistable where tab_estructura=1 and tab_name not in ('gogess_sisfield')";
// and tab_name='app_cliente'";
$rs_buscasi = $DB_gogess->executec($busca_siestructura,array());
if($rs_buscasi)
 {
     	while (!$rs_buscasi->EOF) {
		
		     $listacampos1="select fie_id, field_type, field_flags, fie_name, tab_name, fie_title, fie_titlereporte, fie_txtextra, fie_txtizq, fie_type, fie_typeweb, fie_evitaambiguo, fie_campoafecta, fie_camporecibe,  fie_style, fie_styleobj, fie_attrib, fie_valiextra, fie_value, fie_tabledb, fie_datadb, fie_sqlorder, fie_active, fie_activarprt, fie_obl, fie_sql, fie_group, fie_sendvar, fie_tactive, fie_lencampo, fie_lineas, fie_inactivoftabla, fie_orden, field_maxcaracter, fie_archivo, fie_mascara, fie_iconoarchivo, fie_activarbuscador, fie_ordengrid, fie_typereport, fie_guarda, fie_placeholder, fie_archivogrid, fie_groupprint, fie_anchocolomna, fie_tablasubgrid, fie_tablasubgridcampos, fie_tablasubcampoid, fie_campoenlacesub, fie_campofecharegistro, fie_tituloscamposgrid, fie_camposobligatoriosgrid, fie_camposgridselect, fie_alias, ttbl_id,fie_tblcombogrid,fie_campoidcombogrid,fie_crear,fie_tablabusca,fie_camposbusca,fie_campodevuelve   from gogess_sisfield where tab_name='".trim($rs_buscasi->fields["tab_name"])."' order by fie_orden";
			 
			// echo $listacampos1."<br>";
			 $nombre_tabla='';
			 $i=0;
			 $rawdata=array();
			 $rs_gogessform1 = $DB_gogess->executec($listacampos1,array());
			 if($rs_gogessform1)
			 {
			   while (!$rs_gogessform1->EOF) {
			   
				  
				  //-------------------------------------------------------
				   $nombre_tabla=$rs_gogessform1->fields["tab_name"];
				   $row=$rs_gogessform1->fields;
				   $rawdata[$i] = $row;	
				   $i++;			  
				  //-------------------------------------------------------
				  
				  
				   
				$rs_gogessform1->MoveNext();	
			   }
			 }
			 
			 //genera archivo
			 //print_r($rawdata);
			 $rawdata = utf8_converter($rawdata);
			// print_r($rawdata);
			 $contenido_json=json_encode($rawdata);
			 
			 $fp=fopen("estructura/".$nombre_tabla.".json","w+");
		     fwrite($fp,$contenido_json);
		     fclose($fp) ;
			 
			 //genera archivo
		     
			 
		
		   $rs_buscasi->MoveNext();
		
		}
 }		



?>
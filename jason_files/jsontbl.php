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


$busca_siestructura="select tab_name from gogess_sistable where tab_estructura=1";
// and tab_name='app_cliente'";
$rs_buscasi = $DB_gogess->executec($busca_siestructura,array());
if($rs_buscasi)
 {
     	while (!$rs_buscasi->EOF) {
		
		     $listacampos1="select tab_name,tab_title,tab_information,tab_bextras,tab_datosf,tab_valextguardar,tab_archivo,tab_formatotabla from gogess_sistable where tab_name='".trim($rs_buscasi->fields["tab_name"])."' order by tab_name asc";
			 
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
			 
			 $fp=fopen("tablas/".$nombre_tabla.".json","w+");
		     fwrite($fp,$contenido_json);
		     fclose($fp) ;
			 
			 //genera archivo
		     
			 
		
		   $rs_buscasi->MoveNext();
		
		}
 }		



?>
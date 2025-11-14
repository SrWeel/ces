<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$director='../';
include($director."cfg/clases.php");


$tag_inicial="<?php ";
$tag_final=" ?>";  

//por tabla

function generar_code_tbl($tabla,$tab_campogeneracion,$campoorden,$DB_gogess)
{
$tag_inicial="<?php ";
$tag_final=" ?>";  
$tablas_arr12=array();
$busca_siestructura="select tab_name from gogess_sistable where tab_estructura=1 and tab_name not in ('gogess_sistable','gogess_sisfield')";
$rs_buscasi = $DB_gogess->executec($busca_siestructura,array());
if($rs_buscasi)
 {
     	while (!$rs_buscasi->EOF) {
		
		$listacampos1="select fie_id, field_type, field_flags, fie_name, tab_name, fie_title, fie_titlereporte, fie_txtextra, fie_txtizq, fie_type, fie_typeweb, fie_evitaambiguo, fie_campoafecta, fie_camporecibe,  fie_style, fie_styleobj, fie_attrib, fie_valiextra, fie_value, fie_tabledb, fie_datadb, fie_sqlorder, fie_active, fie_activarprt, fie_obl, fie_sql, fie_group, fie_sendvar, fie_tactive, fie_lencampo, fie_lineas, fie_inactivoftabla, fie_orden, field_maxcaracter, fie_archivo, fie_mascara, fie_iconoarchivo, fie_activarbuscador, fie_ordengrid, fie_typereport, fie_guarda, fie_placeholder, fie_archivogrid, fie_groupprint, fie_anchocolomna, fie_tablasubgrid, fie_tablasubgridcampos, fie_tablasubcampoid, fie_campoenlacesub, fie_campofecharegistro, fie_tituloscamposgrid, fie_camposobligatoriosgrid, fie_camposgridselect, fie_alias, ttbl_id from gogess_sisfield where tab_name='".trim($rs_buscasi->fields["tab_name"])."' order by fie_orden";
		 
		 $rs_gogessform1 = $DB_gogess->executec($listacampos1,array());
		 if($rs_gogessform1)
         {
     	   while (!$rs_gogessform1->EOF) {
		   
		      $nombre_tabla='';
			  $nombre_array='';
			  $nombre_array=trim($rs_gogessform1->fields["tab_name"])."|".trim($rs_gogessform1->fields["fie_name"]);
		      $tablas_arr12[$nombre_array]=$rs_gogessform1->fields;
			  
			  $nombre_tabla=$rs_gogessform1->fields["tab_name"];
			   
		    $rs_gogessform1->MoveNext();	
		   }
		 }
		 
		// print_r($tablas_arr1);
		 $tablas_arr2='';
         $tablas_arr2=preg_replace("/[\r\n\n\r]+/", " ", var_export($tablas_arr12,true));
		 //$tablas_arr2=var_export($tablas_arr12,true);
		 
		 $stringarreglo2=$tablas_arr2;
		 $gogess_sisfield='gogess_sisfield';
		 $stringarreglo2="$$gogess_sisfield=".$stringarreglo2."; 
		  ";
		  
		 $fp=fopen("../libreria/estructura/".$nombre_tabla.".php","w+");
		 fwrite($fp,$tag_inicial." ".$stringarreglo2." ".$tag_final);
		 fclose($fp) ;
		
		 $tablas_arr12=array();
		
		$rs_buscasi->MoveNext();	
		}
  }	



}



//funcion generar codigo
function generar_code($tabla,$tab_campogeneracion,$campoorden,$DB_gogess)
{

if($tabla=='gogess_sisfield')
					{
$listacampos1="select fie_id, field_type, field_flags, fie_name, tab_name, fie_title, fie_titlereporte, fie_txtextra, fie_txtizq, fie_type, fie_typeweb, fie_evitaambiguo, fie_campoafecta, fie_camporecibe,  fie_style, fie_styleobj, fie_attrib, fie_valiextra, fie_value, fie_tabledb, fie_datadb, fie_sqlorder, fie_active, fie_activarprt, fie_obl, fie_sql, fie_group, fie_sendvar, fie_tactive, fie_lencampo, fie_lineas, fie_inactivoftabla, fie_orden, field_maxcaracter, fie_archivo, fie_mascara, fie_iconoarchivo, fie_activarbuscador, fie_ordengrid, fie_typereport, fie_guarda, fie_placeholder, fie_archivogrid, fie_groupprint, fie_anchocolomna, fie_tablasubgrid, fie_tablasubgridcampos, fie_tablasubcampoid, fie_campoenlacesub, fie_campofecharegistro, fie_tituloscamposgrid, fie_camposobligatoriosgrid, fie_camposgridselect, fie_alias, ttbl_id from ".$tabla." order by ".$campoorden;
}
else
{

$listacampos1="select * from ".$tabla." order by ".$campoorden;
}


$rs_gogessform = $DB_gogess->executec($listacampos1,array());

 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
			$busca_siestructura="select tab_estructura from gogess_sistable where tab_estructura=1 and tab_name='".trim($rs_gogessform->fields["tab_name"])."'";
			$rs_buscasi = $DB_gogess->executec($busca_siestructura,array());
			
		    if($rs_buscasi->fields["tab_estructura"]==1)
			{
					//echo $rs_gogessform->fields["tab_name"]."<br>";
					if($tabla=='gogess_sisfield')
					{
					$tablas_arr1[$rs_gogessform->fields["tab_name"]."|".$rs_gogessform->fields["fie_name"]]=$rs_gogessform->fields;
					}
					else
					{
					$tablas_arr1[$rs_gogessform->fields[$tab_campogeneracion]]=$rs_gogessform->fields;
					}
					
		     }
		$rs_gogessform->MoveNext();	
		}
		
 }
$tablas_arr1=preg_replace("/[\r\n\n\r]+/", " ", var_export($tablas_arr1,true));
$tablas_arr1=str_replace(" '","'",$tablas_arr1);
$tablas_arr1=str_replace(" '","'",$tablas_arr1);
$tablas_arr1=str_replace(" '","'",$tablas_arr1);
$tablas_arr1=str_replace(", ",",",$tablas_arr1);
$tablas_arr1=str_replace(", ",",",$tablas_arr1);
$tablas_arr1=str_replace(", ",",",$tablas_arr1);
$tablas_arr1=str_replace(", ",",",$tablas_arr1);
$tablas_arr1=str_replace(" array ","array",$tablas_arr1);
$tablas_arr1=str_replace(" array","array",$tablas_arr1);
$tablas_arr1=str_replace(" array","array",$tablas_arr1);
$tablas_arr1=str_replace(" array","array",$tablas_arr1);

//echo $tablas_arr;
$stringarreglo2=$tablas_arr1;
$gogess_sisfield=$tabla;
$stringarreglo2="
 $$gogess_sisfield=".$stringarreglo2."; 
  ";
//echo $stringarreglo2;
return $stringarreglo2;

}
//funcion generar codigo
function generar_code_combo($tabla,$tab_campogeneracion,$campoorden,$DB_gogess)
{

$listacampos1="select * from ".$tabla." order by ".$campoorden;
$rs_gogessform = $DB_gogess->executec($listacampos1,array());
 
 $numera=0;
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
		
		$tablas_arr1[$numera]=$rs_gogessform->fields;
		$numera++;
		
		$rs_gogessform->MoveNext();	
		}
 }
$tablas_arr1=var_export($tablas_arr1,true);
//echo $tablas_arr;
$stringarreglo2=$tablas_arr1;
$gogess_sisfield=$tabla;
$stringarreglo2="
 $$gogess_sisfield=".$stringarreglo2."; 
  ";

return $stringarreglo2;

}


//ejecutando

$listatablas="select * from gogess_sistable where instan_id in (?,?) and tab_compilar=?";
$rs_listatablas = $DB_gogess->executec($listatablas,array(1,3,1));

//$rs_listatablas = $DB_gogess->Execute($listatablas);

$ib=0;
 if($rs_listatablas)
 {
     while (!$rs_listatablas->EOF) {	
		
		echo "Tabla generada:".$rs_listatablas->fields["tab_name"]."<br>";
		
		if($rs_listatablas->fields["instan_id"]==1)
		{
		$lista_tablas[$ib]=generar_code($rs_listatablas->fields["tab_name"],$rs_listatablas->fields["tab_campogeneracion"],$rs_listatablas->fields["tab_campoorden"],$DB_gogess);
		}
		
		if($rs_listatablas->fields["instan_id"]==3)
		{
		$lista_tablas[$ib]= generar_code_combo($rs_listatablas->fields["tab_name"],$rs_listatablas->fields["tab_campogeneracion"],$rs_listatablas->fields["tab_campoorden"],$DB_gogess);
		}
		//-------------------------------------------------------
		
		
		$fp=fopen("../libreria/estructura/".$rs_listatablas->fields["tab_name"].".php","w+");
		fwrite($fp,$tag_inicial." ".$lista_tablas[$ib]." ".$tag_final);
		fclose($fp) ;
		
		
		/*$fp=fopen("../../../libreria/estructura/".$rs_listatablas->fields["tab_name"].".php","w+");
		fwrite($fp,$tag_inicial." ".$lista_tablas[$ib]." ".$tag_final);
		fclose($fp) ;*/
		
		//-------------------------------------------------------
		
		
		$ib++;
		
		$rs_listatablas->MoveNext();	
		} 
 
 }

 
 generar_code_tbl('gogess_sisfield','','',$DB_gogess);

 /* for ($ival=0;$ival<count($lista_tablas);$ival++)
  {
    $contenido.=$lista_tablas[$ival];
   
  }
  
  
  $contenido_total=$tag_inicial." ".$contenido." ".$tag_final;
  
*/

?>
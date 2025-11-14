<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4440000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$test_id=$_POST["fie_id"];
$obtiene_test="select * from appg_test where test_id='".$test_id."'";
$rs_test= $DB_gogess->executec($obtiene_test,array());

$nombre_tabla=$rs_test->fields["test_ntabla"];
$tabla_gridvalor=$nombre_tabla;

$separa_subindex=explode("_",$nombre_tabla);
$sub_index = substr($separa_subindex[1], 0, 4)."_";
//id tabla grid
$campo_id=$sub_index."id";


     $listav_campos='';
     $listavtitulos_campos='';
     $listav_camposfecha='';
     //busca campos
     $lista_campos="select * from appg_escala where test_id='".$test_id."'";
     $rs_lcampos= $DB_gogess->executec($lista_campos,array());
     if($rs_lcampos)
     {
        while (!$rs_lcampos->EOF)
			{
			    
			  $listav_campos.=$rs_lcampos->fields["esca_nameid"].",";
        	  $listavtitulos_campos.=$rs_lcampos->fields["esca_nombre"].",";
        	  if($rs_lcampos->fields["esca_obligatorio"]==1)
        	  {
        	  $listav_camposobl.=$rs_lcampos->fields["esca_nameid"].",";
        	  } 
        	  if($rs_lcampos->fields["tipda_id"]==2)
        	  {
        	    $listav_camposfecha.=$rs_lcampos->fields["esca_nameid"].",";
        	  }
			    
			  $rs_lcampos->MoveNext();  
			}
     }		


//campos tabla grid
$campos_dataedit=array();
$campos_dataedit=explode(",",$listav_campos);
$campos_datainserta=array();
$campos_datainserta=explode(",",$listav_campos);


$busca_lista="select * from ".$rs_test->fields["test_nombrebase"].".".$tabla_gridvalor." where ".$campo_id."=".$_POST[$campo_id."x"];
$rs_obtiene = $DB_gogess->executec($busca_lista,array());

echo '<input name="'.$campo_id.'xval" type="hidden" id="'.$campo_id.'xval" value="'.$rs_obtiene->fields[$campo_id].'" />';

for($i=0;$i<count($campos_dataedit);$i++)
	 {
		 if($rs_obtiene->fields[$campos_dataedit[$i]])
		 {
		 echo '<input name="'.$campos_dataedit[$i].'xval" type="hidden" id="'.$campos_dataedit[$i].'xval" value="'.$rs_obtiene->fields[$campos_dataedit[$i]].'" />';
		 }
	 }

?>
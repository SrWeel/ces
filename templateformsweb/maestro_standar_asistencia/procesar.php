<?php
ini_set("session.gc_maxlifetime","4445000");
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
 if (@$table)
  {
  $objtableform->select_templateform(@$table,$DB_gogess);	
  }
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;

$busca_plan="select * from faesa_biometricocarga where biom_id=".$_POST["biom_id"];
$rs_plan = $DB_gogess->executec($busca_plan,array());

$target_path="../../archivo/".trim($rs_plan->fields["biom_archivo"]);
$url = $target_path;
$aux=array();
$archivo = fopen($url,'r');
$numlinea=0;
while ($linea = fgets($archivo)) {
   //echo $linea.'<br/>';
    $aux[$numlinea] = explode("\t",$linea); 
	   
    $numlinea++;
}

fclose($archivo);

echo count($aux);

for($i=0;$i<count($aux);$i++)
{
    //print_r($aux[$i]);
	$fecha_hora=array();
	$fecha_hora=explode(" ",$aux[$i][1]);
	
	$insert_data="insert into faesa_biometrico (bio_codigousuario,bio_fecha,bio_hora,bio_marca,centro_id) values ('".trim($aux[$i][0])."','".$fecha_hora[0]."','".$fecha_hora[1]."','".trim($aux[$i][2])."','".$_POST["centro_id"]."')";
	$rs_okins = $DB_gogess->executec($insert_data);
	
	
  
}

echo "Archivo procesado";
?>
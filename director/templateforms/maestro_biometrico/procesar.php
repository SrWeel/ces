<?php
ini_set("session.gc_maxlifetime","144000");
session_start();
$director="../../";
include ("../../cfgclases/clases.php");

$busca_plan="select * from faesa_biometricocarga where biom_id=".$_POST["biom_id"];
$rs_plan = $DB_gogess->Execute($busca_plan);

$target_path="../../../archivo/".trim($rs_plan->fields["biom_archivo"]);
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
	
	$insert_data="insert into faesa_biometrico (bio_codigousuario,bio_fecha,bio_hora,bio_marca) values ('".trim($aux[$i][0])."','".$fecha_hora[0]."','".$fecha_hora[1]."','".trim($aux[$i][2])."')";
	$rs_okins = $DB_gogess->Execute($insert_data);
	
	
  
}

echo "Archivo procesado";
?>
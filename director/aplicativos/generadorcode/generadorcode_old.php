<?php
//sistable
$listacampostabla="select * from sibase_sistable";

 $rs_gogessform = $DB_gogess->Execute($listacampostabla);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
		$tablas_arr[$rs_gogessform->fields["tab_name"]]=$rs_gogessform->fields;
		
		$rs_gogessform->MoveNext();	
		}
 }
$tablas_arr=var_export($tablas_arr,true);
//echo $tablas_arr;

$stringarreglo=$tablas_arr;

$sibase_sistable='sibase_sistable';
$stringarreglo="<?php  $$sibase_sistable=".$stringarreglo."; ";

//sisfield

$listacampos1="select * from sibase_sisfield order by fie_orden asc";

 $rs_gogessform = $DB_gogess->Execute($listacampos1);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
		$tablas_arr1[$rs_gogessform->fields["tab_name"]."|".$rs_gogessform->fields["fie_name"]]=$rs_gogessform->fields;
		
		$rs_gogessform->MoveNext();	
		}
 }
$tablas_arr1=var_export($tablas_arr1,true);
//echo $tablas_arr;

$stringarreglo2=$tablas_arr1;

$sibase_sisfield='sibase_sisfield';
$stringarreglo2="
 $$sibase_sisfield=".$stringarreglo2."; 
  ";


// sibase_template

$listacampos2="select * from sibase_template";
 $rs_gogessform = $DB_gogess->Execute($listacampos2);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
		$tablas_arr2[$rs_gogessform->fields["tem_id"]]=$rs_gogessform->fields;
		
		$rs_gogessform->MoveNext();	
		}
 }
$tablas_arr2=var_export($tablas_arr2,true);
//echo $tablas_arr;

$stringarreglo3=$tablas_arr2;

$sibase_template='sibase_template';
$stringarreglo3="
 $$sibase_template=".$stringarreglo3."; 
  ?> ";
  
  




$contenido=$stringarreglo.$stringarreglo2.$stringarreglo3;
$fp=fopen("libreria/estructura/estructura.php","w+");
fwrite($fp,$contenido);
fclose($fp) ;


?>
<?php
include("libreria/estructura/estructura.php");


?>


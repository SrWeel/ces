<?php
$tag_inicial="<?php ";
$tag_final=" ?> ";  
//funcion generar codigo
function generar_code($tabla,$tab_campogeneracion,$campoorden,$DB_gogess)
{

$listacampos1="select * from ".$tabla." order by ".$campoorden;

 $rs_gogessform = $DB_gogess->Execute($listacampos1);
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {	
		
		if($tabla=='sibase_sisfield')
		{
		$tablas_arr1[$rs_gogessform->fields["tab_name"]."|".$rs_gogessform->fields["fie_name"]]=$rs_gogessform->fields;
		}
		else
		{
		$tablas_arr1[$rs_gogessform->fields[$tab_campogeneracion]]=$rs_gogessform->fields;
		}
		
		$rs_gogessform->MoveNext();	
		}
 }
$tablas_arr1=var_export($tablas_arr1,true);
//echo $tablas_arr;
$stringarreglo2=$tablas_arr1;
$sibase_sisfield=$tabla;
$stringarreglo2="
 $$sibase_sisfield=".$stringarreglo2."; 
  ";

return $stringarreglo2;

}
//funcion generar codigo



//ejecutando

$listatablas="select * from sibase_sistable where instan_id=1";
$rs_listatablas = $DB_gogess->Execute($listatablas);
$ib=0;
 if($rs_listatablas)
 {
     while (!$rs_listatablas->EOF) {	
		
		echo "Tabla generada:".$rs_listatablas->fields["tab_name"]."<br>";
		$lista_tablas[$ib]=generar_code($rs_listatablas->fields["tab_name"],$rs_listatablas->fields["tab_campogeneracion"],$rs_listatablas->fields["tab_campoorden"],$DB_gogess);
		$ib++;
		
		$rs_listatablas->MoveNext();	
		} 
 
 }


  for ($ival=0;$ival<count($lista_tablas);$ival++)
  {
    $contenido.=$lista_tablas[$ival];
   
  }
  
  
  $contenido_total=$tag_inicial." ".$contenido." ".$tag_final;
  

$contenido_txt=$contenido_total;
$fp=fopen("libreria/estructura/estructura_plus.php","w+");
fwrite($fp,$contenido_txt);
fclose($fp) ;


$contenido_txt=$contenido_total;
$fp=fopen("../libreria/estructura/estructura_plus.php","w+");
fwrite($fp,$contenido_txt);
fclose($fp) ;

?>
<?php
//include("libreria/estructura/estructura.php");


?>


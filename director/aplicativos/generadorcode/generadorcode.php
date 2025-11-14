<?php
ini_set("session.gc_maxlifetime","14400");
session_start();
//echo $_POST["pVar1"];
//Llamando objetos
$director="../../";
include ("../../cfgclases/clases.php");

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
		
		if($tabla=='gogess_sisfield')
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

 $rs_gogessform = $DB_gogess->Execute($listacampos1);
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

$listatablas="select * from gogess_sistable where instan_id in (1,3) and tab_compilar=1";
$rs_listatablas = $DB_gogess->Execute($listatablas);
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
		
		
		$fp=fopen("../../libreria/estructura/".$rs_listatablas->fields["tab_name"].".php","w+");
		fwrite($fp,$tag_inicial." ".$lista_tablas[$ib]." ".$tag_final);
		fclose($fp) ;
		
		
		$fp=fopen("../../../libreria/estructura/".$rs_listatablas->fields["tab_name"].".php","w+");
		fwrite($fp,$tag_inicial." ".$lista_tablas[$ib]." ".$tag_final);
		fclose($fp) ;
		
		//-------------------------------------------------------
		
		
		$ib++;
		
		$rs_listatablas->MoveNext();	
		} 
 
 }


  for ($ival=0;$ival<count($lista_tablas);$ival++)
  {
    @$contenido.=@$lista_tablas[$ival];
   
  }
  
  
  $contenido_total=$tag_inicial." ".$contenido." ".$tag_final;
  



?>


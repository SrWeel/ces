<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Content-Type: text/html; charset=UTF-8');
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$conn = $DB_gogess;


include("libreporte.php");
$objgridtablareporte=new listadoreportegrid();	

$hoyfecha=date("Y-m-d H:i:s");
$hoyfechac=date("Y-m-d");

	$campoafecta=trim($_POST["q"]);
	$datobusca=trim($_POST["q1"]);
	$divdata=trim($_POST["q2"]);
	$campoenlace=trim($_POST["q3"]);
	$tabla=trim($_POST["q4"]);
	$valor=trim($_POST["q5"]);


$objgridtablareporte->campo_campoafecta='';
$objgridtablareporte->campo_camporecibe='';
$objgridtablareporte->form_format_field($tabla,$campoafecta,$conn);


if (@$objgridtablareporte->fie_obl)
 {
	 if (!($objgridtablareporte->fie_txtextra))
	 {
	   if (!($objgridtablareporte->imprpt))
	   {
		  $objgridtablareporte->fie_txtextra="*";
		}  
	 }
 }

 if ($objgridtablareporte->campo_campoafecta)
 {    
   if($objgridtablareporte->fie_evitaambiguo)
   {
    $clicdata="onClick=showUser_combog('".$objgridtablareporte->campo_campoafecta."',$('#".$campoafecta."').val(),'div".$objgridtablareporte->campo_campoafecta."','".$objgridtablareporte->fie_evitaambiguo.".".$campoafecta."','".$objgridtablareporte->tab_name."','".$objgridtablareporte->contenid[$objgridtablareporte->campo_campoafecta]."',0,0,0,0,0) ";
	
	}
	else
	{
	
	$clicdata="onClick=showUser_combog('".$objgridtablareporte->campo_campoafecta."',$('#".$campoafecta."').val(),'div".$objgridtablareporte->campo_campoafecta."','".$campoafecta."','".$objgridtablareporte->tab_name."','".$objgridtablareporte->contenid[$objgridtablareporte->campo_campoafecta]."',0,0,0,0,0) ";
	}
	//echo  $clicdata;			 
	printf("<select name='%s' id='%s' class='%s' %s %s>",$campoafecta,$campoafecta,$objgridtablareporte->fie_styleobj,$objgridtablareporte->fie_attrib,$clicdata);          
	printf("<option value=''>---Seleccionar--</option>");  
	$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$valor," where ".$campoenlace."=".$datobusca." ".$objgridtablareporte->fie_sqlorder,$conn);
	printf("</select>%s",$objgridtablareporte->fie_txtextra);
		
}
else
{
  	
	$tipocampo="select ".$objgridtablareporte->campo_camporecibe." from ".$objgridtablareporte->campo_cmbtabla." ";
	
		
	$resultado1 = $conn->executec($tipocampo,array());
	if($resultado1)
	{
	//$resultado1 = mysql_query($tipocampo);
	
	$fld=$resultado1->FetchField(0);
	$nombre_campo=strtolower($fld->name);
	$typecampo=$resultado1->MetaType($fld->type);
	
	//$typecampo  = mysql_field_type($resultado1, 0);
			   
	if($typecampo="C")
	{
	printf("<select name='%s' id='%s' class='%s' %s >",$campoafecta,$campoafecta,@$objgridtablareporte->fie_styleobj,@$objgridtablareporte->fie_attrib);          
	printf("<option value=''>---Seleccionar--</option>");  
	$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$valor," where ".$objgridtablareporte->campo_camporecibe." = ".$datobusca." ".$objgridtablareporte->fie_sqlorder,$conn);
	printf("</select>%s",$objgridtablareporte->txtobligatorio);
	}
	else
	{
	printf("<select name='%s' id='%s' class='%s' %s >",$campoafecta,$campoafecta,$objgridtablareporte->fie_styleobj,$objgridtablareporte->fie_attrib);          
	printf("<option value=''>---Seleccionar--</option>");  
	$objgridtablareporte->fill_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$valor," where ".$objgridtablareporte->campo_camporecibe."=".$datobusca." ".$objgridtablareporte->fie_sqlorder,$conn);
	printf("</select>%s",$objgridtablareporte->txtobligatorio);
	}

  }

}	
							
?>

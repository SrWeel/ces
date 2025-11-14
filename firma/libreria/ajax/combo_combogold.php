
<?php
/***VARIABLES POR GET ***/

$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}

/***VARIABLES POR POST ***/

$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$$tags2[$i]=$valores2[$i]; 
}

?>
<?php

//Llamando objetos
include("../../libreria/formulario.php");
include("../../libreria/dbcc.php");
include("../../cfgclases/config.php");

//Conexion a la base de datos
  $objBd = new  conecc();
  $objBd->conectardb($basededatos,$host,$userdb,$passwdb);
  $objformulario = new  formulario();
  $link = $objBd->enlace;
//Valores globales

	$campoafecta=$_GET["q"];
	$datobusca=$_GET["q1"];
	$divdata=$_GET["q2"];
	$campoenlace=$_GET["q3"];
	$tabla=$_GET["q4"];
	$valor=$_GET["q5"];

$objformulario->field_aqualis($tabla,$campoafecta);

 if ($objformulario->fie_campoafecta)
 { 
   
   if($objformulario->fie_evitaambiguo)
   {
    $clicdata="onClick=showUser_combog('".$objformulario->fie_campoafecta."',window.document.fa.".$campoafecta.".value,'div".$objformulario->fie_campoafecta."','".$objformulario->fie_evitaambiguo.".".$campoafecta."','".$objformulario->tab_name."','".$objformulario->contenid[$objformulario->fie_campoafecta]."',0,0,0,0,0) ";
	
	}
	else
	{
	
	$clicdata="onClick=showUser_combog('".$objformulario->fie_campoafecta."',window.document.fa.".$campoafecta.".value,'div".$objformulario->fie_campoafecta."','".$campoafecta."','".$objformulario->tab_name."','".$objformulario->contenid[$objformulario->fie_campoafecta]."',0,0,0,0,0) ";
	}
	//echo  $clicdata;			 
	printf("<select name='%s' class='%s' %s %s>",$campoafecta,$objformulario->fie_styleobj,$objformulario->fie_attrib,$clicdata);          
	printf("<option value='-1'>---Seleccionar--</option>");  
	$objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$valor," where ".$campoenlace."=".$datobusca." ".$objformulario->fie_sqlorder);
	printf("</select>");
}
else
{
  	
	printf("<select name='%s' class='%s' %s >",$campoafecta,$objformulario->fie_styleobj,$objformulario->fie_attrib);          
	printf("<option value='-1'>---Seleccionar--</option>");  
	$objformulario->fill_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$valor," where ".$campoenlace."=".$datobusca." ".$objformulario->fie_sqlorder);
	printf("</select>");

}	
							
?>

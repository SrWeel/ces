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

$opcion=$_GET["q"];

$tema=$_GET["q1"];

$systemb=$_GET["q2"];
$sessid=$_GET["q3"];


if($opcion==1)
{
////////////////////////////////////////////////////////////

  
  $sql = "SELECT con_id,con_titulo,secp_id FROM kyradm_contenido WHERE secp_id  = '$tema' and con_activo=1 order by con_orden asc";
  $result = mysql_query($sql);
  $contador =1;
  
    $numitems = mysql_num_rows($result);
	$it=1;
	$iti=2;
	$itf=$numitems;
	$separadorm='|';
	
	if ($numitems>1)
	{
	//////////////////////////////----
			while(($row = mysql_fetch_array($result)) AND ($contador<=10))
			{
			////////////..........................
					 if($separadorm)
					{
						if ($it>=$iti and $it<=$itf)
						{
						  $separamenu="&nbsp;".$separadorm."&nbsp;";
						}
						else
						{
						  $separamenu="&nbsp;";
						}
					}	
					//seccion alterna link
					 $sql_tx = "SELECT secalt_id FROM kyradm_contenido WHERE con_id = ".$row["con_id"];
					  $result_tx = mysql_query($sql_tx);
					  if ($row_tx = mysql_fetch_array($result_tx))
						{
							$seccionalterno= $row_tx["secalt_id"];
						}
						
					if ($row["con_id"]==130)
						{
								if ($ar==$row["con_id"])
								 {
								   $currente='class="current"';
								   printf("<a  href='#'  %s  id='Organigrama' title='Organigrama'  onClick='veraplicacion(34,900,600,245,40);' %s class=temare><span>%s %s</span></a>",$currente,$linksubseccion,$separamenu,$row["con_titulo"]);
								   
								 }
								 else
								 { 
									$currente='';
									printf("<a  href='#'  %s  id='Organigrama' title='Organigrama' onClick='veraplicacion(34,900,600,245,40);'  %s class=temare><span>%s %s</span></a>",$currente,$linksubseccion,$separamenu,$row["con_titulo"]);
								 }
						 
						 }
					 else
	                 {
					 //++++
						if ($ar==$row["con_id"])
							 {
							   
							   
							   $currente='class="current"';
							   
								if($seccionalterno>0)
										{
											  printf("<a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s %s class=temare ><span>%s %s</span></a>",$seccionalterno,$row["con_id"],$this->systemb,$this->sessid,$currente,$linksubseccion,$separamenu,$row["con_titulo"]);
										}
										else
										{
											   
											   printf("<a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s %s class=temare><span>%s %s</span></a>",$row["secp_id"],$row["con_id"],$this->systemb,$this->sessid,$currente,$linksubseccion,$separamenu,$row["con_titulo"]);
										}	   
											   
							   
							 }
							 else
							 {
								$currente='';
								
										if($seccionalterno>0)
										  {
								
								printf("<a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s %s class=temare><span>%s %s</span></a>",$seccionalterno,$row["con_id"],$systemb,$sessid,$currente,$linksubseccion,$separamenu,$row["con_titulo"]);
										   }
										   else
										   {
										   
								 printf("<a  href='index.php?secc=1&seccionp=%s&ar=%s&system=%s&sessid=%s'  %s %s class=temare><span>%s %s</span></a>",$row["secp_id"],$row["con_id"],$systemb,$sessid,$currente,$linksubseccion,$separamenu,$row["con_titulo"]);		   
										   
										   
										   }
								 
								
							 }
					 
					 //++++	
					 			 
					 }
					$linksubseccion='';
	 $contador++;
	 $it++;
					//...................................	
		
			 }
   
   //////////////////////////////----
   }


//////////////////////////////////////////////////////////////////////
}
?>
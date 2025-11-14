<?php
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
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

$director="../../";

include("../../cfgclases/clases.php");
//Valores globales

$q=$_GET["q"];
$q1=$_GET["q1"];

?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
                <tr>
                  <td bgcolor="#D2E1E8" class="cssdetperfil"><div align="center"><strong>RESTRINGIDO</strong></div></td>
                  <td bgcolor="#D2E1E8" class="cssdetperfil"><div align="center"><strong>ACTIVO</strong></div></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#EAF1F2" class="cssdetperfiltxt">
				  
				  <?php	  
			
			
		
	if 	($q=='menu')
	{
	  
	   $listamenu=split("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	      
		  $nmenu=$objformulario->replace_cmb("gogess_menu","men_id,men_titulo","where men_id=",$listamenu[$i],$DB_gogess);
		  if ($nmenu)
		  {
	         echo $nmenu."<br>";
			 $listav= $listav.$listamenu[$i].',';
		  }
	   }
	}
	
	
		
	if 	($q=='imenu')
	{
	  
	   $listamenu=split("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	     
		  $inmenu=$objformulario->replace_cmb("gogess_itemmenu","ite_id,ite_titulo","where ite_id=",$listamenu[$i],$DB_gogess);
		  if ($inmenu)
		  {
	         echo $inmenu."<br>";
			 $listav= $listav.$listamenu[$i].',';
		 }
	   }
	}
			
			
	if 	($q=='tabla')
	{
	  
	   $listamenu=split("-",$q1);	
	   for($i=0;$i<=count($listamenu);$i++)
	   {
	     
		
		$btabla=  trim(str_replace(substr($listamenu[$i],0,2),"",$listamenu[$i]));
		  $ntabla=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like",$btabla,$DB_gogess);
		  if ($ntabla)
		  {
	         echo $ntabla."<br>";
			 $listav= $listav."'".$btabla."',";
		 }
	   }
	}  
	$listav=substr($listav,0,-1);
	if(!($listav))
	{
	  $listav=0;
	}
		?>				  </td>
                  <td valign="top" bgcolor="#EAF1F2" class="cssdetperfiltxt">
				  <?php
				  if 	($q=='menu')
					{
						//echo $listav;
				    	$listadoc="select * from gogess_menu where men_active=1 and men_id not in(".$listav.")";						
						$resultdoc = $DB_gogess->Execute($listadoc);						
						//$resultdoc = mysql_query($listadoc);						
						while (!$resultdoc->EOF) {						
									 $nmenuac=$objformulario->replace_cmb("gogess_menu","men_id,men_titulo","where men_id=",$resultdoc->fields[maymin("men_id")],$DB_gogess);
									 echo $nmenuac."<br>";									 
									  $resultdoc->MoveNext();
									}								
									
	  				}		  
				  
				  
				  if 	($q=='imenu')
					  {
					  
					    $listadoc="select * from gogess_itemmenu where ite_active=1 and ite_id not in(".$listav.")";
						$resultdoc = $DB_gogess->Execute($listadoc);	
						while (!$resultdoc->EOF) {	
										 
									 $inmenuac=$objformulario->replace_cmb("gogess_itemmenu","ite_id,ite_titulo","where ite_id=",$resultdoc->fields[maymin("ite_id")],$DB_gogess);
									 echo $inmenuac."<br>";
									 $resultdoc->MoveNext();
									}
					  
					  
					  }
					  
					  
				if 	($q=='tabla')
					{
					
					    $listadoc="select * from gogess_sistable where  tab_name not in(".$listav.")";						
						$resultdoc = $DB_gogess->Execute($listadoc);
						while (!$resultdoc->EOF) {
						
									 $ntablaac=$objformulario->replace_cmb("gogess_sistable","tab_name,tab_title","where tab_name like",$resultdoc->fields[maymin("tab_name")],$DB_gogess);
									 echo $ntablaac."<br>";
									 $resultdoc->MoveNext();
									 
									}
					
					}
	  
					  
				  
				  ?>				  </td>
                </tr>
              </table>
<?php
ini_set('display_errors',0);
//error_reporting(E_ALL);
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
require (dirname (__FILE__) . "/class-excel-xml.inc.php");

if(isset($_SESSION['sessidadm1777_pichincha']))
{

?><?php
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
include("libreporte.php");
$objgridtablareporte=new listadoreportegrid();	
$ival=0;
$pathcampos='campos';
$list_data="select * from sth_reportdetalle where rept_id=".$_GET["ireport"];
$resultlistat = $DB_gogess->Execute($list_data);

if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {				  
					 
					  $listacamposl[$ival]=$resultlistat->fields["reptdet_tabla"].".".$resultlistat->fields["reptdet_campo"];
					  
					  $concatenacampos.=$resultlistat->fields["reptdet_tabla"].".".$resultlistat->fields["reptdet_campo"].",";
					  
					  $ival++;
					  $resultlistat->MoveNext();
					  }
					 } 
					 
$reporte_data="select * from sth_report where rept_id=".$_GET["ireport"];
$resultdata = $DB_gogess->Execute($reporte_data);	
$nreporte=$resultdata->fields["rept_nombre"];		

//solotablas
$ival=0;
$list_datax="select distinct reptdet_tabla from sth_reportdetalle where rept_id=".$_GET["ireport"];

$resultlistatx = $DB_gogess->Execute($list_datax);

if($resultlistatx)
					{  
					  while (!$resultlistatx->EOF) {				  
					 
					  $listatablasx[$ival]=$resultlistatx->fields["reptdet_tabla"];
					  $ival++;
					  
					  $resultlistatx->MoveNext();
					  }
					 } 
		
		
		$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objformulario->replace_cmb("cata_tablas","tbl_nombre,tbl_campoprimario"," where tbl_nombre like",$listatablasx[$i],$DB_gogess);
				
				$campoprimario[$i]["tipo"]= $objformulario->replace_cmb("cata_tablas","tbl_nombre,tab_tipocampoprimariio"," where tbl_nombre like",$listatablasx[$i],$DB_gogess);
				
				
				
		}
		
		//print_r($campoprimario);
		
		for($z=0;$z<count($listatablasx)-1;$z++)
		{
			
			 // echo $listatablasx[$z];
			 
			 
			 
			 
			  $enlacestabla[$z]=" left join ".$listatablasx[$z+1]." on ".$listatablasx[$z].".".$campoprimario[$z]["primario"]."=".$listatablasx[$z+1].".".$campoprimario[$z]["primario"];
			  
			  
		}
		
		//forma consulta
		$consultaunion=$listatablasx[0];
		for ($sq=0;$sq<count($enlacestabla);$sq++)
		{
			$consultaunion.=$enlacestabla[$sq];
		}
		
		
			
	}			 
					 
					 
?>
<?php
//obtiene left join
	$listatablasdata="select * from sth_reportenlaces where rept_id=".$_GET["ireport"];
	
    $resultdatal = $DB_gogess->Execute($listatablasdata);

     if($resultdatal)
					{  
					  while (!$resultdatal->EOF) {				  
					 
					  $resultdatal->fields["rptenlc_tabla"];
					  $resultdatal->fields["rptenlc_campoa"];
					  $resultdatal->fields["rptenlc_campob"];
					  
					  if($resultdatal->fields["rptenlc_campoa"])
					  {
						  $gruposvla.=" left join ".$resultdatal->fields["rptenlc_tabla"]." on ".$resultdatal->fields["rptenlc_campoa"]."=".$resultdatal->fields["rptenlc_campob"];
					  }
					  else
					  {
						  $gruposvla.=" ".$resultdatal->fields["rptenlc_tabla"]." ";
						  
					  }
					 
					  
					  $resultdatal->MoveNext();
					  }
					 } 
	
	//obtine left join
	$consultaunion=$gruposvla;
    
    ?>

<?php
	//genera join
    
    $concatenacampos=substr($concatenacampos,0,-1);
	if(count($listatablasx)>1)
	{
		//for($i=0;$i<count($listatablasx);$i++)
			//{
				
		   
			//  $objgridtablareporte->form_format_tabla($listatablasx[$i],$DB_gogess);
			 // $separa_data=explode(",",$objgridtablareporte->tbl_campoprimario);
			 // $separa_tipo=explode(",",$objgridtablareporte->tab_tipocampoprimariio);		   
			  //print_r($separa_data);
		   
		  // }
		   $sqldata="select ".$concatenacampos." from ".$consultaunion;
	 }
	 else
	 {
	     $sqldata="select ".$concatenacampos." from ".$listatablasx[0];
	 
	 }  

	//genera consulta

 $jv=0;
		for($i=0;$i<count($listacamposl);$i++)
		{
		    
			  $listac=explode(".",$listacamposl[$i]);			
			  $objgridtablareporte->form_format_field($listac[0],$listac[1],$DB_gogess);
			  $tipo_camponormal=$objgridtablareporte->fie_type;
			  $tipo_camporeporte=$objgridtablareporte->fie_typereport;
			  //echo "Holass".$objgridtablareporte->fie_typereport."<br>";	
			  //echo "Holass".$objgridtablareporte->fie_type."<br>";
			 // echo $listac[1]."<br>";
			  $selecSql="select ".$listac[1]." from ".$listac[0]." limit 1";	
								 
				 $rs_script = $DB_gogess->Execute($selecSql);
				 $fld=$rs_script->FetchField(0);
				 
				 $typeSql=$rs_script->MetaType($fld->type);
	
				
				   $nombre_campo=$listac[1];
				   $ntabla=$listac[0];
			//  echo $objgridtablareporte->fie_type."<br>";
		 
		// echo $nombre_campo."-->".$typeSql."<br>";
			  if($_POST[$nombre_campo]!="" or $_POST[$nombre_campo."2"]!="")
			  {
		  
				//echo $objgridtablareporte->fie_type."<br>";
					switch ($typeSql) 
						{
						 case 'C':
							 {
							  if ($_POST[$nombre_campo]!=-1)
									{
										   if ($_POST[$nombre_campo])
											{
											$sql[$jv]=$ntabla.".".$nombre_campo." like '".$_POST[$nombre_campo]."' and ";	
											$jv++;
											}
									}
							 }
							 break;  
						
							 
						 case 'I':
							 { 
							 
					if(trim($objgridtablareporte->fie_typereport))
					{
						//-----------------------------------------------------------------------
						
						 if (trim($objgridtablareporte->fie_typereport)=='select' or trim($objgridtablareporte->fie_typereport)=='selectafecta' or trim($objgridtablareporte->fie_typereport)=='selectrecibe')
							   {
								   if ($_POST[$nombre_campo]!=-1)
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." =".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
								}
								else
								{
									if (is_numeric($_POST[$nombre_campo]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." >=".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
									if (is_numeric($_POST[$nombre_campo."2"]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." <=".$_POST[$nombre_campo."2"]." and ";
									  $jv++;	
									}
								
								}	
								
						
						
						//-----------------------------------------------------------------------
					}
					else
					{
							 
					//-----------------------------------------------------------	 
							   if ($objgridtablareporte->fie_type=='select' or $objgridtablareporte->fie_type=='selectafecta' or $objgridtablareporte->fie_type=='selectrecibe')
							   {
								   if ($_POST[$nombre_campo]!=-1)
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." =".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
								}
								else
								{
									if (is_numeric($_POST[$nombre_campo]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." >=".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
									if (is_numeric($_POST[$nombre_campo."2"]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." <=".$_POST[$nombre_campo."2"]." and ";
									  $jv++;	
									}
								
								}	
								
					//-----------------------------------------------------------			
					}
								
							 }
							 break; 
							 
						
							 
							 
						 case 'N':
							 { 
							   if ($objgridtablareporte->fie_type=='select' or $objgridtablareporte->fie_type=='selectafecta' or $objgridtablareporte->fie_type=='selectrecibe')
							   {
								   if ($_POST[$nombre_campo]!=-1)
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." =".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
								}
								else
								{
									if (is_numeric($_POST[$nombre_campo]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." >=".$_POST[$nombre_campo]." and ";
									  $jv++;	
									}
									if (is_numeric($_POST[$nombre_campo."2"]))
									{
									  $sql[$jv]=$ntabla.".".$nombre_campo." <=".$_POST[$nombre_campo."2"]." and ";
									  $jv++;	
									}
								
								}	
							 }
							 break; 	 
							 
						 case 'D':
							 {
								if ($_POST[$nombre_campo])
								{
								$sql[$jv]=$ntabla.".".$nombre_campo." >='".$_POST[$nombre_campo]."' and ";
								$jv++;
								}	
								
								if ($_POST[$nombre_campo."2"])
								{
								$sql[$jv]=$ntabla.".".$nombre_campo." <='".$_POST[$nombre_campo."2"]."' and ";
								$jv++;
								}
							 }
							 break; 	
							 
						 case 'T':
							 {
								if ($_POST[$nombre_campo])
								{
								$sql[$jv]=$ntabla.".".$nombre_campo." >='".$_POST[$nombre_campo]." 00:00:00' and ";
								$jv++;
								}	
								
								if ($_POST[$nombre_campo."2"])
								{
								$sql[$jv]=$ntabla.".".$nombre_campo." <='".$_POST[$nombre_campo."2"]." 23:59:59' and ";
								$jv++;
								}
							 }
							 break; 
							 	  
						 default:	  
									 
						}  
				}	
		  	 
	 } 
		 
for($i=0;$i<count($sql)+1;$i++)
		{
		  
          $sqlconcatena.=$sql[$i];
        }
 
 //echo $sqlconcatena;
  $ntabla="";
 // print_r($sql);
  $sqlconcatena=substr($sqlconcatena,0,-4);
  
 
  
  if($sqlconcatena)
  {
   $sqldata= $sqldata." where ".$sqlconcatena;
  }
	
	
	
	$objgridtablareporte->gridtabla($concatenacampos,$sqldata,$sqldata,$DB_gogess);
//	echo "<span class=csslista>N.Registros: ".$objgridtablareporte->totalreg."</span>" ;
	
	//print_r($objgridtablareporte->arrcamposn);
	
	?><?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): ?><?php //echo $camponom ?><?php 
		$datos_val[0][$nd]=$camponom;		
	$nd++;
	endforeach; ?><?php 
	  $idata=1;
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?><?php 
		
	 $reclista=1;
	 $kj=0;
	 $idata2=0;
	 foreach($objgridtablareporte->arrcampos as $camposdata): 
	    
		
		$campotabla=explode(".",$listacamposl[$kj]);
		
	    $objgridtablareporte->form_format_field($campotabla[0],$camposdata,$DB_gogess);		
		
		//echo $objgridtablareporte->field_type;
			if(!(trim($objgridtablareporte->field_type)=='int'))
			{
			  $comillaexcel="";
			}
			else
			{
			$comillaexcel="";
			}
			
		
		if ($objgridtablareporte->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];	
								   
				    $rmp= trim($objformulario->replace_cmb($objgridtablareporte->fie_tabledb,$objgridtablareporte->fie_datadb,$objgridtablareporte->fie_sql,$valorbus,$DB_gogess));
				   		   
				  }			 
			   else
			      {
			        $rmp= trim($datoslista[$camposdata]);			 
			      }		
		
		
		
		//echo '<td  nowrap class=csslista>'.$comillaexcel.$rmp.'</td>'; 	  
		
		$datos_val[$idata][$idata2]=$comillaexcel.$rmp;
		$comillaexcel="";
		$idata2++;
		
	  $kj++;
	  $reclista++;
	  ?><?php endforeach; 
		$idata++;
		?><?php endforeach; 
	}
	?><?php

//print_r($datos_val);
// generate excel file
$xls = new Excel_XML;
$xls->addArray ($datos_val);
$xls->generateXML ("reporte");

}
?>
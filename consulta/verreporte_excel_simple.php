<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
require (dirname (__FILE__) . "/class-excel-xml.inc.php");
require_once "../include/base_datos/base_datos.php";
$ini_config_bd = parse_ini_file("../include/base_datos/mysqlDriver.ini", true);

if($_SESSION['usr_codigo'])
{
@$usrperfil = intval($_POST["pUsrPerfil"]);

$bd = new base_datos($ini_config_bd["CONFIGURACION_BASE_DE_DATOS"]["DBMS"]);
$conn = $bd->conect();
$rs = NULL;
$esquema = "";
?><?php
//Llamando objetos
include("libreporte.php");
$objgridtablareporte=new listadoreportegrid();	
$ival=0;
$pathcampos='campos';
$list_data="select * from cata_reportdetalle inner join cata_tablas on cata_reportdetalle.reptdet_tabla=cata_tablas.tbl_id where rept_id=".$_GET["ireport"]." order by reptdet_id asc";
$resultlistat = $conn->Execute($list_data);

if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {				  
					 
					  $listacamposl[$ival]=$resultlistat->fields["tbl_nombre"].".".$resultlistat->fields["reptdet_campo"];
					  
					  
					  if($resultlistat->fields["reptdet_alias"])
					  {
					  $concatenacampos.=$resultlistat->fields["tbl_nombre"].".".$resultlistat->fields["reptdet_campo"]." as ".$resultlistat->fields["reptdet_alias"].",";
					  }
					  else
					  {
					  @$concatenacampos.=$resultlistat->fields["tbl_nombre"].".".$resultlistat->fields["reptdet_campo"].",";
					  }
					  
					 // $concatenacampos.=$resultlistat->fields["tbl_nombre"].".".$resultlistat->fields["reptdet_campo"].",";
					  
					  $ival++;
					  $resultlistat->MoveNext();
					  }
					 } 
					 
$reporte_data="select * from cata_report where rept_id=".$_GET["ireport"];
$resultdata = $conn->Execute($reporte_data);	
$nreporte=$resultdata->fields["rept_nombre"];		

//solotablas
$ival=0;
$list_datax="select distinct tbl_nombre from cata_reportdetalle inner join cata_tablas on cata_reportdetalle.reptdet_tabla=cata_tablas.tbl_id where rept_id=".$_GET["ireport"];

$resultlistatx = $conn->Execute($list_datax);

if($resultlistatx)
					{  
					  while (!$resultlistatx->EOF) {				  
					 
					  $listatablasx[$ival]=$resultlistatx->fields["tbl_nombre"];
					  $ival++;
					  
					  $resultlistatx->MoveNext();
					  }
					 } 
		
		
		$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objgridtablareporte->replace_cmb("cata_tablas","tbl_nombre,tbl_campoprimario"," where tbl_nombre like",$listatablasx[$i],$conn);
				
				$campoprimario[$i]["tipo"]= $objgridtablareporte->replace_cmb("cata_tablas","tbl_nombre,tbl_campoprimario"," where tbl_nombre like",$listatablasx[$i],$conn);
				
				
				
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
	$listatablasdata="select * from cata_reportenlaces where rept_id=".$_GET["ireport"];
	
    $resultdatal = $conn->Execute($listatablasdata);

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
						  @$gruposvla.=" ".$resultdatal->fields["rptenlc_tabla"]." ";
						  
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
				
		   
			//  $objgridtablareporte->form_format_tabla($listatablasx[$i],$conn);
			 // $separa_data=explode(",",$objgridtablareporte->tbl_campoprimario);
			 // $separa_tipo=explode(",",$objgridtablareporte->tbl_campoprimario);		   
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
			  $objgridtablareporte->form_format_field($listac[0],$listac[1],$conn);
			  $tipo_camponormal=$objgridtablareporte->campo_tipo;
			  @$tipo_camporeporte=$objgridtablareporte->campo_tiporeportee;
			  //echo "Holass".$objgridtablareporte->campo_tiporeporte."<br>";	
			  //echo "Holass".$objgridtablareporte->campo_tipo."<br>";
			 // echo $listac[1]."<br>";
			  $selecSql="select ".$listac[1]." from ".$listac[0]." limit 1";	
								 
				 $rs_script = $conn->Execute($selecSql);
				 $fld=$rs_script->FetchField(0);
				 
				 $typeSql=$rs_script->MetaType($fld->type);
	
				
				   $nombre_campo=$listac[1];
				   $ntabla=$listac[0];
			//  echo $objgridtablareporte->campo_tipo."<br>";
		 
		// echo $nombre_campo."-->".$typeSql."<br>";
			  if(@$_POST[$nombre_campo]!="" or @$_POST[$nombre_campo."2"]!="")
			  {
		  
				//echo $objgridtablareporte->campo_tipo."<br>";
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
							 
					if(trim($objgridtablareporte->campo_tiporeporte))
					{
						//-----------------------------------------------------------------------
						
						 if (trim($objgridtablareporte->campo_tiporeporte)=='select' or trim($objgridtablareporte->campo_tiporeporte)=='selectafecta' or trim($objgridtablareporte->campo_tiporeporte)=='selectrecibe')
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
							   if ($objgridtablareporte->campo_tipo=='select' or $objgridtablareporte->campo_tipo=='selectafecta' or $objgridtablareporte->campo_tipo=='selectrecibe')
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
							   if ($objgridtablareporte->campo_tipo=='select' or $objgridtablareporte->campo_tipo=='selectafecta' or $objgridtablareporte->campo_tipo=='selectrecibe')
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
		 
for($i=0;$i<count(@$sql)+1;$i++)
		{
		  
          @$sqlconcatena.=$sql[$i];
        }
 
 //echo $sqlconcatena;
  $ntabla="";
 // print_r($sql);
  $sqlconcatena=substr($sqlconcatena,0,-4);
  
 
  
  if($sqlconcatena)
  {
   $sqldata= $sqldata." where ".$sqlconcatena;
  }
	
	
	
	$objgridtablareporte->gridtabla($concatenacampos,$sqldata,$sqldata,$conn);
//	echo "<span class=csslista>N.Registros: ".$objgridtablareporte->totalreg."</span>" ;
	
	//print_r($objgridtablareporte->arrcamposn);
	
	?><?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): ?><?php //echo $camponom ?><?php 
   if(utf8_decode($camponom)!='Código')
   {
		$datos_val[0][$nd]=utf8_decode($camponom);	
		}	
	$nd++;
	endforeach; 
	
	$datos_val[0][$nd]="Competencia en raz&oacute;n de la materia";	
	$nd++;
	$datos_val[0][$nd]="Competencia en raz&oacute;n del territorio";	
	
	?><?php 
	$comillaexcel='';
	  $idata=1;
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?><?php 
		
	 $reclista=1;
	 $kj=0;
	 $idata2=0;
	 foreach($objgridtablareporte->arrcampos as $camposdata): 
	    
		
		$campotabla=explode(".",$listacamposl[$kj]);
		
	    $objgridtablareporte->form_format_field($campotabla[0],$camposdata,$conn);		
		
		//echo $objgridtablareporte->campo_tipo;
			if(!(trim($objgridtablareporte->field_type)=='int'))
			{
			  $comillaexcel="";
			}
			else
			{
			$comillaexcel="";
			}
			
		
		if ($objgridtablareporte->campo_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];	
								   
				    $rmp= trim($objgridtablareporte->replace_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->campo_cmbsql,$valorbus,$conn));
				   		   
				  }			 
			   else
			      {
			        $rmp= trim($datoslista[$camposdata]);			 
			      }		
		
		
		
		//echo '<td  nowrap class=csslista>'.$comillaexcel.$rmp.'</td>'; 	  
		$id_siscodigo=$datoslista["codigo_sis"];
		if($camposdata!='codigo_sis')
        {
		$datos_val[$idata][$idata2]=@$comillaexcel.utf8_decode($rmp);
		}
		$comillaexcel="";
		$idata2++;
		
	  $kj++;
	  $reclista++;
	  ?><?php endforeach; 
	  
	  $lista_materia="select materia.nombre from cata_dependencia_materia inner join materia on cata_dependencia_materia.codigom=materia.codigo  where codigo_sis=".$id_siscodigo;
		$rs_listamateria = $conn->Execute($lista_materia);

     if($rs_listamateria)
					{  
					  while (!$rs_listamateria->EOF) {			
					  
					  $lista_uno.=utf8_decode($rs_listamateria->fields["nombre"]).";";
					  
					  $rs_listamateria->MoveNext();
					  }
					 } 
	  
	  $datos_val[$idata][$idata2]=$lista_uno;
	  $lista_uno='';
	  
	  $lista_territorio="SELECT 	cata_dependencia_territorio.ctrtrr_id,cata_dependencia_territorio.codigo_sis,cata_dependencia_territorio.codigop,provincia.nombre as pnombre,canton.nombre as cnombre,cata_parroquia.parr_nombre
		FROM cata_dependencia_territorio inner join provincia on cata_dependencia_territorio.codigop=provincia.codigo
		left join canton on cata_dependencia_territorio.codigoc=canton.codigo
		left join cata_parroquia on cata_dependencia_territorio.codigoprr=cata_parroquia.parr_codigo
		WHERE cata_dependencia_territorio.codigo_sis ='".$id_siscodigo."'";
		$rs_listaterritorio = $conn->Execute($lista_territorio);

     if($rs_listaterritorio)
					{  
					  while (!$rs_listaterritorio->EOF) {			
					  
					 $lista_dos.=utf8_decode($rs_listaterritorio->fields["pnombre"]." ".$rs_listaterritorio->fields["cnombre"]." ".$rs_listaterritorio->fields["parr_nombre"].";");
					  
					  $rs_listaterritorio->MoveNext();
					  }
					 } 
	  
	  
	  $idata2++;
	  $datos_val[$idata][$idata2]=$lista_dos;
	  $lista_dos='';
	  
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
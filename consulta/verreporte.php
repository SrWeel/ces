<?php
ini_set('display_errors',0);
//error_reporting(E_ALL);
//error_reporting(0);
// Notificar solamente errores de ejecución
//error_reporting(E_ERROR);
header('Content-Type: text/html; charset=UTF-8');
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$sql='';
$director='../';
include("../cfg/clases.php");
include("../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

 $typeSqlv='';
 $typeSql='';
$conn = $DB_gogess;

//print_r($_POST);

if(!(@$_POST["prob_codigo"]))
{
$_POST["prob_codigo"]=$_POST["pCodProv"];

}
$reportevar=7;
include("libreporte.php");
$concatenacampos='';
$objgridtablareporte=new listadoreportegrid();	
$ival=0;
$pathcampos='campos';
$list_data="select * from sth_reportdetalle inner join gogess_sistable on sth_reportdetalle.reptdet_tabla=gogess_sistable.tab_name where rept_id=".$reportevar;
$resultlistat = $conn->executec($list_data,array());

if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {				  
					 
					  $listacamposl[$ival]=$resultlistat->fields["tab_name"].".".$resultlistat->fields["reptdet_campo"];
					  
					 
					  if(@$resultlistat->fields["reptdet_alias"])
					  {
					  $concatenacampos.=$resultlistat->fields["tab_name"].".".$resultlistat->fields["reptdet_campo"]." as ".$resultlistat->fields["reptdet_alias"].",";
					  }
					  else
					  {
					  @$concatenacampos.=$resultlistat->fields["tab_name"].".".$resultlistat->fields["reptdet_campo"].",";
					  }
					  
					  
					  $ival++;
					  $resultlistat->MoveNext();
					  }
					 } 
					 
			 
$reporte_data="select * from sth_report where rept_id=".$reportevar;
$resultdata = $conn->executec($reporte_data,array());	
$nreporte=$resultdata->fields["rept_nombre"];		

//solotablas
$ival=0;
$list_datax="select distinct reptdet_tabla from sth_reportdetalle inner join gogess_sistable on sth_reportdetalle.reptdet_tabla=gogess_sistable.tab_name where rept_id=".$reportevar;

$resultlistatx = $conn->executec($list_datax,array());

if($resultlistatx)
					{  
					  while (!$resultlistatx->EOF) {				  
					 
					  $listatablasx[$ival]=$resultlistatx->fields["reptdet_tabla"];
					  $ival++;
					  
					  $resultlistatx->MoveNext();
					  }
					 } 
					 
	//print_r($listatablasx);
	
	@$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objgridtablareporte->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like",$listatablasx[$i],$conn);
				
				$campoprimario[$i]["tipo"]= $objgridtablareporte->replace_cmb("gogess_sistable","tab_name,tab_tipocampoprimariio"," where tab_name like",$listatablasx[$i],$conn);
				
				
				
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
	

	//obtiene left join
	$listatablasdata="select * from sth_reportenlaces where rept_id=".$reportevar;
	
    $resultdatal = $conn->executec($listatablasdata,array());

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
<style type="text/css">
<!--
/*listas*/
.cmbforms {
	font-family: Arial, Helvetica;
	color: #000000;
	text-decoration: none;
	font-weight: normal;
	font-size: 11px;
}
.OKcampo{
	font-family: Arial, Helvetica;
	color: #000000;
	text-decoration: none;
	font-weight: normal;
	font-size: 11px;
}
.csstitulo{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
.linklista{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
}
.csslista{
font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;

	text-decoration: none;

}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}

.css_bordetitulo
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
	border: 1px solid #000000;

}
.css_bordetexto
{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: normal;
	text-decoration: none;
	border: 1px solid #000000;	
}

-->
</style>
<script type="text/javascript">
<!--

function showUser_combog(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
 $("#"+str2).load("combo_combog.php",{q:str,q1:str1,q2:str2,q3:str3,q4:str4,q5:str5,q6:str6,q7:str7,q8:str8,q9:str9,q10:str10},function(result){ });  
 $("#"+str2).html("Espere un momento...");

}

function enviar_formulario(){
   window.document.fa.action="";
   window.document.fa.target = '_top';   
   window.document.fa.submit();
} 

function enviar_excel(){
   window.document.fa.action="verreporte_excel.php?ireport=<?php echo @$reportevar; ?>";
   window.document.fa.target = '_new';
   window.document.fa.submit();
} 

function limpiar_form()
{
$("#provincia").val('');
$("#canton").val('');
$("#nombre").val('');
$("#direccion").val('');
$("#telefono").val('');
}
-->
</script>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="2">
	  <div  class="csstitulo">
      </div>
	  
	  
	  </td>
  </tr>
  <tr>
  <td colspan="2" >
  
  
  <form action="" method="post" name="fa"  id="fa">
  
  <table border="0"  cellspacing="0">
  <tr>
    <td valign="top"><table  border="0" cellpadding="2" cellspacing="2">
	 <?php
	
		for($i=0;$i<3;$i++)
		{
		  
		  $listac=explode(".",$listacamposl[$i]);		
	
	
		  $objgridtablareporte->form_format_field($listac[0],$listac[1],$conn);
		  
		     $selecSql="select ".$listac[1]." from ".$listac[0];			 		 		 
			 $rs_script = $conn->executec($selecSql,array());
			 $fld=$rs_script->FetchField(0);			 
			 $typeSqlv=$rs_script->MetaType($fld->type);
			 $nombre_campo=$listac[1];
			 
			 
			 
			 switch ($typeSqlv) 
				{
				 case 'C':
					 {
					     $typeSql='string';
					 }
					 break;  
				
					 
				 case 'I':
					 { 
					   	  $typeSql='int';
					 }
					 break;			 
					 
				 case 'N':
					 { 
					     $typeSql='int';
					 }
					 break; 	 
					 
				 case 'D':
					 {
						  $typeSql='string';
					 }
					 break; 	 
				 default:	  
							 
				}  
			
			//echo $nombre_campo.":".$typeSqlv."<br>";
			//echo $nombre_campo.":".$objgridtablareporte->campo_tiporeporte."<br>";
			
              if($objgridtablareporte->campo_tiporeporte)
			{
			    if ($typeSqlv=="T" or $typeSqlv=="D" )
							{
							   include($pathcampos."/fecha.php");
							}
							else
							{
							   include($pathcampos."/".$objgridtablareporte->campo_tiporeporte.".php");
							}
			
			}
			else
			{
				
		      if ($objgridtablareporte->campo_tipo  )
					{
					    if ($typeSqlv=="T" or $typeSqlv=="D" )
						{
						   include($pathcampos."/fecha.php");
						}
						else
						{
						   include($pathcampos."/".$objgridtablareporte->campo_tipo.".php");
						}
					}
			}
					
		  	  
		 } 
	
	?>
	</table></td>
    <td>
	
	<table  border="0" cellpadding="2" cellspacing="2">
	 <?php
	 
		for($i=3;$i<6;$i++)
		{
		  
		  $listac=explode(".",$listacamposl[$i]);		
	
	
		  $objgridtablareporte->form_format_field($listac[0],$listac[1],$conn);
		  
		     $selecSql="select ".$listac[1]." from ".$listac[0];			 		 		 
			 $rs_script = $conn->executec($selecSql,array());
			 $fld=$rs_script->FetchField(0);			 
			 $typeSqlv=$rs_script->MetaType($fld->type);
			 $nombre_campo=$listac[1];
			 
			 switch ($typeSqlv) 
				{
				 case 'C':
					 {
					     $typeSql='string';
					 }
					 break;  
				
					 
				 case 'I':
					 { 
					   	  $typeSql='int';
					 }
					 break;			 
					 
				 case 'N':
					 { 
					     $typeSql='int';
					 }
					 break; 	 
					 
				 case 'D':
					 {
						  $typeSql='string';
					 }
					 break; 	 
				 default:	  
							 
				}  
			
			//echo $nombre_campo.":".$typeSqlv."<br>";
			//echo $nombre_campo.":".$objgridtablareporte->campo_tiporeporte."<br>";
			
              if($objgridtablareporte->campo_tiporeporte)
			{
			    if ($typeSqlv=="T" or $typeSqlv=="D" )
							{
							   include($pathcampos."/fecha.php");
							}
							else
							{
							   include($pathcampos."/".$objgridtablareporte->campo_tiporeporte.".php");
							}
			
			}
			else
			{
				
		      if ($objgridtablareporte->campo_tipo  )
					{
					    if ($typeSqlv=="T" or $typeSqlv=="D" )
						{
						   include($pathcampos."/fecha.php");
						}
						else
						{
						   include($pathcampos."/".$objgridtablareporte->campo_tipo.".php");
						}
					}
			}
					
		  	  
		 } 
	
	?>
	</table>
	
	</td>
  </tr>
</table>

		   
	
	
	       <input name="Bot&oacute;n" type="button" id="Enviar" value="Ejecutar consulta" onclick="desplegar_consulta_b()">  <input name="Bot&oacute;n" type="button" onClick="desplegar_consulta()" value="Limpiar consulta">
		  <!-- <input type="button" name="Submit" value="A excel"  onclick="enviar_excel()" /> -->
	</form>
  
  
  
  
  </td>
  
  </tr>
  <tr>
  <?php
  if (!(@$banderaimp))
{
  ?>
    <td width="18%" valign="top" bgcolor="#EFF5F5"> 
	
	
	</td>
	<?php
	}
	?>
	
    <td width="82%" valign="top">&nbsp;
	<?php
	//genera join
    
    $concatenacampos=substr($concatenacampos,0,-1);
	if(count($listatablasx)>1)
	{
		//for($i=0;$i<count($listatablasx);$i++)
			//{
	   
			 // $objgridtablareporte->form_format_tabla($listatablasx[$i],$conn);
			 // $separa_data=explode(",",$objgridtablareporte->tab_campoprimario);
			 // $separa_tipo=explode(",",$objgridtablareporte->tab_tipocampoprimariio);		   

		   //}
		    $sqldata="select ".$concatenacampos." from ".$consultaunion;
	 }
	 else
	 {
	     $sqldata="select ".$concatenacampos." from ".$listatablasx[0];
	 
	 }  
	 
	 //echo $sqldata;

	//genera consulta
	
	//print_r($listacamposl);


 $jv=0;
		for($i=0;$i<count($listacamposl);$i++)
		{
		    
			  $listac=explode(".",$listacamposl[$i]);			
			  
			  $objgridtablareporte->form_format_field($listac[0],$listac[1],$conn);
			  $tipo_camponormal=$objgridtablareporte->campo_tipo;
			  $tipo_camporeporte=$objgridtablareporte->campo_tiporeporte;
			  //echo "Holass".$objgridtablareporte->campo_tiporeporte."<br>";	
			  //echo "Holass".$objgridtablareporte->campo_tipo."<br>";
			 // echo $listac[1]."<br>";
			  $selecSql="select ".$listac[1]." from ".$listac[0]." limit 1";	
								 
				 $rs_script = $conn->executec($selecSql,array());
				 $fld=$rs_script->FetchField(0);
				 
				 $typeSql=$rs_script->MetaType($fld->type);
	
				
				   $nombre_campo=$listac[1];
				   $ntabla=$listac[0];
			//  echo $objgridtablareporte->campo_tipo."<br>";
		 
		//echo $nombre_campo."-->".$typeSql."<br>";
			  if(@$_POST[$nombre_campo]!="" or @$_POST[$nombre_campo."2"]!="")
			  {
		  
				//echo $objgridtablareporte->campo_tipo."<br>";
					switch ($typeSql) 
						{
						
						case 'X':
							 {
							  if ($_POST[$nombre_campo]!=-1)
									{
										   if ($_POST[$nombre_campo])
											{
											$sql[$jv]=$ntabla.".".$nombre_campo." like '%".$_POST[$nombre_campo]."%' and ";	
											$jv++;
											}
									}
							 }
							 break;  
						 case 'C':
							 {
							  if ($_POST[$nombre_campo]!=-1)
									{
										   if ($_POST[$nombre_campo])
											{
											$sql[$jv]=$ntabla.".".$nombre_campo." like '%".$_POST[$nombre_campo]."%' and ";	
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
		 
for($i=0;$i<count($sql)+1;$i++)
		{
		  
          @$sqlconcatena.=$sql[$i];
        }
 
 
 
// echo $sqlconcatena;
  $ntabla="";
 // print_r($sql);
  $sqlconcatena=substr($sqlconcatena,0,-4);
  
 
  
  if($sqlconcatena)
  {
   $sqldata= $sqldata." where ".$sqlconcatena;
  }
	
	//echo $sqldata;
	
	
	$objgridtablareporte->gridtabla($concatenacampos,$sqldata,$sqldata,$conn);
	echo "<span class=csslista>N.Registros: ".$objgridtablareporte->totalreg."</span>" ;
	
	?>

	<table width="500px" cellpadding="3" cellspacing="3"  style="border-collapse: collapse;" >
      <tr bgcolor="#CCCCCC">
        <?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): 
   if($nd>0)
   {
   ?>
        <td  nowrap="nowrap" bgcolor="#D9EBF2" class="css_bordetitulo" ><?php echo $camponom ?></td>
		
        <?php
		} 
	$nd++;
	endforeach; ?>
	
      </tr>
      <?php 
	  $comillaexcel='';
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?>
      <tr bgcolor="#ffffff"  onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'" >
        <?php 
	 $reclista=1;
	 $kj=0;
	 foreach($objgridtablareporte->arrcampos as $camposdata): 
	    
		
		$campotabla=explode(".",$listacamposl[$kj]);
		
	    $objgridtablareporte->form_format_field($campotabla[0],$camposdata,$conn);		
		if(@$_POST["ex1"])
		{
			if(!(trim($objgridtablareporte->field_type)=='int'))
			{
			  $comillaexcel="'";
			}
			else
			{
			$comillaexcel="";
			}
		}	
		// print_r($datoslista);
		if ($objgridtablareporte->campo_value=="replace")
			     {			
				//echo $objgridtablareporte->campo_cmbtcampo."<br>";
				  $valorbus=trim($datoslista[$camposdata]);	
								   
				    $rmp= $objgridtablareporte->replace_cmb($objgridtablareporte->campo_cmbtabla,$objgridtablareporte->campo_cmbtcampo,$objgridtablareporte->campo_cmbsql,$valorbus,$conn);
				   		   
				  }			 
			   else
			      {
			        $rmp= $datoslista[$camposdata];			 
			      }		
		
		$objgridtablareporte->campo_value='';
		$objgridtablareporte->campo_cmbtcampo='';
		$objgridtablareporte->campo_cmbtcampo='';
		$objgridtablareporte->campo_cmbsql='';
		
		//$id_siscodigo=$datoslista["codigo_sis"];
		if($kj>0)
		{
		echo '<td  nowrap class="css_bordetexto" >'.@$comillaexcel.$rmp.'</td>'; 	  
	     }  
	  $kj++;
	  $reclista++;
	  ?>
        <?php endforeach; 
			?>
      </tr>
	  
      <?php endforeach; 
	}
	?>
    </table>
	
	
	</td>
  </tr>
</table>




<script type="text/javascript">
<!--
$( "#fecha_creacion" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_creacion2" ).datepicker({dateFormat: 'yy-mm-dd'});
//  End -->
</script>



<?php

?>
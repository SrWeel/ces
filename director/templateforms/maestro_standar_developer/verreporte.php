<?php
ini_set('display_errors',0);
//error_reporting(E_ALL);
if (@$_POST["ex1"]=='true' or @$_POST["ex1"]==1)
{
 $fechahoy=date("Y-m-d");
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
 $banderaimp=1;
}
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles


// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
///
	if ($tags[$i]=='mp')
	{
	///
		if (preg_match('/^[a-z\d_=]{1,200}$/i', $valores[$i])) {
			$$tags[$i]=$valores[$i];
		}
		else
		{
			$$tags[$i]=0;
	    }
	///
	}
///
}


if(@$mp)
{   
   @$decodevalor = base64_decode($mp);
}


$splitvar=explode("&",@$decodevalor);

for($ivari=0;$ivari<count($splitvar);$ivari++)
{
 // echo $splitvar[$ivari]."<br>";
  $sacadatav=explode("=",$splitvar[$ivari]);
  
  //if (preg_match('/^[a-z\d_=]{1,10}$/i',$sacadatav[1])) {
  
  @$$sacadatav[0]=$sacadatav[1];
  
  //}

}

include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm1777_pichincha']))
{
?>
<link type="text/css" href="../../css/ui-lightness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.18.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ui.mask.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ui.datepicker-es.js"></script>
<script type="text/javascript" src="../../js/jquery.timer2.js"></script> 
<script type="text/javascript" src="../../js/jquery.validate.js"></script>
<script type="text/javascript" src="../../js/additional-methods.js"></script>
<script type="text/javascript" src="../../js/jquery.form.js"></script>
<script type="text/javascript" src="../../js/jquery.printPage.js"></script>

<script type="text/javascript" src="../../js/jquery.formatCurrency.js"></script>

<script type="text/javascript" src="../../js/jquery.fixheadertable.js"></script>
<script src="../../js/jquery.pwstrength.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="../../js/jquery.idletimer.js"></script>

<?php  
if($_GET["ireport"])
{
$ireport=$_GET["ireport"];
}


$concatenacampos='';
$gruposvla='';
//Llamando objetos
$director="../../";
include("../../cfgclases/clases.php");
include("libreporte.php");
$objgridtablareporte=new listadoreportegrid();	
$ival=0;
$pathcampos='campos';
$list_data="select * from sth_vddetalle where vardev_id=".$ireport;
$resultlistat = $DB_gogess->Execute($list_data);
$isegmento=0;
if($resultlistat)
					{  
					  while (!$resultlistat->EOF) {				  
					 
					  $listacamposl[$ival]=$resultlistat->fields["vardevdet_tabla"].".".$resultlistat->fields["vardevdet_campo"];
					
					  
					  
					  if(trim($resultlistat->fields["vardevdet_tabla"]))
					  {
					     $concatenacampos.=$resultlistat->fields["vardevdet_tabla"].".".$resultlistat->fields["vardevdet_campo"].",";
					  }
					  
					  if(trim($resultlistat->fields["vardevdet_tabla"])=='')
					  {
					      
						  
						  $campo_operaciones=$resultlistat->fields["vardevdet_operation"];
						  $lista_campos_ing="select * from sth_vddetalle inner join gogess_sisfield on tab_name=vardevdet_tabla and fie_name=vardevdet_campo where vardev_id=".$ireport;
						  $result_cmp = $DB_gogess->Execute($lista_campos_ing);
						  
						  if($result_cmp)
						  { 
						  
							  while (!$result_cmp->EOF) {	
							  
								  if($result_cmp->fields["vardevdet_tabla"])
								  {
									   $nombre_field=str_replace(":","",$result_cmp->fields["fie_title"]);
									   
									   $campo_operaciones=str_replace($nombre_field,$result_cmp->fields["fie_name"], $campo_operaciones);
									   
									
									  
									 
								  }
							  
							  $result_cmp->MoveNext();
							  }
							  
						  }
						 
						 $lista_op[$isegmento]["ncampo"]=$resultlistat->fields["vardevdet_campo"];
						 $lista_op[$isegmento]["valor"]="(".trim($campo_operaciones).")";
						  $isegmento++;
						 //echo $campo_operaciones."<br>";
						  
				          //echo $resultlistat->fields["vardevdet_campo"];
						
						  
					     // $concatenacampos.=" (".$campo_operaciones.") as ".$resultlistat->fields["vardevdet_campo"]." ".",";  
						  
					  }
					  
					  
					  
					  $ival++;
					  $resultlistat->MoveNext();
					  }
					 } 
	
	
	
	//print_r($lista_op);
	$calculados='';
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		$calculados.=  $lista_op[$iar]["valor"]." as ".$lista_op[$iar]["ncampo"].",";
		
	}
	
	
	
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		
		$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
		
	}
	for($iar=0;$iar<count($lista_op);$iar++)
	{
		
		$calculados=str_replace("[".$lista_op[$iar]["ncampo"]."]",$lista_op[$iar]["valor"],$calculados);
		
	}
	
	
	

	
	$concatenacampos.=$calculados;
	
	//$text = preg_replace("/\balgo(s)?\b/i", "otra cosa", "esto es algo bonito de algodon");  
	
//echo  $concatenacampos;					 
$reporte_data="select * from rose_variabledeveloper where vardev_id=".$_GET["ireport"];
$resultdata = $DB_gogess->Execute($reporte_data);	
$nreporte=$resultdata->fields["rept_nombre"];		

//solotablas
$ival=0;
$list_datax="select distinct vardevdet_tabla from sth_vddetalle where vardev_id=".$_GET["ireport"];

$resultlistatx = $DB_gogess->Execute($list_datax);

if($resultlistatx)
					{  
					  while (!$resultlistatx->EOF) {				  
					 
					 if($resultlistatx->fields["vardevdet_tabla"])
					 {
					  $listatablasx[$ival]=$resultlistatx->fields["vardevdet_tabla"];
					  $ival++;
					 }
					  
					  $resultlistatx->MoveNext();
					  }
					 } 
					 
	//print_r($listatablasx);
	
	$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_campoprimario"," where tab_name like",$listatablasx[$i],$DB_gogess);
				
				$campoprimario[$i]["tipo"]= $objformulario->replace_cmb("gogess_sistable","tab_name,tab_tipocampoprimariio"," where tab_name like",$listatablasx[$i],$DB_gogess);
				
				
				
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
	$listatablasdata="select * from sth_vdenlaces where vardev_id=".$_GET["ireport"];
	
    $resultdatal = $DB_gogess->Execute($listatablasdata);

     if($resultdatal)
					{  
					  while (!$resultdatal->EOF) {				  
					 
					  $resultdatal->fields["vardevenlc_tabla"];
					  $resultdatal->fields["vardevenlc_campoa"];
					  $resultdatal->fields["vardevenlc_campob"];
					  
					  if($resultdatal->fields["vardevenlc_campoa"])
					  {
						  $gruposvla.=" left join ".$resultdatal->fields["vardevenlc_tabla"]." on ".$resultdatal->fields["vardevenlc_campoa"]."=".$resultdatal->fields["vardevenlc_campob"];
					  }
					  else
					  {
						  $gruposvla.=" ".$resultdatal->fields["vardevenlc_tabla"]." ";
						  
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

.css_obj{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.css_objtxt{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}

-->
</style>
<script type="text/javascript">
<!--
function enviar_formulario(){
   window.document.fa.action="";
   window.document.fa.target = '_top';   
   window.document.fa.submit();
} 

function enviar_excel(){
   window.document.fa.action="verreporte_excel.php?ireport=<?php echo $_GET["ireport"]; ?>";
   window.document.fa.target = '_new';
   window.document.fa.submit();
} 
-->
</script>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="2">
	  <div align="center" class="csstitulo"><?php echo $nreporte ?>
      </div></td>
  </tr>
  <tr>
  <?php
  if (!(@$banderaimp))
{
  ?>
    <td width="18%" valign="top" bgcolor="#EFF5F5"> 
	<form action="" method="post" name="fa"  id="fa">
		   <table  border="0" cellpadding="0" cellspacing="2">
	 <?php
	/* $ilist=0;
		for($i=0;$i<count($listacamposl);$i++)
		{
		  $ilist++;
		  $listac=explode(".",$listacamposl[$i]);	
		  if(count($listac)==2)
		  {	
	
		  $objformulario->form_format_field($listac[0],$listac[1],$DB_gogess);
		  
		 $selecSql="select ".$listac[1]." from ".$listac[0]." limit 1";			 		 		 
			 $rs_script = $DB_gogess->Execute($selecSql);
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
			//echo $nombre_campo.":".$objformulario->fie_typereport."<br>";
			$objformulario->fie_styleobj="css_obj";
			$objformulario->fie_style="css_objtxt";
			$color_fila='';
			if($ilist%2)
			{
			$color_fila='bgcolor="#DCE0E7"';
			}
			else
			{
			$color_fila='bgcolor="#DAF3D1"';
			}
			
              if(@$objformulario->fie_typereport)
			{
			  
			    if ($typeSqlv=="T" or $typeSqlv=="D" )
							{
							   include($pathcampos."/fecha.php");
							}
							else
							{
							   include($pathcampos."/".$objformulario->fie_typereport.".php");
							  $pathcampos."/".$objformulario->fie_typereport.".php";
							}
			
			}
			else
			{
				
		      if ($objformulario->fie_type)
					{
					    if ($typeSqlv=="T" or $typeSqlv=="D" )
						{
						   include($pathcampos."/fecha.php");
						}
						else
						{
						   include($pathcampos."/".$objformulario->fie_type.".php");
						}
					}
			}
					
		  	  
		  }
		 } 
	*/
	?>
	</table>
	       <input name="Bot&oacute;n" type="button" id="Enviar" value="Ejecutar consulta" onclick="enviar_formulario()">
		   <input name="Bot&oacute;n" type="button" onClick="limpiar_form()" value="Limpiar consulta">
	<input type="button" name="Submit" value="A excel"  onclick="enviar_excel()" />
	</form>
	<script type="text/javascript">
<!--
function limpiar_form()
{

<?php  //echo $camposlimpia; 
?>
document.location.href ="verreporte.php?ireport=<?php echo $_GET['ireport']; ?>";

}
-->
</script>
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
	   
			 // $objformulario->form_format_tabla($listatablasx[$i],$DB_gogess);
			 // $separa_data=explode(",",$objformulario->tab_campoprimario);
			 // $separa_tipo=explode(",",$objformulario->tab_tipocampoprimariio);		   

		   //}
		    $sqldata="select ".$concatenacampos." from ".$consultaunion;
	 }
	 else
	 {
	     $sqldata="select ".$concatenacampos." from ".$listatablasx[0];
	 
	 }  
	 
	//echo $sqldata;

	//genera consulta

/*
 $jv=0;
		for($i=0;$i<count($listacamposl);$i++)
		{
		    
			  $listac=explode(".",$listacamposl[$i]);			
			  $objformulario->form_format_field($listac[0],$listac[1],$DB_gogess);
			 @$tipo_camponormal=$objformulario->fie_type;
			  @$tipo_camporeporte=$objformulario->fie_typereport;
			  //echo "Holass".$objformulario->fie_typereport."<br>";	
			  //echo "Holass".$objformulario->fie_type."<br>";
			 // echo $listac[1]."<br>";
			  $selecSql="select ".$listac[1]." from ".$listac[0]." limit 1";	
								 
				 $rs_script = $DB_gogess->Execute($selecSql);
				 $fld=$rs_script->FetchField(0);
				 
				 $typeSql=$rs_script->MetaType($fld->type);
	
				
				   $nombre_campo=$listac[1];
				   $ntabla=$listac[0];
			//  echo $objformulario->fie_type."<br>";
		 
		// echo $nombre_campo."-->".$typeSql."<br>";
			  if(@$_POST[$nombre_campo]!="" or @$_POST[$nombre_campo."2"]!="")
			  {
		  
				//echo $objformulario->fie_type."<br>";
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
							 
					if(trim($objformulario->fie_typereport))
					{
						//-----------------------------------------------------------------------
						
						 if (trim($objformulario->fie_typereport)=='select' or trim($objformulario->fie_typereport)=='selectafecta' or trim($objformulario->fie_typereport)=='selectrecibe')
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
							   if ($objformulario->fie_type=='select' or $objformulario->fie_type=='selectafecta' or $objformulario->fie_type=='selectrecibe')
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
							   if ($objformulario->fie_type=='select' or $objformulario->fie_type=='selectafecta' or $objformulario->fie_type=='selectrecibe')
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
 
 
 
// echo $sqlconcatena;
  $ntabla="";
 // print_r($sql);
  $sqlconcatena=substr($sqlconcatena,0,-4);
  
 */
  
  if($sqlconcatena)
  {
   $sqldata= $sqldata." where ".$sqlconcatena;
  }
	//echo $sqldata;
	//echo $sqldata=$sqldata." limit 2";
	
	$objgridtablareporte->gridtabla($concatenacampos,$sqldata,$sqldata,$DB_gogess);
	echo "<span class=csslista>N.Registros: ".$objgridtablareporte->totalreg."</span>" ;
	
	?>
	
	
	<table width="100%" cellpadding="3" cellspacing="3" >
      <tr bgcolor="#CCCCCC">
        <?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): ?>
        <td  nowrap="nowrap" bgcolor="#D9EBF2" class="linklista"><?php echo utf8_decode($camponom) ?></td>
        <?php 
	$nd++;
	endforeach; ?>
      </tr>
      <?php 
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?>
      <tr bgcolor="#ffffff"  onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'" >
        <?php 
	 $reclista=1;
	 $kj=0;
	 foreach($objgridtablareporte->arrcampos as $camposdata): 
	    
		
		$campotabla=explode(".",$listacamposl[$kj]);
		
		if(trim($campotabla[0]))
		{
		
		
	    $objformulario->form_format_field($campotabla[0],$camposdata,$DB_gogess);		
		if(@$_POST["ex1"])
		{
			if(!(trim($objformulario->field_type)=='int'))
			{
			  $comillaexcel="'";
			}
			else
			{
			$comillaexcel="";
			}
		}	
		
		if ($objformulario->fie_value=="replace")
			     {			
				    $valorbus=$datoslista[$camposdata];	
								   
				    $rmp= $objformulario->replace_cmb($objformulario->fie_tabledb,$objformulario->fie_datadb,$objformulario->fie_sql,$valorbus,$DB_gogess);
				   		   
				  }			 
			   else
			      {
			        $rmp= @$datoslista[$camposdata];			 
			      }		
		
		}
		else
		{
			
			
			$rmp= @$datoslista[trim($campotabla[1])];
		}
		
		echo '<td  nowrap class=csslista>'.utf8_decode(@$comillaexcel.$rmp).'</td>'; 	  
	  $kj++;
	  $reclista++;
	  ?>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; 
	}
	?>
    </table>
	
	
	</td>
  </tr>
</table>



<?php
}
?>
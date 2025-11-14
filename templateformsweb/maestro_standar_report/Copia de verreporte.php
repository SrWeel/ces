<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
if ($_POST["ex1"]=='true' or $_POST["ex1"]==1)
{
 $fechahoy=date("Y-m-d");
 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
 $banderaimp=1;
}
include("../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(isset($_SESSION['sessidadm_frank']))
{
?>
<?php
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
<div id=div_<?php echo $table ?>></div>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="2">
	  <div align="center" class="csstitulo"><?php echo $nreporte ?>
      </div></td>
  </tr>
  <tr>
  <?php
  if (!($banderaimp))
{
  ?>
    <td width="18%" valign="top" bgcolor="#EFF5F5"> 
	<form action="" method="post" name="fa"  id="fa">
		   <table  border="0" cellpadding="0" cellspacing="2">
	 <?php
	 
		for($i=0;$i<count($listacamposl);$i++)
		{
		  
		  $listac=explode(".",$listacamposl[$i]);		
	
		  $objformulario->form_format_field($listac[0],$listac[1],$DB_gogess);
		  
		     $selecSql="select ".$listac[1]." from ".$listac[0];			 		 		 
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
			
              if($objformulario->fie_typereport)
			{
			    if ($typeSql=="date")
							{
							   include($pathcampos."/fecha.php");
							}
							else
							{
							   include($pathcampos."/".$objformulario->fie_typereport.".php");
							}
			
			}
			else
			{
				
		      if ($objformulario->fie_type)
					{
					    if ($typeSql=="date")
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
	
	?>
	</table>
	       <input name="Bot&oacute;n" type="button" id="Enviar" value="Ejecutar consulta" onclick="enviar_formulario()">
	<input type="button" name="Submit" value="A excel"  onclick="enviar_excel()" />
	</form>
	
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

/*	   
	   $separa_data=explode(",",$objtableform->tab_campoprimario);
$separa_tipo=explode(",",$objtableform->tab_tipocampoprimariio);

//echo "holass".$_POST["opcion"];

if($_POST["opcion"]=='actualizar')
{
	for ($i_campo=0;$i_campo<count($separa_data);$i_campo++)
	{
	
	   if($separa_tipo[$i_campo]=='int')
	   {
		  $cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."=".$_POST[$separa_data[$i_campo]]." and ";
	   }
	
	   if($separa_tipo[$i_campo]=='string')
	   {
		  $cocatenafiltro=$cocatenafiltro.$separa_data[$i_campo]."='".$_POST[$separa_data[$i_campo]]."' and ";
	   } 
		
	}
	$cocatenafiltro=substr($cocatenafiltro,0,-4);


}
	   */
	//genera consulta

 $jv=0;
		for($i=0;$i<count($listacamposl);$i++)
		{
		    
		  $listac=explode(".",$listacamposl[$i]);			
		  $objformulario->form_format_field($listac[0],$listac[1],$DB_gogess);
		 // echo $listac[1]."<br>";
		  
		     $selecSql="select ".$listac[1]." from ".$listac[0];	
			 		 		 
			 $rs_script = $DB_gogess->Execute($selecSql);
			 $fld=$rs_script->FetchField(0);
			 
			 $typeSql=$rs_script->MetaType($fld->type);

		    
			   $nombre_campo=$listac[1];
			   $ntabla=$listac[0];
		//   echo $objformulario->fie_type."<br>";
	 
	// echo $nombre_campo."-->".$typeSql."<br>";
	  if($_POST[$nombre_campo]!="")
	  {
	  
	  
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
		
	    $objformulario->form_format_field($campotabla[0],$camposdata,$DB_gogess);		
		if($_POST["ex1"])
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
			        $rmp= $datoslista[$camposdata];			 
			      }		
		
		
		
		echo '<td  nowrap class=csslista>'.utf8_decode($comillaexcel.$rmp).'</td>'; 	  
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
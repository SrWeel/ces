<?php
error_reporting(0);
// Notificar solamente errores de ejecución
error_reporting(E_ERROR);
$fechahoy=date("Y-m-d");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename="."rep_".$fechahoy.".xls");
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
require_once "../include/base_datos/base_datos.php";
$ini_config_bd = parse_ini_file("../include/base_datos/mysqlDriver.ini", true);
$banderaimp=1;
if($_SESSION['usr_codigo'])
{
@$usrperfil = intval($_POST["pUsrPerfil"]);

$bd = new base_datos($ini_config_bd["CONFIGURACION_BASE_DE_DATOS"]["DBMS"]);
$conn = $bd->conect();
$rs = NULL;
$esquema = "";


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
					 
	//print_r($listatablasx);
	
	$cantidadtablas=count($listatablasx);
	if($cantidadtablas>1)
	{
		for($i=0;$i<count($listatablasx);$i++)
		{
			 
			    $campoprimario[$i]["primario"]= $objgridtablareporte->replace_cmb("cata_tablas","tbl_nombre,tbl_campoprimario"," where tbl_nombre like",$listatablasx[$i],$conn);
				
				$campoprimario[$i]["tipo"]= $objgridtablareporte->replace_cmb("cata_tablas","tbl_nombre,tbl_tipocampop"," where tbl_nombre like",$listatablasx[$i],$conn);
				
				
				
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
	font-size: 16px;
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

.linklista_cab{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
	text-decoration: none;
	color: #FFFFFF;
	border: 1px solid #000000;
}

.csslista{
font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;

	text-decoration: none;

}
.csslista_data{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-decoration: none;
	border: 1px solid #000000;
}

body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
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
   window.document.fa.action="verreporte_excel.php?ireport=<?php echo $_GET["ireport"]; ?>";
   window.document.fa.target = '_new';
   window.document.fa.submit();
} 
-->
</script>
<table width="100%" border="0" align="center" cellspacing="0">
  <tr>
    <td colspan="2"><img src="http://10.1.13.103/siscadep/frmReporte/logo.png" width="162" height="97">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	  <div align="center" class="csstitulo"><?php echo $nreporte ?>
</div>
<table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>Fecha del Reporte:</td>
            <td><?php echo date("Y-m-d h:i:s"); ?>&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
      </table>

</td>
  </tr>
  <tr>
  <?php
  //print_r($listacamposl);
  
  if (!($banderaimp))
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
								 
				 $rs_script = $conn->Execute($selecSql);
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
											$sql[$jv]=$ntabla.".".$nombre_campo." like '".$_POST[$nombre_campo]."' and ";	
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
	
	
	<table width="100%" cellpadding="3" cellspacing="3" >
      <tr bgcolor="#CCCCCC">
        <?php
   $nd=0; 
   foreach($objgridtablareporte->arrcamposn as $camponom): 
   if(utf8_decode($camponom)!='Código')
   {
   ?>
        <td   bgcolor="#00008B" class="linklista_cab"><?php echo utf8_decode($camponom) ?></td>
        <?php 
		}
		
	$nd++;
	endforeach; 
	
	if($_GET["ireport"]!=3)
	{
	?>
	<td nowrap="nowrap" bgcolor="#00008B" class="linklista_cab">Competencia en raz&oacute;n de la materia</td>
	<td nowrap="nowrap" bgcolor="#00008B" class="linklista_cab">Competencia en raz&oacute;n del territorio</td>
	<?php
	}
	?>
      </tr>
      <?php 
   if(count($objgridtablareporte->filas)>0)
   {
   foreach($objgridtablareporte->filas as $datoslista): ?>
      <tr bgcolor="#ffffff"  onmouseout="this.style.backgroundColor='#ffffff'" onmouseover="this.style.cursor='hand';this.style.backgroundColor='#d4d0c8'" >
        <?php 
		$comillaexcel='';
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
		
		$id_siscodigo=$datoslista["codigo_sis"];
		
		if($camposdata!='codigo_sis')
        {
		if($camposdata=='log_sql')
		{
		echo '<td  nowrap class=csslista_data>'.@$comillaexcel.base64_decode($rmp).'</td>'; 	
		}
		else
		{
		echo '<td  nowrap class=csslista_data>'.utf8_decode(@$comillaexcel.$rmp).'</td>'; 	
		}
		}  
	  $kj++;
	  $reclista++;
	  ?>
        <?php endforeach; 
		echo '<td  nowrap class=csslista_data>';
		
		$lista_materia="select distinct materia.nombre from cata_dependencia_materia inner join materia on cata_dependencia_materia.codigom=materia.codigo  where codigo_sis='".$id_siscodigo."'";
		$rs_listamateria = $conn->Execute($lista_materia);

     if($rs_listamateria)
					{  
					  while (!$rs_listamateria->EOF) {			
					  
					  echo  utf8_decode($rs_listamateria->fields["nombre"])."<br>";
					  
					  $rs_listamateria->MoveNext();
					  }
					 } 
		
		echo'</td>'; 	
		echo '<td  nowrap class=csslista_data>';
		
		
		$lista_territorio="SELECT 	cata_dependencia_territorio.ctrtrr_id,cata_dependencia_territorio.codigo_sis,cata_dependencia_territorio.codigop,provincia.nombre as pnombre,canton.nombre as cnombre,cata_parroquia.parr_nombre
		FROM cata_dependencia_territorio inner join provincia on cata_dependencia_territorio.codigop=provincia.codigo
		left join canton on cata_dependencia_territorio.codigoc=canton.codigo
		left join cata_parroquia on cata_dependencia_territorio.codigoprr=cata_parroquia.parr_codigo
		WHERE cata_dependencia_territorio.codigo_sis ='".$id_siscodigo."'";
		$rs_listaterritorio = $conn->Execute($lista_territorio);

     if($rs_listaterritorio)
					{  
					  while (!$rs_listaterritorio->EOF) {			
					  
					  echo  utf8_decode($rs_listaterritorio->fields["pnombre"]." ".$rs_listaterritorio->fields["cnombre"]." ".$rs_listaterritorio->fields["parr_nombre"]."<br>");
					  
					  $rs_listaterritorio->MoveNext();
					  }
					 } 
		
		echo '</td>'; 	?>
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
}
?>
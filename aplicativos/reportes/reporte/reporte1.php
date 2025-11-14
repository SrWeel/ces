<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../';
include("../../../cfg/clases.php");
include("../../../cfg/declaracion.php");

$union_data='';
$objformulario= new  ValidacionesFormulario();



$busca_tblparaplanillar="select distinct gogess_sistable.tab_name,fie_tablasubgrid,fie_campoenlacesub,tab_codigoesp,tab_campoprimario from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and gogess_sistable.tab_name not in ('dns_psicologia','dns_prehospitalario')";

$rs_tblpla = $DB_gogess->executec($busca_tblparaplanillar,array());
if($rs_tblpla)
	{
		while (!$rs_tblpla->EOF) {
		
		  $tabla_subgrid=$rs_tblpla->fields["fie_tablasubgrid"];
		  $campo_enlaceval=$rs_tblpla->fields["fie_campoenlacesub"];
		  $tabla_principal=$rs_tblpla->fields["tab_name"];
		  $tabla_especialidad=$rs_tblpla->fields["tab_codigoesp"];
		  $tab_campoprimario=$rs_tblpla->fields["tab_campoprimario"];
	
	$centro_val="";
	if($_POST["centro_id"])
	{
	$centro_val=" ".$tabla_principal.".centro_id='".$_POST["centro_id"]."' and	";  
	}
		 		  
$obtiene_sub=explode("_",$tab_campoprimario);
$campofr='';
$campofr=$obtiene_sub[0]."_fecharegistro";

$campoenl='';
$campoenl=$obtiene_sub[0]."_enlace";
		  		  
		  
$union_data.="select 
'".$tab_campoprimario."' as id_tbl,
".$tabla_principal.".clie_id,
".$tabla_principal.".usua_id,
".$campofr." as fecharegistro,
'".$tabla_principal."' as tabla,
'' as prenatal_p,
'' as prenatal_s,
'' as parto,
'' as postparto,
'' planificacion_p,
'' as planificacion_s,
'' as uterino,
'' as mamario,
".$campoenl." as enlace,
clie_fechanacimiento,
clie_apellido,
clie_nombre,
clie_rucci,
clie_genero 
from 
cesdb_aroriginal.".$tabla_principal." inner join cesdb_aroriginal.app_cliente on cesdb_aroriginal.app_cliente.clie_id=cesdb_aroriginal.".$tabla_principal.".clie_id 
UNION ";


		  
		
		$rs_tblpla->MoveNext();
		}
	}	


//echo $union_data;

$union_data=$sqlconcatena=substr($union_data,0,-6);

$array_patologia=array();
$array_nombrepatologia=array();
$lista_cie=array();

$listaespe_array=array();
$lista_espe=array();

$listamedico_array=array();
$lista_medico=array();

?><style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style>
<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4">&nbsp;</td>
    <td colspan="20"><div align="center" class="css_listat"></div></td>
  </tr>
  <tr>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="2" rowspan="2" class="css_listat"><strong>SEXO</strong></td>
    <td colspan="11" rowspan="2" class="css_listat"><strong>GRUPOS DE EDAD   -   MORBILIDAD</strong></td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="5" class="css_listat"><strong>DIAGN&Oacute;STICO</strong></td>
    <td colspan="2" rowspan="2" class="css_listat"><strong>TIPO  DE ATENCION</strong></td>
  </tr>
  <tr>
    <td colspan="3" class="css_listat"><strong>CLASE</strong></td>
    <td colspan="2" class="css_listat">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#E3F1F4" class="css_listat"><strong>No</strong></td>
    <td nowrap="NOWRAP" bgcolor="#E3F1F4" class="css_listat"><strong>HISTORIA CLINICA </strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>HOMBRE</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>MUJER</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>20 A&Ntilde;OS Y MAS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>MENOR  DE 1 MES</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>1 - 11 MESES</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>1 - 4 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>5 - 9 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>10 - 14 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>15 - 19 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>20 - 35 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>36 - 49 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>50 - 64 A&Ntilde;OS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>65 A&Ntilde;OS Y MAS</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>DIAGN&Oacute;STICO O SINDROME SEG&Uacute;N C.I.E.</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>CODIFICACION  DIAGN&Oacute;STICO</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>PRESUNTIVO</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>DEFINITIVO</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>DEFINITIVO CONTROL</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>A.I.E.P.I.</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>ALERTA-ACION</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>PRIMERA</strong></td>
    <td nowrap="nowrap" bgcolor="#E3F1F4" class="css_listat"><strong>SUBSECUENTE</strong></td>
  </tr>
 <?php
$nhombres=0;
$nmujeres=0;
$conteomayorigual20=0;
$conteomenoraunmes=0;
$conteode1a11meses=0;
$conteodeunoa4anios=0;
$conteode10a14anios=0;
$conteode5a9anios=0;
$conteode15a19anios=0;
$conteode20a35anios=0;
$conteode36a49anios=0;
$conteode50a64anios=0;
$conteode65a1000anios=0;
$conteopresuntivo=0;
$conteodefinitivo=0;
$definitivocontrol=0;
$conteoaten_subsecuente=0;

$cuenta_lista=0;
 
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,0 as situ_id,clie_fechanacimiento,clie_apellido,clie_nombre,clie_rucci,clie_genero from (".$union_data.") tbl where clie_id not in (2) and usua_id not in(1)";	
$numera=0;
 $rs_gogessform = $DB_gogess->executec($cuenta_sql,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
		
		$numera++;
		  // $busca_data_cliente="select * from app_cliente where clie_id='".$rs_gogessform->fields["clie_id"]."'";	
		  // $rs_cliente = $DB_gogess->executec($busca_data_cliente,array());
		   $sactivo='';
		   $spasivo='';
		   $montepio='';
		   $dependiente='';
		   $noaplica='';
		   if($rs_gogessform->fields["situ_id"]==1)
		   {
		      $sactivo='x';
		   
		   }
		    if($rs_gogessform->fields["situ_id"]==2)
		   {
		      $spasivo='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==3)
		   {
		      $montepio='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==4)
		   {
		      $dependiente='x';
		   
		   }
		   
		   if($rs_gogessform->fields["situ_id"]==5)
		   {
		      $noaplica='x';		   
		   }
		   

		   
		   $hombre='';
		   if($rs_gogessform->fields["clie_genero"]=='M')
		   {
		     $hombre='x';
			 $nhombres++;
		   }
		   $mujer='';
		   if($rs_gogessform->fields["clie_genero"]=='F')
		   {
		      $mujer='x';
			  $nmujeres++;
		   }
		   
		   
		   $prenatal_p='';
		   if($rs_gogessform->fields["prenatal_p"]=='1')
		   {
		      $prenatal_p='x';
		   }
		   
		   $prenatal_s='';
		   if($rs_gogessform->fields["prenatal_s"]=='1')
		   {
		      $prenatal_s='x';
		   }
		   
		   
		   $parto='';
		   if($rs_gogessform->fields["parto"]=='1')
		   {
		      $parto='x';
		   }
		   
		   $postparto='';
		   if($rs_gogessform->fields["postparto"]=='1')
		   {
		      $postparto='x';
		   }
		   //------------------------------------
		   
		   $planificacion_p='';
		   if($rs_gogessform->fields["planificacion_p"]=='1')
		   {
		      $planificacion_p='x';
		   }
		   
		   $planificacion_s='';
		   if($rs_gogessform->fields["planificacion_s"]=='1')
		   {
		      $planificacion_s='x';
		   }
		   //--------------------------------------
		   $uterino='';
		   if($rs_gogessform->fields["uterino"]=='1')
		   {
		      $uterino='x';
		   }
		   
		   $mamario='';
		   if($rs_gogessform->fields["mamario"]=='1')
		   {
		      $mamario='x';
		   }
		   //----------------------EDAD
		   $edad_alafechar=array();
		   $fechan=$rs_gogessform->fields["clie_fechanacimiento"];
		   $fechafin=$rs_gogessform->fields["fecharegistro"];
		   $edad_alafechar=calcular_edad($fechan,$fechafin);
		   
		   //primera vez
		    $menur1anio_p='';
			$de1a4_p='';
			$aten_primera='';
		   if($rs_gogessform->fields["tabla"]=='dns_anamesisexamenfisico' or $rs_gogessform->fields["tabla"]=='dns_imagenologiainfo' or $rs_gogessform->fields["tabla"]=='dns_odontologia' or $rs_gogessform->fields["tabla"]=='dns_procediminetosinvasivos' or $rs_gogessform->fields["tabla"]=='dns_psicologia' or $rs_gogessform->fields["tabla"]=='dns_referencia' or $rs_gogessform->fields["tabla"]=='dns_interconsulta' or $rs_gogessform->fields["tabla"]=='dns_prehospitalario' or $rs_gogessform->fields["tabla"]=='dns_histopatologia' or $rs_gogessform->fields["tabla"]=='dns_laboratorio' or $rs_gogessform->fields["tabla"]=='dns_imagenologia' or $rs_gogessform->fields["tabla"]=='dns_enfermeria' or $rs_gogessform->fields["tabla"]=='dns_laboratorioinforme' or $rs_gogessform->fields["tabla"]=='dns_fisioterapia' or $rs_gogessform->fields["tabla"]=='dns_visitadomiciliaria' or $rs_gogessform->fields["tabla"]=='dns_ginecologiaanamesis'  or $rs_gogessform->fields["tabla"]=='dns_traumatologiaanamesis'  or $rs_gogessform->fields["tabla"]=='dns_cardiologiaanamesis' or $rs_gogessform->fields["tabla"]=='dns_datosiess' or $rs_gogessform->fields["tabla"]=='dns_rehabilitacionanamesis'  or $rs_gogessform->fields["tabla"]=='dns_pediatriaanamesis' or $rs_gogessform->fields["tabla"]=='dns_acupunturaanamesis' or $rs_gogessform->fields["tabla"]=='dns_hospitalanamesis' or $rs_gogessform->fields["tabla"]=='dns_epicrisisanamesis' or $rs_gogessform->fields["tabla"]=='dns_gastroenterologiaanamesis' or $rs_gogessform->fields["tabla"]=='dns_otorrinoanamesis'  or $rs_gogessform->fields["tabla"]=='dns_emergenciaanamesis' or $rs_gogessform->fields["tabla"]=='dns_newreferencia' )
		   {
		   
		      if($edad_alafechar["anio"]<1)
			  {
			     $menur1anio_p='x';
			  }
			  
			  
			  if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $de1a4_p='x';
			  }
			  
		      $aten_primera='x';
			  
			  $conteoaten_primera++;
			  
		   }
		   
		   



		   $menur1anio_s='';
		   $de1a4_s='';
		   $aten_subsecuente='';
		   if($rs_gogessform->fields["tabla"]=='dns_consultaexterna' or $rs_gogessform->fields["tabla"]=='dns_subsecuenteodontologia' or $rs_gogessform->fields["tabla"]=='dns_subsecuentepsicologia' or $rs_gogessform->fields["tabla"]=='dns_ginecologiaconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_traumatologiaconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_cardiologiaconsultaexterna' or  $rs_gogessform->fields["tabla"]=='dns_rehabilitacionconsultaexterna'  or  $rs_gogessform->fields["tabla"]=='dns_pediatriaconsultaexterna'  or  $rs_gogessform->fields["tabla"]=='dns_acupunturaconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_hospitalconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_epicrisisconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_gastroenterologiaconsultaexterna' or $rs_gogessform->fields["tabla"]=='dns_otorrinoconsultaexterna'  or $rs_gogessform->fields["tabla"]=='dns_emergenciaconsultaexterna'  )
		   {
		   
		       if($edad_alafechar["anio"]<1)
			   {
			     $menur1anio_s='x';
			   }
			   
			   if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $de1a4_s='x';
			  }
		      
			  $aten_subsecuente='x';
			  $conteoaten_subsecuente++;
		   }
		   
		   
		   
		
		   
		   	   
		   //subsecuente	    

           //general
		   $de5a9anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=9)
			  {
			     $de5a9anios='x';
				 $conteode5a9anios++;
			  }
		   
		   $ado10a14anios='';
		   if($edad_alafechar["anio"]>=10 and $edad_alafechar["anio"]<=14)
			  {
			     $ado10a14anios='x';
			  }


           $ado15a19anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=19)
			  {
			     $ado15a19anios='x';
			  }

          $mayorigual20='';
		  if($edad_alafechar["anio"]>=20)
			  {
			     $mayorigual20='x';
				 $conteomayorigual20++;
			  }

          $menoraunmes='';
		  if($edad_alafechar["anio"]==0 and $edad_alafechar["mes"]<1)
			  {
			     $menoraunmes='x';
				 
				 $conteomenoraunmes++;
			  }
  
          $de1a11meses='';
		  if($edad_alafechar["anio"]==0 and ($edad_alafechar["mes"]>=1 and $edad_alafechar["mes"]<=11))
			  {
			     $de1a11meses='x';
				  $conteode1a11meses++;
			  }
			
		   $deunoa4anios='';
		   if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $deunoa4anios='x';
				 $conteodeunoa4anios++;
			  }  

           $de5a9anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=9)
			  {
			     $de5a9anios='x';
			  }  

           $de10a14anios='';
		   if($edad_alafechar["anio"]>=10 and $edad_alafechar["anio"]<=14)
			  {
			     $de10a14anios='x';
				 $conteode10a14anios++;
			  }  
			  
		  $de15a19anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=19)
			  {
			     $de15a19anios='x';
				 $conteode15a19anios++;
			  } 
			  
		  $de20a35anios='';
		   if($edad_alafechar["anio"]>=20 and $edad_alafechar["anio"]<=35)
			  {
			     $de20a35anios='x';
				 $conteode20a35anios++;
			  }	
			  
		  $de36a49anios='';
		   if($edad_alafechar["anio"]>=36 and $edad_alafechar["anio"]<=49)
			  {
			     $de36a49anios='x';
				 $conteode36a49anios++;
			  }	 
			  
		 $de50a64anios='';
		   if($edad_alafechar["anio"]>=50 and $edad_alafechar["anio"]<=64)
			  {
			     $de50a64anios='x';
				 $conteode50a64anios++;
			  }  
			  
		 $de65a1000anios='';
		   if($edad_alafechar["anio"]>=65)
			  {
			     $de65a1000anios='x';
				 $conteode65a1000anios++;
			  }  	     	  
		  
		  //diagnosticos
		  
		  $busca_tbldiagnositco="select * from gogess_sistable inner join gogess_sisfield on gogess_sistable.tab_name=gogess_sisfield.tab_name where ttbl_id in(1) and gogess_sistable.tab_name='".$rs_gogessform->fields["tabla"]."' and fie_type='campogrid'";
	
	       $rs_tbldiag = $DB_gogess->executec($busca_tbldiagnositco,array());
		   
		   $lista_diag="select * from ".$rs_tbldiag->fields["fie_tablasubgrid"]." where ".$rs_tbldiag->fields["fie_campoenlacesub"]."='".$rs_gogessform->fields["enlace"]."' limit 1";
	       $rs_diag = $DB_gogess->executec($lista_diag,array());
		   
		   $definitivo='';
		   if($rs_diag->fields["diagn_tipo"]=='DEFINITIVO')
		   {
		   $definitivo='x';
		   $conteodefinitivo++;
		   }
		   
		   $definitivocontrol='';
		   if($rs_diag->fields["diagn_tipo"]=='DEFINITIVO CONTROL')
		   {
		   $definitivocontrol='x';		   
		   $conteodefinitivocontrol++;
		   }
		   
		   $presuntivo='';
		   if($rs_diag->fields["diagn_tipo"]=='PRESUNTIVO')
		   {
		   $presuntivo='x';
		   $conteopresuntivo++;
		   }
		   
	//echo $numera."-->".$edad_alafechar["anio"]."-->".$edad_alafechar["mes"];	   
	
	
 ?> 
  <tr>
    <td class="css_listat"><?php echo $numera; ?></td>
    <td nowrap="NOWRAP" class="css_listat"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]." ".$rs_gogessform->fields["clie_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $hombre; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mujer; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mayorigual20; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $menoraunmes; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de1a11meses; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $deunoa4anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de5a9anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de10a14anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de15a19anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de20a35anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de36a49anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de50a64anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de65a1000anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo utf8_encode($rs_diag->fields["diagn_descripcion"]); ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo utf8_encode($rs_diag->fields["diagn_cie"]); ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $presuntivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $definitivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $definitivocontrol; ?></td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_primera; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_subsecuente; ?></td>
  </tr>
 <?php
 
        $array_patologia[$rs_diag->fields["diagn_cie"]]++;		
		$array_nombrepatologia[$rs_diag->fields["diagn_cie"]]=$rs_diag->fields["diagn_descripcion"];
        $lista_cie[$cuenta_lista]=$rs_diag->fields["diagn_cie"];
		
		
		$listaespe_array[$rs_gogessform->fields["tabla"]]++;
		$lista_espe[$cuenta_lista]=$rs_gogessform->fields["tabla"];
		
		
		
		
		$listamedico_array[$rs_gogessform->fields["usua_id"]]++;
		$lista_medico[$cuenta_lista]=$rs_gogessform->fields["usua_id"];
		
		
		$cuenta_lista++;
 
        $rs_gogessform->MoveNext();	
		}
 }
 ?> 

  <tr>
    <td bgcolor="#DFECF2" class="css_listat"><strong>TOTALES</strong></td>
    <td nowrap="NOWRAP" bgcolor="#DFECF2" class="css_listat"><strong>
      <?php  ?>
    </strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $nhombres; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $nmujeres; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteomayorigual20; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteomenoraunmes; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo  $conteode1a11meses++; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteodeunoa4anios++; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode5a9anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode10a14anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode15a19anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode20a35anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode36a49anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode50a64anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteode65a1000anios; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong>
      <?php  ?>
    </strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong>
      <?php  ?>
    </strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteopresuntivo; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteodefinitivo; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteodefinitivocontrol; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteoaten_primera; ?></strong></td>
    <td nowrap="nowrap" bgcolor="#DFECF2" class="css_listat"><strong><?php echo $conteoaten_subsecuente; ?></strong></td>
  </tr>
</table>
<br />
<?php
//$listamedico_array[$rs_gogessform->fields["usua_id"]]++;
//$lista_medico[$cuenta_lista]=$rs_gogessform->fields["usua_id"];

$lista_medico1=array();
$lista_medico1=array_unique($lista_medico);

$listadomed=array();
$listadomed=array_values($lista_medico1);

//print_r($listadomed);
?>
<table width="500" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#E2EFF3"><div align="center"><strong>M&Eacute;DICO</strong></div></td>
  </tr>
<?php
for ($i=1;$i<count($listadomed);$i++)
{
//if(trim($listado[$i]))
//{

 $cuenta_sql1="select * from  app_usuario where usua_id='".$listadomed[$i]."' and usua_id not in(1)";	
 $rs_gogessform1 = $DB_gogess->executec($cuenta_sql1,array());
?>  
  <tr>
    <td nowrap="nowrap"><?php echo utf8_encode($rs_gogessform1->fields["usua_nombre"].' '.$rs_gogessform1->fields["usua_apellido"]); ?></td>
	<td nowrap="nowrap"><?php echo $listamedico_array[$listadomed[$i]]; ?></td>
  </tr>
<?php
    $contadorglobalmed=$contadorglobalmed+$listamedico_array[$listadomed[$i]];
//}

}
?>  
  <tr>
    <td bgcolor="#E7F2F8"><strong>TOTALES</strong></td>
    <td bgcolor="#E7F2F8"><strong>
      <?php  echo  $contadorglobalmed; ?>
    </strong></td>
  </tr>
</table>


<br />
<?php

//$listaespe_array[$rs_gogessform->fields["tabla"]]++;
//$lista_espe[$cuenta_lista]==$rs_gogessform->fields["tabla"];

$lista_unico=array();
$lista_unico=array_unique($lista_espe);

$listadou=array();
$listadou=array_values($lista_unico);

?>

<table width="500" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#E2EFF3"><div align="center"><strong>ESPECIALIDAD</strong></div></td>
  </tr>
<?php
for ($i=1;$i<count($listadou);$i++)
{
//if(trim($listado[$i]))
//{
?>  
  <tr>
    <td nowrap="nowrap"><?php echo utf8_encode($listadou[$i]); ?></td>
	<td nowrap="nowrap"><?php echo $listaespe_array[$listadou[$i]]; ?></td>
  </tr>
<?php
    $contadorglobal1=$contadorglobal1+$listaespe_array[$listadou[$i]];
//}

}
?>  
  <tr>
    <td bgcolor="#E7F2F8"><strong>TOTALES</strong></td>
    <td bgcolor="#E7F2F8"><strong>
      <?php  echo  $contadorglobal1; ?>
    </strong></td>
  </tr>
</table>



<?php
$lista_ciesinr=array();
$lista_ciesinr=array_unique($lista_cie);

$listado=array();
$listado=array_values($lista_ciesinr);

$contadorglobal=0;
?>
<br />
<table width="500" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#E2EFF3"><div align="center"><strong>POR PATOLOGIA </strong></div></td>
  </tr>
<?php
for ($i=1;$i<count($listado);$i++)
{
//if(trim($listado[$i]))
//{
?>  
  <tr>
    <td nowrap="nowrap"><?php echo utf8_encode($listado[$i]); ?></td>
	<td nowrap="nowrap"><?php echo utf8_encode($array_nombrepatologia[$listado[$i]]); ?></td>
    <td><?php  echo $array_patologia[$listado[$i]]; ?></td>
  </tr>
<?php
    $contadorglobal=$contadorglobal+$array_patologia[$listado[$i]];
//}

}
?>  
  <tr>
    <td bgcolor="#E7F2F8"><strong>TOTALES</strong></td>
	<td bgcolor="#E7F2F8"></td>
    <td bgcolor="#E7F2F8"><strong>
      <?php  echo $contadorglobal; ?>
    </strong></td>
  </tr>
</table>

<?php
}
?>



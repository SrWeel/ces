<style type="text/css">
<!--
.css_listat {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
.css_lista {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.verticalText {
writing-mode: vertical-lr;
    transform: rotate(90deg);
	font-size:9px;
	margin-right: 30%;
	margin-left: 30%;
}
-->
</style>
<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");


$objformulario= new  ValidacionesFormulario();

//echo $_POST["fecha_inicio"];
//echo $_POST["fecha_fin"];
$lista_estu=array();


//print_r($lista_estu);

?>

<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="9">&nbsp;</td>
    <td colspan="15"><div align="center" class="css_listat">ATENCI&Oacute;N PREVENTIVA</div></td>
	<td colspan="22"><div align="center" class="css_listat"></div></td>
  </tr>
  <tr>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="5" rowspan="2" class="css_listat">BENEFICIARIO</td>
    <td colspan="2" rowspan="2" class="css_listat">SEXO</td>
    <td colspan="8" class="css_listat">MUJERES</td>
    <td colspan="5" class="css_listat">NI&Ntilde;OS</td>
    <td colspan="2" class="css_listat">ADOLECENTES</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="10" rowspan="2" class="css_listat">GRUPOS DE EDAD   -   MORBILIDAD</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td rowspan="2" class="css_listat">&nbsp;</td>
    <td colspan="5" class="css_listat">DIAGN&Oacute;STICO</td>
    <td colspan="2" rowspan="2" class="css_listat">TIPO  DE ATENCION</td>
    <td rowspan="2" class="css_listat">ORDENES</td>
    <td rowspan="2" class="css_listat">HORAS </td>
  </tr>
  <tr>
    <td colspan="2" class="css_listat">PRENATAL</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="2" class="css_listat">PLANIF. FAMILIAR</td>
    <td colspan="2" class="css_listat">D.O.C</td>
    <td colspan="2" class="css_listat">&lt; 1 A&Ntilde;O</td>
    <td colspan="2" class="css_listat">1-4 A&Ntilde;OS</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td class="css_listat">&nbsp;</td>
    <td colspan="3" class="css_listat">CLASE</td>
    <td colspan="2" class="css_listat">&nbsp;</td>
  </tr>
  <tr>
    <td class="css_listat">No</td>
    <td nowrap="NOWRAP" class="css_listat">HISTORIA CLINICA </td>
    <td nowrap="nowrap" class="css_listat" >S. ACTIVO</td>
    <td nowrap="nowrap" class="css_listat">S. PASIVO</td>
    <td nowrap="nowrap" class="css_listat">MONTEPIO</td>
    <td nowrap="nowrap" class="css_listat">DEPENDIENTE </td>
    <td nowrap="nowrap" class="css_listat">NO APLICA</td>
    <td nowrap="nowrap" class="css_listat">HOMBRE</td>
    <td nowrap="nowrap" class="css_listat">MUJER</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">PARTO</td>
    <td nowrap="nowrap" class="css_listat">POSTPARTO</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA </td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">CERVICO UTERINO</td>
    <td nowrap="nowrap" class="css_listat">MAMARIO</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">5-9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">10 - 14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">15-19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">20 A&Ntilde;OS Y MAS</td>
    <td nowrap="nowrap" class="css_listat">MENOR  DE 1 MES</td>
    <td nowrap="nowrap" class="css_listat">1 - 11 MESES</td>
    <td nowrap="nowrap" class="css_listat">1 - 4 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">5 - 9 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">10 - 14 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">15 - 19 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">20 - 35 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">36 - 49 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">50 - 64 A&Ntilde;OS</td>
    <td nowrap="nowrap" class="css_listat">65 A&Ntilde;OS Y MAS</td>
    <td nowrap="nowrap" class="css_listat">DIAGN&Oacute;STICO O SINDROME SEG&Uacute;N C.I.E.</td>
    <td nowrap="nowrap" class="css_listat">CODIFICACION  DIAGN&Oacute;STICO</td>
    <td nowrap="nowrap" class="css_listat">PRESUNTIVO</td>
    <td nowrap="nowrap" class="css_listat">DEFINITIVO</td>
    <td nowrap="nowrap" class="css_listat">DEFINITIVO CONTROL</td>
    <td nowrap="nowrap" class="css_listat">A.I.E.P.I.</td>
    <td nowrap="nowrap" class="css_listat">ALERTA-ACION</td>
    <td nowrap="nowrap" class="css_listat">PRIMERA</td>
    <td nowrap="nowrap" class="css_listat">SUBSECUENTE</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
  </tr>
 <?php
$cuenta_sql="select id_tbl,tabla,clie_id,usua_id,prenatal_p,prenatal_s,parto,postparto,planificacion_p,planificacion_s,uterino,mamario,fecharegistro,enlace,situ_id,clie_fechanacimiento,clie_apellido,clie_nombre,clie_rucci,clie_genero from pruebas_reportes.registro_diario where (fecharegistro>='".$_POST["fecha_inicio"]." 00:00:00' and fecharegistro<='".$_POST["fecha_inicio"]." 23:59:59') and usua_id='".$_POST["usua_id"]."'";	
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
		   }
		   $mujer='';
		   if($rs_gogessform->fields["clie_genero"]=='F')
		   {
		      $mujer='x';
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
		   if($rs_gogessform->fields["tabla"]=='dns_anamesisexamenfisico' or $rs_gogessform->fields["tabla"]=='dns_imagenologiainfo' or $rs_gogessform->fields["tabla"]=='dns_odontologia' or $rs_gogessform->fields["tabla"]=='dns_procediminetosinvasivos' or $rs_gogessform->fields["tabla"]=='dns_psicologia' or $rs_gogessform->fields["tabla"]=='dns_referencia' or $rs_gogessform->fields["tabla"]=='dns_interconsulta' or $rs_gogessform->fields["tabla"]=='dns_prehospitalario' or $rs_gogessform->fields["tabla"]=='dns_histopatologia' or $rs_gogessform->fields["tabla"]=='dns_laboratorio' or $rs_gogessform->fields["tabla"]=='dns_imagenologia' or $rs_gogessform->fields["tabla"]=='dns_enfermeria' or $rs_gogessform->fields["tabla"]=='dns_laboratorioinforme' or $rs_gogessform->fields["tabla"]=='dns_fisioterapia' or $rs_gogessform->fields["tabla"]=='dns_visitadomiciliaria')
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
		   }
		   
		   



		   $menur1anio_s='';
		   $de1a4_s='';
		   $aten_subsecuente='';
		   if($rs_gogessform->fields["tabla"]=='dns_consultaexterna' or $rs_gogessform->fields["tabla"]=='dns_subsecuenteodontologia' or $rs_gogessform->fields["tabla"]=='dns_subsecuentepsicologia' or $rs_gogessform->fields["tabla"]=='dns_regfisioterapia')
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
		   }
		   	   
		   //subsecuente	    

           //general
		   $de5a9anios='';
		   if($edad_alafechar["anio"]>=5 and $edad_alafechar["anio"]<=9)
			  {
			     $de5a9anios='x';
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
			  }

          $menoraunmes='';
		  if($edad_alafechar["anio"]==0 and $edad_alafechar["mes"]<1)
			  {
			     $menoraunmes='x';
			  }
  
          $de1a11meses='';
		  if($edad_alafechar["anio"]==0 and ($edad_alafechar["mes"]>=1 and $edad_alafechar["mes"]<=11))
			  {
			     $de1a11meses='x';
			  }
			
		   $deunoa4anios='';
		   if($edad_alafechar["anio"]>=1 and $edad_alafechar["anio"]<=4)
			  {
			     $deunoa4anios='x';
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
			  }  
			  
		  $de15a19anios='';
		   if($edad_alafechar["anio"]>=15 and $edad_alafechar["anio"]<=19)
			  {
			     $de15a19anios='x';
			  } 
			  
		  $de20a35anios='';
		   if($edad_alafechar["anio"]>=20 and $edad_alafechar["anio"]<=35)
			  {
			     $de20a35anios='x';
			  }	
			  
		  $de36a49anios='';
		   if($edad_alafechar["anio"]>=36 and $edad_alafechar["anio"]<=49)
			  {
			     $de36a49anios='x';
			  }	 
			  
		 $de50a64anios='';
		   if($edad_alafechar["anio"]>=50 and $edad_alafechar["anio"]<=64)
			  {
			     $de50a64anios='x';
			  }  
			  
		 $de65a1000anios='';
		   if($edad_alafechar["anio"]>=65)
			  {
			     $de65a1000anios='x';
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
		   }
		   
		   $definitivocontrol='';
		   if($rs_diag->fields["diagn_tipo"]=='DEFINITIVO CONTROL')
		   {
		   $definitivocontrol='x';
		   }
		   
		   $presuntivo='';
		   if($rs_diag->fields["diagn_tipo"]=='PRESUNTIVO')
		   {
		   $presuntivo='x';
		   }
		   
	//echo $numera."-->".$edad_alafechar["anio"]."-->".$edad_alafechar["mes"];	   
 ?> 
  <tr>
    <td class="css_listat"><?php echo $numera; ?></td>
    <td nowrap="NOWRAP" class="css_listat"><?php echo utf8_encode($rs_gogessform->fields["clie_apellido"]." ".$rs_gogessform->fields["clie_nombre"]); ?></td>
    <td nowrap="nowrap" class="css_listat" ><?php echo $sactivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $spasivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $montepio; ?></td>
	<td nowrap="nowrap" class="css_listat"><?php echo $dependiente; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $noaplica; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $hombre; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mujer; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $prenatal_p; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $prenatal_s; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $parto; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $postparto; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $planificacion_p; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $planificacion_s; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $uterino; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $mamario; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $menur1anio_p; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $menur1anio_s; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de1a4_p; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de1a4_s; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $de5a9anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $ado10a14anios; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $ado15a19anios; ?></td>
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
    <td nowrap="nowrap" class="css_listat"><?php echo $rs_diag->fields["diagn_descripcion"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $rs_diag->fields["diagn_cie"]; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $presuntivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $definitivo; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $definitivocontrol; ?></td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_primera; ?></td>
    <td nowrap="nowrap" class="css_listat"><?php echo $aten_subsecuente; ?></td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
    <td nowrap="nowrap" class="css_listat">&nbsp;</td>
  </tr>
 <?php
        $rs_gogessform->MoveNext();	
		}
 }
 ?> 
</table>

<?php
}
?>
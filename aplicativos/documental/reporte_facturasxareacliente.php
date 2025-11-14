<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
//ini_set("session.cookie_lifetime",$tiempossss);
//ini_set("session.gc_maxlifetime",$tiempossss);
//session_start();
$nombre_archivo_t='';
include("lib_excel.php");

$desde_val=$_GET["desde_val"];
$hasta_val=$_GET["hasta_val"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

$su_quito='';
$su_quito=$_GET['centro_id'];
$fact_val="";
if($su_quito==1)
{
  $fact_val="001-002-";
}

if($su_quito==2)
{
  $fact_val="002-002-";
}

$arreglo_valorc=array();



//---------------------------------------------------------------------

 $cuenta=0;
	   $lista_terapias="select * from faesa_terapiasregistro inner join dns_especialidad on faesa_terapiasregistro.especi_id=dns_especialidad.especi_id inner join app_usuario on faesa_terapiasregistro.usua_id=app_usuario.usua_id inner join app_cliente on faesa_terapiasregistro.clie_id=app_cliente.clie_id where terap_fecha>='".$desde_val."' and terap_fecha<='".$hasta_val."' and faesa_terapiasregistro.centro_id=".$_GET['centro_id'];
	   $rs_lterapias = $DB_gogess->executec($lista_terapias,array());
				if($rs_lterapias)
                   {
	                  while (!$rs_lterapias->EOF) {	
				       $cuenta++;
					  $documento.='<tr>
					    <td>'.$cuenta.'</td>
						<td>'.$rs_lterapias->fields["especi_nombre"].'</td>
						<td>'.$rs_lterapias->fields["usua_nombre"].' '.$rs_lterapias->fields["usua_apellido"].'</td>
						<td>'.$rs_lterapias->fields["terap_fecha"].'</td>
						<td>'.$rs_lterapias->fields["terap_hora"].'</td>
					  </tr>';
					  
			$busca_categ="select tipopac_nombre from faesa_tipopaciente where tipopac_id='".$rs_lterapias->fields["tipopac_id"]."'";
	        $rs_categ = $DB_gogess->executec($busca_categ,array());
					  
					  $arreglo_valorc[$rs_lterapias->fields["especi_nombre"]][$rs_lterapias->fields["usua_nombre"].' '.$rs_lterapias->fields["usua_apellido"]][$rs_categ->fields["tipopac_nombre"]]=$arreglo_valorc[$rs_lterapias->fields["especi_nombre"]][$rs_lterapias->fields["usua_nombre"].' '.$rs_lterapias->fields["usua_apellido"]][$rs_categ->fields["tipopac_nombre"]]+1;
					  
					  $rs_lterapias->MoveNext();
					  }
					}  
					
					
/*
   $cuenta=0;
	   $lista_evaluacioninte="select * from faesa_asigahorario INNER JOIN faesa_grupos on faesa_asigahorario.grup_id=faesa_grupos.grup_id  where eteneva_id=".$rs_data->fields["eteneva_id"];
	   $rs_evainte = $DB_gogess->executec($lista_evaluacioninte,array());
				if($rs_evainte)
                   {
	                  while (!$rs_evainte->EOF) {	
				       $cuenta++;
					  $documento.='<tr>
					    <td>'.$cuenta.'</td>
						<td>EVALUACION INTEGRAL</td>
						<td>'.$rs_evainte->fields["grup_nombre"].'</td>
						<td>'.$rs_evainte->fields["asighor_fecha"].'</td>
						<td></td>
					  </tr>';
					  
					  $rs_evainte->MoveNext();
					  }
					}  */
//----------------------------------------------------------------------

//print_r($arreglo_valorc);

$documento='
<style type="text/css">
<!--
.arplano {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.espetxt {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.espetxt1 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
-->
</style>';

$listapor_producto="select docdet_codprincipal,sum(docdet_cantidad) as cantidad,sum(docdet_total) as total from beko_documentocabecera  cab inner join beko_documentodetalle detall on cab.doccab_id=detall.doccab_id where doccab_fechaemision_cliente>='".$desde_val."' and doccab_fechaemision_cliente<='".$hasta_val."' and doccab_ndocumento like '".$fact_val."%' group by docdet_codprincipal";

$resumen_uno='<p></p><table width="100" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td><span class="arplano"><B>Producto</B></span></td>
    <td><span class="arplano"><B>Cantidad</B></span></td>
    <td><span class="arplano"><B>Total</B></span></td>
  </tr>';  
$suma_cantidad=0;
$suma_total=0;
$rs_datalp = $DB_gogess->executec($listapor_producto,array());
 if($rs_datalp)
 {
    while (!$rs_datalp->EOF) {
	
	$busca_producto="select * from efacsistema_producto where prod_codigo='".$rs_datalp->fields["docdet_codprincipal"]."'";
	$rs_prd = $DB_gogess->executec($busca_producto,array());
	
    $resumen_uno.='<tr>
    <td nowrap="nowrap" ><span class="arplano" >'.$rs_datalp->fields["docdet_codprincipal"]."-".$rs_prd->fields["prod_nombre"].'</span></td>
	<td nowrap="nowrap" ><span class="arplano">'.$rs_datalp->fields["cantidad"].'</span></td>
	<td nowrap="nowrap" ><span class="arplano">'.$rs_datalp->fields["total"].'</span></td>
    </tr>';
	$suma_cantidad=$suma_cantidad+$rs_datalp->fields["cantidad"];
	$suma_total=$suma_total+$rs_datalp->fields["total"];
	
    $rs_datalp->MoveNext();	
	}
 } 

$resumen_uno.='<tr>
    <td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano" ><B>TOTALES</B></span></td>
	<td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano"><B>'.$suma_cantidad.'</B></span></td>
	<td nowrap="nowrap" bgcolor="#D0DCEA" ><span class="arplano"><B>'.$suma_total.'</B></span></td>
    </tr>';
	
$resumen_uno.='</table>'; 

$resumen_uno='';

$documento.=$resumen_uno.'</body>
</html>';


//print_r($arreglo_valorc);


$resumen_dos='';
$resumen_dos.='<center><table width="700" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#D0DCEA"  ><span class="espetxt"><b>Especialidad</b></span></td>
    <td bgcolor="#D0DCEA"  ><span class="espetxt"><b>Detalles</b></span></td>
  </tr>';
  foreach ($arreglo_valorc as $clave => $valor) {
	$resumen_dos.='<tr>
    <td><span class="espetxt1">'.$clave.'</span></td>
    <td><span class="espetxt1">';
	//-------------------------------------------------------------------------
	$resumen_dos.='<table width="600" border="1" cellpadding="0" cellspacing="0">
     <tr>
       <td bgcolor="#D0DCEA" width="400"  ><span class="espetxt"><b>Terapeuta</b></span></td>
        <td bgcolor="#D0DCEA"  ><span class="espetxt"><b></b></span></td>
     </tr>';
	 
	      foreach ($valor as $clave1 => $valor2) {
		     
			// print_r($valor2);
			 $resumen_dos.='<tr>
					<td><span class="espetxt1">'.$clave1.'</span></td>
					<td><span class="espetxt1">';
					
					    $resumen_dos.='<table width="300" border="1" cellpadding="0" cellspacing="0">
								 <tr>
								   <td bgcolor="#D0DCEA" width="150"><span class="espetxt"><b>CATEGORIA</b></span></td>
									<td bgcolor="#D0DCEA"  width="150" ><span class="espetxt"><b>No.TERAPIAS</b></span></td>
								 </tr>';
						$TOTAL_suma=0;		 
						foreach ($valor2 as $clave2 => $valor3) {
						        
								$resumen_dos.='<tr>
										<td><span class="espetxt1">'.$clave2.'</span></td>
										<td><span class="espetxt1">'.$valor3.'</span></td></tr>';
						         $TOTAL_suma=$TOTAL_suma+$valor3;
						}		 
						
						
						 
						
						$resumen_dos.='<tr>
										<td><span class="espetxt1"><b>TOTAL</b></span></td>
										<td><span class="espetxt1"><b>'.$TOTAL_suma.'</b></span></td></tr>';
										
						$resumen_dos.='</table>';		 
					
					
			$resumen_dos.='</span></td>
					</tr>';
		  
		  }
	 
	 $resumen_dos.='</table></center>';
	//-------------------------------------------------------------------------
	
	$resumen_dos.='</span></td>
  </tr>';
		
}
  
$resumen_dos.='</table>
';

echo $documento.'<br>'.$resumen_dos;


?> 
<br /><br />
<table width="700" border="1" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <td bgcolor="#D2E2EE"><span class="arplano"><b>TERAPEUTA</b></span></td>
    <td bgcolor="#D2E2EE"><span class="arplano"><b>No. EVALUACIONES</b></span></td>
  </tr>
  <?php
  //psicologia
$total_evl=0;
$lista_terapias="select ps.usua_id,count(psic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_psicologia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$desde_val."' and asighor_fecha<='".$hasta_val."') and at.centro_id=".$_GET['centro_id']." group by ps.usua_id";



  $rs_gogessform = $DB_gogess->executec($lista_terapias,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="espetxt1"><?php echo $nusuario; ?></span></td>
    <td><span class="espetxt1"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
        $total_evl=$rs_gogessform->fields["total"]+$total_evl;
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  
  
   <?php
   //pedagogia

$lista_terapias="select ps.usua_id,count(pedago_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_pedagogia ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$desde_val."' and asighor_fecha<='".$hasta_val."') and at.centro_id=".$_GET['centro_id']." group by ps.usua_id";



//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->executec($lista_terapias,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="espetxt1"><?php echo $nusuario; ?></span></td>
    <td><span class="espetxt1"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
        $total_evl=$rs_gogessform->fields["total"]+$total_evl;
		
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  <?php
  //lenguaje

$lista_terapias="select ps.usua_id,count(lenguaj_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_lenguaje ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$desde_val."' and asighor_fecha<='".$hasta_val."') and at.centro_id=".$_GET['centro_id']." group by ps.usua_id";



//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->executec($lista_terapias,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
  ?>
  <tr>
    <td><span class="espetxt1"><?php echo $nusuario; ?></span></td>
    <td><span class="espetxt1"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php
        $total_evl=$rs_gogessform->fields["total"]+$total_evl;
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
  
  
  
   <?php
  //terapia fisica

$lista_terapias="select ps.usua_id,count(terfisic_id) as total from dns_atencion at inner join dns_atencionevaluacion ateeva on at.atenc_enlace=ateeva.atenc_enlace inner join faesa_asigahorario asig on asig.eteneva_id=ateeva.eteneva_id inner join faesa_terapiafisica ps on ps.eteneva_id=ateeva.eteneva_id where eteneva_num=1 and (asighor_fecha>='".$desde_val."' and asighor_fecha<='".$hasta_val."') and at.centro_id=".$_GET['centro_id']." group by ps.usua_id";



//echo $lista_terapias;
  $rs_gogessform = $DB_gogess->executec($lista_terapias,array());
 if($rs_gogessform)
 {
     	while (!$rs_gogessform->EOF) {
  
       $nusuario='';
       $nusuario=$objformulario->replace_cmb("app_usuario","usua_id,usua_nombre,usua_apellido"," where usua_id=",$rs_gogessform->fields["usua_id"],$DB_gogess);
	   $noasi="";
	   if(!($nusuario))
	   {
	     $noasi="No asignado";
	   }
  ?>
  <tr>
    <td><span class="espetxt1"><?php echo $nusuario.$noasi; ?></span></td>
    <td><span class="espetxt1"><?php echo $rs_gogessform->fields["total"]; ?></span></td>
  </tr>
  <?php 
        $total_evl=$rs_gogessform->fields["total"]+$total_evl;
        $rs_gogessform->MoveNext();	
		}
  }
  ?>
   <tr>
    <td><span class="espetxt1"><B>TOTAL</B></span></td>
    <td><span class="espetxt1"><b><?php echo $total_evl; ?></b></span></td>
  </tr>
  
</table>

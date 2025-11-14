<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include("libreport.php");
include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";
//saca datos de empresa para filtrar

//armasql busqueda
$eteneva_id=$_POST["eteneva_id"]=13;
$clie_id=$_POST["clie_id"]=8;

//////eteneva_id
$reporte=1;

 echo  	$lista_paciente="select * from app_cliente where clie_id='".$clie_id."'";
$rs_paciente = $DB_gogess->executec($lista_paciente,array());



$html='<table width="100%" border="0">


  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><h2>INFORME DE EVALUACIÓN</h2></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="59">I. DATOS PERSONALES:</td>
  </tr>
  <!-- DATOS PERSONALES --->
  <tr>
    <td>
      <table width="50%" border="0" align="left">
      <tr>
        <td width="58%">NOMBRES COMPLETOS:</td>
        <td width="9%">&nbsp;</td>
        <td width="33%">'.$rs_paciente->fields["clie_nombre"].' '.$rs_paciente->fields["clie_apellido"].'</td>
      </tr>
      <tr>
        <td>HISTORIA CLINICA:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["atenc_hc"].'</td>
      </tr>
      <tr>
        <td>FECHA DE NACIMIENTO:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_fechanacimiento"].'</td>
      </tr>
       <tr>
        <td height="25">EDAD:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_fechanacimiento"].'</td>
      </tr>
       <tr>
        <td>DIRECCIÓN:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_direccion"].'</td>
      </tr>
       <tr>
        <td>TELÉFONO:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_telefono"].'</td>
      </tr>
       <tr>
        <td>INSTRUCCIÓN:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_instruccion"].'</td>
      </tr>
       <tr>
        <td>INSTITUCIÓN:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_institucion"].'</td>
      </tr>
       <tr>
        <td>FUENTE DE DATOS:</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["clie_encadodeemergencia"].'</td>
      </tr>
       <tr>
        <td>FECHA DE EVALUACIÓN</td>
        <td>&nbsp;</td>
        <td>'.$rs_paciente->fields["atenc_fecharegistro"].'</td>
      </tr>
      
    </table>
    
    </td>
  </tr>
  <!-- CIERRE DATOS PERSONALES --->
  <!-- MOTIVOS DE CONSULTA --->
  
    <tr>
      
        <td>&nbsp;</td>
      </tr>
  <tr>
        <td>II. MOTIVO DE CONSULTA:</td>
      </tr>
      <tr>
        <td><p align="justify">'.$rs_paciente->fields["atenc_observacion"].'</p></td>
      </tr>
       <tr>
      
        <td>&nbsp;</td>
      </tr>
      
       <!-- CIERRE MOTIVOS DE CONSULTA --->
  
  <!-- APLICACIÓN DE REACTIVOS Y RESULTADOS DE LA EVALUACIÓN --->
  
   
  <tr>
        <td>II. APLICACIÓN DE REACTIVOS Y RESULTADOS DE LA EVALUACIÓN:</td>
      </tr>
   <tr>
   <td>&nbsp;</td>
    </tr>
      <tr>
      
        <td><li>Observación y entrvista clínica:</li></td>
      </tr>
      
      
      <tr>
      
        <td>
  
  <tr>
    <td>';//<?php
    
	 	$lista_evaluacion="select * from dns_atencionevaluacion where eteneva_id=".$eteneva_id;
$rs_evaluacion = $DB_gogess->executec($lista_evaluacion,array());
		$rs_evaluacion->fields["eteneva_ps"];
		$rs_evaluacion->fields["eteneva_p"];
		$rs_evaluacion->fields["eteneva_l"];
	 	$rs_evaluacion->fields["eteneva_tf"];
		$rs_evaluacion->fields["eteneva_tf"];
	echo	$atenc_enlace=$rs_evaluacion->fields["atenc_enlace"];
		//$grupg_tablasexternasino=$rs_evaluacion->fields["grupg_tablasexternasino"];
		//$grupg_tablasexterna=$rs_evaluacion->fields["grupg_tablasexterna"];
		
		
		
		
  	$lista_tabeval="select * from faesa_tablaevaluacion";
$rs_tabeval = $DB_gogess->executec($lista_tabeval,array());
$rs_tabeval2 = $DB_gogess->executec($lista_tabeval,array());

//echo $rs_tabeval2->fields["tabeval_evaluacion"];

 // $rs_evaluacion->fields[$rs_tabeval->fields["tabeval_evaluacion"]];
 // echo $rs_tabeval->fields["tabeval_obsentreclin"];

if($rs_tabeval)
 {

	  while (!$rs_tabeval->EOF) {	
	   
	
		if($rs_evaluacion->fields[$rs_tabeval->fields["tabeval_evaluacion"]]=="true")
		{
			
		// $rs_evaluacion->fields[$rs_tabeval->fields["tabeval_obsentreclin"]];
		
	   	$lista_campollenosino="select * from ".$rs_tabeval->fields["tabeval_tabla"]." where atenc_id='".$eteneva_id."'";
$rs_tabsinocamp = $DB_gogess->executec($lista_campollenosino,array());
			
			
			
			
$entrevistaclinica=$rs_tabeval->fields["tabeval_alias"]."entrevistaclinica";

  if($rs_tabsinocamp->fields[$entrevistaclinica])
			{
				
				/*	$celdas=$nombreceldas[$i];
						 @$caractprimero=substr($campostodosarray[$i], 0,1);
					
						$celdas= str_replace('-', '', $celdas);*/
						
						//$html.='<td>'.$rs_tabsinocamp->fields[$rs_tabeval->fields["tabeval_obsentreclin"]].'</td>';
				
				
         $html.=' <tr>     
      			  <td>&nbsp;</td>
     			 </tr>
		 <tr>
        <td align="justify"><li>'.$rs_tabeval->fields["tabeval_titulo"].'</li> '.$rs_tabsinocamp->fields[$rs_tabeval->fields["tabeval_obsentreclin"]].' </br> </td>
        </tr>';

		}
		
		
	
		
		 }
					
		 $rs_tabeval->MoveNext();	   

	  }
  }


$rs_tabeval=$rs_tabeval2;
///$rs_tabeval3=$rs_tabeval2;
  


if($rs_tabeval)
 {

	  while (!$rs_tabeval->EOF) {	
	   
	
		if($rs_evaluacion->fields[$rs_tabeval->fields["tabeval_evaluacion"]]=="true")
		{

	///	if()

  $lista_campollenosino="select * from ".$rs_tabeval->fields["tabeval_tabla"]." where atenc_id='".$eteneva_id."'";
$rs_tabsinocamp = $DB_gogess->executec($lista_campollenosino,array());


		
	//////////grupos de formulario		
   $lista_formulariog="select * from faesa_gruposgrids where tabeval_id=".$rs_tabeval->fields["tabeval_id"]." order by grupg_orden asc" ;
 
	$rs_formgrup = $DB_gogess->executec($lista_formulariog,array());
	


	
	 if($rs_formgrup)
 {
	 
	 
	
		

	  while (!$rs_formgrup->EOF) {	 
	  
	  	 $grupg_tablasexternasino=$rs_formgrup->fields["grupg_tablasexternasino"];
 	$grupg_tablasexterna=$rs_formgrup->fields["grupg_tablasexterna"];
	 $atenc_enlace;
	 $campelace=$rs_tabeval2->fields["tabeval_alias"]."enlace";
	 
	 if($rs_formgrup->fields["grupg_id"])
	{
	 $formulariosino= sinoformulario($rs_formgrup->fields["grupg_id"],$rs_tabeval->fields["tabeval_tabla"],$eteneva_id,$grupg_tablasexternasino,$grupg_tablasexterna,$atenc_enlace,$campelace,$DB_gogess);

	}
	
		if($formulariosino>0)
	{
	 
	  
	$cabecera=0;
	///////revisa los campos del formulario
	$lista_formcampos="select * from faesa_gruposcamposgrid where grupg_id=".$rs_formgrup->fields["grupg_id"]." order by grupgcamp_orden asc";
	$rs_formgrupcamp = $DB_gogess->executec($lista_formcampos,array());
	$campostodos="";
	
	//$rs_formgrupcamp->fields["grupgcamp_campos"];
	$banderaformulario=0;
	  if($rs_formgrupcamp)
 {
	  while (!$rs_formgrupcamp->EOF) {	 
	  
	
			    $campostodos=$rs_formgrupcamp->fields["grupgcamp_campos"].",";
			   $rs_formgrupcamp->fields["grupgcamp_campos"];
		
	  
	  $rs_formgrupcamp->MoveNext();	   

	  }
	  
 }
	  
	  $campostodosarray = explode(",", $campostodos);
	  
	  for ($i = 0; $i <= count($campostodosarray); $i++) {
   		
			//$banderaform=1;
		//print_r($campostodosarray);
	   @$caractprimero=substr($campostodosarray[$i], 0,1);
		if($caractprimero=='-'){
			
			   $campostodosarray[$i];
		   	$nombrecampos= str_replace('-', '', $campostodosarray[$i]);
			
	//echo  $rs_tabsinocamp->fields[$nombrecampos]."<br>";
	
	
			
			if(@$rs_tabsinocamp->fields[$nombrecampos]!="")
			{
				$banderaformulario=1;
				}
					 
			}
	    }
		
		if($rs_formgrup->fields["grupg_titulo"])
		{
	 $html.='
	 <tr><td></br></td></tr>
	 <tr><td colspan="'.$rs_formgrup->fields["grupg_numcolumnas"].'" ><h3>'.utf8_encode($rs_formgrup->fields["grupg_titulo"]).'<h3></td></tr>'; }
	 
	 if($rs_formgrup->fields["grupg_subtitulo"])
		{
	 $html.='
	 <tr><td></td></tr>
	 <tr><td colspan="'.$rs_formgrup->fields["grupg_numcolumnas"].'"  >'.utf8_encode($rs_formgrup->fields["grupg_subtitulo"]).'</td></tr>';
	 $html.='<tr><td></td></tr>';
	 
	  }else{
		$html.='<tr><td></br></td></tr>';  
		  }
	 
	 
	  $html.='<table width="70%" border="'.$rs_formgrup->fields["grupg_borde"].'">';
	 
	/// echo $rs_formgrup->fields["grupg_numcolumnas"];
	 if($cabecera==0){
		 
		 $html.='<tr>';
		 
		  for($i = 0; $i < $rs_formgrup->fields["grupg_numcolumnas"]; $i++){
			  
			  
			  
			  $nombrecolumnas = explode(",", $rs_formgrup->fields["grupg_gruponombrecolumnas"]);
	         
			  
		 
		 		
				 $html.='<td><h4>'.$nombrecolumnas[$i].'<h4></td>';
		 
			 }
		 
		 $html.='</tr>';
		 
		 $cabecera=1;
		 }
	 
	 
	 $html.='<tr>';
	///////////////// lista externa
	// echo $grupg_tablasexternasino;
	 if($grupg_tablasexternasino==1)
	{
		
	  	$lista_formcampos2="select * from ".$rs_formgrup->fields["grupg_tablasexterna"]." where ".$rs_tabeval2->fields["tabeval_alias"]."enlace='".$atenc_enlace."' ";
	$rs_formgrupcamp2 = $DB_gogess->executec($lista_formcampos2,array());
	
	
	
	  $lista_formulariogg="SELECT *
FROM faesa_gruposcamposgrid
  INNER JOIN faesa_gruposgrids ON faesa_gruposgrids.grupg_id =
    faesa_gruposcamposgrid.grupg_id where faesa_gruposgrids.grupg_id=".$rs_formgrup->fields["grupg_id"];
	$rs_formgruppp = $DB_gogess->executec($lista_formulariogg,array());
	$grupg_numcolumnas=$rs_formgruppp->fields["grupg_numcolumnas"];
	
	$nombrecolumnass = explode(",", $rs_formgruppp->fields["grupgcamp_campos"]);
	         
	//print_r($nombrecolumnass);
	
	  if($rs_formgrupcamp2)
 {
	 $html.='<tr>';
	 
	 
	 
	  while (!$rs_formgrupcamp2->EOF) {	 
	  
	  for($i = 0; $i < $grupg_numcolumnas; $i++){
		  
		     $caractprimero=substr($nombrecolumnass[$i], 0,1);
		if($caractprimero=='-'){
			
			   $campostodosarray[$i];
		   	$nombrecampos= str_replace('-', '', $nombrecolumnass[$i]);
		  
			
		$html.='<td>'.$rs_formgrupcamp2->fields[$nombrecampos].'</td>';		
					
	  //$html.='<td>'.$nombrecolumnass[$i].'</td>';
	  
		}
		if($caractprimero=='('){
			
			$camposexternos= str_replace('(', '', $nombrecolumnass[$i]);
			$camposexternos= str_replace(')', '', $camposexternos);
			
			$nombrecolumexter = explode(";", $camposexternos);
			
		

	//print_r($nombrecolumexter);
 $lista_campdato="select * from ".$nombrecolumexter[0]." where ".$nombrecolumexter[1]."='".$rs_formgrupcamp2->fields[$nombrecolumexter[1]]."' ";
	$rs_campdato = $DB_gogess->executec($lista_campdato,array());
	
	$html.='<td>'.$rs_campdato->fields[$nombrecolumexter[2]].'</td>';		
					
			
			}
	  		
			}
			
			  $rs_formgrupcamp2->MoveNext();	   


	  }
	  
	   $html.='</tr>';
	  }
	  
		}
	//////////////fin  lista externa
	// echo $grupg_tablasexternasino;
	  if($grupg_tablasexternasino==0)
	{
		$lista_formcampos2="select * from faesa_gruposcamposgrid where grupg_id=".$rs_formgrup->fields["grupg_id"]." order by grupgcamp_orden asc";
	$rs_formgrupcamp2 = $DB_gogess->executec($lista_formcampos2,array());
	
	
	  if($rs_formgrupcamp2)
 {
	  while (!$rs_formgrupcamp2->EOF) {	 
	  
	  $sivafila="";
	  				
					$html.='<tr>';
					
					///////////////	diferenciaceldas de titulos		
					$campostodosarray = explode(",", $rs_formgrupcamp2->fields["grupgcamp_campos"]);
					//print_r($campostodosarray);
				
					for($i = 0; $i < count($campostodosarray); $i++){
						
						   @$caractprimero=substr($campostodosarray[$i], 0,1);
		if($caractprimero=='-'){
			
			   $campostodosarray[$i];
		   	$nombrecampos= str_replace('-', '', $campostodosarray[$i]);
			
			
			if($sivafila=="")
		{
			
			if($rs_tabsinocamp->fields[$nombrecampos]!="")
			{
			$sivafila=1;
				
				}
			}
		}
					}
				
			////////////////fin diferenciaceldas de titulos		
			if($sivafila==1)
			{
				$nombreceldas = explode(",", $rs_formgrupcamp2->fields["grupgcamp_campos"]);
					
					for($i = 0; $i < count($nombreceldas); $i++){
						
						//$html.='<td>'.$nombreceldas[$i].'</td>';
						$celdas=$nombreceldas[$i];
						 @$caractprimero=substr($campostodosarray[$i], 0,1);
					if($caractprimero=='-'){
						$celdas= str_replace('-', '', $celdas);
						
						$html.='<td>'.$rs_tabsinocamp->fields[$celdas].'</td>';
						
								}else{
									
									$html.='<td>'.$nombreceldas[$i].'</td>';
									}
						}
			}
	
			     $html.='</tr>';
		
	  
	  $rs_formgrupcamp2->MoveNext();	   

	  }
	  
 }
 
	}
	
		 $html.='</tr>';
		
		 $html.='</table>';
		
	}
		
		 $rs_formgrup->MoveNext();	   
  
	  }
	  
 }
	  
	
	}
	 $rs_tabeval->MoveNext();	   

	  }
  }

	
	
	
		
		
  
   
      
	  ///////fin revisa los campos del formulario
	  

//////////grupos de formulario	  
		
		




    
   $html.='</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>
	
	
	</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
  </tr>
</table>';

echo $html;
	

?>
<!--
<table width="200" border="1">
  <tr>
    <td colspan="" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
